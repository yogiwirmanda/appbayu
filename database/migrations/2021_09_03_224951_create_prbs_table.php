<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prbs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_pasien');
            $table->integer('id_dokter');
            $table->string('tensi');
            $table->string('nadi');
            $table->string('suhu');
            $table->string('berat_badan');
            $table->string('tinggi_badan');
            $table->text('obat');
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
        Schema::dropIfExists('prbs');
    }
}
