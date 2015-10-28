<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            @foreach (config('menu.admin') as $menu)
                <li {{ (request()->segment(2) === $menu['slug']) || (isset($menu['submenu']) &&
                    collect($menu['submenu'])->contains('slug', request()->segment(2))) ? 'class=active' : '' }}>
                    <a href="#">
                        <i class="fa fa-link"></i>
                        <span>{{ strtoupper($menu['name']) }}</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li {{ request()->segment(2) === $menu['slug'] ? 'class=active' : '' }}>
                            <a href="{{ url('dashboard/' . $menu['slug']) }}">All {{ $menu['name'] }}</a>
                        </li>
                        @if (isset($menu['submenu']))
                            @foreach ($menu['submenu'] as $submenu)
                                <li {{ request()->segment(2) === $submenu['slug'] ? 'class=active' : '' }}>
                                    <a href="{{ url('dashboard/' . $submenu['slug']) }}">{{ $submenu['name'] }}</a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </li>
            @endforeach
        </ul>
    </section>
</aside>