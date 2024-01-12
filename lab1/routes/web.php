<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
    $validator = Validator::make($request->all(), [
        'username' => 'required|min:4|max:32',
        'email' => 'required|email|different:username',
        'password' => 'required|min:6|same:password_confirm',
    ]);

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