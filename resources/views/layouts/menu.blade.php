<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ url('/') }}" class="app-brand-link">
            <span class="app-brand-logo demo w-100">
                <span style="">
                    <img src="{{asset('assets/img/1.png')}}" class="w-100" alt="logo" srcset="">
                </span>
            </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M11.4854 4.88844C11.0081 4.41121 10.2344 4.41121 9.75715 4.88844L4.51028 10.1353C4.03297 10.6126 4.03297 11.3865 4.51028 11.8638L9.75715 17.1107C10.2344 17.5879 11.0081 17.5879 11.4854 17.1107C11.9626 16.6334 11.9626 15.8597 11.4854 15.3824L7.96672 11.8638C7.48942 11.3865 7.48942 10.6126 7.96672 10.1353L11.4854 6.61667C11.9626 6.13943 11.9626 5.36568 11.4854 4.88844Z"
                    fill="currentColor" fill-opacity="0.6"/>
                <path
                    d="M15.8683 4.88844L10.6214 10.1353C10.1441 10.6126 10.1441 11.3865 10.6214 11.8638L15.8683 17.1107C16.3455 17.5879 17.1192 17.5879 17.5965 17.1107C18.0737 16.6334 18.0737 15.8597 17.5965 15.3824L14.0778 11.8638C13.6005 11.3865 13.6005 10.6126 14.0778 10.1353L17.5965 6.61667C18.0737 6.13943 18.0737 5.36568 17.5965 4.88844C17.1192 4.41121 16.3455 4.41121 15.8683 4.88844Z"
                    fill="currentColor" fill-opacity="0.38"/>
            </svg>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <li class="menu-item @if (Request::is('/')) active @endif ">
            <a href="{{ url('/') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-view-dashboard"></i>
                <div>Dashboard</div>
            </a>
        </li>
        @if(Auth::User()->role == 'Admin')
        <li class="menu-item  @if(in_array(Request::getRequestUri(),['/residential', '/residential-block'])) active open @endif ">
            <a href="javascript:void(0);" class="menu-link menu-toggle waves-effect">
                <i class="menu-icon tf-icons mdi mdi-city"></i>
                <div>Perumahan</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @if (Request::is('residential')) active @endif">
            <a href="{{ route('residential.index') }}" class="menu-link">
                <div>Nama Perumahan</div>
            </a>
        </li>
        <li class="menu-item @if (Request::is('residential-block')) active @endif">
            <a href="{{ route('residentialblock.index') }}" class="menu-link">
                <div>Blok Perumahan</div>
            </a>
        </li>
            </ul>
        </li>

        <li class="menu-item @if (Request::is('device')) active @endif">
            <a href="{{ route('device.index') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-devices"></i>
                <div>Perangkat</div>
            </a>
        </li>
        @endif
        <li class="menu-item @if (Request::is('emergency-state')) active @endif ">
            <a href="{{ route('emergencyState.index') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-alert"></i>
                <div>Keadaan Darurat</div>
            </a>
        </li>
        <li class="menu-item @if (Request::is('emergency-report')) active @endif ">
            <a href="{{ route('emergencyReport.index') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-clipboard-text"></i>
                <div>Laporan</div>
            </a>
        </li>
        @if(Auth::User()->role == 'Admin')
        <li class="menu-item @if (Request::is('history-button')) active @endif ">
            <a href="{{ route('user.index') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-account"></i>
                <div>User</div>
            </a>
        </li>
        @endif

        <li class="menu-item">
            <a href="" class="menu-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="menu-icon tf-icons mdi mdi-logout"></i>
                <div>Sign Out</div>
            </a>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </ul>
</aside>
