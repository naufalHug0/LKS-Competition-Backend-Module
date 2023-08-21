<?php
namespace App\Helpers;

class ApiFormatter {
    public static function createApi($status, $body) {
        return response()->json($body, $status);
    }
}