<?php
// admin



// user

use App\Http\Controllers\StudentController;

// guest

use App\Http\Controllers\ProfileController;

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




        // Pass data to the view (if needed)
        return view('admin.dashboard', compact('reactionCounts', 'totalVisitors', 'videoCounts'));
    })->name('dashboard');
});




// Route for User
Route::prefix('user')->name('user.')->middleware(['auth', 'role:user'])->group(function () {
    Route::get('dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');

     Route::get('/students', [StudentController::class, 'create'])->name('students.create');
});
