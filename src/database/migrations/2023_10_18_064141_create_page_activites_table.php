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
        Schema::connection(config('analysis.analysis'))->create('page_activities', function (Blueprint $table) {
            $table->id();
            $table->string('clicked_element',255);
            $table->string('timestamp',50);
            $table->integer('visited_page_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection(config('analysis.analysis'))->dropIfExists('page_activities');
    }
};
