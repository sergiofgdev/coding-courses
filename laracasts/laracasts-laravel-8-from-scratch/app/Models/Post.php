<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //$fillable permite mass assign a la hora de introducir datos en la bbdd
    //protected $fillable = ['title', 'excerpt', 'body'];

    //Everything is fillable except what is in $guarded
    // Si vemos que usamos mucho esto, se puede desactivar en Providers/AppServiceProvider-> public function boot() Model::unguard()
    protected $guarded = [];

    // this way we will have less db query clockwork
    protected $with = ['category', 'author'];


    //Relación entre categoria y post
    public function category()
    {
        //hasOne, hasMany, belongsTo, belongsToMany
        return $this->belongsTo(Category::class);
    }

    //Relacion entre autor y post
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeFilter($query, array $filters) // Post::newQuery()->filter() Scope es como un añadido extra.
    {
        //Filtra los posts por lo escrito en search
        $query->when($filters['search'] ?? false, fn($query, $search) => $query
            ->where(fn($query) => $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%')
            )
        );

        //Filtra los posts por categoria, pero no por el id de la categoria si n su slug
        $query->when($filters['category'] ?? false, fn($query, $category) => $query
            ->whereHas('category', fn($query) => $query->where('slug', $category)
            ));

        //Filtra los posts por author->username
        $query->when($filters['author'] ?? false, fn($query, $author) => $query
            ->whereHas('author', fn($query) => $query->where('username', $author)
            )

        );
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


}
