<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Panel;
use Filament\Models\Contracts\FilamentUser;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'type',
        'active',
        'staff_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
        'staff_id' => 'boolean',
        'active' => 'boolean',
    ];

    /**
     *  User tickets.
     */
    
    public function tickets(): hasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function open_tickets(): hasMany
    {
        return $this->hasMany(Ticket::class)->where('status', 'open');
    }

    public function processing_tickets(): hasMany
    {
        return $this->hasMany(Ticket::class)->where('status', 'processing');
    }

    public function closed_tickets(): hasMany
    {
        return $this->hasMany(Ticket::class)->where('status', 'closed');
    }

    /**
     * Staff and admins tickets.
     */

    public function staff_tickets(): hasMany
    {
        return $this->hasMany(Ticket::class, 'staff_id');
    }

    public function staff_open_tickets(): hasMany
    {
        return $this->hasMany(Ticket::class, 'staff_id')->where('status', 'open');
    }

    public function staff_processing_tickets(): hasMany
    {
        return $this->hasMany(Ticket::class, 'staff_id')->where('status', 'processing');
    }

    public function staff_closed_tickets(): hasMany
    {
        return $this->hasMany(Ticket::class, 'staff_id')->where('status', 'closed');
    }

    /**
     * Determine who can access which panels
     * 
     */
    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'admin') { // Admin panel
            if( $this->is_admin || $this->type === 'admin') {
                return true;
            } else {
                return false;
            }
        } elseif ($panel->getId() === 'staff') { // Staff panel
            if ( $this->is_admin || $this->type === 'staff' ){
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
