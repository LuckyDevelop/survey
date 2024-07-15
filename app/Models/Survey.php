<?php

namespace App\Models;

use App\Models\Periode;
use App\Models\Kategori;
use App\Models\Pertanyaan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Survey extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

    public function pertanyaans()
    {
        return $this->hasMany(Pertanyaan::class);
    }

    public function responden()
    {
        return $this->belongsTo(Role::class);
    }
}