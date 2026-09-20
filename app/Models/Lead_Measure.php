<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead_Measure extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "lead_measure";
    protected $primaryKey = 'lead_id';
    public $incrementing = true;
    protected $fillable = ['project_id','lead'];
    public $timestamps = true;
}