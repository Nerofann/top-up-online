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
        Schema::table('users', function(Blueprint $table) {
            $table->addColumn("text", "gauth_id")->nullable()->after("role"); 
            $table->addColumn("text", "gauth_type")->nullable()->after("gauth_id"); 
            $table->addColumn("integer", "status")->default(0)->nullable()->after("gauth_type");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumns("users", ["gauth_id", "gauth_type"]);
    }
};
