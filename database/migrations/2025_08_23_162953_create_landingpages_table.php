<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('landingpages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tagline')->nullable();
            $table->string('title_about_agribiz')->nullable();
            $table->text('desc_about_agribiz')->nullable();
            $table->string('image_about_agribiz')->nullable();
            $table->string('key_main_feature_title')->nullable();
            $table->text('key_main_feature_desc')->nullable();
            $table->string('key_feature_group_title')->nullable();
            $table->text('key_feature_group_desc')->nullable();
            $table->string('key_feature_company_title')->nullable();
            $table->text('key_feature_company_desc')->nullable();
            $table->string('key_feature_shareholder_title')->nullable();
            $table->text('key_feature_shareholder_desc')->nullable();
            $table->string('key_feature_sra_title')->nullable();
            $table->text('key_feature_sra_desc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landingpages');
    }
};