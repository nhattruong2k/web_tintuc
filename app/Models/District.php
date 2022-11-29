<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class District extends Model
{
    use HasFactory;
    public function province()
        {
            return $this->belongsTo(Province::class, 'province_id');
        }
        
        public function wards()
        {
            return $this->hasMany(Ward::class, 'district_id');
        }

        public function user(){
            return $this->hasOne(User::class);
        }
}
