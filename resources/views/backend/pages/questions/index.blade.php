@extends('backend.layouts.admin_master')
@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
             <!-- start page title -->
             <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">Questionnaire</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Add Questions to ({{$questionnaire->name}})</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 
            <div class="card py-4 px-2">
                    <form action=""  method="post" id="store_form">
                        @csrf
                        <input type="hidden" name="questionnaire_id" value="{{$questionnaire->id}}">
                        <div class="row">
                            <div class="col-lg-5">
                                <form action="">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group mt-3">
                                                <label class="form-label"> Type <span class="text-danger">*</span></label>
                                                <select name="type" class="form-select" id="type">
                                                    <option value="" disabled selected>-- Select Type--</option>
                                                    <option value="text" {{old('type') == 'text' ? 'selected' : ''}}>text</option>
                                                    <option value="number" {{old('type') == 'number' ? 'selected' : ''}}>number</option>
                                                    <option value="radio" {{old('type') == 'radio' ? 'selected' : ''}}>radio</option>
                                                    <option value="date" {{old('type') == 'date' ? 'selected' : ''}}>date</option>
                                                </select>
                                            </div>
                                            <div class="error-text type-error"></div>
                                        </div>
                                        <div class="col-12 my-2">
                                            <div class="form-group">
                                                <label class="form-label">Content <span class="text-danger">*</span></label>
                                                <input type="text" name="content" class="form-control" value="{{old('content')}}">
                                            </div>
                                            <div class="error-text content-error"></div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 mt-3" id="rule_div" style="display: none">
                                            <h4>Rules</h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mt-3">
                                                        <label class="form-label"> Type <span class="text-danger">*</span></label>
                                                        <select name="rule_type" class="form-select" id="rule_type">
                                                            <option value="" disabled selected>-- Select Rule Type--</option>
                                                            <option value="numeric" {{old('rule_type') == 'numeric' ? 'selected' : ''}}>numeric</option>
                                                            <option value="string" {{old('rule_type') == 'string' ? 'selected' : ''}}>string</option>
                                                        </select>
                                                    </div>
                                                    <div class="error-text rule_type-error"></div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mt-3">
                                                        <label class="form-label">Min </label>
                                                        <input type="number" name="rule_min" id="rule_min" class="form-control" value="{{old('rule_min')}}">
                                                    </div>
                                                    <div class="error-text rule_min-error"></div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mt-3">
                                                        <label class="form-label">Max </label>
                                                        <input type="number" name="rule_max" id="rule_max" class="form-control" value="{{old('rule_max')}}">
                                                    </div>
                                                    <div class="error-text rule_max-error"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 mt-3" id="otpions-div" style="display: none">
                                            
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="d-flex gap-2">
                                                        <h4>Options</h4>
                                                        <div>
                                                            <button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">add</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-12">
                                                    
                                                    <div id="dynamicAddRemove">
                                                        <div class="form-group mt-3" >
                                                            <label class="form-label">Value </label>
                                                            <div class="d-flex gap-2">
                                                                <input type="text" name="input[0][value]"  class="form-control value" />

                                                            </div>
                                                            <div class="error-text input-0-value-error"></div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12 my-2">
                                            <button class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            
                            <div class="col-lg-7 mt-2">
                                <div id="attribute_table">
                                    @include('backend.pages.questions.table',['questions'=>$questions])
                                </div>
                            
                            </div>
                            
                           
                            
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
@section('script')
<script>
    $('#type').on('change',function(){
        let value=$(this).val();
        if(value == 'text'  || value == 'number'){
            $('#rule_type').val('')
            $('#rule_min').val('')
            $('#rule_max').val('')
            $('#rule_div').show();
        }else{
            $('#rule_div').hide();
            
        }
    })
    $('#type').on('change',function(){
        let value=$(this).val();
        if(value == 'radio'){
            $('.value').val('')
            $('#otpions-div').show();
        }else{
            $('#otpions-div').hide();

        }
    })
</script>
<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar").click(function () {
        ++i;
        $('#dynamicAddRemove').append(`
                <div class="form-group mt-3" >
                    <label class="form-label">Value </label>
                    <div class="d-flex gap-2">
                        <input type="text" name="input[${i}][value]"  class="form-control value" />
                        <button class="btn btn-danger remove-input-field"> <i class="fa fa-x"></i> </button>

                    </div>
                    <div class="error-text input-${i}-value-error"></div>
                </div>
        `)
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).closest('.form-group').remove();
    });
    

</script>

{{-- add attribute  --}}
<script>
    $('#store_form').on('submit',function(e){
        e.preventDefault();
        $.ajax({
            url:"{{route('admin.question.store')}}",
            type:'POST',
            dataType:'JSON',
            data: new FormData(this),
            cache:false,
            contentType:false,
            processData:false,
            beforeSend:function(){
                    $(document).find('div.error-text').html('');
            },
            success:function(data){
                

                if(data.status){
                    $('#attribute_table').html(data.html)
                    $("#store_form")[0].reset();
                    $.toast({
                        heading: "Success",
                        showHideTransition: 'fade',
                        text:"The Question added successfully",
                        hideAfter:6000,
                        position: 'top-right',
                        icon: 'success',
                    });
                }else{
                    
                    $.each(data.errors,function(prefix , value){
                        
                        $('div.'+prefix.replaceAll('.','-')+'-error').html(`<p class='invalid-feedback d-block'>${value[0]}</p>`);
                    })

                    if(data.error){
                        Swal.fire({
                            title: data.error,
                            icon: 'warning',
                            confirmButtonText: 'Ok'
                        })
                    }
                }
            }
        })
    })
</script>



@endsection
