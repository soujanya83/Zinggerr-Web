@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet">
@section('pageTitle', ' Task Update')

@section('content')
@include('partials.sidebar')
@include('partials.header')
<style>
    .selected-item {
        display: inline-block;
        margin: 5px;
        padding: 5px 10px;
        background-color: #007bff;
        color: white;

        font-size: 14px;
    }

    .selected-item .remove-btn {
        margin-left: 5px;
        cursor: pointer;
        color: white;
        font-weight: bold;
    }

    .list-container label {
        margin-bottom: 0;
    }
</style>
<style>
    .role-search, #filterRoleDropdown {
        height: 38px; /* Match the height of form-control and form-select */
        padding: 0.375rem 0.75rem; /* Standard Bootstrap input padding */
    }
    .row.g-2 {
        margin-bottom: 1rem; /* Adjust spacing below the row */
    }
</style>
<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Tasks</h5>
                        </div>
                    </div>

                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Update Task</li>
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
                                <h5>Update Task</h5>
                            </div>

                            <div class="card-body">
                                <form id="permissionForm" action="{{ route('update.task', $task->id) }}" method="post"
                                    autocomplete="off">
                                    @csrf


                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Title <span class="text-danger" style="font-weight: bold;">*</span></label>
                                                <input type="text" class="form-control" name="title"
                                                    placeholder="Enter Task Title.."
                                                    value="{{ old('title', $task->task_title) }}" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="task_date">Deadline <span class="text-danger" style="font-weight: bold;">*</span></label>
                                                <input type="text" class="form-control" name="task_date" id="task_date"
                                                    required
                                                    value="{{ old('task_date', \Carbon\Carbon::parse($task->task_completion_date)->format('d/m/Y')) }}"
                                                    placeholder="dd/mm/yyyy">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Description <span class="text-danger" style="font-weight: bold;">*</span></label>
                                            <div class="form-floating mb-3">
                                                <!-- Textarea for Summernote -->
                                                <textarea id="summernote" name="description" class="form-control"
                                                    required>
                                                    {{ old('description', $task->description) }}
                                                </textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3 mt-4">
                                                <label>Status</label>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        id="active" value="1" {{ old('status', $task->status) == 1 ?
                                                    'checked' : '' }}>
                                                    <label class="form-check-label" for="active">Active</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        id="inactive" value="0" {{ old('status', $task->status) == 0 ?
                                                    'checked' : '' }}>
                                                    <label class="form-check-label" for="inactive">Inactive</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3 mt-4">
                                                <label>Assign To:</label>
                                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#assignModal" data-task-id="{{ $task->id }}">
                                                    Select Users
                                                </button>
                                                <div id="selected-items-outside" class="mt-2"></div>
                                                <div id="hidden-inputs"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <input type="submit" class="btn btn-shadow btn-primary" value="Update">
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
                        <button class="nav-link active" id="roles-tab" data-bs-toggle="tab" data-bs-target="#roles" type="button" role="tab" aria-controls="roles" aria-selected="true">Users/Roles</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="courses-tab" data-bs-toggle="tab" data-bs-target="#courses" type="button" role="tab" aria-controls="courses" aria-selected="false">Courses</button>
                    </li>
                </ul>
                <div class="tab-content" id="assignTabContent">
                    <div class="tab-pane fade show active" id="roles" role="tabpanel" aria-labelledby="roles-tab">
                        <div class="row g-2 mb-2">
                            <div class="col-6">
                                <input type="text" class="form-control role-search" placeholder="Search users...">
                            </div>
                            <div class="col-6">
                                <select id="filterRoleDropdown" class="form-select">
                                    <option value="">All Roles</option>
                                </select>
                            </div>
                        </div>
                        <div class="list-container role-list" style="max-height: 300px; overflow-y: auto">
                            <!-- Users rendered via JS -->
                        </div>
                        <div id="hidden-inputs" class="d-none"></div>
                    </div>
                    <div class="tab-pane fade" id="courses" role="tabpanel" aria-labelledby="courses-tab">
                        <input type="text" class="form-control mb-2 course-search" placeholder="Search courses...">
                        <div class="select-all-container py-2 px-1 bg-light border-bottom mb-2">
                            <label class="d-flex align-items-center w-100 m-0">
                                <input type="checkbox" class="select-all-checkbox me-2" data-type="courses">
                                <strong>Select All Courses</strong>
                            </label>
                        </div>
                        <div class="list-container course-list" style="max-height: 150px; overflow-y: auto; border: 1px solid #dee2e6; border-radius: 0.25rem; padding: 0.5rem 0; margin-bottom: 1rem;">
                            <!-- Courses rendered via JS -->
                        </div>
                        <div class="course-users-section" style="display: none;">
                            <input type="text" class="form-control mt-2 mb-2 course-users-search" placeholder="Search users...">
                            <div class="list-container course-users-container" style="max-height: 300px; overflow-y: auto">
                                <!-- Users rendered via JS -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between align-items-center">
                <div id="selected-items-outside" class="d-flex flex-wrap flex-grow-1"></div>
                <button type="button" class="btn btn-primary" id="saveAssignments" data-bs-dismiss="modal">Save</button>
            </div>
        </div>
    </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.js">
