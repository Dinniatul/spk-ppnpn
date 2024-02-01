<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiTriwulan extends Model
{
    use HasFactory;

    protected $fillable = ['idNtr', 'user_id', 'idPPNPN', 'idPr', 'idKr', 'nilai', 'nilai_konversi'];

    protected $primaryKey = 'idNtr';
    public function PPNPN()
    {
        return $this->belongsTo(PPNPN::class, 'idPPNPN', 'idPPNPN');
    }

    public function Periode()
    {
        return $this->belongsTo(Periode::class, 'idPr', 'idPr');
    }

    public function Kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'idKr', 'idKr');
    }

    public function User()
    {
        return $this->belongsTo(Kriteria::class, 'user_id', 'id');
    }

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}
