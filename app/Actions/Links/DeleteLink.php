<?php

namespace App\Actions\Links;

use App\Models\Link;

class DeleteLink
{
    public function handle(Link $link): void
    {
        $link->delete();
    }
}
