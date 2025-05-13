<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Special test route that includes version info for diagnostics
Route::get('/test', function () {
    return Inertia::render('Test', [
        'phpVersion' => PHP_VERSION,
        'laravelVersion' => app()->version()
    ]);
});

// Special endpoint that bypasses Inertia and returns JSON directly
Route::get('/direct-dashboard', function () {
    return response()->json([
        'component' => 'Dashboard',
        'props' => [
            'stats' => [
                'smsSent' => 1250,
                'recipients' => 150,
                'failedDeliveries' => 12,
                'smsCredit' => 3500
            ] 
        ],
        'url' => '/direct-dashboard'
    ]);
});

// Default route - we'll visit this after confirming Test works
Route::get('/', function () {
    return Inertia::render('Dashboard', [
        'stats' => [
            'smsSent' => 1250,
            'recipients' => 150,
            'failedDeliveries' => 12,
            'smsCredit' => 3500
        ]
    ]);
})->name('dashboard');

// Authentication Routes (assuming you have auth controller)
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return Inertia::render('Auth/Login');
    })->name('login');
    
    Route::post('/login', function () {
        // Login logic would go here
        return redirect()->route('dashboard');
    });
});

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    
    // SMS Management Routes
    Route::prefix('sms')->name('sms.')->group(function () {
        // Send SMS Page
        Route::get('/send', function () {
            return Inertia::render('SMS/Send');
        })->name('send');
        
        // SMS Templates
        Route::get('/templates', function () {
            return Inertia::render('SMS/Templates');
        })->name('templates');
        
        // SMS Logs
        Route::get('/logs', function () {
            return Inertia::render('SMS/Logs');
        })->name('logs');
    });
    
    // Recipients Management
    Route::get('/recipients', function () {
        return Inertia::render('Recipients/Index');
    })->name('recipients');
    
    // Settings
    Route::get('/settings', function () {
        return Inertia::render('Settings');
    })->name('settings');
    
    // Logout
    Route::post('/logout', function () {
        // Logout logic would go here
        return redirect()->route('login');
    })->name('logout');
});
