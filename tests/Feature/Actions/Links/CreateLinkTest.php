<?php

use App\Actions\Links\CreateLink;
use App\Models\{Link, User};
use Illuminate\Support\Str;

use function Pest\Laravel\{actingAs, assertDatabaseHas};

beforeEach(function () {
    actingAs(User::factory()->create());
    $this->action = new CreateLink();
});

it('should creates a link', function () {
    $longUrl  = fake()->url;
    $shortUrl = $this->action->handle($longUrl);

    expect($shortUrl)->toHaveLength(7);

    assertDatabaseHas(Link::class, [
        'short_url' => $shortUrl,
        'long_url'  => $longUrl,
        'user_id'   => auth()->user()->id,
    ]);
});

it('ensures short_url is unique', function () {
    Str::createRandomStringsUsing(function () {
        return '1234567';
    });

    $longUrl  = fake()->url;
    $shortUrl = $this->action->handle($longUrl);

    expect($shortUrl)->toHaveLength(7);

    assertDatabaseHas(Link::class, [
        'short_url' => $shortUrl,
        'long_url'  => $longUrl,
        'user_id'   => auth()->user()->id,
    ]);

    expect(function () {
        $this->action->handle(fake()->url);
    })->toThrow(Exception::class, 'Failed to generate a unique short_url');

    Str::createRandomStringsNormally();
});
