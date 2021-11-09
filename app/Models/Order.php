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
        'mobile',
        'cost',
        'department_id',
        'document_type_id',
        'status_id',
        'user_id',
        'or_no',
        'expiration_time',
        'appeals',
        'remarks',
    ];

    public function document_type()
    {
        return $this->hasOne(DocumentType::class, 'id', 'document_type_id');
    }

    public function status()
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
