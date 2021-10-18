<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Patient;
use App\Models\Organization;
use App\Models\AreaJob;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->timestamp('init');
            $table->timestamp('end');
            $table->text('observation');
            $table->integer('status');
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Organization::class);
            $table->foreignIdFor(AreaJob::class);
            $table->foreignIdFor(Patient::class);
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
        Schema::dropIfExists('appointments');
    }
}
