<?php

use App\Models\PropertyAmenity;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\AmenityController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\FloorPlanController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\PropertyTypeController;
use App\Http\Controllers\PropertyCategoryController;

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

Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::group(['prefix' => 'amenity', 'as' => '.amenity'], function () {
        Route::post('save', [AmenityController::class, 'create']);
        Route::post('edit/{amenity:id}', [AmenityController::class, 'update']);
        Route::post('delete/{amenity:id}', [AmenityController::class, 'delete']);
    });

    Route::group(['prefix' => 'category', 'as' => '.category'], function () {
        Route::group(['prefix' => 'category', 'as' => '.category'], function () {
            Route::post('save', [CategoryController::class, 'store']);
            Route::post('edit/{category:ulid}', [CategoryController::class, 'update']);
            Route::post('delete/{category:ulid}', [CategoryController::class, 'delete']);
        });
        Route::group(['prefix' => 'property_category', 'as' => '.property_category'], function () {
            Route::post('save', [PropertyCategoryController::class, 'store']);
            Route::post('edit/{property_category:ulid}', [PropertyCategoryController::class, 'update']);
            Route::post('delete/{property_category:ulid}', [PropertyCategoryController::class, 'delete']);
        });
    });

    Route::group(['prefix' => 'type', 'as' => '.type'], function () {
        Route::group(['prefix' => 'type', 'as' => '.type'], function () {
            Route::post('save', [TypeController::class, 'store']);
            Route::post('edit/{type:ulid}', [TypeController::class, 'update']);
            Route::post('delete/{type:ulid}', [TypeController::class, 'delete']);
        });
        Route::group(['prefix' => 'property_type', 'as' => '.property_type'], function () {
            Route::post('save', [PropertyTypeController::class, 'store']);
            Route::post('edit/{property_type:ulid}', [PropertyTypeController::class, 'update']);
            Route::post('delete/{property_type:ulid}', [PropertyTypeController::class, 'delete']);
        });
    });

    Route::group(['prefix' => 'floor_plan', 'as' => '.floor_plan'], function () {
        Route::group(['prefix' => 'floor_plan', 'as' => '.floor_plan'], function () {
            Route::post('save', [FloorPlanController::class, 'store']);
            Route::post('edit/{floor_plan:ulid}', [FloorPlanController::class, 'update']);
            Route::post('delete/{floor_plan:ulid}', [FloorPlanController::class, 'delete']);
        });
    });

    Route::group(['prefix' => 'video', 'as' => '.video'], function () {
        Route::group(['prefix' => 'video', 'as' => '.video'], function () {
            Route::post('save', [VideoController::class, 'store']);
            Route::post('edit/{video:ulid}', [VideoController::class, 'update']);
            Route::post('delete/{video:ulid}', [VideoController::class, 'delete']);
        });
    });

    Route::group(['prefix' => 'agent', 'as' => '.agent'], function () {
        Route::group(['prefix' => 'agent', 'as' => '.agent'], function () {
            Route::post('save', [AgentController::class, 'store']);
            Route::post('edit/{agent:ulid}', [AgentController::class, 'update']);
            Route::post('delete/{agent:ulid}', [AgentController::class, 'delete']);
        });
    });

    Route::group(['prefix' => 'testimonial', 'as' => '.testimonial'], function () {
        Route::group(['prefix' => 'testimonial', 'as' => '.testimonial'], function () {
            Route::post('save', [TestimonialController::class, 'store']);
            Route::post('edit/{testimonial:ulid}', [TestimonialController::class, 'update']);
            Route::post('delete/{testimonial:ulid}', [TestimonialController::class, 'delete']);
        });
    });

    Route::group(['prefix' => 'property', 'as' => '.property'], function () {
        Route::group(['prefix' => 'property', 'as' => '.property'], function () {
            Route::post('save', [PropertyController::class, 'store']);
            Route::post('edit/{property:ulid}', [PropertyController::class, 'update']);
            Route::post('delete/{property:ulid}', [PropertyController::class, 'delete']);
        });
    });

    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
});
