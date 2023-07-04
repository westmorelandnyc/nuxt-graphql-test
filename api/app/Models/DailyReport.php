<?php

namespace App\Models;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DailyReport extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'name',
        'date',
        'sort_order'
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function foreman() {
        return $this->belongsTo(User::class, 'foreman_id');
    }
}
