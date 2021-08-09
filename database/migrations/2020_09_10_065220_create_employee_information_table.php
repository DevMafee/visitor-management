<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_information', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('emp_id')->nullable();
            $table->string('department')->nullable();
            $table->string('designation')->nullable();
            $table->string('contact')->nullable();
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
        Schema::table('employee_information', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('employee_information');
    }
}
