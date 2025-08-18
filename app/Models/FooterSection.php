<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'title',
        'address'
    ];

    public function details()
    {
        return $this->hasMany(FooterSectionDetail::class, 'footer_section_id');
    }



}
