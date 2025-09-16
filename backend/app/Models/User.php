<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nom','prenom','email','password','service','fonction','role'
    ];

    protected $hidden = [
        'password','remember_token'
    ];

    // relations
    public function demandes()
    {
        return $this->hasMany(DemandeVPN::class);
    }

    public function groupes()
    {
        return $this->belongsToMany(GroupeVPN::class, 'groupe_user');
    }
}
