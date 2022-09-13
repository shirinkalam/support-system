<?php

namespace App\Models;

use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = ['text','ticket_id'];

    public function repliable()
    {
        return $this->morphTo();
    }

    public function getCreatedAtAttribute($value)
    {
        $time = new Verta($value);

        return $time->formatDifference($time);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
