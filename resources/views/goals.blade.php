<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SaveSmart Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <style>
        .sidebar {
            transition: transform 0.3s ease-in-out;
        }

        .chart-container {
            position: relative;
            height: 350px;
        }

        @keyframes slideIn {
            from {
                transform: translateX(-100px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .animate-slide-in {
            animation: slideIn 0.5s ease-out;
        }
    </style>
</head>

<body class="bg-gray-100 h-screen">
    <div id="sweetAlert"
        class="fixed top-0 left-0 w-full flex justify-center z-50 transform -translate-y-full transition-transform duration-500">
        @if (session('success') || session('error'))
            <div
                class="bg-{{ session('success') == 'Goal deleted successfully' || session('error') ? 'red-500' : 'green-500' }} shadow-lg rounded-lg m-4 max-w-md w-full overflow-hidden">
                <div class="flex items-center p-4">
                    <div class="flex-shrink-0 mr-4">
                        <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-white font-medium">{{ session('success') ? 'Success' : 'Error' }}</h3>
                        <p class="text-white opacity-90 text-sm">{{ session('success') ?? session('error') }}</p>
                    </div>
                    <button onclick="closeAlert()" class="text-white hover:text-gray-200 focus:outline-none">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="bg-white bg-opacity-30 h-1">
                    <div id="progressBar" class="bg-white h-1 w-full"></div>
                </div>
            </div>
        @endif
    </div>
    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 w-64 bg-blue-800 text-white p-4 z-10 sidebar">
        <div class="flex items-center space-x-3 mb-8">
            <i class="fas fa-piggy-bank text-3xl"></i>
            <span class="text-2xl font-bold">SaveSmart</span>
        </div>
        <nav class="space-y-2">
            <a href="/dash"
                class="flex items-center space-x-3 hover:bg-blue-700 p-3 rounded-lg transition duration-200">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="/goals" class="flex items-center space-x-3 bg-blue-700 p-3 rounded-lg transition duration-200">
                <i class="fas fa-bullseye"></i>
                <span>Goals</span>
            </a>
            <a href="#" class="flex items-center space-x-3 hover:bg-blue-700 p-3 rounded-lg transition duration-200">
                <i class="fas fa-chart-bar"></i>
                <span>Reports</span>
            </a>
        </nav>
        <div class="absolute bottom-0 pb-4">
            <div class="flex items-center space-x-3 bg-blue-700 p-3 rounded-lg transition duration-200">
                <img src="{{ asset('storage/' . session('avatar')) }}" class="w-8 h-8 rounded-full">
                <div>
                    <div class="text-sm font-medium">{{ session('full_name') }}</div>
                    <div class="text-xs text-gray-400 truncate">{{ auth()->user()->email }}</div>
                </div>
                <a href="/logout-profile" class="ml-auto text-red-500 hover:text-red-600">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="ml-64 flex-1 p-8">
        <!-- Header -->
        <header class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">My Goals</h1>
            <div class="flex space-x-3">
                <div class="relative">
                    <input type="text" placeholder="Search goals..."
                        class="bg-white pl-10 pr-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" />
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                <button id="view-toggle"
                    class="bg-indigo-100 text-indigo-600 px-4 py-2 rounded-lg font-medium hover:bg-indigo-200 transition-colors">
                    <i class="fas fa-th-large mr-2"></i>
                    Change View
                </button>
            </div>
        </header>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center mr-4">
                        <i class="fas fa-flag-checkered text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Active Goals</p>
                        <h3 class="text-2xl font-bold text-gray-800">
                            {{ \App\Models\Goal::where('status', 'active')->count() }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center mr-4">
                        <i class="fas fa-dollar-sign text-green-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Total Goal Amount</p>
                        <h3 class="text-2xl font-bold text-gray-800">
                            ${{ \App\Models\Goal::where('profile_id', session('profile_id'))->where('status', 'active')->sum('amount') }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-full bg-amber-100 flex items-center justify-center mr-4">
                        <i class="fas fa-trophy text-amber-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Completed Goals</p>
                        <h3 class="text-2xl font-bold text-gray-800">
                            {{ \App\Models\Goal::where('profile_id', session('profile_id'))->where('status', 'completed')->count() }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center mr-4">
                        <i class="fas fa-calendar-check text-purple-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Achievement Rate</p>
                        <h3 class="text-2xl font-bold text-gray-800">
                            @if (\App\Models\Goal::where('profile_id', session('profile_id'))->count() > 0)
                                {{ (\App\Models\Goal::where('profile_id', session('profile_id'))->count() > 0) ? ( (\App\Models\Goal::where('status', 'completed')->count() / \App\Models\Goal::where('profile_id', session('profile_id'))->count() ) * 50 ) : 0 }}%
                            @else
                                0%
                            @endif
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Two Columns Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Add Goal Form -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <h2 class="text-xl font-bold mb-6 text-gray-800">Add a New Goal</h2>

                    <form action="/addgoal" method="post" id="goal-form" enctype="multipart/form-data"
                        class="space-y-5">
                        @csrf
                        @error('avatar')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <!-- Goal Image Upload -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Goal Image</label>
                            <div class="flex items-center justify-center">
                                <label for="goal-image-upload" class="cursor-pointer">
                                    <div
                                        class="w-full h-40 bg-gray-100 border-2 border-dashed border-gray-300 rounded-lg flex flex-col items-center justify-center text-gray-500 hover:bg-gray-50 transition-colors">
                                        <div id="image-preview" class="w-full h-full flex items-center justify-center">
                                            <div class="text-center p-4">
                                                <i class="fas fa-image text-3xl mb-2"></i>
                                                <p class="text-sm">Upload goal image</p>
                                                <p class="text-xs mt-1">Click to browse or drag & drop</p>
                                            </div>
                                        </div>
                                    </div>
                                    <input id="goal-image-upload" name="avatar" type="file" accept="image/*"
                                        class="hidden" />
                                </label>
                            </div>
                        </div>

                        <div>
                            <label for="goal" class="block text-sm font-medium text-gray-700 mb-1">Goal
                                Name</label>
                            <input type="text" id="goal" name="goal" placeholder="What do you want to achieve?"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                        </div>

                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                            <select id="category" name="category"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                                <option value="savings">Savings</option>
                                <option value="investment">Investment</option>
                                <option value="debt">Debt Repayment</option>
                                <option value="education">Education</option>
                                <option value="travel">Travel</option>
                                <option value="health">Health & Fitness</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div>
                            <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">Target
                                Amount ($)</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500">$</span>
                                </div>
                                <input type="number" id="amount" name="amount" placeholder="0.00" min="0" step="0.01"
                                    class="w-full pl-8 pr-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                            </div>
                        </div>

                        <div>
                            <label for="target_date" class="block text-sm font-medium text-gray-700 mb-1">Target
                                Date</label>
                            <input type="date" id="target-date" name="target_date"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description
                                (Optional)</label>
                            <textarea id="description" name="description" rows="3"
                                placeholder="Why is this goal important to you?"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"></textarea>
                        </div>

                        <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-6 rounded-lg transition-colors flex items-center justify-center">
                            <i class="fas fa-plus mr-2"></i>
                            Add Goal
                        </button>
                    </form>
                </div>
            </div>

            <!-- Goal Progress Section -->
            <div class="lg:col-span-2">
                <!-- Progress Chart -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 mb-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-800">Goal Progress</h2>
                        <div>
                            <select class="bg-gray-100 text-gray-800 px-3 py-2 rounded-lg border-0 text-sm font-medium">
                                <option>This Month</option>
                                <option>Last 3 Months</option>
                                <option>This Year</option>
                                <option>All Time</option>
                            </select>
                        </div>
                    </div>
                    <div class="h-64">
                        <canvas id="progressChart"></canvas>
                    </div>
                </div>

                <!-- Goals List -->
                <div class="space-y-5 max-h-[300px] overflow-y-auto">
                    @foreach (\App\Models\Goal::where('profile_id', session('profile_id'))->orderBy('created_at', 'desc')->get() as $goal)
                                    <div
                                        class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 transition-all hover:shadow-md">
                                        <div class="flex">
                                            <!-- Goal Image/Avatar -->
                                            <div class="w-1/4 bg-indigo-100 h-50 relative">
                                                <img src="{{ asset('storage/' . $goal->avatar) }}" alt="Goal Image"
                                                    class="absolute inset-0 w-full h-full object-cover" />
                                                <div class="absolute top-2 left-2">
                                                    <span
                                                        class="inline-block px-2 py-1 text-xs font-medium bg-blue-600 text-white rounded-full">{{ $goal->category }}</span>
                                                </div>
                                            </div>

                                            <!-- Goal Content -->
                                            <div class="w-3/4 pl-6 pr-6">
                                                <div class="flex justify-between items-start mb-4 pt-4">
                                                    <div>
                                                        <h3 class="text-lg font-bold text-gray-800">{{ $goal->goal }}</h3>
                                                        <p class="text-sm text-gray-500 mt-1">{{ $goal->description }}</p>
                                                    </div>
                                                    <div class="flex space-x-2">
                                                        <button class="text-gray-400 hover:text-indigo-600 transition-colors">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </button>
                                                        <a href="/deletegoal/{{ $goal->id }}"
                                                            class="text-gray-400 hover:text-red-600 transition-colors">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="mb-4">
                                                    <div class="flex justify-between text-sm mb-1">
                                                        <span class="font-medium">Progress</span>
                                                        <span class="text-gray-600">${{ $goal->current_amount }} to
                                                            ${{ $goal->amount }}</span>
                                                    </div>
                                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                        <div class="bg-green-500 h-2.5 rounded-full"
                                                            style="{{ 'width: ' . ($goal->current_amount / $goal->amount) * 100 . '%' }}">
                                                        </div>
                                                    </div>
                                                    <div class="goal-card relative overflow-hidden rounded-2xl p-6">
                                                        <!-- Content Container -->
                                                        <div class="flex flex-col space-y-4">
                                                            <!-- Goal header shown in both states -->
                                                            <div class="flex items-center justify-between">
                                                                <h3 class="text-xl font-bold text-gray-800">
                                                                    <i class="fas fa-trophy text-amber-500 mr-2"></i>
                                                                    <span>Goal Progress</span>
                                                                </h3>

                                                                <div
                                                                    class="rounded-full bg-gray-100 px-3 py-1 text-sm font-medium text-gray-700">
                                                                    @if ($goal->status != 'completed')                                                                    
                                                                    ${{ $goal->amount }} Total
                                                                    @endif
                                                                    @if ($goal->status == 'completed')
                                                                    Completed
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <!-- Contribution Section -->
                                                            @if ($goal->status != 'completed')
                                                                                                    @php
                                                                                                        $lastBet = \App\Models\History::where('user_id', auth()->id())
                                                                                                            ->where('note', 'like', '%Contributed $% to goal: ' . $goal->goal)
                                                                                                            ->latest()
                                                                                                            ->first();
                                                                                                        $canContribute = !$lastBet || now()->diffInDays($lastBet->created_at) >= 1;
                                                                                                        $contributionAmount = intval($goal->amount / 10);
                                                                                                    @endphp

                                                                                                    <div id="contribute-section-{{ $goal->id }}" class="mt-2">
                                                                                                        @if ($canContribute)
                                                                                                            <div class="flex flex-col space-y-4">
                                                                                                                <div class="text-sm text-gray-600">
                                                                                                                    <i class="fas fa-info-circle mr-1"></i>
                                                                                                                    Ready to make progress? Contribute now!
                                                                                                                </div>

                                                                                                                <a href="/bet/{{ $goal->id }}"
                                                                                                                    class="group flex w-full items-center justify-center rounded-xl bg-gradient-to-r from-amber-200 to-amber-300 py-3 px-4 font-semibold text-gray-800 border border-amber-400 shadow-sm transition-all duration-200 hover:shadow-md hover:from-amber-300 hover:to-amber-400">
                                                                                                                    <i
                                                                                                                        class="fas fa-coins mr-2 text-amber-600 transition-transform duration-300 group-hover:rotate-12 group-hover:scale-110"></i>
                                                                                                                    <span>Contribute ${{ $contributionAmount }}</span>
                                                                                                                </a>
                                                                                                            </div>
                                                                                                        @else
                                                                                                            <div class="space-y-4">
                                                                                                                <div id="countdown-section-{{ $goal->id }}"
                                                                                                                    class="rounded-xl bg-gray-200 p-4">
                                                                                                                    <div class="mb-2 text-sm font-medium text-gray-600">
                                                                                                                        <i class="fas fa-clock mr-1"></i>
                                                                                                                        Next contribution available in:
                                                                                                                    </div>

                                                                                                                    <div id="countdown-{{ $goal->id }}"
                                                                                                                        class="text-center text-2xl font-bold text-gray-800"></div>

                                                                                                                    <div class="mt-3 h-2 overflow-hidden rounded-full bg-gray-300">
                                                                                                                        <div id="progress-bar-{{ $goal->id }}"
                                                                                                                            class="h-full bg-gradient-to-r from-gray-500 to-gray-600 transition-all duration-1000">
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>

                                                                                                                <button
                                                                                                                    onclick="confirmSkip('{{ $goal->id }}', '{{ $contributionAmount }}')"
                                                                                                                    class="flex w-full items-center justify-center rounded-xl border border-blue-300 bg-blue-50 py-3 px-4 font-medium text-blue-700 transition-colors duration-200 hover:bg-blue-100">
                                                                                                                    <i class="fas fa-forward mr-2"></i>
                                                                                                                    <span>Skip Waiting Period</span>
                                                                                                                </button>
                                                                                                            </div>

                                                                                                            <script>
                                                                                                                (function startCountdown(goalId, lastBetTime) {
                                                                                                                    const nextBetTime = new Date(new Date(lastBetTime).getTime() + 24 * 60 * 60 * 1000);
                                                                                                                    const totalWaitTime = 24 * 60 * 60 * 1000;
                                                                                                                    const countdownElem = document.getElementById("countdown-" + goalId);
                                                                                                                    const progressBar = document.getElementById("progress-bar-" + goalId);

                                                                                                                    function updateCountdown() {
                                                                                                                        const now = new Date();
                                                                                                                        const timeLeft = nextBetTime - now;
                                                                                                                        const percentComplete = 100 - ((timeLeft / totalWaitTime) * 100);

                                                                                                                        // Update progress bar
                                                                                                                        if (progressBar) {
                                                                                                                            progressBar.style.width = Math.max(5, Math.min(100, percentComplete)) + "%";
                                                                                                                        }

                                                                                                                        if (timeLeft > 0) {
                                                                                                                            const hours = Math.floor(timeLeft / (1000 * 60 * 60));
                                                                                                                            const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                                                                                                                            const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                                                                                                                            // Format with leading zeros
                                                                                                                            const formattedHours = String(hours).padStart(2, '0');
                                                                                                                            const formattedMinutes = String(minutes).padStart(2, '0');
                                                                                                                            const formattedSeconds = String(seconds).padStart(2, '0');

                                                                                                                            countdownElem.innerHTML = `
                                                                                                                                                                                <div class="flex items-center justify-center space-x-2">
                                                                                                                                                                                    <div class="flex flex-col items-center">
                                                                                                                                                                                        <span class="rounded bg-gray-800 px-2 py-1 text-xl text-white">${formattedHours}</span>
                                                                                                                                                                                        <span class="text-xs text-gray-600">hours</span>
                                                                                                                                                                                    </div>
                                                                                                                                                                                    <span class="text-xl">:</span>
                                                                                                                                                                                    <div class="flex flex-col items-center">
                                                                                                                                                                                        <span class="rounded bg-gray-800 px-2 py-1 text-xl text-white">${formattedMinutes}</span>
                                                                                                                                                                                        <span class="text-xs text-gray-600">min</span>
                                                                                                                                                                                    </div>
                                                                                                                                                                                    <span class="text-xl">:</span>
                                                                                                                                                                                    <div class="flex flex-col items-center">
                                                                                                                                                                                        <span class="rounded bg-gray-800 px-2 py-1 text-xl text-white">${formattedSeconds}</span>
                                                                                                                                                                                        <span class="text-xs text-gray-600">sec</span>
                                                                                                                                                                                    </div>
                                                                                                                                                                                </div>
                                                                                                                                                                            `;
                                                                                                                        } else {
                                                                                                                            countdownElem.innerHTML = `<span class="text-green-600">Ready to contribute!</span>`;
                                                                                                                            location.reload();
                                                                                                                        }
                                                                                                                    }

                                                                                                                    updateCountdown();
                                                                                                                    setInterval(updateCountdown, 1000);
                                                                                                                })("{{ $goal->id }}", "{{ $lastBet->created_at ?? now() }}");

                                                                                                                function confirmSkip(goalId, amount) {
                                                                                                                    if (confirm("🚨 WARNING: Skipping the timer is risky. Are you sure you want to continue?")) {
                                                                                                                        document.getElementById("countdown-section-" + goalId).style.display = "none";

                                                                                                                        let contributeSection = document.getElementById("contribute-section-" + goalId);
                                                                                                                        contributeSection.innerHTML = `
                                                                                                                                                                            <div class="flex flex-col space-y-4">
                                                                                                                                                                                <div class="text-sm text-gray-600">
                                                                                                                                                                                    <i class="fas fa-info-circle mr-1"></i>
                                                                                                                                                                                    Ready to make progress? Contribute now!
                                                                                                                                                                                </div>

                                                                                                                                                                                <a href="/bet/${goalId}"
                                                                                                                                                                                class="group flex w-full items-center justify-center rounded-xl bg-gradient-to-r from-amber-200 to-amber-300 py-3 px-4 font-semibold text-gray-800 border border-amber-400 shadow-sm transition-all duration-200 hover:shadow-md hover:from-amber-300 hover:to-amber-400">
                                                                                                                                                                                <i
                                                                                                                                                                                    class="fas fa-coins mr-2 text-amber-600 transition-transform duration-300 group-hover:rotate-12 group-hover:scale-110"></i>
                                                                                                                                                                                <span>Contribute $${amount}</span>
                                                                                                                                                                                </a>
                                                                                                                                                                            </div>
                                                                                                                                                                        `;
                                                                                                                    }
                                                                                                                }
                                                                                                            </script>
                                                                                                        @endif
                                                                                                    </div>
                                                            @else
                                                                <!-- Completed goal display -->
                                                                <div class="flex flex-col space-y-2">
                                                                    <div class="rounded-lg bg-emerald-50 p-4 text-center">
                                                                        <i class="fas fa-check-circle text-3xl text-emerald-500 mb-2"></i>
                                                                        <p class="text-emerald-700 font-medium">Goal successfully completed!
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="flex justify-between items-center pb-4">
                                                    <div class="flex items-center text-sm text-gray-500">
                                                        <span><i class="far fa-calendar-alt mr-1"></i>Target Date:
                                                            {{ $goal->target_date }}</span>
                                                    </div>
                                                    <div>
                                                        <span
                                                            class="px-3 py-1 bg-{{ ($goal->current_amount >= $goal->amount) ? 'red-100' : 'green-100'}} text-green-800 rounded-full text-xs font-medium">{{ number_format(min(($goal->current_amount / $goal->amount) * 100, 100), 2) }}%
                                                            completed</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
    </div>

    <script>
        // Initialize Progress Chart
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('progressChart').getContext('2d');

            const progressChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Emergency Fund', 'Stock Portfolio', 'New Car', 'Dream Vacation'],
                    datasets: [
                        {
                            label: 'Current Amount',
                            data: [3200, 5000, 8000, 1500],
                            backgroundColor: [
                                '#10b981', // green
                                '#8b5cf6', // purple
                                '#3b82f6', // blue
                                '#f59e0b'  // amber
                            ],
                            borderRadius: 6
                        },
                        {
                            label: 'Target Amount',
                            data: [10000, 15000, 25000, 4000],
                            backgroundColor: '#e5e7eb',
                            borderRadius: 6
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function (value) {
                                    return '$' + value.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            const alert = document.getElementById('sweetAlert');
            const progressBar = document.getElementById('progressBar');
            let timeoutId;

            if (alert && alert.querySelector('.bg-green-500')) {
                setTimeout(() => {
                    alert.classList.remove('-translate-y-full');
                    alert.classList.add('translate-y-0');

                    let width = 100;
                    const duration = 5000;
                    const interval = 50;
                    const step = (interval / duration) * 100;

                    const timer = setInterval(() => {
                        width -= step;
                        if (width <= 0) {
                            clearInterval(timer);
                            width = 0;
                        }
                        if (progressBar) {
                            progressBar.style.width = width + '%';
                        }
                    }, interval);

                    timeoutId = setTimeout(() => {
                        closeAlert();
                    }, 5000);
                }, 100);
            }
            if (alert && alert.querySelector('.bg-red-500')) {
                setTimeout(() => {
                    alert.classList.remove('-translate-y-full');
                    alert.classList.add('translate-y-0');

                    let width = 100;
                    const duration = 5000;
                    const interval = 50;
                    const step = (interval / duration) * 100;

                    const timer = setInterval(() => {
                        width -= step;
                        if (width <= 0) {
                            clearInterval(timer);
                            width = 0;
                        }
                        if (progressBar) {
                            progressBar.style.width = width + '%';
                        }
                    }, interval);

                    timeoutId = setTimeout(() => {
                        closeAlert();
                    }, 5000);
                }, 100);
            }
        });

        function closeAlert() {
            const alert = document.getElementById('sweetAlert');
            alert.classList.remove('translate-y-0');
            alert.classList.add('-translate-y-full');

            setTimeout(() => {
                if (alert.parentNode) {
                    alert.parentNode.removeChild(alert);
                }
            }, 500);
        }
    </script>
</body>

</html>