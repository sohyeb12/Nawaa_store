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
            $table->id(); // id 
            $table->string('name',255);
            $table->string('slug')->unique();
            $table->foreignId('category_id')
                  ->nullable()
                  ->constrained('categories','id')
                  ->nullOnDelete(); // nullOnDelete mean if category deletd, prouct category will null 
                                    // cascadeOnDelete mean if category deletd, prouct category will delt
            $table->text('description')->nullable(); // LongText
            $table->string('short_description')->nullable();
            $table->float('price')->default(0);
            $table->float('compare_price')->nullable();
            $table->string('image',255)->nullable();
            $table->enum('status',['draft ','active ','archived']);

            // $table->unsignedBigInteger('category_id');
            // $table->foreign('category_id')->references('id')->on('categories');
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
