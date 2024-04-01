<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post("/verify-recaptcha", function(Request $request) {
    $captcha_response = $request->input("captcha") == null ? "null": $request->input("captcha");
    $secret = "6Ldv0aopAAAAAF0-mVyVTlbSq0PC1d8Tdcn8Y-yq"; 

        $apiUrl = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
        'secret' => $secret,
        'response' => $captcha_response,
        'remoteip' => $request->ip()
    ];

    $response = Http::withoutVerifying()->withOptions(["verify"=>false])->asForm()->post($apiUrl, $data);

    return response()->json(["status" => json_decode($response->body())->success]);
}); 


Route::post("/contact-us", function(Request $request) {

   $g_captcha_resp = $request->input()["g-recaptcha-response"];
   
}); 