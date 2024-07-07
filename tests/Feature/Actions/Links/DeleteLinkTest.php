<?php

use App\Actions\Links\DeleteLink;
use App\Models\{Link, User};

use function Pest\Laravel\{actingAs, assertSoftDeleted};

beforeEach(function () {
    actingAs(User::factory()->create());
    $this->action = new DeleteLink();
});

it('can delete a link', function () {
    $link = Link::factory()->create();
    $this->action->handle($link);

    assertSoftDeleted($link);
});
