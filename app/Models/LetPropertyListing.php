<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetPropertyListing extends Model
{
    use HasFactory;

    
    protected $table = 'let_property_listings';

    
    protected $fillable = [
        'customer',
        'uuid',
        'fk_asset_id',
        'need_reminder',
        'reminder_date',
        'is_active',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
        'rental_value_psf',
        'rental_value_total',
        'rental_size',
        'rental_date',
    ];

    
    protected $casts = [
        
        'expiry_date' => 'date',
        'land_size' => 'decimal:2',
        'psf_rental_value' => 'decimal:2',
        'total_rental_value' => 'decimal:2',
    ];
}

