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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('civilite_id')->nullable()->constrained();
            $table->foreignId('parcours_id')->nullable()->constrained();
            $table->foreignId('diplome_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['civilite_id']);
            $table->dropForeign(['parcours_id']);
            $table->dropForeign(['diplome_id']);
            $table->dropColumn('civilite_id');
            $table->dropColumn('parcours_id');
            $table->dropColumn('diplome_id');
        });
    }
};
