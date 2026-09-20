<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Output extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "outputs";
    protected $primaryKey = 'output_id';
    public $incrementing = true;
    protected $fillable = ['project_id','output'];
    public $timestamps = true;
}
