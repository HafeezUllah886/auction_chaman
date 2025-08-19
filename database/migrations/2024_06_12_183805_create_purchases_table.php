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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string("c_no");
            $table->string("bl_no");
            $table->decimal("bl_amount", 15,2);
            $table->decimal("container_amount", 15,2);
            $table->decimal("net_amount", 15,2);
            $table->date("date");
            $table->text('notes')->nullable();
            $table->bigInteger('refID');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
