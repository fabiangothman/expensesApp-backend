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
            $table->enum('frequency_type', ['DAILY', 'MONTHLY', 'YEARLY'])->default('MONTHLY');
            $table->integer('frequency')->default(1);
            $table->timestamp('start_date')->default(now());
            $table->timestamp('end_date')->nullable()->default(null);
            $table->unsignedBigInteger('expense_id')->unsigned();
            $table->boolean('active')->default(true);
            $table->string('description', 255)->nullable()->default(null);
            $table->timestamps();

            $table->foreign('expense_id')
                ->references('id')->on('expenses')
                ->onUpdate('cascade')->onDelete('cascade');
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
