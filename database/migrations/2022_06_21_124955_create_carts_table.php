<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('uuid');
            $table->string('user_name');
            $table->string('product_id');
            $table->string('product_name');
            $table->string('product_price');
            $table->string('quantity')->dafault(0);
            $table->double('total');
            $table->string('product_image');
            $table->string('product_image_url');
            $table->datetime('updated_at')->format('WAT');
            $table->datetime('created_at')->format('WAT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
