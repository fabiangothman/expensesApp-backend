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
        Schema::create('scheduled_expenses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->enum('transaction_type', ['IN', 'OUT', 'NONE'])->default('NONE');
            $table->unsignedBigInteger('value');
            $table->enum('frequency_type', ['DAILY', 'MONTHLY', 'YEARLY'])->default('MONTHLY');
            $table->integer('frequency');
            $table->timestamp('start_date')->default(now());
            $table->timestamp('end_date')->nullable()->default(null);
            $table->unsignedBigInteger('expensegroup_id');
            $table->string('description')->nullable();
            $table->boolean('active')->default(1);
            $table->timestamps();

            $table->foreign('expensegroup_id')
                ->references('id')->on('expense_groups')
                ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scheduled_expenses');
    }
};
