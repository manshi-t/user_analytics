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
        Schema::connection(config('analysis.analysis'))->table('visited_pages', function (Blueprint $table) {
            $table->integer('time_spent')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection(config('analysis.analysis'))->table('visited_pages', function (Blueprint $table) {
            $table->string('time_spent',20)->change();
        });
    }
};
