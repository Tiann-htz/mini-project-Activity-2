<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold">Suppliers Management</h2>
                        <button id="openAddModal" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Add Supplier
                        </button>
                    </div>
                    
                    <div id="response" class="mb-4 text-green-600"></div>
                    <div id="errorResponse" class="mb-4 text-red-600"></div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact Person</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Address</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($suppliers as $supplier)
                                    <tr id="supplier-{{ $supplier->id }}">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $supplier->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $supplier->contact_person }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $supplier->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $supplier->phone }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $supplier->address }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <button 
                                                class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded mr-2 edit-btn" 
                                                data-id="{{ $supplier->id }}">
                                                Edit
                                            </button>
                                            <button 
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded delete-btn" 
                                                data-id="{{ $supplier->id }}">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">No suppliers found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Supplier Modal -->
    <div id="addModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
        <div class="bg-white p-8 rounded-lg w-1/2">
            <h3 class="text-lg font-bold mb-4">Add New Supplier</h3>
            <form id="addSupplierForm">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="contact_person" class="block text-sm font-medium text-gray-700">Contact Person</label>
                    <input type="text" name="contact_person" id="contact_person" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="text" name="phone" id="phone" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <textarea name="address" id="address" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
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

    <!-- Edit Supplier Modal -->
    <div id="editModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
        <div class="bg-white p-8 rounded-lg w-1/2">
            <h3 class="text-lg font-bold mb-4">Edit Supplier</h3>
            <form id="editSupplierForm">
                @csrf
                <input type="hidden" id="edit_supplier_id">
                <div class="mb-4">
                    <label for="edit_name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="edit_name" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="edit_contact_person" class="block text-sm font-medium text-gray-700">Contact Person</label>
                    <input type="text" name="contact_person" id="edit_contact_person" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="edit_email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="edit_email" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="edit_phone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="text" name="phone" id="edit_phone" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="edit_address" class="block text-sm font-medium text-gray-700">Address</label>
                    <textarea name="address" id="edit_address" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
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
            <p class="mb-4">Are you sure you want to delete this supplier?</p>
            <input type="hidden" id="delete_supplier_id">
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

        // Add Supplier Modal
        document.getElementById('openAddModal').addEventListener('click', function() {
            addModal.classList.remove('hidden');
        });

        document.getElementById('closeAddModal').addEventListener('click', function() {
            addModal.classList.add('hidden');
            document.getElementById('addSupplierForm').reset();
        });

        // Edit Supplier Modal
        document.getElementById('closeEditModal').addEventListener('click', function() {
            editModal.classList.add('hidden');
        });

        // Delete Supplier Modal
        document.getElementById('closeDeleteModal').addEventListener('click', function() {
            deleteModal.classList.add('hidden');
        });

        // Add Supplier Form Submission
        document.getElementById('addSupplierForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const data = {
                name: formData.get('name'),
                contact_person: formData.get('contact_person'),
                email: formData.get('email'),
                phone: formData.get('phone'),
                address: formData.get('address')
            };

            axios.post('/suppliers', data)
                .then(response => {
                    responseDiv.textContent = response.data.success;
                    errorResponseDiv.textContent = '';
                    document.getElementById('addSupplierForm').reset();
                    addModal.classList.add('hidden');
                    // Reload the page to show the new supplier
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

        // Edit Supplier Event Listeners
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const supplierId = this.getAttribute('data-id');
                document.getElementById('edit_supplier_id').value = supplierId;
                
                // Fetch supplier details
                axios.get(`/suppliers/${supplierId}`)
                    .then(response => {
                        const supplier = response.data;
                        document.getElementById('edit_name').value = supplier.name;
                        document.getElementById('edit_contact_person').value = supplier.contact_person;
                        document.getElementById('edit_email').value = supplier.email;
                        document.getElementById('edit_phone').value = supplier.phone;
                        document.getElementById('edit_address').value = supplier.address;
                        
                        editModal.classList.remove('hidden');
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        errorResponseDiv.textContent = 'Error: ' + (error.response?.data?.message || 'Something went wrong');
                        responseDiv.textContent = '';
                    });
            });
        });

        // Edit Supplier Form Submission
        document.getElementById('editSupplierForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const supplierId = document.getElementById('edit_supplier_id').value;
            const formData = new FormData(this);
            const data = {
                name: formData.get('name'),
                contact_person: formData.get('contact_person'),
                email: formData.get('email'),
                phone: formData.get('phone'),
                address: formData.get('address')
            };

            axios.put(`/suppliers/${supplierId}`, data)
                .then(response => {
                    responseDiv.textContent = response.data.success;
                    errorResponseDiv.textContent = '';
                    editModal.classList.add('hidden');
                    // Reload the page to show the updated supplier
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

        // Delete Supplier Event Listeners
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const supplierId = this.getAttribute('data-id');
                document.getElementById('delete_supplier_id').value = supplierId;
                deleteModal.classList.remove('hidden');
            });
        });

        // Confirm Delete Button
        document.getElementById('confirmDelete').addEventListener('click', function() {
            const supplierId = document.getElementById('delete_supplier_id').value;
            
            axios.delete(`/suppliers/${supplierId}`)
                .then(response => {
                    responseDiv.textContent = response.data.success;
                    errorResponseDiv.textContent = '';
                    deleteModal.classList.add('hidden');
                    // Remove the deleted row from the table
                    const supplierRow = document.getElementById(`supplier-${supplierId}`);
                    if (supplierRow) {
                        supplierRow.remove();
                    }
                    // If no more suppliers, add the "No suppliers found" row
                    const tableBody = document.querySelector('tbody');
                    if (tableBody.children.length === 0) {
                        const noSuppliersRow = document.createElement('tr');
                        noSuppliersRow.innerHTML = '<td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">No suppliers found</td>';
                        tableBody.appendChild(noSuppliersRow);
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