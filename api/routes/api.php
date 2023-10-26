<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\AmenityController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FloorPlanController;
use App\Http\Controllers\PropertyCategoryController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyTypeController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\VideoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'post', 'middleware' => ['auth:sanctum', 'throttle:50,1'], 'as' => 'api.post'], function () {
    Route::group(['prefix' => 'dashboard', 'as' => '.db'], function () {
        //region Extensions
        Route::group(['prefix' => 'amenity', 'as' => '.amenity'], function () {
            Route::group(['prefix' => 'amenity', 'as' => '.amenity'], function () {
                Route::post('save', [AmenityController::class, 'store'])->name('.save');
                Route::post('edit/{amenity:ulid}', [AmenityController::class, 'update'])->name('.edit');
                Route::post('delete/{amenity:ulid}', [AmenityController::class, 'delete'])->name('.delete');
            });
            Route::group(['prefix' => 'property_amenity', 'as' => '.property_amenity'], function () {
                Route::post('save', [PropertyAmenity::class, 'store'])->name('.save');
                Route::post('edit/{property_amenity:ulid}', [PropertyAmenity::class, 'update'])->name('.edit');
                Route::post('delete/{property_amenity:ulid}', [PropertyAmenity::class, 'delete'])->name('.delete');
            });
        });

        Route::group(['prefix' => 'category', 'as' => '.category'], function () {
            Route::group(['prefix' => 'category', 'as' => '.category'], function () {
                Route::post('save', [CategoryController::class, 'store'])->name('.save');
                Route::post('edit/{category:ulid}', [CategoryController::class, 'update'])->name('.edit');
                Route::post('delete/{category:ulid}', [CategoryController::class, 'delete'])->name('.delete');
            });
            Route::group(['prefix' => 'property_category', 'as' => '.property_category'], function () {
                Route::post('save', [PropertyCategoryController::class, 'store'])->name('.save');
                Route::post('edit/{property_category:ulid}', [PropertyCategoryController::class, 'update'])->name('.edit');
                Route::post('delete/{property_category:ulid}', [PropertyCategoryController::class, 'delete'])->name('.delete');
            });
        });
        
        Route::group(['prefix' => 'type', 'as' => '.type'], function () {
            Route::group(['prefix' => 'type', 'as' => '.type'], function () {
                Route::post('save', [TypeController::class, 'store'])->name('.save');
                Route::post('edit/{type:ulid}', [TypeController::class, 'update'])->name('.edit');
                Route::post('delete/{type:ulid}', [TypeController::class, 'delete'])->name('.delete');
            });
            Route::group(['prefix' => 'property_type', 'as' => '.property_type'], function () {
                Route::post('save', [PropertyTypeController::class, 'store'])->name('.save');
                Route::post('edit/{property_type:ulid}', [PropertyTypeController::class, 'update'])->name('.edit');
                Route::post('delete/{property_type:ulid}', [PropertyTypeController::class, 'delete'])->name('.delete');
            });
        });
        
        Route::group(['prefix' => 'floor_plan', 'as' => '.floor_plan'], function () {
            Route::group(['prefix' => 'floor_plan', 'as' => '.floor_plan'], function () {
                Route::post('save', [FloorPlanController::class, 'store'])->name('.save');
                Route::post('edit/{floor_plan:ulid}', [FloorPlanController::class, 'update'])->name('.edit');
                Route::post('delete/{floor_plan:ulid}', [FloorPlanController::class, 'delete'])->name('.delete');
            });
        });

        Route::group(['prefix' => 'video', 'as' => '.video'], function () {
            Route::group(['prefix' => 'video', 'as' => '.video'], function () {
                Route::post('save', [VideoController::class, 'store'])->name('.save');
                Route::post('edit/{video:ulid}', [VideoController::class, 'update'])->name('.edit');
                Route::post('delete/{video:ulid}', [VideoController::class, 'delete'])->name('.delete');
            });
        });
        
        Route::group(['prefix' => 'agent', 'as' => '.agent'], function () {
            Route::group(['prefix' => 'agent', 'as' => '.agent'], function () {
                Route::post('save', [AgentController::class, 'store'])->name('.save');
                Route::post('edit/{agent:ulid}', [AgentController::class, 'update'])->name('.edit');
                Route::post('delete/{agent:ulid}', [AgentController::class, 'delete'])->name('.delete');
            });
        });
        
        Route::group(['prefix' => 'testimonial', 'as' => '.testimonial'], function () {
            Route::group(['prefix' => 'testimonial', 'as' => '.testimonial'], function () {
                Route::post('save', [TestimonialController::class, 'store'])->name('.save');
                Route::post('edit/{testimonial:ulid}', [TestimonialController::class, 'update'])->name('.edit');
                Route::post('delete/{testimonial:ulid}', [TestimonialController::class, 'delete'])->name('.delete');
            });
        });
        
        Route::group(['prefix' => 'property', 'as' => '.property'], function () {
            Route::group(['prefix' => 'property', 'as' => '.property'], function () {
                Route::post('save', [PropertyController::class, 'store'])->name('.save');
                Route::post('edit/{property:ulid}', [PropertyController::class, 'update'])->name('.edit');
                Route::post('delete/{property:ulid}', [PropertyController::class, 'delete'])->name('.delete');
            });
        });
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
});