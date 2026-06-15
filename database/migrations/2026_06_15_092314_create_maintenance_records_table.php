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
        Schema::create('maintenance_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained()->cascadeOnDelete();

            $table->string('maintenance_number')->unique(); // Format: MNT-000001
            $table->enum('maintenance_type', ['preventive', 'corrective', 'inspection']);
            $table->date('maintenance_date');
            $table->string('technician');
            $table->decimal('cost', 15, 2)->default(0);

            $table->text('notes')->nullable();
            $table->string('attachment')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_records');
    }
};
