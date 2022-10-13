<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 165);
            $table->string('phone', 12);
            $table->string('dpi', 55);
            $table->string('address');
            $table->decimal('salary', 10, 2);
            $table->integer('age');
            $table->enum('gender', ['Male', 'Female'])->default('Male');
            $table->string('avatar')->nullable();
            $table->string('referencia', 100);
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
        Schema::dropIfExists('customers');
    }
};
