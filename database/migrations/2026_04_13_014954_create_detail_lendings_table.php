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
        Schema::create('detail_lendings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lending_id')->constrained()->cascadeOnDelete();;
            $table->foreignId('item_id')->constrained()->cascadeOnDelete();;
            $table->string('qty');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_lendings');
    }
};
