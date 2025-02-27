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
                    <button id="newTransactionButton"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-full">
                        + New Transaction
                    </button>
                </div>
            </div>

            <div id="transactionForm"
                class="hidden z-10 fixed right-0 top-0 h-screen w-96 bg-white shadow-2xl overflow-y-auto transform transition-transform duration-300 ease-in-out translate-x-full">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">New Transaction</h2>
                        <button id="closeForm" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <form action="/transaction" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                            <div class="flex space-x-4">
                                <label id="incomeRadio" class="flex items-center space-x-2">
                                    <input type="radio" name="type" value="income" class="form-radio text-green-500">
                                    <span class="text-green-600 font-medium">Income</span>
                                </label>
                                <label id="expenseRadio" class="flex items-center space-x-2">
                                    <input type="radio" name="type" value="expense" class="form-radio text-red-500">
                                    <span class="text-red-600 font-medium">Expense</span>
                                </label>
                            </div>
                        </div>

                        <div id="categoryContainer" class="hidden">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                            <div class="grid grid-cols-3 gap-3">
                                <div class="flex flex-col items-center space-y-2 p-3 rounded-lg hover:bg-gray-50 cursor-pointer category-item"
                                    data-category="Shopping">
                                    <i class="fas fa-shopping-cart text-blue-500 text-2xl"></i>
                                    <span class="text-sm text-gray-600">Shopping</span>
                                </div>
                                <div class="flex flex-col items-center space-y-2 p-3 rounded-lg hover:bg-gray-50 cursor-pointer category-item"
                                    data-category="Food">
                                    <i class="fas fa-utensils text-green-500 text-2xl"></i>
                                    <span class="text-sm text-gray-600">Food</span>
                                </div>
                                <div class="flex flex-col items-center space-y-2 p-3 rounded-lg hover:bg-gray-50 cursor-pointer category-item"
                                    data-category="Utilities">
                                    <i class="fas fa-bolt text-yellow-500 text-2xl"></i>
                                    <span class="text-sm text-gray-600">Utilities</span>
                                </div>
                                <div class="flex flex-col items-center space-y-2 p-3 rounded-lg hover:bg-gray-50 cursor-pointer category-item"
                                    data-category="Travel">
                                    <i class="fas fa-plane text-purple-500 text-2xl"></i>
                                    <span class="text-sm text-gray-600">Travel</span>
                                </div>
                                <div class="flex flex-col items-center space-y-2 p-3 rounded-lg hover:bg-gray-50 cursor-pointer category-item"
                                    data-category="Savings">
                                    <i class="fas fa-piggy-bank text-teal-500 text-2xl"></i>
                                    <span class="text-sm text-gray-600">Savings</span>
                                </div>
                                <div class="flex flex-col items-center space-y-2 p-3 rounded-lg hover:bg-gray-50 cursor-pointer category-item"
                                    data-category="Other">
                                    <i class="fas fa-ellipsis-h text-gray-500 text-2xl"></i>
                                    <span class="text-sm text-gray-600">Other</span>
                                </div>
                            </div>
                            <input type="hidden" name="category" value="">
                        </div>

                        <script>
                            const categoryItems = document.querySelectorAll('.category-item');
                            const categoryInput = document.querySelector('input[name="category"]');

                            categoryItems.forEach(item => {
                                item.addEventListener('click', () => {
                                    categoryInput.value = item.getAttribute('data-category') || null;
                                    categoryItems.forEach(i => i.style.backgroundColor = '');
                                    item.style.backgroundColor = '#e2e8f0';
                                });
                            });
                        </script>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Amount</label>
                            <div class="relative mt-1">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500">$</span>
                                </div>
                                <input type="number" name="amount"
                                    class="block w-full pl-8 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                    placeholder="0.00">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2" for="date">Date</label>
                            <input id="date" name="date" type="date"
                                class="block w-full pr-10 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Note</label>
                            <textarea rows="3"
                                class="block w-full pr-10 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                placeholder="Add a note..." name="note"></textarea>
                        </div>

                        <div>
                            <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200">
                                Save Transaction
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Balance Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow-lg p-6 animate-slide-in">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-gray-500">Current Balance</span>
                        <i class="fas fa-wallet text-blue-500 text-xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800">
                        ${{ \App\Models\Balence::where('user_id', auth()->user()->id)->value('balance') }}
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
                        <span class="text-gray-500">Montly Income 
                            <button id="editButton" class="ml-2 text-gray-500 hover:text-gray-700 focus:outline-none">
                                <i class="fas fa-pencil-alt text-sm"></i>
                            </button>
                            <button type="submit" id="saveButton" class="hidden ml-2 text-gray-500 hover:text-gray-700 focus:outline-none">
                                <i class="fas fa-save text-sm"></i>
                            </button>
                        </span>
                        <i class="fas fa-dollar-sign text-purple-500 text-xl"></i>
                    </div>
                    <h2 id="monthlyIncome" class="text-3xl font-bold text-gray-800">
                        ${{ \App\Models\Balence::where('user_id', auth()->user()->id)->value('Montly_income') }}</h2>
                    <form action="/updateIncome" method="POST" class="hidden flex flex-row text-3xl font-bold text-gray-800" id="inputField">
                        <h2 class="mr-2">$</h2>
                        <input type="number" id="inputField" class="w-full text-gray-800 font-bold" placeholder="">
                    </form>
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
                    @foreach (\App\Models\History::where('profile_id', session('profile_id'))->get() as $transaction)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="{{ $transaction->type == 'income' ? 'bg-green-100' : 'bg-red-100' }} p-2 rounded-full">
                                    <script>
                                        var categories = {
                                            "Food": "fas fa-utensils",
                                            "Transportation": "fas fa-bus",
                                            "Entertainment": "fas fa-gamepad",
                                            "Housing": "fas fa-home",
                                            "Insurance": "fas fa-shield-alt",
                                            "Healthcare": "fas fa-medkit",
                                            "Debt": "fas fa-credit-card",
                                            "Savings": "fas fa-piggy-bank",
                                            "Gifts": "fas fa-gift",
                                            "Miscellaneous": "fas fa-question-circle",
                                            "Not Exist": "fa-solid fa-cubes",
                                        };
                                        var category = "{{ $transaction->category }}";
                                        document.write(`<i class="${categories[category]} {{ $transaction->category == 'Not Exist' && $transaction->type == 'income' ? 'text-green-600' : 'text-red-600' }}"></i>`);
                                    </script>
                                </div>
                                <div>
                                    <p class="font-medium">{{ $transaction->category == 'Not Exist' ? 'Other' : $transaction->category }}</p>
                                    <p class="text-xs text-gray-500">{{ $transaction->date }},{{ \App\Models\Profile::where('id', session('profile_id'))->value('full_name') }}</p>
                                </div>
                            </div>
                            <span class="{{ $transaction->type == 'income' ? 'text-green-500' : 'text-red-500' }}">{{ $transaction->type == 'income' ? '+' : '-' }}${{ $transaction->amount }}</span>
                        </div>
                    @endforeach
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
    <script>
        document.getElementById('newTransactionButton').addEventListener('click', function () {
            var profileForm = document.getElementById('transactionForm');
            profileForm.classList.toggle('hidden');
            profileForm.style.transform = 'translateX(100%)';
            profileForm.style.transition = 'transform 0.3s ease-in-out';
            requestAnimationFrame(function () {
                profileForm.style.transform = 'translateX(0)';
            });
        });
        document.querySelector('#closeForm').addEventListener('click', () => {
            var profileForm = document.getElementById('transactionForm');
            profileForm.style.transform = 'translateX(0)';
            profileForm.style.transition = 'transform 0.3s ease-in-out';
            requestAnimationFrame(function () {
                profileForm.style.transform = 'translateX(100%)';
            });
            setTimeout(() => {
                profileForm.classList.toggle('hidden');
            }, 200);
        });
        document.getElementById('expenseRadio').addEventListener('change', function () {
            document.getElementById('categoryContainer').classList.remove('hidden');
            document.getElementById('categoryContainer').style.transform = 'translateY(-30%)';
            document.getElementById('categoryContainer').style.transition = 'transform 0.4s ease-in-out';
            requestAnimationFrame(function () {
                document.getElementById('categoryContainer').style.transform = 'translateY(0)';
            });
        });

        document.getElementById('incomeRadio').addEventListener('change', function () {
            if (!document.getElementById('categoryContainer').classList.contains('hidden')) {
                document.getElementById('categoryContainer').classList.add('hidden');
                document.getElementById('categoryContainer').style.transform = 'translateY(30%)';
                document.getElementById('categoryContainer').style.transition = 'opacity 0.4s ease-in-out, transform 0.4s ease-in-out';
                document.getElementById('categoryContainer').style.opacity = '0';
                requestAnimationFrame(function () {
                    document.getElementById('categoryContainer').style.opacity = '1';
                    document.getElementById('categoryContainer').style.transform = 'translateY(0)';
                });

            }
        });

        document.getElementById('editButton').addEventListener('click', function () {
            document.getElementById('inputField').classList.remove('hidden');
            document.getElementById('monthlyIncome').classList.add('hidden');
            document.getElementById('editButton').classList.add('hidden');
            document.getElementById('saveButton').classList.remove('hidden');
        });

        document.getElementById('saveButton').addEventListener('click', function () {
            document.getElementById('inputField').submit();
        });

    </script>
@else
    <script>window.location.href = "{{ route('login') }}";</script>
@endif

</html>