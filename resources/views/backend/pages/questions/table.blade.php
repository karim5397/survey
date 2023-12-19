<table class="table table-bordered table-hover">
    <thead>
        <tr class="product-th">
            <th>#</th>
            <th>Content</th>
            <th>Is Required</th>
            <th>Type</th>
            <th>Rule</th>
            <th>Action</th>
            
        </tr>
    </thead>
    <tbody>
        @if ($questions->count() > 0)
       
            @foreach ($questions as $question)
            @php
            if(!empty($question->rules)){

                $rules=implode('|',json_decode($question->rules));
            }else {
                $rules='';
            }
            @endphp
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$question->content}}</td>
                    <td>{{$question->is_required == true ? 'Yes' : 'No'}}</td>
                    <td>{{$question->type}}</td>
                    <td>{{$rules}}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{route('admin.question.destroy' , $question->id)}}" title="Delete"  data-attribute="{{$question->id}}" class="btn btn-outline-danger dlt_link"><i class="mdi mdi-trash-can"></i></a>
                        </div>
                    </td> 
                </tr>
            @endforeach
        @else    
        <tr>
            <td colspan="10">
                <p class="text-danger text-center">No Data Found</p>
            </td>
        </tr>
        @endif
    </tbody>        
</table>

