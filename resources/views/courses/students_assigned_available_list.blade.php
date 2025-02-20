<div class="tab-pane fade" id="profile-9" role="tabpanel" aria-labelledby="profile-tab-9">
    <div class="nested-tabs">
        <!-- Nested Tabs Navigation -->
        <ul class="nav nav-tabs mb-3" id="nestedTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="usersassigned-tab" data-bs-toggle="tab"
                    data-bs-target="#assignedusers" type="button" role="tab" aria-controls="assigned"
                    aria-selected="true" style="background-color: #ffffff">
                    <i class="material-icons-two-tone me-1">account_circle</i> Assigned
                    Students
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="useravailable-tab" data-bs-toggle="tab" data-bs-target="#usersavailable"
                    type="button" role="tab" aria-controls="available" aria-selected="false"
                    style="background-color: #ffffff">
                    <i class="material-icons-two-tone me-2">group</i> Available Students
                </button>
            </li>
        </ul>

        <!-- Nested Tab Content -->
        <div class="tab-content" id="nestedTabsContent">
            <div class="tab-pane fade show active" id="assignedusers" role="tabpanel"
                aria-labelledby="usersassigned-tab">
                <div class="row">
                    <!-- [ sample-page ] start -->
                    <div class="col-sm-12">
                        <div class="card table-card">
                            <div class="card-header">
                                <div class="row align-items-center g-2">
                                    <h5>Students List Assigned For This Courses</h5>

                                    <div class="col-auto" style=" margin-top: -21px; margin-left: 78%">
                                        <div class="col-md-12">
                                            <input type="text" id="searchInput3" class="form-control"
                                                placeholder="Search...">
                                        </div>
                                    </div>

                                    <script>
                                        $(document).ready(function(){
                                        $("#searchInput3").on("keyup", function() {
                                            var value = $(this).val().toLowerCase();
                                            $("#userTableBody3 tr").filter(function() {
                                                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                            });
                                        });
                                    });
                                    </script>

                                </div>
                                <hr>
                                <div class="card-body pt-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr id="showtr">
                                                    <th>#</th>
                                                    <th>Students Profile</th>
                                                    <th>Username</th>
                                                    <th>Phone</th>
                                                    <th>Type</th>
                                                    <th>Gender</th>
                                                    <th>Status</th>
                                                    @if(Auth::user()->can('role') ||
                                                    (isset($permissions) &&
                                                    in_array('teachers_edit', $permissions))
                                                    ||
                                                    (isset($permissions) &&
                                                    in_array('teachers_delete',
                                                    $permissions)))
                                                    <th class="text-center">Action</th>
                                                    @endif

                                                </tr>
                                            </thead>
                                            <tbody id="userTableBody3">


                                                @if ($userdata->count() > 0)

                                                @foreach ($userdata as $keys=> $user)
                                                <tr>
                                                    <td>{{ ++$keys }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0 wid-40">
                                                                @if ($user->profile_picture)
                                                                <img class="img-radius"
                                                                    src="{{ asset('storage/' . $user->profile_picture) }}"
                                                                    alt="User image" style="height:52px;width: 52px;">
                                                                @else
                                                                <img class="img-radius"
                                                                    src="{{ asset('asset/images/user/avatar-1.jpg') }}"
                                                                    alt="Default image"
                                                                    style="height:52px;width: 52px;">
                                                                @endif
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h5 class="mb-1">{{
                                                                    $user->name }}</h5>
                                                                <p class="text-muted f-12 mb-0">
                                                                    {{ $user->email }}</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $user->username }}</td>
                                                    <td>{{ $user->phone }}</td>
                                                    <td>
                                                        <span class="badge bg-light-info  rounded-pill f-14">
                                                            {{ $user->type }}</span>
                                                    </td>
                                                    <td>{{ $user->gender }}</td>
                                                    <td>
                                                        @if($user->status == 1)
                                                        <span
                                                            class="badge rounded-pill f-14 bg-light-success">Active</span>
                                                        @else
                                                        <span class="badge bg-light-danger rounded-pill f-14">Inactive
                                                        </span>
                                                        @endif
                                                    </td>

                                                    <td class="text-center">
                                                        @if(Auth::user()->can('role') ||
                                                        (isset($permissions) &&
                                                        in_array('teachers_edit',
                                                        $permissions)))
                                                        @if($user->assignStatus == 1)
                                                        <form action="{{ route('course.pause_users') }}" method="post"
                                                            style="display: inline;">
                                                            @csrf
                                                            <!-- Hidden Input for Course ID -->
                                                            <input type="hidden" name="assign_id"
                                                                value="{{ $user->assignId }}">

                                                            <button type="submit"
                                                                class="btn  btn-shadow btn-sm btn-success mx-1">
                                                                <i class="ti ti-user-plus"></i>
                                                                Active
                                                            </button>

                                                        </form>
                                                        @else
                                                        <form action="{{ route('course.pause_users') }}" method="post"
                                                            style="display: inline;">
                                                            @csrf
                                                            <!-- Hidden Input for Course ID -->
                                                            <input type="hidden" name="assign_id"
                                                                value="{{ $user->assignId }}">
                                                            <button type="submit"
                                                                class="btn  btn-shadow btn-sm btn-secondary mx-1">
                                                                <i class="ti ti-user-plus"></i>
                                                                Pausa
                                                            </button>

                                                        </form>
                                                        @endif
                                                        @endif
                                                        {{-- @if(Auth::user()->can('role')
                                                        ||
                                                        (isset($permissions) &&
                                                        in_array('assign_remove',
                                                        $permissions)))
                                                        <a href="{{ route('assigned_delete', $user->assignId) }}"
                                                            class="btn btn-sm btn-danger" data-id="{{ $user->id }}"
                                                            onclick="return confirmDelete(this)">
                                                            Remove
                                                        </a>
                                                        @endif --}}
                                                        @if(Auth::user()->can('role') ||
                                                        (isset($permissions) &&
                                                        in_array('assign_remove',
                                                        $permissions)))
                                                        <button type="button"
                                                            class="btn  btn-shadow btn-sm btn-danger open-remark-modal"
                                                            data-id="{{ $user->assignId }}" data-bs-toggle="modal"
                                                            data-bs-target="#remarkModal">
                                                            Remove
                                                        </button>
                                                        @endif



                                                    </td>

                                                </tr>
                                                @endforeach


                                                @else
                                                <tr>
                                                    <td colspan="8" class="text-center">No
                                                        Data Found!</td>
                                                </tr>
                                                @endif

                                            </tbody>
                                        </table>
                                        <div class="datatable-bottom">
                                            @if ($userdata->count() > 0)
                                            <div class="datatable-info">
                                                Showing {{ $userdata->firstItem() }} to {{
                                                $userdata->lastItem() }} of {{
                                                $userdata->total()
                                                }}
                                                entries
                                            </div>



                                            <nav class="datatable-pagination">
                                                <ul class="datatable-pagination-list">
                                                    @if ($userdata->onFirstPage())
                                                    <li class="datatable-pagination-list-item datatable-disabled">
                                                        <button disabled aria-label="Previous Page">‹</button>
                                                    </li>
                                                    @else
                                                    <li class="datatable-pagination-list-item">
                                                        <a href="{{ $userdata->previousPageUrl() }}"
                                                            class="datatable-pagination-list-item-link"
                                                            aria-label="Previous Page">‹</a>
                                                    </li>
                                                    @endif

                                                    @foreach ($userdata->getUrlRange(1,
                                                    $userdata->lastPage()) as $page => $url)
                                                    <li
                                                        class="datatable-pagination-list-item {{ $userdata->currentPage() == $page ? 'datatable-active' : '' }}">
                                                        <a href="{{ $url }}" class="datatable-pagination-list-item-link"
                                                            aria-label="Page {{ $page }}">{{
                                                            $page
                                                            }}</a>
                                                    </li>
                                                    @endforeach

                                                    @if ($userdata->hasMorePages())
                                                    <li class="datatable-pagination-list-item">
                                                        <a href="{{ $userdata->nextPageUrl() }}"
                                                            class="datatable-pagination-list-item-link"
                                                            aria-label="Next Page">›</a>
                                                    </li>
                                                    @else
                                                    <li class="datatable-pagination-list-item datatable-disabled">
                                                        <button disabled aria-label="Next Page">›</button>
                                                    </li>
                                                    @endif
                                                </ul>
                                            </nav>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="tab-pane fade" id="usersavailable" role="tabpanel" aria-labelledby="useravailable-tab">
                <div class="row">
                    <!-- [ sample-page ] start -->
                    <div class="col-sm-12">
                        <div class="card table-card">
                            <div class="card-header">
                                <div class="row align-items-center g-2">
                                    <h5>Students List Available For This Courses </h5>

                                    <div class="col-auto" style=" margin-top: -21px; margin-left: 78%">
                                        <div class="col-md-12">
                                            <input type="text" id="searchInput4" class="form-control"
                                                placeholder="Search...">
                                        </div>
                                    </div>

                                    <script>
                                        $(document).ready(function(){
                                        $("#searchInput4").on("keyup", function() {
                                            var value = $(this).val().toLowerCase();
                                            $("#userTableBody4 tr").filter(function() {
                                                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                            });
                                        });
                                    });
                                    </script>

                                </div>
                                <hr>
                                <div class="card-body pt-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr id="showtr">
                                                    <th>#</th>
                                                    <th>Students Profile</th>
                                                    <th>Username</th>
                                                    <th>Phone</th>
                                                    <th>Type</th>
                                                    <th>Gender</th>
                                                    <th>Status</th>
                                                    @if(Auth::user()->can('role') ||
                                                    (isset($permissions) &&
                                                    in_array('teachers_edit', $permissions))
                                                    ||
                                                    (isset($permissions) &&
                                                    in_array('teachers_delete',
                                                    $permissions)))
                                                    <th class="text-center">Action</th>
                                                    @endif

                                                </tr>
                                            </thead>
                                            <tbody id="userTableBody4">


                                                @if ($availableUsers->count() > 0)

                                                @foreach ($availableUsers as $keys=>
                                                $user)
                                                <tr>
                                                    <td>{{ ++$keys }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0 wid-40">
                                                                @if ($user->profile_picture)
                                                                <img class="img-radius"
                                                                    src="{{ asset('storage/' . $user->profile_picture) }}"
                                                                    alt="User image" style="height:52px;width: 52px;">
                                                                @else
                                                                <img class="img-radius"
                                                                    src="{{ asset('asset/images/user/avatar-1.jpg') }}"
                                                                    alt="Default image"
                                                                    style="height:52px;width: 52px;">
                                                                @endif
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h5 class="mb-1">{{
                                                                    $user->name }}</h5>
                                                                <p class="text-muted f-12 mb-0">
                                                                    {{ $user->email }}</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $user->username }}</td>
                                                    <td>{{ $user->phone }}</td>
                                                    <td>
                                                        <span class="badge bg-light-info  rounded-pill f-14">
                                                            {{ $user->type }}</span>
                                                    </td>
                                                    <td>{{ $user->gender }}</td>
                                                    <td>
                                                        @if($user->status == 1)
                                                        <span
                                                            class="badge rounded-pill f-14 bg-light-success">Active</span>
                                                        @else
                                                        <span class="badge bg-light-danger rounded-pill f-14">Inactive
                                                        </span>
                                                        @endif
                                                    </td>



                                                    <td class="text-center">
                                                        {{-- @if(Auth::user()->can('role')
                                                        ||
                                                        (isset($permissions) &&
                                                        in_array('teachers_edit',
                                                        $permissions)))
                                                        <!-- Edit Button -->
                                                        <a href="{{ route('teacher_edit', $user->id) }}"
                                                            class="btn btn-sm btn-secondary mx-1">
                                                            <i class="ti ti-edit"></i> Edit
                                                        </a>
                                                        @endif --}}

                                                        @if(Auth::user()->type ===
                                                        'Superadmin' || (isset($permissions)
                                                        && in_array('cousers_assign',
                                                        $permissions)))
                                                        <!-- Assign Button -->
                                                        <form action="{{ route('course.assign') }}" method="post"
                                                            style="display: inline;">
                                                            @csrf
                                                            <!-- Hidden Input for Course ID -->
                                                            <input type="hidden" name="course_id" value="{{ $id }}">
                                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                            <button type="submit"
                                                                class="btn btn-shadow btn-sm btn-primary mx-1">
                                                                <i class="ti ti-user-plus"></i>
                                                                Assign
                                                            </button>
                                                        </form>
                                                        @endif
                                                    </td>

                                                </tr>
                                                @endforeach


                                                @else
                                                <tr>
                                                    <td colspan="8" class="text-center">No
                                                        Data Found!</td>
                                                </tr>
                                                @endif

                                            </tbody>
                                        </table>
                                        <div class="datatable-bottom">
                                            @if ($availableUsers->count() > 0)
                                            <div class="datatable-info">
                                                Showing {{ $availableUsers->firstItem() }}
                                                to {{
                                                $availableUsers->lastItem() }} of {{
                                                $availableUsers->total()
                                                }}
                                                entries
                                            </div>



                                            <nav class="datatable-pagination">
                                                <ul class="datatable-pagination-list">
                                                    @if ($availableUsers->onFirstPage())
                                                    <li class="datatable-pagination-list-item datatable-disabled">
                                                        <button disabled aria-label="Previous Page">‹</button>
                                                    </li>
                                                    @else
                                                    <li class="datatable-pagination-list-item">
                                                        <a href="{{ $availableUsers->previousPageUrl() }}"
                                                            class="datatable-pagination-list-item-link"
                                                            aria-label="Previous Page">‹</a>
                                                    </li>
                                                    @endif


                                                    @foreach($availableUsers->getUrlRange(1,
                                                    $availableUsers->lastPage()) as $page =>
                                                    $url)
                                                    <li
                                                        class="datatable-pagination-list-item {{ $availableUsers->currentPage() == $page ? 'datatable-active' : '' }}">
                                                        <a href="{{ $url }}" class="datatable-pagination-list-item-link"
                                                            aria-label="Page {{ $page }}">{{
                                                            $page
                                                            }}</a>
                                                    </li>
                                                    @endforeach

                                                    @if ($availableUsers->hasMorePages())
                                                    <li class="datatable-pagination-list-item">
                                                        <a href="{{ $data->nextPageUrl() }}"
                                                            class="datatable-pagination-list-item-link"
                                                            aria-label="Next Page">›</a>
                                                    </li>
                                                    @else
                                                    <li class="datatable-pagination-list-item datatable-disabled">
                                                        <button disabled aria-label="Next Page">›</button>
                                                    </li>
                                                    @endif
                                                </ul>
                                            </nav>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
