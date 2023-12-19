@extends('backend.layouts.admin_master')
@section('content')
<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">
            
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route("admin.questionnaire.index")}}">Questionnaire</a></li>
                                <li class="breadcrumb-item active">Edit Questionnaire</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Edit Questionnaire</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 
           
                <div class="row">
                    <div class="col-sm-12">
                        
                        <div class="card">
                            <div class="card-body">
                                
                                <form action="{{route('admin.questionnaire.update',$questionnaire->id)}}" method="POST"  id="edit-form">
                                    @csrf
                                    @method('PATCH')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3>
                                                Questionnaire Informations
                                            </h3>
                                        </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group mt-3">
                                                    <label class="form-label">Name <span class="text-danger">*</span></label>
                                                    <input type="text" name="name" class="form-control" value="{{old('name',$questionnaire->name)}}">
                                                </div>
                                                @error('name')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group mt-3">
                                                    <label class="form-label"> Is Active <span class="text-danger">*</span></label>
                                                    <select name="is_active" class="form-select">
                                                        <option value="" disabled selected>-- select --</option>
                                                        <option value="1" {{old('is_active',$questionnaire->is_active) == '1' ? 'selected' : ''}}>Yes</option>
                                                        <option value="0" {{old('is_active',$questionnaire->is_active) == '0' && old('is_active',$questionnaire->is_active) != '' ? 'selected' : ''}}>No</option>
                                                    </select>
                                                </div>
                                                @error('is_active')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                            
                                            <div class="col-md-12 col-sm-12">
                                                <div class="form-group mt-3">
                                                    <label class="form-label">Description <span class="text-danger">*</span></label>
                                                    <textarea name="description" class="form-control" cols="30" rows="5">{{old('description',$questionnaire->description)}}</textarea>
                                                </div>
                                                @error('description')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-12 col-sm-12 mt-3 d-flex justify-content-center gap-2">
                                                <button class="btn btn-success "> Save</button>
                                                <a class="btn btn-danger " href="{{route('admin.questionnaire.index')}}">  Cancel</a>
                                            </div>
                                        </div>
                                    </form>
                            </div>
                        </div> <!-- end card-->
                    </div> 
                </div>
            </form>
            <!-- end row-->
        </div>
    </div>
</div>
@endsection

