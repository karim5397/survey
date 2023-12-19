<?php

namespace App\Http\Controllers\backend;

use Exception;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\Questionnaire;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\questionnaire\StoreQuestionnaireRequest;
use App\Http\Requests\questionnaire\UpdateQuestionnaireRequest;

class QuestionnaireController extends Controller
{
    public function index(){
        $questionnaires = Questionnaire::orderBy('id','desc')->paginate(10);
        return view('backend.pages.questionnaire.index', compact("questionnaires"));
    }
    public function create(){
        return view('backend.pages.questionnaire.create');
    }
    public function store(StoreQuestionnaireRequest $request){
        try {
            $data= $request->validated();
            $data['user_id'] = auth()->user()->id;
            Questionnaire::create($data);
            return redirect()->route('admin.questionnaire.index')->with('success','questionnaire added successfully');
        }catch(Exception $e){
            return redirect()->back()->with('error','something went wrong'.$e->getMessage());
        }
    }
    public function edit(Questionnaire $questionnaire){
        $questionnaire->findOrFail($questionnaire->id);
        return view('backend.pages.questionnaire.edit',compact('questionnaire'));
    }
    public function update(UpdateQuestionnaireRequest $request,Questionnaire $questionnaire){
        try {
            $questionnaire->findOrFail($questionnaire->id);
            $data= $request->validated();
            $questionnaire->update($data);
            return redirect()->route('admin.questionnaire.index')->with('success','questionnaire updated successfully');
        }catch(Exception $e){
            return redirect()->back()->with('error','something went wrong'.$e->getMessage());
        }
    }
    public function destroy(Questionnaire $questionnaire)
    {
        try{
            $questionnaire->findOrFail($questionnaire->id)->delete();
            return back()->with('success' ,'deleted successfully');
        
        }catch(Exception $ex){
            return back()->with('error' , 'Something Went Wrong '.$ex->getMessage())->withInput();
        }
    }
    public function status(Request $request)
    {
        if($request->mode=='true')
        {
             DB::table('questionnaires')->where('id' , $request->id)->update(['is_active' => true]);
        }else{
             DB::table('questionnaires')->where('id' , $request->id)->update(['is_active' => false]);
        }
        return response()->json(['msg'=>'is_active Successfully Updated' , 'status' => true]);
    }
}
