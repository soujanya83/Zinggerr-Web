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


                {{-- <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-book"></i></span>
                        <span class="pc-mtext" data-i18n="Courses">Courses</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>

                    <ul class="pc-submenu">
                        <!-- Toddlers (0-3 years) -->
                        <li class="pc-item pc-hasmenu">
                            <a href="#!" class="pc-link">
                                <span class="pc-mtext">Toddlers(0-3 years)</span>
                                <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                            </a>
                            <ul class="pc-submenu" style="list-style: none; padding-left: 15px;">
                                <li class="pc-item"><a class="pc-link"
                                        href="{{ route('montessori.toddlers_practical') }}">Practical Life</a></li>
                                <li class="pc-item"><a class="pc-link"
                                        href="{{ route('montessori.toddlers_sensorial') }}">Sensorial</a></li>
                                <li class="pc-item"><a class="pc-link"
                                        href="{{ route('montessori.toddlers_mathematics') }}">Mathematics</a></li>
                                <li class="pc-item"><a class="pc-link"
                                        href="{{ route('montessori.toddlers_language') }}">Language</a></li>
                                <li class="pc-item"><a class="pc-link"
                                        href="{{ route('montessori.toddlers_cultural') }}">Cultural Studies</a></li>
                            </ul>
                        </li>

                        <!-- Early Childhood (3-6 years) -->
                        <li class="pc-item pc-hasmenu">
                            <a href="#!" class="pc-link">
                                <span class="pc-mtext">Early Childhood(3-6 years)</span>
                                <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                            </a>
                            <ul class="pc-submenu" style="list-style: none; padding-left: 15px;">
                                <li class="pc-item"><a class="pc-link"
                                        href="{{ route('montessori.earlychildhood_practical') }}">Practical Life</a>
                                </li>
                                <li class="pc-item"><a class="pc-link"
                                        href="{{ route('montessori.earlychildhood_sensorial') }}">Sensorial</a></li>
                                <li class="pc-item"><a class="pc-link"
                                        href="{{ route('montessori.earlychildhood_mathematics') }}">Mathematics</a></li>
                                <li class="pc-item"><a class="pc-link"
                                        href="{{ route('montessori.earlychildhood_language') }}">Language</a></li>
                                <li class="pc-item"><a class="pc-link"
                                        href="{{ route('montessori.earlychildhood_cultural') }}">Cultural Studies</a>
                                </li>
                            </ul>
                        </li>

                        <!-- Elementary (6-12 years) -->
                        <li class="pc-item pc-hasmenu">
                            <a href="#!" class="pc-link">
                                <span class="pc-mtext">Elementary(6-12 years)</span>
                                <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                            </a>
                            <ul class="pc-submenu" style="list-style: none; padding-left: 15px;">
                                <li class="pc-item"><a class="pc-link"
                                        href="{{ route('montessori.elementary_practical') }}">Practical Life</a></li>
                                <li class="pc-item"><a class="pc-link"
                                        href="{{ route('montessori.elementary_sensorial') }}">Sensorial</a></li>
                                <li class="pc-item"><a class="pc-link"
                                        href="{{ route('montessori.elementary_mathematics') }}">Mathematics</a></li>
                                <li class="pc-item"><a class="pc-link"
                                        href="{{ route('montessori.elementary_language') }}">Language</a></li>
                                <li class="pc-item"><a class="pc-link"
                                        href="{{ route('montessori.elementary_cultural') }}">Cultural Studies</a></li>
                            </ul>
                        </li>
                    </ul>
                </li> --}}


                <li class="pc-item pc-hasmenu">
                    <a href="#" class="pc-link">
                        <span class="pc-micon">
                            <i class="ti ti-settings"></i>
                        </span>
                        <span class="pc-mtext" data-i18n="Teachers">Montessori Training</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <!-- Montessori (0-3) -->
                        <li class="pc-item pc-hasmenu">
                            <a href="#" class="pc-link">
                                <span class="pc-mtext" data-i18n="Montessori">Montessori (0-3)</span>
                                <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                            </a>
                            <ul class="pc-submenu">
                                <li class="pc-item">
                                    <a class="pc-link" href="#" data-i18n="AgeGroup">Nido (2-14 months) Group</a>
                                </li>
                                <li class="pc-item">
                                    <a class="pc-link" href="#" data-i18n="Areas">Infant (14 months-3 years)</a>
                                </li>
                            </ul>
                        </li>
                        <!-- Casa Dei Bambini (3-6 years) -->
                        @php
                        use Illuminate\Support\Str;
                        $ageGroups = DB::table('montessori_age_groups')->where('status', 1)->get();
                        $areas = DB::table('montessori_areas')->where('status', 1)->get();
                        @endphp
                        <li class="pc-item pc-hasmenu">
                            <a href="#" class="pc-link">
                                <span class="pc-mtext" data-i18n="Montessori">Casa Dei Bambini (3-6 years)</span>
                                <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                            </a>
                            <ul class="pc-submenu">
                                @foreach ($areas as $area)
                                <li class="pc-item">
                                    <a class="pc-link" href="#">
                                        {{ ucwords($area->full_name) }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </li>

                {{-- <li class="pc-item pc-hasmenu">
                    <a href="#" class="pc-link">
                        <span class="pc-micon">
                            <i class="ti ti-settings"></i>
                        </span>
                        <span class="pc-mtext" data-i18n="Teachers">Montessori Training</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <!-- Montessori Settings -->
                        <li class="pc-item pc-hasmenu">
                            <a href="#" class="pc-link">
                                <span class="pc-mtext" data-i18n="Montessori">Montessori (0-3)</span>
                                <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                            </a>
                            <ul class="pc-submenu">
                                <li class="pc-item">
                                    <a class="pc-link" href="#" data-i18n="AgeGroup">Nido(2-14 months)
                                        Group</a>
                                </li>
                                <li class="pc-item">
                                    <a class="pc-link" href="#" data-i18n="Areas">Infant (14 months-3 years)</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    @php
                    use Illuminate\Support\Str;
                    $ageGroups = DB::table('montessori_age_groups')->where('status', 1)->get();
                    $areas = DB::table('montessori_areas')->where('status', 1)->get();
                    @endphp
                    <ul class="pc-submenu">
                        <!-- Montessori Settings -->
                        <li class="pc-item pc-hasmenu">
                            <a href="#" class="pc-link">
                                <span class="pc-mtext" data-i18n="Montessori">Casa Dei Bambini (3-6 years)</span>
                                <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                            </a>
                            <ul class="pc-submenu">
                                @foreach ($areas as $area)
                                <li class="pc-item">
                                    <a class="pc-link" href="#">
                                        {{ ucwords($area->full_name) }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>


                </li> --}}

                {{-- <li class="pc-item pc-hasmenu">
                    <a href="#" class="pc-link">
                        <span class="pc-micon">
                            <i class="ti ti-settings"></i>
                        </span>
                        <span class="pc-mtext" data-i18n="Teachers">Montessori Training</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <!-- Montessori Settings -->
                        <li class="pc-item pc-hasmenu">
                            <a href="#" class="pc-link">
                                <span class="pc-mtext" data-i18n="Montessori">Montessori (0-3)</span>
                                <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                            </a>
                            <ul class="pc-submenu">
                                <li class="pc-item">
                                    <a class="pc-link" href="#" data-i18n="AgeGroup">Nido (2-14 months) Group</a>
                                </li>
                                <li class="pc-item">
                                    <a class="pc-link" href="#" data-i18n="Areas">Infant (14 months-3 years)</a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <ul class="pc-submenu">
                        <!-- Montessori Settings -->
                        <li class="pc-item pc-hasmenu">
                            <a href="#" class="pc-link">
                                <span class="pc-mtext" data-i18n="Montessori">Casa Dei Bambini (3-6 years)</span>
                                <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                            </a>
                            <ul class="pc-submenu">

                                <!-- Added two new submenu items -->
                                <li class="pc-item">
                                    <a class="pc-link" href="#">Practical Life Skills</a>
                                </li>
                                <li class="pc-item">
                                    <a class="pc-link" href="#">Sensorial Activities</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li> --}}


                {{-- @if (Auth::user()->can('role') || (isset($permissions) &&
                in_array('faculty_sidebar',$permissions)))


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
                                data-i18n="List">List</a>
                        </li>
                    </ul>
                </li>
                @endif --}}


                {{-- @if(Auth::user()->can('role') || (isset($permissions) && in_array('student_sidebar',$permissions)))


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
                                data-i18n="List">List</a>
                        </li>
                    </ul>
                </li>
                @endif --}}

                {{-- @if(Auth::user()->can('role') || Auth::user()->can('admin-role') ||
                Auth::user()->can('staff-role')) --}}
                {{-- @php
                dd($permissions);
                @endphp --}}
                @if(Auth::user()->can('role') || (isset($permissions) && in_array('user_sidebar',
                $permissions)))

                {{-- <li class="pc-item pc-hasmenu">
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
                </li> --}}


                <li
                    class="pc-item pc-hasmenu {{ request()->routeIs('useradd') || request()->routeIs('userlist') || request()->routeIs('teacherlist') || request()->routeIs('studentlist') ? 'active pc-trigger' : '' }}">
                    <a href="#" class="pc-link">
                        <span class="pc-micon">
                            <i class="ti ti-user"></i>
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
                            <i class="ti ti-notes"></i>
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
                <li class="pc-item pc-hasmenu" style="display: none">
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
                                {{-- <li class="pc-item">
                                    <a class="pc-link" href="{{ route('addCourse') }}"
                                        data-i18n="Expired List">Create</a>
                                </li> --}}


                            </ul>
                        </li>

                        <!-- Account Settings -->
                        <li class="pc-item">
                            <a class="pc-link" href="{{ route('userprofile') }}" data-i18n="AccountSettings">Account</a>
                        </li>
                    </ul>
                </li>
                @endif



            </ul>
        </div>
    </div>
</nav>


{{-- <script>
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
</script> --}}

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
