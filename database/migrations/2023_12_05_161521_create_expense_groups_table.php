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
        Schema::create('expense_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('group_key', 40)->unique();
            $table->unsignedBigInteger('moneybox_id');
            $table->string('description', 255)->nullable()->default(null);
            $table->timestamps();
            
            $table->foreign('moneybox_id')
                ->references('id')->on('money_boxes')
                ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expense_groups');
    }
};
