<?php

use Flarum\Install\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 100)->unique();
            $table->string('email', 150)->unique();
            $table->boolean('is_activated')->default(0);
            $table->string('password', 100);
            $table->text('bio')->nullable();
            $table->string('avatar_path', 100)->nullable();
            $table->binary('preferences')->nullable();
            $table->dateTime('join_time')->nullable();
            $table->dateTime('last_seen_time')->nullable();
            $table->dateTime('read_time')->nullable();
            $table->dateTime('notification_read_time')->nullable();
            $table->integer('discussions_count')->unsigned()->default(0);
            $table->integer('comments_count')->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->drop('users');
    }
}
