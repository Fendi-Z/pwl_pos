<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StokModel extends Model
{
    // use HasFactory;

    protected $table = 't_stok';
    protected $primaryKey = 'stok_id';
    protected $guarded = [];

    public function stoks():HasMany {
        return $this->hasMany(LevelModel::class);
    }
    
    public function barang():BelongsTo {
        return $this->belongsTo(BarangModel::class, 'barang_id');
    }

    public function user():BelongsTo {
        return $this->belongsTo(UserModel::class, 'user_id');
    }
}
