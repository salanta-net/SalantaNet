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
        Schema::create('shopify_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('collection_id');
            $table->string('brand');
            $table->string('model');
            $table->string('version')->nullable();
            $table->mediumInteger('year_from')->nullable();
            $table->mediumInteger('year_to')->nullable();
            $table->longText('document_link');
            $table->string('document_type');
            $table->longText('images');
            $table->longText('htmlbody');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopify_products');
    }
};
