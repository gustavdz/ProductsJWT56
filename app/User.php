<?php

namespace Products_JWT;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password','profilepicture_filename','p12_filename','p12_password','api_token','admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function clients(){
        return $this->hasMany(Clients::class);
    }

    public function proforms(){
        return $this->hasMany(proform::class);
    }

    public function products(){
        return $this->hasMany(Products::class);
    }

    public function ptoventas(){
        return $this->hasMany(ptoventas::class);
    }

    public function cabfacturas(){
        return $this->hasMany(cabfacturas::class);
    }

    public function empresas(){
        return $this->hasOne(Empresas::class);
    }

    public function comunicados(){
        return $this->hasMany(comunicados::class);
    }

    public function proyectos(){
        return $this->hasMany(Proyectos::class);
    }

    public function comunicadoslecturas(){
        return $this->hasMany(comunicadosLectura::class);
    }

    public function tasks(){
        return $this->hasMany(task::class);
    }

    public function comunicadoslecturas_comunicados($comunicado_id){
        return Comunicados::where('id','=',$comunicado_id)->first();
    }

    public function getProfilepictureFilenameAttribute()
    {
        if (! $this->attributes['profilepicture_filename']) {
            return '/img/default-avatar.png';
        }

        return '/images/users/'.$this->attributes['profilepicture_filename'];
    }

    public function getP12FilenameAttribute()
    {
        if (! $this->attributes['p12_filename']) {
            return 'No se ha cargado un archivo de firma digital.';
        }

        return $this->attributes['p12_filename'];
    }
}
