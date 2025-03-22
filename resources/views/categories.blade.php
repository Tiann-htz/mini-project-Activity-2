<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold">Medicine Categories</h2>
                        <button id="openAddModal" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Add Category
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
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assigned Medicines</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @forelse($categories as $category)
            <tr id="category-{{ $category->id }}">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $category->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $category->description }}</td>
                <td class="px-6 py-4 text-sm text-gray-500 assigned-medicines">
                    <div class="flex flex-wrap gap-1 max-w-md">
                        @forelse($category->medicines as $medicine)
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-0.5 rounded">
                                {{ $medicine->name }}
                            </span>
                        @empty
                            <span class="text-gray-400 italic">No medicines assigned</span>
                        @endforelse
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <button 
                        class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded mr-2 edit-btn" 
                        data-id="{{ $category->id }}">
                        Edit
                    </button>
                    <button 
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mr-2 assign-btn" 
                        data-id="{{ $category->id }}">
                        Assign Medicines
                    </button>
                    <button 
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded delete-btn" 
                        data-id="{{ $category->id }}">
                        Delete
                    </button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">No categories found</td>
            </tr>
        @endforelse
    </tbody>
</table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div id="addModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
        <div class="bg-white p-8 rounded-lg w-1/2">
            <h3 class="text-lg font-bold mb-4">Add New Category</h3>
            <form id="addCategoryForm">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
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

    <!-- Edit Category Modal -->
    <div id="editModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
        <div class="bg-white p-8 rounded-lg w-1/2">
            <h3 class="text-lg font-bold mb-4">Edit Category</h3>
            <form id="editCategoryForm">
                @csrf
                <input type="hidden" id="edit_category_id">
                <div class="mb-4">
                    <label for="edit_name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="edit_name" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="edit_description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="edit_description" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
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

    <!-- Assign Medicines Modal -->
    <div id="assignModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
        <div class="bg-white p-8 rounded-lg w-2/3">
            <h3 class="text-lg font-bold mb-4">Assign Medicines to Category: <span id="categoryName"></span></h3>
            <form id="assignMedicinesForm">
                @csrf
                <input type="hidden" id="assign_category_id">
                <div class="mb-4 max-h-96 overflow-y-auto">
                    <div id="medicinesList" class="grid grid-cols-1 gap-2">
                        <!-- Medicines will be loaded here -->
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="button" id="closeAssignModal" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2">
                        Cancel
                    </button>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Save Assignments
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
        <div class="bg-white p-8 rounded-lg w-1/3">
            <h3 class="text-lg font-bold mb-4">Confirm Delete</h3>
            <p class="mb-4">Are you sure you want to delete this category?</p>
            <input type="hidden" id="delete_category_id">
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
        const assignModal = document.getElementById('assignModal');
        const deleteModal = document.getElementById('deleteModal');
        const responseDiv = document.getElementById('response');
        const errorResponseDiv = document.getElementById('errorResponse');

        // Add Category Modal
        document.getElementById('openAddModal').addEventListener('click', function() {
            addModal.classList.remove('hidden');
        });

        document.getElementById('closeAddModal').addEventListener('click', function() {
            addModal.classList.add('hidden');
            document.getElementById('addCategoryForm').reset();
        });

        // Edit Category Modal
        document.getElementById('closeEditModal').addEventListener('click', function() {
            editModal.classList.add('hidden');
        });

        // Assign Medicines Modal
        document.getElementById('closeAssignModal').addEventListener('click', function() {
            assignModal.classList.add('hidden');
        });

        // Delete Category Modal
        document.getElementById('closeDeleteModal').addEventListener('click', function() {
            deleteModal.classList.add('hidden');
        });

        // Add Category Form Submission
        document.getElementById('addCategoryForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const data = {
                name: formData.get('name'),
                description: formData.get('description')
            };

            axios.post('/categories', data)
                .then(response => {
                    responseDiv.textContent = response.data.success;
                    errorResponseDiv.textContent = '';
                    document.getElementById('addCategoryForm').reset();
                    addModal.classList.add('hidden');
                    // Reload the page to show the new category
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

        // Edit Category Event Listeners
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const categoryId = this.getAttribute('data-id');
                document.getElementById('edit_category_id').value = categoryId;
                
                // Fetch category details
                axios.get(`/categories/${categoryId}`)
                    .then(response => {
                        const category = response.data;
                        document.getElementById('edit_name').value = category.name;
                        document.getElementById('edit_description').value = category.description;
                        
                        editModal.classList.remove('hidden');
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        errorResponseDiv.textContent = 'Error: ' + (error.response?.data?.message || 'Something went wrong');
                        responseDiv.textContent = '';
                    });
            });
        });

        // Edit Category Form Submission
        document.getElementById('editCategoryForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const categoryId = document.getElementById('edit_category_id').value;
            const formData = new FormData(this);
            const data = {
                name: formData.get('name'),
                description: formData.get('description')
            };

            axios.put(`/categories/${categoryId}`, data)
                .then(response => {
                    responseDiv.textContent = response.data.success;
                    errorResponseDiv.textContent = '';
                    editModal.classList.add('hidden');
                    // Reload the page to show the updated category
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

        // Assign Medicines Event Listeners
        document.querySelectorAll('.assign-btn').forEach(button => {
            button.addEventListener('click', function() {
                const categoryId = this.getAttribute('data-id');
                document.getElementById('assign_category_id').value = categoryId;
                
                // Fetch category name and medicines
                axios.get(`/categories/${categoryId}`)
                    .then(response => {
                        const category = response.data;
                        document.getElementById('categoryName').textContent = category.name;
                        
                        // Fetch all medicines and category's medicines
                        Promise.all([
                            axios.get('/medicines-list'),
                            axios.get(`/categories/${categoryId}/medicines`)
                        ])
                        .then(([allMedicinesResponse, categoryMedicinesResponse]) => {
                            const allMedicines = allMedicinesResponse.data;
                             const categoryMedicines = categoryMedicinesResponse.data;
                            
                            // Create a Set of medicine IDs that are already assigned to this category
                            const assignedMedicineIds = new Set(categoryMedicines.map(medicine => medicine.id));
                            
                            // Generate checkboxes for all medicines
                            const medicinesList = document.getElementById('medicinesList');
                            medicinesList.innerHTML = '';
                            
                            allMedicines.forEach(medicine => {
                                const isChecked = assignedMedicineIds.has(medicine.id);
                                const medicineItem = document.createElement('div');
                                medicineItem.className = 'flex items-center';
                                medicineItem.innerHTML = `
                                    <input type="checkbox" name="medicines[]" value="${medicine.id}" id="medicine-${medicine.id}" 
                                        class="mr-2" ${isChecked ? 'checked' : ''}>
                                    <label for="medicine-${medicine.id}" class="text-sm">${medicine.name} (${medicine.quantity} in stock)</label>
                                `;
                                medicinesList.appendChild(medicineItem);
                            });
                            
                            assignModal.classList.remove('hidden');
                        })
                        .catch(error => {
                            console.error('Error fetching medicines:', error);
                            errorResponseDiv.textContent = 'Error: ' + (error.response?.data?.message || 'Something went wrong');
                            responseDiv.textContent = '';
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching category:', error);
                        errorResponseDiv.textContent = 'Error: ' + (error.response?.data?.message || 'Something went wrong');
                        responseDiv.textContent = '';
                    });
            });
        });

        // Assign Medicines Form Submission
        document.getElementById('assignMedicinesForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const categoryId = document.getElementById('assign_category_id').value;
            const formData = new FormData(this);
            const medicineIds = formData.getAll('medicines[]');

            axios.post(`/categories/${categoryId}/medicines`, { medicines: medicineIds })
                .then(response => {
                    responseDiv.textContent = response.data.success;
                    errorResponseDiv.textContent = '';
                    assignModal.classList.add('hidden');
                    
                    // Update the list of assigned medicines in the table without refreshing
                    updateAssignedMedicines(categoryId, medicineIds);
                })
                .catch(error => {
                    console.error('Error:', error);
                    errorResponseDiv.textContent = 'Error: ' + (error.response?.data?.message || 'Something went wrong');
                    responseDiv.textContent = '';
                });
        });

        // Function to update the assigned medicines display in the table
        function updateAssignedMedicines(categoryId, medicineIds) {
            // If no medicines are assigned, show "No medicines assigned" message
            if (medicineIds.length === 0) {
                const tdElement = document.querySelector(`#category-${categoryId} .assigned-medicines`);
                if (tdElement) {
                    tdElement.innerHTML = '<span class="text-gray-400 italic">No medicines assigned</span>';
                }
                return;
            }

            // Fetch details of all medicines to get their names
            axios.get('/medicines-list')
                .then(response => {
                    const allMedicines = response.data;
                    
                    // Create a map of medicine IDs to names
                    const medicineMap = new Map();
                    allMedicines.forEach(medicine => {
                        medicineMap.set(medicine.id.toString(), medicine.name);
                    });
                    
                    // Create span elements for each assigned medicine
                    const assignedMedicineSpans = medicineIds.map(id => {
                        const medicineName = medicineMap.get(id.toString()) || 'Unknown';
                        return `<span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-0.5 rounded mr-1 mb-1 inline-block">
                            ${medicineName}
                        </span>`;
                    }).join('');
                    
                    // Update the assigned medicines column for this category
                    const tdElement = document.querySelector(`#category-${categoryId} .assigned-medicines`);
                    if (tdElement) {
                        tdElement.innerHTML = `<div class="flex flex-wrap gap-1 max-w-md">${assignedMedicineSpans}</div>`;
                    }
                })
                .catch(error => {
                    console.error('Error fetching medicines for display:', error);
                });
        }

        // Delete Category Event Listeners
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const categoryId = this.getAttribute('data-id');
                document.getElementById('delete_category_id').value = categoryId;
                deleteModal.classList.remove('hidden');
            });
        });

        // Confirm Delete Button
        document.getElementById('confirmDelete').addEventListener('click', function() {
            const categoryId = document.getElementById('delete_category_id').value;
            
            axios.delete(`/categories/${categoryId}`)
                .then(response => {
                    responseDiv.textContent = response.data.success;
                    errorResponseDiv.textContent = '';
                    deleteModal.classList.add('hidden');
                    // Remove the deleted row from the table
                    const categoryRow = document.getElementById(`category-${categoryId}`);
                    if (categoryRow) {
                        categoryRow.remove();
                    }
                    // If no more categories, add the "No categories found" row
                    const tableBody = document.querySelector('tbody');
                    if (tableBody.children.length === 0) {
                        const noCategories = document.createElement('tr');
                        noCategories.innerHTML = '<td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">No categories found</td>';
                        tableBody.appendChild(noCategories);
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