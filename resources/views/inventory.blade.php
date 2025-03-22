<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold">Medicine Inventory</h2>
                        <button id="openAddModal" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Add Medicine
                        </button>
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
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Manufacturer</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($medicines as $medicine)
                                    <tr id="medicine-{{ $medicine->id }}">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $medicine->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $medicine->description }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">₱{{ number_format($medicine->price, 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $medicine->quantity }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $medicine->expiry_date->format('Y-m-d') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $medicine->manufacturer }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <button 
                                                class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded mr-2 edit-btn" 
                                                data-id="{{ $medicine->id }}">
                                                Edit
                                            </button>
                                            <button 
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded delete-btn" 
                                                data-id="{{ $medicine->id }}">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">No medicines found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Medicine Modal -->
    <div id="addModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
        <div class="bg-white p-8 rounded-lg w-1/2">
            <h3 class="text-lg font-bold mb-4">Add New Medicine</h3>
            <form id="addMedicineForm">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="number" step="0.01" name="price" id="price" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                    <input type="number" name="quantity" id="quantity" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="expiry_date" class="block text-sm font-medium text-gray-700">Expiry Date</label>
                    <input type="date" name="expiry_date" id="expiry_date" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="manufacturer" class="block text-sm font-medium text-gray-700">Manufacturer</label>
                    <input type="text" name="manufacturer" id="manufacturer" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="flex justify-end">
                    <button type="button" id="closeAddModal" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2">
                        Cancel
                    </button>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Medicine Modal -->
    <div id="editModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
        <div class="bg-white p-8 rounded-lg w-1/2">
            <h3 class="text-lg font-bold mb-4">Edit Medicine</h3>
            <form id="editMedicineForm">
                @csrf
                <input type="hidden" id="edit_medicine_id">
                <div class="mb-4">
                    <label for="edit_name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="edit_name" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="edit_description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="edit_description" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                </div>
                <div class="mb-4">
                    <label for="edit_price" class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="number" step="0.01" name="price" id="edit_price" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="edit_quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                    <input type="number" name="quantity" id="edit_quantity" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="edit_expiry_date" class="block text-sm font-medium text-gray-700">Expiry Date</label>
                    <input type="date" name="expiry_date" id="edit_expiry_date" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="edit_manufacturer" class="block text-sm font-medium text-gray-700">Manufacturer</label>
                    <input type="text" name="manufacturer" id="edit_manufacturer" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="flex justify-end">
                    <button type="button" id="closeEditModal" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2">
                        Cancel
                    </button>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Update
                    </button>
                </div>
            </form>
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
        // Modal controls
        const addModal = document.getElementById('addModal');
        const editModal = document.getElementById('editModal');
        const deleteModal = document.getElementById('deleteModal');
        const responseDiv = document.getElementById('response');
        const errorResponseDiv = document.getElementById('errorResponse');

        // Add Medicine Modal
        document.getElementById('openAddModal').addEventListener('click', function() {
            addModal.classList.remove('hidden');
        });

        document.getElementById('closeAddModal').addEventListener('click', function() {
            addModal.classList.add('hidden');
            document.getElementById('addMedicineForm').reset();
        });

        // Edit Medicine Modal
        document.getElementById('closeEditModal').addEventListener('click', function() {
            editModal.classList.add('hidden');
        });

        // Delete Medicine Modal
        document.getElementById('closeDeleteModal').addEventListener('click', function() {
            deleteModal.classList.add('hidden');
        });

        // Add Medicine Form Submission
        document.getElementById('addMedicineForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const data = {
                name: formData.get('name'),
                description: formData.get('description'),
                price: formData.get('price'),
                quantity: formData.get('quantity'),
                expiry_date: formData.get('expiry_date'),
                manufacturer: formData.get('manufacturer')
            };

            axios.post('/medicines', data)
                .then(response => {
                    responseDiv.textContent = response.data.success;
                    errorResponseDiv.textContent = '';
                    document.getElementById('addMedicineForm').reset();
                    addModal.classList.add('hidden');
                    // Reload the page to show the new medicine
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                })
                .catch(error => {
                    console.error('Error:', error);
                    errorResponseDiv.textContent = 'Error: ' + (error.response?.data?.message || 'Something went wrong');
                    responseDiv.textContent = '';
                });
        });

        // Edit Medicine Event Listeners
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const medicineId = this.getAttribute('data-id');
                document.getElementById('edit_medicine_id').value = medicineId;
                
                // Fetch medicine details
                axios.get(`/medicines/${medicineId}`)
                    .then(response => {
                        const medicine = response.data;
                        document.getElementById('edit_name').value = medicine.name;
                        document.getElementById('edit_description').value = medicine.description;
                        document.getElementById('edit_price').value = medicine.price;
                        document.getElementById('edit_quantity').value = medicine.quantity;
                        document.getElementById('edit_expiry_date').value = medicine.expiry_date.split('T')[0];
                        document.getElementById('edit_manufacturer').value = medicine.manufacturer;
                        
                        editModal.classList.remove('hidden');
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        errorResponseDiv.textContent = 'Error: ' + (error.response?.data?.message || 'Something went wrong');
                        responseDiv.textContent = '';
                    });
            });
        });

        // Edit Medicine Form Submission
        document.getElementById('editMedicineForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const medicineId = document.getElementById('edit_medicine_id').value;
            const formData = new FormData(this);
            const data = {
                name: formData.get('name'),
                description: formData.get('description'),
                price: formData.get('price'),
                quantity: formData.get('quantity'),
                expiry_date: formData.get('expiry_date'),
                manufacturer: formData.get('manufacturer')
            };

            axios.put(`/medicines/${medicineId}`, data)
                .then(response => {
                    responseDiv.textContent = response.data.success;
                    errorResponseDiv.textContent = '';
                    editModal.classList.add('hidden');
                    // Reload the page to show the updated medicine
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                })
                .catch(error => {
                    console.error('Error:', error);
                    errorResponseDiv.textContent = 'Error: ' + (error.response?.data?.message || 'Something went wrong');
                    responseDiv.textContent = '';
                });
        });

        // Delete Medicine Event Listeners
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const medicineId = this.getAttribute('data-id');
                document.getElementById('delete_medicine_id').value = medicineId;
                deleteModal.classList.remove('hidden');
            });
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
                    // If no more medicines, add the "No medicines found" row
                    const tableBody = document.querySelector('tbody');
                    if (tableBody.children.length === 0) {
                        const noMedicinesRow = document.createElement('tr');
                        noMedicinesRow.innerHTML = '<td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">No medicines found</td>';
                        tableBody.appendChild(noMedicinesRow);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    errorResponseDiv.textContent = 'Error: ' + (error.response?.data?.message || 'Something went wrong');
                    responseDiv.textContent = '';
                });
        });
    </script>
</x-app-layout>