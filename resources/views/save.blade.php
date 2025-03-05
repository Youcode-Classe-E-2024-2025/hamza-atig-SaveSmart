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

        .animate-slide-in {
            animation: slideIn 0.5s ease-out;
        }

        .progress-ring {
            transform: rotate(-90deg);
        }

        .progress-ring-circle {
            transition: stroke-dashoffset 0.5s;
            stroke-width: 8;
            fill: transparent;
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
            <a href="/goals"
                class="flex items-center space-x-3 hover:bg-blue-700 p-3 rounded-lg transition duration-200">
                <i class="fas fa-bullseye"></i>
                <span>Goals</span>
            </a>
            <a href="/save" class="flex items-center space-x-3 bg-blue-700 p-3 rounded-lg transition duration-200">
                <i class="fas fa-chart-bar"></i>
                <span>Saving</span>
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
    <div class="ml-64 p-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Savings Overview</h1>
        </div>

        <!-- Key Metrics Cards -->
        <div class="grid grid-cols-4 gap-6 mb-8">
            <div class="bg-white shadow-md rounded-lg p-6 flex flex-col">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-gray-600 font-medium">Total Savings</h3>
                    <i class="fas fa-piggy-bank text-blue-500"></i>
                </div>
                <div class="text-2xl font-bold text-green-600">{{ \App\Models\Balence::where('user_id', auth()->id())->value('balance') }}</div>
                @php
                    $lastMonthBalance = \App\Models\Balence::where('user_id', auth()->id())->where('created_at', '<', now()->subMonth())->value('balance');
                    $diff = $lastMonthBalance == 0 ? 0 : (\App\Models\Balence::where('user_id', auth()->id())->value('balance') - $lastMonthBalance) / $lastMonthBalance * 100;
                @endphp
                <div class="text-sm text-green-500 mt-2">+{{ number_format($diff, 2) }}% from last month</div>
            </div>
            <div class="bg-white shadow-md rounded-lg p-6 flex flex-col">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-gray-600 font-medium">Monthly Expenses</h3>
                    <i class="fas fa-receipt text-red-500"></i>
                </div>
                <div class="text-2xl font-bold text-red-600">${{ number_format(\App\Models\History::where('user_id', auth()->id())->where('type', 'expense')->sum('amount'), 2) }}</div>
                <div class="text-sm text-red-500 mt-2">-1.5% from last month</div>
            </div>
            <div class="bg-white shadow-md rounded-lg p-6 flex flex-col">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-gray-600 font-medium">Savings Rate</h3>
                    <i class="fas fa-chart-line text-purple-500"></i>
                </div>
                <div class="text-2xl font-bold text-purple-600">{{ number_format(\App\Models\Balence::where('user_id', auth()->id())->value('balance') / \App\Models\History::where('user_id', auth()->id())->where('type', 'expense')->sum('amount') * 100, 1) }}%</div>
                
                    @if (number_format(\App\Models\Balence::where('user_id', auth()->id())->value('balance') / \App\Models\History::where('user_id', auth()->id())->where('type', 'income')->sum('amount') * 100, 1) > 30)
                        <div class="text-sm text-purple-500 mt-2">Excellent save</div>
                    @elseif (number_format(\App\Models\Balence::where('user_id', auth()->id())->value('balance') / \App\Models\History::where('user_id', auth()->id())->where('type', 'income')->sum('amount') * 100, 1) > 19)
                        <div class="text-sm text-green-500 mt-2">Good save</div>
                    @else
                        <div class="text-sm text-red-500 mt-2">Needs Improvement</div>
                    @endif
            </div>
            <div class="bg-white shadow-md rounded-lg p-6 flex flex-col">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-gray-600 font-medium">Spending Category</h3>
                    <i class="fas fa-chart-pie text-yellow-500"></i>
                </div>
                <div class="text-2xl font-bold text-yellow-600">Food</div>
                <div class="text-sm text-yellow-500 mt-2">Highest Expense</div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-2 gap-8">
            <!-- Expenses vs Savings Line Chart -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-4 text-gray-700">Monthly Expenses vs Savings</h3>
                <canvas id="expensesSavingsChart" height="300"></canvas>
            </div>

            <!-- Spending by Category Pie Chart -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-4 text-gray-700">Spending by Category</h3>
                <canvas id="spendingCategoryChart" height="300"></canvas>
            </div>
        </div>
    </div>

    <script>
        var ctx1 = document.getElementById('expensesSavingsChart').getContext('2d');
        var expenses = [];
        var incomes = [];
        var labels = [];

        @foreach (\App\Models\History::where('profile_id', session('profile_id'))->orderBy('created_at', 'desc')->get() as $history)
                @php
                    $timestamp = \Carbon\Carbon::parse($history->created_at);

                    $minute = $timestamp->minute;
                    $rounded_minute = $minute - ($minute % 10);
                    $rounded_time = $timestamp->minute($rounded_minute)->format('H:i');
                @endphp
                @if ($history->type == 'expense')
                    expenses.push({{ $history->amount }});
                    labels.push('{{ $rounded_time }}');
                @else
                    incomes.push({{ $history->amount }});
                    labels.push('{{ $rounded_time }}');
                @endif
        @endforeach

        new Chart(ctx1, {
            type: 'line',
            data: {
                labels: [...new Set(labels)],
                datasets: [{
                    label: 'Expenses',
                    data: expenses,
                    borderColor: 'rgb(255, 99, 132)',
                    tension: 0.1
                }, {
                    label: 'Income',
                    data: incomes,
                    borderColor: 'rgb(54, 162, 235)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctx2 = document.getElementById('spendingCategoryChart').getContext('2d');
        @php
            $needs = (\App\Models\Balence::where('user_id', auth()->id())->value('balance') - \App\Models\History::where('profile_id', session('profile_id'))->sum('amount'));
            $wants = (\App\Models\Balence::where('user_id', auth()->id())->value('balance') - \App\Models\Goal::where('profile_id', session('profile_id'))->sum('current_amount'));
            $savings = \App\Models\Balence::where('user_id', auth()->id())->value('balance');
        @endphp
        new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['Needs', 'Wants', 'Savings'],
                datasets: [{
                    data: [{{ $needs }}, -{{ $wants }}, {{ $savings }}],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 206, 86)'
                    ]
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
</body>

</html>