<?php 

use Illuminate\Support\Facades\Schema; 
use Illuminate\Database\Schema\Blueprint; 
use Illuminate\Database\Migrations\Migration; 

class CreateFilesTable extends Migration { 

/** 
* Run the migrations. 
* 
* @return void 
*/ 

public function up() { 

   Schema::create('files', function (Blueprint $table) { 
            $table->increments('id');
            $table->string('id_generator');
            $table->float('rarity');
            $table->string('name')->nullable();
            $table->string('path')->nullable();
            $table->string('trait')->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                  ->references('id')->on('nft_users')
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
        Schema::dropIfExists('files');
    }
}