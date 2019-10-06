<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Backend\Helper\Constant;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('hash_id', 30);
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('profile')->default('profile.png');

            $table->enum('status', [
                Constant::PENDING,
                Constant::VERIFIED,
                Constant::BLOCKED,
            ])->default(Constant::VERIFIED);
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
        Schema::dropIfExists('organizations');
    }
}
