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
            $table->string('website',50)->after('page_url');
            $table->enum('status',['running','failed'])->after('website');
            $table->dropColumn('session_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection(config('analysis.analysis'))->table('visited_pages', function (Blueprint $table) {
            $table->dropColumns(['website','status']);
            $table->string('session_id',32);
        });
    }
};
