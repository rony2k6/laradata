<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->nullable()->change();
            $table->after('password', function ($table) {
                $table->timestamp('dob')->index();
                $table->string('phone');
                $table->ipAddress('ip');
                $table->string('country');
            });
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
            $table->string('password')->change();
            $table->dropColumn('dob');
            $table->dropColumn('phone');
            $table->dropColumn('ip');
            $table->dropColumn('country');
        });
    }
}
