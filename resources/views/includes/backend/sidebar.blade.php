<!-- Left Sidebar start-->
<div class="side-menu-fixed">
    <div class="scrollbar side-menu-bg">
        <ul class="nav navbar-nav side-menu" id="sidebarnav">
            <!-- menu item Dashboard-->
            <li class=" {{ \Illuminate\Support\Facades\Request::is('admin/dashboard')?'active':''}} ">

                    <a href="{{route('dashboard')}}"><i class="ti-home"></i><span class="right-nav-text">Main </span></a>


            </li>
            <!-- menu title -->
            <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Sections </li>
            <!-- menu item Category-->
            <li class=" {{ \Illuminate\Support\Facades\Request::is('admin/categories/index') ? 'active': \Illuminate\Support\Facades\Request::is('admin/categories/create')?'active':''}} ">
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#categories">
                    <div class="pull-left"><i class="ti-palette"></i><span class="right-nav-text">Categories</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="categories" class="collapse {{ \Illuminate\Support\Facades\Request::is('admin/categories/index') ? 'show': \Illuminate\Support\Facades\Request::is('admin/categories/create')?'show':'' }}" data-parent="#sidebarnav">
                    <li class="{{ \Illuminate\Support\Facades\Request::is('admin/categories/index')?'active':''}}"><a href="{{route('admin.categories')}}">Categories</a></li>

                </ul>
            </li>
            <!-- menu item Tags-->
            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#tags">
                    <div class="pull-left"><i class="ti-calendar"></i><span class="right-nav-text">Tags</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="tags" class="collapse" data-parent="#sidebarnav">
                    <li> <a href="{{route('admin.tags')}}">Tags</a> </li>

                </ul>
            </li>

            <!-- menu item Products-->
            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#products">
                    <div class="pull-left"><i class="ti-calendar"></i><span class="right-nav-text">Products</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="products" class="collapse" data-parent="#sidebarnav">
                    <li> <a href="{{route('admin.products')}}">Products</a> </li>

                </ul>
            </li>

            <!-- menu item ProductsCoupons-->
            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#coupons">
                    <div class="pull-left"><i class="ti-calendar"></i><span class="right-nav-text">Coupons</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="coupons" class="collapse" data-parent="#sidebarnav">
                    <li> <a href="{{route('admin.coupons')}}">Coupons</a> </li>

                </ul>
            </li>

            <!-- menu item mailbox-->
            <li>
                <a href="mail-box.html"><i class="ti-email"></i><span class="right-nav-text">Mail box</span> <span class="badge badge-pill badge-warning float-right mt-1">HOT</span> </a>
            </li>
            <!-- menu item Charts-->
            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#chart">
                    <div class="pull-left"><i class="ti-pie-chart"></i><span class="right-nav-text">Charts</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="chart" class="collapse" data-parent="#sidebarnav">
                    <li> <a href="chart-js.html">Chart.js</a> </li>
                    <li> <a href="chart-morris.html">Chart morris </a> </li>
                    <li> <a href="chart-sparkline.html">Chart Sparkline</a> </li>
                </ul>
            </li>

            <!-- menu font icon-->
            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#font-icon">
                    <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">font icon</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="font-icon" class="collapse" data-parent="#sidebarnav">
                    <li> <a href="fontawesome-icon.html">font Awesome</a> </li>
                    <li> <a href="themify-icons.html">Themify icons</a> </li>
                    <li> <a href="weather-icon.html">Weather icons</a> </li>
                </ul>
            </li>
            <!-- menu title -->
            <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Widgets, Forms & Tables </li>
            <!-- menu item Widgets-->
            <li>
                <a href="widgets.html"><i class="ti-blackboard"></i><span class="right-nav-text">Widgets</span> <span class="badge badge-pill badge-danger float-right mt-1">59</span> </a>
            </li>
            <!-- menu item Form-->
            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#Form">
                    <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">Form & Editor</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="Form" class="collapse" data-parent="#sidebarnav">
                    <li> <a href="editor.html">Editor</a> </li>

                </ul>
            </li>
            <!-- menu item table -->
            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#table">
                    <div class="pull-left"><i class="ti-layout-tab-window"></i><span class="right-nav-text">data table</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="table" class="collapse" data-parent="#sidebarnav">
                    <li> <a href="data-html-table.html">Data html table</a> </li>
                    <li> <a href="data-local.html">Data local</a> </li>
                    <li> <a href="data-table.html">Data table</a> </li>
                </ul>
            </li>
            <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">More Pages</li>
            <!-- menu item Custom pages-->
            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#custom-page">
                    <div class="pull-left"><i class="ti-file"></i><span class="right-nav-text">Custom pages</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="custom-page" class="collapse" data-parent="#sidebarnav">
                    <li> <a href="projects.html">projects</a> </li>

                </ul>
            </li>
            <!-- menu item Authentication-->
            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#authentication">
                    <div class="pull-left"><i class="ti-id-badge"></i><span class="right-nav-text">Authentication</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="authentication" class="collapse" data-parent="#sidebarnav">
                    <li> <a href="login.html">login</a> </li>
                    <li> <a href="register.html">register</a> </li>
                    <li> <a href="lockscreen.html">Lock screen</a> </li>
                </ul>
            </li>
            <!-- menu item maps-->
            <li>
                <a href="maps.html"><i class="ti-location-pin"></i><span class="right-nav-text">maps</span> <span class="badge badge-pill badge-success float-right mt-1">06</span></a>
            </li>
            <!-- menu item timeline-->
            <li>
                <a href="timeline.html"><i class="ti-panel"></i><span class="right-nav-text">timeline</span> </a>
            </li>
            <!-- menu item Multi level-->
            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#multi-level"><div class="pull-left"><i class="ti-layers"></i><span class="right-nav-text">Multi level Menu</span></div><div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                <ul id="multi-level" class="collapse" data-parent="#sidebarnav">
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#auth">Level item 1<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                        <ul id="auth" class="collapse">
                            <li>
                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#login">Level item 1.1<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                                <ul id="login" class="collapse">
                                    <li>
                                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#invoice">level item 1.1.1<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                                        <ul id="invoice" class="collapse">
                                            <li> <a href="#">level item 1.1.1.1</a> </li>
                                            <li> <a href="#">level item 1.1.1.2</a> </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li> <a href="#">level item 1.2</a> </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#error">level item 2<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                        <ul id="error" class="collapse" >
                            <li> <a href="#">level item 2.1</a> </li>
                            <li> <a href="#">level item 2.2</a> </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>

<!-- Left Sidebar End-->
