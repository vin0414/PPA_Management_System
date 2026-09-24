<?php
namespace App\Services;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Permissions
{
    public function checkAccess()
    {
        return DB::table('assignment as a')
        ->join('roles as r','r.role_id','=','a.role_id')
        ->select('r.role_name')
        ->where('a.id',Auth::id())->first();
    }
}
