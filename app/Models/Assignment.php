<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assignment extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "assignment";
    protected $primaryKey = 'assignment_id';
    public $incrementing = true;
    protected $fillable = ['role__id','id'];
    public $timestamps = true;
}
