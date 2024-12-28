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
        Schema::table('cars', function (Blueprint $table) {
            $table->unsignedBigInteger('gasoline_id')->nullable()->after('logo_id');
            $table->foreign('gasoline_id')->references('id')->on('gasolines')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropForeign(['gasoline_id']);
            $table->dropColumn('gasoline_id');
        });
    }
};
