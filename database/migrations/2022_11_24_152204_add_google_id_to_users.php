<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGoogleIdToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'google_id')) {
            Schema::table('users', function ($table) {
                $table->string('google_id')->nullable()->after('password');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('users', 'google_id')) {
            Schema::table('users', function ($table) {
                $table->dropColumn('google_id');
            });
        }
    }
}
