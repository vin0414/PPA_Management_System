<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\Action;
use App\Services\Log;
use App\Services\Dashboard;
use App\Services\Permissions;
use App\Models\Project;
use App\Models\Proposal;
use App\Models\Roles;

class Home extends Controller
{
    protected $action;
    protected $logService;
    protected $dashboard;
    protected $permissions;
    public function __construct(Action $action, Log $logService, Dashboard $dashboard, Permissions $permissions)
    {
        $this->action = $action;
        $this->logService = $logService;
        $this->dashboard = $dashboard;
        $this->permissions = $permissions;
    }

    public function index()
    {
        $data['title'] = "Welcome";
        return view('auth.index',$data);
    }

    public function dashboard(Request $request)
    {
        $filter = [
            'project'   => $request->input('project'),
            'proponent' => $request->input('proponent'),
            'tier'      => $request->input('tier'),
            'activity'  => $request->input('activity'),
            'priority'  => $request->input('priority')
        ];
        $data['title'] = "Dashboard";
        $data['total'] = $this->dashboard->totalProposal();
        $data['budget'] = $this->dashboard->totalProposedBudget();
        $data['low'] = $this->dashboard->totalLowPriority();
        $data['moderate'] = $this->dashboard->totalModeratePriority();
        $data['high'] = $this->dashboard->totalHighPriority();
        $data['list'] = $this->dashboard->fetchProposals($filter);
        $data['permissions'] = $this->permissions->checkAccess();
        return view('pages.dashboard',$data);
    }

    public function createProposal()
    {
        $data['title'] = "Activity Proposal";
        $data['permissions'] = $this->permissions->checkAccess();
        return view('pages.create',$data);
    }

    public function editProposal($token)
    {
        if($this->permissions->checkAccess()->role_name == "Super-admin")
        {
            $id = decrypt($token);
            $data['proposal'] = Proposal::findOrFail($id);
            $data['title'] = "Edit Activity Proposal";
            $data['permissions'] = $this->permissions->checkAccess();
            return view('pages.edit',$data);
        }
        abort(403, 'Unauthorized');
    }

    public function settings()
    {
        if($this->permissions->checkAccess()->role_name == "Super-admin")
        {
            $data['title'] = "System Settings";
            $data['projects'] = Project::all();
            $data['leads'] = $this->action->fetchLeadMeasure();
            $data['strategies'] = $this->action->fetchStrategies();
            $data['output'] = $this->action->fetchOutput();
            $data['targets'] = $this->action->fetchTargets();
            $data['users'] = $this->action->fetchUsers();
            $data['roles'] = Roles::all();
            $data['permissions'] = $this->permissions->checkAccess();
            return view('pages.settings',$data);
        }
        abort(403, 'Unauthorized');
    }

    public function profile()
    {
        $data['title'] = "My Profile";
        $data['permissions'] = $this->permissions->checkAccess();
        $data['logs'] = DB::table('logs as l')
                        ->join('users as u','u.id','=','l.id')
                        ->select('u.name','l.activity','l.ip_address','l.agent','l.created_at')
                        ->get();
        return view('pages.profile',$data);
    }

