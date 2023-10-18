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
        Schema::connection(config('analysis.analysis'))->create('visited_pages', function (Blueprint $table) {
            $table->id();
            $table->string('page_url',255);
            $table->string('time_spent',20);
            $table->string('session_id',32);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection(config('analysis.analysis'))->dropIfExists('visited_pages');
    }
};
