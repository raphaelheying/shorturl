<?php

use App\Actions\Visits\CreateVisit;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('dashboard', [
            'links' => auth()->user()->links()->with('visits')->paginate(20),
        ]);
    })->name('dashboard');

    Route::view('profile', 'profile')->name('profile');

    Volt::route('url', 'pages.url.create')
        ->name('url.create');

    Volt::route('url/{link:short_url}', 'pages.url.view')
        ->name('url.view');

    Route::get('{link:short_url}', function (Link $link, Request $request, CreateVisit $action) {
        $action->handle($link, [
            'ipAddress' => $request->ip(),
            'userAgent' => $request->userAgent(),
        ]);

        return redirect($link->long_url);
    })->name('url');
});
