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
        Schema::create('sale_parts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sales_id')->constrained('sales','id')->cascadeOnDelete();
            $table->foreignId('customer_id')->constrained('accounts','id')->cascadeOnDelete();
            $table->text('description');
            $table->float('qty');
            $table->decimal('price_pkr',15,2)->default(0);
            $table->decimal('conversion_rate',15,2)->default(0);
            $table->decimal('price_afg',15,2)->default(0);
            $table->date('date')->default(now());
            $table->bigInteger('refID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_parts');
    }
};
