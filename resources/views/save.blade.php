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
            <a href="/goals" class="flex items-center space-x-3 hover:bg-blue-700 p-3 rounded-lg transition duration-200">
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
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Saving Goals</h1>
                <p class="text-gray-600">Track your financial targets and monitor your progress.</p>
            </div>
            <div class="flex items-center space-x-4">
                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                    <i class="fas fa-plus mr-2"></i> Add New Goal
                </button>
                <div class="relative">
                    <i class="fas fa-bell text-gray-600 text-xl cursor-pointer"></i>
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">3</span>
                </div>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6 card-hover">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-gray-500 font-medium">Total Goals</h3>
                    <span class="bg-blue-100 text-blue-600 text-xs px-2 py-1 rounded-full">Active</span>
                </div>
                <p class="text-3xl font-bold text-gray-800 mb-2">5</p>
                <div class="flex items-center text-sm text-gray-500">
                    <i class="fas fa-bullseye text-blue-500 mr-1"></i> 
                    <span>3 on track, 2 behind schedule</span>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6 card-hover">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-gray-500 font-medium">Saved Amount</h3>
                    <span class="bg-green-100 text-green-600 text-xs px-2 py-1 rounded-full">+15.3%</span>
                </div>
                <p class="text-3xl font-bold text-gray-800 mb-2">$24,750</p>
                <div class="flex items-center text-sm text-gray-500">
                    <i class="fas fa-arrow-up text-green-500 mr-1"></i> 
                    <span>$3,280 more than last month</span>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6 card-hover">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-gray-500 font-medium">Target Amount</h3>
                    <span class="bg-purple-100 text-purple-600 text-xs px-2 py-1 rounded-full">Total</span>
                </div>
                <p class="text-3xl font-bold text-gray-800 mb-2">$48,000</p>
                <div class="flex items-center text-sm text-gray-500">
                    <i class="fas fa-calculator text-purple-500 mr-1"></i> 
                    <span>51.6% of total goal achieved</span>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6 card-hover">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-gray-500 font-medium">Upcoming Goal</h3>
                    <span class="bg-orange-100 text-orange-600 text-xs px-2 py-1 rounded-full">30 days</span>
                </div>
                <p class="text-3xl font-bold text-gray-800 mb-2">Vacation</p>
                <div class="flex items-center text-sm text-gray-500">
                    <i class="fas fa-calendar-alt text-orange-500 mr-1"></i> 
                    <span>$800 needed to complete</span>
                </div>
            </div>
        </div>

        <!-- Main Goal Tracking Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Active Goals Progress -->
            <div class="bg-white rounded-lg shadow p-6 lg:col-span-2 card-hover">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-800">Active Goals Progress</h3>
                    <div class="flex space-x-2">
                        <button class="text-gray-500 hover:text-gray-700 px-2 py-1 rounded">
                            <i class="fas fa-filter mr-1"></i> Filter
                        </button>
                        <button class="text-gray-500 hover:text-gray-700 px-2 py-1 rounded">
                            <i class="fas fa-sort mr-1"></i> Sort
                        </button>
                    </div>
                </div>
                
                <div class="space-y-6">
                    <!-- Goal 1 -->
                    <div class="border-b pb-5">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h4 class="font-semibold text-gray-800 flex items-center">
                                    <i class="fas fa-home text-blue-500 mr-2"></i> Home Down Payment
                                </h4>
                                <p class="text-sm text-gray-500">Target date: December 15, 2025</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="text-green-600 font-medium">On Track</span>
                                <div class="dropdown inline-block relative">
                                    <button class="text-gray-500 hover:text-gray-700">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row md:items-center justify-between">
                            <div class="w-full md:w-8/12 pr-4">
                                <div class="flex justify-between items-center mb-1">
                                    <span class="text-sm text-gray-500">Progress</span>
                                    <span class="text-sm font-medium">65%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-3">
                                    <div class="bg-blue-600 h-3 rounded-full" style="width: 65%"></div>
                                </div>
                            </div>
                            <div class="mt-3 md:mt-0 flex justify-between md:justify-end md:w-4/12">
                                <div class="text-center pr-3">
                                    <p class="text-xs text-gray-500">Saved</p>
                                    <p class="font-bold text-gray-800">$13,000</p>
                                </div>
                                <div class="text-center px-3 border-l">
                                    <p class="text-xs text-gray-500">Target</p>
                                    <p class="font-bold text-gray-800">$20,000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Goal 2 -->
                    <div class="border-b pb-5">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h4 class="font-semibold text-gray-800 flex items-center">
                                    <i class="fas fa-car text-purple-500 mr-2"></i> New Car
                                </h4>
                                <p class="text-sm text-gray-500">Target date: August 30, 2025</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="text-orange-600 font-medium">Attention Needed</span>
                                <div class="dropdown inline-block relative">
                                    <button class="text-gray-500 hover:text-gray-700">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row md:items-center justify-between">
                            <div class="w-full md:w-8/12 pr-4">
                                <div class="flex justify-between items-center mb-1">
                                    <span class="text-sm text-gray-500">Progress</span>
                                    <span class="text-sm font-medium">43%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-3">
                                    <div class="bg-purple-600 h-3 rounded-full" style="width: 43%"></div>
                                </div>
                            </div>
                            <div class="mt-3 md:mt-0 flex justify-between md:justify-end md:w-4/12">
                                <div class="text-center pr-3">
                                    <p class="text-xs text-gray-500">Saved</p>
                                    <p class="font-bold text-gray-800">$6,450</p>
                                </div>
                                <div class="text-center px-3 border-l">
                                    <p class="text-xs text-gray-500">Target</p>
                                    <p class="font-bold text-gray-800">$15,000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Goal 3 -->
                    <div>
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h4 class="font-semibold text-gray-800 flex items-center">
                                    <i class="fas fa-plane text-green-500 mr-2"></i> Vacation Fund
                                </h4>
                                <p class="text-sm text-gray-500">Target date: April 10, 2025</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="text-green-600 font-medium">On Track</span>
                                <div class="dropdown inline-block relative">
                                    <button class="text-gray-500 hover:text-gray-700">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row md:items-center justify-between">
                            <div class="w-full md:w-8/12 pr-4">
                                <div class="flex justify-between items-center mb-1">
                                    <span class="text-sm text-gray-500">Progress</span>
                                    <span class="text-sm font-medium">80%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-3">
                                    <div class="bg-green-600 h-3 rounded-full" style="width: 80%"></div>
                                </div>
                            </div>
                            <div class="mt-3 md:mt-0 flex justify-between md:justify-end md:w-4/12">
                                <div class="text-center pr-3">
                                    <p class="text-xs text-gray-500">Saved</p>
                                    <p class="font-bold text-gray-800">$2,400</p>
                                </div>
                                <div class="text-center px-3 border-l">
                                    <p class="text-xs text-gray-500">Target</p>
                                    <p class="font-bold text-gray-800">$3,000</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Goal Stats & Tips -->
            <div class="space-y-6">
                <!-- Goal Completion Forecast -->
                <div class="bg-white rounded-lg shadow p-6 card-hover">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Goal Forecast</h3>
                    <div class="flex flex-col items-center">
                        <div class="relative h-40 w-40 mb-4">
                            <svg class="progress-ring" width="160" height="160">
                                <circle class="progress-ring-circle" stroke="#e5e7eb" cx="80" cy="80" r="70" stroke-width="12" />
                                <circle class="progress-ring-circle" stroke="#3b82f6" cx="80" cy="80" r="70" stroke-width="12" 
                                    stroke-dasharray="439.6" stroke-dashoffset="153.9" />
                            </svg>
                            <div class="absolute inset-0 flex flex-col items-center justify-center">
                                <span class="text-3xl font-bold text-gray-800">65%</span>
                                <span class="text-sm text-gray-500">Overall Progress</span>
                            </div>
                        </div>
                        <div class="text-center">
                            <p class="text-sm text-gray-600 mb-2">Based on your current saving rate:</p>
                            <p class="font-medium text-gray-800">You'll reach all goals by <span class="text-blue-600 font-bold">January 2026</span></p>
                        </div>
                    </div>
                </div>

                <!-- Savings Tips -->
                <div class="bg-white rounded-lg shadow p-6 card-hover">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Smart Tips</h3>
                    <div class="space-y-4">
                        <div class="flex space-x-3">
                            <div class="flex-shrink-0 bg-blue-100 rounded-full p-2">
                                <i class="fas fa-lightbulb text-blue-500"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800">Increase car savings</h4>
                                <p class="text-sm text-gray-600">Adding $100 more monthly will help you reach your goal 3 months earlier.</p>
                            </div>
                        </div>
                        <div class="flex space-x-3">
                            <div class="flex-shrink-0 bg-green-100 rounded-full p-2">
                                <i class="fas fa-chart-line text-green-500"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800">Auto-save feature</h4>
                                <p class="text-sm text-gray-600">Enable auto-saving to put aside 5% of each deposit automatically.</p>
                            </div>
                        </div>
                        <div class="flex space-x-3">
                            <div class="flex-shrink-0 bg-purple-100 rounded-full p-2">
                                <i class="fas fa-trophy text-purple-500"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800">You're on a streak!</h4>
                                <p class="text-sm text-gray-600">4 months of consistent savings. Keep it up!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recently Completed Goals -->
        <div class="bg-white rounded-lg shadow p-6 mb-8 card-hover">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-800">Completed Goals</h3>
                <button class="text-sm text-blue-600 hover:text-blue-800">View All</button>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Goal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Completion Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8 bg-yellow-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-laptop text-yellow-500"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">New Laptop</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$1,200</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Jan 15, 2025</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">6 months</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Completed
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8 bg-red-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-heartbeat text-red-500"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">Emergency Fund</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$5,000</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Nov 30, 2024</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">12 months</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Completed
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Show Sweet Alert if success or error message exists
        document.addEventListener('DOMContentLoaded', function() {
            const sweetAlert = document.getElementById('sweetAlert');
            if (sweetAlert.querySelector('.bg-red-500, .bg-green-500')) {
                sweetAlert.classList.remove('-translate-y-full');
                sweetAlert.classList.add('translate-y-0');
                
                // Progress bar animation
                const progressBar = document.getElementById('progressBar');
                if (progressBar) {
                    let width = 100;
                    const interval = setInterval(function() {
                        if (width <= 0) {
                            clearInterval(interval);
                            closeAlert();
                        } else {
                            width--;
                            progressBar.style.width = width + '%';
                        }
                    }, 50);
                }
            }
        });

        function closeAlert() {
            const sweetAlert = document.getElementById('sweetAlert');
            sweetAlert.classList.remove('translate-y-0');
            sweetAlert.classList.add('-translate-y-full');
        }

        // Chart data for saving progress visualization
        document.addEventListener('DOMContentLoaded', function() {
            // Future JS for charts implementation
            const ctx = document.getElementById('savingsChart');
            if (ctx) {
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                        datasets: [
                            {
                                label: 'Actual Savings',
                                data: [1200, 2450, 3700, 5200, 7800, 9300, 12000, 14500, 18000],
                                borderColor: '#3b82f6',
                                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                tension: 0.4,
                                fill: true
                            },
                            {
                                label: 'Projected',
                                data: [1000, 2000, 3000, 4000, 5000, 7500, 10000, 12500, 15000],
                                borderColor: '#9ca3af',
                                borderDash: [5, 5],
                                tension: 0.4,
                                fill: false
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top',
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return '$' + value.toLocaleString();
                                    }
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
</body>

</html>