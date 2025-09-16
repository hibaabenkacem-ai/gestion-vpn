<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupeVPN extends Model
{
    use HasFactory;
    protected $table = 'groupe_vpns';
    protected $fillable = ['nom_groupe','description'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'groupe_user');
    }

    public function demandes()
    {
        return $this->hasMany(DemandeVPN::class);
    }
}
