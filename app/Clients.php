<?php

namespace Products_JWT;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    //
    Protected $table = 'clients';
    Protected $fillable = array('name','last_name','email','dni','client_vip','phone','profilepicture_filename','address','user_id');
    protected $hidden = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function proform(){
        return $this->hasMany(proform::class);
    }

    public function cabfacturas(){
        return $this->hasMany(cabfacturas::class);
    }

    public function proyectos(){
        return $this->hasMany(Proyectos::class);
    }

    public function getProfilepictureFilenameAttribute()
    {
        if (! $this->attributes['profilepicture_filename']) {
            return '/img/default-avatar.png';
        }

        return '/images/clients/'.$this->attributes['profilepicture_filename'];
    }
}
