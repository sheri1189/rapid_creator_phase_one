<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
     data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
     data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <a href="{{ route('dashboard.dashboard') }}">
            <img alt="Logo" src="{{ asset(env('SOFTWARE_LOGO')) }}"
                 class="h-40px app-sidebar-logo-default">
            <img alt="Logo" src="{{ asset(env('SOFTWARE_LOGO')) }}"
                 class="h-40px app-sidebar-logo-minimize">
        </a>

        <div id="kt_app_sidebar_toggle"
             class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate "
             data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
             data-kt-toggle-name="app-sidebar-minimize">
            <i class="fas fa-long-arrow-alt-left fs-3 rotate-180"><span class="path1"></span><span
                    class="path2"></span></i>
        </div>
    </div>
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
            <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true"
                 data-kt-scroll-activate="true" data-kt-scroll-height="auto"
                 data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
                 data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px"
                 data-kt-scroll-save-state="true" style="height: 113px;">
                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu"
                     data-kt-menu="true" data-kt-menu-expand="false">
                    <div class="menu-item pt-5">
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">Dashboard</span>
                        </div>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{ url('/dashboard') }}">
                            <span class="menu-icon">
                                <i class="fas fa-tachometer-alt fs-2"></i>
                                <span class="path1"></span>
                                <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Dashbord</span>
                        </a>
                    </div>
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="fas fa-images fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                            <span class="menu-title">Templates</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion" style="display: none; overflow: hidden;"
                             kt-hidden-height="250">
                            <div class="menu-item">
                                <a class="menu-link" href="{{ url('/template/create') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Add New Template</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="{{ url('/template') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">View Templates</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="menu-item pt-5">
                        <div class="menu-content"><span class="menu-heading fw-bold text-uppercase fs-7">Settings</span>
                        </div>
                    </div>
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="fas fa-font fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                            <span class="menu-title">Fonts</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion" style="display: none; overflow: hidden;"
                             kt-hidden-height="250">
                            <div class="menu-item">
                                <a class="menu-link" href="{{ url('/fonts/create') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Upload Font</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="{{ url('/fonts') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Manage Fonts</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="fas fa-file-csv fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                            <span class="menu-title">Csv Files</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion" style="display: none; overflow: hidden;"
                             kt-hidden-height="250">
                            <div class="menu-item">
                                <a class="menu-link" href="{{ url('/csv/create') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Upload CSV File</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="{{ url('/csv') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Manage Csv Files</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    @if(Auth::user()->is_admin==1)
                        <div class="menu-item pt-5">
                            <div class="menu-content"><span class="menu-heading fw-bold text-uppercase fs-7">Users Management</span>
                            </div>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="{{ url('/users') }}">
                            <span class="menu-icon">
                                <i class="fas fa-users fs-2"></i>
                                <span class="path1"></span>
                                <span class="path2"></span>
                                </i>
                            </span>
                                <span class="menu-title">Manage Users</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
