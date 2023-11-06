<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MassBookingController;
Use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\DonationController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/create-mass-booking', [MassBookingController::class,'createMassBook']);
// view
Route::get("/mass-booking", [MassBookingController::class, 'massbookListing']);
Route::get("/mass-booking/{id}", [MassBookingController::class, 'massbookDetail']);
Route::delete("/mass-booking/{id}", [MassBookingController::class, 'massbookDelete']);
Route::get('/get-restriction', [MassBookingController::class, 'getRestriction'])->name('getRestriction'); 
Route::post('/createdonation', [DonationController::class, 'createDonation']);
Route::get("/donation", [DonationController::class, 'donationListing']);
Route::get('/editdonation/{id}', [DonationController::class, 'donationDetail']);
Route::delete('/deletedonation/{id}', [DonationController::class, 'donationDelete']);


