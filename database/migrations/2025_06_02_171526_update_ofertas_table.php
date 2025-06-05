<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOfertasTable extends Migration
{
    public function up()
    {
        Schema::table('ofertas', function (Blueprint $table) {
            $table->string('nombre')->nullable();
            $table->decimal('precio_original', 8, 2)->default(0.00);
            $table->decimal('precio_oferta', 8, 2)->default(0.00);
            $table->string('imagen')->nullable();
            $table->unsignedBigInteger('negocio_id')->nullable();
            $table->foreign('negocio_id')->references('id')->on('negocios')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('ofertas', function (Blueprint $table) {
            $table->dropForeign(['negocio_id']);
            $table->dropColumn('negocio_id');
            $table->dropColumn('nombre');
            $table->dropColumn('precio_original');
            $table->dropColumn('precio_oferta');
            $table->dropColumn('imagen');
        });
    }
}
