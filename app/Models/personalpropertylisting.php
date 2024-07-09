<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class PersonalPropertyListing extends Model
{
    use HasFactory;

    protected $table = 'Company_asset_listings';

    protected $fillable = [
        'file_id',
        'uuid',
        'purchase_date',
        'registered_owner',
        'type',
        'details',
        'address_1',
        'address_2',
        'address_3',
        'postcode',
        'city',
        'state',
        'tenure',
        'category_of_use',
        'land_size_acre',
        'building_size_sqft',
        'purchase_value_psf',
        'purchase_value_total',
        'nbv_value',
        'on_date',
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
}

