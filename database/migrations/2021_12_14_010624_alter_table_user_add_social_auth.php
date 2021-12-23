<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUserAddSocialAuth extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('social_id', 30)
                ->default('')
                ->nullable()
                ->comment('Unique identifier in social network');
            $table->enum('social_type', ['site', 'vkontakte', 'github'])
                ->default('site')
                ->nullable()
                ->comment('Which social network was authenticated');
            $table->string('avatar', 250)
                ->default('/assets/image/avatar.png')
                ->nullable();
            $table->index('social_id');
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
            $table->dropColumn(['socialID', 'social_type', 'avatar']);
        });
    }
}
