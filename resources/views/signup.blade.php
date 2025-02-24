<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-[#1c1c24] min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-[1200px] bg-[#13131a] rounded-3xl overflow-hidden shadow-2xl flex flex-col md:flex-row">
        <!-- Left Section -->
        <div class="w-full md:w-1/2 relative">
            <a href="/"
                class="absolute top-6 right-6 bg-white/10 backdrop-blur-sm text-white px-4 py-2 rounded-full text-sm hover:bg-white/20 transition-colors z-10">
                Back to website →
            </a>
            <div class="relative h-full">
                <img src="https://img.freepik.com/premium-photo/stack-money-coin-black-background-saving-money-concept_38477-1065.jpg"
                    alt="Desert landscape" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-purple-900/30"></div>
                <div class="absolute bottom-12 left-12 text-white">
                    <h2 class="text-2xl md:text-4xl font-semibold mb-2">Capturing Moments,</h2>
                    <h2 class="text-2xl md:text-4xl font-semibold">Creating Memories</h2>
                    <div class="flex gap-2 mt-6">
                        <div class="w-4 h-1 bg-white/30 rounded"></div>
                        <div class="w-4 h-1 bg-white/30 rounded"></div>
                        <div class="w-4 h-1 bg-white rounded"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Section -->
        <div class="w-full md:w-1/2 p-6 md:p-12">
            <div class="max-w-md mx-auto">
                <h1 class="text-white text-2xl md:text-4xl font-semibold mb-2">Create an account</h1>
                <p class="text-gray-400 mb-8">
                    Already have an account?
                    <a href="/login" class="text-white hover:underline">Log in</a>
                </p>

                <form action="/signup" method="POST" class="space-y-4">
                    @csrf
                    <div class="flex flex-col md:flex-row gap-4">
                        <input type="text" name="full_name" placeholder="Full name"
                            class="w-full md:w-1/2 bg-[#1c1c24] text-white rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-purple-600" required>
                        <input type="number" name="family_members" placeholder="Number of family members" required
                            class="w-full md:w-1/2 bg-[#1c1c24] text-white rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-purple-600">
                    </div>
                    <input type="number" name="my_income" placeholder="My Income" required
                        class="w-full bg-[#1c1c24] text-white rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-purple-600">
                    <input type="number" name="other_family_income" placeholder="Other Family Income" required
                        class="w-full bg-[#1c1c24] text-white rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-purple-600">
                    <input type="email" name="email" placeholder="Email" required
                        class="w-full bg-[#1c1c24] text-white rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-purple-600">
                    <div class="relative">
                        <input type="password" name="password" placeholder="Enter your password" required
                            class="w-full bg-[#1c1c24] text-white rounded-lg p-3 pr-10 focus:outline-none focus:ring-2 focus:ring-purple-600">
                    </div>
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" required
                            class="rounded bg-[#1c1c24] border-gray-600 text-purple-600 focus:ring-purple-600">
                        <span class="text-gray-400">I agree to the <a href="#" class="text-white hover:underline">Terms & Conditions</a></span>
                    </label>
                    <button type="submit"
                        class="w-full bg-purple-600 text-white rounded-lg p-3 hover:bg-purple-700 transition-colors">
                        Create account
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
