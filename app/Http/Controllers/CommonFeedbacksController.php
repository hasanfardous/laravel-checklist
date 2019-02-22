<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CommonFeedback;

class CommonFeedbacksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $CommonFeedbacks = CommonFeedback::paginate(10);

        return view('admin.feedbacks.feedbacks', [
            'CommonFeedbacks' => $CommonFeedbacks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.feedbacks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $CommonFeedback = new CommonFeedback();

        $CommonFeedback->feedback = $request->feedback;
        $CommonFeedback->save();

        return redirect('feedbacks/all')->with('success', 'Common Feedback Added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $CommonFeedback = CommonFeedback::find($id);
        
        return view('admin.feedbacks.edit', [
            'CommonFeedback' => $CommonFeedback
        ]);
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
        $CommonFeedback = CommonFeedback::where('id', $id)->first();

        $CommonFeedback->feedback = $request->feedback;
        $CommonFeedback->save();

        return redirect('/feedbacks/all')->with('success', 'Feedback updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $CommonFeedback = CommonFeedback::find($id);
        $CommonFeedback->delete();

        return redirect('feedbacks/all')->with('success', 'Feedback has been deleted.');
    }
}
