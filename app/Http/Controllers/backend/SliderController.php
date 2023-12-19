<?php

namespace App\Http\Controllers\backend;

use Exception;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Traits\ImageStoreTrait;
use App\Http\Requests\slider\StoreSliderRequest;
use App\Http\Requests\slider\UpdateSliderRequest;

class SliderController extends Controller
{
    use ImageStoreTrait;
    function __construct()
    {
         $this->middleware('permission:slider-list', ['only' => ['index']]);
         $this->middleware('permission:slider-create', ['only' => ['create','store']]);
         $this->middleware('permission:slider-edit', ['only' => ['edit','update','status']]);
         $this->middleware('permission:slider-delete', ['only' => ['destroy','groupDelete']]);
    }
    public function index()
    {
        $sliders=Slider::orderBy('id','DESC')->paginate(10);
        return view('backend.pages.slider.index' ,compact('sliders'));
    }

    
    public function create()
    {
        return view('backend.pages.slider.create');
    }

 
    public function store(StoreSliderRequest $request)
    {
        try{
            $data=$request->validated();
            $data['added_by']=auth()->user()->id;
            $data['order_no']=order_number(new Slider());
            if(!empty($request->hasFile('photo'))){
                $image=$this->storeImage($request->file('photo'),'frontend/assets/images/slider/');
                $data['photo']=$image;
            }
            Slider::create($data);
            return redirect()->route('admin.slider.index')->with('success','slider created successfully');
        }catch(Exception $ex){
            return back()->with('error','Something went wrong '.$ex->getMessage())->withInput();
        }
    }
    public function show(Slider $slider)
    {
        $slider->find($slider->id);
        return view('backend.pages.slider.show',compact('slider'));
    }
    public function edit(Slider $slider)
    {
        $slider->find($slider->id);
        return view('backend.pages.slider.edit',compact('slider'));
    }

   
    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        try{
            $slider->find($slider->id);
            $old_image=$request->old_photo;
            $data=$request->validated();
            $data['updated_by']=auth()->user()->id;
            if(Slider::where('order_no',$request->order_no)->where('id','!=',$slider->id)->exists()){
                return back()->withErrors([
                    'order_no'=>'This order number is exists in another slider'])->withInput();
            }else{
                $data['order_no']=$request->order_no;
            }
    
            if($request->hasFile('photo')){
                $image=$this->storeImage($request->file('photo'),'frontend/assets/images/slider/');
                $data['photo']=$image;
                $slider->update($data);
                if($slider){
                    if(file_exists($old_image)){
                        unlink($old_image);
                    }
                    return redirect()->route('admin.slider.index')->with('success','slider updated successfully');
                }

            }else{
                $slider->update($data);
                if($slider){
                    return redirect()->route('admin.slider.index')->with('success','slider updated successfully');
                }
            }
        }catch(Exception $ex){
            return back()->with('error','Something went wrong '.$ex->getMessage())->withInput();
        }
    }

    public function destroy(Slider $slider)
    {
        $slider->find($slider->id);
        $slider->delete();
        if($slider)
        {
            $old_image=$slider->photo;
            if(file_exists($old_image)){
                unlink($old_image);
            }
           return redirect()->back()->with('success' , 'Deleted successfully');
        }else{
            return back()->with('error' , 'Something Went Wrong');
        }
    }

    public function status(Request $request)
    {
        if($request->mode=='true')
        {
             DB::table('sliders')->where('id' , $request->id)->update(['status' => 'active']);
        }else{
             DB::table('sliders')->where('id' , $request->id)->update(['status' => 'inactive']);
        }
        return response()->json(['msg'=>'Status Successfully Updated' , 'status' => true]);
    }

    public function groupDelete(Request $request)
    {
        if($request->ajax()){
            $ids_array=$request->ids;
            foreach ($ids_array as $id) {
                $slider=Slider::find($id);
                if(file_exists($slider->photo)){
                    unlink($slider->photo);
                }
                $slider->delete();
            }
            return response()->json([
                'status'=>true,
                'msg'=>'deleted successfully'
            ]);
        }
    }
}
