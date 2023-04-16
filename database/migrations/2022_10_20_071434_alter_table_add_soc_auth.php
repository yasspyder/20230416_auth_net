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
        Schema::table('users', function (Blueprint $table) {
            $table->string('id_in_soc', 20)
                ->default('')
                ->comment('id в социальной сети');
            $table->enum('type_auth', ['site', 'vk', 'github'])
                ->default('site')
                ->comment('указывает тип авторизации пользователя');
            $table->string('avatar', 150)
                ->default('')
                ->comment('ссылка на аватар пользователя');
            $table->index('id_in_soc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['id_in_soc', 'type_auth', 'avatar']);
        });
    }
};
