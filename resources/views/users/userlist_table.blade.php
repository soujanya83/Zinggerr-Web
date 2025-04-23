@if ($data->count() > 0)

@foreach ($data as $keys => $user)
<tr>
    <td>{{ $keys + 1 }}</td>
    <td>
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0 wid-40">
                @if ($user->profile_picture)
                <img class="img-radius" src="{{ asset('storage/' . $user->profile_picture) }}" alt="User image"
                    style="height:52px;width: 52px;">
                @else
                <img class="img-radius" src="{{ asset('asset/images/download.jpg') }}" alt="Default image"
                    style="height:52px;width: 52px;">
                @endif
            </div>
            <div class="flex-grow-1 ms-3">
                <h5 class="mb-1">{{ $user->name }}</h5>
                <p class="text-muted f-12 mb-0">{{ $user->email }}</p>
            </div>
        </div>
    </td>
    <td>{{ $user->username }}</td>
    <td>{{ $user->country_code }}{{ $user->phone ?: '--' }}</td>
    <td>
        @if ($user->type == 'Faculty')
        <span class="badge rounded-pill f-14 bg-light-success">{{ $user->type }}</span>
        @elseif($user->type == 'Admin')
        <span class="badge bg-light-danger rounded-pill f-14"> {{ $user->type }}</span>
        @elseif($user->type == 'Student')
        <span class="badge bg-light-primary rounded-pill f-14"> {{ $user->type }}</span>
        @elseif($user->type == 'Staff')
        <span class="badge bg-light-warning  rounded-pill f-14"> {{ $user->type }}</span>
        @else
        <span class="badge bg-light-primary  rounded-pill f-14"> {{ $user->type }}</span>
        @endif
    </td>
    <td>{{ $user->gender }}</td>
    @if(Auth::user()->can('role') ||
    (isset($permissions) && in_array('users_status', $permissions)))

    <td>
        <label class="switch" title="Status change">
            <input type="checkbox" class="status-toggle" data-id="{{ $user->id }}"
                data-status="{{ $user->status == 1 ? 0 : 1 }}" {{ $user->status == 1 ? 'checked' : '' }}
            title="Status change">
            <span class="slider round"></span>
        </label>
    </td>

    @endif

    <td>
        @if(Auth::user()->can('role') ||
        (isset($permissions) && in_array('users_edit', $permissions)))

        <a href="{{ route('user_edit', $user->slug) }}" class="avtar avtar-xs btn-link-secondary read-more-btn"
            data-id="{{ $user->id }}">
            <i class="ti ti-edit f-20" title="User Edit"></i>
        </a>
        @endif

        @if(Auth::user()->can('role') ||
        (isset($permissions) && in_array('assign_permission', $permissions)))
        @if($user->type == 'Admin')
        <a href="{{ route('user.assign_permission', $user->slug) }}"
            class="avtar avtar-xs btn-link-secondary read-more-btn" data-id="{{ $user->id }}">
            <i class="ti ti-info-circle f-20" title="Assign Permission"></i>
        </a>
        @else
        <a href="{{ route('user.allassign_permission', $user->slug) }}"
            class="avtar avtar-xs btn-link-secondary read-more-btn" data-id="{{ $user->id }}">
            <i class="ti ti-info-circle f-20" title="Assign Permission"></i>
        </a>
        @endif
        @endif



        @if(Auth::user()->can('role') ||
        (isset($permissions) && in_array('users_delete', $permissions)))
        <a href="{{ route('user_delete', $user->id) }}" class="avtar avtar-xs btn-link-secondary read-more-btn"
            data-id="{{ $user->id }}" onclick="return confirmDelete(this)">
            <i class="ti ti-trash f-20" style="color: red;" title="User Delete"></i>
        </a>
        @endif

    </td>
</tr>
@endforeach
@else
<tr>
    <td colspan="8" class="text-center">No Data Found!</td>
</tr>
@endif
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(element) {
    event.preventDefault(); // Prevent the default link behavior
    const url = element.href;

    Swal.fire({
        title: 'Are you sure? For Delete',
        text: 'This action cannot be undone!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // If confirmed, redirect to the delete URL
            window.location.href = url;
        }
    });

    return false; // Prevent immediate navigation
}

</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('.status-toggle').change(function() {
            var toggle = $(this);
            var userId = toggle.data('id');
            var newStatus = toggle.is(':checked') ? 1 : 0;

            $.ajax({
                url: '{{ route("changeStatus") }}',
                type: 'POST',
                data: {
                    id: userId,
                    status: newStatus,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if(response.success) {
                        toggle.data('status', newStatus === 1 ? 0 : 1);
                        Swal.fire({
                            title: 'Success!',
                            text: 'User status change successfully',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    } else {
                        toggle.prop('checked', !toggle.is(':checked'));
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to update status',
                            icon: 'error'
                        });
                    }
                },
                error: function(xhr) {
                    toggle.prop('checked', !toggle.is(':checked'));
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred while updating status',
                        icon: 'error'
                    });
                }
            });
        });
    });
</script>
