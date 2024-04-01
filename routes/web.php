<?php

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
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

   $response = $request->input();

   Mail::to('tony@urmerch.co.uk')->send(new ContactMail($response["first-name"]." ".$response["last-name"], $response["your-message"], $response["phone"], $response["your-email"], $response["company-organization"]));

   return redirect()->back(); 
   
}); 