<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = ['link'];

    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
