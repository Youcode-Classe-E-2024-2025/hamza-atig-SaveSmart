<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SaveSmart Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
@if (auth()->check())

    <body class="bg-gray-100 h-screen">
        <!-- Sidebar -->
        <div class="fixed inset-y-0 left-0 w-64 bg-blue-800 text-white p-4 z-10 sidebar">
            <div class="flex items-center space-x-3 mb-8">
                <i class="fas fa-piggy-bank text-3xl"></i>
                <span class="text-2xl font-bold">SaveSmart</span>
            </div>

            <nav class="space-y-2">
                <a href="#" class="flex items-center space-x-3 bg-blue-700 p-3 rounded-lg transition duration-200">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="flex items-center space-x-3 hover:bg-blue-700 p-3 rounded-lg transition duration-200">
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
                    <img src="https://randomuser.me/api/portraits/men/1.jpg" class="w-8 h-8 rounded-full">
                    <div>
                        <div class="text-sm font-medium">John Doe</div>
                        <div class="text-xs text-gray-400 truncate">john.doe@example.com</div>
                    </div>
                    <button class="ml-auto text-red-500 hover:text-red-600">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="ml-64 p-8 h-screen overflow-y-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8 animate-slide-in">
                <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <input type="text" placeholder="Search transactions..."
                            class="bg-white rounded-full px-4 py-2 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-full">
                        + New Transaction
                    </button>
                </div>
            </div>

            <!-- Balance Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow-lg p-6 animate-slide-in">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-gray-500">Current Balance</span>
                        <i class="fas fa-wallet text-blue-500 text-xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800">${{ \App\Models\Balence::where('user_id', auth()->user()->id)->value('balance') }}
                    </h2>
                    <div class="flex justify-between mt-4">
                        <div>
                            <p class="text-green-500 text-sm">0% this month</p>
                        </div>
                        <div>
                            <button class="text-blue-500 hover:text-blue-600 text-sm">View Details</button>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6 animate-slide-in">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-gray-500">Savings Goal</span>
                        <i class="fas fa-bullseye text-green-500 text-xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800">$5,000.00</h2>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 mt-4">
                        <div class="bg-green-500 h-2.5 rounded-full" style="width: 1%"></div>
                    </div>
                    <p class="text-sm text-gray-500 mt-2">0% completed</p>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6 animate-slide-in">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-gray-500">Net Income</span>
                        <i class="fas fa-dollar-sign text-purple-500 text-xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800">${{ \App\Models\Balence::where('user_id', auth()->user()->id)->value('Montly_income') }}</h2>
                    <div class="flex justify-between mt-4">
                        <div>
                            <p class="text-sm text-gray-500">This month</p>
                        </div>
                        <div>
                            <p class="text-purple-500 text-sm">+8.5%</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Spending Chart -->
                <div class="bg-white rounded-lg shadow-lg p-6 animate-slide-in">
                    <h3 class="text-xl font-semibold mb-4">Spending Breakdown</h3>
                    <div class="chart-container">
                        <canvas id="spendingChart"></canvas>
                    </div>
                </div>

                <!-- Savings Trend Chart -->
                <div class="bg-white rounded-lg shadow-lg p-6 animate-slide-in">
                    <h3 class="text-xl font-semibold mb-4">Savings Trend</h3>
                    <div class="chart-container">
                        <canvas id="savingsChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Transactions -->
            <div class="bg-white rounded-lg shadow-lg p-6 animate-slide-in">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold">Recent Transactions</h3>
                    <button class="text-blue-500 hover:text-blue-600 text-sm">View All</button>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="bg-red-100 p-2 rounded-full">
                                <i class="fas fa-shopping-cart text-red-600"></i>
                            </div>
                            <div>
                                <p class="font-medium">Walmart</p>
                                <p class="text-xs text-gray-500">Jan 15, 2023</p>
                            </div>
                        </div>
                        <span class="text-red-600">-$89.99</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="bg-green-100 p-2 rounded-full">
                                <i class="fas fa-utensils text-green-600"></i>
                            </div>
                            <div>
                                <p class="font-medium">Restaurant</p>
                                <p class="text-xs text-gray-500">Jan 14, 2023</p>
                            </div>
                        </div>
                        <span class="text-red-600">-$45.50</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="bg-blue-100 p-2 rounded-full">
                                <i class="fas fa-gas-pump text-blue-600"></i>
                            </div>
                            <div>
                                <p class="font-medium">Gas Station</p>
                                <p class="text-xs text-gray-500">Jan 13, 2023</p>
                            </div>
                        </div>
                        <span class="text-red-600">-$32.75</span>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Spending Chart
            const ctx = document.getElementById('spendingChart').getContext('2d');
            const spendingChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Groceries', 'Utilities', 'Entertainment', 'Transportation', 'Other'],
                    datasets: [{
                        label: 'Spending',
                        data: [450, 200, 150, 100, 80],
                        backgroundColor: [
                            '#3B82F6',
                            '#6366F1',
                            '#F59E0B',
                            '#10B981',
                            '#EC4899'
                        ],
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                        tooltip: {
                            enabled: true
                        }
                    }
                }
            });

            // Savings Trend Chart
            const ctx2 = document.getElementById('savingsChart').getContext('2d');
            const savingsChart = new Chart(ctx2, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Savings',
                        data: [1200, 1500, 1300, 1700, 1900, 2200],
                        borderColor: '#10B981',
                        tension: 0.4,
                        fill: {
                            target: 'origin',
                            above: 'rgba(16, 185, 129, 0.2)'
                        }
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </body>
@else
    <script>window.location.href = "{{ route('login') }}";</script>
@endif

</html>