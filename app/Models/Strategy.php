<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Strategy extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "strategies";
    protected $primaryKey = 'strategy_id';
    public $incrementing = true;
    protected $fillable = ['project_id','name_of_strategy'];
    public $timestamps = true;
}