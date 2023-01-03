<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Permission;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    use \Illuminate\Auth\Authenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name','ninkname','email','password','avatar','phone',
        'gender','birth_date','province_id','district_id','ward_id','google_id',
        'accept_blogger','staff_id'
    ];

    public function blogs()
    {
        return $this->hasMany(Blogger::class);
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function vieweds()
    {
        return $this->hasMany(recentlyViewed::class);
    }

    public function likes()
    {
        return $this->hasMany(likeDislike::class);
    }
    
    public function socialAccounts()
    {
        return $this->hasMany(SocialAccount::class);
    }

    public function province(){
        return $this->hasOne(Province::class,'id','province_id');
    }

    public function district(){
        return $this->hasOne(District::class,'id','district_id');
    }

    public function ward(){
        return $this->hasOne(Ward::class,'id','ward_id');
    }

    public function scopeUser_province($query, $user){
        return $query->with('province')->where('province_id',$user->province_id);
    }

    public function scopeUser_district($query, $user){
        return $query->with('district')->where('district_id',$user->district_id);
    }

    public function scopeUser_ward($query, $user){
        return $query->with('ward')->where('ward_id',$user->ward_id);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function setBirthDateAttribute($value){
        if($value != ''){
            $this->attributes['birth_date'] = \Carbon\Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d'); 
        }else{
            $this->attributes['birth_date'] = '';
        }
        // dd($value);
    }
    public function getBirthDateAttribute($value){
        if(is_null($value)){
            return null;
        }else{
            return Carbon::createFromFormat('Y-m-d', $this->attributes['birth_date'])->format('d/m/Y');
        }
    }

}
