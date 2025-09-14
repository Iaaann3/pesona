<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BiayaSetting extends Model
{
     use HasFactory;

    protected $table = 'biaya_settings';
    protected $fillable = ['keamanan', 'kebersihan','tanggal_tagih', 'tanggal_jatuh_tempo',];
}
