<?php
// admin


use App\Http\Controllers\Admin\DestinationController as AdminDestinationController;
use App\Http\Controllers\Admin\EventController;

use App\Http\Controllers\Admin\VideoController as AdminVideoController;
use App\Http\Controllers\HotelController as AdminHotelController;

// user
use App\Http\Controllers\ShareDestinationController;
use App\Http\Controllers\ShareVideoController;
use App\Http\Controllers\User\DestinationController as UserDestinationController;
use App\Http\Controllers\User\FeedbackController as UserFeedbackController;
use App\Http\Controllers\User\VideoController as UserVideoController;
use App\Http\Controllers\User\HotelController as UserHotelController;
// guest
use App\Http\Controllers\Guest\DestinationController as GuestDestinationController;
use App\Http\Controllers\Guest\VideoController as GuestVideoController;
use App\Http\Controllers\Guest\GuestController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController as ControllersSearchController;
use App\Http\Controllers\UserController;
use App\Models\Feedback;
use App\Models\FeedbackReaction;
use App\Models\Video;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;


//ROUTE FOR GUEST
Route::get('/', function () {
    return view('guest.welcome');
})->name('/');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';

// ROUTE FOR ADMIN
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('dashboard', function () {



        // Query the FeedbackReaction table
        $reactionCounts = FeedbackReaction::select('reaction', DB::raw('COUNT(*) as total_count'))
            ->groupBy('reaction')
            ->get();

        $totalVisitors = Feedback::distinct('user_id')->count('user_id');
        $visitorCounts = Feedback::select('destination_id', DB::raw('COUNT(DISTINCT user_id) as total_visitors'))
            ->groupBy('destination_id')
            ->get();

            $videoCounts = Video::select('destination_id', DB::raw('COUNT(*) as total_videos'))
            ->groupBy('destination_id')
            ->with('destination:id,name') // Include destination name
            ->get();

        


        // Pass data to the view (if needed)
        return view('admin.dashboard', compact('reactionCounts','totalVisitors','videoCounts'));
    })->name('dashboard');
   
    Route::get('activity-logs', function () {
        $activityLogs = Activity::latest()->paginate(10);
        return view('admin.activity-logs.index', compact('activityLogs'));
    })->name('activity-logs.index');

});




//ROUTE FOR USER
Route::prefix('user')->name('user.')->middleware(['auth', 'role:user'])->group(function () {
    Route::get('dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');
  
});



Route::prefix('hotel-owner')->name('hotel-owner.')->middleware(['auth', 'role:hotel-owner'])->group(function () {
    Route::get('dashboard', function () {
        return view('hotel-owner.dashboard ');
    })->name('dashboard');
});

