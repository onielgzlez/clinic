<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\User;
use App\Models\Organization;
use App\Models\Country;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();            
            $table->string('fullname');
            $table->string('email');
            $table->string('phone');
            $table->double('amount');
            $table->string('currency',3);
            $table->string('promo_code')->nullable();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Organization::class);
            $table->foreignIdFor(Country::class);
            $table->integer('status');
            $table->date('pay_date');
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
        Schema::dropIfExists('payments');
    }
}