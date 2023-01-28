<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmartAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smart_ads', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug');
            $table->text('body')->nullable();
            $table->string('adType');
            $table->string('image')->nullable();
            $table->string('imageUrl')->nullable();
            $table->string('imageAlt')->nullable();
            $table->integer('views')->default(0);
            $table->integer('clicks')->default(0);
            $table->boolean('enabled')->default(1);
            $table->json('placements')->nullable();
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
        Schema::dropIfExists('smart_ads');
    }
}