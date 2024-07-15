<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisJawaban extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function listJawabans()
    {
        return $this->hasMany(ListJawaban::class);
    }

    public function inputType()
    {
        return $this->belongsTo(InputType::class);
    }
}
