<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold">Staff Management</h2>
                        <button id="openAddModal" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Add Staff Member
                        </button>
                    </div>
                    
                    <div id="response" class="mb-4 text-green-600"></div>
                    <div id="errorResponse" class="mb-4 text-red-600"></div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Roles</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($staff as $user)
                                    <tr id="staff-{{ $user->id }}">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @foreach($user->roles as $role)
                                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs mr-1">
                                                    {{ $role->name }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <button 
                                                class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded mr-2 edit-btn" 
                                                data-id="{{ $user->id }}">
                                                Edit
                                            </button>
                                            <button 
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded delete-btn" 
                                                data-id="{{ $user->id }}">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">No staff members found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Staff Modal -->
    <div id="addModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
        <div class="bg-white p-8 rounded-lg w-1/2">
            <h3 class="text-lg font-bold mb-4">Add New Staff Member</h3>
            <form id="addStaffForm">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Roles</label>
                    <div class="mt-2 space-y-2">
                        @foreach($roles as $role)
                            <div class="flex items-center">
                                <input type="checkbox" name="roles[]" id="role_{{ $role->id }}" value="{{ $role->id }}" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="role_{{ $role->id }}" class="ml-2 block text-sm text-gray-900">
                                    {{ $role->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
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

    <!-- Edit Staff Modal -->
    <div id="editModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
        <div class="bg-white p-8 rounded-lg w-1/2">
            <h3 class="text-lg font-bold mb-4">Edit Staff Member</h3>
            <form id="editStaffForm">
                @csrf
                <input type="hidden" id="edit_staff_id">
                <div class="mb-4">
                    <label for="edit_name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="edit_name" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="edit_email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="edit_email" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Roles</label>
                    <div class="mt-2 space-y-2" id="edit_roles">
                        @foreach($roles as $role)
                            <div class="flex items-center">
                                <input type="checkbox" name="roles[]" id="edit_role_{{ $role->id }}" value="{{ $role->id }}" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="edit_role_{{ $role->id }}" class="ml-2 block text-sm text-gray-900">
                                    {{ $role->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
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
            <p class="mb-4">Are you sure you want to delete this staff member?</p>
            <input type="hidden" id="delete_staff_id">
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

        // Add Staff Modal
        document.getElementById('openAddModal').addEventListener('click', function() {
            addModal.classList.remove('hidden');
        });

        document.getElementById('closeAddModal').addEventListener('click', function() {
            addModal.classList.add('hidden');
            document.getElementById('addStaffForm').reset();
        });

        // Edit Staff Modal
        document.getElementById('closeEditModal').addEventListener('click', function() {
            editModal.classList.add('hidden');
        });

        // Delete Staff Modal
        document.getElementById('closeDeleteModal').addEventListener('click', function() {
            deleteModal.classList.add('hidden');
        });

        // Add Staff Form Submission
        document.getElementById('addStaffForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const roles = Array.from(formData.getAll('roles[]'));
            
            const data = {
                name: formData.get('name'),
                email: formData.get('email'),
                password: formData.get('password'),
                password_confirmation: formData.get('password_confirmation'),
                roles: roles
            };

            axios.post('/staff', data)
                .then(response => {
                    responseDiv.textContent = response.data.success;
                    errorResponseDiv.textContent = '';
                    document.getElementById('addStaffForm').reset();
                    addModal.classList.add('hidden');
                    // Reload the page to show the new staff member
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

        // Edit Staff Event Listeners
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const staffId = this.getAttribute('data-id');
                document.getElementById('edit_staff_id').value = staffId;
                
                // Clear all checkboxes
                document.querySelectorAll('#edit_roles input[type="checkbox"]').forEach(checkbox => {
                    checkbox.checked = false;
                });
                
                // Fetch staff details
                axios.get(`/staff/${staffId}`)
                    .then(response => {
                        const user = response.data;
                        document.getElementById('edit_name').value = user.name;
                        document.getElementById('edit_email').value = user.email;
                        
                        // Check role checkboxes
                        user.roles.forEach(role => {
                            const checkbox = document.getElementById(`edit_role_${role.id}`);
                            if (checkbox) {
                                checkbox.checked = true;
                            }
                        });
                        
                        editModal.classList.remove('hidden');
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        errorResponseDiv.textContent = 'Error: ' + (error.response?.data?.message || 'Something went wrong');
                        responseDiv.textContent = '';
                    });
            });
        });

        // Edit Staff Form Submission
        document.getElementById('editStaffForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const staffId = document.getElementById('edit_staff_id').value;
            const formData = new FormData(this);
            const roles = Array.from(formData.getAll('roles[]'));
            
            const data = {
                name: formData.get('name'),
                email: formData.get('email'),
                roles: roles
            };

            axios.put(`/staff/${staffId}`, data)
                .then(response => {
                    responseDiv.textContent = response.data.success;
                    errorResponseDiv.textContent = '';
                    editModal.classList.add('hidden');
                    // Reload the page to show the updated staff member
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

        // Delete Staff Event Listeners
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const staffId = this.getAttribute('data-id');
                document.getElementById('delete_staff_id').value = staffId;
                deleteModal.classList.remove('hidden');
            });
        });

        // Confirm Delete Button
        document.getElementById('confirmDelete').addEventListener('click', function() {
            const staffId = document.getElementById('delete_staff_id').value;
            
            axios.delete(`/staff/${staffId}`)
                .then(response => {
                    responseDiv.textContent = response.data.success;
                    errorResponseDiv.textContent = '';
                    deleteModal.classList.add('hidden');
                    // Remove the deleted row from the table
                    const staffRow = document.getElementById(`staff-${staffId}`);
                    if (staffRow) {
                        staffRow.remove();
                    }
                    // If no more staff, add the "No staff found" row
                    const tableBody = document.querySelector('tbody');
                    if (tableBody.children.length === 0) {
                        const noStaffRow = document.createElement('tr');
                        noStaffRow.innerHTML = '<td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">No staff members found</td>';
                        tableBody.appendChild(noStaffRow);
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