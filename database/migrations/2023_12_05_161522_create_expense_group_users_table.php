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
        Schema::create('expense_group_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('expensegroup_id');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('expensegroup_id')
                ->references('id')->on('expense_groups')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expense_group_users');
    }
};
