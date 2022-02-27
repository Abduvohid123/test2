<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }} {{ request()->is("admin/audit-logs*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('audit_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.audit-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.auditLog.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('buxgalteriya_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/tolovlars*") ? "c-show" : "" }} {{ request()->is("admin/*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.buxgalteriya.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('tolovlar_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tolovlars.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tolovlars") || request()->is("admin/tolovlars/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-dollar-sign c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.tolovlar.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('chiqimlar_access')
                        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/qoshima-chiqimlars*") ? "c-show" : "" }} {{ request()->is("admin/boshqa-ishchilar-maoshlaris*") ? "c-show" : "" }}">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-hand-holding-usd c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.chiqimlar.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('qoshima_chiqimlar_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.qoshima-chiqimlars.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/qoshima-chiqimlars") || request()->is("admin/qoshima-chiqimlars/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-money-bill-alt c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.qoshimaChiqimlar.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('boshqa_ishchilar_maoshlari_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.boshqa-ishchilar-maoshlaris.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/boshqa-ishchilar-maoshlaris") || request()->is("admin/boshqa-ishchilar-maoshlaris/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-money-bill-alt c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.boshqaIshchilarMaoshlari.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('room_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.rooms.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/rooms") || request()->is("admin/rooms/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-door-closed c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.room.title') }}
                </a>
            </li>
        @endcan
        @can('fan_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.fans.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/fans") || request()->is("admin/fans/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-book-open c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.fan.title') }}
                </a>
            </li>
        @endcan
        @can('student_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.students.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/students") || request()->is("admin/students/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-user-graduate c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.student.title') }}
                </a>
            </li>
        @endcan
        @can('group_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.groups.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/groups") || request()->is("admin/groups/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.group.title') }}
                </a>
            </li>
        @endcan
        @can('add_teache_to_group_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.add-teache-to-groups.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/add-teache-to-groups") || request()->is("admin/add-teache-to-groups/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.addTeacheToGroup.title') }}
                </a>
            </li>
        @endcan
        @can('progol_system_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.progol-systems.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/progol-systems") || request()->is("admin/progol-systems/*") ? "c-active" : "" }}">
                    <i class="fa-fw far fa-calendar-check c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.progolSystem.title') }}
                </a>
            </li>
        @endcan
        @can('position_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.positions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/positions") || request()->is("admin/positions/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-align-left c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.position.title') }}
                </a>
            </li>
        @endcan
        @can('worker_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.workers.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/workers") || request()->is("admin/workers/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-people-carry c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.worker.title') }}
                </a>
            </li>
        @endcan
        @can('week_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.weeks.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/weeks") || request()->is("admin/weeks/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.week.title') }}
                </a>
            </li>
        @endcan
        @can('month_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.months.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/months") || request()->is("admin/months/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.month.title') }}
                </a>
            </li>
        @endcan
        @can('kashalok_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.kashaloks.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/kashaloks") || request()->is("admin/kashaloks/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.kashalok.title') }}
                </a>
            </li>
        @endcan
        @can('reklama_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.reklamas.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/reklamas") || request()->is("admin/reklamas/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.reklama.title') }}
                </a>
            </li>
        @endcan
        @can('ota_ona_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.ota-onas.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/ota-onas") || request()->is("admin/ota-onas/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.otaOna.title') }}
                </a>
            </li>
        @endcan
        @can('viloyatlar_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.viloyatlars.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/viloyatlars") || request()->is("admin/viloyatlars/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.viloyatlar.title') }}
                </a>
            </li>
        @endcan
        @can('tumanlar_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.tumanlars.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tumanlars") || request()->is("admin/tumanlars/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.tumanlar.title') }}
                </a>
            </li>
        @endcan
        @can('filial_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.filials.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/filials") || request()->is("admin/filials/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.filial.title') }}
                </a>
            </li>
        @endcan
        @can('sorovnoma_otkazish_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/sorovnomas*") ? "c-show" : "" }} {{ request()->is("admin/savol-types*") ? "c-show" : "" }} {{ request()->is("admin/savollars*") ? "c-show" : "" }} {{ request()->is("admin/javoblars*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.sorovnomaOtkazish.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('sorovnoma_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.sorovnomas.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/sorovnomas") || request()->is("admin/sorovnomas/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.sorovnoma.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('savol_type_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.savol-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/savol-types") || request()->is("admin/savol-types/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.savolType.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('savollar_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.savollars.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/savollars") || request()->is("admin/savollars/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-question c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.savollar.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('javoblar_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.javoblars.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/javoblars") || request()->is("admin/javoblars/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.javoblar.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.systemCalendar") }}" class="c-sidebar-nav-link {{ request()->is("admin/system-calendar") || request()->is("admin/system-calendar/*") ? "c-active" : "" }}">
                <i class="c-sidebar-nav-icon fa-fw fas fa-calendar">

                </i>
                {{ trans('global.systemCalendar') }}
            </a>
        </li>
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>