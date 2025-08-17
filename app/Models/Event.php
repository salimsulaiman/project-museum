<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'event_category_id',
        'event_location_id',
        'location_detail',
        'content',
        'standing',
        'classroom',
        'round_table',
        'u_shape',
        'length',
        'width',
        'facility',
        'max_participant',
        'contact',
        'pic',
        'description',
        'starting_date',
        'ending_date',
        'status',
    ];

    protected $casts = [
        'starting_date' => 'datetime',
        'ending_date'   => 'datetime',
    ];

    // Relasi ke kategori
    public function category()
    {
        return $this->belongsTo(EventCategory::class, 'event_category_id');
    }

    // Relasi ke lokasi
    public function location()
    {
        return $this->belongsTo(EventLocation::class, 'event_location_id');
    }
}
