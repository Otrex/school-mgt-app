<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::webhooks('paystack-webhook');

/**
 * [Done] Endpoint for total number of enrollees given the local government
 * [Done] Percentage increase in the number of enrollees in a local government over a given time period (start date, end date, compare start date, compare end date)
 * [Done] Total number of community centers given the local governments
 * [Done] Total number of active computers given the local government
 * [Done] A breakdown of enrollment numbers on a monthly basis given the time period
 *  A ranking of enrollees based on test scores given the local government, month and year.
 */
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api.key', 'prefix' => 'v1'], function () {
    Route::get('/resource-types', [ApiController::class, 'getResourceTypes']);
    Route::get('/states', [ApiController::class, 'getStates']);
    Route::get('/states/{stateId}/local-governments', [ApiController::class, 'getLGAByState']);
    Route::get('/local-governments/{localGovernmentId}/stats', [ApiController::class, 'getLGAStats']);
    Route::get('/local-governments/{localGovernmentId}/enrollments/stats', [ApiController::class, 'getEnrolmentStats']);
    Route::get('/local-governments/{localGovernmentId}/resources/stats', [ApiController::class, 'getTotalActiveResourceInLGA']);
    Route::get('/local-governments/{localGovernmentId}/enrollments/courses/{courseId}/rank', [ApiController::class, 'rankEnrollees']);
    Route::get('/local-governments/{localGovernmentId}/enrollments/percentage-increase', [ApiController::class, 'getEnrolmentPercentageIncrease']);
});

Route::fallback(function () {
    return response()->json([ 'error' => 'Endpoint Not Found' ], 404);
});