</script>
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
    let assignmentData = {
        users: [],
        roles: [],
        courses: [],
        roleUserMap: {},
        courseUserMap: {},
        assignments: { users: [], roles: [], courses: [] }
    };

    function fetchAssignmentData() {
        const taskId = window.taskId;
        console.log('Fetching data for taskId:', taskId); // Debug
        $.ajax({
            url: '{{ route("get.task.assignments", ":id") }}'.replace(':id', taskId),
            method: 'GET',
            success: function(response) {
                console.log('Response:', response); // Debug
                if (response.success) {
                    assignmentData.users = response.users.slice(0, 100);
                    assignmentData.roles = response.roles;
                    assignmentData.courses = response.courses;
                    assignmentData.assignedCourseUsers = response.assignedCourseUsers || [];
                    assignmentData.assignments = response.assignments;

                    buildRoleUserMappings();
                    buildCourseUserMappings();
                    populateLists();
                    populateCourseList();
                    populateRoleDropdown();
                    applyInitialSelections();
                    updateUserListVisibility();
                } else {
                    alert('Failed to load data: ' + response.message);
                }
            },
            error: function(xhr) {
                console.error('AJAX Error:', xhr); // Debug
                alert('Error fetching data: ' + (xhr.responseJSON?.message || 'Something went wrong'));
            }
        });
    }

    function populateRoleDropdown() {
        const $dropdown = $('#filterRoleDropdown');
        $dropdown.empty();
        $dropdown.append('<option value="">All Roles</option>');
        console.log('Roles for dropdown:', assignmentData.roles); // Debug
        assignmentData.roles.forEach(role => {
            $dropdown.append(`<option value="${role.display_name}">${role.display_name}</option>`);
        });
    }

    function populateCourseList() {
        const $courseList = $('.course-list');
        $courseList.empty();
        console.log('Courses for list:', assignmentData.courses); // Debug
        assignmentData.courses.forEach(course => {
            const isChecked = assignmentData.assignments.courses.includes(course.id.toString());
            $courseList.append(`
                <div class="course-item py-2 px-1" data-course-id="${course.id}">
                    <label class="d-flex align-items-center w-100 m-0">
                        <input type="checkbox" class="assign-checkbox course-checkbox me-2" value="${course.id}" data-name="${course.course_full_name}" ${isChecked ? 'checked' : ''}>
                        <span class="course-name">${course.course_full_name}</span>
                    </label>
                </div>
            `);
        });
    }

    function filterCourseList(input) {
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

        $courseList.find('.no-results').remove();
        if (visibleItems === 0 && searchText) {
            $courseList.append('<div class="no-results text-center p-3 text-muted">No courses found</div>');
        }
    }

    function buildRoleUserMappings() {
        assignmentData.roleUserMap = {};
        assignmentData.roles.forEach(role => {
            assignmentData.roleUserMap[role.id] = [];
        });
        assignmentData.users.forEach(user => {
            assignmentData.roles.forEach(role => {
                if (role.name === user.type) {
                    assignmentData.roleUserMap[role.id].push(user.id);
                }
            });
        });
    }

    function buildCourseUserMappings() {
        assignmentData.courseUserMap = {};
        assignmentData.courses.forEach(course => {
            assignmentData.courseUserMap[course.id] = [];
        });
        assignmentData.assignedCourseUsers.forEach(assignment => {
            if (assignmentData.courseUserMap[assignment.course_id]) {
                assignmentData.courseUserMap[assignment.course_id].push(assignment.user_id);
            }
        });
    }

    function applyInitialSelections() {
    // Clear all checkboxes and selected items
    $('.assign-checkbox').prop('checked', false);
    $('.selected-item').remove();

    // Convert all user IDs to strings for consistent comparison
    const assignedUserIds = assignmentData.assignments.users.map(id => id.toString());

    console.log('Pre-checking users with IDs:', assignedUserIds); // Debug

    // Pre-select users in the role users list
    assignedUserIds.forEach(userId => {
        $(`.role-user-checkbox[value="${userId}"]`).prop('checked', true);
    });

    // Pre-select users in the course users list
    assignedUserIds.forEach(userId => {
        $(`.course-user-checkbox[value="${userId}"]`).prop('checked', true);
    });

    // Pre-select courses
    assignmentData.assignments.courses.forEach(courseId => {
        $(`.course-checkbox[value="${courseId}"]`).prop('checked', true);
    });

    // Update course users visibility based on selected courses
    updateUserListVisibility();

    // Update select all checkboxes
    updateSelectAllCheckboxes();

    // Update the selected items display
    updateSelectedItems();
    }

    function filterRoleUsers(input, roleDropdown) {
        const searchText = $(input).val().toLowerCase().trim();
        const selectedRole = $(roleDropdown).val();
        const $roleList = $('.role-list');
        const $items = $roleList.find('.role-user-item');
        let visibleItems = 0;

        $items.each(function() {
            const $item = $(this);
            const name = $item.find('.user-name').text().toLowerCase();
            const userType = $item.data('user-type').toLowerCase();
            const matches = name.includes(searchText) && (!selectedRole || userType === selectedRole.toLowerCase());
            $item.toggle(matches);
            if (matches) visibleItems++;
        });

        $roleList.find('.no-results').remove();
        if (visibleItems === 0 && (searchText || selectedRole)) {
            $roleList.append('<div class="no-results text-center p-3 text-muted">No users found</div>');
        }
        updateSelectAllCheckboxes();
    }

    function populateRoleUsers() {
        const $roleList = $('.role-list');
        $roleList.find('.role-user-item').remove();
        console.log('Users for role list:', assignmentData.users);
        assignmentData.users.forEach(user => {
            const imageSrc = user.profile_picture ? '{{ asset("storage/") }}' + '/' + user.profile_picture : '{{ asset("asset/images/download.jpg") }}';
            const userType = user.type || 'No Role';
            $roleList.append(`
                <div class="role-user-item py-2 px-1" data-user-id="${user.id}" data-user-type="${userType}">
                    <label class="d-flex align-items-center w-100 m-0">
                        <input type="checkbox" class="assign-checkbox role-user-checkbox me-2" name="assign_users[]"
                            value="${user.id}" data-name="${user.name}" data-type="user"
                            data-image="${imageSrc}" data-role="${userType}">
                        <img src="${imageSrc}" alt="${user.name}" class="img-radius me-2" style="height: 30px; width: 30px; object-fit: cover;">
                        <div>
                            <div class="user-name">${user.name}</div>
                            <small class="text-muted user-role">${userType}</small>
                        </div>
                    </label>
                </div>
            `);
        });

        const $hiddenRoleCheckboxes = $('<div class="d-none hidden-role-checkboxes"></div>');
        console.log('Roles for checkboxes:', assignmentData.roles);
        assignmentData.roles.forEach(role => {
            $hiddenRoleCheckboxes.append(`
                <input type="checkbox" class="assign-checkbox role-checkbox" name="assign_roles[]"
                    value="${role.id}" data-name="${role.display_name}" data-type="role">
            `);
        });
        $roleList.append($hiddenRoleCheckboxes);
    }

    function populateCourseUsers($container) {
        $container.empty();
        const selectedCourseIds = $('.course-checkbox:checked').map(function() { return $(this).val(); }).get();
        let usersToShow = [];

        if (selectedCourseIds.length > 0) {
            const allAssignedUserIds = selectedCourseIds.reduce((acc, courseId) => {
                const userIds = assignmentData.courseUserMap[courseId] || [];
                return [...acc, ...userIds];
            }, []);
            usersToShow = assignmentData.users.filter(user => allAssignedUserIds.includes(user.id));
        }

        if (usersToShow.length === 0 && selectedCourseIds.length > 0) {
            $container.append('<div class="text-center p-3 text-muted">No users assigned to selected courses</div>');
            return;
        } else if (selectedCourseIds.length === 0) {
            $container.append('<div class="text-center p-3 text-muted">Please select at least one course to see users</div>');
            return;
        }

        $container.append(`
            <div class="select-all-container py-2 px-1 bg-light border-bottom">
                <label class="d-flex align-items-center w-100 m-0">
                    <input type="checkbox" class="select-all-checkbox me-2" data-type="course-users">
                    <strong>Select All Users</strong>
                </label>
            </div>
        `);

        usersToShow.forEach(user => {
            const imageSrc = user.profile_picture ? '{{ asset("storage/") }}' + '/' + user.profile_picture : '{{ asset("asset/images/download.jpg") }}';
            const userType = user.type || 'No Role';
            const isChecked = assignmentData.assignments.users.includes(user.id.toString()) && selectedCourseIds.some(courseId => assignmentData.courseUserMap[courseId]?.includes(user.id));
            $container.append(`
                <div class="course-user-item py-2 px-1" data-user-id="${user.id}" data-user-type="${userType}">
                    <label class="d-flex align-items-center w-100 m-0">
                        <input type="checkbox" class="assign-checkbox course-user-checkbox me-2" name="assign_users[]"
                            value="${user.id}" data-name="${user.name}" data-type="user"
                            data-image="${imageSrc}" data-role="${userType}" ${isChecked ? 'checked' : ''}>
                        <img src="${imageSrc}" alt="${user.name}" class="img-radius me-2" style="height: 30px; width: 30px; object-fit: cover;">
                        <div>
                            <div class="user-name">${user.name}</div>
                            <small class="text-muted user-role">${userType}</small>
                        </div>
                    </label>
                </div>
            `);
        });
    }

    function filterCourseUsers(input) {
        const searchText = $(input).val().toLowerCase().trim();
        const $courseUsersContainer = $('.course-users-container');
        const $items = $courseUsersContainer.find('.course-user-item');
        let visibleItems = 0;

        $items.each(function() {
            const $item = $(this);
            const name = $item.find('.user-name').text().toLowerCase();
            const matches = name.includes(searchText);
            $item.toggle(matches);
            if (matches) visibleItems++;
        });

        $courseUsersContainer.find('.no-results').remove();
        if (visibleItems === 0 && searchText) {
            $courseUsersContainer.append('<div class="no-results text-center p-3 text-muted">No users found</div>');
        }
        updateSelectAllCheckboxes();
    }

    function populateLists() {
        const $roleList = $('.role-list');
        $roleList.empty().append(`
            <div class="select-all-container py-2 px-1 bg-light border-bottom">
                <label class="d-flex align-items-center w-100 m-0">
                    <input type="checkbox" class="select-all-checkbox me-2" data-type="role-users">
                    <strong>Select All Users</strong>
                </label>
            </div>
        `);
        console.log('Populating role users with users:', assignmentData.users);
        populateRoleUsers();

        $('.course-users-section').hide();
        console.log('Populating course users with courses:', assignmentData.courses);
        populateCourseUsers($('.course-users-container'));
    }

    function updateUserListVisibility() {
        const selectedCourseIds = $('.course-checkbox:checked').map(function() { return $(this).val(); }).get();
        if (selectedCourseIds.length > 0) {
            $('.course-users-section').show();
        } else {
            $('.course-users-section').hide();
        }
    }

    function handleSelectAll() {
        $(document).on('change', '.select-all-checkbox', function() {
            const isChecked = $(this).prop('checked');
            const type = $(this).data('type');

            if (type === 'role-users') {
                $('.role-user-checkbox:visible').prop('checked', isChecked);
                if (!isChecked) updateUserSelectionsBasedOnRoles();
            } else if (type === 'course-users') {
                $('.course-user-checkbox:visible').prop('checked', isChecked);
            } else if (type === 'courses') {
                $('.course-checkbox').prop('checked', isChecked);
                populateCourseUsers($('.course-users-container'));
                updateUserListVisibility();
            }
            updateSelectedItems();
        });

        $(document).on('change', '.role-user-checkbox, .course-user-checkbox, .course-checkbox', function() {
            updateSelectAllCheckboxes();
            if ($(this).hasClass('course-checkbox')) {
                populateCourseUsers($('.course-users-container'));
                updateUserListVisibility();
            }
            updateSelectedItems();
        });
    }

    function updateUserSelectionsBasedOnRoles() {
        $('.role-user-checkbox, .course-user-checkbox').prop('checked', false);
        const selectedRoleIds = $('.role-checkbox:checked').map(function() { return $(this).val(); }).get();

        selectedRoleIds.forEach(roleId => {
            (assignmentData.roleUserMap[roleId] || []).forEach(userId => {
                $(`.role-user-checkbox[value="${userId}"], .course-user-checkbox[value="${userId}"]`).prop('checked', true);
            });
        });
    }

    function updateSelectAllCheckboxes() {
        const updateCheckbox = (type, selector) => {
            const total = $(selector + ':visible').length;
            const checked = $(selector + ':visible:checked').length;
            $(`.select-all-checkbox[data-type="${type}"]`).prop('checked', total > 0 && checked === total);
        };
        updateCheckbox('role-users', '.role-user-checkbox');
        updateCheckbox('course-users', '.course-user-checkbox');
        updateCheckbox('courses', '.course-checkbox');
    }

    function updateSelectedItems() {
        const $selectedItemsInside = $('#selected-items');
        const $selectedItemsOutside = $('#selected-items-outside');
        const $hiddenInputs = $('#hidden-inputs');
        $selectedItemsInside.empty();
        $selectedItemsOutside.empty();
        $hiddenInputs.empty();

        $('.role-checkbox:checked').each(function() {
            const $checkbox = $(this);
            const id = $checkbox.val();
            const name = $checkbox.data('name');
            const type = $checkbox.data('type');
            const itemHtml = `
                <div class="selected-item m-1 p-2 d-inline-flex align-items-center"
                    data-id="${id}" data-type="${type}" style="background-color: #f0f0f0; border-radius: 30px;">
                    <i class="fas fa-user-tag me-2"></i>
                    <span class="name">${name}</span>
                      <i class="ti ti-trash f-17" style="color: red;" onclick="removeItem(this)"></i>
                </div>
            `;
            $selectedItemsInside.append(itemHtml);
            $selectedItemsOutside.append(itemHtml);
            $hiddenInputs.append(`<input type="hidden" name="assign_${type}s[]" value="${id}">`);
        });

        const autoSelectedUserIds = new Set();
        $('.role-checkbox:checked').each(function() {
            (assignmentData.roleUserMap[$(this).val()] || []).forEach(id => autoSelectedUserIds.add(id));
        });

        $('.role-user-checkbox:checked, .course-user-checkbox:checked').each(function() {
            const $checkbox = $(this);
            const id = $checkbox.val();
            if (!autoSelectedUserIds.has(id)) {
                const name = $checkbox.data('name');
                const image = $checkbox.data('image') || '{{ asset("asset/images/download.jpg") }}';
                const role = $checkbox.data('role') || '';
                const itemHtml = `
                    <div class="selected-item m-1 p-2 d-inline-flex align-items-center"
                        data-id="${id}" data-type="user" style="background-color: #f0f0f0; border-radius: 30px;">
                        <img src="${image}" alt="${name}" class="img-radius me-2" style="height: 24px; width: 24px; object-fit: cover;">
                        <span class="name" style="color:black">${name}</span>
                        ${role ? `<span class="role ms-1 text-muted small">(${role})</span>` : ''}
                          <i class="ti ti-trash f-17" style="color: red;" onclick="removeItem(this)"></i>
                    </div>
                `;
                $selectedItemsInside.append(itemHtml);
                $selectedItemsOutside.append(itemHtml);
                $hiddenInputs.append(`<input type="hidden" name="assign_users[]" value="${id}">`);
            }
        });

        if (autoSelectedUserIds.size > 0) {
            const countHtml = `
                <div class="auto-selected-count m-1 p-2 d-inline-flex align-items-center"
                    style="background-color: #e6f3ff; border-radius: 30px;">
                    <i class="fas fa-users me-2"></i>
                    <span>${autoSelectedUserIds.size} users from selected roles</span>
                </div>
            `;
            $selectedItemsInside.append(countHtml);
            $selectedItemsOutside.append(countHtml);
        }
    }

    window.removeItem = function(element) {
    const $item = $(element).closest('.selected-item');
    const id = $item.data('id');
    const type = $item.data('type');

    // Uncheck the specific checkbox for the user/role/course
    if (type === 'user') {
        $(`.role-user-checkbox[value="${id}"], .course-user-checkbox[value="${id}"]`).prop('checked', false);
    } else {
        $(`.${type}-checkbox[value="${id}"]`).prop('checked', false);
    }

    // Remove the specific selected item from the DOM
    $item.remove();

    // Update the hidden inputs and refresh the selected items display
    updateSelectedItems();
    updateSelectAllCheckboxes();
    };

    $('#assignModal').on('show.bs.modal', function(event) {
        const button = $(event.relatedTarget);
        const taskId = button.data('task-id');
        console.log('Modal opened with taskId:', taskId); // Debug
        window.taskId = taskId;
        fetchAssignmentData();
        $('.role-search, .course-search, .course-users-search, #filterRoleDropdown').val('');
        $('.list-container .role-user-item, .list-container .course-user-item, .list-container .course-item').show();
        $('.list-container .no-results').remove();
        $('.course-users-section').hide();
    });

    $('#saveAssignments').on('click', updateSelectedItems);

    handleSelectAll();
    $('.role-search').on('keyup', function() { filterRoleUsers(this, $('#filterRoleDropdown')); });
    $('#filterRoleDropdown').on('change', function() { filterRoleUsers($('.role-search'), this); });
    $('.course-search').on('keyup', function() { filterCourseList(this); });
    $(document).on('keyup', '.course-users-search', function() { filterCourseUsers(this); });

    updateSelectedItems();

    $('.role-list').before('<div class="alert alert-info py-2 mb-2"><small><i class="fas fa-info-circle me-1"></i> Filter users by role using the dropdown above. Selecting users will add them individually or you can select entire roles.</small></div>');
    $('.course-list').before('<div class="alert alert-info py-2 mb-2"><small><i class="fas fa-info-circle me-1"></i> Search and select courses to filter users. Use "Select All" to check all courses.</small></div>');
    $('.course-users-container').before('<div class="alert alert-info py-2 mb-2"><small><i class="fas fa-info-circle me-1"></i> Users assigned to selected courses will appear here.</small></div>');

    $('<style>').prop('type', 'text/css').html(`
        .role-user-item, .course-user-item, .course-item {
            border-bottom: 1px solid #eee;
            transition: background-color 0.2s;
        }
        .role-user-item:hover, .course-user-item:hover, .course-item:hover {
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
        .course-list {
            max-height: 150px; /* Adjusted height for course list */
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
        .user-name, .course-name {
            font-weight: 500;
        }
        .alert {
            font-size: 0.875rem;
            padding: 0.5rem 1rem;
        }
    `).appendTo('head');
    });
</script>

<script>
   function populateRoleDropdown() {
    const $dropdown = $('#filterRoleDropdown');
    $dropdown.empty();
    $dropdown.append('<option value="">All Roles</option>');
    assignmentData.roles.forEach(role => {
        $dropdown.append(`<option value="${role.display_name}">${role.display_name}</option>`);
    });
}

// In fetchAssignmentData success callback, add:
populateRoleDropdown();

</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        flatpickr("#task_date", {
            dateFormat: "d/m/Y", // Sets the format to dd/mm/yyyy
            defaultDate: "{{ old('task_date', \Carbon\Carbon::parse($task->task_completion_date)->format('d/m/Y')) }}",
        });
    });
</script>
@include('partials.footer')
@endsection
