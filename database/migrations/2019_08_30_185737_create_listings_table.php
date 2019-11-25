<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('type');
            $table->unsignedBigInteger('guests');
            $table->string('location');
            $table->text('description');
            $table->unsignedBigInteger('bedrooms');
            $table->unsignedBigInteger('beds');
            $table->unsignedBigInteger('bathrooms');
            $table->unsignedBigInteger('price');
            $table->string('check-in-from');
            $table->string('check-in-to');
            $table->string('check-out');

            $table->index('user_id');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listings');
    }
}
