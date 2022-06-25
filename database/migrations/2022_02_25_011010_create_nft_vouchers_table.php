<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNftVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nft_vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('code');
            $table->integer('membership_id')->unsigned();
            $table->foreign('membership_id')
                  ->references('id')->on('memberships')
                  ->onDelete('cascade'); 
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
        Schema::dropIfExists('nft_vouchers');
    }
}
