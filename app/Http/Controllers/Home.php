<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Services\Action;
use App\Services\Log;
use App\Models\Project;

class Home extends Controller
{
    protected $action;
    protected $logService;
    public function __construct(Action $action, Log $logService)
    {
        $this->action = $action;
        $this->logService = $logService;
    }

    public function index()
    {
        $data['title'] = "Welcome";
        return view('auth.index',$data);
    }

    public function dashboard()
    {
        $data['title'] = "Dashboard";
        return view('pages.dashboard',$data);
    }

    public function settings()
    {
        $data['title'] = "System Settings";
        $data['projects'] = Project::all();
        $data['leads'] = $this->action->fetchLeadMeasure();
        $data['strategies'] = $this->action->fetchStrategies();
        $data['output'] = $this->action->fetchOutput();
        $data['targets'] = $this->action->fetchTargets();
        return view('pages.settings',$data);
    }

    public function profile()
    {
        $data['title'] = "My Profile";
        return view('pages.profile',$data);
    }

    //actions here

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
}