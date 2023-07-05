<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostCode extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = [
        'cost_code_number',
        'description',
        'unit_of_measure',
        'internal_id',
    ];
}
