<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLetPropertyListingsTable extends Migration
{
    public function up()
    {
        Schema::create('let_property_listings', function (Blueprint $table) {
            $table->id();
            $table->string('fk_asset_id')->nullable();
            $table->string('uuid', 36)->unique();
            $table->integer('rental_size')->nullable();
            $table->date('rental_date')->nullable();
            $table->string('customer')->nullable();
           
            
            $table->decimal('rental_value_psf', 8, 2)->nullable();
            $table->decimal('rental_value_total', 8, 2)->nullable();
            
            $table->boolean('need_reminder')->default(false);
            $table->date('reminder_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('created_by', 350);
            $table->string('updated_by', 350)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('let_property_listings');
    }
}
