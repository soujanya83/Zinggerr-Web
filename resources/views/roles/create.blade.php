@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet">
@section('pageTitle', ' Create Role')

@section('content')
@include('partials.sidebar')
@include('partials.header')

<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col">


                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3>Add Roles</h3>
                            <div>
                                <button class="btn btn-outline-primary me-2">Return</button>


                                <!-- Button to trigger the modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#createRoleModal">
                                    Add
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="createRoleModal" tabindex="-1"
                                    aria-labelledby="createRoleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="createRoleModalLabel">Create Role</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('roles.store') }}">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Role Name</label>
                                                        <input type="text" class="form-control" id="name" name="name"
                                                            required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="user_display" class="form-label">User
                                                            Display</label>
                                                        <input type="text" class="form-control" id="user_display"
                                                            name="user_display" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="description" class="form-label">Description</label>
                                                        <textarea class="form-control" id="description"
                                                            name="description" rows="3"></textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Search" id="searchInput">
                        </div>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th> Name</th>
                                    <th>UserDisplay</th>
                                    <th>Discription</th>
                                    
                                </tr>
                            </thead>
                            <tbody id="roleTableBody">
                                <!-- Dynamic rows will be inserted here -->
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <nav>
                            <ul class="pagination justify-content-center">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                    <!-- Bootstrap JS -->
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js">
                    </script>
                    <script>
                    // Example JavaScript for populating the table
                    const roles = [{
                            name: 'Administrator',
                            status: 'Active'
                        },
                        {
                            name: 'Audit',
                            status: 'Active'
                        },
                        {
                            name: 'Author',
                            status: 'Active'
                        },
                        {
                            name: 'Contributor',
                            status: 'Active'
                        },
                        {
                            name: 'Editor',
                            status: 'Disabled'
                        },
                        {
                            name: 'Manager',
                            status: 'Active'
                        },
                        {
                            name: 'Writer',
                            status: 'Active'
                        },
                    ];

                    const roleTableBody = document.getElementById('roleTableBody');

                    roles.forEach(role => {
                        const row = `
                <tr>
                    <td>${role.name}</td>
                    <td>${role.status}</td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-light text-info"><i class="bi bi-eye"></i></button>
                        <button class="btn btn-sm btn-light text-primary"><i class="bi bi-pencil"></i></button>
                        <button class="btn btn-sm btn-light text-danger"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
            `;
                        roleTableBody.innerHTML += row;
                    });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<script>
// Populate modal fields when the edit button is clicked
$('#editRoleModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var roleId = button.data('role-id');
    var roleName = button.data('role-name');
    var roleDisplayName = button.data('role-display-name');
    var roleDescription = button.data('role-description');

    var modal = $(this);
    modal.find('.modal-title').text('Edit Role: ' + roleName);
    modal.find('#role_name').val(roleName);
    modal.find('#role_display_name').val(roleDisplayName);
    modal.find('#role_description').val(roleDescription);

    // Set the form action URL dynamically
    modal.find('#editRoleForm').attr('action', '/roles/' + roleId);
});
</script>
@include('partials.footer')
@endsection