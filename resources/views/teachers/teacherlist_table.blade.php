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
    <td>{{ $user->country_code }}{{ $user->phone }}</td>
    <td>
        <span class="badge bg-light-info  rounded-pill f-14">@if($user->type=='Teacher') Faculty @endif</span>
    </td>
    <td>{{ $user->gender }}</td>
    <td>
        @if($user->status == 1)
        <span class="badge rounded-pill f-14 bg-light-success">Active</span>
        @else
        <span class="badge bg-light-danger rounded-pill f-14">Inactive </span>
        @endif
    </td>


    <td class="text-center">
        @if(Auth::user()->can('role') ||
        (isset($permissions) && in_array('faculty_edit', $permissions)))
        <a href="{{ route('teacher_edit', $user->slug) }}" class="avtar avtar-xs btn-link-secondary read-more-btn"
            data-id="{{ $user->id }}">
            <i class="ti ti-edit f-20"></i>
        </a>
        @endif
        @if(Auth::user()->can('role') ||
        (isset($permissions) && in_array('faculty_delete', $permissions)))
        <a href="{{ route('user_delete', $user->id) }}" class="avtar avtar-xs btn-link-secondary read-more-btn"
            data-id="{{ $user->id }}" onclick="return confirmDelete(this)">
            <i class="ti ti-trash f-20" style="color: red;"></i>
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
