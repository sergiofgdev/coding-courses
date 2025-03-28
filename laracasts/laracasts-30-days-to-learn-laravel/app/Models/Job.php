<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'job_listings'; //Esto lo ha añadido porque estamos usando el model Job pero la table en la bd es job_listings, lo más lógico hubiera sido utilizar la migración de Jobs ya incluída y modificarla
//    protected $fillable = ['title', 'salary'];

    protected $guarded = [];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, foreignPivotKey: 'job_listing_id');
    }
}
