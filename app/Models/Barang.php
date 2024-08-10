<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = 'barangs';

    protected $guarded = ['id'];

    protected $fillable = [
        'name', 'phone', 'link'
    ];

    public function candidates()
    {
        return $this->hasMany(Candidate::class, 'leader_id');
    }
}
