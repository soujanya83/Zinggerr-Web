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

{{-- <style>
    /* Sidebar styles */
    .pc-sidebar {
        width: 260px;
        transition: all 0.3s ease;
        position: fixed;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 1029;
    }

    /* Icon-only sidebar state */
    .pc-sidebar.icon-only {
        width: 70px;
    }

    /* Hide text and unnecessary elements in icon-only state */
    .pc-sidebar.icon-only .pc-mtext,
    .pc-sidebar.icon-only .pc-item.pc-caption label,
    .pc-sidebar.icon-only .pc-arrow,
    .pc-sidebar.icon-only .navbar-brand-name {
        display: none;
    }

    /* Center the icons in icon-only state */
    .pc-sidebar.icon-only .pc-micon {
        /* margin: 0 auto; */
        display: flex;
        justify-content: center;
    }

    /* Adjust menu items in icon-only state */
    .pc-sidebar.icon-only .pc-navbar>li>.pc-link {
        padding: 12px 5px;
        justify-content: center;
    }

    /* Logo adjustments */
    .pc-sidebar .m-header img.logo {
        transition: all 0.3s ease;
    }

    .pc-sidebar.icon-only .m-header img.logo {
        width: 40px !important;
    }

    /* Submenu styling for icon-only state */
    .pc-sidebar.icon-only .pc-hasmenu:hover .pc-submenu {
        display: block;
        position: absolute;
        left: 70px;
        top: 0;
        width: 200px;
        background: #fff;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        border-radius: 4px;
        z-index: 999;
        padding: 10px;
    }

    /* Show submenu on hover in icon-only state */
    .pc-sidebar.icon-only .pc-hasmenu:hover>.pc-submenu {
        display: block;
    }

    /* Main content adjustment */
    .pc-container {
        margin-left: 260px;
        transition: all 0.3s ease;
    }

    .pc-sidebar.icon-only~.pc-container {
        margin-left: 70px;
    }
</style> --}}

