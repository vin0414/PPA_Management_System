<?php
namespace App\Services;
use Illuminate\Support\Facades\DB;
use App\Models\Proposal;
use App\Models\Project;
use App\Models\Lead_Measure;
use App\Models\Strategy;
use App\Models\Output;
use App\Models\Target;

class Dashboard
{
    public function totalProposal()
    {
        return Proposal::count();
    }

    public function totalProposedBudget()
    {
        return Proposal::sum('amount');
    }

    public function totalLowPriority()
    {
        return Proposal::where('priority_level',1)->count();
    }

    public function totalModeratePriority()
    {
        return Proposal::where('priority_level',2)->count();
    }

    public function totalHighPriority()
    {
        return Proposal::where('priority_level',3)->count();
    }

    public function fetchProposals()
    {
        return DB::table('proposals as p')->paginate(10);
    }

    public function fetchProjects($id)
    {
        return Project::where('category',$id)->get();
    }

    public function fetchLeadMeasure($id)
    {
        return Lead_Measure::where('project_id',$id)->get();
    }

    public function fetchStrategy($id)
    {
        return Strategy::where('project_id',$id)->get();
    }

    public function fetchOutput($id)
    {
        return Output::where('project_id',$id)->get();
    }

    public function fetchTarget($id)
    {
        return Target::where('project_id',$id)->get();
    }

    public function saveProposal($data)
    {
        return "";
    }
}
