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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->unique()->min(3);
            $table->string('nit', 20)->unique();
            $table->string('email', 80)->unique()->min(5);
            $table->string('phone', 25)->unique()->min(5);
            $table->string('fax', 35)->nullable();
            $table->string('website', 255)->nullable();
            $table->foreignId('country_id')->constrained();
            $table->foreignId('department_id')->constrained();
            $table->foreignId('city_id')->constrained();
            $table->string('address', 255)->min(5);
            $table->enum('economic_activity', ['trade', 'industry', 'transport', 'other_services'])->default('other_services');
            $table->boolean('status')->default(true);
            $table->softDeletes();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
