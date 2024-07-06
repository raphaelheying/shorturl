<?php

namespace App\Livewire\Actions;

use Illuminate\Support\Facades\{Auth, Session};

class Logout
{
    public function __invoke(): void
    {
        Auth::guard('web')->logout();

        Session::invalidate();
        Session::regenerateToken();
    }
}
