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
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->string("model");
            $table->unsignedBigInteger("model_id")->index();
            $table->enum("currency", ["USD", "GBP", "EUR", "JOD", "JPY"]);
            $table->float("value")->default(0.00);
            $table->timestamps();

            $table->unique(["currency" , "model" , "model_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prices');
    }
};
