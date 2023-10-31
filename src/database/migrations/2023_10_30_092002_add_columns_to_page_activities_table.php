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
            $table->string('session_id',32)->after('visited_page_id');
            $table->enum('action',['buy now','opened','closed','favorite','unfavorite'])->after('session_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection(config('analysis.analysis'))->table('page_activities', function (Blueprint $table) {
            $table->dropColumns(['session_id','action']);
        });
    }
};
