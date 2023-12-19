<!-- Vendor js -->
<script src="{{asset('backend/assets/js/vendor.min.js')}}"></script>


<!-- Plugins js-->
<script src="{{asset('backend/assets/libs/flatpickr/flatpickr.min.js')}}"></script>
<script src="{{asset('backend/assets/libs/select2/js/select2.min.js')}}"></script>
<script src="{{asset('backend/assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
 <script src="{{asset('backend/assets/js/bstable.js')}}"></script>
 <script src="{{asset('backend/assets/libs/selectize/js/standalone/selectize.min.js')}}"></script>
 <script src="{{asset('backend/assets/libs/toastr-notification/dist/jquery.toast.min.js')}}"></script>
 <script src="{{asset('backend/assets/libs/tinymce/tinymce.min.js')}}"></script>
 
 
 <!-- App js-->
 <script src="{{asset('backend/assets/js/validate.min.js')}}"></script>
 <script src="{{asset('backend/assets/js/custom.js')}}"></script>


{{-- notification  --}}
<script>
    @if (Illuminate\Support\Facades\Session::has('success'))
        $.toast({
            heading: "Success",
            showHideTransition: 'fade',
            text:"{{session()->get('success')}}",
            hideAfter:6000,
            position: 'top-right',
            icon: 'success',
        });

      
    @endif
 
    @php
    Illuminate\Support\Facades\Session::forget('success');
    @endphp
    @if (Illuminate\Support\Facades\Session::has('error'))
          $.toast({
             heading: "Error",
            showHideTransition: 'fade',
            text:"{{session()->get('error')}}",
            hideAfter:false,
            position: 'top-right',
            icon: 'error',
          })
    @endif
    @php
        Illuminate\Support\Facades\Session::forget('error');
    @endphp
 </script>



@yield('script')