<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PPNPN extends Model
{
    use HasFactory;

    protected $fillable = ['namaPPNPN'];
    protected $primaryKey = 'idPPNPN';
}
