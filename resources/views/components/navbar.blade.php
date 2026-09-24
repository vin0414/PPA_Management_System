<div class="navbar bg-blue-950 shadow-sm flex flex-col sm:flex-row gap-2 sm:gap-0 p-4">
    <!-- Left Section: Branding -->
    <div class="flex-1 text-white w-full sm:w-auto">
        <a class="text-xl block" href="{{ url('/') }}">
            <b>{{ config('app.name') }}</b>
        </a>
        <small class="block mt-1 text-xs sm:text-sm text-slate-300">
            Schools Division Office, General Trias City · Program <span class="text-warning font-semibold">LABONG</span>
            · DEDP 2026–2031
        </small>
    </div>

    <!-- Right Section: Actions & Menu -->
    <div
        class="flex-none flex items-center justify-between sm:justify-end w-full sm:w-auto gap-4 border-t border-blue-900 pt-2 sm:pt-0 sm:border-t-0">
        <!-- Tagline: Hidden on mobile, visible on desktop -->
        <div class="hidden md:block text-white text-sm italic opacity-90">
            <small>Mainam na ARAL – Wastong ALAGA – Mabuting ASAL</small>
        </div>

        @guest
        <a href="{{ url('auth') }}"
            class="btn btn-outline border-white text-white hover:bg-white hover:text-blue-950 btn-sm ml-auto">Sign
            In</a>
        @endguest

        @auth
        <div class="dropdown dropdown-end ml-auto">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                <div class="avatar avatar-placeholder">
                    <div class="bg-neutral text-neutral-content w-8 rounded-full">
                        <span class="text-xs">{{ Auth::user()->initials }}</span>
                    </div>
                </div>
            </div>
            <!-- Increased z-index to ensure it floats over body content -->
            <ul tabindex="-1"
                class="menu menu-sm dropdown-content bg-base-100 rounded-box z-50 mt-3 w-52 p-2 shadow text-base-content">
                <li><a href="{{ url('profile') }}">My Profile</a></li>
                @if($permissions->role_name === "Super-admin")
                <li><a href="{{ url('settings') }}">System Settings</a></li>
                @endif
                <li><a href="{{ url('logout') }}">Logout</a></li>
            </ul>
        </div>
        @endAuth
    </div>
</div>