<?php

use App\Models\Komoditas;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pangans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('komoditas');
            $table->string('jenis_barang');
            $table->string('satuan');
            $table->string('harga_sebelum')->nullable();
            $table->string('harga');
            $table->string('pasar');
            $table->string('keterangan');
            $table->timestamp('periode');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pangans');
    }
};
