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
                <div class="profile cursor-pointer">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ9-9fq8t1B57qEsg1t_MXWRj4mqyC4lD15OQ&s"
                        alt="Profile 1" class="rounded-lg shadow-lg h-[100px] w-auto">
                    <p class="mt-2 text-lg font-medium">User 1</p>
                </div>
                <div class="profile cursor-pointer">
                    <img src="https://www.qcnews.com/wp-content/uploads/sites/109/2021/11/Ted-Midsize-for-Web-1.jpg?w=1280"
                        alt="Profile 2" class="rounded-lg shadow-lg h-[100px] w-auto">
                    <p class="mt-2 text-lg font-medium">User 2</p>
                </div>
                <div class="profile cursor-pointer">
                    <img src="https://pbs.twimg.com/media/FTJyFlQWUAEnV5m.jpg" alt="Profile 3"
                        class="rounded-lg shadow-lg h-[100px] w-auto">
                    <p class="mt-2 text-lg font-medium">User 3</p>
                </div>
                <div class="profile cursor-pointer flex flex-col items-center h-[100px] w-[100px] justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
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
@else
    <script>window.location.href = "{{ route('login') }}";</script>
@endif

</html>