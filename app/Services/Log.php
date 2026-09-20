<?php
namespace App\Services;
use App\Models\Logs;

class Log
{
    public function saveLogs($id, $activity, $ip, $agent)
    {
        Logs::create([
            'id'        => $id,
            'activity'  => $activity,
            'ip_address'=> $ip,
            'agent'     => $agent
        ]);
    }
}