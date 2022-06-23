<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->increments('id'); // ID
            $table->string('staff_code',4)->unique('staffs_staff_code_unique_idx'); // 社員コード
            $table->string('last_name',100); // 姓
            $table->string('first_name',100); // 名
            $table->string('last_name_romaji',200); // 姓ローマ字
            $table->string('first_name_romaji',200); // 名ローマ字
            $table->string('staff_department',4); // 所属
            $table->boolean('new_glad_flg'); // 新卒中途
            $table->string('joined_year',10); // 入社年月日
            $table->text('project_type',255)->nullable(); // 案件
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
        Schema::dropIfExists('staffs');
    }
};
