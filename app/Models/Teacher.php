<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_guru'; 

    protected $fillable = [
        'nama_guru',
        'nip',
        'mapel',
        'foto',
    ];

    public $timestamps = false;
}
