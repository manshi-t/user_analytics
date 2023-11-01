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
        Schema::connection(config('analysis.analysis'))->table('page_activities', function (Blueprint $table) {
            $table->string('action',50)->change(); //Ex:-'buy now','opened','closed','favorite','unfavorite','other'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection(config('analysis.analysis'))->table('page_activities', function (Blueprint $table) {
            $table->enum('action',['buy now','opened','closed','favorite','unfavorite'])->after('session_id')->change();
        });
    }
};
