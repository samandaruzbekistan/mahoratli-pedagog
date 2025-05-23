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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string("fullname");
            $table->string("username");
            $table->string("password");
            $table->timestamps();
        });

        $hash = \Illuminate\Support\Facades\Hash::make('mode1234');

        \Illuminate\Support\Facades\DB::table("admins")
            ->insert([
                'fullname' => "Samandar",
                'username' => "dev",
                'password' => $hash,
                'created_at' => \Carbon\Carbon::now()->toDateString(),
                'updated_at' => \Carbon\Carbon::now()->toDateString(),
            ]);
//        comment

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
};
