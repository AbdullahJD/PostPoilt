<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ URL('dashboard') }}"><i class="icon-speedometer"></i>Dashboard
                </a>
            </li>




            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-puzzle"></i>Post
                    </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ URL('post') }}"><i
                                class="icon-people"></i>Create Post
                            </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-puzzle"></i>Platforms
                    </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ URL('/settings/platforms') }}"><i
                                class="icon-user-follow"></i>Platforms</a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</div>
