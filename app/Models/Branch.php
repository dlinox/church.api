<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'phone_number', 'status'];

    protected $casts = [
        'status' => 'boolean',
    ];

    public $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $searchColumns = ['name'];
}
