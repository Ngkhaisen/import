<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('overseas_property_listings', function (Blueprint $table) {
        $table->id();
        $table->string('file_id');
        $table->string('uuid', 36)->unique();
        $table->foreignId('property_type_id')->nullable();
        $table->foreignId('property_tenure_id')->nullable();
        $table->foreignId('property_category_id')->nullable();
        $table->foreignId('property_status_id')->nullable();
        $table->foreignId('property_action_id')->nullable();
        $table->date('purchase_date');
        $table->string('company')->nullable();
        $table->string('registered_owner');
        $table->string('type');
        $table->text('details');
        $table->string('address_1')->nullable();
        $table->string('address_2')->nullable();
        $table->string('address_3')->nullable();
        $table->string('city');
        $table->string('state');
        $table->string('country');
        $table->string('tenure')->nullable();
        $table->string('category_of_use')->nullable();
        $table->decimal('land_size_acre', 8, 2)->nullable();
        $table->string('building_size_sqft')->nullable();
        $table->decimal('purchase_value_psf', 15, 2)->nullable();
        $table->decimal('purchase_value_total', 15, 2)->nullable();
        $table->decimal('nbv_value', 15, 2)->nullable();
        $table->date('date_of_revaluation')->nullable();
        $table->decimal('revaluation_psf', 15, 2)->nullable();
        $table->decimal('revaluation_total', 15, 2)->nullable();
        $table->decimal('sold_price', 15, 2)->nullable();
        $table->string('status');
        $table->string('action');
        $table->string('remark')->nullable();
        $table->boolean('is_malaysia')->default(false);
        $table->boolean('is_personal')->default(false);
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
        Schema::dropIfExists('overseas_property_listings');
    }
};
