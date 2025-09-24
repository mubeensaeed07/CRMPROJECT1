
            <aside class="app-sidebar sticky" id="sidebar">

                <!-- Start::main-sidebar-header -->
                <div class="main-sidebar-header">
                    <a href="{{url('index')}}" class="header-logo">
                        <img src="{{asset('build/assets/images/brand-logos/desktop-logo.png')}}" alt="logo" class="desktop-logo">
                        <img src="{{asset('build/assets/images/brand-logos/toggle-logo.png')}}" alt="logo" class="toggle-logo">
                        <img src="{{asset('build/assets/images/brand-logos/desktop-dark.png')}}" alt="logo" class="desktop-dark">
                        <img src="{{asset('build/assets/images/brand-logos/toggle-dark.png')}}" alt="logo" class="toggle-dark">
                        <img src="{{asset('build/assets/images/brand-logos/desktop-white.png')}}" alt="logo" class="desktop-white">
                        <img src="{{asset('build/assets/images/brand-logos/toggle-white.png')}}" alt="logo" class="toggle-white">
                    </a>
                </div>
                <!-- End::main-sidebar-header -->

                <!-- Start::main-sidebar -->
                <div class="main-sidebar" id="sidebar-scroll">

                    <!-- Start::nav -->
                    <nav class="main-menu-container nav nav-pills flex-column sub-open">
                        <div class="slide-left" id="slide-left">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path> </svg>
                        </div>
                        <ul class="main-menu">
                            <!-- Start::slide__category -->
                            <li class="slide__category"><span class="category-name">Main</span></li>
                            <!-- End::slide__category -->

                            <!-- Start::CRM Dashboard -->
                            @auth
                            @if(Auth::user()->isSuperAdmin())
                            <li class="slide">
                                <a href="{{ route('superadmin.dashboard') }}" class="side-menu__item">
                                    <i class="bx bx-crown side-menu__icon"></i>
                                    <span class="side-menu__label">Super Admin</span>
                                </a>
                            </li>
                            @elseif(Auth::user()->isAdmin())
                            <li class="slide">
                                <a href="{{ route('admin.dashboard') }}" class="side-menu__item">
                                    <i class="bx bx-user-check side-menu__icon"></i>
                                    <span class="side-menu__label">Admin Dashboard</span>
                                </a>
                            </li>
                            @else
                            <li class="slide">
                                <a href="{{ route('user.dashboard') }}" class="side-menu__item">
                                    <i class="bx bx-user side-menu__icon"></i>
                                    <span class="side-menu__label">User Dashboard</span>
                                </a>
                            </li>
                            @endif
                            @endauth
                            <!-- End::CRM Dashboard -->

                            <!-- Start::slide -->
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">
                                    <i class="bx bx-home side-menu__icon"></i>
                                    <span class="side-menu__label">Dashboards<span class="badge bg-warning-transparent ms-2">12</span></span>
                                    <i class="fe fe-chevron-right side-menu__angle"></i>
                                </a>
                                <ul class="slide-menu child1">
                                    <li class="slide side-menu__label1">
                                        <a href="javascript:void(0);">Dashboards</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('index')}}" class="side-menu__item">CRM</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('index2')}}" class="side-menu__item">Ecommerce</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('index3')}}" class="side-menu__item">Crypto</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('index4')}}" class="side-menu__item">Jobs</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('index5')}}" class="side-menu__item">NFT</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('index6')}}" class="side-menu__item">Sales</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('index7')}}" class="side-menu__item">Analytics</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('index8')}}" class="side-menu__item">Projects</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('index9')}}" class="side-menu__item">HRM</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('index10')}}" class="side-menu__item">Stocks</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('index11')}}" class="side-menu__item">Courses</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('index12')}}" class="side-menu__item">Personal</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- End::slide -->

                            <!-- Start::slide__category -->
                            <li class="slide__category"><span class="category-name">Pages</span></li>
                            <!-- End::slide__category -->

                            <!-- Start::slide -->
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">
                                    <i class="bx bx-file-blank side-menu__icon"></i>
                                    <span class="side-menu__label">Pages<span class="badge bg-secondary-transparent ms-2">New</span></span>
                                    <i class="fe fe-chevron-right side-menu__angle"></i>
                                </a>
                                <ul class="slide-menu child1">
                                    <li class="slide side-menu__label1">
                                        <a href="javascript:void(0);">Pages</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('aboutus')}}" class="side-menu__item">About Us</a>
                                    </li>
                                    <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">Blog
                                            <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                        <ul class="slide-menu child2">
                                            <li class="slide">
                                                <a href="{{url('blog')}}" class="side-menu__item">Blog</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('blog-details')}}" class="side-menu__item">Blog Details</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('blog-create')}}" class="side-menu__item">Create Blog</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('chat')}}" class="side-menu__item">Chat</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('contacts')}}" class="side-menu__item">Contacts</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('contactus')}}" class="side-menu__item">Contact Us</a>
                                    </li>
                                    <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">Ecommerce
                                            <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                        <ul class="slide-menu child2">
                                            <li class="slide">
                                                <a href="{{url('add-products')}}" class="side-menu__item">Add Products</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('cart')}}" class="side-menu__item">Cart</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('checkout')}}" class="side-menu__item">Checkout</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('edit-products')}}" class="side-menu__item">Edit Products</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('order-details')}}" class="side-menu__item">Order Details</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('orders')}}" class="side-menu__item">Orders</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('products')}}" class="side-menu__item">Products</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('products-details')}}" class="side-menu__item">Product Details</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('products-list')}}" class="side-menu__item">Products List</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('wishlist')}}" class="side-menu__item">Wishlist</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">Email
                                            <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                        <ul class="slide-menu child2">
                                            <li class="slide">
                                                <a href="{{url('mail')}}" class="side-menu__item">Mail App</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('mail-settings')}}" class="side-menu__item">Mail Settings</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('empty-page')}}" class="side-menu__item">Empty</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('faqs')}}" class="side-menu__item">FAQ's</a>
                                    </li>
                                    <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">File Manager
                                            <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                        <ul class="slide-menu child2">
                                            <li class="slide">
                                                <a href="{{url('filemanager')}}" class="side-menu__item">File Manager</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">Invoice
                                            <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                        <ul class="slide-menu child2">
                                            <li class="slide">
                                                <a href="{{url('invoice-create')}}" class="side-menu__item">Create Invoice</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('invoice-details')}}" class="side-menu__item">Invoice Details</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('invoice-list')}}" class="side-menu__item">Invoice List</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('landing')}}" class="side-menu__item">Landing</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('landing-jobs')}}" class="side-menu__item">Jobs Landing<span class="badge bg-secondary-transparent ms-2">New</span></a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('notifications')}}" class="side-menu__item">Notifications</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('pricing')}}" class="side-menu__item">Pricing</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('profile')}}" class="side-menu__item">Profile</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('reviews')}}" class="side-menu__item">Reviews</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('teams')}}" class="side-menu__item">Teams</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('terms-conditions')}}" class="side-menu__item">Terms & Conditions</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('timeline')}}" class="side-menu__item">Timeline</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('todo-list')}}" class="side-menu__item">To Do List</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- End::slide -->

                            <!-- Start::slide -->
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">
                                    <i class="bx bx-task side-menu__icon"></i>
                                    <span class="side-menu__label">Task<span class="badge bg-secondary-transparent ms-2">New</span></span>
                                    <i class="fe fe-chevron-right side-menu__angle"></i>
                                </a>
                                <ul class="slide-menu child1">
                                    <li class="slide side-menu__label1">
                                        <a href="javascript:void(0);">Task</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('task-kanban-board')}}" class="side-menu__item">Kanban Board</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('task-listview')}}" class="side-menu__item">List View</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('task-details')}}" class="side-menu__item">Task Details</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- End::slide -->

                            <!-- Start::slide -->
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">
                                    <i class="bx bx-fingerprint side-menu__icon"></i>
                                    <span class="side-menu__label">Authentication</span>
                                    <i class="fe fe-chevron-right side-menu__angle"></i>
                                </a>
                                <ul class="slide-menu child1">
                                    <li class="slide side-menu__label1">
                                        <a href="javascript:void(0);">Authentication</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('comingsoon')}}" class="side-menu__item">Coming Soon</a>
                                    </li>
                                    <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">Create Password
                                            <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                        <ul class="slide-menu child2">
                                            <li class="slide">
                                                <a href="{{url('createpassword-basic')}}" class="side-menu__item">Basic</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('createpassword-cover')}}" class="side-menu__item">Cover</a>
                                            </li>
                                        </ul>
                                    </li>      
                                    <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">Lock Screen
                                            <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                        <ul class="slide-menu child2">
                                            <li class="slide">
                                                <a href="{{url('lockscreen-basic')}}" class="side-menu__item">Basic</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('lockscreen-cover')}}" class="side-menu__item">Cover</a>
                                            </li>
                                        </ul>
                                    </li>     
                                    <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">Reset Password
                                            <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                        <ul class="slide-menu child2">
                                            <li class="slide">
                                                <a href="{{url('resetpassword-basic')}}" class="side-menu__item">Basic</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('resetpassword-cover')}}" class="side-menu__item">Cover</a>
                                            </li>
                                        </ul>
                                    </li>     
                                    <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">Sign Up
                                            <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                        <ul class="slide-menu child2">
                                            <li class="slide">
                                                <a href="{{url('signup-basic')}}" class="side-menu__item">Basic</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('signup-cover')}}" class="side-menu__item">Cover</a>
                                            </li>
                                        </ul>
                                    </li>  
                                    <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">Sign In
                                            <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                        <ul class="slide-menu child2">
                                            <li class="slide">
                                                <a href="{{url('signin-basic')}}" class="side-menu__item">Basic</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('signin-cover')}}" class="side-menu__item">Cover</a>
                                            </li>
                                        </ul>
                                    </li> 
                                    <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">Two Step Verification
                                            <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                        <ul class="slide-menu child2">
                                            <li class="slide">
                                                <a href="{{url('twostep-verification-basic')}}" class="side-menu__item">Basic</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('twostep-verification-cover')}}" class="side-menu__item">Cover</a>
                                            </li>
                                        </ul>
                                    </li> 
                                    <li class="slide">
                                        <a href="{{url('under-maintenance')}}" class="side-menu__item">Under Maintenance</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- End::slide -->

                            <!-- Start::slide -->
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">
                                    <i class="bx bx-error side-menu__icon"></i>
                                    <span class="side-menu__label">Error</span>
                                    <i class="fe fe-chevron-right side-menu__angle"></i>
                                </a>
                                <ul class="slide-menu child1">
                                    <li class="slide side-menu__label1">
                                        <a href="javascript:void(0);">Error</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('error401')}}" class="side-menu__item">401 - Error</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('error404')}}" class="side-menu__item">404 - Error</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('error500')}}" class="side-menu__item">500 - Error</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- End::slide -->

                            <!-- Start::slide__category -->
                            <li class="slide__category"><span class="category-name">General</span></li>
                            <!-- End::slide__category -->

                            <!-- Start::slide -->
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">
                                    <i class="bx bx-box side-menu__icon"></i>
                                    <span class="side-menu__label">Ui Elements</span>
                                    <i class="fe fe-chevron-right side-menu__angle"></i>
                                </a>
                                <ul class="slide-menu child1 mega-menu">
                                    <li class="slide side-menu__label1">
                                        <a href="javascript:void(0);">Ui Elements</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('alerts')}}" class="side-menu__item">Alerts</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('badges')}}" class="side-menu__item">Badges</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('breadcrumbs')}}" class="side-menu__item">Breadcrumbs</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('buttons')}}" class="side-menu__item">Buttons</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('buttongroups')}}" class="side-menu__item">Button Groups</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('cards')}}" class="side-menu__item">Cards</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('dropdowns')}}" class="side-menu__item">Dropdowns</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('images-figures')}}" class="side-menu__item">Images & Figures</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('listgroups')}}" class="side-menu__item">List Groups</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('navs-tabs')}}" class="side-menu__item">Navs & Tabs</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('object-fit')}}" class="side-menu__item">Object Fit</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('paginations')}}" class="side-menu__item">Paginations</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('popovers')}}" class="side-menu__item">Popovers</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('progress')}}" class="side-menu__item">Progress</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('spinners')}}" class="side-menu__item">Spinners</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('toasts')}}" class="side-menu__item">Toasts</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('tooltips')}}" class="side-menu__item">Tooltips</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('typography')}}" class="side-menu__item">Typography</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- End::slide -->

                            <!-- Start::slide -->
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">
                                    <i class="bx bx-medal side-menu__icon"></i>
                                    <span class="side-menu__label">Utilities</span>
                                    <i class="fe fe-chevron-right side-menu__angle"></i>
                                </a>
                                <ul class="slide-menu child1">
                                    <li class="slide side-menu__label1">
                                        <a href="javascript:void(0);">Utilities</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('avatars')}}" class="side-menu__item">Avatars</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('borders')}}" class="side-menu__item">Borders</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('breakpoints')}}" class="side-menu__item">Breakpoints</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('colors')}}" class="side-menu__item">Colors</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('columns')}}" class="side-menu__item">Columns</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('flex')}}" class="side-menu__item">Flex</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('gutters')}}" class="side-menu__item">Gutters</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('helpers')}}" class="side-menu__item">Helpers</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('positions')}}" class="side-menu__item">Positions</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('more')}}" class="side-menu__item">Additional Content</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- End::slide -->

                            <!-- Start::slide -->
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">
                                    <i class="bx bx-file side-menu__icon"></i>
                                    <span class="side-menu__label">Forms</span>
                                    <i class="fe fe-chevron-right side-menu__angle"></i>
                                </a>
                                <ul class="slide-menu child1">
                                    <li class="slide side-menu__label1">
                                        <a href="javascript:void(0);">Forms</a>
                                    </li>
                                    <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">Form Elements
                                            <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                        <ul class="slide-menu child2">
                                            <li class="slide">
                                                <a href="{{url('form-inputs')}}" class="side-menu__item">Inputs</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('form-check-radios')}}" class="side-menu__item">Checks & Radios</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('form-input-groups')}}" class="side-menu__item">Input Groups</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('form-select')}}" class="side-menu__item">Form Select</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('form-range')}}" class="side-menu__item">Range Slider</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('form-input-masks')}}" class="side-menu__item">Input Masks</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('form-file-uploads')}}" class="side-menu__item">File Uploads</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('form-datetime-pickers')}}" class="side-menu__item">Date,Time Picker</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('form-color-pickers')}}" class="side-menu__item">Color Pickers</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('floating-labels')}}" class="side-menu__item">Floating Labels</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('form-layouts')}}" class="side-menu__item">Form Layouts</a>
                                    </li>
                                    <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">Form Editors
                                            <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                        <ul class="slide-menu child2">
                                            <li class="slide">
                                                <a href="{{url('quill-editor')}}" class="side-menu__item">Quill Editor</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('form-validations')}}" class="side-menu__item">Validations</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('form-select2')}}" class="side-menu__item">Select2</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- End::slide -->

                            <!-- Start::slide -->
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">
                                    <i class="bx bx-party side-menu__icon"></i>
                                    <span class="side-menu__label">Advanced Ui</span>
                                    <i class="fe fe-chevron-right side-menu__angle"></i>
                                </a>
                                <ul class="slide-menu child1">
                                    <li class="slide side-menu__label1">
                                        <a href="javascript:void(0);">Advanced Ui</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('accordions-collapse')}}" class="side-menu__item">Accordions & Collapse</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('carousel')}}" class="side-menu__item">Carousel</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('draggable-cards')}}" class="side-menu__item">Draggable Cards</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('modals-closes')}}" class="side-menu__item">Modals & Closes</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('navbars')}}" class="side-menu__item">Navbars</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('offcanvas')}}" class="side-menu__item">Offcanvas</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('placeholders')}}" class="side-menu__item">Placeholders</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('ratings')}}" class="side-menu__item">Ratings</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('scrollspy')}}" class="side-menu__item">Scrollspy</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('swiperjs')}}" class="side-menu__item">Swiper JS</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- End::slide -->

                            <!-- Start::slide -->
                            <li class="slide">
                                <a href="{{url('widgets')}}" class="side-menu__item">
                                    <i class="bx bx-gift side-menu__icon"></i>
                                    <span class="side-menu__label">Widgets<span class="badge bg-danger-transparent ms-2">Hot</span></span>
                                </a>
                            </li>
                            <!-- End::slide -->

                            <!-- Start::slide__category -->
                            <li class="slide__category"><span class="category-name">Web Apps</span></li>
                            <!-- End::slide__category -->

                            <!-- Start::slide -->
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">
                                    <i class="bx bx-grid-alt side-menu__icon"></i>
                                    <span class="side-menu__label">Apps<span class="badge bg-secondary-transparent ms-2">New</span></span>
                                    <i class="fe fe-chevron-right side-menu__angle"></i>
                                </a>
                                <ul class="slide-menu child1">
                                    <li class="slide side-menu__label1">
                                        <a href="javascript:void(0);">Apps</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('full-calendar')}}" class="side-menu__item">Full Calendar</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('gallery')}}" class="side-menu__item">Gallery</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('sweet-alerts')}}" class="side-menu__item">Sweet Alerts</a>
                                    </li>
                                    <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">Projects<span class="badge bg-secondary-transparent ms-2">New</span>
                                            <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                        <ul class="slide-menu child2">
                                            <li class="slide">
                                                <a href="{{url('projects-list')}}" class="side-menu__item">Projects List</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('projects-overview')}}" class="side-menu__item">Project Overview</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('projects-create')}}" class="side-menu__item">Create Project</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">Jobs<span class="badge bg-secondary-transparent ms-2">New</span>
                                            <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                        <ul class="slide-menu child2">
                                            <li class="slide">
                                                <a href="{{url('job-details')}}" class="side-menu__item">Job Details</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('job-company-search')}}" class="side-menu__item">Company Search</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('job-search')}}" class="side-menu__item">Job Search</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('job-post')}}" class="side-menu__item">Job Post</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('job-list')}}" class="side-menu__item">Job List</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('job-candidate-search')}}" class="side-menu__item">Search Candidate</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('job-candidate-details')}}" class="side-menu__item">Candidate Details</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">NFT<span class="badge bg-secondary-transparent ms-2">New</span>
                                            <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                        <ul class="slide-menu child2">
                                            <li class="slide">
                                                <a href="{{url('nft-marketplace')}}" class="side-menu__item">Market Place</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('nft-details')}}" class="side-menu__item">NFT Details</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('nft-create')}}" class="side-menu__item">Create NFT</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('nft-wallet-integration')}}" class="side-menu__item">Wallet Integration</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('nft-live-auction')}}" class="side-menu__item">Live Auction</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">CRM<span class="badge bg-secondary-transparent ms-2">New</span>
                                            <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                        <ul class="slide-menu child2">
                                            <li class="slide">
                                                <a href="{{url('crm-contacts')}}" class="side-menu__item">Contacts</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('crm-companies')}}" class="side-menu__item">Companies</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('crm-deals')}}" class="side-menu__item">Deals</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('crm-leads')}}" class="side-menu__item">Leads</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">Crypto<span class="badge bg-secondary-transparent ms-2">New</span>
                                            <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                        <ul class="slide-menu child2">
                                            <li class="slide">
                                                <a href="{{url('crypto-transactions')}}" class="side-menu__item">Transactions</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('crypto-currency-exchange')}}" class="side-menu__item">Currency Exchange</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('crypto-buy-sell')}}" class="side-menu__item">Buy & Sell</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('crypto-marketcap')}}" class="side-menu__item">Marketcap</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('crypto-wallet')}}" class="side-menu__item">Wallet</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <!-- End::slide -->

                            <!-- Start::slide -->
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">
                                    <i class="bx bx-layer side-menu__icon"></i>
                                    <span class="side-menu__label">Nested Menu</span>
                                    <i class="fe fe-chevron-right side-menu__angle"></i>
                                </a>
                                <ul class="slide-menu child1">
                                    <li class="slide side-menu__label1">
                                        <a href="javascript:void(0);">Nested Menu</a>
                                    </li>
                                    <li class="slide">
                                        <a href="javascript:void(0);" class="side-menu__item">Nested-1</a>
                                    </li>
                                    <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">Nested-2
                                            <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                        <ul class="slide-menu child2">
                                            <li class="slide">
                                                <a href="javascript:void(0);" class="side-menu__item">Nested-2-1</a>
                                            </li>
                                            <li class="slide has-sub">
                                                <a href="javascript:void(0);" class="side-menu__item">Nested-2-2
                                                    <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                                <ul class="slide-menu child3">
                                                    <li class="slide">
                                                        <a href="javascript:void(0);" class="side-menu__item">Nested-2-2-1</a>
                                                    </li>
                                                    <li class="slide">
                                                        <a href="javascript:void(0);" class="side-menu__item">Nested-2-2-2</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <!-- End::slide -->

                            <!-- Start::slide__category -->
                            <li class="slide__category"><span class="category-name">Tables & Charts</span></li>
                            <!-- End::slide__category -->

                            <!-- Start::slide -->
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">
                                    <i class="bx bx-table side-menu__icon"></i>
                                    <span class="side-menu__label">Tables<span class="badge bg-success-transparent ms-2">3</span></span>
                                    <i class="fe fe-chevron-right side-menu__angle"></i>
                                </a>
                                <ul class="slide-menu child1">
                                    <li class="slide side-menu__label1">
                                        <a href="javascript:void(0);">Tables</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('tables')}}" class="side-menu__item">Tables</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('grid-tables')}}" class="side-menu__item">Grid JS Tables</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('data-tables')}}" class="side-menu__item">Data Tables</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- End::slide -->

                            <!-- Start::slide -->
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">
                                    <i class="bx bx-bar-chart-square side-menu__icon"></i>
                                    <span class="side-menu__label">Charts</span>
                                    <i class="fe fe-chevron-right side-menu__angle"></i>
                                </a>
                                <ul class="slide-menu child1">
                                    <li class="slide side-menu__label1">
                                        <a href="javascript:void(0);">Charts</a>
                                    </li>
                                    <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">Apex Charts
                                            <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                        <ul class="slide-menu child2">
                                            <li class="slide">
                                                <a href="{{url('apex-line-charts')}}" class="side-menu__item">Line Charts</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('apex-area-charts')}}" class="side-menu__item">Area Charts</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('apex-column-charts')}}" class="side-menu__item">Column Charts</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('apex-bar-charts')}}" class="side-menu__item">Bar Charts</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('apex-mixed-charts')}}" class="side-menu__item">Mixed Charts</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('apex-rangearea-charts')}}" class="side-menu__item">Range Area Charts</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('apex-timeline-charts')}}" class="side-menu__item">Timeline Charts</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('apex-candlestick-charts')}}" class="side-menu__item">CandleStick
                                                    Charts</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('apex-boxplot-charts')}}" class="side-menu__item">Boxplot Charts</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('apex-bubble-charts')}}" class="side-menu__item">Bubble Charts</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('apex-scatter-charts')}}" class="side-menu__item">Scatter Charts</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('apex-heatmap-charts')}}" class="side-menu__item">Heatmap Charts</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('apex-treemap-charts')}}" class="side-menu__item">Treemap Charts</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('apex-pie-charts')}}" class="side-menu__item">Pie Charts</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('apex-radialbar-charts')}}" class="side-menu__item">Radialbar Charts</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('apex-radar-charts')}}" class="side-menu__item">Radar Charts</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{url('apex-polararea-charts')}}" class="side-menu__item">Polararea Charts</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('chartjs-charts')}}" class="side-menu__item">Chartjs Charts</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('echarts')}}" class="side-menu__item">Echart Charts</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- End::slide -->

                            <!-- Start::slide__category -->
                            <li class="slide__category"><span class="category-name">Maps & Icons</span></li>
                            <!-- End::slide__category -->

                            <!-- Start::slide -->
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">
                                    <i class="bx bx-map side-menu__icon"></i>
                                    <span class="side-menu__label">Maps</span>
                                    <i class="fe fe-chevron-right side-menu__angle"></i>
                                </a>
                                <ul class="slide-menu child1">
                                    <li class="slide side-menu__label1">
                                        <a href="javascript:void(0);">Maps</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('google-maps')}}" class="side-menu__item">Google Maps</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('leaflet-maps')}}" class="side-menu__item">Leaflet Maps</a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{url('vector-maps')}}" class="side-menu__item">Vector Maps</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- End::slide -->

                            <!-- Start::slide -->
                            <li class="slide">
                                <a href="{{url('icons')}}" class="side-menu__item">
                                    <i class="bx bx-store-alt side-menu__icon"></i>
                                    <span class="side-menu__label">Icons</span>
                                </a>
                            </li>
                            <!-- End::slide -->
                        </ul>
                        <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path> </svg></div>
                    </nav>
                    <!-- End::nav -->

                </div>
                <!-- End::main-sidebar -->

            </aside>