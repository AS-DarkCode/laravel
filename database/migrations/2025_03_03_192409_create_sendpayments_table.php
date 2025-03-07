<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSendpaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('sendpayments', function (Blueprint $table) {
            $table->id();
            $table->text('breif');
            $table->enum('paymenttype', ['cash', 'online']);
            $table->date('transationdate');
            $table->decimal('amount', 10, 2);
            $table->foreignId('userid')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sendpayments');
    }
}
