<?php

use App\Models\{Link, User, Visit};
use Livewire\Volt\Volt;

use function Pest\Laravel\actingAs;

beforeEach(function () {
    $this->actingAs(User::factory()->create());
    $this->link = Link::factory([
        'user_id' => auth()->user()->id,
    ])->create();
});

test('view url screen can be rendered', function () {
    $this->get('/url/' . $this->link->short_url)
        ->assertOk()
        ->assertSeeVolt('pages.url.view');
});

it('should list all visits', function () {
    $this->link->visits()->saveMany(Visit::factory()->count(10)->create());

    Volt::test('pages.url.view', ['link' => $this->link])
        ->assertSee($this->link->visits->first()->ip_address)
        ->assertSee($this->link->visits->last()->ip_address);
});

it('should paginate visits', function () {
    $this->link->visits()->saveMany(Visit::factory()->count(25)->create());

    Volt::test('pages.url.view', ['link' => $this->link])
        ->assertSee($this->link->visits->first()->ip_address)
        ->call('gotoPage', 2)
        ->assertSee($this->link->visits->last()->ip_address);
});

it('should be possible to see url only if user is the owner', function () {
    $nonOwnerUser = User::factory()->create();
    actingAs($nonOwnerUser);

    Volt::test('pages.url.view', ['link' => $this->link])
        ->assertForbidden();
});
