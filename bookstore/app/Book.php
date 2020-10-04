<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function publisher()
    {
        return $this->belongsTo('App\Publisher');
    }

    public function authors()
    {
        return $this->belongsToMany('App\Author', 'book_author');
    }

    public function ratings()
    {
        return $this->hasMany('App\Rating');
    }

    public function rate()
    {
        return $this->ratings->isNotEmpty() ? $this->ratings()->sum('value') / $this->ratings()->count() : 0;
    }
}
