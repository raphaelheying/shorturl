<?php

use App\Models\Link;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Link::class);
            $table->ipAddress('ip_address');
            $table->string('browser');
            $table->string('platform');
            $table->string('device');
            $table->string('device_type');
            $table->string('agent');
            $table->timestamp('created_at', 0)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
