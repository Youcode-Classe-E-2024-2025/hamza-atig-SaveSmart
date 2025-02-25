<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Selection</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .profile:hover {
            transform: scale(1.1);
            transition: transform 0.3s ease-in-out;
        }
    </style>
</head>
@if (auth()->check())

    <body class="bg-white flex flex-col items-center justify-center h-screen">
        <div class="text-center">
            <h1 class="text-4xl font-semibold mb-8">Select a Viewer</h1>
            <div class="flex gap-6 justify-center">
                @foreach (\App\Models\Profile::where('user_id', auth()->id())->get() as $profile)
                    <div class="profile cursor-pointer">
                        <img src="{{ asset('storage/' . $profile->avatar) }}" alt="{{ $profile->full_name }}"
                            class="rounded-lg shadow-lg h-[100px] w-auto">
                        <p class="mt-2 text-lg font-medium">{{ $profile->full_name }}</p>
                    </div>
                @endforeach
                <div id="addProfile"
                    class="profile cursor-pointer flex flex-col items-center h-[100px] w-[100px] justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </div>

                <div id="profileForm"
                    class="hidden fixed right-0 top-0 h-screen w-96 bg-white shadow-lg overflow-y-auto font-manrope">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <span class="text-[#64748B] font-semibold text-lg">Create Profile</span>
                            <div id="closeForm" class="cursor-pointer border rounded-[4px] p-1 hover:bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#64748B]" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                        </div>

                        <form action="/createprofile" method="POST" enctype="multipart/form-data" class="mt-6">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <label for="avatar" class="font-semibold">Profile Picture</label>
                            <input type="file" name="avatar" id="avatar"
                                class="w-full mt-1 border border-[#A0ABBB] p-2 rounded-[4px]">

                            <label for="full_name" class="font-semibold mt-4 block">Full Name</label>
                            <input type="text" name="full_name" id="full_name" placeholder="Enter full name"
                                class="w-full mt-1 border border-[#A0ABBB] p-2 rounded-[4px]">

                            <label for="password" class="font-semibold mt-4 block">Password</label>
                            <input type="password" name="password" id="password" placeholder="Enter password"
                                class="w-full mt-1 border border-[#A0ABBB] p-2 rounded-[4px]">

                            <button type="submit"
                                class="mt-6 w-full cursor-pointer rounded-[4px] bg-green-700 px-3 py-2 text-center font-semibold text-white hover:bg-green-800 transition">
                                Create Profile
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-10">
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="bg-red-600 text-white px-6 py-2 rounded-lg shadow-lg hover:bg-red-700 transition">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </body>

    <script>
        document.getElementById('addProfile').addEventListener('click', function () {
            var profileForm = document.getElementById('profileForm');
            profileForm.classList.toggle('hidden');
            profileForm.style.transform = 'translateX(100%)';
            profileForm.style.transition = 'transform 0.3s ease-in-out';
            requestAnimationFrame(function () {
                profileForm.style.transform = 'translateX(0)';
            });
        });
        document.querySelector('#closeForm').addEventListener('click', () => {
            var profileForm = document.getElementById('profileForm');
            profileForm.style.transform = 'translateX(0)';
            profileForm.style.transition = 'transform 0.3s ease-in-out';
            requestAnimationFrame(function () {
                profileForm.style.transform = 'translateX(100%)';
            });
            setTimeout(() => {
                profileForm.classList.toggle('hidden');
            }, 200);
        });
    </script>
@else
    <script>window.location.href = "{{ route('login') }}";</script>
@endif

</html>