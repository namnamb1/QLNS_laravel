<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->bigIncrements('id_rq');
            $table->unsignedBigInteger('member_id');
            $table->foreign('member_id')->references('id')->on('members');
            $table->string('rq_full_name')->nullable();
            $table->string('rq_avatar')->nullable();
            $table->string('rq_address')->nullable();
            $table->date('rq_brith_date')->nullable();
            $table->integer('rq_gender')->nullable();
            $table->string('rq_tinh')->nullable();
            $table->string('rq_huyen')->nullable();
            $table->tinyInteger('rq_status')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