<style>
    /* Sidebar styles (base - initially full) */
    .pc-sidebar {
        width: 260px;
        /* Initially full width */
        transition: all 0.3s ease;
        position: fixed;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 1029;
        overflow-y: auto;
        /* Enable scroll if content overflows */
        background-color: #f8f9fa;
        padding-top: 1rem;
    }

    /* Icon-only sidebar state (when collapsed) */
    .pc-sidebar.icon-only {
        width: 60px;
    }

    .pc-sidebar.icon-only .m-header {
        text-align: center;
    }

    .pc-sidebar.icon-only .m-header img.logo {
        width: 40px !important;
    }

    .pc-sidebar.icon-only .pc-mtext,
    .pc-sidebar.icon-only .pc-item.pc-caption label,
    .pc-sidebar.icon-only .pc-arrow {
        display: none !important;
        /* Forcefully hide in icon-only */
        opacity: 0 !important;
    }

    .pc-sidebar.icon-only .pc-micon {
        display: flex;
        justify-content: center;
        margin-right: 0;
    }

    .pc-sidebar.icon-only .pc-navbar>li>.pc-link {
        padding: 0.75rem 5px;
        justify-content: center;
    }

    /* Hover effect on the icon-only sidebar */
    .pc-sidebar.icon-only:hover {
        width: 260px !important;
        /* Forcefully expand to full width */
    }

    .pc-sidebar.icon-only:hover .m-header {
        text-align: left !important;
        /* Forcefully align logo to left */
    }

    .pc-sidebar.icon-only:hover .m-header img.logo {
        width: auto !important;
        /* Forcefully restore full logo width */
    }

    .pc-sidebar.icon-only:hover .pc-mtext,
    .pc-sidebar.icon-only:hover .pc-arrow {
        display: inline-block !important;
        /* Forcefully show text and arrows */
        opacity: 1 !important;
        /* Forcefully set opacity to visible */
    }

    .pc-sidebar.icon-only:hover .pc-micon {
        justify-content: flex-start !important;
        /* Forcefully align icon to the left */
        margin-right: 0.75rem !important;
        /* Forcefully add spacing */
    }

    .pc-sidebar.icon-only:hover .pc-navbar>li>.pc-link {
        padding: 0.75rem 1rem !important;
        /* Forcefully restore full padding */
        justify-content: flex-start !important;
        /* Forcefully align content left */
    }

    .pc-sidebar.icon-only:hover .pc-link>span {
        white-space: nowrap;
        /* Prevent text wrapping */
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .pc-sidebar.icon-only:hover .pc-mtext {
        width: auto;
        /* Allow text to take necessary width */
    }

    /* Main content adjustment */
    .pc-container {
        margin-left: 260px;
        /* Initially full width */
        transition: margin-left 0.3s ease;
    }

    .pc-sidebar.icon-only~.pc-container {
        margin-left: 70px !important;
        /* Forcefully adjust for collapsed state */
    }

    .pc-sidebar.icon-only:hover~.pc-container {
        margin-left: 260px !important;
        /* Forcefully adjust for expanded hover state */
    }

    /* Logo adjustments */
    .pc-sidebar .m-header {
        text-align: left;
        /* Adjust if needed */
        opacity: 1;
        /* Initially show logo */
        transition: opacity 0.3s ease;
    }

    .pc-sidebar.icon-only .m-header {
        text-align: center;
    }

    .pc-sidebar.icon-only .m-header img.logo {
        width: 40px !important;
    }

    .pc-sidebar .m-header img.logo {
        max-width: 100%;
        height: auto;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const originalHideBtn = document.getElementById('sidebar-hide');
        if (originalHideBtn) {
            const newBtn = originalHideBtn.cloneNode(true);
            newBtn.id = 'sidebar-toggle-btn';
            originalHideBtn.parentNode.replaceChild(newBtn, originalHideBtn);

            const sidebar = document.querySelector('.pc-sidebar');
            const mainContainer = document.querySelector('.pc-container');
            const headerLeft = document.querySelector('.pc-header-left');
            const header = document.querySelector('.pc-header'); // <-- New line

            function updateLayoutStyles() {
                const isIconOnly = sidebar.classList.contains('icon-only');

                if (mainContainer) {
                    mainContainer.style.marginLeft = isIconOnly ? '70px' : '260px';
                }

                if (headerLeft) {
                    headerLeft.style.left = isIconOnly ? '66px' : '260px';
                }

                if (header) {
                    header.style.left = isIconOnly ? '66px' : '260px'; // <-- Apply style to .pc-header
                }
            }

            function toggleSidebarView() {
                sidebar.classList.toggle('icon-only');
                updateLayoutStyles();

                localStorage.setItem('sidebarView',
                    sidebar.classList.contains('icon-only') ? 'icon-only' : 'full');
            }

            const savedView = localStorage.getItem('sidebarView');
            if (savedView === 'icon-only') {
                sidebar.classList.add('icon-only');
            }

            updateLayoutStyles();

            newBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                toggleSidebarView();
                return false;
            });
        }
    });


