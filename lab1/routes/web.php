<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Mews\Captcha\Facades\Captcha;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/userform', function () {
    return view('userform');
});

Route::post('/userform', function (Request $request): RedirectResponse {
    $messages = [
        'username.required' => 'Please enter a username.',
        'username.min' => 'The username must be at least :min characters.',
        'username.max' => 'The username may not be greater than :max characters.',
        'email.required' => 'Please enter an email address.',
        'email.email' => 'Please enter a valid email address.',
        'email.different' => 'The email address must be different from the username.',
        'password.required' => 'Please enter a password.',
        'password.min' => 'The password must be at least :min characters.',
        'password.same' => 'The passwords do not match. Please try again.',
        'captcha.required' => 'Please enter the CAPTCHA code.',
        'captcha.captcha' => 'The CAPTCHA code is incorrect. Please try again.',
    ];

    $validator = Validator::make($request->all(), [
        'username' => 'required|min:4|max:32',
        'email' => 'required|email|different:username',
        'password' => 'required|min:6|same:password_confirm',
        'captcha' => 'required|captcha',
    ], $messages);

    if ($validator->fails()) {
        return redirect('/userform')
            ->withErrors($validator)
            ->withInput();
    }

    // If validation passes, redirect to 'userresults' route with old input
    return redirect('/userresults')->withInput();
});

Route::get('/userresults', function () {
    return dd(request()->old());
});

// Add this route to your web.php file
Route::get('/refresh-captcha', function () {
    return Captcha::img();
});