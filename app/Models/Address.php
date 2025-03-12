<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = 'addresses';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    // Kolom yang bisa diisi (fillable)
    protected $fillable = [
        'street',
        'city',
        'province',
        'country',
        'postal_code',
        'contact_id'
    ];

    // Relasi ke model Contact
    public function contact()
    {
        return $this->belongsTo(Contact::class, 'contact_id', 'id');
    }
}