<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'site_name',
    'site_email' ,
    'site_status',
    'ticket_monitor_status',
    'signup_status',
    'users_only_status',
    'site_close_massage',
    'it_support_number',
    'support_info_page',
    'support_info_page_status',
    'ticket_search_status',
    'site_activation_hours',
    'site_activation_starts_at',
    'site_activation_ends_at',
    'site_activation_hours_massage',
    'timezone',
    'closed_days'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'closed_days' => 'array',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'closed_days' => '[]',
    ];

    public static function getSetting($field)
    {
        if ($setting = Setting::first()){
            return $setting->$field;
        } else {
            return 'no value found';
        }
    }

}