    //actions here
    public function download()
    {
        $fileName = 'activity_forms.csv';
        $data = DB::table('proposals as a')
            ->leftJoin('projects as b', 'a.project_id', '=', 'b.project_id')
            ->whereNull('a.deleted_at')
            ->select('a.created_at', 'a.goal', 'a.pillar', 'a.activity_title', 'a.proponent', 'a.amount', 'a.tier', 'a.priority_level', 'a.score', 'b.project_details')
            ->get();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['Proponent','Title','Goal','Pillar','Project','Tier','Amount','Score','Priority','Date Created'];

        $callback = function() use ($data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($data as $row) {
                fputcsv($file, [
                    $row->proponent,
                    $row->activity_title,
                    $row->goal,
                    $row->pillar,
                    $row->project_details,
                    $row->tier,
                    $row->amount,
                    $row->score,
                    $row->priority_level,
                    $row->created_at
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function saveProposal(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'goal'            => 'required|string',
            'pillar'          => 'required|string',
            'project'         => 'required|integer',
            'lead_measure'    => 'required|integer',
            'strategy'        => 'required|integer',
            'output'          => 'required|integer',
            'target'          => 'required|integer',
            'proponent'       => 'required|string|max:255',
            'activity'        => 'required|string|max:255',
            'amount'          => 'required|numeric|gt:0|decimal:0,2',
            'activity_type'   => 'required|integer',
            'tier_category'   => 'required|string',
            'equity_index'    => 'required|integer',
            'target_alignment'=> 'required|integer',
            'level'           => 'required',
            'score'           => 'required'
        ],[
            'goal.required'         => 'Please select a goal',
            'pillar.required'       => 'Please select a pillar',
            'project.required'      => 'Please select a project',
            'lead_measure.required' => 'Please select a lead measure',
            'strategy.required'     => 'Please select a strategy',
            'output.required'       => 'Please select an output',
            'target.required'       => 'Please select a target',
            'proponent.required'    => 'Please enter office, unit or school proposing this',
            'activity.required'     => 'Please enter the title of the activity',
            'amount.required'       => 'Please enter proposed budget',
            'activity_type.required'=> 'Please select type of activity',
            'tier_category.required'=> 'Please select tier',
            'equity_index.required' => 'Please select equity index',
            'target_alignment.required'=> 'Please select target alignment'
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()
            ]);
        }
        //save
        $data = $this->dashboard->saveProposal($validator->validated());
        if($data)
        {
            $this->logService->saveLogs(
                Auth::id(),
                'Submitted new proposal',
                $request->ip(),
                $request->header('User-Agent')
            );
            return response()->json([
                'status'=>200,
                'message'=>'Successfully saved entry'
            ]);
        }
        else
        {
            return response()->json([
                'status'=>500,
                'message'=>$data
            ]);
        }
    }

    public function updateProposal(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id'              => 'required|integer',
            'goal'            => 'required|string',
            'pillar'          => 'required|string',
            'project'         => 'required|integer',
            'lead_measure'    => 'required|integer',
            'strategy'        => 'required|integer',
            'output'          => 'required|integer',
            'target'          => 'required|integer',
            'proponent'       => 'required|string|max:255',
            'activity'        => 'required|string|max:255',
            'amount'          => 'required|numeric|gt:0|decimal:0,2',
            'activity_type'   => 'required|integer',
            'tier_category'   => 'required|string',
            'equity_index'    => 'required|integer',
            'target_alignment'=> 'required|integer',
            'level'           => 'required',
            'score'           => 'required'
        ],[
            'goal.required'         => 'Please select a goal',
            'pillar.required'       => 'Please select a pillar',
            'project.required'      => 'Please select a project',
            'lead_measure.required' => 'Please select a lead measure',
            'strategy.required'     => 'Please select a strategy',
            'output.required'       => 'Please select an output',
            'target.required'       => 'Please select a target',
            'proponent.required'    => 'Please enter office, unit or school proposing this',
            'activity.required'     => 'Please enter the title of the activity',
            'amount.required'       => 'Please enter proposed budget',
            'activity_type.required'=> 'Please select type of activity',
            'tier_category.required'=> 'Please select tier',
            'equity_index.required' => 'Please select equity index',
            'target_alignment.required'=> 'Please select target alignment'
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()
            ]);
        }
        //save
        $data = $this->dashboard->updateProposal($validator->validated());
        if($data)
        {
            $this->logService->saveLogs(
                Auth::id(),
                'Updated existing proposal',
                $request->ip(),
                $request->header('User-Agent')
            );
            return response()->json([
                'status'=>200,
                'message'=>'Successfully applied changes'
            ]);
        }
        else
        {
            return response()->json([
                'status'=>500,
                'message'=>$data
            ]);
        }
    }

    public function deleteProposal(Request $request)
    {
        $value = $request->input('value');
        $data = $this->dashboard->deleteProposal($value);
        if($data)
        {
            $this->logService->saveLogs(
                Auth::id(),
                'Deleted proposal',
                $request->ip(),
                $request->header('User-Agent')
            );
            return response()->json([
                'status'=>200,
                'message'=>'Successfully deleted entry'
            ]);
        }
        else
        {
            return response()->json([
                'status'=>500,
                'message'=>$data
            ]);
        }
    }

    public function saveProject(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'category'  => 'required|string|max:255',
            'details'   => 'required|string|unique:projects,project_details'
        ],[
            'category.required' => 'Please select a category',
            'category.string'   => 'Invalid entry',
            'details.required'  => 'Please enter the project details',
            'details.unique'    => 'These project details have already been submitted.'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()
            ]);
        }
        $data = $this->action->saveProject($validator->validated());
        if($data)
        {
            $this->logService->saveLogs(
                Auth::id(),
                'Create new project',
                $request->ip(),
                $request->header('User-Agent')
            );
            return response()->json([
                'status'=>200,
                'message'=>'Successfully saved entry'
            ]);
        }
        else
        {
            return response()->json([
                'status'=>500,
                'message'=>$data
            ]);
        }
    }

    public function removeProject(Request $request)
    {
        $value = decrypt($request->input('value'));
        $data = $this->action->removeProject($value);
        if($data)
        {
            $this->logService->saveLogs(
                Auth::id(),
                'Remove project. Reference :'.$value,
                $request->ip(),
                $request->header('User-Agent')
            );
            return response()->json([
                'status'=>200,
                'message'=>'Successfully removed entry'
            ]);
        }
        else
        {
            return response()->json([
                'status'=>500,
                'message'=>$data
            ]);
        }
    }

    public function saveLeadMeasure(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'project'                => 'required|integer',
            'lead_measure_details'   => 'required|string|unique:lead_measure,lead'
        ],[
            'project.required'  => 'Please select project',
            'project.integer'   => 'Invalid entry',
            'lead_measure_details.required'  => 'Please enter the lead measure details',
            'lead_measure_details.unique'    => 'These lead measure details have already been submitted.'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()
            ]);
        }
        $data = $this->action->saveLeadMeasure($validator->validated());
        if($data)
        {
            $this->logService->saveLogs(
                Auth::id(),
                'Create new Lead Measure',
                $request->ip(),
                $request->header('User-Agent')
            );
            return response()->json([
                'status'=>200,
                'message'=>'Successfully saved entry'
            ]);
        }
        else
        {
            return response()->json([
                'status'=>500,
                'message'=>$data
            ]);
        }
    }

    public function removeLeadMeasure(Request $request)
    {
        $value = decrypt($request->input('value'));
        $data = $this->action->removeLeadMeasure($value);
        if($data)
        {
            $this->logService->saveLogs(
                Auth::id(),
                'Remove selected lead measure. Reference : '.$value,
                $request->ip(),
                $request->header('User-Agent')
            );
            return response()->json([
                'status'=>200,
                'message'=>'Successfully removed entry'
            ]);
        }
        else
        {
            return response()->json([
                'status'=>500,
                'message'=>$data
            ]);
        }
    }

    public function saveStrategy(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'strat_project'    => 'required|integer',
            'strategy'         => 'required|string|unique:strategies,name_of_strategy'
        ],[
            'strat_project.required'  => 'Please select project',
            'strat_project.integer'   => 'Invalid entry',
            'strategy.required'       => 'Please enter the strategy details',
            'strategy.unique'         => 'These strategy have already been submitted.'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()
            ]);
        }
        $data = $this->action->saveStrategy($validator->validated());
        if($data)
        {
            $this->logService->saveLogs(
                Auth::id(),
                'Create new target',
                $request->ip(),
                $request->header('User-Agent')
            );
            return response()->json([
                'status'=>200,
                'message'=>'Successfully saved entry'
            ]);
        }
        else
        {
            return response()->json([
                'status'=>500,
                'message'=>$data
            ]);
        }
    }

    public function removeStrategy(Request $request)
    {
        $value = decrypt($request->input('value'));
        $data = $this->action->removeStrategy($value);
        if($data)
        {
            $this->logService->saveLogs(
                Auth::id(),
                'Remove selected target. Reference : '.$value,
                $request->ip(),
                $request->header('User-Agent')
            );
            return response()->json([
                'status'=>200,
                'message'=>'Successfully removed entry'
            ]);
        }
        else
        {
            return response()->json([
                'status'=>500,
                'message'=>$data
            ]);
        }
    }

    public function saveOutput(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'output_project'   => 'required|integer',
            'output_details'   => 'required|string|unique:outputs,output'
        ],[
            'output_project.required'  => 'Please select project',
            'output_project.integer'   => 'Invalid entry',
            'output_details.required'  => 'Please enter the output details',
            'output_details.unique'    => 'These output have already been submitted.'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()
            ]);
        }
        $data = $this->action->saveOutput($validator->validated());
        if($data)
        {
            $this->logService->saveLogs(
                Auth::id(),
                'Create new output',
                $request->ip(),
                $request->header('User-Agent')
            );
            return response()->json([
                'status'=>200,
                'message'=>'Successfully saved entry'
            ]);
        }
        else
        {
            return response()->json([
                'status'=>500,
                'message'=>$data
            ]);
        }
    }

    public function removeOutput(Request $request)
    {
        $value = decrypt($request->input('value'));
        $data = $this->action->removeOutput($value);
        if($data)
        {
            $this->logService->saveLogs(
                Auth::id(),
                'Remove selected output. Reference : '.$value,
                $request->ip(),
                $request->header('User-Agent')
            );
            return response()->json([
                'status'=>200,
                'message'=>'Successfully removed entry'
            ]);
        }
        else
        {
            return response()->json([
                'status'=>500,
                'message'=>$data
            ]);
        }
    }

    public function saveTarget(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'target_project'   => 'required|integer',
            'target_details'   => 'required|string|unique:targets,target_details'
        ],[
            'target_project.required'  => 'Please select project',
            'target_project.integer'   => 'Invalid entry',
            'target_details.required'  => 'Please enter the target details',
            'target_details.unique'    => 'These target have already been submitted.'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()
            ]);
        }

        $data = $this->action->saveTarget($validator->validated());
        if($data)
        {
            $this->logService->saveLogs(
                Auth::id(),
                'Create new target',
                $request->ip(),
                $request->header('User-Agent')
            );
            return response()->json([
                'status'=>200,
                'message'=>'Successfully saved entry'
            ]);
        }
        else
        {
            return response()->json([
                'status'=>500,
                'message'=>$data
            ]);
        }
    }

    public function removeTarget(Request $request)
    {
        $value = decrypt($request->input('value'));
        $data = $this->action->removeTarget($value);
        if($data)
        {
            $this->logService->saveLogs(
                Auth::id(),
                'Remove selected target. Reference : '.$value,
                $request->ip(),
                $request->header('User-Agent')
            );
            return response()->json([
                'status'=>200,
                'message'=>'Successfully removed entry'
            ]);
        }
        else
        {
            return response()->json([
                'status'=>500,
                'message'=>$data
            ]);
        }
    }

    //fetch activity resources
    public function fetchProjects(Request $request)
    {
        $value = $request->input('value');
        $data = $this->dashboard->fetchProjects($value);
        return response()->json([
            'status'=>200,
            'data'=>$data
        ]);
    }

    public function fetchLeadMeasure(Request $request)
    {
        $value = $request->input('value');
        $data = $this->dashboard->fetchLeadMeasure($value);
        return response()->json([
            'status'=>200,
            'data'=>$data
        ]);
    }

    public function fetchStrategy(Request $request)
    {
        $value = $request->input('value');
        $data = $this->dashboard->fetchStrategy($value);
        return response()->json([
            'status'=>200,
            'data'=>$data
        ]);
    }

    public function fetchOutput(Request $request)
    {
        $value = $request->input('value');
        $data = $this->dashboard->fetchOutput($value);
        return response()->json([
            'status'=>200,
            'data'=>$data
        ]);
    }

    public function fetchTarget(Request $request)
    {
        $value = $request->input('value');
        $data = $this->dashboard->fetchTarget($value);
        return response()->json([
            'status'=>200,
            'data'=>$data
        ]);
    }

    public function saveRole(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'role' => 'required|string|max:255|unique:roles,role_name'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()
            ]);
        }
        $data = $this->action->saveRole($validator->validated());
        if($data)
        {
            $this->logService->saveLogs(
                Auth::id(),
                'Added new role',
                $request->ip(),
                $request->header('User-Agent')
            );
            return response()->json([
                'status'=>200,
                'message'=>'Successfully added new role'
            ]);
        }
        else
        {
            return response()->json([
                'status'=>500,
                'message'=>$data
            ]);
        }
    }

    public function saveAccount(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'account_name'=> 'required|string|max:255|unique:users,name',
            'email'       => 'required|email:rfc,dns',
            'role_name'   => 'required|integer'
        ],[
            'account_name.required' => 'Please enter fullname',
            'email.required'        => 'Please enter valid email address',
            'role_name.required'    => 'Please select a role'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()
            ]);
        }
        $data = $this->action->saveAccount($validator->validated());
        if($data)
        {
            $this->logService->saveLogs(
                Auth::id(),
                'Created new account',
                $request->ip(),
                $request->header('User-Agent')
            );
            return response()->json([
                'status'=>200,
                'message'=>'Successfully created new account'
            ]);
        }
        else
        {
            return response()->json([
                'status'=>500,
                'message'=>$data
            ]);
        }
    }

    public function deactivate(Request $request)
    {
        $value = $request->input('value');
        $data = $this->action->deactivateAccount($value);
        if($data)
        {
            $this->logService->saveLogs(
                Auth::id(),
                'Deactivate the selected account',
                $request->ip(),
                $request->header('User-Agent')
            );
            return response()->json([
                'status'=>200,
                'message'=>'Successfully deactivate the account'
            ]);
        }
        else
        {
            return response()->json([
                'status'=>500,
                'message'=>$data
            ]);
        }
    }

}
