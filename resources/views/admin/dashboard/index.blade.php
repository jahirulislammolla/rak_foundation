<x-admin-layout>
<ul class="grow text-gray-700 overflow-y-auto px-2 print:hidden grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
    <li class="font-semibold">
        <div class="p-3 border border-dashed bg-sky-300">
            <a href="{{ url('dashboard') }}"
                class="h-8 flex items-center justify-between gap-2 cursor-pointer {{ Request::path() == 'admin' ? 'text-sky-700' : '' }}">
                <i class="w-5 text-center icon-home"></i>
                <span class="grow menu__title">Dashboard</span>
            </a>
        </div>
    </li>
    <li class="font-semibold">
        <div class="p-3 border border-dashed bg-sky-300">
            <a onclick="submenuToggle(this)" class="h-8 flex items-center justify-between gap-2 cursor-pointer">
                <i class="w-5 text-center icon-people"></i>
                <span class="grow menu__title">User</span>
                <i class="w-5 text-center icon-arrow-down"></i>
            </a>
            <ul class="hidden pl-2 py-1">
                <li class="pl-2 font-semibold">
                    <a href="{{ url('users') }}"
                        class="h-8 flex items-center justify-between gap-2 cursor-pointer {{ Request::path() == 'user' ? 'text-sky-700' : '' }}">
                        <i class="w-5 text-center icon-people"></i>
                        <span class="grow menu__title">User List</span>
                    </a>
                </li>
                <li class="pl-2 font-semibold">
                    <a href="{{ url('users/create') }}"
                        class="h-8 flex items-center justify-between gap-2 cursor-pointer {{ Request::path() == 'user/create' ? 'text-sky-700' : '' }}">
                        <i class="w-5 text-center icon-plus"></i>
                        <span class="grow menu__title">Add User</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    <li class="font-semibold">
        <div class="p-3 border border-dashed bg-sky-300">
            <a onclick="submenuToggle(this)" class="h-8 flex items-center justify-between gap-2 cursor-pointer">
                <i class="w-5 text-center icon-people"></i>
                <span class="grow menu__title">Roles</span>
                <i class="w-5 text-center icon-arrow-down"></i>
            </a>
            <ul class="hidden pl-2 py-1">
                <li class="pl-2 font-semibold">
                    <a href="{{ url('roles') }}"
                        class="h-8 flex items-center justify-between gap-2 cursor-pointer {{ Request::path() == 'roles' ? 'text-sky-700' : '' }}">
                        <i class="w-5 text-center icon-people"></i>
                        <span class="grow menu__title">Role List</span>
                    </a>
                </li>
                <li class="pl-2 font-semibold">
                    <a href="{{ url('roles/create') }}"
                        class="h-8 flex items-center justify-between gap-2 cursor-pointer {{ Request::path() == 'roles/create' ? 'text-sky-700' : '' }}">
                        <i class="w-5 text-center icon-plus"></i>
                        <span class="grow menu__title">Add Role</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    <li class="font-semibold">
        <div class="p-3 border border-dashed bg-sky-300">
            <a onclick="submenuToggle(this)" class="h-8 flex items-center justify-between gap-2 cursor-pointer">
                <i class="w-5 text-center icon-people"></i>
                <span class="grow menu__title">Permissions</span>
                <i class="w-5 text-center icon-arrow-down"></i>
            </a>
            <ul class="hidden pl-2 py-1">
                <li class="pl-2 font-semibold">
                    <a href="{{ url('permissions') }}"
                        class="h-8 flex items-center justify-between gap-2 cursor-pointer {{ Request::path() == 'permissions' ? 'text-sky-700' : '' }}">
                        <i class="w-5 text-center icon-people"></i>
                        <span class="grow menu__title">Permission List</span>
                    </a>
                </li>
                <li class="pl-2 font-semibold">
                    <a href="{{ url('permissions/create') }}"
                        class="h-8 flex items-center justify-between gap-2 cursor-pointer {{ Request::path() == 'permissions/create' ? 'text-sky-700' : '' }}">
                        <i class="w-5 text-center icon-plus"></i>
                        <span class="grow menu__title">Add Permission</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    <li class="font-semibold">
        <div class="p-3 border border-dashed bg-sky-300">
            <a href="{{ url('manage-publications') }}" class="h-8 flex items-center justify-between gap-2 cursor-pointer">
                <i class="fas fa-book w-5 text-center"></i>
                <span class="grow menu__title">Publications List</span>
            </a>
        </div>
    </li>
    <li class="font-semibold">
        <div class="p-3 border border-dashed bg-sky-300">
            <a href="{{ url('manage-profiles') }}" class="h-8 flex items-center justify-between gap-2 cursor-pointer">
                <i class="fas fa-user w-5 text-center"></i>
                <span class="grow menu__title">Profile List</span>
            </a>
        </div>
    </li>
    <li class="font-semibold">
        <div class="p-3 border border-dashed bg-sky-300">
            <a href="{{ url('manage-awards') }}" class="h-8 flex items-center justify-between gap-2 cursor-pointer">
                <i class="fas fa-trophy w-5 text-center"></i>
                <span class="grow menu__title">Award List</span>
            </a>
        </div>
    </li>
    <li class="font-semibold">
        <div class="p-3 border border-dashed bg-sky-300">
            <a href="{{ url('manage-educations') }}" class="h-8 flex items-center justify-between gap-2 cursor-pointer">
                <i class="fas fa-graduation-cap w-5 text-center"></i>
                <span class="grow menu__title">Education List</span>
            </a>
        </div>
    </li>
    <li class="font-semibold">
        <div class="p-3 border border-dashed bg-sky-300">
            <a href="{{ url('manage-leaderships') }}" class="h-8 flex items-center justify-between gap-2 cursor-pointer">
                <i class="fas fa-users w-5 text-center"></i>
                <span class="grow menu__title">Leadership List</span>
            </a>
        </div>
    </li>
    <li class="font-semibold">
        <div class="p-3 border border-dashed bg-sky-300">
            <a href="{{ url('manage-mentorships') }}" class="h-8 flex items-center justify-between gap-2 cursor-pointer">
                <i class="fas fa-hands-helping w-5 text-center"></i>
                <span class="grow menu__title">Mentorship List</span>
            </a>
        </div>
    </li>
    <li class="font-semibold">
        <div class="p-3 border border-dashed bg-sky-300">
            <a href="{{ url('manage-outreachs') }}" class="h-8 flex items-center justify-between gap-2 cursor-pointer">
                <i class="fas fa-bullhorn w-5 text-center"></i>
                <span class="grow menu__title">Outreach List</span>
            </a>
        </div>
    </li>
    <li class="font-semibold">
        <div class="p-3 border border-dashed bg-sky-300">
            <a href="{{ url('manage-teachings') }}" class="h-8 flex items-center justify-between gap-2 cursor-pointer">
                <i class="fas fa-chalkboard-teacher w-5 text-center"></i>
                <span class="grow menu__title">Teaching List</span>
            </a>
        </div>
    </li>
    <li class="font-semibold">
        <div class="p-3 border border-dashed bg-sky-300">
            <a href="{{ url('manage-professional-services') }}" class="h-8 flex items-center justify-between gap-2 cursor-pointer">
                <i class="fas fa-briefcase w-5 text-center"></i>
                <span class="grow menu__title">Professional Affiliation List</span>
            </a>
        </div>
    </li>
    <li class="pl-2 font-semibold">
        <div class="p-3 border border-dashed bg-sky-300">
            <a href="{{ url('manage-messages') }}" class="h-8 flex items-center justify-between gap-2 cursor-pointer">
                <i class="fas fa-envelope w-5 text-center"></i>
                <span class="grow menu__title">Message List</span>
            </a>
        </div>
    </li>

    @foreach ($menus as $menu)
    @can($menu->permission)
    <li class="font-semibold">
        <div class="p-3 border border-dashed bg-sky-300">
            <a href="{{ count($menu->submenu) ? '#' : url($menu->url) }}" onclick="submenuToggle(this)"
                class="h-8 flex items-center justify-between gap-2 cursor-pointer {{ Request::is($menu->url . '*') ? 'text-sky-700' : '' }}">
                <i class="w-5 text-center {{ $menu->icon }}"></i>
                <span class="grow menu__title">{{ $menu->title }}</span>
                @if (count($menu->submenu))
                <i class="w-5 text-center icon-arrow-down"></i>
                @endif
            </a>
            @if (count($menu->submenu))
            <ul class="hidden pl-2 py-1">
                @foreach ($menu->submenu as $submenu)
                @can($submenu->permission)
                <li class="pl-2 font-semibold">
                    <a href="{{ count($submenu->thirdmenu) ? '#' : url($submenu->url) }}"
                        onclick="submenuToggle(this)"
                        class="h-8 flex items-center justify-between gap-2 cursor-pointer {{ Request::path() == $submenu->url ? 'text-sky-700' : '' }}">
                        <i class="w-5 text-center {{ $submenu->icon }}"></i>
                        <span class="grow menu__title">{{ $submenu->title }}</span>
                        @if (count($submenu->thirdmenu))
                        <i class="w-5 text-center icon-arrow-down"></i>
                        @endif
                    </a>
                    @if (count($submenu->thirdmenu))
                    <ul class="hidden pl-2 py-1">
                        @foreach ($submenu->thirdmenu as $thirdmenu)
                        <li class="pl-2 font-semibold">
                            <a href="{{ url($thirdmenu->url) }}"
                                class="h-8 flex items-center justify-between gap-2 cursor-pointer {{ Request::path() == $thirdmenu->url ? 'text-sky-700' : '' }}">
                                <i class="w-5 text-center {{ $submenu->icon }}"></i>
                                <span class="grow menu__title">{{ $thirdmenu->title }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </li>
                @endcan
                @endforeach
            </ul>
            @endif
        </div>
    </li>
    @endcan
    @endforeach
</ul>
</x-admin-layout>