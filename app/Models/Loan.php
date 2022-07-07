<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'loan_amount', 
        'status',
        'loan_type',
        'duration',
        'approved_at',
        'approved_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
