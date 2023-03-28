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
        Schema::create('sp500s', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->float('open',6,2);
            $table->float('high',6,2);
            $table->float('low',6,2);
            $table->float('close',6,2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sp500s');
    }
};
