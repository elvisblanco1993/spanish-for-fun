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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('service_id');
            $table->string('stripe_payment_id')->index()->nullable();
            $table->string('title');
            $table->text('description');
            $table->longText('content')->nullable();
            $table->longText('solution')->nullable();
            $table->integer('amount_due')->default(0);
            $table->timestamps();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
