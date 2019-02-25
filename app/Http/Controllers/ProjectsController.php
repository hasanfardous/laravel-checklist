<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Feedback;
use App\CommonFeedback;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::paginate(10);
        return view('admin.projects.projects', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project = new Project();
        $project->name = $request->name;
        $project->client_name = $request->client_name;
        $project->client_logo = $this->projectImgFunc($request);
        $project->save();
        $project_id = $project->id;

        $this->storeCommonFeedbacks($project_id);
        
        return redirect('/projects/all')->with('success', 'Project has been saved.');
    }

    protected function projectImgFunc($request){
        $project = Project::find($request->id);

        if ( $request->file('client_image') ) {
            @unlink($project->client_logo);
        
            $imgObj = $request->file('client_image');
            $projImgName = $imgObj->getClientOriginalName();
            $projImgNameOnly = pathinfo($projImgName, PATHINFO_FILENAME);
            $projExtOnly = pathinfo($projImgName, PATHINFO_EXTENSION);
            $projImgName = $projImgNameOnly. '_' . time() .'.'. $projExtOnly;
            $upPath = 'admin/img/client-logo/';
            $imgObj->move($upPath, $projImgName);
            return $upPath . $projImgName;
        } else{
            return $project->client_logo;
        }
    }

    protected function storeCommonFeedbacks($project_id){
        $CommonFeedbacks = CommonFeedback::all();
        $feedback = new Feedback();
        $now = date('Y-m-d H:i:s');   
        $newFeedbacks = array();

        foreach ( $CommonFeedbacks as $CommonFeedback ) {
            $newFeedbacks[] = [
                'project_id'  => $project_id,
                'feedback'  => $CommonFeedback->feedback,
                'feedback_sec' => '',
                'feedback_status' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        $feedback::insert( $newFeedbacks );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $feedbacks = Feedback::where('project_id', $id)->get();

        return view('admin.projects.single-project', [
            'feedbacks' => $feedbacks,
            'project_id' => $id
        ]);
    }

    public function approveFeedback($id){
        $feedback = Feedback::find($id);
        $feedback->feedback_status = 1;
        $feedback->save();

        return 'Approved';

        $request->session()->flash('message', 'New customer added successfully.');
        $request->session()->flash('message-type', 'success');
    
        return response()->json(['status'=>'Hooray']);
    }


    public function rejectFeedback($id){
        $feedback = Feedback::find($id);
        $feedback->feedback_status = 2;
        $feedback->save();

        return 'Rejected';
    }


    public function deleteFeedback($id){
        $feedback = Feedback::find($id);
        $feedback->delete();

        return 'Deleted';
    }

    public function secondaryFeedbackStore(Request $request, $id){
        $feedback = Feedback::find($request->id);
        $feedback->feedback_sec = $request->feedbackSec;
        $feedback->save();

        return 'Secondary feedback added';
    }



    public function newFeedbackAdd(Request $request){
        $feedback = new Feedback();
        
        $feedback->project_id     = $request->project_id;
        $feedback->feedback       = $request->newFeedback;
        $feedback->feedback_sec   = '';
        $feedback->feedback_status = 0;
        $feedback->save();

        return redirect('projects/view/'.$request->project_id)->with('success', 'Feedback added');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);

        return view('admin.projects.edit', ['project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = Project::where('id', $id)->first();
        $project->name = $request->name;
        $project->client_name = $request->client_name;
        $project->client_logo = $this->projectImgFunc($request);
        $project->save();

        return redirect('/projects/all')->with('success', 'Project has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        $project->delete();

        return redirect('/projects/all')->with('success', 'Project has been deleted.');
    }
}
