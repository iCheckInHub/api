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
    Schema::create('users', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('name');
      $table->string('email')->unique();
      $table->string('avatar')->nullable();
      $table->timestamp('email_verified_at')->nullable();
      $table->string('password');
      $table->rememberToken();
      $table->timestamps();
    });

    Schema::create('user_providers', function (Blueprint $table) {
      $table->string('id');
      $table->string('provider');
      $table->string('name');
      $table->string('email')->nullable();
      $table->string('avatar')->nullable();
      $table->primary(['provider', 'id']);
      $table->timestamps();
      $table->foreignUuid('user_id');
      $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('users');
  }
};
