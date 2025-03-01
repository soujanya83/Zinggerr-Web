<style>
    .suggestions-box {
        border: 1px solid #ccc;
        background: white;
        position: absolute;
        z-index: 10;
        width: 100%;
        border-radius: 5px;
        margin-top: 2px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        padding: 8px;
    }

    .suggestions-heading {
        font-size: 14px;
        font-weight: bold;
        display: block;
        padding-bottom: 5px;
        border-bottom: 1px solid #ddd;
        margin-bottom: 5px;
    }

    .suggestion-item {
        padding: 7px;
        cursor: pointer;
        border-bottom: 1px solid #eeeeee;
    }

    .suggestion-item:last-child {
        border-bottom: none;
    }

    .suggestion-item:hover {
        background: #f5f5f5;
    }
</style>

<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{ route('dashboard_user') }}" class="b-brand text-primary">
                <img src="{{ asset('asset/images/logo.png')}}" class="logo" width="200px" alt="logo">

            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item pc-caption">
                    <label>Navigation</label>
                    <i class="ti ti-dashboard"></i>
                </li>



                <li class="pc-item">
                    <a href="{{ route('dashboard_user') }}" class="pc-link"><span class="pc-micon"><i
                                class="ti ti-dashboard"></i></span><span class="pc-mtext">Dashboard</span></a>
                </li>


                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-book"></i> </span>
                        <span class="pc-mtext" data-i18n="Courses">Courses</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item">
                            <a class="pc-link" href="{{ route('courses') }}" data-i18n="Active List">List</a>
                        </li>
                        @if(Auth::user()->can('role') || Auth::user()->can('admin-role') ||
                        Auth::user()->can('teacher-role'))

                        <li class="pc-item">
                            <a class="pc-link" href="{{ route('addCourse') }}" data-i18n="Add New">Create</a>
                        </li>

                        <li class="pc-item">
                            <a class="pc-link" href="{{ route('course.category') }}"
                                data-i18n="Expired List">Category</a>
                        </li>
                        @endif
                        {{-- <li class="pc-item">
                            <a class="pc-link" href="#" data-i18n="Expired List">Expired List</a>
                        </li>
                        <li class="pc-item">
                            <a class="pc-link" href="#" data-i18n="View All">View All</a>
                        </li> --}}
                    </ul>
                </li>




                @if (Auth::user()->can('role') || (isset($permissions) && in_array('faculty_sidebar',$permissions)))


                <li class="pc-item pc-hasmenu">
                    <a href="#" class="pc-link">
                        <span class="pc-micon">
                            <i class="ti ti-user"></i>
                        </span>
                        <span class="pc-mtext" data-i18n="Teachers">Faculty</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="{{ route('teacheradd') }}"
                                data-i18n="Pricing">Create</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{ route('teacherlist') }}"
                                data-i18n="List">List</a></li>
                    </ul>
                </li>
                @endif


                @if(Auth::user()->can('role') || (isset($permissions) && in_array('student_sidebar',$permissions)))


                <li class="pc-item pc-hasmenu">
                    <a href="#" class="pc-link">
                        <span class="pc-micon">
                            <i class="ti ti-users"></i>
                        </span>
                        <span class="pc-mtext" data-i18n="Students">Students</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="{{ route('studentadd') }}"
                                data-i18n="Pricing">Create</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{ route('studentlist') }}"
                                data-i18n="List">List</a></li>
                    </ul>
                </li>
                @endif
                {{-- @if(Auth::user()->can('role') || Auth::user()->can('admin-role') ||
                Auth::user()->can('staff-role')) --}}
                @if(Auth::user()->can('role') || (isset($permissions) && in_array('user_sidebar',
                $permissions)))

                <li class="pc-item pc-hasmenu">
                    <a href="#" class="pc-link">
                        <span class="pc-micon">
                            <i class="ti ti-user"></i>
                        </span>
                        <span class="pc-mtext" data-i18n="User">Users</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="{{ route('useradd') }}" data-i18n="Pricing">Create
                            </a></li>
                        <li class="pc-item"><a class="pc-link" href="{{ route('userlist') }}" data-i18n="List">
                                List</a>
                        </li>
                    </ul>
                </li>
                @endif

                @if(Auth::user()->can('role') || (isset($permissions) && in_array('role_sidebar',
                $permissions)))
                <li class="pc-item pc-hasmenu">
                    <a href="#" class="pc-link">
                        <span class="pc-micon">
                            <i class="ti ti-notes"></i>
                        </span>
                        <span class="pc-mtext" data-i18n="User">Role</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="{{ route('roles.create') }}"
                                data-i18n="Pricing">Create</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{ route('roles.list') }}"
                                data-i18n="Pricing">List</a></li>
                    </ul>
                </li>
                @endif

                @if(Auth::user()->can('role')|| (isset($permissions) && in_array('permission_sidebar',
                $permissions)))
                <li class="pc-item pc-hasmenu">
                    <a href="#" class="pc-link">
                        <span class="pc-micon">
                            <i class="ti ti-login"></i>
                        </span>
                        <span class="pc-mtext" data-i18n="Teachers">Permissions</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="{{ route('permissions.create') }}"
                                data-i18n="Pricing">Create</a></li>

                        <li class="pc-item"><a class="pc-link" href="{{ route('permissions.list') }}"
                                data-i18n="Pricing">List</a></li>

                        {{-- <li class="pc-item"><a class="pc-link" href="{{ route('permissions.role') }}"
                                data-i18n="List">Assign</a></li> --}}

                        {{-- <li class="pc-item"><a class="pc-link" href="{{ route('permissions.assignedlist') }}"
                                data-i18n="List">Assigned List</a></li> --}}
                    </ul>

                </li>
                @endif




            </ul>
        </div>
    </div>
