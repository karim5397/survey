<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">
               
                <li class="{{Route::is('admin.questionnaire.*') || Route::is('admin.question.*') ? 'menuitem-active' :''}}">
                    <a href="{{route('admin.questionnaire.index')}}">
                        <i class="mdi mdi-pin"></i>
                        <span> Questionnaire </span>
                    </a>
                </li>
             </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>