<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\Uuid;

class Record extends Model
{
    use HasFactory;
    use Uuid;

    protected $primaryKey = 'UUID';

    public $fillable = ['name','description','code','status'];
}
