<?php

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
        Schema::create('tenanted_property_listings', function (Blueprint $table) {
            $table->id();
            $table->string('file_id')->nullable();
            $table->string('uuid', 36)->unique();
            $table->year('year');
            $table->foreignId('property_type_id')->nullable();
            $table->string('landlord');
            $table->string('company');
            $table->string('type');
            $table->text('details');
            $table->string('address_1');
            $table->string('address_2')->nullable();
            $table->string('address_3')->nullable();
            $table->string('postcode')->nullable();
            $table->string('city');
            $table->string('state');
            $table->date('date_commencement');
            $table->date('date_expired');
            $table->integer('tenure_year');
            $table->decimal('rental_payment', 10, 2);
            $table->string('purpose')->nullable();
            $table->text('remarks')->nullable();
            $table->boolean('is_personal')->default(true);
            $table->string('created_by', 350);
            $table->string('updated_by', 350)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenanted_property_listings');
    }
};
