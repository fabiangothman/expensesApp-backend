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
        Schema::create('expense_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->unsignedBigInteger('expensegroup_id')->nullable()->default(null);
            $table->string('description', 255)->nullable()->default(null);
            $table->unsignedBigInteger('parentcategory_id')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('expensegroup_id')
                ->references('id')->on('expense_groups')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('parentcategory_id')
                ->references('id')->on('expense_categories')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expense_categories');
    }
};
