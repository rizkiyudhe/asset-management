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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('asset_code')->unique(); // Auto: AST-000001
            $table->foreignId('category_id')->constrained()->restrictOnDelete();
            $table->foreignId('location_id')->constrained()->restrictOnDelete();

            $table->string('name');
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('serial_number')->unique()->nullable();

            $table->date('purchase_date');
            $table->decimal('purchase_price', 15, 2);

            $table->enum('condition', ['excellent', 'good', 'fair', 'poor']);
            $table->enum('status', ['active', 'maintenance', 'damaged', 'lost', 'disposed'])->default('active');

            $table->text('description')->nullable();
            $table->string('image')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
