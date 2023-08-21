<?php

namespace App\Http\Controllers;

use App\Helpers\ApiFormatter;
use App\Models\validations;
use Illuminate\Http\Request;

class ValidationsController extends Controller
{
    public function index (Request $request) {
        $validations = validations::where('society_id', $request->user->id)->with('validators')->first();

        return ApiFormatter::createApi(200, ['validation'=>[
            'id' => $validations->id,
            'status' => $validations->status,
            'work_experience' => $validations->work_experience,
            'job_category_id' => $validations->job_category_id,
            'job_position' => $validations->job_position,
            'reason_accepted' => $validations->reason_accepted,
            'validator_notes' => $validations->validator_notes,
            'validators' => $validations->validators
        ]]);
    }
    public function requestValidation (Request $request) {
        // return societies::where('login_tokens', $request->token)->first();
        $user =  $request->user;

        validations::create([
            'society_id'=>$user->id,
            'work_experience' => $request->work_experience,
            'job_category_id' => $request->job_category_id,
            'job_position' => $request->job_position,
            'reason_accepted' => $request->reason_accepted
        ]);

        return ApiFormatter::createApi(200, ['message'=>'Request data validation sent successful']);
    }
}
