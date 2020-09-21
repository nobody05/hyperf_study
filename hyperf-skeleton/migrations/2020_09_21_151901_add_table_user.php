<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class AddTableUser extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("user", function (Blueprint $table) {
            $table->increments("id")->comment("主键")->autoIncrement();
            $table->unsignedTinyInteger("gender")->nullable(false)->default(1)->comment("1-男 2-女");
            $table->char("mobile", 20)->nullable()->default(0)->comment("手机号");
            $table->string("nickname", 255)->nullable(false)->default("")->comment("昵称");
            $table->string("email", 80)->nullable(false)->default("")->comment("邮箱");
            $table->string("province", 255)->nullable(false)->default("")->comment("省份");
            $table->string("city", 255)->nullable(false)->default("")->comment("城市");
            $table->timestamp("created_at")->comment("创建时间");
            $table->timestamp("updated_at")->comment("更新时间");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('', function (Blueprint $table) {
            //
        });
    }
}
