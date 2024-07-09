<?php

use App\Models\{Link, User};
use Livewire\Volt\Volt;

beforeEach(function () {
    $this->actingAs(User::factory()->create());
});

test('create url screen can be rendered', function () {
    $this->get('/url')
        ->assertOk()
        ->assertSeeVolt('pages.url.create');
});

it('should create a new url', function () {
    $component = Volt::test('pages.url.create')
        ->set('url', 'https://example.com')
        ->call('saveLink')
        ->assertHasNoErrors()
        ->assertSessionHas('message', 'URL created successfully');

    $this->assertDatabaseHas(Link::class, [
        'long_url' => 'https://example.com',
    ]);

    $shortUrl = Link::where('long_url', 'https://example.com')->first()->short_url;
    $component->assertRedirect(route('url.view', $shortUrl));
});

test('url should be a valid url', function () {
    Volt::test('pages.url.create')
        ->set('url', 'not-a-url')
        ->call('saveLink')
        ->assertHasErrors(['url' => 'url'])
        ->assertNoRedirect();
});

test('url should be required', function () {
    Volt::test('pages.url.create')
        ->set('url', '')
        ->call('saveLink')
        ->assertHasErrors(['url' => 'required'])
        ->assertNoRedirect();
});

test('url should be max 255 characters', function () {
    Volt::test('pages.url.create')
        ->set('url', str_repeat('a', 256))
        ->call('saveLink')
        ->assertHasErrors(['url' => 'max:255'])
        ->assertNoRedirect();
});
