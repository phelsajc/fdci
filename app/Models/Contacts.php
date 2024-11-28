<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    protected $table = "contacts";

    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
        'company',
        'phone',
        'email',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
