<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Resep extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'tbresep';



    protected $fillable = [
        'namaresep',
        'deskripsi',
        'waktuproses',
        'views',
        'rating',
        'resep_id',
        'caramembuat',
    ]; 

    public function ratings()
    {
    return $this->hasMany(Rating::class)->selectRaw('resep_id, AVG(rating) as rating')->groupBy('resep_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the comments for the recipe.
     */
    public function komentars()
    {
        return $this->hasMany(Komentar::class);
    }

}
