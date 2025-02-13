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
use App\Http\Controllers\User\HotelController as GuestHotelController;
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
use App\Http\Controllers\Guest\HotelController;
use App\Http\Middleware\TrackVisitor;       
use App\Models\Event;
use Carbon\Carbon;

//ROUTE FOR GUEST

Route::get('/', function () {
    $events = Event::orderBy('start_date', 'asc')
        ->where('start_date', '>=', Carbon::now())
        ->get()
        ->groupBy(function ($event) {
            return Carbon::parse($event->start_date)->format('F Y');
        });

    return view('guest.welcome', compact('events'));
})->name('/');


Route::get('destinations', [GuestDestinationController::class, 'index'])->name('destinations.index');
Route::get('destinations/{destination}', [GuestDestinationController::class, 'show'])->name('destinations.show');
Route::post('destinations/{destination}/share', [ShareDestinationController::class, 'share'])->name('destinations.share');
Route::get('destinations-videos', [GuestVideoController::class, 'showDestinationVideos'])->name('destinations.videos');
Route::get('history', [GuestController::class, 'history'])->name('history');
Route::get('culture', [GuestController::class, 'culture'])->name('culture');
Route::get('events', [GuestController::class, 'events'])->name('guest.events');
Route::get('events/{event}', [GuestController::class, 'show_event'])->name('events.show');
Route::get('contact', [GuestController::class, 'contact'])->name('contact');

Route::get('hotels', [HotelController::class, 'index'])->name('hotels.index');
Route::get('hotels/{hotel}', [HotelController::class, 'show'])->name('hotels.show');


//CULTURE ROUTES
Route::get('farming', [GuestController::class, 'farming'])->name('farming');
Route::get('fishing', [GuestController::class, 'fishing'])->name('fishing');
Route::get('wgakka_gathering', [GuestController::class, 'gakka'])->name('gakka');
Route::get('dried_fish', [GuestController::class, 'dried_fish'])->name('dried_fish');
Route::get('nipa_thatch', [GuestController::class, 'nipa_thatch'])->name('nipa_thatch');
Route::get('miki_niladdit', [GuestController::class, 'miki_niladdit'])->name('miki_niladdit');
Route::get('web/culture/aramang_ukoy', [GuestController::class, 'aramang_ukoy'])->name('aramang_ukoy');
Route::get('gallery/{id}', [GalleryController::class, 'show'])->name('gallery.show');
//PRODUCTS 
Route::get('products', [GuestController::class, 'products'])->name('products');
Route::get('alamang', [GuestController::class, 'alamang'])->name('alamang');
Route::get('daing', [GuestController::class, 'daing'])->name('daing');
Route::get('nipa_wine', [GuestController::class, 'nipa_wine'])->name('nipa_wine');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';

// ROUTE FOR ADMIN
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('dashboard', function () {
         // Query for reaction counts
    $reactionCounts = FeedbackReaction::select('reaction', DB::raw('COUNT(*) as total_count'))
    ->groupBy('reaction')
    ->get();

// Total number of unique visitors based on visitor_logs
$totalVisitors = DB::table('visitor_logs')
    ->distinct('ip_address') // Count unique IP addresses
    ->count('ip_address');

// Visitor counts grouped by date (for graph)
$visitorData = DB::table('visitor_logs')
    ->select(DB::raw('DATE(visited_at) as date'), DB::raw('COUNT(DISTINCT ip_address) as count'))
    ->groupBy('date')
    ->orderBy('date')
    ->get();

$visitorDates = $visitorData->pluck('date'); // Dates for the visitor graph
$visitorCounts = $visitorData->pluck('count'); // Counts for the visitor graph

// Video counts grouped by destinations
$videoCounts = Video::select('destination_id', DB::raw('COUNT(*) as total_videos'))
    ->groupBy('destination_id')
    ->with('destination:id,name') // Include destination name
    ->get();

// Extract video labels and data for the chart
$videoLabels = $videoCounts->map(function ($videoCount) {
    return $videoCount->destination->name ?? 'Unknown';
});

$videoData = $videoCounts->pluck('total_videos');

// Reaction labels and data for graph
$reactionLabels = ['Like', 'Dislike'];
$reactionData = [
    $reactionCounts->where('reaction', 'like')->first()?->total_count ?? 0,
    $reactionCounts->where('reaction', 'dislike')->first()?->total_count ?? 0,
];

// Return the view with all the data
return view('admin.dashboard', compact(
    'reactionCounts',
    'totalVisitors',
    'videoCounts',
    'visitorDates',
    'visitorCounts',
    'reactionLabels',
    'reactionData',
    'videoLabels',
    'videoData'
));
    })->name('dashboard');



    Route::resource('destinations', AdminDestinationController::class);
    Route::resource('videos', AdminVideoController::class);
    Route::put('videos/{video}/review', [AdminVideoController::class, 'review'])->name('videos.review');


    Route::get('feedbacks', [AdminDestinationController::class, 'manageFeedbacks'])->name('feedbacks.index');
    Route::get('details', [AdminDestinationController::class, 'details'])->name('details');

    Route::get('activity-logs', function () {
        $activityLogs = Activity::latest()->paginate(10);
        return view('admin.activity-logs.index', compact('activityLogs'));
    })->name('activity-logs.index');

    Route::get('events', [EventController::class, 'index'])->name('events.index');

    Route::resource('events', EventController::class)->only(['index', 'create', 'store', 'edit', 'update']);
    Route::get('events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::get('events/{event}', [EventController::class, 'show'])->name('events.show');

    Route::resource('hotels', AdminHotelController::class);
});




//ROUTE FOR USER
Route::prefix('user')->name('user.')->middleware(['auth', 'role:user'])->group(function () {
    Route::get('dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');
    Route::resource('destinations', UserDestinationController::class);
    Route::post('feedbacks/{feedback}/like', [UserFeedbackController::class, 'like'])->name('feedbacks.like');
    Route::post('feedbacks/{feedback}/dislike', [UserFeedbackController::class, 'dislike'])->name('feedbacks.dislike');
    Route::resource('feedbacks', UserFeedbackController::class);
    Route::prefix('destinations/{destination}')->name('destinations.')->group(function () {
        Route::resource('videos', UserVideoController::class);


    });

    Route::get('destinations-videos', [UserVideoController::class, 'showDestinationVideos'])->name('destinations.videos');

    Route::get('history', [GuestController::class, 'user_history'])->name('history');
    Route::get('culture', [GuestController::class, 'user_culture'])->name('culture');
    Route::get('events', [GuestController::class, 'events'])->name('events');
    Route::get('events/{event}', [GuestController::class, 'show_event'])->name('events.show');
    Route::get('contact', [GuestController::class, 'user_contact'])->name('contact');
    Route::get('/gallery/{id}', [GalleryController::class, 'show'])->name('gallery.show');

    Route::get('products', [GuestController::class, 'products'])->name('products');
    Route::get('alamang', [GuestController::class, 'alamang'])->name('alamang');
    Route::get('daing', [GuestController::class, 'daing'])->name('daing');
    Route::get('nipa_wine', [GuestController::class, 'nipa_wine'])->name('nipa_wine');
    Route::resource('hotels', UserHotelController::class)->only(['index', 'show']);
});





Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search');




// Wrap routes with the middleware
Route::middleware([TrackVisitor::class])->group(function () {
    Route::get('/', function () {
        return view('guest.welcome');
    })->name('/');
});
