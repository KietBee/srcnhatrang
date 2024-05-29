<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetAdoptionRequest extends Model
{
    use HasFactory;

    protected $table = 'pet_adoption_requests';

    // Define the primary key
    protected $primaryKey = 'pet_adoption_request_id';

    // Disable auto-incrementing
    public $incrementing = false;

    // Fillable fields
    protected $fillable = [
        'pet_adoption_request_id',
        'is_approval',
        'pet_id',
        'requester_id',
        'approver_id',
        'reason_for_adoption',
        'notes',
        'approved_at',
    ];

    // Casts for specific fields
    protected $casts = [
        'is_approval' => 'boolean',
        'approved_at' => 'datetime',
    ];

    /**
     * Define the "belongsTo" relationship with the "Pet" model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pet()
    {
        return $this->belongsTo(Pet::class, 'pet_id', 'pet_id');
    }

    /**
     * Define the "belongsTo" relationship with the "Account" model for the requester.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function requester()
    {
        return $this->belongsTo(User::class, 'requester_id', 'id');
    }

    /**
     * Define the "belongsTo" relationship with the "Account" model for the approver.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id', 'id');
    }
}
