<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_email',
        'user_id'
    ];
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
