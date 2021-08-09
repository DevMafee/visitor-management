<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitor_information', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employee_information')->onDelete('cascade');
            $table->string('address')->nullable();
            $table->string('purpose')->nullable();
            $table->string('contact')->nullable();
            $table->string('card_no')->nullable();
            $table->date('in_date')->nullable();
            $table->time('in_time')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->date('out_date')->nullable();
            $table->time('out_time')->nullable();
            $table->enum('visit_status',['In', 'Out'])->default('In');
            $table->enum('status',['Active', 'Inactive'])->default('Active');
            $table->softDeletes();
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
        Schema::table('visitor_information', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('visitor_information');
    }
}
