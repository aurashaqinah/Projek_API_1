<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    // Kolom yang bisa diisi (fillable)
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'user_id'
    ];

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Relasi ke model Address
    public function addresses()
    {
        return $this->hasMany(Address::class, 'contact_id', 'id');
    }
    
}