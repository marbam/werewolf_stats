<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $toCheck = [ 
            'ADMIN_EMAIL' => 'Email for admin',
            'ADMIN_PASSWORD' => 'Password for admin',
            'APPROVED_EMAIL' => 'Email for an approved user',
            'APPROVED_PASSWORD' => 'Password for approved_user',
            'UNAPPROVED_EMAIL' => 'Email for an unapproved user',
            'UNAPPROVED_PASSWORD' => 'Password for an unpproved user'
        ];

        $missing = [];
        foreach($toCheck as $variable => $description) {
            if (is_null(env($variable))) {
                $missing[$variable] = $description;
            }
        }

        if(!empty($missing)) {
            foreach ($missing as $key => $desc) {
                echo "Please populate ENV Variable '".$key."' (".$desc.")\n";
            }
            die();
        }

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
