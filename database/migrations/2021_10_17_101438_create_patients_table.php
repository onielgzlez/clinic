<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\City;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('second_name')->nullable();
            $table->string('last_name');
            $table->string('last_name2');
            $table->string('email')->nullable();           
            $table->string('document')->unique();
            $table->string('phone')->nullable();
            $table->string('telephone')->nullable();
            $table->string('jobphone')->nullable();
            $table->string('photo')->nullable();            
            $table->string('whatsapp')->nullable();            
            $table->string('reference')->nullable();            
            $table->string('phone_reference')->nullable();     
            $table->string('whatsapp_reference')->nullable();          
            $table->string('contact_via')->nullable();          
            $table->string('prospectus')->nullable();          
            $table->date('birthdate')->nullable();
            $table->string('address')->nullable();
            $table->string('address_job')->nullable();
            $table->foreignIdFor(City::class)->nullable();
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
        Schema::dropIfExists('patients');
    }
}
