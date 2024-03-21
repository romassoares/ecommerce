<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'client_id',
        'service_id',
        'date_schedule',
    ];

    public function client(): BelongsTo
    {
        return  $this->belongsTo(Client::class);
    }

    public function service(): BelongsTo
    {
        return  $this->belongsTo(Service::class);
    }
}
