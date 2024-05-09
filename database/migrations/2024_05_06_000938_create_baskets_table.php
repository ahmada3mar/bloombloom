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
        Schema::create('baskets', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("lens_id");
            $table->foreign('lens_id')->on('lenses')->references("id");

            $table->unsignedBigInteger("frame_id");
            $table->foreign('frame_id')->on('frames')->references("id");

            $table->unsignedBigInteger("user_id");
            $table->foreign('user_id')->on('users')->references("id");

            $table->enum("currency", ["USD", "GBP", "EUR", "JOD", "JPY"]);
            $table->float("total")->default(0.00);

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
        Schema::dropIfExists('baskets');
    }
};
