<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proposal extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "proposals";
    protected $primaryKey = 'proposal_id';
    public $incrementing = true;
    protected $fillable = ['goal','pillar','project_id','lead_id','strategy_id','output_id','target_id',
                           'proponent','activity_title','amount','activity_type','tier','equity_index','target_alignment',
                           'priority_level','score','id'];
    public $timestamps = true;
}
