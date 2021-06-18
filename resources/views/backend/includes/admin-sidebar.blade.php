<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main</span>
                </li>
                <li class="{{Request::is('admin/dashboard*') ? 'active' :''}}">
                    <a href="{{route('admin.dashboard')}}"><i class="fe fe-home"></i> <span>Dashboard</span></a>
                </li>
                <li class="submenu {{Request::is('admin/service-order*') ? 'active' :''}}">
                    <a href="#" class=" {{Request::is('admin/service-order*') ? 'menudrop' :''}}"><i class="fa fa-shopping-basket mr-1"></i><span>Order List</span> <span class="menu-arrow"></span></a>
                    <ul style="display:{{Request::is('admin/service-order*') ? 'block' :'none'}};">
                        <li><a href="{{route('admin.service.order')}}">Service Order</a></li>
                    </ul>
                </li>
                <li class="submenu {{Request::is('admin/serviceProvider-list*') ? 'active' :''}}">
                    <a href="#" class=" {{Request::is('admin/serviceProvider-list*') ? 'menudrop' :''}}"><i class="fa fa-female"></i><span>Service Provider</span> <span class="menu-arrow"></span></a>
                    <ul style="display:{{Request::is('admin/serviceProvider-list*') ? 'block' :'none'}};">
                        <li><a href="{{route('admin.serviceProvider-list')}}">Service Provider List</a></li>
                        <li><a href="{{route('admin.serviceProvider.verification.image')}}">Verification Image</a></li>
                    </ul>
                </li>
                <li class="submenu {{Request::is('admin/user-list*') ? 'menu-open' :''}}">
                    <a href="#" class=""><i class="fa fa-users"></i><span>User</span> <span class="menu-arrow"></span></a>
                    <ul style="display:{{Request::is('admin/user-list*') ? 'block' :'none'}};">
                        <li><a href="{{route('admin.user-list')}}" class="{{Request::is('admin/user-list*') ? 'active' :''}}">User List</a></li>
                    </ul>
                </li>
                <li class="submenu {{Request::is('admin/serviceProviderCategory*') || Request::is('admin/serviceCategory*') || Request::is('admin/serviceSubCategory*') || Request::is('admin/service*') ? 'menu-open' :''}}">
                    <a href="#" ><i class="fa fa-list"></i><span>Service List</span> <span class="menu-arrow"></span></a>
                    <ul style="display:{{Request::is('admin/serviceProviderCategory*') || Request::is('admin/serviceCategory*') || Request::is('admin/serviceSubCategory*') || Request::is('admin/service*') ? 'block' :'none'}};">
                        <li><a href="{{route('admin.serviceProviderCategory.index')}}" class="{{Request::is('admin/serviceProviderCategory*') ? 'active' :''}}">Service Provider Category</a></li>
                        <li><a href="{{route('admin.serviceCategory.index')}}" class="{{Request::is('admin/serviceCategory*') ? 'active' :''}}">Service Category</a></li>
                        <li><a href="{{route('admin.serviceSubCategory.index')}}" class="{{Request::is('admin/serviceSubCategory*') ? 'active' :''}}">Service Sub-Category</a></li>
                        <li><a href="{{route('admin.services.index')}}" class="{{Request::is('admin/services*') ? 'active' :''}}">Service</a></li>
                    </ul>
                </li>
                <li class="submenu {{Request::is('admin/clinicCategory*') || Request::is('clinic-lis*') || Request::is('clinic-verification-image*') ? 'menu-open' :''}}">
                    <a href="#"><i class="fa fa-hospital-o"></i><span>Clinic Management</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{route('admin.clinicCategory.index')}}" class="{{Request::is('admin/clinicCategory*') ? 'active' :''}}">Clinic Category </a></li>
                        <li><a href="{{route('admin.clinic-list')}}" class="{{Request::is('clinic-list*') ? 'active' :''}}">Clinic List</a></li>
                        <li><a href="{{route('admin.clinic.verification.image')}}" class="{{Request::is('clinic-verification-image*') ? 'active' :''}}">Clinic Verification Image</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fa fa-user-md"></i><span>Doctors</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{route('admin.DoctorSpeciality.index')}}"> Doctor Speciality </a></li>
                        <li><a href="{{route('admin.clinic-doctor-list')}}">Clinic Doctor List</a></li>
                        <li><a href="{{route('admin.Doctor.index')}}"> Doctor </a></li>
                    </ul>
                </li>
                <li class="submenu {{Request::is('admin/relatedQuestions*') ? 'active' :''}}">
                    <a href="#" class="{{Request::is('admin/relatedQuestions*') ? 'menudrop' :''}}"><i class="fa fa-quora"></i><span>Question</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{route('admin.users.question.list')}}"> User Question </a></li>
                        <li><a href="{{route('admin.relatedQuestions.index')}}"> Related Question </a></li>
                    </ul>
                </li>
                <li class="submenu {{Request::is('admin/test*') ? 'active' :''}}">
                    <a href="#" class="{{Request::is('admin/test*') ? 'menudrop' :''}}"><i class="fa fa-flask"></i><span>Lab Test</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{route('admin.tests.index')}}"> List </a></li>
                        <li><a href="{{route('admin.tests.create')}}"> Create </a></li>
                    </ul>
                </li>
                 <li class="submenu {{Request::is('admin/health-tips*') ? 'active' :''}}">
                    <a href="#" class="{{Request::is('admin/health-tips*') ? 'menudrop' :''}}"><i class="fa fa-heartbeat fa-1x"></i><span>Health Tips</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{route('admin.health-tips-category.index')}}"> Health Tips Category </a></li>
                        <li><a href="{{route('admin.health-tips-list.index')}}"> Health Tips List </a></li>
                    </ul>
                </li>
                <li class="submenu {{Request::is('admin/banner*') ? 'active' :''}}">
                    <a href="#" class="{{Request::is('admin/banner*') ? 'menudrop' :''}}"><i class="fa fa-flask"></i><span>Banner</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{route('admin.banner.index')}}"> List </a></li>
                        <li><a href="{{route('admin.banner.create')}}"> Create </a></li>
                    </ul>
                </li>
                <li class="submenu {{Request::is('admin/profile*') ? 'menu-open' :''}}">
                    <a href="#" class=""><i class="fa fa-user-circle"></i><span>Admin</span> <span class="menu-arrow"></span></a>
                    <ul style="display:{{Request::is('admin/profile*') ? 'block' :'none'}};">
                        <li><a href="{{route('admin.profile.index')}}" class="{{Request::is('admin/profile*') ? 'active' :''}}">Profile</a></li>
                        <li><a href="{{route('admin.shop.index')}}" class="{{Request::is('admin/shop*') ? 'active' :''}}">Admin Shop</a></li>
                        <li><a href="{{route('admin.payment.history')}}" class="{{Request::is('admin/payment/history*') ? 'active' :''}}">Admin Payment History</a></li>
                    </ul>
                </li>
                <li class="submenu {{Request::is('admin/sellers*') || Request::is('admin/due-to-seller*') || Request::is('admin/due-to-admin*')  ? 'menu-open' :''}}">
                    <a href="#" class=""><i class="fa fa-users"></i><span>Seller</span> <span class="menu-arrow"></span></a>
                    <ul style="display:{{Request::is('admin/sellers*') ? 'block' :'none'}};">
                        <li><a href="{{route('admin.sellers.index')}}" class="{{Request::is('admin/sellers/list*') ? 'active' :''}}">Seller List</a></li>
                        <li><a href="{{route('admin.seller.payment.history')}}" class="{{Request::is('admin/sellers/payment/history*') ? 'active' :''}}">Seller Payment History</a></li>
                        <li><a href="{{route('admin.due-to-seller')}}" class="{{Request::is('admin/due-to-seller*') ? 'active' :''}}">Due To Seller</a></li>
                        <li><a href="{{route('admin.due-to-admin')}}" class="{{Request::is('admin/due-to-admin*') ? 'active' :''}}">Due To Admin</a></li>
                    </ul>
                </li>
                <li class="submenu {{Request::is('admin/products*') || Request::is('admin/category*') || Request::is('admin/subcategory*') || Request::is('admin/subsubcategory*') || Request::is('admin/brands*') || Request::is('admin/attributes*') || Request::is('admin/seller-requested-products*') || Request::is('admin/advertisements*') ? 'menu-open' :''}}">
                    <a href="#" class=""><i class="fa fa-cart-arrow-down"></i><span>Shop</span> <span class="menu-arrow"></span></a>
                    <ul style="display:{{Request::is('admin/serviceProviderCategory*') || Request::is('admin/serviceCategory*') || Request::is('admin/serviceSubCategory*') || Request::is('admin/service*') ? 'block' :'none'}};">
                        <li><a href="{{route('admin.products.index')}}" class="{{Request::is('admin/products*') ? 'active' :''}}">Products</a></li>
                        <li><a href="{{route('admin.category.index')}}" class="{{Request::is('admin/category*') ? 'active' :''}}">Product Category</a></li>
                        <li><a href="{{route('admin.subcategory.index')}}" class="{{Request::is('admin/subcategory*') ? 'active' :''}}">Product Subcategory</a></li>
                        <li><a href="{{route('admin.subsubcategory.index')}}" class="{{Request::is('admin/subsubcategory*') ? 'active' :''}}">Product Sub Subcategory</a></li>
                        <li><a href="{{route('admin.brands.index')}}" class="{{Request::is('admin/brands*') ? 'active' :''}}">Product Brand</a></li>
                        <li><a href="{{route('admin.attributes.index')}}" class="{{Request::is('admin/attributes*') ? 'active' :''}}">Product Attribute</a></li>
                        <li><a href="{{route('admin.seller-requested.products')}}" class="{{Request::is('admin/seller-requested-products*') ? 'active' :''}}">Seller Requested Products</a></li>

                        <li><a href="{{route('admin.all.seller.products')}}" class="{{Request::is('admin/all/seller/products*') ? 'active' :''}}">All Seller Products</a></li>
                        <li><a href="{{route('admin.advertisements.index')}}" class="{{Request::is('admin/advertisements*') ? 'active' :''}}">Advertisements</a></li>
                        <li><a href="{{route('admin.sliders.index')}}" class="{{Request::is('admin/sliders*') ? 'active' :''}}">Shop Sliders</a></li>
                    </ul>
                </li>
                <li class="submenu {{Request::is('admin/business*') ? 'active' :''}}">
                    <a href="#" class=" {{Request::is('admin/business*') ? 'menudrop' :''}}"><i class="fa fa-cogs"></i><span>Settings</span> <span class="menu-arrow"></span></a>
                    <ul style="display:{{Request::is('admin/business*') ? 'block' :'none'}};">
                        <li><a href="{{route('admin.business.index')}}">Business Settings</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.flash_deals.index')}}" class="nav-link {{Request::is('admin/flash_deals*') ? 'active' :''}}">
                        <i class="fa fa-{{Request::is('admin/flash_deals*') ? 'folder-open':'bolt'}} nav-icon"></i>
                        <p>Flash Deals</p>
                    </a>
                </li>
                @php
                    $new_orders = \App\Order::where('delivery_status','Pending')->where('view',0)->count();
                @endphp
                <li class="submenu {{(Request::is('admin/order*')) || Request::is('admin/all-orders*') ? 'menu-open' : ''}}">
                    <a href="#" class="">
                        <i class="fa fa-cart-arrow-down"></i>
                        <span>Order Management</span>
                        @if(!empty($new_orders))
                            <span class="badge badge-danger"> {{$new_orders}} New</span>
                        @endif
                        <span class="menu-arrow"></span>
                    </a>
                    <ul style="display:{{Request::is('admin/serviceProviderCategory*') || Request::is('admin/serviceCategory*') || Request::is('admin/serviceSubCategory*') || Request::is('admin/service*') ? 'block' :'none'}};">
                        <li><a href="{{route('admin.all.orders')}}" class="{{Request::is('admin/all-orders*') || Request::is('admin/orders*') ? 'active' :''}}">All Orders</a></li>
                        <li>
                            <a href="{{route('admin.order.pending')}}" class="{{Request::is('admin/order/pending*') ? 'active' :''}}">
                                Pending Order
                                @if(!empty($new_orders))
                                    <span class="right badge badge-danger">New ({{$new_orders}})</span>
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.order.on-reviewed')}}" class="{{Request::is('admin/order/on-reviewed*')  ? 'active' :''}}">
                                On Reviewed Order
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.order.on-delivered')}}" class="{{Request::is('admin/order/on-delivered*')  ? 'active' :''}}">
                                On Delivered Order
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.order.delivered')}}" class="{{Request::is('admin/order/delivered*')  ? 'active' :''}}">
                                Delivered Order
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.order.completed')}}" class="{{Request::is('admin/order/completed*')  ? 'active' :''}}">
                                Completed Order
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.order.canceled')}}" class="{{Request::is('admin/order/canceled*')  ? 'active' :''}}">
                                Cancel Order
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.daily-orders')}}" class="{{Request::is('admin/order/daily-orders*')  ? 'active' :''}}">
                                Daily Order
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="">
                    <a href="{{route('admin.product-reviews')}}" class="{{Request::is('admin/product-reviews*') ? 'active' :''}}"><i class="fa fa-star"></i><span>Product Reviews</span> </a>
                </li>
                <li class="">
                    <a href="{{route('admin.seller-order-report')}}" class="{{Request::is('admin/seller-order-report*') ? 'active' :''}}"><i class="fa fa-list"></i><span>Seller Order Report</span> </a>
                </li>
                <li class="">
                    <a href="{{route('admin.top-rated-shop')}}" class="{{Request::is('admin/seller-order-report*') ? 'active' :''}}"><i class="fa fa-shopping-bag"></i><span>Top Rated Shop</span> </a>
                </li>
                <li class="">
                    <a href="{{route('admin.top-users')}}" class="{{Request::is('admin/top-users*') ? 'active' :''}}"><i class="fa fa-users"></i><span>Top Users</span> </a>
                </li>
                <li class="">
                    <a href="{{route('admin.blogs.index')}}" class="{{Request::is('admin/blogs*') ? 'active' :''}}"><i class="fa fa-newspaper-o"></i><span>Blogs</span> </a>
                </li>
                <li class="">
                    <a href="{{route('admin.shop_pages.index')}}" class="{{Request::is('admin/shop_pages*') ? 'active' :''}}"><i class="fa fa-newspaper-o"></i><span>Shop Pages</span> </a>
                </li>
                <li class="">
                    <a href="{{route('admin.site.optimize')}}" class="{{Request::is('admin/site-optimize*') ? 'active' :''}}"><i class="fa fa-cog"></i><span>Site Optimize</span> </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
