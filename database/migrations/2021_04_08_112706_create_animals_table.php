<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('dob');
            $table->enum('type', ['Dog', 'Cat', 'Rabbit', 'Hamster'])->default(NULL);
            $table->string('description')->nullable();
            $table->enum('availability', ['Available', 'Unavailable'])->default('Available');
            $table->string('image', 256)->nullable();
            $table->string('image2', 256)->nullable();
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
        Schema::dropIfExists('animals');
    }
}
