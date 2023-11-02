sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">JungleBook</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <?php

#User subadmin Permissions 
use App\Models\Adminrole;
$r1 = Route::getCurrentRoute()->getAction();
$r2 = Route::currentRouteAction();
$r3 = Route::currentRouteName();

$r4 = explode('@',$r2);

$permissions_string = Adminrole::where('role_uid',Auth::user()->role_uid)->value('permissions');

$permissions_array = explode(',', $permissions_string);

#end subadmin Permissions work
?>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <!-- <a href="{{ route('dashboard') }}"><li class="menu-label">Dashboard</li></a> -->
        @if( preg_match('/DashboardController/', $permissions_string) ||$permissions_string == '*')
        <li>
            <a href="{{ route('dashboard') }}">
                <div class="parent-icon"><i class="bx bxs-dashboard"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        @endif
        @if( preg_match('/FarmerController/', $permissions_string) || preg_match('/FpoController/', $permissions_string) || preg_match('/TraderController/', $permissions_string) || preg_match('/ProcessorController/', $permissions_string)||$permissions_string == '*')
       
        @if( preg_match('/ProcessorController/', $permissions_string) ||$permissions_string == '*')
               
               <li @if(Route::is('.index') || Route::is('processors.create') || Route::is('processors.edit')) class="mm-active" @endif> 
                   <a href="{{ route('processors.index') }}"><i class="bx bx-right-arrow-alt"></i>Tour Packages</a>
               </li>
               @endif
        @endif
         
        <li @if(Route::is('commodities.index') || Route::is('commodities.create') || Route::is('commodities.edit')) class="mm-active" @endif>
                    <a href="{{ route('commodities.index') }}"><i class="bx bx-right-arrow-alt"></i> Categories</a>
                </li>
        
        @if( preg_match('/NewsController/', $permissions_string) ||$permissions_string == '*')
        <!-- <li class="menu-label">News</li> -->
        <li @if(Route::is('news.index') || Route::is('news.create') || Route::is('news.edit')) class="mm-active" @endif>
            <a href="{{ route('news.index') }}">
                <i class="bx bx-right-arrow-alt"></i>News
            </a>
        </li>
        @endif
        @if( preg_match('/PopController/', $permissions_string) ||preg_match('/SectionController/', $permissions_string) ||$permissions_string == '*')
        <!-- <li class="menu-label">POP</li> -->
        @if( preg_match('/PopController/', $permissions_string) ||$permissions_string == '*')
                <li @if(Route::is('pops.index') || Route::is('pops.create') || Route::is('pops.edit')) class="mm-active" @endif>
                    <a href="{{ route('pops.index') }}">
                    <i class="bx bx-right-arrow-alt"></i>Slider

                     </a>
                </li>

                <li @if(Route::is('services.index') || Route::is('services.create') || Route::is('services.edit')) class="mm-active" @endif>
                    <a href="{{ route('services.index') }}">
                    <i class="bx bx-right-arrow-alt"></i>Services

                     </a>
                </li>

                <li @if(Route::is('pops.index') || Route::is('pops.create') || Route::is('pops.edit')) class="mm-active" @endif>
                    <a href="{{ route('fpos.index') }}">
                    <i class="bx bx-right-arrow-alt"></i>Testimonials

                     </a>
                </li>

                <li @if(Route::is('sections.index') || Route::is('sections.create') || Route::is('sections.edit')) class="mm-active" @endif>
                    <a href="{{ route('sections.index') }}">
                    <i class="bx bx-right-arrow-alt"></i>Static Pages

                     </a>
                </li>

                @endif
        @endif
 
        <!-- <li class="menu-label">Location</li> -->
        </ul>
    
    <!--end navigation-->
</div>
<!--end sidebar wrapper 