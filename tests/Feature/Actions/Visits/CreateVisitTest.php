<?php

use App\Actions\Visits\CreateVisit;
use App\Models\{Link, Visit};

use function Pest\Laravel\{assertDatabaseHas};

beforeEach(function () {
    $this->link   = Link::factory()->create();
    $this->action = new CreateVisit();
});

it('should save the visit', function () {
    $data = [
        'ipAddress' => fake()->ipv4,
        'userAgent' => fake()->userAgent,
    ];

    $visit = $this->action->handle($this->link, $data);

    assertDatabaseHas(Visit::class, [
        'id'         => $visit->id,
        'link_id'    => $this->link->id,
        'ip_address' => $data['ipAddress'],
        'agent'      => $data['userAgent'],
    ]);
});
