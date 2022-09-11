<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable =[
        'title','text','department','file_path','periority'
    ];

    protected $attributes =[
        'status' => 0
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
