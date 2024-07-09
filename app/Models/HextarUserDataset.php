<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HextarUserDataset extends Model
{
    use HasFactory;
    protected $table = 'hextar_dataset_combine';

    protected $fillable = [
        'id',
        'name',
        'first_name',
        'last_name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'image',
        'phone',
        'phone_backup',
        'points',
        'status_id',
        'skype',
        'zoom',
        'telegram',
        'member_from',
        'wechat',
        'QQ',
        'weibo',
        'twitter',
        'michat',
        'facebook',
        'login_from',
        'firebase_token',
        'device_token',
        'firebase_register',
        'send',
        'phone_verified',
        'imported',
        'no_show_phone',
        'primary_company',
        'employee_level',
        'designation',
        'department',
        'channel_id',
        'ihextar_used_id',
        'profile_image',
        'is_active',
        'point_updated_at',
        'license_accept_version',
        'is_viewable',
        
    ];
}
