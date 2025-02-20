<div class="tab-pane fade" id="profile-8" role="tabpanel" aria-labelledby="profile-tab-8">
    <div class="nested-tabs">
        <!-- Nested Tabs Navigation -->
        <ul class="nav nav-tabs mb-3" id="nestedTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="assigned-tab" data-bs-toggle="tab" data-bs-target="#assigned"
                    type="button" role="tab" aria-controls="assigned" aria-selected="true"
                    style="    background-color: white;">
                    <i class="material-icons-two-tone me-1">account_circle</i> Assigned
                    Faculties
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="available-tab" data-bs-toggle="tab" data-bs-target="#available"
                    type="button" role="tab" aria-controls="available" aria-selected="false"
                    style="    background-color: white;">
                    <i class="material-icons-two-tone me-1">group</i> Available Faculties
                </button>
            </li>
        </ul>

        <!-- Nested Tab Content -->
        <div class="tab-content" id="nestedTabsContent">
            <div class="tab-pane fade show active" id="assigned" role="tabpanel" aria-labelledby="assigned-tab">
                <div class="row">
                    <!-- [ sample-page ] start -->
                    <div class="col-sm-12">
                        <div class="card table-card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <h5>Faculties List Assigned For This Courses</h5>


                                    <div class="col-auto" style=" margin-top: -21px; margin-left: 78%">
                                        <div class="col-md-12">
                                            <input type="text" id="searchInput" class="form-control"
                                                placeholder="Search...">
                                        </div>
                                    </div>
                                    <br>
                                    <script>
                                        $(document).ready(function(){
                                            $("#searchInput").on("keyup", function() {
                                                var value = $(this).val().toLowerCase();
                                                $("#userTableBody tr").filter(function() {
                                                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                                });
                                            });
                                        });
                                    </script>



                                    {{-- <div class="col">
                                        <select id="entriesPerPage">
                                            <option value="5" selected>5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="25">25</option>
                                        </select> entries per page
                                    </div> --}}

                                </div>

                                <div class="card-body pt-0">
                                    <div class="table-responsive">




                                        <table class="table table-hover">
                                            <thead>
                                                <tr id="showtr">
                                                    <th>#</th>
                                                    <th>Faculties Profile</th>
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
                                            <tbody id="userTableBody">


                                                @if ($data->count() > 0)

                                                @foreach ($data as $keys=> $user)
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
                                                        <!-- Manage Button -->
                                                        <a href="javascript:void(0);"
                                                            class="btn btn-shadow btn-sm btn-secondary mx-1 manage-permissions-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#assignPermissionsModal"
                                                            data-user-id="{{ $user->id }}">
                                                            <i class="ti ti-edit"></i>
                                                            Manage
                                                        </a>
                                                        @endif
                                                        @if(Auth::user()->can('role') ||
                                                        (isset($permissions) &&
                                                        in_array('assign_remove',
                                                        $permissions)))
                                                        <a href="{{ route('assigned_delete', $user->assignId) }}"
                                                            class="btn btn-shadow btn-sm btn-danger"
                                                            data-id="{{ $user->id }}"
                                                            onclick="return confirmDelete(this)">
                                                            Remove
                                                        </a>
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
                                            @if ($data->count() > 0)
                                            <div class="datatable-info">
                                                Showing {{ $data->firstItem() }} to {{
                                                $data->lastItem() }} of {{ $data->total()
                                                }}
                                                entries
                                            </div>



                                            <nav class="datatable-pagination">
                                                <ul class="datatable-pagination-list">
                                                    @if ($data->onFirstPage())
                                                    <li class="datatable-pagination-list-item datatable-disabled">
                                                        <button disabled aria-label="Previous Page">‹</button>
                                                    </li>
                                                    @else
                                                    <li class="datatable-pagination-list-item">
                                                        <a href="{{ $data->previousPageUrl() }}"
                                                            class="datatable-pagination-list-item-link"
                                                            aria-label="Previous Page">‹</a>
                                                    </li>
                                                    @endif

                                                    @foreach ($data->getUrlRange(1,
                                                    $data->lastPage()) as $page => $url)
                                                    <li
                                                        class="datatable-pagination-list-item {{ $data->currentPage() == $page ? 'datatable-active' : '' }}">
                                                        <a href="{{ $url }}" class="datatable-pagination-list-item-link"
                                                            aria-label="Page {{ $page }}">{{
                                                            $page
                                                            }}</a>
                                                    </li>
                                                    @endforeach

                                                    @if ($data->hasMorePages())
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





            <div class="tab-pane fade" id="available" role="tabpanel" aria-labelledby="available-tab">
                <div class="row">
                    <!-- [ sample-page ] start -->
                    <div class="col-sm-12">
                        <div class="card table-card">
                            <div class="card-header">
                                <div class="row align-items-center g-2">
                                    <h5>Faculties List Available For This Courses </h5>

                                    <div class="col-auto" style=" margin-top: -21px; margin-left: 78%">
                                        <div class="col-md-12">
                                            <input type="text" id="searchInput2" class="form-control"
                                                placeholder="Search...">
                                        </div>
                                    </div>

                                    <script>
                                        $(document).ready(function(){
                                        $("#searchInput2").on("keyup", function() {
                                            var value = $(this).val().toLowerCase();
                                            $("#userTableBody2 tr").filter(function() {
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
                                                    <th>Faculties Profile</th>
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
                                            <tbody id="userTableBody2">


                                                @if ($availableTeachers->count() > 0)

                                                @foreach ($availableTeachers as $keys=>
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
                                                        @if(Auth::user()->can('role') ||
                                                        (isset($permissions) &&
                                                        in_array('teachers_edit',
                                                        $permissions)))
                                                        <!-- Manage Button -->
                                                        <a href="javascript:void(0);"
                                                            class="btn btn-shadow btn-sm btn-secondary mx-1 manage-permissions-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#assignPermissionsModal"
                                                            data-user-id="{{ $user->id }}">
                                                            <i class="ti ti-edit"></i>
                                                            Manage
                                                        </a>
                                                        @endif

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
                                            @if ($availableTeachers->count() > 0)
                                            <div class="datatable-info">
                                                Showing {{ $availableTeachers->firstItem()
                                                }} to {{
                                                $availableTeachers->lastItem() }} of {{
                                                $availableTeachers->total()
                                                }}
                                                entries
                                            </div>



                                            <nav class="datatable-pagination">
                                                <ul class="datatable-pagination-list">
                                                    @if ($availableTeachers->onFirstPage())
                                                    <li class="datatable-pagination-list-item datatable-disabled">
                                                        <button disabled aria-label="Previous Page">‹</button>
                                                    </li>
                                                    @else
                                                    <li class="datatable-pagination-list-item">
                                                        <a href="{{ $availableTeachers->previousPageUrl() }}"
                                                            class="datatable-pagination-list-item-link"
                                                            aria-label="Previous Page">‹</a>
                                                    </li>
                                                    @endif


                                                    @foreach($availableTeachers->getUrlRange(1,
                                                    $availableTeachers->lastPage()) as $page
                                                    => $url)

                                                    <li
                                                        class="datatable-pagination-list-item {{ $availableTeachers->currentPage() == $page ? 'datatable-active' : '' }}">
                                                        <a href="{{ $url }}" class="datatable-pagination-list-item-link"
                                                            aria-label="Page {{ $page }}">{{
                                                            $page
                                                            }}</a>
                                                    </li>
                                                    @endforeach

                                                    @if ($availableTeachers->hasMorePages())
                                                    <li class="datatable-pagination-list-item">
                                                        <a href="{{ $availableTeachers->nextPageUrl() }}"
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
