<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold">Expired & Expiring Medicines</h2>
                        <div>
                            <select id="filterType" class="border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="all">All</option>
                                <option value="expired">Expired</option>
                                <option value="expiring">Expiring in 30 days</option>
                                <option value="expiring90">Expiring in 90 days</option>
                            </select>
                        </div>
                    </div>
                    
                    <div id="response" class="mb-4 text-green-600"></div>
                    <div id="errorResponse" class="mb-4 text-red-600"></div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Expiry Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="medicinesTable">
                                <!-- Medicines will be loaded here via JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
        <div class="bg-white p-8 rounded-lg w-1/3">
            <h3 class="text-lg font-bold mb-4">Confirm Delete</h3>
            <p class="mb-4">Are you sure you want to delete this medicine?</p>
            <input type="hidden" id="delete_medicine_id">
            <div class="flex justify-end">
                <button type="button" id="closeDeleteModal" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2">
                    Cancel
                </button>
                <button type="button" id="confirmDelete" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    Delete
                </button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // DOM elements
        const responseDiv = document.getElementById('response');
        const errorResponseDiv = document.getElementById('errorResponse');
        const medicinesTable = document.getElementById('medicinesTable');
        const filterType = document.getElementById('filterType');
        const deleteModal = document.getElementById('deleteModal');
        
        // Load medicines based on filter
        function loadMedicines(filter = 'all') {
            axios.get(`/expired-medicines?filter=${filter}`)
                .then(response => {
                    const medicines = response.data;
                    renderMedicinesTable(medicines);
                })
                .catch(error => {
                    console.error('Error:', error);
                    errorResponseDiv.textContent = 'Error: ' + (error.response?.data?.message || 'Something went wrong');
                    responseDiv.textContent = '';
                });
        }
        
        // Render medicines table
        function renderMedicinesTable(medicines) {
            medicinesTable.innerHTML = '';
            
            if (medicines.length === 0) {
                medicinesTable.innerHTML = `
                    <tr>
                        <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">No medicines found</td>
                    </tr>
                `;
                return;
            }
            
            medicines.forEach(medicine => {
                // Determine status
                let status = '';
                let statusClass = '';
                
                const today = new Date();
                const expiryDate = new Date(medicine.expiry_date);
                const daysUntilExpiry = Math.ceil((expiryDate - today) / (1000 * 60 * 60 * 24));
                
                if (daysUntilExpiry < 0) {
                    status = 'Expired';
                    statusClass = 'text-red-600 font-bold';
                } else if (daysUntilExpiry <= 30) {
                    status = `Expires in ${daysUntilExpiry} days`;
                    statusClass = 'text-orange-600 font-semibold';
                } else if (daysUntilExpiry <= 90) {
                    status = `Expires in ${daysUntilExpiry} days`;
                    statusClass = 'text-yellow-600';
                } else {
                    status = 'Valid';
                    statusClass = 'text-green-600';
                }
                
                const row = document.createElement('tr');
                row.id = `medicine-${medicine.id}`;
                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${medicine.name}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${medicine.description || ''}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">₱${Number(medicine.price).toFixed(2)}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${medicine.quantity}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${medicine.expiry_date.split('T')[0]}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm ${statusClass}">${status}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded delete-btn" data-id="${medicine.id}">
                            Delete
                        </button>
                    </td>
                `;
                medicinesTable.appendChild(row);
            });
            
            // Add event listeners to delete buttons
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const medicineId = this.getAttribute('data-id');
                    document.getElementById('delete_medicine_id').value = medicineId;
                    deleteModal.classList.remove('hidden');
                });
            });
        }
        
        // Filter change event listener
        filterType.addEventListener('change', function() {
            loadMedicines(this.value);
        });
        
        // Delete modal events
        document.getElementById('closeDeleteModal').addEventListener('click', function() {
            deleteModal.classList.add('hidden');
        });
        
        // Confirm Delete Button
        document.getElementById('confirmDelete').addEventListener('click', function() {
            const medicineId = document.getElementById('delete_medicine_id').value;
            
            axios.delete(`/medicines/${medicineId}`)
                .then(response => {
                    responseDiv.textContent = response.data.success;
                    errorResponseDiv.textContent = '';
                    deleteModal.classList.add('hidden');
                    
                    // Remove the deleted row from the table
                    const medicineRow = document.getElementById(`medicine-${medicineId}`);
                    if (medicineRow) {
                        medicineRow.remove();
                    }
                    
                    // If no more medicines, show "No medicines found"
                    if (medicinesTable.children.length === 0) {
                        medicinesTable.innerHTML = `
                            <tr>
                                <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">No medicines found</td>
                            </tr>
                        `;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    errorResponseDiv.textContent = 'Error: ' + (error.response?.data?.message || 'Something went wrong');
                    responseDiv.textContent = '';
                });
        });
        
        // Load medicines when page loads
        document.addEventListener('DOMContentLoaded', function() {
            loadMedicines('all');
        });
    </script>
</x-app-layout>