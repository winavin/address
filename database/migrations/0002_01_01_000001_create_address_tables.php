<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('address_countries', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('address_states', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(config('address.models.country'))->constrained((new (config('address.models.country')))->getTable());
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('address_addresses', function (Blueprint $table) {
            $table->id();
            $table->morphs('addressable');
            $table->string('type'); // Home | Office | Shop | Warehouse
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('line_1');
            $table->string('line_2')->nullable();
            $table->string('city');
            $table->string('district');
            $table->foreignIdFor(config('address.models.state'))->constraint((new (config('address.models.state')))->getTable());
            $table->foreignIdFor(config('address.models.country'))->constraint((new (config('address.models.country')))->getTable());
            $table->string('postal_code');
            $table->boolean('is_default');
            $table->boolean('is_default_billing');
            $table->boolean('is_default_shipping');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address_countries');
        Schema::dropIfExists('address_states');
        Schema::dropIfExists('address_addresses');
    }
};
