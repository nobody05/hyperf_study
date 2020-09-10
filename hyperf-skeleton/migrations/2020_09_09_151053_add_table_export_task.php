<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class AddTableExportTask extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("export_task", function (Blueprint $table) {
            $table->increments("id")->comment("主键")->autoIncrement();
            $table->unsignedInteger("created_user_id")->nullable(false)->comment("创建人ID");
            $table->unsignedTinyInteger("type")->nullable(false)->default(1)->comment("类型 1-用户列表");
            $table->unsignedInteger("status")->nullable(false)->default(1)->comment("状态 1-待处理 2-处理中 5-处理成功 10-处理失败");
            $table->json("export_filters")->nullable(true)->comment("导出的查询条件");
            $table->string("export_file_path", 255)->nullable(false)->default("")->comment("导出文件路径");
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
