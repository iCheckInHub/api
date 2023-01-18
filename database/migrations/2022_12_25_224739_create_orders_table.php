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
    Schema::create('orders', function (Blueprint $table) {
      $table->uuid('id');
      $table->bigInteger('no', true, true)->unique();
      $table->enum('status', ['pending', 'confirmed', 'canceled', 'completed'])->default('pending');
      $table->foreignUuid('user_id');
      $table->foreignUuid('place_id');
      $table->timestamps();
      $table->decimal('total', 8, 2)->default(0);
      $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
      $table->foreign('place_id')->references('id')->on('places')->onDelete('restrict');
    });

    Schema::table('orders', function (Blueprint $table) {
      $table->dropPrimary('orders_no_primary');
      $table->primary('id');
    });

    Schema::create('order_items', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->foreignUuid('order_id');
      $table->foreignUuid('service_id');
      $table->integer('quantity')->default(1);
      $table->integer('duration')->default(0);
      $table->decimal('price', 8, 2)->default(0);
      $table->json('optionIds')->nullable();
      $table->json('data');
      $table->timestamps();
      $table->foreignUuid('place_id');
      $table->foreign('place_id')->references('id')->on('places')->onDelete('restrict');
      $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
      $table->foreign('service_id')->references('id')->on('menu_services')->onDelete('restrict');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('order_items');
    Schema::dropIfExists('orders');
  }
};
