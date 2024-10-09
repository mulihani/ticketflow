<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'author_ip',
        'author_id',
        'author_name',
        'author_mobile',
        'author_ext',
        'category_id',
        'section_id',
        'content',
        'user_id',
        'staff_id',
        'status',
        'note',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'category_id' => 'integer',
        'user_id' => 'integer',
    ];

    public function category(): belongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function section(): belongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function staff(): belongsTo
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public static function getLastUserTickets( $take = 10, $order = 'desc' )
    {
        return Ticket::where('user_id', auth()->id())->orderBy('id', $order)->take($take)->get();
    }

    public static function ticketCount( $status = '')
    {
        if ($status) {
            return Ticket::where('status', $status)->count();
        } else {
            return Ticket::all()->count();;
        }
    }

}
