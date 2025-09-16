<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkflowValidation extends Model
{
    use HasFactory;
    protected $fillable = [
        'demande_vpn_id','etape_actuelle','statut','commentaire','validated_by','date_validation'
    ];

    public function demande()
    {
        return $this->belongsTo(DemandeVPN::class, 'demande_vpn_id');
    }

    public function validator()
    {
        return $this->belongsTo(User::class, 'validated_by');
    }
}
