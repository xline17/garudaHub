<?php

use App\Http\Controllers\BidController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('projects.index');
});

Route::resource('projects', ProjectController::class);
Route::post('projects/{project}/bids', [BidController::class, 'store'])->name('bids.store');
Route::delete('bids/{bid}', [BidController::class, 'destroy'])->name('bids.destroy');