</script>
<nav class="pc-sidebar" style="background-color: #ffffff;">
    <div class="navbar-wrapper">
        <div class="m-header" style="margin-top:-19px">
            <a href="{{ route('dashboard_user') }}" class="b-brand text-primary">
                <img src="{{ asset('asset/images/logo.png')}}" class="logo" width="200px" alt="logo">

            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar mt-1">

                <li class="pc-item">
                    <a href="{{ route('dashboard_user') }}" class="pc-link"><span class="pc-micon"><i
                                class="ti ti-dashboard"></i></span><span class="pc-mtext">Dashboard</span></a>
                </li>

                <li class="pc-item pc-hasmenu">
                    <a href="#" class="pc-link">
                        <span class="pc-micon">
                            <i class="ti ti-school"></i>
                        </span>
                        <span class="pc-mtext" data-i18n="Teachers">Montessori Training</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>

                    @php
                    $ageGroupsData=DB::table('montessori_age_groups')->where('status',1)->orderBy('position','asc')->get();
                    @endphp

                    <ul class="pc-submenu">
                        <!-- Montessori (0-3) -->
                        @foreach ($ageGroupsData as $ageData)
                        <li class="pc-item pc-hasmenu">
                            <a href="#" class="pc-link">
                                <span class="pc-mtext" data-i18n="Montessori">{{ $ageData->full_name }}</span>
                                <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                            </a>
                            @php
                            $areasData = DB::table('montessori_areas')
                            ->where('status', 1)
                            ->where('age_group', $ageData->slug)
                            ->get();
                            @endphp

                            <ul class="pc-submenu">
                                @foreach($areasData as $areaData)
                                <li class="pc-item">
                                    <a class="pc-link"
                                        href="{{ route('montessori.course.show', ['ageGroup' => $ageData->slug, 'area' => $areaData->slug]) }}"
                                        data-i18n="Areas">
                                        {{ $areaData->full_name }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach




                    </ul>
                </li>

                @if(Auth::user()->can('role') || (isset($permissions) && in_array('user_sidebar',
                $permissions)))
                <li
                    class="pc-item pc-hasmenu {{ request()->routeIs('useradd') || request()->routeIs('userlist') || request()->routeIs('teacherlist') || request()->routeIs('studentlist') ? 'active pc-trigger' : '' }}">
                    <a href="#" class="pc-link">
                        <span class="pc-micon">
                            <i class="ti ti-users"></i>
                        </span>
                        <span class="pc-mtext" data-i18n="User">Users</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>

                    <ul class="pc-submenu">
                        <li class="pc-item {{ request()->routeIs('useradd') ? 'active' : '' }}">
                            <a class="pc-link" href="{{ route('useradd') }}" data-i18n="Create">Create</a>
                        </li>
                        <li class="pc-item {{ request()->routeIs('userlist') ? 'active' : '' }}">
                            <a class="pc-link" href="{{ route('userlist') }}" data-i18n="List">List</a>
                        </li>

                        @if (Auth::user()->can('role') || (isset($permissions) && in_array('faculty_sidebar',
                        $permissions)))
                        <li class="pc-item {{ request()->routeIs('teacherlist') ? 'active' : '' }}">
                            <a class="pc-link" href="{{ route('teacherlist', ['type' => 'faculty']) }}"
                                data-i18n="Faculty">
                                Faculty
                            </a>
                        </li>
                        @endif

                        @if (Auth::user()->can('role') || (isset($permissions) && in_array('student_sidebar',
                        $permissions)))
                        <li class="pc-item {{ request()->routeIs('studentlist') ? 'active' : '' }}">
                            <a class="pc-link" href="{{ route('studentlist', ['type' => 'student']) }}"
                                data-i18n="Students">
                                Students
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                @if(Auth::user()->can('role') || (isset($permissions) && in_array('role_sidebar',
                $permissions)))
                <li class="pc-item pc-hasmenu">
                    <a href="#" class="pc-link">
                        <span class="pc-micon">
                            <i class="ti ti-shield-check"></i>
                        </span>
                        <span class="pc-mtext" data-i18n="User">Role</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="{{ route('roles.create') }}"
                                data-i18n="Pricing">Create</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{ route('roles.list') }}"
                                data-i18n="Pricing">List</a>
                        </li>
                    </ul>
                </li>
                @endif

                @if(Auth::user()->can('role')|| (isset($permissions) && in_array('permission_sidebar',
                $permissions)))
                <li class="pc-item pc-hasmenu" style="display:none">
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
                    </ul>
                </li>
                @endif

                @if(Auth::user()->can('role')|| (isset($permissions) && in_array('settings_sidebar',
                $permissions)))
                <li class="pc-item pc-hasmenu">
                    <a href="#" class="pc-link">
                        <span class="pc-micon">
                            <i class="ti ti-settings"></i>
                        </span>
                        <span class="pc-mtext" data-i18n="Teachers">Settings</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <!-- Montessori Settings -->
                        <li class="pc-item pc-hasmenu">
                            <a href="#" class="pc-link">
                                <span class="pc-mtext" data-i18n="Montessori">Montessori</span>
                                <span class="pc-arrow"><i data-feather="chevron-right"></i></span>

                            </a>
                            <ul class="pc-submenu">
                                <li class="pc-item">
                                    <a class="pc-link" href="{{ route('montessori.age_groups') }}"
                                        data-i18n="AgeGroup">Age
                                        Group</a>
                                </li>
                                <li class="pc-item">
                                    <a class="pc-link" href="{{ route('montessori.areas_list') }}"
                                        data-i18n="Areas">Areas</a>
                                </li>
                                <li class="pc-item">
                                    <a class="pc-link" href="{{ route('courses') }}"
                                        data-i18n="Expired List">Courses</a>
                                </li>
                                <li class="pc-item">
                                    <a class="pc-link" href="{{ route('course.category') }}"
                                        data-i18n="Expired List">Category</a>
                                </li>
                            </ul>
                        </li>
                        <li class="pc-item">
                            <a class="pc-link" href="{{ route('userprofile') }}" data-i18n="AccountSettings">Account</a>
                        </li>
                    </ul>
                </li>
                @endif

                @if(Auth::user()->can('role')|| (isset($permissions) && in_array('events_sidebar',
                $permissions)))
                <li class="pc-item pc-hasmenu">
                    <a href="#" class="pc-link">
                        <span class="pc-micon">
                            <i class="ti ti-clipboard-list"></i>


                        </span>
                        <span class="pc-mtext" data-i18n="User">Events</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="{{ route('event.create') }}"
                                data-i18n="Pricing">Create</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{ route('event.list') }}"
                                data-i18n="Pricing">List</a>
                        </li>
                    </ul>
                </li>
                @endif


                <li class="pc-item pc-hasmenu">
                    <a href="#" class="pc-link">
                        <span class="pc-micon">

                            <i class="ti ti-list-check"></i>

                        </span>
                        <span class="pc-mtext" data-i18n="User">Tasks</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        @if(Auth::user()->can('role')|| (isset($permissions) && in_array('tasks_create',
                        $permissions)))
                        <li class="pc-item"><a class="pc-link" href="{{ route('tasks.create') }}"
                                data-i18n="Pricing">Create</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{ route('tasks.list') }}"
                                data-i18n="Pricing">List</a>
                        </li>
                        @endif
                        <li class="pc-item"><a class="pc-link" href="{{ route('task.assign_user') }}"
                                data-i18n="Pricing">Assign</a>
                        </li>
                    </ul>
                </li>


                <li class="pc-item pc-hasmenu">
                    <a href="#" class="pc-link">
                        <span class="pc-micon">
                            <i class="ti ti-presentation"></i>
                        </span>
                        <span class="pc-mtext" data-i18n="User">Online Classes</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">

                        <li class="pc-item"><a class="pc-link" href="{{ route('online_classes.list') }}"
                                data-i18n="Pricing">List</a>
                        </li>

                    </ul>
                </li>

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

        let nameParts = fullName.trim().toLowerCase().split(/\s+/); // Split by space
        let firstName = nameParts[0] || ''; // First name
        let lastName = nameParts[1] || ''; // Last name
        let subName = nameParts.length > 2 ? nameParts[2] : ''; // Subname if exists
        let randomNum = () => Math.floor(10 + Math.random() * 90); // 2-digit random number

        let variations = [];

        if (firstName && lastName) {
            variations.push(`${firstName}_${lastName}`);
            variations.push(`${firstName}${lastName}${randomNum()}`);
            variations.push(`${lastName}_${firstName}${randomNum()}`);
            variations.push(`${firstName.charAt(0)}_${lastName}${randomNum()}`);
        }
        if (subName) {
            variations.push(`${firstName}_${subName}`);
            variations.push(`${subName}_${lastName}${randomNum()}`);
        }
        variations.push(`${firstName}${randomNum()}`);
        variations.push(`${fullName.replace(/\s+/g, '')}${randomNum()}`);

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
