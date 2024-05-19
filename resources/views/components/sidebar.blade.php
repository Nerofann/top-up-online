<div class="main-sidebar">
    <div class="main-menu">
        <ul class="sidebar-menu scrollable">
            @foreach ($sidebarShow as $item)
                <li class="sidebar-item">
                    <a role="button" class="sidebar-link-group-title has-sub">{{ $item['title'] }}</a>
                    <ul class="sidebar-link-group">
                        @foreach ($item['child'] as $child)
                            <li class="sidebar-dropdown-item">
                                <a href="{{ route($child['cRoute']) }}" class="sidebar-link">
                                    <span class="nav-icon"><i class="{{ $child['cIcon'] }}"></i></span> 
                                    <span class="sidebar-txt">{{ $child['cTitle'] }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
            {{-- <li class="sidebar-item">
                <a role="button" class="sidebar-link-group-title has-sub">Apps</a>
                <ul class="sidebar-link-group">
                    <li class="sidebar-dropdown-item">
                        <a role="button" class="sidebar-link has-sub" data-dropdown="crmDropdown"><span class="nav-icon"><i class="fa-light fa-user-headset"></i></span> <span class="sidebar-txt">CRM</span></a>
                        <ul class="sidebar-dropdown-menu" id="crmDropdown">
                            <li class="sidebar-dropdown-item"><a href="audience.html" class="sidebar-link">Target Audience</a></li>
                            <li class="sidebar-dropdown-item"><a href="company.html" class="sidebar-link">Company</a></li>
                            <li class="sidebar-dropdown-item"><a href="task.html" class="sidebar-link">Task</a></li>
                            <li class="sidebar-dropdown-item"><a href="leads.html" class="sidebar-link">Leads</a></li>
                            <li class="sidebar-dropdown-item"><a href="customer.html" class="sidebar-link">Customer</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-dropdown-item">
                        <a role="button" class="sidebar-link has-sub" data-dropdown="hrmDropdown"><span class="nav-icon"><i class="fa-light fa-user-tie"></i></span> <span class="sidebar-txt">HRM</span></a>
                        <ul class="sidebar-dropdown-menu" id="hrmDropdown">
                            <li class="sidebar-dropdown-item"><a href="add-employee.html" class="sidebar-link">Add Employee</a></li>
                            <li class="sidebar-dropdown-item"><a href="all-employee.html" class="sidebar-link">All Employee</a></li>
                            <li class="sidebar-dropdown-item"><a href="attendance.html" class="sidebar-link">Attendance</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-dropdown-item">
                        <a role="button" class="sidebar-link has-sub" data-dropdown="ecommerceDropdown"><span class="nav-icon"><i class="fa-light fa-cart-shopping-fast"></i></span> <span class="sidebar-txt">eCommerce</span></a>
                        <ul class="sidebar-dropdown-menu" id="ecommerceDropdown">
                            <li class="sidebar-dropdown-item"><a href="all-customer.html" class="sidebar-link">All Customer</a></li>
                            <li class="sidebar-dropdown-item"><a href="add-product.html" class="sidebar-link">Add Product</a></li>
                            <li class="sidebar-dropdown-item"><a href="all-product.html" class="sidebar-link">All Product</a></li>
                            <li class="sidebar-dropdown-item"><a href="category.html" class="sidebar-link">Category</a></li>
                            <li class="sidebar-dropdown-item"><a href="order.html" class="sidebar-link">Order</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-dropdown-item">
                        <a href="calendar.html" class="sidebar-link"><span class="nav-icon"><i class="fa-light fa-calendar"></i></span> <span class="sidebar-txt">Calendar</span></a>
                    </li>
                    <li class="sidebar-dropdown-item">
                        <a href="chat.html" class="sidebar-link"><span class="nav-icon"><i class="fa-light fa-messages"></i></span> <span class="sidebar-txt">Chat</span></a>
                    </li>
                    <li class="sidebar-dropdown-item">
                        <a href="email.html" class="sidebar-link"><span class="nav-icon"><i class="fa-light fa-envelope"></i></span> <span class="sidebar-txt">Email</span></a>
                    </li>
                    <li class="sidebar-dropdown-item">
                        <a role="button" class="sidebar-link has-sub" data-dropdown="ecommerceDropdown"><span class="nav-icon"><i class="fa-light fa-envelope-open-text"></i></span> <span class="sidebar-txt">Email Templates</span></a>
                        <ul class="sidebar-dropdown-menu" id="ecommerceDropdown">
                            <li class="sidebar-dropdown-item"><a href="card-declined.html" class="sidebar-link">Card Declined</a></li>
                            <li class="sidebar-dropdown-item"><a href="promotion.html" class="sidebar-link">Promotional</a></li>
                            <li class="sidebar-dropdown-item"><a href="subscription-confirm.html" class="sidebar-link">Subscription Confirm</a></li>
                            <li class="sidebar-dropdown-item"><a href="welcome-mail.html" class="sidebar-link">Welcome</a></li>
                            <li class="sidebar-dropdown-item"><a href="reset-password-mail.html" class="sidebar-link">Reset Password</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-dropdown-item">
                        <a href="invoices.html" class="sidebar-link"><span class="nav-icon"><i class="fa-light fa-file-invoice"></i></span> <span class="sidebar-txt">Invoices</span></a>
                    </li>
                    <li class="sidebar-dropdown-item">
                        <a href="contact.html" class="sidebar-link"><span class="nav-icon"><i class="fa-light fa-user-plus"></i></span> <span class="sidebar-txt">Contacts</span></a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a role="button" class="sidebar-link-group-title has-sub">Pages</a>
                <ul class="sidebar-link-group">
                    <li class="sidebar-dropdown-item">
                        <a role="button" class="sidebar-link has-sub" data-dropdown="authDropdown"><span class="nav-icon"><i class="fa-light fa-user-cog"></i></span> <span class="sidebar-txt">Authentication</span></a>
                        <ul class="sidebar-dropdown-menu" id="authDropdown">
                            <li class="sidebar-dropdown-item"><a href="login.html" class="sidebar-link">Login 01</a></li>
                            <li class="sidebar-dropdown-item"><a href="login-2.html" class="sidebar-link">Login 02</a></li>
                            <li class="sidebar-dropdown-item"><a href="login-3.html" class="sidebar-link">Login 03</a></li>
                            <li class="sidebar-dropdown-item"><a href="registration.html" class="sidebar-link">Registration 01</a></li>
                            <li class="sidebar-dropdown-item"><a href="registration-2.html" class="sidebar-link">Registration 02</a></li>
                            <li class="sidebar-dropdown-item"><a href="reset-password.html" class="sidebar-link">Reset Password</a></li>
                            <li class="sidebar-dropdown-item"><a href="update-password.html" class="sidebar-link">Update Password</a></li>
                            <li class="sidebar-dropdown-item"><a href="login-status.html" class="sidebar-link">Login Status</a></li>
                            <li class="sidebar-dropdown-item"><a href="account-deactivated.html" class="sidebar-link">Account Deactivated</a></li>
                            <li class="sidebar-dropdown-item"><a href="welcome.html" class="sidebar-link">Welcome</a></li>
                            <li class="sidebar-dropdown-item"><a href="email-verify.html" class="sidebar-link">Verify Email</a></li>
                            <li class="sidebar-dropdown-item"><a href="two-factor.html" class="sidebar-link">2 Factor Verification</a></li>
                            <li class="sidebar-dropdown-item"><a href="multi-step-signup.html" class="sidebar-link">Multi Step Signup</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-dropdown-item">
                        <a role="button" class="sidebar-link has-sub" data-dropdown="errorDropdown"><span class="nav-icon"><i class="fa-light fa-triangle-exclamation"></i></span> <span class="sidebar-txt">Error Pages</span></a>
                        <ul class="sidebar-dropdown-menu" id="errorDropdown">
                            <li class="sidebar-dropdown-item"><a href="error-400.html" class="sidebar-link">Error 400</a></li>
                            <li class="sidebar-dropdown-item"><a href="error-403.html" class="sidebar-link">Error 403</a></li>
                            <li class="sidebar-dropdown-item"><a href="error-404.html" class="sidebar-link">Error 404</a></li>
                            <li class="sidebar-dropdown-item"><a href="error-408.html" class="sidebar-link">Error 408</a></li>
                            <li class="sidebar-dropdown-item"><a href="error-500.html" class="sidebar-link">Error 500</a></li>
                            <li class="sidebar-dropdown-item"><a href="error-503.html" class="sidebar-link">Error 503</a></li>
                            <li class="sidebar-dropdown-item"><a href="error-504.html" class="sidebar-link">Error 504</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-dropdown-item">
                        <a role="button" class="sidebar-link has-sub" data-dropdown="userDropdown"><span class="nav-icon"><i class="fa-light fa-user"></i></span> <span class="sidebar-txt">User</span></a>
                        <ul class="sidebar-dropdown-menu" id="userDropdown">
                            <li class="sidebar-dropdown-item"><a href="view-profile.html" class="sidebar-link">View Profile</a></li>
                            <li class="sidebar-dropdown-item"><a href="edit-profile.html" class="sidebar-link">Edit Profile</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-dropdown-item">
                        <a role="button" class="sidebar-link has-sub" data-dropdown="additionalDropdown"><span class="nav-icon"><i class="fa-light fa-square-plus"></i></span> <span class="sidebar-txt">Additional</span></a>
                        <ul class="sidebar-dropdown-menu" id="additionalDropdown">
                            <li class="sidebar-dropdown-item"><a href="coming-soon.html" class="sidebar-link">Coming Soon 01</a></li>
                            <li class="sidebar-dropdown-item"><a href="coming-soon-2.html" class="sidebar-link">Coming Soon 02</a></li>
                            <li class="sidebar-dropdown-item"><a href="pricing-table.html" class="sidebar-link">Pricing Table 01</a></li>
                            <li class="sidebar-dropdown-item"><a href="pricing-table-2.html" class="sidebar-link">Pricing Table 02</a></li>
                            <li class="sidebar-dropdown-item"><a href="under-construction.html" class="sidebar-link">Under Construction</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-dropdown-item">
                        <a href="utility.html" class="sidebar-link"><span class="nav-icon"><i class="fa-light fa-layer-group"></i></span> <span class="sidebar-txt">Utility</span></a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a role="button" class="sidebar-link-group-title has-sub">Components</a>
                <ul class="sidebar-link-group">
                    <li class="sidebar-dropdown-item">
                        <a role="button" class="sidebar-link has-sub" data-dropdown="advanceUiDropdown"><span class="nav-icon"><i class="fa-light fa-layer-group"></i></span> <span class="sidebar-txt">Advance UI</span></a>
                        <ul class="sidebar-dropdown-menu" id="advanceUiDropdown">
                            <li class="sidebar-dropdown-item"><a href="sweet-alert.html" class="sidebar-link">Sweet Alert</a></li>
                            <li class="sidebar-dropdown-item"><a href="nestable-list.html" class="sidebar-link">Nestable List</a></li>
                            <li class="sidebar-dropdown-item"><a href="animation.html" class="sidebar-link">Animation</a></li>
                            <li class="sidebar-dropdown-item"><a href="swiper-slider.html" class="sidebar-link">Swiper Slider</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-dropdown-item">
                        <a href="form.html" class="sidebar-link"><span class="nav-icon"><i class="fa-light fa-memo-pad"></i></span> <span class="sidebar-txt">Forms</span></a>
                    </li>
                    <li class="sidebar-dropdown-item">
                        <a href="table.html" class="sidebar-link"><span class="nav-icon"><i class="fa-light fa-table"></i></span> <span class="sidebar-txt">Tables</span></a>
                    </li>
                    <li class="sidebar-dropdown-item">
                        <a href="charts.html" class="sidebar-link"><span class="nav-icon"><i class="fa-light fa-chart-simple"></i></span> <span class="sidebar-txt">Charts</span></a>
                    </li>
                    <li class="sidebar-dropdown-item">
                        <a href="icon.html" class="sidebar-link"><span class="nav-icon"><i class="fa-light fa-compass-drafting"></i></span> <span class="sidebar-txt">Icons</span></a>
                    </li>
                    <li class="sidebar-dropdown-item">
                        <a href="map.html" class="sidebar-link"><span class="nav-icon"><i class="fa-light fa-location-dot"></i></span> <span class="sidebar-txt">Maps</span></a>
                    </li>
                    <li class="sidebar-dropdown-item">
                        <a href="file-manager.html" class="sidebar-link"><span class="nav-icon"><i class="fa-light fa-folder-open"></i></span> <span class="sidebar-txt">File Manager</span></a>
                    </li>
                    <li class="sidebar-dropdown-item">
                        <a role="button" class="sidebar-link has-sub" data-dropdown="levelDropdown"><span class="nav-icon"><i class="fa-light fa-layer-group"></i></span> <span class="sidebar-txt">Multiple Level</span></a>
                        <ul class="sidebar-dropdown-menu" id="levelDropdown">
                            <li class="sidebar-dropdown-item"><a href="#" class="sidebar-link">Level 1</a></li>
                            <li class="sidebar-dropdown-item">
                                <a role="button" class="sidebar-link has-sub">Level 1</a>
                                <ul class="sidebar-dropdown-menu">
                                    <li class="sidebar-dropdown-item"><a href="#" class="sidebar-link">Level 2</a></li>
                                    <li class="sidebar-dropdown-item">
                                        <a role="button" class="sidebar-link has-sub">Level 2</a>
                                        <ul class="sidebar-dropdown-menu">
                                            <li class="sidebar-dropdown-item"><a href="#" class="sidebar-link">Level 3</a></li>
                                            <li class="sidebar-dropdown-item"><a href="#" class="sidebar-link">Level 3</a></li>
                                            <li class="sidebar-dropdown-item"><a href="#" class="sidebar-link">Level 3</a></li>
                                            <li class="sidebar-dropdown-item"><a href="#" class="sidebar-link">Level 3</a></li>
                                        </ul>
                                    </li>
                                    <li class="sidebar-dropdown-item"><a href="#" class="sidebar-link">Level 2</a></li>
                                    <li class="sidebar-dropdown-item"><a href="#" class="sidebar-link">Level 2</a></li>
                                </ul>
                            </li>
                            <li class="sidebar-dropdown-item"><a href="#" class="sidebar-link">Level 1</a></li>
                            <li class="sidebar-dropdown-item"><a href="#" class="sidebar-link">Level 1</a></li>
                        </ul>
                    </li>
                </ul>
            </li> --}}
            <li class="help-center">
                <h3>Help Center</h3>
                <p>We're an award-winning, forward thinking</p>
                <a href="#" class="btn btn-sm btn-light">Go to Help Center</a>
            </li>
        </ul>
    </div>
</div>