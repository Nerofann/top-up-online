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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained('vendors', 'id');
            $table->foreignId('provider_id')->constrained('providers', 'id');
            $table->string('type');
            $table->string('name');
            $table->text('description')->nullable();
            $table->double('price_vendor');
            $table->double('price_real');
            $table->double('price_discount');
            $table->string('code')->unique();
            $table->text('extra')->nullable();
            $table->text('instructions')->nullable();
            $table->enum('status', ['tersedia', 'gangguan']);
            $table->string('published')->constrained('users', 'uuid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
