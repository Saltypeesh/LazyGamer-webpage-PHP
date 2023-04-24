<x-layout>
    <div class="space d-md-none "></div>
    <div class="manage-area pt-3">
        <div class="container">

            <div class="main-panel">
                <div class="avatar-panel">
                    <div class="user-avatar mb-3">
                        <img style="border-radius: 30%" class="w-100"
                            src="{{ auth()->user()->profile_img ? asset('storage/' . auth()->user()->profile_img) : asset('icon/avatar.svg') }}"
                            alt="">
                    </div>
                    <div class="user-links">
                        <div class="title">
                            <span class="user-nickname">{{ auth()->user()->username }}</span>
                        </div>

                    </div>
                    <div class="profile-info-date mb-3">Member since:
                        {{ date('d M, Y', strtotime(auth()->user()->created_at)) }}</div>
                </div>
            </div>

            @yield('manage-content')

        </div>
    </div>
</x-layout>
