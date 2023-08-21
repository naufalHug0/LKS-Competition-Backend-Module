<?php

namespace App\Http\Controllers;

use App\Models\societies;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login (Request $request) {
        $society = societies::select(
            'name', 'born_date','gender','address','regional_id'
        )->with('regionals')->where('id_card_number', $request->id_card_number)->where('password', $request->password)->first();

        if ($society) {
            $society['token'] = md5($society->id_card_number);

            societies::where('id_card_number', $request->id_card_number)->update(['login_tokens'=>$society['token']]);

            return ApiFormatter::createApi(200, $society);
        }

        return ApiFormatter::createApi(401, ['message'=>'ID Card Number or Password incorrect']);
    }

    public function logout (Request $request) {
        $updated_row = societies::where('login_tokens', $request->token)->update(['login_tokens'=>null]);

        if ($updated_row > 0) {
            return ApiFormatter::createApi(200, ['message'=>'Logout success']);
        }

        return ApiFormatter::createApi(401, ['message'=>'Invalid token']);
    }
}
