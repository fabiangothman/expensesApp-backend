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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->timestamp('date');
            $table->enum('transaction_type', ['IN', 'OUT', 'NONE'])->default('NONE');
            $table->unsignedBigInteger('value');
            $table->tinyInteger('processed')->default(false);
            $table->unsignedBigInteger('expensegroup_id');
            $table->unsignedBigInteger('expensecategory_id');
            $table->string('description', 255)->nullable()->default(null);
            $table->timestamps();

            $table->foreign('expensegroup_id')
                ->references('id')->on('expense_groups')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('expensecategory_id')
                ->references('id')->on('expense_categories')
                ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
