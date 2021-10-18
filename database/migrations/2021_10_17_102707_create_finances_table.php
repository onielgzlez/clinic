<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Patient;
use App\Models\Organization;

class CreateFinancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finances', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->double('amount');
            $table->text('concepts')->nullable();
            $table->timestamp('f_date')->nullable();
            $table->date('pay_date')->nullable();
            $table->string('order')->nullable();
            $table->foreignIdFor(Patient::class)->nullable();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Organization::class);
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
        Schema::dropIfExists('finances');
    }
}
