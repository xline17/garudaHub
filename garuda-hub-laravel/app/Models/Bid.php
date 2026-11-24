<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bid extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'user_id',
        'amount',
        'proposal',
        'status',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function bidder(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}