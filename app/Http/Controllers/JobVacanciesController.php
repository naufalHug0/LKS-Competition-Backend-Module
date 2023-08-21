<?php

namespace App\Http\Controllers;

use App\Helpers\ApiFormatter;
use App\Models\job_vacancies;
use App\Models\job_apply_positions;
use App\Models\validations;
use Illuminate\Http\Request;

class JobVacanciesController extends Controller
{
    public function index (Request $request) {
        $user_validation = validations::where('society_id', $request->user->id)->first();

        $vacancies = job_vacancies::where('job_category_id', $user_validation->job_category_id)->with(['job_categories', 'available_positions:job_vacancy_id,position,capacity,apply_capacity'])->get();

        return ApiFormatter::createApi(200, ['vacancies' => $vacancies]);
    }

    public function show (Request $request, $id) {
        $vacancy = job_vacancies::find($id)->with([
            'job_categories',
            'available_positions:id,job_vacancy_id,position,capacity,apply_capacity'
        ])->first();

        $vacancy['available_positions']['apply_count'] = job_apply_positions::where('position_id',$vacancy['available_positions']['id'])->count();

        return ApiFormatter::createApi(200, ['vacancy' => $vacancy]);
    }
}