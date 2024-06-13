<?php

use App\Http\Controllers\ReportedVideosController;
use App\Http\Controllers\WatchController;
use Illuminate\Support\Facades\Route;

// Controllers/Resource Controllers
use App\Http\Controllers\VideoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ThumbnailController;
use App\Models\Video;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__.'/auth.php';

// Home
Route::get("/", [HomeController::class, "show"])->name("home");

// Search
Route::get('/search', [SearchController::class, "search"]);

// Upload
Route::get("/upload", [VideoController::class, "create"])->middleware("auth");
Route::post("/upload", [VideoController::class, "store"])->middleware("auth");
Route::post("/upload-youtube", [VideoController::class, "storeFromYoutube"])->middleware("auth");

// Watch
Route::get("/watch", [WatchController::class, "show"]);

Route::get("/watch/{videoid}/{resolution}/{filename}", [VideoController::class, "show"]);
Route::get("/watch/{videoid}/{filename}", [VideoController::class, "showPlaylist"]);
Route::get("/api/watch/liked", [WatchController::class, "videoLiked"]);
Route::get("/api/watch/disliked", [WatchController::class, "videoDisliked"]);
Route::get("/api/watch/like_rem_row", [WatchController::class, "deleteLikeRow"]);
Route::post("/api/watch/report_video", [WatchController::class, "videoReported"]);

// Admin
Route::get("/reported-videos", [ReportedVideosController::class, "show"]);

// Account
Route::view("/login", "account.login")->middleware("nonauth");
Route::view("/register", "account.register")->middleware("nonauth");

// API
Route::get("/api/thumbnail", [ThumbnailController::class, "show"]);