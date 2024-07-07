<?php

namespace App\Actions\Visits;

use App\Models\{Link, Visit};
use Jenssegers\Agent\Facades\Agent;

class CreateVisit
{
    /**
     * @param array{ipAddress: string, userAgent: string} $data
     */
    public function handle(Link $link, array $data): Visit
    {
        return $link->visits()->create([
            'ip_address'  => $data['ipAddress'],
            'agent'       => $data['userAgent'],
            'browser'     => Agent::browser(),
            'platform'    => Agent::platform(),
            'device'      => Agent::device(),
            'device_type' => Agent::deviceType(),
            'created_at'  => now(),
        ]);
    }
}
