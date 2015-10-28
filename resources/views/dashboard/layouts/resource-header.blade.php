<div class="box-header">
    <ul class="nav nav-tabs">
        <li role="presentation" {{ !request()->segment(3) ? 'class=active' : '' }}>
            <a href="{{ url('dashboard/' . request()->segment(2)) }}">All</a>
        </li>
        <li role="presentation" {{ request()->segment(3) === 'trash' ? 'class=active' : '' }}>
            <a href="{{ url('dashboard/' . request()->segment(2) . '/trash') }}">Trash</a>
        </li>
    </ul>
</div>