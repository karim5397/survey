<?php

namespace App\Http\Controllers\backend;

use Exception;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\Questionnaire;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    public function index($questionnaire_id)
    {
        $questionnaire=Questionnaire::findOrFail($questionnaire_id);
        $questions=Question::where('questionnaire_id',$questionnaire_id)->orderBy('id','desc')->get();
        return view('backend.pages.questions.index', compact("questionnaire","questions"));
    }
    public function store(Request $request){
        if($request->ajax()){
 
            $validator = Validator::make($request->all(),[
                'type'=>'required|in:text,number,radio,date',
                'is_required'=>'required|boolean',
                'content'=>'required|string',
                'rule_type'=>"required_if:type,text,number|in:string,numeric",
                'rule_min'=>"nullable|numeric",
                'rule_max'=>"nullable|numeric",
                'input.*.value' => 'required_if:type,radio',
               
            ],[
                'type.required'=>'The type field is required',
                'is_required.required'=>'The is_required field is required',
                'content.required'=>'The content field is required',
                'input.*.value.required_if'=>'The value field is required',
                'rule_type.required_if'=>'The rule_type field is required',
            ]);

            if ($validator->fails())
            {
                return response()->json(['status'=>false,'errors'=>$validator->errors()->toArray()]);
            }

            $rules=[
                $request->rule_type,                
            ];
            if ($request->has('rule_max') && $request->rule_max !== null) {
                $rules[] = 'max:' . $request->rule_max;
            }
            if ($request->has('rule_min') && $request->rule_min !== null) {
                $rules[] = 'min:' . $request->rule_min;
            }

            $options=[];
            foreach ($request->input as $key => $value) {
                $options[]=$value['value'];
            }
            $rulesJson = !empty($rules) ? json_encode($rules) : null;
            $optionsJson = !empty($options) ? json_encode($options) : null;
            Question::create([
            'questionnaire_id'=>$request->questionnaire_id,
            'is_required'=>$request->is_required,
            'order'=>order_number(new Question),
            'content' => $request->content,
            'type' => $request->type,
            'rules' => $rulesJson,
            'options' =>$optionsJson ,
            ]);

            $questions=Question::where('questionnaire_id',$request->questionnaire_id)->orderBy('id','desc')->get();
             $view=view('backend.pages.questions.table',['questions'=>$questions])->render();
             return response()->json([
                 'status'=>true,
                 'html'=>$view
             ]);
        }
    }
    public function destroy($id)
    {
        try{
            Question::findOrFail($id)->delete();
            return back()->with('success' ,'deleted successfully');
        
        }catch(Exception $ex){
            return back()->with('error' , 'Something Went Wrong '.$ex->getMessage())->withInput();
        }
    }
}
