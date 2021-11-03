<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'price', 'days_before_expire'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
