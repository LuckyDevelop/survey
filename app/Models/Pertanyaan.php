<?php

namespace App\Models;

use App\Models\Jawaban;
use App\Models\JenisJawaban;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pertanyaan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function jawabans()
    {
        return $this->hasMany(Jawaban::class);
    }

    public function jenis_jawaban()
    {
        return $this->belongsTo(JenisJawaban::class);
    }
}