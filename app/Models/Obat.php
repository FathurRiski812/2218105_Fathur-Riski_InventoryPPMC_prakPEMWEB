<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;
    protected $table = 'tb_obat';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = ['nama_obat', 'harga', 'deskripsi','photo'];
    public $timestamps = false;

}
