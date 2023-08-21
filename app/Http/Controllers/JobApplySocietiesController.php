<?php

namespace App\Http\Controllers;

use App\Helpers\ApiFormatter;
use App\Models\job_apply_societies;
use App\Models\job_apply_positions;
use App\Models\validations;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobApplySocietiesController extends Controller
{
    public function index (Request $request) {
        $job_apply_societies = job_apply_societies::where('society_id', $request->user->id)->with(['job_vacancies.job_categories', 'job_apply_positions.available_positions'])->first();

        $vacancies = [
            'id' => $job_apply_societies->id,
            'category' => $job_apply_societies->job_vacancies->job_categories,
            'company' => $job_apply_societies->job_vacancies->company,
            'address' => $job_apply_societies->job_vacancies->address,
            'position' => $job_apply_societies->job_apply_positions->map(function ($position) use ($job_apply_societies) {
                return [
                    'position' => $position->available_positions->position,
                    'apply_status' => $position->status,
                    'notes' => $job_apply_societies->notes
                ];
            })
        ];

        return ApiFormatter::createApi(200, ['vacancies' => $vacancies]);
    }

    public function apply (Request $request) {
        $validator = Validator::make($request->all(), [
            'vacancy_id' => 'required',
            'positions' => 'required'
        ]);

        if ($validator->fails()) {
            return ApiFormatter::createApi(401, [
                'message' => 'Invalid field',
                'errors' => $validator->errors()
            ]);
        }

        $hasApplied = job_apply_societies::where('society_id',$request->user->id)->count() > 0;

        if ($hasApplied) {
            return ApiFormatter::createApi(401, ['message' => 'Application for a job can only be once']);
        }

        $validation = validations::where('society_id', $request->user->id)->first();

        if ($validation->status !== 'accepted') {
            return ApiFormatter::createApi(401, ['message' => 'Your data validator must be accepted by validator before']);
        }

        $now = Carbon::now();

        $job_apply_societies = job_apply_societies::create([
            'notes' => $request->notes,
            'date' => $now,
            'society_id' => $request->user->id,
            'job_vacancy_id' => $request->vacancy_id
        ]);

        foreach ($request->positions as $position) {
            job_apply_positions::create([
                'date' => $now,
                'society_id' => $request->user->id,
                'job_vacancy_id' => $request->vacancy_id,
                'position_id' => $position,
                'job_apply_societies_id' => $job_apply_societies->id
            ]);
        }

        return ApiFormatter::createApi(200, ['message' => 'Applying for job successful']);
    }
}
