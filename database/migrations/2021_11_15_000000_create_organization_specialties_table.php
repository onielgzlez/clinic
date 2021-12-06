<?php

use App\Models\AreaJob;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Organization;

class CreateOrganizationSpecialtiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_specialties', function (Blueprint $table) {         
            $table->foreignIdFor(Organization::class);
            $table->foreignIdFor(AreaJob::class);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organization_specialties');
    }
}
