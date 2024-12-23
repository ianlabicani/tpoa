<?php

use App\Http\Controllers\Admin\DestinationController as AdminDestinationController;
use App\Http\Controllers\User\DestinationController as UserDestinationController;
use App\Http\Controllers\User\FeedbackController as UserFeedbackController;
use App\Http\Controllers\User\VideoController as UserVideoController;
use App\Http\Controllers\Guest\DestinationController as GuestDestinationController;
use App\Http\Controllers\Guest\VideoController as GuestVideoController;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('guest.welcome');
})->name('/');
Route::get('about', function () {
    return view('guest.about');
})->name('about');
Route::get('services', function () {
    return view('guest.services');
})->name('services');
Route::get('contact', function () {
    return view('guest.contact');
})->name('contact');
Route::get('destinations', [GuestDestinationController::class, 'index'])->name('destinations.index');
Route::get('destinations/{destination}', [GuestDestinationController::class, 'show'])->name('destinations.show');
Route::get('destinations-videos', [GuestVideoController::class, 'showDestinationVideos'])->name('destinations.videos');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::resource('destinations', AdminDestinationController::class);
});

Route::prefix('user')->name('user.')->middleware(['auth', 'role:user'])->group(function () {
    Route::get('dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');
    Route::resource('destinations', UserDestinationController::class);
    Route::resource('feedbacks', UserFeedbackController::class);
    Route::prefix('destinations/{destination}')->name('destinations.')->group(function () {
        Route::resource('videos', UserVideoController::class);
    });
});

