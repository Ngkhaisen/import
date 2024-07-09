<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OverseasPropertyListing extends Model
{
    use HasFactory;

    protected $table = 'Company_asset_listings';

    protected $fillable = [
        'file_id',
        'uuid',
        'purchase_date',
        'company',
        'registered_owner',
        'type',
        'details',
        'address_1',
        'address_2',
        'address_3',
        'city',
        'state',
        'country',
        'tenure',
        'category_of_use',
        'land_size_acre',
        'building_size_sqft',
        'purchase_value_psf',
        'purchase_value_total',
        'nbv_value',
        'date_of_revaluation',
        'revaluation_psf',
        'revaluation_total',
        'sold_price',
        'status',
        'action',
        'remark',
        'is_malaysia',
        'is_personal',
        'property_type_id',
        'property_tenure_id',
        'property_category_id',
        'property_status_id',
        'property_action_id',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'


    ];

    protected $casts = [
        'date_of_purchase' => 'date',
        'date_of_revaluation' => 'date',
        'land_size_acre' => 'decimal:2',
        'building_size_sqft' => 'decimal:2',
        'psf_purchase_value_rm' => 'decimal:2',
        'total_purchase_value_rm' => 'decimal:2',
        'nbv_rm' => 'decimal:2',
        'psf_revaluation_rm' => 'decimal:2',
        'total_revaluation_rm' => 'decimal:2',
        'sold_price' => 'decimal:2',
        'is_malaysia' => 'boolean'
    ];
}

