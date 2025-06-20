<style>
    .user-avatar {
        width: 28%;
        height: 80%;
        border-radius: 50%;
        /* Example for a circular avatar */

    }

    /* ...................for pagination................................... */

    .datatable-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
    }

    .datatable-info {
        font-size: 14px;
        color: #6c757d;
    }

    .datatable-pagination {
        display: flex;
    }

    .datatable-pagination-list {
        list-style: none;
        display: flex;
        gap: 5px;
        padding: 0;
        margin: 0;
    }

    .datatable-pagination-list-item {
        display: inline-block;
    }

    .datatable-pagination-list-item-link {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        width: 30px;
        height: 30px;

        border-radius: 4px;
        color: #6c757d;
        text-decoration: none;
    }

    .datatable-pagination-list-item-link:hover {
        background-color: #f8f9fa;
        color: #000;
    }

    .datatable-pagination-list-item.datatable-active .datatable-pagination-list-item-link {
        background-color: #e9ecef;
        color: #000;
        cursor: default;
    }

    .datatable-pagination-list-item.datatable-disabled button {
        background-color: #f2f6f9;
        border: 1px solid #ddd;
        color: #6c757d;
        cursor: not-allowed;
    }

    .pc-header {
        background: #1b1a8c;
    }

    /* .......................................................... */

    .card.table-card {
    background-image: url('{{ asset('asset/zinggerr-web-image.jpg') }}');
    background-size: cover;
    background-position: center;
    }

       .page-header {
    background-image: url('{{ asset('asset/zinggerr-web-image.jpg') }}');
    background-size: cover;
    background-position: center;
}

      .card {
    background-image: url('{{ asset('asset/zinggerr-web-image.jpg') }}');
    background-size: cover;
    background-position: center;
}
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<header class="pc-header" style="background-color: #6141bc;">
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

    <div class="header-wrapper">
        <div class="me-auto pc-mob-drp">
            <ul class="list-unstyled">


                <li class="pc-h-item header-mobile-collapse">
                    <a href="#" class="pc-head-link head-link-secondary ms-0" id="sidebar-hide">
                        <i class="ti ti-menu-2"></i>
                    </a>
                </li>
                <li class="pc-h-item pc-sidebar-popup">
                    <a href="#" class="pc-head-link head-link-secondary ms-0" id="mobile-collapse">
                        <i class="ti ti-menu-2"></i>
                    </a>
                </li>


                <li class="dropdown pc-h-item d-inline-flex d-md-none">
                    <a class="pc-head-link head-link-secondary dropdown-toggle arrow-none m-0" data-bs-toggle="dropdown"
                        href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="ti ti-search"></i>
                    </a>
                    <div class="dropdown-menu pc-h-dropdown drp-search">
                        <form class="px-3">
                            <div class="form-group mb-0 d-flex align-items-center">
                                <i data-feather="search"></i>
                                <input type="search" class="form-control border-0 shadow-none"
                                    placeholder="Search here. . .">
                            </div>
                        </form>
                    </div>
                </li>
                {{-- <li class="pc-h-item d-none d-md-inline-flex">
                    <form class="header-search">
                        <i data-feather="search" class="icon-search"></i>
                        <input type="search" class="form-control" placeholder="Search here. . .">
                        <button class="btn btn-light-secondary btn-search"><i
                                class="ti ti-adjustments-horizontal"></i></button>
                    </form>
                </li> --}}
            </ul>
        </div>
        <!-- [Mobile Media Block end] -->
        <div class="ms-auto">
            <ul class="list-unstyled">
                {{-- <li class="dropdown pc-h-item" style="margin-top: -12px;margin-right:21px">
                    <a class="pc-head-link head-link-secondary dropdown-toggle arrow-none me-0"
                        data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="ti ti-bell"></i>
                    </a>
                    <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
                        <div class="dropdown-header">
                            <a href="#!" class="link-primary float-end text-decoration-underline">Mark as all read</a>
                            <h5>All Notification <span class="badge bg-warning rounded-pill ms-1">01</span></h5>
                        </div>
                        <div class="dropdown-header px-0 text-wrap header-notification-scroll position-relative"
                            style="max-height: calc(100vh - 215px)">
                            <div class="list-group list-group-flush w-100">
                                <div class="list-group-item list-group-item-action">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <div class="user-avtar bg-light-success"><i
                                                    class="ti ti-building-store"></i></div>
                                        </div>
                                        <div class="flex-grow-1 ms-1">
                                            <span class="float-end text-muted">3 min ago</span>
                                            <h5>Store Verification Done</h5>
                                            <p class="text-body fs-6">We have successfully received your request.</p>
                                            <div class="badge rounded-pill bg-light-danger">Unread</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item list-group-item-action">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <img src="asset/images/user/download.jpg" alt="user-image"
                                                class="user-avtar">
                                        </div>
                                        <div class="flex-grow-1 ms-1">
                                            <span class="float-end text-muted">10 min ago</span>
                                            <h5>Joseph William</h5>
                                            <p class="text-body fs-6">It is a long established fact that a reader will
                                                be distracted </p>
                                            <div class="badge rounded-pill bg-light-success">Confirmation of Account
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="text-center py-2">
                            <a href="#!" class="link-primary">Mark as all read</a>
                        </div>
                    </div>
                </li> --}}
                <div class="m-header" style="margin-top:-10px">

                    <!-- Search Bar -->
                    <div class="search-bar mt-2" style="position: relative; width: 100%;">
                        <span class="search-icon"
                            style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #a0a0a0;">
                            <i class="ti ti-search" style="font-size: 18px;color: #6610f2;"></i>
                        </span>
                        <input type="text" class="form-control" id="sidebarSearch" placeholder="Search..."
                            style="background-color: #e0cffc; border: none; border-radius: 11px; padding: 8px 15px 8px 35px; color: rgb(0, 0, 0); font-size: 16px; width: 100%;">
                    </div>
                </div>
                @php
                $notifications = auth()->user()->unreadNotifications;
                @endphp

                <li class="dropdown pc-h-item position-relative" style="margin-top: -12px; margin-right:21px;">
                    <!-- Bell Icon with Clickable Count -->
                    <a class="pc-head-link head-link-secondary dropdown-toggle arrow-none me-0 position-relative"
                        data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"
                        style="cursor: pointer; display: flex; align-items: center;">

                        <i class="ti ti-bell" style="font-size: 21px; text-align: center;"></i>

                        @if($notifications->count())
                        <span id="notification-count" class="badge bg-danger position-absolute"
                            style="border-radius: 10px; font-size: 12px; bottom: -5px; left: 0; padding: 2px 6px;">
                            {{ $notifications->count() }}
                        </span>
                        @endif
                    </a>

                    <!-- Notification Dropdown -->
                    <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown" >
                        <div class="dropdown-header">
                            <a href="{{ route('notifications.markAllRead') }}"
                                class="link-primary float-end text-decoration-underline">
                                Mark all as read
                            </a>
                            <h5>All Notifications
                                <span class="badge bg-warning rounded-pill ms-1" id="notif-badge">{{
                                    $notifications->count() }}</span>
                            </h5>
                        </div>

                        <!-- Notification List -->
                        <div class="dropdown-header px-0 text-wrap header-notification-scroll position-relative"
                            style="max-height: calc(100vh - 215px); overflow-y: auto;">
                            <div class="list-group list-group-flush w-100">
                                @forelse($notifications as $notification)
                                <a href="{{ $notification->data['url'] ?? '#' }}"
                                    class="list-group-item list-group-item-action notification-item"
                                    data-id="{{ $notification->id }}"
                                    onclick="markAsRead(event, '{{ $notification->id }}')">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <div class="user-avtar bg-light-success"><i class="ti ti-bell"></i></div>
                                        </div>
                                        <div class="flex-grow-1 ms-1">
                                            <span class="float-end text-muted">
                                                {{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}
                                            </span>
                                            <h5>{{ $notification->data['title'] }}</h5>
                                            <p class="text-body fs-6">{{ strip_tags($notification->data['message']) }}
                                            </p>

                                            @if(!$notification->read_at)
                                            <div class="badge rounded-pill bg-light-danger unread-badge">Unread</div>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                                @empty
                                <div class="text-center text-muted p-2">No notifications</div>
                                @endforelse
                            </div>
                        </div>

                        <div class="dropdown-divider"></div>
                    </div>
                </li>


                <li class="dropdown pc-h-item header-user-profile" style="margin-right: 14px;">
                    <span class="dropdown-toggle arrow-none me-0" href="#" role="button" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false"
                        style="height: 56px; display: flex; align-items: center; padding: 0 10px; color:#04049b;">
                        @if(Auth::user()->profile_picture)
                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="user-image"
                            class="user-avatar"
                            style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px;margin-top: -10px;">
                        @else
                        <img src="{{ asset('asset/images/user/download.jpg') }}" alt="image" class="user-avatar"
                            style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px;margin-top: -10px;">
                        @endif
                        <div style="display: flex; flex-direction: column; justify-content: center;    margin-top: -14px;">
                            <b style="color:#e9ecef; font-size: 16px;">{{ ucfirst(Str::before(Auth::user()->name, ' '))
                                }}</b>
                            <span style="color:#e9ecef; font-size: 12px; line-height: 1.2;">
                                @if (Auth::user()->type == 'Superadmin')
                                SuperAdmin
                                @else
                                {{ Auth::user()->type }}
                                @endif
                            </span>
                        </div>
                        <span class="dropdown-toggle" style="color:#e9ecef; margin-left: 10px;" type="button"
                            id="settingsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        </span>
                    </span>






                    <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                        <div class="dropdown-header">
                            <h4><span class="text-muted" style="font-size: 17px;">{{ Str::title(Auth::user()->name)
                                    }}</span></h4>
                            <p class="text-muted small">@if( Auth::user()->type =='Superadmin') <b
                                    class="badge bg-light-primary  rounded-pill f-14"
                                    style="    font-size: 14px;">SuperAdmin</b> @else <b
                                    class="badge bg-light-primary  rounded-pill f-14" style="    font-size: 14px;">{{
                                    Auth::user()->type}}</b>@endif </p>
                            <hr>
                            <div class="profile-notification-scroll position-relative"
                                style="max-height: calc(100vh - 280px)">

                                <a href="{{ route('userprofile') }}" class="dropdown-item">
                                    <i class="ti ti-settings"></i>
                                    <span>Account Settings</span>
                                </a>

                                <a class="dropdown-item" href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="ti ti-logout"></i>
                                    <span>Logout</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>


    <script>
        function markAsRead(event, notificationId) {
            event.preventDefault(); // Prevent page reload

            let notificationItem = document.querySelector(`[data-id="${notificationId}"]`);
            let unreadBadge = notificationItem.querySelector(".unread-badge");
            let notificationCountElement = document.getElementById("notification-count");
            let notifBadge = document.getElementById("notif-badge");

            // Remove "Unread" Badge
            if (unreadBadge) unreadBadge.remove();

            // Reduce the notification count
            let count = parseInt(notificationCountElement.innerText);
            if (count > 1) {
                notificationCountElement.innerText = count - 1;
                notifBadge.innerText = count - 1;
            } else {
                notificationCountElement.remove();
                notifBadge.remove();
            }

            // Mark notification as read via AJAX
            fetch(`/notifications/read/${notificationId}`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({})
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    console.log("Notification marked as read");
                }
            });

            // Redirect after marking as read
            setTimeout(() => {
                window.location.href = notificationItem.getAttribute("href");
            }, 300);
        }
    </script>



</header>
