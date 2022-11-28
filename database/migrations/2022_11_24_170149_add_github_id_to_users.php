<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGithubIdToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'github_id')) {
            Schema::table('users', function ($table) {
                $table->string('github_id')->nullable()->after('google_id');
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
        if (Schema::hasColumn('users', 'github_id')) {
            Schema::table('users', function ($table) {
                $table->dropColumn('github_id');
            });
        }
    }
}
