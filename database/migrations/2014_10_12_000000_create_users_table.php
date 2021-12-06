<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\AreaJob;
use App\Models\City;
use App\Models\Classificator;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('second_name')->nullable();
            $table->string('last_name');
            $table->string('last_name2');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('document')->unique();
            $table->string('phone')->nullable();
            $table->string('photo')->nullable();
            $table->string('headerTheme')->nullable();
            $table->string('sideTheme')->nullable();
            $table->string('brandTheme')->nullable();
            $table->string('colorTheme')->nullable();
            $table->string('mobileTheme')->nullable();
            $table->string('desktopTheme')->nullable();
            $table->string('locale')->nullable();
            $table->integer('status');
            $table->string('type');
            $table->string('timezone')->nullable();
            $table->json('options')->nullable();
            $table->foreignIdFor(City::class)->nullable();
            $table->foreignIdFor(AreaJob::class)->nullable();
            $table->foreignIdFor(Classificator::class)->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
