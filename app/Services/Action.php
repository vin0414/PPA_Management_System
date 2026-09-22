<?php
namespace App\Services;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Lead_Measure;
use App\Models\Output;
use App\Models\Project;
use App\Models\Strategy;
use App\Models\Target;

class Action
{
    public function saveProject($data)
    {
        return Project::create([
            'category'       => $data['category'],
            'project_details'=> $data['details']
        ]);
    }

    public function removeProject($id)
    {
        return DB::table('projects')
        ->where('project_id',$id)
        ->delete();
    }

    public function fetchLeadMeasure()
    {
        return DB::table('lead_measure as l')
        ->leftJoin('projects as p','p.project_id','=','l.project_id')
        ->select('p.project_details','l.lead','l.lead_id')
        ->get();
    }

    public function saveLeadMeasure($data)
    {
        return Lead_Measure::create([
            'project_id' => $data['project'],
            'lead'       => $data['lead_measure_details']
        ]);
    }

    public function removeLeadMeasure($id)
    {
        return DB::table('lead_measure')
        ->where('lead_id',$id)
        ->delete();
    }

    public function fetchStrategies()
    {
        return DB::table('strategies as s')
        ->leftJoin('projects as p','p.project_id','=','s.project_id')
        ->select('p.project_details','s.name_of_strategy','s.strategy_id')
        ->get();
    }

    public function saveStrategy($data)
    {
        return Strategy::create([
            'project_id'      => $data['strat_project'],
            'name_of_strategy'=> $data['strategy']
        ]);
    }

    public function removeStrategy($id)
    {
        return DB::table('strategies')
        ->where('strategy_id',$id)
        ->delete();
    }

    public function saveOutput($data)
    {
        return Output::create([
            'project_id' => $data['output_project'],
            'output'     => $data['output_details']
        ]);
    }

    public function removeOutput($id)
    {
        return DB::table('outputs')
        ->where('output_id',$id)
        ->delete();
    }

    public function fetchOutput()
    {
        return DB::table('outputs as o')
        ->leftJoin('projects as p','p.project_id','=','o.project_id')
        ->select('p.project_details','o.output','o.output_id')
        ->get();
    }

    public function saveTarget($data)
    {
        return Target::create([
            'project_id'    => $data['target_project'],
            'target_details'=> $data['target_details']
        ]);
    }

    public function fetchTargets()
    {
        return DB::table('targets as t')
        ->leftJoin('projects as p','p.project_id','=','t.project_id')
        ->select('p.project_details','t.target_details','t.target_id')
        ->get();
    }

    public function removeTarget($id)
    {
        return DB::table('targets')
        ->where('target_id',$id)
        ->delete();
    }
}