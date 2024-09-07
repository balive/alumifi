<?php

use App\Http\Controllers\SubscriptionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/subscription/stripe_hook', [SubscriptionController::class, 'stripe_hook']);


