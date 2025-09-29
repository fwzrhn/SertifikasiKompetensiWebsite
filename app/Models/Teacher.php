<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_guru'; // pakai id_guru sebagai PK
    protected $fillable = ['nama_guru', 'nip', 'mapel', 'foto'];
}
