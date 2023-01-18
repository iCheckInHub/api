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
    Schema::create('pos_devices', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('name');
      $table->string('device_id')->unique();  // unique ID for the device
      $table->foreignUuid('place_id');  // foreign key to the places table
      $table->timestamps();
      $table->foreign('place_id')->references('id')->on('places')->onDelete('restrict');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('pos_devices');
  }
};
