<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDashboardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dashboards', function (Blueprint $table) {
            $table->id();
            $table->string('id_generator');
            $table->string('collection_name');
            $table->integer('NFT_quantity');
            $table->string('status');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                  ->references('id')->on('nft_users')
                  ->onDelete('cascade');  
            $table->integer('voucher_id')->unsigned();
            $table->foreign('voucher_id')
                  ->references('id')->on('nft_vouchers')
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
        Schema::dropIfExists('dashboards');
    }
}
