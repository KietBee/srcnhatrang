<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetAdoptionRequest extends Model
{
    use HasFactory;

    protected $table = 'pet_adoption_requests';
    protected $primaryKey = 'pet_adoption_request_id';
    public $incrementing = false;

    protected $fillable = [
        'pet_adoption_request_id',
        'is_approval',
        'pet_adoption_id',
        'requester_id',
        'approver_id',
        'reason_for_adoption',
        'notes',
        'approved_at',
    ];

    protected $casts = [
        'is_approval' => 'boolean',
        'approved_at' => 'datetime',
    ];

    public function petAdoption()
    {
        return $this->belongsTo(PetAdoption::class, 'pet_adoption_id', 'pet_adoption_id');
    }

    public function requester()
    {
        return $this->belongsTo(User::class, 'requester_id', 'id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id', 'id');
    }
}
