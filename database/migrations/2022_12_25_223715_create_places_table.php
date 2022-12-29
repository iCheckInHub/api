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
    Schema::create('places', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('name');
      $table->string('address')->nullable();
      $table->string('image')->nullable();
      $table->string('cover')->nullable();
      $table->string('description')->nullable();
      $table->string('phone')->nullable();
      $table->json('hours')->nullable();
      $table->foreignUuid('user_id');
      $table->timestamps();
      $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
    });
    Schema::create('menus', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('name');
      $table->string('description')->nullable();
      $table->string('image')->nullable();
      $table->foreignUuid('place_id');
      $table->foreignUuid('parent_id')->nullable();
      $table->timestamps();
    });
    Schema::table('menus', function (Blueprint $table) {
      $table->foreign('place_id')->references('id')->on('places')->onDelete('restrict');
      $table->foreign('parent_id')->references('id')->on('menus')->onDelete('restrict');
    });
    Schema::create('menu_services', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('name');
      $table->string('description')->nullable();
      $table->string('image')->nullable();
      $table->decimal('price', 8, 2);
      $table->integer('duration')->nullable();
      $table->boolean('top')->default(false);
      $table->foreignUuid('menu_id')->nullable();
      $table->timestamps();
      $table->foreign('menu_id')->references('id')->on('menus')->onDelete('restrict');
      $table->foreignUuid('place_id');
      $table->foreign('place_id')->references('id')->on('places')->onDelete('restrict');
    });

    Schema::create('menu_service_extras', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('name');
      $table->string('description')->nullable();
      $table->boolean('multiple')->default(false);
      $table->string('image')->nullable();
      $table->foreignUuid('service_id')->nullable();
      $table->timestamps();

      $table->foreign('service_id')->references('id')->on('menu_services')->onDelete('restrict');
      $table->foreignUuid('place_id');
      $table->foreign('place_id')->references('id')->on('places')->onDelete('restrict');
    });

    Schema::create('menu_service_extra_options', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('name');
      $table->string('description')->nullable();
      $table->string('image')->nullable();
      $table->decimal('price', 8, 2);
      $table->integer('duration')->nullable();
      $table->boolean('default')->default(false);
      $table->foreignUuid('extra_id')->nullable();
      $table->timestamps();

      $table->foreign('extra_id')->references('id')->on('menu_service_extras')->onDelete('restrict');
      $table->foreignUuid('place_id');
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
    Schema::dropIfExists('menu_service_extra_options');
    Schema::dropIfExists('menu_service_extras');
    Schema::dropIfExists('menu_services');
    Schema::dropIfExists('menus');
    Schema::dropIfExists('places');
  }
};
