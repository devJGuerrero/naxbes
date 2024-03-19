<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('zip', 25);
            $table->foreignId('country_id')->constrained();
            $table->foreignId('department_id')->constrained();
            $table->foreignId('city_id')->constrained();
        });
        Schema::create('addressables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('address_id')->constrained()->cascadeOnDelete();
            $table->morphs('addressable');
            $table->enum('site', ['home', 'office', 'other'])->default('other');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addressables');
        Schema::dropIfExists('addresses');
    }
};
