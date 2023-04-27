<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;

    protected $table='platforms';
    protected $primaryKey ='id';
    protected $fillable =['platname'];
    
    public function listing(){
        return $this->belongsTo(Listing::class,'plat_id');
    }
}
