<div class="navbar bg-base-100 bg-blue-950 shadow-sm">
    <div class="flex-1 text-white p-4">
        <a class="text-xl" href="{{ url('dashboard') }}">
            <b>{{ config('app.name') }}</b>
        </a><br />
        <small>Schools Division Office, General Trias City · Program <span class="text-warning">LABONG</span> · DEDP
            2026–2031</small>
    </div>
    <div class="flex-none">
        <div class="dropdown text-white">
            <small>Mainam na ARAL – Wastong ALAGA – Mabuting ASAL</small>
        </div>
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                <div class="avatar avatar-placeholder">
                    <div class="bg-neutral text-neutral-content w-8 rounded-full">
                        <span class="text-xs">{{ Auth::user()->initials }}</span>
                    </div>
                </div>
            </div>
            <ul tabindex="-1" class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
                <li><a href="{{ url('profile') }}">My Profile</a></li>
                <li><a href="{{ url('settings') }}">System Settings</a></li>
                <li><a href="{{ url('logout') }}">Logout</a></li>
            </ul>
        </div>
    </div>
</div>
