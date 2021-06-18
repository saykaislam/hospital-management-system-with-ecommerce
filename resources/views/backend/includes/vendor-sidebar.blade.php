<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main</span>
                </li>
                <li class="{{Request::is('vendor/dashboard*') ? 'active' :''}}">
                    <a href="{{route('vendor.dashboard')}}"><i class="fe fe-home"></i> <span>Dashboard</span></a>
                </li>
                <li class="submenu {{Request::is('vendor/service-order*') ? 'active' :''}}">
                    <a href="#" class=" {{Request::is('vendor/service-order*') ? 'menudrop' :''}}"><i class="fa fa-shopping-basket mr-1"></i><span>Order List</span> <span class="menu-arrow"></span></a>
                    <ul style="display:{{Request::is('admin/service-order*') ? 'block' :'none'}};">
                        <li><a href="{{route('vendor.product.order')}}">Product Order</a></li>
                    </ul>
                </li>
                <li class="submenu {{Request::is('vendor/serviceProviderCategory*') || Request::is('vendor/serviceCategory*') || Request::is('vendor/serviceSubCategory*') ? 'active' :''}}">
                    <a href="#" class="{{Request::is('vendor/serviceProviderCategory*') || Request::is('vendor/serviceCategory*') || Request::is('vendor/serviceSubCategory*') ? 'menudrop' :''}}"><i class="fa fa-cart-arrow-down"></i><span>Shop</span> <span class="menu-arrow"></span></a>
                    <ul style="display:{{Request::is('admin/serviceProviderCategory*') || Request::is('admin/serviceCategory*') || Request::is('admin/serviceSubCategory*') || Request::is('admin/service*') ? 'block' :'none'}};">
                        <li><a href="{{route('vendor.products.index')}}">Products</a></li>
                        <li><a href="{{route('vendor.category.index')}}">Product Category</a></li>
                        <li><a href="{{route('vendor.subcategory.index')}}">Product Subcategory</a></li>
                        <li><a href="{{route('vendor.brands.index')}}">Product Brand</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
