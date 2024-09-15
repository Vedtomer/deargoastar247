   <!--  BEGIN SIDEBAR  -->
   <div class="sidebar-wrapper sidebar-theme">
       <nav id="sidebar">

           <div class="navbar-nav theme-brand flex-row  text-center">
               <div class="nav-logo">
                   {{-- <div class="nav-item  avatar avatar-indicators avatar-online">
                       <a href="{{ route('admin.dashboard') }}">
                           <img src="{{ asset('asset/admin/assets/img/small-logo.png') }}" class="rounded-circle"
                               alt="logo">
                       </a>
                   </div> --}}
                   {{-- <div class="nav-item theme-text">
                       <a href="{{route("admin.dashboard")}}" class="nav-link"> SEI </a>
                   </div> --}}
               </div>

               <div class="nav-item sidebar-toggle">
                   <div class="btn-toggle sidebarCollapse">
                       <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                           fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                           stroke-linejoin="round" class="feather feather-chevrons-left">
                           <polyline points="11 17 6 12 11 7"></polyline>
                           <polyline points="18 17 13 12 18 7"></polyline>
                       </svg>
                   </div>
               </div>
           </div>

           <div class="profile-info">
               <div class="user-info">
                   <div class="profile-img  ">
                       <img src="{{ Auth::user()->profile_image }}" alt="avatar">
                   </div>
                   <div class="profile-content">
                       <h6 class="">{{ Auth::user()->name }}</h6>

                   </div>
               </div>
           </div>

           <ul class="list-unstyled menu-categories" id="accordionExample">

               <li class="menu {{ classActivePath('draws') }}">
                   <a href="{{ route('draws.index') }}" aria-expanded="false" class="dropdown-toggle">
                       <div class="">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                               fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                               stroke-linejoin="round" class="feather feather-columns">
                               <path
                                   d="M12 3h7a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-7m0-18H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h7m0-18v18">
                               </path>
                           </svg>
                           <span>Dashboard</span>
                       </div>
                   </a>
               </li>


               {{-- <li class="menu {{ classActivePath('transaction') }}">
                   <a href="{{ route('admin.transaction') }}" aria-expanded="false" class="dropdown-toggle">
                       <div class="">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                               fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                               stroke-linejoin="round" class="feather feather-monitor">
                               <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                               <line x1="8" y1="21" x2="16" y2="21"></line>
                               <line x1="12" y1="17" x2="12" y2="21"></line>
                           </svg>
                           <span>Transaction</span>
                       </div>
                   </a>
               </li>

               <li class="menu {{ classActivePath('sliders') }}">
                   <a href="{{ route('sliders.index') }}" aria-expanded="false" class="dropdown-toggle">
                       <div class="">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                               fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                               stroke-linejoin="round" class="feather feather-layout">
                               <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                               <line x1="3" y1="9" x2="21" y2="9"></line>
                               <line x1="9" y1="21" x2="9" y2="9"></line>
                           </svg>
                           <span>App Slider</span>
                       </div>
                   </a>
               </li>

               <li class="menu {{ classActivePath('companies') }}">
                   <a href="{{ route('companies.index') }}" aria-expanded="false" class="dropdown-toggle">
                       <div class="">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                               fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                               stroke-linejoin="round" class="feather feather-layout">
                               <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                               <line x1="3" y1="9" x2="21" y2="9"></line>
                               <line x1="9" y1="21" x2="9" y2="9"></line>
                           </svg>
                           <span>Company</span>
                       </div>
                   </a>
               </li> --}}







           </ul>

       </nav>

   </div>
   <!--  END SIDEBAR  -->
