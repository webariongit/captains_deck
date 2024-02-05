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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('meal_type_id'); # Drinks & Foods
            $table->string('category_id'); # Drinks( Spirits , Wine , ..... ) & Foods( Asian , Continental , ..... )
            $table->string('subcategory_id'); #Drinks( Spirits() , Wine() , ..... ) & Foods( Asian() , Continental() , ..... )
            $table->string('food_type_id'); #Drinks( Spirits() , Wine() , ..... ) & Foods( Asian() , Continental() , ..... )
            $table->string('meal_name');
            $table->string('meal_image');
            $table->string('meal_qty');
            $table->string('meal_amount');
            $table->string('meal_description');
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
