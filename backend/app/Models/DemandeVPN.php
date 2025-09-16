<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeVPN extends Model
{
    use HasFactory;
    protected $table = 'demande_vpns';
    protected $fillable = [
        'user_id','groupe_vpn_id','date_debut','date_fin','justification','statut'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function groupe()
    {
        return $this->belongsTo(GroupeVPN::class, 'groupe_vpn_id');
    }

    public function workflows()
    {
        return $this->hasMany(WorkflowValidation::class, 'demande_vpn_id');
    }
}

