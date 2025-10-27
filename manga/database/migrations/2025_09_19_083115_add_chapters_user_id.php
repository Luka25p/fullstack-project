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
        Schema::table('chapters', function (Blueprint $table) {
            if (!Schema::hasColumn('chapters', 'user_id')) {
                $table->unsignedBigInteger('user_id')->after('id');

                $table->foreign('user_id', 'chapters_user_id_foreign')
                      ->references('id')->on('users')
                      ->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chapters', function (Blueprint $table) {
            $table->dropForeign('chapters_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
};
