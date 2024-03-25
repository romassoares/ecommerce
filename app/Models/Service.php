<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['description', 'limit_schedule', 'service_day', 'price'];


    public function get_days_of_week()
    {
        return ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'];
    }

    public function schedules(): HasMany
    {
        return  $this->hasMany(Schedule::class);
    }
}
