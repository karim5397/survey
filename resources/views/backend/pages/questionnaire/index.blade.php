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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Questionnaires</a></li>
                                <li class="breadcrumb-item active">Show All Questionnaires</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Show All Questionnaires</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <h4 class="header-title ">Questionnaires List</h4>
                                </div>
                            </div>
                            <!-- filter-->
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex justify-content-end gap-2">
                                        <div>
                                            <a href="{{route('admin.questionnaire.create')}}" class="btn btn-primary"><i class="mdi mdi-plus-circle-outline mr-2"></i> Add questionnaire</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            
                            <div class="table-responsive" id="list_table">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Is Active</th>
                                            <th>Added By</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                            @forelse ($questionnaires as $questionnaire)
                                                <tr>
                                                    <td>{{$questionnaires->firstItem()+$loop->index}}</td>
                                                    <td>{{$questionnaire->name}}</td>
                                                    <td>{{$questionnaire->description}}</td>
                                                    <td class="status">
                                                        <div class="form-check form-switch d-flex  gap-2">
                                                            <input  type="checkbox" name="toogle" data-url="{{route('admin.questionnaire.status')}}"  value="{{$questionnaire->id}}" {{$questionnaire->is_active == true ? 'checked' : ''}}  class="form-check-input mr-0 ml-3 change-status-btn"  >
                                                            <div id="status-div">
                                                                @if ($questionnaire->is_active == true)
                                                                    <span class="badge bg-success">Yes</span>
                                                                @else
                                                                    <span class="badge bg-danger">No</span>
                                                                    
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{$questionnaire->user->name}}</td>
                                                    <td>
                                                        <div class="d-flex  gap-2">
                                                            <a href="{{route('admin.question.index',$questionnaire->id)}}"  data-bs-toggle="tooltip" title="Add Question" class="btn btn-outline-success"><i class="mdi mdi-plus"></i></a>
                                                            <a href="{{route('admin.questionnaire.edit',$questionnaire->id)}}"  data-bs-toggle="tooltip" title="Edit" class="btn btn-outline-secondary"><i class="mdi mdi-pen"></i></a>
                                                            <form action="{{route('admin.questionnaire.destroy',$questionnaire->id)}}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-outline-danger dltBtn"  data-bs-toggle="tooltip" title="Delete"><i class="mdi mdi-trash-can"></i></button>
                                                            </form>
                                                        </div>
                                                    </td>
                                
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="10">
                                                        <p class="text-danger text-center">No Data Found</p>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        
                                        
                                        
                                    </tbody>
                                </table>
                                <div id="ajax_pagination">
                                    {{$questionnaires->links('pagination::bootstrap-5')}}
                                </div>

                            </div>


                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->
        </div> <!-- container -->

    </div> <!-- content -->
</div>
@endsection
