<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantedPropertyListing extends Model
{
    use HasFactory;

    
    protected $table = 'tenanted_property_listings';

    
    protected $fillable = [
        'file_id',
        'uuid',
        'year',
        'landlord',
        'company',
        'type',
        'details',
        'address_1',
        'address_2',
        'address_3',
        'postcode',
        'city',
        'state',
        'date_commencement',
        'date_expired',
        'tenure_year',
        'rental_payment',
        'purpose',
        'remarks',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
        'property_type_id',
        'is_active',
        'is_personal'
    ];

    
    protected $casts = [
        'date_of_commencement' => 'date:Y-m-d',
        'date_of_expiry' => 'datetime:Y-m-d',
    ];
}
