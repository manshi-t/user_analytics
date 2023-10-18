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
        Schema::connection(config('analysis.analysis'))->create('sessions', function (Blueprint $table) {
            $table->id();
            $table->string('session_id',32);
            $table->string('ip_address',20);
            $table->string('device_name',50);
            $table->string('brand',50)->nullable(true);
            $table->string('model',50)->nullable(true);	
            $table->string('os',20);
            $table->string('browser',20);	
            $table->string('country',20)->nullable(true);
            $table->string('state',20)->nullable(true);
            $table->string('city',20)->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection(config('analysis.analysis'))->dropIfExists('sessions');
    }
};
