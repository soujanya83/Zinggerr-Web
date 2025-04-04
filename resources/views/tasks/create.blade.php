@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

@section('pageTitle', ' Task Create')

@section('content')
@include('partials.sidebar')
@include('partials.headerdashboard')
{{-- <style>
    /* Ensure the dropdown menu aligns properly with the input */
    .dropdown {
        position: relative;
    }

    /* Optional: Add some styling to match the image */
    .form-control-sm {
        border-radius: 0.25rem;
        border: 1px solid #ced4da;
    }

    .dropdown-menu {
        border-radius: 0.25rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
</style> --}}
{{-- <style>
    .selected-item {
        display: inline-flex;
        align-items: center;
        background-color: #e9ecef;
        padding: 5px 10px;
        margin: 5px;
        border-radius: 15px;
        font-size: 14px;
    }

    .selected-item img {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        margin-right: 8px;
    }

    .selected-item .role {
        color: #6c757d;
        font-size: 12px;
        margin-left: 5px;
    }

    .remove-btn {
        margin-left: 8px;
        cursor: pointer;
        color: #dc3545;
        font-weight: bold;
    }
</style> --}}
<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Create Task</h5>
                        </div>
                    </div>

                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Create Task</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="row">
            <div class="tab-pane" id="request" role="tabpanel" aria-labelledby="request-tab">
                <div class="card">

                    <div class="card-header" style="margin-bottom: -28px;">
                        <div class="row align-items-center g-2">
                            <div class="col">
                                <h5>Create Task</h5>
                            </div>

                            <div class="card-body">

                                <form id="permissionForm" action="{{ route('task.store') }}" method="post"
                                    autocomplete="off">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Title</label>
                                                <input type="text" class="form-control" name="title"
                                                    placeholder="Enter Task Title.." value="{{ old('title') }}"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="task_date">Deadline</label>
                                                <input type="text" class="form-control" name="task_date" id="task_date"
                                                    required value="{{ old('task_date') }}" placeholder="dd/mm/yyyy">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Description</label>
                                            <div class="form-floating mb-3">
                                                <textarea id="summernote" name="description" class="form-control"
                                                    required>{{ old('description') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3 mt-4">
                                                <label></label>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        id="active" value="1" checked>
                                                    <label class="form-check-label" for="active">Active</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        id="inactive" value="0">
                                                    <label class="form-check-label" for="inactive">Inactive</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3 mt-4">
                                                <label>Assign To</label>
                                                <button type="button" class="btn btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#assignModal">
                                                    Select Users
                                                </button>
                                                <div id="selected-items-outside" class="mt-2"></div>
                                                <div id="hidden-inputs"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <input type="submit" class="btn btn-shadow btn-primary" value="Submit">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="assignModal" tabindex="-1" aria-labelledby="assignModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignModalLabel">Assign Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="selected-items" class="mb-3 d-flex flex-wrap align-items-center"></div>
                <ul class="nav nav-tabs" id="assignTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="users-tab" data-bs-toggle="tab" data-bs-target="#users"
                            type="button" role="tab" aria-controls="users" aria-selected="true">Users</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="roles-tab" data-bs-toggle="tab" data-bs-target="#roles"
                            type="button" role="tab" aria-controls="roles" aria-selected="false">Roles</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="courses-tab" data-bs-toggle="tab" data-bs-target="#courses"
                            type="button" role="tab" aria-controls="courses" aria-selected="false">Courses</button>
                    </li>
                </ul>
                <div class="tab-content" id="assignTabContent">
                    <div class="tab-pane fade show active" id="users" role="tabpanel" aria-labelledby="users-tab">
                        <input type="text" class="form-control mt-2 mb-2 user-search" placeholder="Search users...">
                        <div class="list-container user-list" style="max-height: 200px; overflow-y: auto;">
                            <!-- Users will be populated via AJAX -->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="roles" role="tabpanel" aria-labelledby="roles-tab">
                        <input type="text" class="form-control mt-2 mb-2 role-search" placeholder="Search roles...">
                        <div class="list-container role-list" style="max-height: 200px; overflow-y: auto">
                            <!-- Roles will be populated via AJAX -->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="courses" role="tabpanel" aria-labelledby="courses-tab">
                        <input type="text" class="form-control mt-2 mb-2 course-search" placeholder="Search courses...">
                        <div class="list-container course-list" style="max-height: 200px; overflow-y: auto">
                            <!-- Courses will be populated via AJAX -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="saveAssignments" data-bs-dismiss="modal">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Summernote CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>

<script>
    $(document).ready(function () {
        // Initialize Summernote on the textarea
        $('#summernote').summernote({
            placeholder: 'Enter description here...',
            tabsize: 2,
            height: 90, // Adjust the height as needed
            toolbar: [
                // Custom toolbar options
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                // ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
</script>

<script>
    $(document).ready(function() {
    // Store fetched data
    let assignmentData = {
        users: [],
        roles: [],
        courses: [],
        roleUserMap: {},
        courseUserMap: {}
    };

    // Function to fetch data via AJAX
    function fetchAssignmentData() {
        $.ajax({
            url: '{{ route("get.assignment.data") }}',
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    assignmentData.users = response.users;
                    assignmentData.roles = response.roles;
                    assignmentData.courses = response.courses;

                    buildRoleUserMappings();
                    buildCourseUserMappings();
                    populateLists();

                    // Apply initial selections from the tags displayed at the top
                    applyInitialSelections();
                } else {
                    alert('Failed to load data: ' + response.message);
                }
            },
            error: function(xhr) {
                alert('Error fetching data: ' + xhr.responseJSON?.message || 'Something went wrong');
            }
        });
    }

    // Build mappings between roles and their users
    function buildRoleUserMappings() {
        assignmentData.roleUserMap = {};

        // Initialize role map entries
        assignmentData.roles.forEach(role => {
            assignmentData.roleUserMap[role.id] = [];
        });

        // Populate role map with users
        assignmentData.users.forEach(user => {
            // Find the role that matches the user's type
            assignmentData.roles.forEach(role => {
                if (role.name === user.type) {
                    assignmentData.roleUserMap[role.id].push(user.id);
                }
            });
        });
    }

    // Build mappings between courses and their assigned users
    function buildCourseUserMappings() {
        assignmentData.courseUserMap = {};

        // Initialize course map entries
        assignmentData.courses.forEach(course => {
            assignmentData.courseUserMap[course.id] = [];

            // We're simulating course assignments here
            assignmentData.users.forEach(user => {
                if (user.id % 2 === course.id % 2) { // Just a simple rule for demonstration
                    assignmentData.courseUserMap[course.id].push(user.id);
                }
            });
        });
    }

    // Apply initial selections based on tags at the top of the modal
    function applyInitialSelections() {
        // Clear all checkboxes first
        $('.assign-checkbox').prop('checked', false);

        // Get all the selected items from the tags at the top of the modal
        const selectedItems = $('.selected-item');

        // Process roles and courses first
        selectedItems.each(function() {
            const $item = $(this);
            const type = $item.data('type');
            const id = $item.data('id');

            if (type === 'role' || type === 'course') {
                // Check the corresponding checkbox
                $(`.${type}-checkbox[value="${id}"]`).prop('checked', true);
            }
        });

        // Then update user selections based on roles and courses
        updateUserSelectionsBasedOnRolesAndCourses();

        // Finally, add any individually selected users
        selectedItems.each(function() {
            const $item = $(this);
            const type = $item.data('type');
            const id = $item.data('id');

            if (type === 'user') {
                // Check if user is not already selected from role or course
                if (!$(`.user-checkbox[value="${id}"]`).prop('checked')) {
                    $(`.user-checkbox[value="${id}"]`).prop('checked', true);
                }
            }
        });

        // Update the selection summary
        updateSelectedItems();
        updateSelectAllCheckboxes();
    }

    // Function to populate the lists in the modal
    function populateLists() {
        // Populate Users with enhanced layout
        const $userList = $('.user-list');
        $userList.empty();

        // Add Select All checkbox for users
        $userList.append(`
            <div class="select-all-container py-2 px-1 bg-light border-bottom">
                <label class="d-flex align-items-center w-100 m-0">
                    <input type="checkbox" class="select-all-checkbox me-2" data-type="user">
                    <strong>Select All Users</strong>
                </label>
            </div>
        `);

        assignmentData.users.forEach(user => {
            const imageSrc = user.profile_picture ? '{{ asset("storage/") }}' + '/' + user.profile_picture : '{{ asset("asset/images/download.jpg") }}';
            $userList.append(`
                <div class="user-item py-2 px-1" data-user-id="${user.id}" data-user-type="${user.type || ''}">
                    <label class="d-flex align-items-center w-100 m-0">
                        <input type="checkbox" class="assign-checkbox user-checkbox me-2" name="assign_users[]"
                            value="${user.id}" data-name="${user.name}" data-type="user"
                            data-image="${imageSrc}" data-role="${user.type || ''}">
                        <img src="${imageSrc}" alt="${user.name}" class="img-radius me-2" style="height: 30px; width: 30px; object-fit: cover;">
                        <div>
                            <div class="user-name">${user.name}</div>
                            <small class="text-muted user-role">${user.type || ''}</small>
                        </div>
                    </label>
                </div>
            `);
        });

        // Populate Roles with enhanced layout
        const $roleList = $('.role-list');
        $roleList.empty();

        // Add Select All checkbox for roles
        $roleList.append(`
            <div class="select-all-container py-2 px-1 bg-light border-bottom">
                <label class="d-flex align-items-center w-100 m-0">
                    <input type="checkbox" class="select-all-checkbox me-2" data-type="role">
                    <strong>Select All Roles</strong>
                </label>
            </div>
        `);

        assignmentData.roles.forEach(role => {
            $roleList.append(`
                <div class="role-item py-2 px-1" data-role-id="${role.id}" data-role-name="${role.name}">
                    <label class="d-flex align-items-center w-100 m-0">
                        <input type="checkbox" class="assign-checkbox role-checkbox me-2" name="assign_roles[]"
                            value="${role.id}" data-name="${role.display_name}" data-type="role">
                        <div class="role-icon me-2 d-flex align-items-center justify-content-center"
                            style="height: 30px; width: 30px; background-color: #eaeaea; border-radius: 50%;">
                            <i class="fas fa-user-tag"></i>
                        </div>
                        <div class="role-name">${role.display_name}</div>
                    </label>
                </div>
            `);
        });

        // Populate Courses with enhanced layout
        const $courseList = $('.course-list');
        $courseList.empty();

        // Add Select All checkbox for courses
        $courseList.append(`
            <div class="select-all-container py-2 px-1 bg-light border-bottom">
                <label class="d-flex align-items-center w-100 m-0">
                    <input type="checkbox" class="select-all-checkbox me-2" data-type="course">
                    <strong>Select All Courses</strong>
                </label>
            </div>
        `);

        assignmentData.courses.forEach(course => {
            $courseList.append(`
                <div class="course-item py-2 px-1" data-course-id="${course.id}">
                    <label class="d-flex align-items-center w-100 m-0">
                        <input type="checkbox" class="assign-checkbox course-checkbox me-2" name="assign_courses[]"
                            value="${course.id}" data-name="${course.course_full_name}" data-type="course">
                        <div class="course-icon me-2 d-flex align-items-center justify-content-center"
                            style="height: 30px; width: 30px; background-color: #e6f3ff; border-radius: 50%;">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="course-name">${course.course_full_name}</div>
                    </label>
                </div>
            `);
        });

        // Update user selections based on any initially checked roles and courses
        updateUserSelectionsBasedOnRolesAndCourses();
        updateSelectAllCheckboxes();
    }

    // Function to handle select all functionality
    function handleSelectAll() {
        // Add event listener for select all checkboxes
        $(document).on('change', '.select-all-checkbox', function() {
            const isChecked = $(this).prop('checked');
            const type = $(this).data('type');

            if (type === 'user') {
                $('.user-checkbox:visible').prop('checked', isChecked);
            } else if (type === 'role') {
                $('.role-checkbox:visible').prop('checked', isChecked);

                // If selecting all roles, also select all visible users
                if (isChecked) {
                    $('.user-checkbox:visible').prop('checked', true);
                } else {
                    // If deselecting all roles, update users based on course selections
                    updateUserSelectionsBasedOnRolesAndCourses();
                }
            } else if (type === 'course') {
                $('.course-checkbox:visible').prop('checked', isChecked);

                // If selecting all courses, also select all visible users
                if (isChecked) {
                    $('.user-checkbox:visible').prop('checked', true);
                } else {
                    // If deselecting all courses, update users based on role selections
                    updateUserSelectionsBasedOnRolesAndCourses();
                }
            }

            // Update the selections
            updateSelectedItems();
        });

        // Update select all checkbox state when individual checkboxes change
        $(document).on('change', '.user-checkbox', function() {
            updateSelectAllCheckboxes();
            updateSelectedItems();
        });

        // Handle role checkbox changes
        $(document).on('change', '.role-checkbox', function() {
            const isChecked = $(this).prop('checked');
            const roleId = $(this).val();

            // Get all users associated with this role
            const userIds = assignmentData.roleUserMap[roleId] || [];

            // Select/deselect those users
            userIds.forEach(userId => {
                $(`.user-checkbox[value="${userId}"]`).prop('checked', isChecked);
            });

            updateSelectAllCheckboxes();
            updateSelectedItems();
        });

        // Handle course checkbox changes
        $(document).on('change', '.course-checkbox', function() {
            const isChecked = $(this).prop('checked');
            const courseId = $(this).val();

            // Get all users associated with this course
            const userIds = assignmentData.courseUserMap[courseId] || [];

            // Select/deselect those users
            userIds.forEach(userId => {
                $(`.user-checkbox[value="${userId}"]`).prop('checked', isChecked);
            });

            updateSelectAllCheckboxes();
            updateSelectedItems();
        });
    }

    // Function to update user selections based on selected roles and courses
    function updateUserSelectionsBasedOnRolesAndCourses() {
        // First, uncheck all users
        $('.user-checkbox').prop('checked', false);

        // Get all selected roles
        const selectedRoleIds = $('.role-checkbox:checked').map(function() {
            return $(this).val();
        }).get();

        // Get all selected courses
        const selectedCourseIds = $('.course-checkbox:checked').map(function() {
            return $(this).val();
        }).get();

        // Select users based on roles
        selectedRoleIds.forEach(roleId => {
            const userIds = assignmentData.roleUserMap[roleId] || [];
            userIds.forEach(userId => {
                $(`.user-checkbox[value="${userId}"]`).prop('checked', true);
            });
        });

        // Select users based on courses
        selectedCourseIds.forEach(courseId => {
            const userIds = assignmentData.courseUserMap[courseId] || [];
            userIds.forEach(userId => {
                $(`.user-checkbox[value="${userId}"]`).prop('checked', true);
            });
        });
    }

    // Function to update select all checkboxes based on individual selections
    function updateSelectAllCheckboxes() {
        // For users
        const totalVisibleUsers = $('.user-checkbox:visible').length;
        const checkedVisibleUsers = $('.user-checkbox:visible:checked').length;
        $('.select-all-checkbox[data-type="user"]').prop('checked',
            totalVisibleUsers > 0 && checkedVisibleUsers === totalVisibleUsers);

        // For roles
        const totalVisibleRoles = $('.role-checkbox:visible').length;
        const checkedVisibleRoles = $('.role-checkbox:visible:checked').length;
        $('.select-all-checkbox[data-type="role"]').prop('checked',
            totalVisibleRoles > 0 && checkedVisibleRoles === totalVisibleRoles);

        // For courses
        const totalVisibleCourses = $('.course-checkbox:visible').length;
        const checkedVisibleCourses = $('.course-checkbox:visible:checked').length;
        $('.select-all-checkbox[data-type="course"]').prop('checked',
            totalVisibleCourses > 0 && checkedVisibleCourses === totalVisibleCourses);
    }

    // Enhanced filter function for users with multiple filter criteria
    function filterUsers(input) {
        const searchText = $(input).val().toLowerCase().trim();
        const $userList = $('.user-list');
        const $items = $userList.find('.user-item');

        let visibleItems = 0;

        $items.each(function() {
            const $item = $(this);
            const name = $item.find('.user-name').text().toLowerCase();
            const role = $item.find('.user-role').text().toLowerCase();

            // Check if item matches search text in either name or role
            const matches = name.includes(searchText) || role.includes(searchText);
            $item.toggle(matches);

            if (matches) visibleItems++;
        });

        // Show "No results found" if nothing matches
        $userList.find('.no-results').remove();
        if (visibleItems === 0 && searchText.length > 0) {
            $userList.append('<div class="no-results text-center p-3 text-muted">No users found</div>');
        }

        // Update select all checkbox state after filtering
        updateSelectAllCheckboxes();
    }

    // Filter function for roles
    function filterRoles(input) {
        const searchText = $(input).val().toLowerCase().trim();
        const $roleList = $('.role-list');
        const $items = $roleList.find('.role-item');

        let visibleItems = 0;

        $items.each(function() {
            const $item = $(this);
            const name = $item.find('.role-name').text().toLowerCase();

            const matches = name.includes(searchText);
            $item.toggle(matches);

            if (matches) visibleItems++;
        });

        // Show "No results found" if nothing matches
        $roleList.find('.no-results').remove();
        if (visibleItems === 0 && searchText.length > 0) {
            $roleList.append('<div class="no-results text-center p-3 text-muted">No roles found</div>');
        }

        // Update select all checkbox state after filtering
        updateSelectAllCheckboxes();
    }

    // Filter function for courses
    function filterCourses(input) {
        const searchText = $(input).val().toLowerCase().trim();
        const $courseList = $('.course-list');
        const $items = $courseList.find('.course-item');

        let visibleItems = 0;

        $items.each(function() {
            const $item = $(this);
            const name = $item.find('.course-name').text().toLowerCase();

            const matches = name.includes(searchText);
            $item.toggle(matches);

            if (matches) visibleItems++;
        });

        // Show "No results found" if nothing matches
        $courseList.find('.no-results').remove();
        if (visibleItems === 0 && searchText.length > 0) {
            $courseList.append('<div class="no-results text-center p-3 text-muted">No courses found</div>');
        }

        // Update select all checkbox state after filtering
        updateSelectAllCheckboxes();
    }

    // Bind search input events with specific filter functions
    $('.user-search').on('keyup', function() {
        filterUsers(this);
    });

    $('.role-search').on('keyup', function() {
        filterRoles(this);
    });

    $('.course-search').on('keyup', function() {
        filterCourses(this);
    });

    function updateSelectedItems() {
    var $selectedItemsInside = $('#selected-items');
    var $selectedItemsOutside = $('#selected-items-outside');
    var $hiddenInputs = $('#hidden-inputs');
    $selectedItemsInside.empty();
    $selectedItemsOutside.empty();
    $hiddenInputs.empty();

    // First add roles and courses to the selection display
    $('.role-checkbox:checked, .course-checkbox:checked').each(function() {
        var $checkbox = $(this);
        var id = $checkbox.val();
        var name = $checkbox.data('name');
        var type = $checkbox.data('type');

        // Create tag-like selected item display
        let itemHtml = `
            <div class="selected-item m-1 p-2 d-inline-flex align-items-center"
                data-id="${id}" data-type="${type}"
                style="background-color: #f0f0f0; border-radius: 30px;">
        `;

        if (type === 'role') {
            itemHtml += `
                <i class="fas fa-user-tag me-2"></i>
                <span class="name">${name}</span>
            `;
        } else {
            itemHtml += `
                <i class="fas fa-book me-2"></i>
                <span class="name">${name}</span>
            `;
        }

        itemHtml += `
            &nbsp; <i class="ti ti-trash f-17" style="color: red;" onclick="removeItem(this)"></i>
        `;

        $selectedItemsInside.append(itemHtml);
        $selectedItemsOutside.append(itemHtml);

        var inputName = type === 'role' ? 'assign_roles[]' : 'assign_courses[]';
        $hiddenInputs.append(`<input type="hidden" name="${inputName}" value="${id}">`);
    });

    // Get all user IDs that are automatically selected due to role or course
    const autoSelectedUserIds = new Set();

    // Add users from selected roles
    $('.role-checkbox:checked').each(function() {
        const roleId = $(this).val();
        const userIds = assignmentData.roleUserMap[roleId] || [];
        userIds.forEach(userId => autoSelectedUserIds.add(userId));
    });

    // Add users from selected courses
    $('.course-checkbox:checked').each(function() {
        const courseId = $(this).val();
        const userIds = assignmentData.courseUserMap[courseId] || [];
        userIds.forEach(userId => autoSelectedUserIds.add(userId));
    });

    // Add only individually selected users (those not auto-selected from roles/courses)
    $('.user-checkbox:checked').each(function() {
        var $checkbox = $(this);
        var id = $checkbox.val();

        // Only add visual display and hidden input for individually selected users
        if (!autoSelectedUserIds.has(id)) {
            var name = $checkbox.data('name');
            var image = $checkbox.data('image') || '{{ asset("asset/images/download.jpg") }}';
            var role = $checkbox.data('role') || '';

            let itemHtml = `
                <div class="selected-item m-1 p-2 d-inline-flex align-items-center"
                    data-id="${id}" data-type="user"
                    style="background-color: #f0f0f0; border-radius: 30px;">
                    <img src="${image}" alt="${name}" class="img-radius me-2"
                        style="height: 24px; width: 24px; object-fit: cover;">
                    <span class="name">${name}</span>
                    ${role ? `<span class="role ms-1 text-muted small">(${role})</span>` : ''}
                    &nbsp; <i class="ti ti-trash f-17" style="color: red;" onclick="removeItem(this)"></i>
                </div>
            `;

            $selectedItemsInside.append(itemHtml);
            $selectedItemsOutside.append(itemHtml);
            $hiddenInputs.append(`<input type="hidden" name="assign_users[]" value="${id}">`);
        }
    });

    // We don't need to add hidden inputs for auto-selected users as they'll be handled by backend
    // Just add a count indicator to show how many users will be included
    if (autoSelectedUserIds.size > 0) {
        const countHtml = `
            <div class="auto-selected-count m-1 p-2 d-inline-flex align-items-center"
                style="background-color: #e6f3ff; border-radius: 30px;">
                <i class="fas fa-users me-2"></i>
                <span>${autoSelectedUserIds.size} users from selected roles/courses</span>
            </div>
        `;
        $selectedItemsInside.append(countHtml);
        $selectedItemsOutside.append(countHtml);
    }
    }
        // Highlight users that are auto-selected from roles or courses
        function highlightAutoSelectedUsers() {
            // Remove previous highlights
            $('.user-item').removeClass('auto-selected');

            // Get all user IDs that are automatically selected due to role or course
            const autoSelectedUserIds = new Set();

            // Add users from selected roles
            $('.role-checkbox:checked').each(function() {
                const roleId = $(this).val();
                const userIds = assignmentData.roleUserMap[roleId] || [];
                userIds.forEach(userId => autoSelectedUserIds.add(userId));
            });

            // Add users from selected courses
            $('.course-checkbox:checked').each(function() {
                const courseId = $(this).val();
                const userIds = assignmentData.courseUserMap[courseId] || [];
                userIds.forEach(userId => autoSelectedUserIds.add(userId));
            });

            // Highlight the auto-selected users
            autoSelectedUserIds.forEach(userId => {
                $(`.user-item[data-user-id="${userId}"]`).addClass('auto-selected');
            });
        }

        // Remove selected item and uncheck corresponding checkbox
        window.removeItem = function(element) {
            var $item = $(element).closest('.selected-item');
            var id = $item.data('id');
            var type = $item.data('type');

            // Uncheck the checkbox
            $(`input[name="${type === 'user' ? 'assign_users[]' : type === 'role' ? 'assign_roles[]' : 'assign_courses[]'}"][value="${id}"]`).prop('checked', false);

            // If removing a role or course, also update related user selections
            if (type === 'role' || type === 'course') {
                updateUserSelectionsBasedOnRolesAndCourses();
            }

            updateSelectedItems();
            updateSelectAllCheckboxes();
            highlightAutoSelectedUsers();
        };

        // Fetch data and update selected items when modal is opened
        $('#assignModal').on('show.bs.modal', function() {
            fetchAssignmentData();

            // Reset search inputs when modal opens
            $('.user-search, .role-search, .course-search').val('');
            $('.list-container .user-item, .list-container .role-item, .list-container .course-item').show();
            $('.list-container .no-results').remove();
        });

        // Update selected items when modal is closed with save
        $('#saveAssignments').on('click', function() {
            updateSelectedItems();
        });

        // Initialize select all functionality
        handleSelectAll();

        // Initialize selected items on page load
        updateSelectedItems();

        // Make the global functions available
        window.filterUsers = filterUsers;
        window.filterRoles = filterRoles;
        window.filterCourses = filterCourses;

        // Add tooltips to help users understand the auto-selection behavior
        $('.role-list').before(`
            <div class="alert alert-info py-2 mb-2">
                <small><i class="fas fa-info-circle me-1"></i> Selecting a role will automatically select all users with that role.</small>
            </div>
        `);

        $('.course-list').before(`
            <div class="alert alert-info py-2 mb-2">
                <small><i class="fas fa-info-circle me-1"></i> Selecting a course will automatically select all users assigned to that course.</small>
            </div>
        `);

        // Add observers for highlighting auto-selected users
        $(document).on('change', '.role-checkbox, .course-checkbox', function() {
            highlightAutoSelectedUsers();
        });
    });

    // Add CSS for better styling
    $(document).ready(function() {
        // Add CSS dynamically
        $('<style>')
        .prop('type', 'text/css')
        .html(`
            .user-item, .role-item, .course-item {
                border-bottom: 1px solid #eee;
                transition: background-color 0.2s;
            }
            .user-item:hover, .role-item:hover, .course-item:hover {
                background-color: #f8f9fa;
            }
            .selected-item {
                transition: all 0.2s;
            }
            .selected-item:hover {
                background-color: #e9e9e9 !important;
            }
            .list-container {
                border: 1px solid #dee2e6;
                border-radius: 0.25rem;
                padding: 0.5rem 0;
                max-height: 300px;
                overflow-y: auto;
            }
            .no-results {
                padding: 20px;
                color: #6c757d;
                font-style: italic;
            }
            .select-all-container {
                position: sticky;
                top: 0;
                z-index: 1;
            }
            .user-name, .role-name, .course-name {
                font-weight: 500;
            }
            .alert {
                font-size: 0.85rem;
            }
            /* Highlight users that are auto-selected */
            .user-item.auto-selected {
                background-color: #e8f4ff;
            }
            .auto-selected-count {
                background-color: #e6f3ff;
                color: #0d6efd;
                font-weight: 500;
            }
        `)
        .appendTo('head');
    });
</script>


<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        flatpickr("#task_date", {
            dateFormat: "d/m/Y", // Sets the format to dd/mm/yyyy
            defaultDate: "{{ old('task_date') }}", // Keeps the old value if present
        });
    });
</script>

@include('partials.footer')
@endsection
