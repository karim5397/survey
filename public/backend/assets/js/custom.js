"use-strict"

const lang=document.documentElement.lang;
tinymce.init({
    selector: "textarea.tinymce-editor",
    toolbar: "insertfile undo redo  |table | ltr rtl | formatselect | styleselect | numlist bullist | bold italic |backcolor |removeformat |alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media  |searchreplace|visualchars |wordcount",
    plugins: [
            'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
            'searchreplace', 'wordcount', 'visualblocks', 'visualchars', 'fullscreen', 'insertdatetime',
            'media', 'table', 'emoticons', 'template', 'help'
            ],
    setup: function (editor) {
        editor.on('init change', function () {
            editor.save();
        });
    },  
    image_description: true,
    image_title: true,
    images_upload_url: '/upload',
    automatic_uploads: true,
    file_picker_types: 'image',
    height:300,    
    file_picker_callback: function(cb, value, meta) {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');
        input.onchange = function() {
            var file = this.files[0];

            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function () {
                var id = 'blobid' + (new Date()).getTime();
                var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                var base64 = reader.result.split(',')[1];
                var blobInfo = blobCache.create(id, file, base64);
                blobCache.add(blobInfo);
                cb(blobInfo.blobUri(), { title: file.name });
            };
        };
        input.click();
    }  
});


//toggle dark light mode
let dark_btn=document.querySelector('#dark_btn');
let light_btn=document.querySelector('#light_btn');

dark_btn.addEventListener('click',function(e){
    e.preventDefault();
    localStorage.removeItem('theme-color');
    localStorage.setItem('theme-color','dark')
    themeColor();
})
light_btn.addEventListener('click',function(e){
    e.preventDefault();
    localStorage.removeItem('theme-color');
    localStorage.setItem('theme-color','light')
    themeColor();
})

function themeColor(){
    if(localStorage.getItem('theme-color') == 'dark'){
        console.log(localStorage.getItem('theme-color'));
        light_btn.classList.remove('d-none');
        dark_btn.classList.add('d-none');
        document.querySelector('body').setAttribute('data-theme','dark');
        document.querySelector('body').setAttribute('data-leftbar-color','dark');
    }
    if(localStorage.getItem('theme-color') == 'light'){
        light_btn.classList.add('d-none');
        dark_btn.classList.remove('d-none');
        document.querySelector('body').setAttribute('data-theme','light');
        document.querySelector('body').setAttribute('data-leftbar-color','light');
    }

}

window.onload=function(){

    themeColor();
}

   


function PhotoUrl(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#upload_'+input.id).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}


$(document).ready(function(){
    //ajax token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
})

 // change status
 $(document).on('change','.change-status-btn',function(){
    var mode = $(this).prop('checked');
    var url = $(this).data('url');
    const lang=document.documentElement.lang;
    console.log(url);
    if(mode){
        
        $(this).next().html('<span class="badge bg-success">Active</span>');
        
    }else{
        
        $(this).next().html('<span class="badge bg-danger">Inactive</span>');
      
    }
    var id = $(this).val();
    $.ajax({
        url:url,
        type:'POST',
        data:{
            mode:mode,
            id:id,
        },
        success:function(response){
            if(response.status){
                $.toast({
                    heading: "Success",
                    showHideTransition: 'fade',
                    text:response.msg,
                    hideAfter:3000,
                    position: 'top-right',
                    icon: 'success',
                });
            }else{
                alert('please try again');
            }
        }
    })
})


//delete button
$('.dltBtn').click(function (e) {
    var form=$(this).closest('form');
    var dataID=$(this).data('id');
    e.preventDefault();

    Swal.fire({
         title: 'Are you sure?',
         text: "you will not be able to recover this data again!",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         cancelButtonText: 'Cancel',
         confirmButtonText: 'Yes , Deleted !'
       }).then((result) => {
         if (result.isConfirmed) {
           form.submit();
           Swal.fire(
             'data has been deleted successfully !',
           )
         }
     });
});

// multi delete
//check button for multi delete
$('#check_all').on('click', function(e) {
    if($(this).is(':checked',true))  
    {
        $(".sub_check").prop('checked', true);
        $('#delete_all_checks').show();
        
    } else {  
        $(".sub_check").prop('checked',false);  
        $('#delete_all_checks').hide();                    
    }  
});


$(document).on('click','.sub_check',function(){
 let checked=[];
 
 $('.sub_check').each(function(){
     if($(this).is(':checked',true)){
         checked.push($(this).val())
     }
 });
 if(checked.length > 0){
     $('#delete_all_checks').show();
 }else{
     $('#delete_all_checks').hide();
 }
})


//multiple delete
$('#delete_all_checks').on('click',function(e){
    e.preventDefault();
    let url=$(this).data('url');
    let ids=[];
    $('.sub_check:checked').each(function(){
        ids.push($(this).val());
    });
    Swal.fire({
        title: 'Are you sure?',
        text: "you will not be able to recover this data again!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancel',
        confirmButtonText: 'Yes , Deleted !'
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url:url,
                type:'GET',
                dataType:'JSON',
                data:{
                    ids:ids
                },
                success:function(data){
                    if(data.status == true){
                        Swal.fire({
                            title: "Deleted successfully",
                            icon:"success",
                            confirmButtonText: "Ok",
                            closeOnConfirm: true,
                            })
                            .then((isConfirm) => {
                            if (isConfirm) {
                                location.reload();
                            } 
                        });
                    }else{
                        Swal.fire({
                            text:data.errors,
                            icon:"warning",
                            confirmButtonText: "Ok",
                            closeOnConfirm: true,
                        })
                    }
                }
            });
        }
    });
});


//show model
function showModal(input){
    let url=input.dataset.url;
    let id=input.id
    $.ajax({
        url:url,
        type:'GET',
        dataType:'JSON',
        data:{
            id:id
        },
        success:function(data){
            $('.modal-body').html(data.html)
            $('#show_modal').modal('show');
        }
    })
}

$(document).ready(function() {
    $('.search-select2').select2();
    flatpickr(".flat_picker_date");
});

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})