<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'ctr_no',
        'name',
        'contact_no',
        'document_type_id',
        'status_id',
        'or_no',
        'expiration_time',
    ];
}
