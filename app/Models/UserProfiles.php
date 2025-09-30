<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfiles extends Model
{
    protected $table = "user_profiles";
    
    protected $fillable = [
        'user_id',
        'fullname',
        'nohp',
        'address',
        'address_ktp',
        'rekening',
        'bank',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}