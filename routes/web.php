<?php declare(strict_types=1);

use App\Livewire\Home;
use Illuminate\Support\Facades\Route;

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        // your actual routes
        Route::get('/', Home::class)->name('home');
        
   
    });
}



