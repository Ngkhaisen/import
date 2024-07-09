<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyAssetListing extends Model
{
    use HasFactory;
    protected $table = 'Company_asset_listings';

    public $timestamps = false; // Since timestamps are managed separately

    protected $casts = [
        'created_at' => 'datetime:Y-m-d\TH:i:sP',
        'updated_at' => 'datetime:Y-m-d\TH:i:sP',
        'deleted_at' => 'datetime:Y-m-d\TH:i:sP',
        'is_active' => 'boolean',
        
        'is_malaysia' => 'boolean',
        'need_reminder' => 'boolean',
        'purchase_value_total' => 'float',
        'purchase_value_psf' => 'float',
        'nbv_value' => 'float',
        'sold_price' => 'float',
        'purchase_date' => 'datetime:Y-m-d',
        'revaluation_date' => 'datetime:Y-m-d',
        'is_compliance' => 'boolean',
        'utilize_building_size' => 'float',
        'utilize_land_size' => 'float',
        'utilize_building_size_value_type_sqft' => 'integer',
        'utilize_land_size_value_type_acre' => 'integer',
        'market_value' => 'float',
        'land_size' => 'float',
        'building_size' => 'float',
        'land_size_value_type_acre' => 'integer',
        'building_size_value_type_sqft' => 'integer',
        'lease_hold_expired_date' => 'datetime:Y-m-d',
    ];

    protected $fillable = [
        
        'file_id',
        'uuid',
        'property_type_id',
        'property_tenure_id',
        'property_category_id',
        'property_status_id',
        'property_action_id',
        'address_1',
        'address_2',
        'address_3',
        'postcode',
        'city',
        'state',
        'purchase_date',
        'details',
        'purchase_value_psf',
        'purchase_value_total',
        'nbv_value',
        'revaluation_date',
        'remarks',
        'is_malaysia',
        'is_personal',
        'is_active',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
        'is_compliance',
        'compliance_remark',
        'utilize_building_size',
        'utilize_land_size',
        'utilize_building_size_value_type_sqft',
        'utilize_land_size_value_type_acre',
        'market_value',
        'land_size',
        'building_size',
        'land_size_value_type_acre',
        'building_size_value_type_sqft',
        'lease_hold_expired_date',
        'hak_milik_id',
        'lot_id',
        'bandar_pekan_mukim',
    ];
}


