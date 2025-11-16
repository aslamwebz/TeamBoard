<?php declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Livewire\Home;


foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        // your actual routes
        Route::get('/', Home::class)->name('home');
    });
}



