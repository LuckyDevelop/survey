<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListJawaban extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function jenisJawaban()
    {
        return $this->belongsTo(JenisJawaban::class);
    }
}
