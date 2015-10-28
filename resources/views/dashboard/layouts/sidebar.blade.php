<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            @foreach (config('menu.admin') as $menu)
                <li {{ request()->segment(2) === $menu['slug'] ? 'class=active' : '' }}>
                    <a href="#">
                        <i class="fa fa-link"></i>
                        <span>{{ strtoupper($menu['name']) }}</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li {{ !request()->segment(3) && request()->segment(2) === $menu['slug'] ? 'class=active' : '' }}>
                            <a href="{{ url('dashboard/' . $menu['slug']) }}">All {{ $menu['name'] }}</a>
                        </li>
                        <li {{ strpos(request()->segment(3), 'create') !== false ? 'class=active' : '' }}>
                            <a href="{{ url('dashboard/' . $menu['slug'] . '/create') }}">Add New</a>
                        </li>
                        <li {{ strpos(request()->segment(3), 'trash') !== false ? 'class=active' : '' }}>
                            <a href="{{ url('dashboard/' . $menu['slug'] . '/trash') }}">Trash</a>
                        </li>
                    </ul>
                </li>
            @endforeach
        </ul>
    </section>
</aside>