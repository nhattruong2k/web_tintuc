<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Blogger;

class Province extends Model
{
    protected $table = 'provinces';
    protected $fillable = [
        'name', 'gso_id',
    ];
    use HasFactory;
    public function districts()
    {
        return $this->hasMany(District::class, 'province_id');
    }

    public function user(){
        return $this->hasOne(User::class);
    }

    public function blog(){
        return $this->hasOne(Blogger::class,);
    }
}
