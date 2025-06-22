<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodosTable extends Migration
{
    /**
     * マイグレーションの実行時に呼び出される処理
     *「todos」テーブルを新しく作成する
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->id();//ID（自動で増える主キー）作成
            $table->string('content', 20);//Todoの内容を最大20文字の文字列で作成
            $table->timestamps();//created_at・updated_at の日時カラムを自動で作成
        });
    }

    /**
     * マイグレーションを取り消す
     * 「todos」テーブルを削除する
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('todos');
    }
}
