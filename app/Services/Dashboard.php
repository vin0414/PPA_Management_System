<?php
namespace App\Services;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Proposal;
use App\Models\Project;

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
        return "";
    }

    public function fetchProjects($id)
    {
        return Project::where('category',$id)->get();
    }
}
