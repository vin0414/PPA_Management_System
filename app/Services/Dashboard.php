<?php
namespace App\Services;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
        return Proposal::where('priority_level',3)->count();
    }

    public function totalModeratePriority()
    {
        return Proposal::where('priority_level',2)->count();
    }

    public function totalHighPriority()
    {
        return Proposal::where('priority_level',1)->count();
    }

    public function fetchProposals($data)
    {
        $columnMap = [
            'project'   => 'b.project_details',
            'proponent' => 'a.proponent',
            'tier'      => 'a.tier',
            'activity'  => 'a.activity_type',
            'priority'  => 'a.priority_level'
        ];
        $query = DB::table('proposals as a')
            ->leftJoin('projects as b', 'a.project_id', '=', 'b.project_id')
            ->whereNull('a.deleted_at')
            ->select('a.proposal_id', 'a.goal', 'a.pillar', 'a.activity_title', 'a.proponent', 'a.amount', 'a.tier', 'a.priority_level', 'a.score', 'b.project_details');

        foreach ($data as $key => $value) {
            if (!empty($value) && isset($columnMap[$key])) {
                // Check if the current filter is the proponent
                if ($key === 'proponent') {
                    $query->where($columnMap[$key], 'like', '%' . $value . '%');
                }else if($key === 'project')
                {
                    $query->where($columnMap[$key], 'like', '%' . $value . '%');
                } else {
                    // Keep exact match for project, tier, activity, and priority
                    $query->where($columnMap[$key], '=', $value);
                }
            }
        }
        return $query->paginate(10);
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
        return Proposal::create([
            'goal'            => $data['goal'],
            'pillar'          => $data['pillar'],
            'project_id'      => $data['project'],
            'lead_id'         => $data['lead_measure'],
            'strategy_id'     => $data['strategy'],
            'output_id'       => $data['output'],
            'target_id'       => $data['target'],
            'proponent'       => $data['proponent'],
            'activity_title'  => $data['activity'],
            'amount'          => str_replace(',', '', $data['amount']),
            'activity_type'   => $data['activity_type'],
            'tier'            => $data['tier_category'],
            'equity_index'    => $data['equity_index'],
            'target_alignment'=> $data['target_alignment'],
            'priority_level'  => $data['level'],
            'score'           => $data['score'],
            'id'              => Auth::id()
        ]);
    }

    public function updateProposal($data)
    {
        return DB::table('proposals')
        ->where('proposal_id',$data['id'])
        ->update([
            'goal'            => $data['goal'],
            'pillar'          => $data['pillar'],
            'project_id'      => $data['project'],
            'lead_id'         => $data['lead_measure'],
            'strategy_id'     => $data['strategy'],
            'output_id'       => $data['output'],
            'target_id'       => $data['target'],
            'proponent'       => $data['proponent'],
            'activity_title'  => $data['activity'],
            'amount'          => str_replace(',', '', $data['amount']),
            'activity_type'   => $data['activity_type'],
            'tier'            => $data['tier_category'],
            'equity_index'    => $data['equity_index'],
            'target_alignment'=> $data['target_alignment'],
            'priority_level'  => $data['level'],
            'score'           => $data['score'],
        ]);
    }

    public function deleteProposal($id)
    {
        return DB::table('proposals')
        ->where('proposal_id',$id)
        ->update([
            'deleted_at'=>now()
        ]);
    }
}