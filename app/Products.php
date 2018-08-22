<?php

namespace Products_JWT;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //
    Protected $table = 'products';
    Protected $fillable = array('name','detail','price','picture_filename','user_id');
    protected $hidden = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function proformDetail(){
        return $this->hasMany(proformDetail::class);
    }

    public function cabfacturas(){
        return $this->hasMany(cabfacturas::class);
    }

    public function getPictureFilenameAttribute()
    {
        if (! $this->attributes['picture_filename']) {
            return '/img/default-picture.jpg';
        }

        return '/images/products/'.$this->attributes['picture_filename'];
    }
}
