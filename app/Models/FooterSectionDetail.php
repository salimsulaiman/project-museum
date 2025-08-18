<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterSectionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'footer_section_id',
        'navigation',
        'href'
    ];

      public function section()
    {
        return $this->belongsTo(FooterSection::class, 'footer_section_id');
    }
}
