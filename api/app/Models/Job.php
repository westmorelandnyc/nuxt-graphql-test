<?php

namespace App\Models;

use App\Models\Location;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function locations()
    {
        return $this->hasMany(Location::class);
    }
}
