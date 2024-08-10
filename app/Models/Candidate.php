<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = 'candidates';

    protected $guarded = ['id'];

    public function barangs()
    {
        return $this->belongsTo(Barang::class, 'leader_id');
    }

  
}
