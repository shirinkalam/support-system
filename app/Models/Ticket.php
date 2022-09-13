<?php

namespace App\Models;

use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\ComparisonMethodDoesNotDeclareBoolReturnTypeException;

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

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    #زمانی که میخواهد ان اتریبیوت را از مدل بخواند این تابع را بر روی آن اجرا میکند
    public function getPeriorityAttribute($value)
    {
        return ['پایین' ,'متوسط' , 'بالا'][$value];
    }

    public function getStatusNameAttribute()
    {
        return ['باز','پاسخ داده شده','بسته'][$this->status];
    }

    public function getCreatedAtAttribute($value)
    {
        $time = new Verta($value);

        return $time->formatDifference($time);
    }

    public function hasFile()
    {
        return !is_null($this->file_path);
    }

    public function file()
    {
        return $this->hasFile()
            ? Storage::url($this->file_path)
            : null ;
    }

    public function isCreated()
    {
        return $this->status == 0;
    }

    public function replied()
    {
        $this->status = 1;
        $this->save();
    }

    public function close()
    {
        $this->status = 2;
        $this->save();
    }

    public function isClosed()
    {
        return  $this->status === 2;
    }
}