</nav>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const fullNameInput = document.getElementById('nameInput'); // Full Name field
        const userNameInput = document.getElementById('usernameInput'); // Username field
        const suggestionsBox = document.getElementById('usernameSuggestions'); // Suggestions box
        const suggestionsList = document.getElementById('suggestionsList'); // Suggestions list inside the box

        // Function to generate username suggestions based on full name
        const generateUsernames = (fullName) => {
            if (!fullName) return [];

            let cleanName = fullName.trim().replace(/\s+/g, '').toLowerCase(); // Remove spaces
            let randomNum = () => Math.floor(10000 + Math.random() * 90000); // 5-digit random number
            let variations = [
                cleanName.toLowerCase() + randomNum(),
                cleanName.toUpperCase() + randomNum(),
                cleanName.charAt(0).toUpperCase() + cleanName.slice(1) + randomNum(),
                cleanName.slice(0, 3).toUpperCase() + cleanName.slice(3) + randomNum(),
                cleanName + '_' + randomNum()
            ];

            return variations;
        };

        // Check if usernames exist in the database
        const checkUsernames = async (usernames) => {
            try {
                let response = await fetch('{{ route("check.username.suggestions") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ usernames })
                });
                return await response.json();
            } catch (error) {
                console.error('Error checking usernames:', error);
                return [];
            }
        };

        // Function to update and display username suggestions
        const updateUsernameSuggestions = async () => {
            let fullName = fullNameInput.value.trim();
            if (!fullName) return; // Don't show suggestions if full name is empty

            let suggestions = generateUsernames(fullName);
            let availableUsernames = await checkUsernames(suggestions);

            // Show available usernames in the dropdown
            suggestionsList.innerHTML = '';
            availableUsernames.forEach(username => {
                let div = document.createElement('div');
                div.classList.add('suggestion-item');
                div.textContent = username;
                div.addEventListener('click', () => {
                    userNameInput.value = username;
                    suggestionsBox.style.display = 'none';
                });
                suggestionsList.appendChild(div);
            });

            suggestionsBox.style.display = availableUsernames.length > 0 ? 'block' : 'none';
        };

        // Show suggestions when typing in the username field
        userNameInput.addEventListener('focus', updateUsernameSuggestions);
        userNameInput.addEventListener('input', updateUsernameSuggestions);

        // Hide suggestions if user clicks outside
        document.addEventListener('click', (event) => {
            if (!suggestionsBox.contains(event.target) && event.target !== userNameInput) {
                suggestionsBox.style.display = 'none';
            }
        });
    });
</script>
