<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceivepaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('receivepayments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userid')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('siteid')->nullable()->constrained('sites')->onDelete('set null');
            $table->text('purpose');
            $table->decimal('amount', 10, 2);
            $table->date('date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('receivepayments');
    }
}