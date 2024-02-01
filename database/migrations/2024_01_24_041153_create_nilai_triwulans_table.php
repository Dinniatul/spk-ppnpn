<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiTriwulansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_triwulans', function (Blueprint $table) {
            $table->id('idNtr');
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('idPPNPN')->index();
            $table->unsignedBigInteger('idPr')->index();
            $table->unsignedBigInteger('idKr')->index();
            $table->float('nilai');
            $table->integer('nilai_konversi')->nullable();
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
        Schema::dropIfExists('nilai_triwulans');
    }
}
