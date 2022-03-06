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
                    <div class="pull-left"><i class="ti-cup"></i><span class="right-nav-text">Coupons</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="coupons" class="collapse" data-parent="#sidebarnav">
                    <li> <a href="{{route('admin.coupons')}}">Coupons</a> </li>

                </ul>
            </li>


            <!-- menu item ProductsReviews-->
            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#reviews">
                    <div class="pull-left"><i class="ti-pencil"></i><span class="right-nav-text">Reviews</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="reviews" class="collapse" data-parent="#sidebarnav">
                    <li> <a href="{{route('admin.reviews')}}">Reviews</a> </li>

                </ul>
            </li>

            <!-- menu item Customer-->
            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#customer">
                    <div class="pull-left"><i class="ti-user"></i><span class="right-nav-text">Customers</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="customer" class="collapse" data-parent="#sidebarnav">
                    <li> <a href="{{route('admin.customers')}}">Customers</a> </li>

                </ul>
            </li>

            <!-- menu item Customers Addresses-->
            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#customerAddress">
                    <div class="pull-left"><i class="ti-user"></i><span class="right-nav-text">Customers Addresses</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="customerAddress" class="collapse" data-parent="#sidebarnav">
                    <li> <a href="{{route('admin.customers_addresses')}}">Customers Addresses</a> </li>

                </ul>
            </li>
          <!-- menu item Country-->
            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#country">
                    <div class="pull-left"><i class="ti-world"></i><span class="right-nav-text">Countries</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="country" class="collapse" data-parent="#sidebarnav">
                    <li> <a href="{{route('admin.countries')}}">Countries</a> </li>

                </ul>
            </li>

          <!-- menu item State-->
            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#state">
                    <div class="pull-left"><i class="ti-map-alt"></i><span class="right-nav-text">States</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="state" class="collapse" data-parent="#sidebarnav">
                    <li> <a href="{{route('admin.states')}}">States</a> </li>

                </ul>
            </li>

          <!-- menu item City-->
            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#city">
                    <div class="pull-left"><i class="ti-location-pin"></i><span class="right-nav-text">Cities</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="city" class="collapse" data-parent="#sidebarnav">
                    <li> <a href="{{route('admin.cities')}}">Cities</a> </li>

                </ul>
            </li>


            <!-- menu item shipping companies-->
            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#shipping_companies">
                    <div class="pull-left"><i class="ti-shopping-cart"></i><span class="right-nav-text">Shipping Companies</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="shipping_companies" class="collapse" data-parent="#sidebarnav">
                    <li> <a href="{{route('admin.shipping_companies')}}">Shipping Companies</a> </li>

                </ul>
            </li>

            <!-- menu item payment methods-->
            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#payment_methods">
                    <div class="pull-left"><i class="ti-money"></i><span class="right-nav-text">Payment Methods</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="payment_methods" class="collapse" data-parent="#sidebarnav">
                    <li> <a href="{{route('admin.payment_methods')}}">Payment Methods</a> </li>

                </ul>
            </li>

            <!-- menu item account_settingd-->
            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#Account Settings">
                    <div class="pull-left"><i class="ti-settings"></i><span class="right-nav-text">Account Settings</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="Account Settings" class="collapse" data-parent="#sidebarnav">
                    <li> <a href="{{route('admin.account_settings')}}">Account Settings</a> </li>

                </ul>
            </li>



        </ul>
    </div>
</div>

<!-- Left Sidebar End-->
