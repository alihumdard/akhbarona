<?php $prefixAdmin = 'admincpanel/';?>
<nav class="col-md-2 sidebar{{(Request::is($prefixAdmin.'article*') || Request::is($prefixAdmin.'file*') || Request::is($prefixAdmin.'comment*') || Request::is($prefixAdmin.'page*'))?'':' expanded'}}">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('/') ? 'active' : ''  }}" href="{{ route('dashboard') }}">
                    <i class="fas fa-home"></i>
                    <span>@lang('app.dashboard')</span>
                </a>
            </li>
            @if(Auth::user()->hasPermission(['category.manage']))
            <li class="nav-item">
                <a class="nav-link {{ Request::is($prefixAdmin.'category*') ? 'active' : ''  }}" href="{{ route('category.index') }}">
                    <i class="fa fa-list-alt"></i>
                    <span>@lang('app.categories')</span>
                </a>
            </li>
            @endif

            <li class="nav-item">
                <a class="nav-link {{ Request::is($prefixAdmin.'article*') ? 'active' : ''  }}" href="{{ route('article.index') }}">
                    <i class="fa fa-newspaper"></i>
                    <span>Articles</span>
                </a>
            </li>

            @if(Auth::user()->hasPermission(['comment.manage']))
            <li class="nav-item">
                <a class="nav-link {{ Request::is($prefixAdmin.'comment*') ? 'active' : ''  }}" href="{{ route('comment.index') }}">
                    <i class="fa fa-comment"></i>
                    <span>Comments</span>
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link {{ Request::is($prefixAdmin.'log*') ? 'active' : ''  }}" href="{{ route('log') }}">
                    <i class="fa fa-history"></i>
                    <span>Log activity</span>
                </a>
            </li>
            @if(Auth::user()->hasPermission(['page.manage']))
            <li class="nav-item">
                <a class="nav-link {{ Request::is($prefixAdmin.'page*') ? 'active' : ''  }}" href="{{ route('page.index') }}">
                    <i class="fa fa-list-ul"></i>
                    <span>Pages</span>
                </a>
            </li>
            @endif
            @if(Auth::user()->hasPermission(['roles.manage', 'permissions.manage']))
            <li class="nav-item">
                <a class="nav-link {{ Request::is($prefixAdmin.'admin-user*') ? 'active' : ''  }}" href="{{ route('user-admin.list') }}">
                    <i class="fas fa-users-cog"></i>
                    <span>Admin Account</span>
                </a>
            </li>
            @endif

            @if(Auth::user()->hasPermission(['roles.manage', 'permissions.manage']))
            <li class="nav-item">
                <a href="#roles-dropdown"
                   class="nav-link"
                   data-toggle="collapse"
                   aria-expanded="{{ Request::is($prefixAdmin.'role*') || Request::is($prefixAdmin.'permission*') ? 'true' : 'false' }}">
                    <i class="fas fa-users-cog"></i>
                    <span>@lang('app.roles_and_permissions')</span>
                </a>
                <ul class="{{ Request::is($prefixAdmin.'role*') || Request::is($prefixAdmin.'permission*') ? '' : 'collapse' }} list-unstyled sub-menu" id="roles-dropdown">
                    @if(Auth::user()->hasPermission('roles.manage'))
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is($prefixAdmin.'role*') ? 'active' : '' }}"
                           href="{{ route('role.index') }}">@lang('app.roles')</a>
                    </li>
                    @endif
                    @if(Auth::user()->hasPermission('permissions.manage'))
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is($prefixAdmin.'permission*') ? 'active' : '' }}"
                           href="{{ route('permission.index') }}">@lang('app.permissions')</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            @if(Auth::user()->hasPermission(['setting.manage']))
            <li class="nav-item">
                <a href="#setting-dropdown"
                   class="nav-link"
                   data-toggle="collapse"
                   aria-expanded="{{ Request::is($prefixAdmin.'setting*') ? 'true' : 'false' }}">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
                <ul class="{{ Request::is($prefixAdmin.'setting*') ? '' : 'collapse' }} list-unstyled sub-menu" id="setting-dropdown">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is($prefixAdmin.'setting/general*') ? 'active' : '' }}"
                           href="{{ route('setting.edit',['general']) }}">General</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is($prefixAdmin.'setting/cache*') ? 'active' : '' }}"
                           href="{{ route('setting.edit',['cache']) }}">Page Caching</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is($prefixAdmin.'setting/article*') ? 'active' : '' }}"
                           href="{{ route('setting.edit',['article']) }}">Articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is($prefixAdmin.'setting/comment*') ? 'active' : '' }}"
                           href="{{ route('setting.edit',['comment']) }}">Comment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is($prefixAdmin.'setting/email*') ? 'active' : '' }}"
                           href="{{ route('setting.edit',['email']) }}">Email</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is($prefixAdmin.'setting/analytic*') ? 'active' : '' }}"
                           href="{{ route('setting.edit',['analytic']) }}">Web Analytics</a>
                    </li>
                </ul>
            </li>
            @endif
        </ul>

    </div>
</nav>

