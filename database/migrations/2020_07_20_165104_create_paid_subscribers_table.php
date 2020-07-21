<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaidSubscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paid_subscribers', function (Blueprint $table) {
            $table->id();
            
            $table->string('user_email')->nullable();
            $table->float('amount')->nullable();
            $table->integer('sub_time')->nullable();
            $table->string('transaction_number')->nullable();
            $table->string('response_code')->nullable();
            $table->string('gateway_id')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->string('pre_status')->nullable();
            $table->string('pre_response_code')->nullable();
            $table->string('reference')->nullable();
            $table->string('payment_status')->nullable();
            
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
        Schema::dropIfExists('paid_subscribers');
    }
}
