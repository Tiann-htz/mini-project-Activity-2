<x-app-layout>
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Medicines Count -->
                <div class="bg-white overflow-hidden shadow-lg rounded-lg transition-all duration-300 hover:shadow-xl border border-gray-100">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium mb-2">Total Medicines</h3>
                        <p class="text-4xl font-bold text-blue-600" id="medicinesCount">0</p>
                    </div>
                </div>
                
                <!-- Categories Count -->
                <div class="bg-white overflow-hidden shadow-lg rounded-lg transition-all duration-300 hover:shadow-xl border border-gray-100">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium mb-2">Categories</h3>
                        <p class="text-4xl font-bold text-green-600" id="categoriesCount">0</p>
                    </div>
                </div>
                
                <!-- Suppliers Count -->
                <div class="bg-white overflow-hidden shadow-lg rounded-lg transition-all duration-300 hover:shadow-xl border border-gray-100">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium mb-2">Suppliers</h3>
                        <p class="text-4xl font-bold text-purple-600" id="suppliersCount">0</p>
                    </div>
                </div>
                
                <!-- Staff Count -->
                <div class="bg-white overflow-hidden shadow-lg rounded-lg transition-all duration-300 hover:shadow-xl border border-gray-100">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium mb-2">Staff Members</h3>
                        <p class="text-4xl font-bold text-yellow-600" id="staffCount">0</p>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Expiring Medicines -->
                <div class="bg-white overflow-hidden shadow-lg rounded-lg border border-gray-100">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium mb-5 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Expiring Soon
                        </h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Expiry Date</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200" id="expiringMedicines">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" colspan="3">Loading...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <!-- Low Stock Medicines -->
                <div class="bg-white overflow-hidden shadow-lg rounded-lg border border-gray-100">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium mb-5 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
                            </svg>
                            Low Stock
                        </h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200" id="lowStockMedicines">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" colspan="3">Loading...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="mt-8 bg-white overflow-hidden shadow-lg rounded-lg border border-gray-100">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-5 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Quick Actions
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <a href="{{ route('inventory') }}" class="bg-blue-100 hover:bg-blue-200 p-6 rounded-lg flex items-center justify-center shadow-md hover:shadow-lg transition-all duration-300">
                            <div class="text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                                <span class="block mt-3 font-medium">Add Medicine</span>
                            </div>
                        </a>
                        <a href="{{ route('categories') }}" class="bg-green-100 hover:bg-green-200 p-6 rounded-lg flex items-center justify-center shadow-md hover:shadow-lg transition-all duration-300">
                            <div class="text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                <span class="block mt-3 font-medium">Manage Categories</span>
                            </div>
                        </a>
                        <a href="{{ route('suppliers') }}" class="bg-purple-100 hover:bg-purple-200 p-6 rounded-lg flex items-center justify-center shadow-md hover:shadow-lg transition-all duration-300">
                            <div class="text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-purple-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <span class="block mt-3 font-medium">Manage Suppliers</span>
                            </div>
                        </a>
                        <a href="{{ route('staff') }}" class="bg-yellow-100 hover:bg-yellow-200 p-6 rounded-lg flex items-center justify-center shadow-md hover:shadow-lg transition-all duration-300">
                            <div class="text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-yellow-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <span class="block mt-3 font-medium">Manage Staff</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // Load statistics when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Fetch counts
            fetchCounts();
            
            // Fetch expiring medicines
            fetchExpiringMedicines();
            
            // Fetch low stock medicines
            fetchLowStockMedicines();
        });
        
        function fetchCounts() {
            // Fetch medicines count
            axios.get('/dashboard/medicines/count')
                .then(response => {
                    document.getElementById('medicinesCount').textContent = response.data.count;
                })
                .catch(error => {
                    console.error('Error fetching medicines count:', error);
                });
                
            // Fetch categories count
            axios.get('/dashboard/categories/count')
                .then(response => {
                    document.getElementById('categoriesCount').textContent = response.data.count;
                })
                .catch(error => {
                    console.error('Error fetching categories count:', error);
                });
                
            // Fetch suppliers count
            axios.get('/dashboard/suppliers/count')
                .then(response => {
                    document.getElementById('suppliersCount').textContent = response.data.count;
                })
                .catch(error => {
                    console.error('Error fetching suppliers count:', error);
                });
                
            // Fetch staff count
            axios.get('/dashboard/staff/count')
                .then(response => {
                    document.getElementById('staffCount').textContent = response.data.count;
                })
                .catch(error => {
                    console.error('Error fetching staff count:', error);
                });
        }
        
        function fetchExpiringMedicines() {
            axios.get('/dashboard/medicines/expiring')
                .then(response => {
                    const medicines = response.data.medicines;
                    const tableBody = document.getElementById('expiringMedicines');
                    
                    if (medicines.length === 0) {
                        tableBody.innerHTML = '<tr><td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" colspan="3">No medicines expiring soon</td></tr>';
                        return;
                    }
                    
                    let html = '';
                    medicines.forEach(medicine => {
                        // Format date to show only YYYY-MM-DD
                        const expiryDate = new Date(medicine.expiry_date);
                        const formattedDate = expiryDate.toISOString().split('T')[0];
                        
                        html += `
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${medicine.name}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${medicine.quantity}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${formattedDate}</td>
                            </tr>
                        `;
                    });
                    tableBody.innerHTML = html;
                })
                .catch(error => {
                    console.error('Error fetching expiring medicines:', error);
                    document.getElementById('expiringMedicines').innerHTML = '<tr><td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" colspan="3">Error loading data</td></tr>';
                });
        }
        
        function fetchLowStockMedicines() {
            axios.get('/dashboard/medicines/low-stock')
                .then(response => {
                    const medicines = response.data.medicines;
                    const tableBody = document.getElementById('lowStockMedicines');
                    
                    if (medicines.length === 0) {
                        tableBody.innerHTML = '<tr><td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" colspan="3">No medicines with low stock</td></tr>';
                        return;
                    }
                    
                    let html = '';
                    medicines.forEach(medicine => {
                        // Handle price as a string or number
                        const price = typeof medicine.price === 'number' 
                            ? '₱' + medicine.price.toFixed(2) 
                            : '₱' + medicine.price;
                            
                        html += `
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${medicine.name}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${medicine.quantity}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${price}</td>
                            </tr>
                        `;
                    });
                    tableBody.innerHTML = html;
                })
                .catch(error => {
                    console.error('Error fetching low stock medicines:', error);
                    document.getElementById('lowStockMedicines').innerHTML = '<tr><td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" colspan="3">Error loading data</td></tr>';
                });
        }
    </script>
</x-app-layout>