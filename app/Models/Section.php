<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;

class Section extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'active',
        'position',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'active' => 'boolean',
    ];

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

    public static function getSection($id)
    {
        if ($id !="" && $section = Section::findOrFail($id)){
            return $section->name;
        } else {
            return 'no value found';
        }
    }

    public static function getSections( $all = '' )
    {
        if ( $all != '' ) {
            return Section::orderBy('position')->get();
        } else {
            return Section::where('active', 1)->orderBy('position')->get();
        }
    }

}
