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
        Schema::create('features', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('feature_group_title')->nullable();
            $table->text('feature_group_desc')->nullable();
            $table->string('feature_group_img')->nullable();
            $table->string('feature_company_title')->nullable();
            $table->text('feature_company_desc')->nullable();
            $table->string('feature_company_img')->nullable();
            $table->string('feature_shareholder_title')->nullable();
            $table->text('feature_shareholder_desc')->nullable();
            $table->string('feature_shareholder_img')->nullable();
            $table->string('feature_sra_title')->nullable();
            $table->text('feature_sra_desc')->nullable();
            $table->string('feature_sra_img')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('features');
    }
};