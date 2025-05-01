@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet">
@section('pageTitle', ' Roles List')

@section('content')
@include('partials.sidebar')
@include('partials.header')
<style>
    .notification-item {
        border-bottom: 1px solid #e9ecef;
        padding: 15px;
        display: flex;
        align-items: center;
        transition: background-color 0.2s;
    }

    .notification-item:hover {
        background-color: #f8f9fa;
    }

    .notification-item.unread {
        background-color: #f1f3f5;
    }

    .user-avtar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        margin-right: 10px;
    }

    .bg-light-success {
        background-color: #e6f7e9;
    }

    .bg-light-danger {
        background-color: #f8d7da;
    }

    .container {
        margin-left: 260px;
        /* Adjust based on your sidebar width */
        padding: 20px;
    }
</style>
<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Notificatins</h5>
                        </div>
                    </div>

                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Notification List</li>
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
                    <div class="card-header">
                        <div class="row align-items-center g-2">
                            <div class="col">
                                <h5>Notifications List</h5>
                            </div>
                            {{-- <div class="form-search col-auto mb-3">
                                <input type="text" class="form-control" id="searchNotifications"
                                    placeholder="Search by Title or Message...">
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="mb-3 d-flex justify-content-end">
                                <a href="{{ route('notifications.markAllRead') }}"
                                    class="btn btn-outline-primary">
                                    Mark all as read
                                </a>
                            </div>

                            <div class="card-body p-0" id="notificationsContainer">
                                @php $index = 1; @endphp
                                @forelse($notifications as $notification)
                                <a href="{{ $notification->data['url'] ?? '#' }}"
                                    class="notification-item {{ !$notification->read_at ? 'unread' : '' }} d-flex"
                                    style="text-decoration: none; color: inherit;"
                                    data-title="{{ $notification->data['title'] ?? '' }}"
                                    data-message="{{ strip_tags($notification->data['message']) ?? '' }}"
                                    data-id="{{ $notification->id }}"
                                    onclick="markAsRead(event, '{{ $notification->id }}')">
                                    <div class="d-flex w-100">
                                        <div class="flex-shrink-0 me-3" style="width:3%">
                                            <span class="serial-number">{{ $index++.' -' }}</span>
                                        </div>
                                        <div class="user-avtar bg-light-success ms-2">
                                            <i class="ti ti-bell"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between">
                                                <h5 class="mb-1">{{ $notification->data['title'] ?? 'No Title' }}</h5>
                                                <span class="text-muted">
                                                    @if(!$notification->read_at)
                                                    <span class="badge bg-light-danger rounded-pill">Unread</span>
                                                    @endif
                                                    {{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans()
                                                    }}
                                                </span>
                                            </div>
                                            <p class="text-body mb-1">{{ strip_tags($notification->data['message']) ??
                                                'No Message' }}</p>

                                        </div>
                                    </div>
                                </a>
                                @empty
                                <div class="text-center text-muted p-3" id="noNotifications">
                                    No notifications available.
                                </div>
                                @endforelse
                            </div>

                            <style>
                                .serial-number {
                                    display: inline-block;
                                    width: 28px;
                                    text-align: center;
                                    font-weight: bold;
                                    margin-right: 10px;
                                }

                                .notification-item {
                                    display: flex;
                                    align-items: center;
                                    padding: 15px;
                                    border-bottom: 1px solid #e9ecef;
                                    transition: background-color 0.2s;
                                }

                                .notification-item.unread {
                                    background-color: #f1f3f5;
                                }

                                .notification-item.hidden {
                                    display: none;
                                }
                            </style>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    // Search Functionality
                                    const searchInput = document.getElementById('searchNotifications');
                                    const notificationItems = document.querySelectorAll('.notification-item');
                                    const noNotifications = document.getElementById('noNotifications');

                                    searchInput.addEventListener('input', function() {
                                        const searchTerm = this.value.toLowerCase().trim();
                                        console.log('Search term:', searchTerm); // Debug log

                                        let hasVisibleItems = false;

                                        notificationItems.forEach(item => {
                                            const title = item.getAttribute('data-title')?.toLowerCase() || '';
                                            const message = item.getAttribute('data-message')?.toLowerCase() || '';
                                            console.log('Title:', title, 'Message:', message); // Debug log

                                            if (searchTerm === '') {
                                                item.classList.remove('hidden');
                                                hasVisibleItems = true;
                                            } else if (title.includes(searchTerm) || message.includes(searchTerm)) {
                                                item.classList.remove('hidden');
                                                hasVisibleItems = true;
                                            } else {
                                                item.classList.add('hidden');
                                            }
                                        });

                                        if (noNotifications) {
                                            noNotifications.style.display = hasVisibleItems || searchTerm === '' ? 'none' : 'block';
                                        }
                                    });

                                    // Mark All as Read Functionality
                                    document.getElementById('markAllRead').addEventListener('click', function(event) {
                                        event.preventDefault();
                                        fetch('/notifications/mark-all-as-read', {
                                            method: 'POST',
                                            headers: {
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                'Content-Type': 'application/json',
                                            },
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.success) {
                                                // Refresh the page or update UI
                                                location.reload(); // Reloads the page to reflect updated read status
                                            } else {
                                                console.error('Failed to mark all as read');
                                            }
                                        })
                                        .catch(error => console.error('Error:', error));
                                    });

                                    // Mark Single Notification as Read
                                    function markAsRead(event, notificationId) {
                                        event.preventDefault();
                                        fetch('/notifications/mark-as-read/' + notificationId, {
                                            method: 'POST',
                                            headers: {
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                'Content-Type': 'application/json',
                                            },
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.success) {
                                                window.location.href = event.currentTarget.href;
                                            }
                                        })
                                        .catch(error => console.error('Error marking notification as read:', error));
                                    }
                                });
                            </script>


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@include('partials.footer')
@endsection
