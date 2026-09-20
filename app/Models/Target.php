<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Target extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "targets";
    protected $primaryKey = 'target_id';
    public $incrementing = true;
    protected $fillable = ['project_id','target_details'];
    public $timestamps = true;
}
