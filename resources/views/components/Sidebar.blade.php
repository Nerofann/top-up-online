<div class="main-sidebar">
    <div class="main-menu">
        <ul class="sidebar-menu scrollable">
            @foreach ($sidebarShow as $item)
                <li class="sidebar-item">
                    <a role="button" class="sidebar-link-group-title has-sub">{{ $item['title'] }}</a>
                    <ul class="sidebar-link-group">
                        @foreach ($item['child'] as $child)
                            <li class="sidebar-dropdown-item">
                                <a href="{{ route($child['cRoute']['name'], ($child['cRoute']['params'] ?? [])) }}" class="sidebar-link">
                                    <span class="nav-icon"><i class="{{ $child['cIcon'] }}"></i></span> 
                                    <span class="sidebar-txt">{{ $child['cTitle'] }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
            <li class="help-center">
                <h3>Help Center</h3>
                <p>We're an award-winning, forward thinking</p>
                <a href="#" class="btn btn-sm btn-light">Go to Help Center</a>
            </li>
        </ul>
    </div>
</div>