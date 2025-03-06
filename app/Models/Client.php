<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'status'
    ];

    public function cashier(){
       return $this->belongsTo(User::class, 'cashier_Id');
    }
    
}
