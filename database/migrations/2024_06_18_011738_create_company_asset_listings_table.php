<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyAssetListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_asset_listings', function (Blueprint $table) {
            $table->id();
            $table->string('file_id')->unique();
            $table->string('uuid', 36)->unique();
            
            $table->foreignId('property_type_id')->nullable();
            $table->foreignId('property_tenure_id')->nullable();
            $table->foreignId('property_category_id')->nullable();
            $table->foreignId('property_status_id')->nullable();
            $table->foreignId('property_action_id')->nullable();
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('address_3')->nullable();
            $table->string('postcode')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->date('purchase_date')->nullable();
            $table->text('details');
            $table->decimal('purchase_value_psf', 18, 6)->nullable();
            $table->decimal('purchase_value_total', 18, 6)->nullable();
            $table->decimal('nbv_value', 18, 6)->nullable();
            $table->date('revaluation_date')->nullable();
            $table->text('remarks')->nullable();
            $table->boolean('is_malaysia')->default(1);
            $table->boolean('is_personal')->default(0);
            $table->boolean('is_active')->default(1);
            $table->string('created_by', 350);
            $table->string('updated_by', 350)->nullable();
            $table->string('deleted_by', 350)->nullable();
            $table->boolean('is_compliance')->nullable()->default(0);
            $table->text('compliance_remark')->nullable();
            $table->decimal('utilize_building_size', 18, 6)->nullable();
            $table->decimal('utilize_land_size', 18, 6)->nullable();
            $table->tinyInteger('utilize_building_size_value_type_sqft')->nullable();
            $table->tinyInteger('utilize_land_size_value_type_acre')->nullable();
            $table->decimal('market_value', 18, 6)->nullable();
            $table->decimal('land_size', 18, 6)->nullable();
            $table->decimal('building_size', 18, 6)->nullable();
            $table->tinyInteger('land_size_value_type_acre')->nullable();
            $table->tinyInteger('building_size_value_type_sqft')->nullable();
            $table->date('lease_hold_expired_date')->nullable();
            $table->string('hak_milik_id', 100)->unique()->nullable();
            $table->string('lot_id', 100)->nullable();
            $table->string('bandar_pekan_mukim', 100)->nullable();
            $table->timestamps(); // This will add created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_asset_listings');
    }
}
