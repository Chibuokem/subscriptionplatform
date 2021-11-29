<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\WebsitesController;
use App\Http\Controllers\Api\V1\PostsController;
use App\Http\Controllers\Api\V1\SubscriptionsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    //endpoint to create website
    Route::post('/create-website', [WebsitesController::class,'createWebsite']);
    //endpoint to create post
    Route::post('/create-post', [PostsController::class,'createPost']);
    //add subscriber
    Route::post('/add-subscriber', [SubscriptionsController::class,'addSubscriberToWebsite']);
});
