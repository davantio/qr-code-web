<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seal_dows', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('product_name');
            $table->string('batch_number');
            $table->date('manufacture_date');
            $table->date('expiry_date');
            $table->string('manufacturing_site');
            $table->string('repacking_site');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seal_dows');
    }
};
