<div class="navbar-custom">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-end mb-0">

            

            <li class="dropdown d-none d-lg-inline-block">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" title="theme color" id="dark_btn">
                    <i class="mdi mdi-brightness-3" style="font-size: 22px"></i>
                </a>
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light d-none" id="light_btn">
                    <i class="mdi mdi-brightness-5" style="font-size: 22px"></i>
                </a>
            </li>

            {{-- <li class="dropdown d-none d-lg-inline-block">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" title="main website" href="{{route('home')}}" target="_blank">
                    <i class="mdi mdi-web" style="font-size: 22px"></i>
                </a>
            </li> --}}
            
            

            


            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{asset(userDefaultImage())}}" alt="user-image" class="rounded-circle">
                    <span class="pro-user-name ms-1">
                        {{auth()->user()->name}} <i class="mdi mdi-chevron-down"></i> 
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome , {{auth()->user()->name}}</h6>
                        
                    </div>

                    <div class="dropdown-divider"></div>

                    <!-- item-->
                    <a href="{{route('admin.logout')}}" class="dropdown-item notify-item">
                        <i class="fe-log-out"></i>
                        <span>Logout</span>

                    </a>

                </div>
            </li>

            

        </ul>

        <!-- LOGO -->
        <div class="logo-box bg-white">
            <a href="{{route('admin.questionnaire.index')}}" class="logo logo-light text-center">
                 <span class="logo-sm">
                    
                    <span class="logo-lg-text-light">G</span>
                </span> 
                <h3 class="pt-2">
                    Galaxy
                </h3>
            </a>
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light">
                    <i class="fe-menu"></i>
                </button>
            </li>

            <li>
                <!-- Mobile menu toggle (Horizontal Layout)-->
                <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </li>   
        </ul>
        <div class="clearfix"></div>
    </div>
</div>