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
                <img class="img-radius" src="{{ asset('../images/user/avatar-1.jpg') }}" alt="Default image"
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
    <td>{{ $user->phone }}</td>
    <td>
        @if ($user->type == 'Superadmin')
        <span class="badge rounded-pill f-14 bg-light-success">{{ $user->type }}</span>
        @elseif($user->type == 'Admin')
        <span class="badge bg-light-danger rounded-pill f-14"> {{ $user->type }}</span>
        @elseif($user->type == 'Student')
        <span class="badge bg-light-primary rounded-pill f-14"> {{ $user->type }}</span>
        @elseif($user->type == 'Staff')
        <span class="badge bg-light-warning  rounded-pill f-14"> {{ $user->type }}</span>
        @elseif($user->type == 'Teacher')
        <span class="badge bg-light-info  rounded-pill f-14"> {{ $user->type }}</span>
        @endif
    </td>
    <td>{{ $user->gender }}</td>
    <td>
        <form action="{{ route('changeStatus') }}" method="GET" style="display: inline;">
            <input type="hidden" name="id" value="{{ $user->id }}">
            <input type="hidden" name="status" value="{{ $user->status == 1 ? 0 : 1 }}">
            <button type="submit" class="btn {{ $user->status == 1 ? 'btn-success' : 'btn-danger' }}">
                {{ $user->status == 1 ? 'Active' : 'Inactive' }}
            </button>
        </form>
    </td>


    <td class="text-center">
        @can('role', Auth::user())
        <a href="{{ route('user_edit', $user->id) }}" class="avtar avtar-xs btn-link-secondary read-more-btn"
            data-id="{{ $user->id }}">
            <i class="ti ti-edit f-20"></i>
        </a>
        <a href="{{ route('user_delete', $user->id) }}" class="avtar avtar-xs btn-link-secondary read-more-btn"
            data-id="{{ $user->id }}" onclick="return confirmDelete(this)">
            <i class="ti ti-trash f-20" style="color: red;"></i>
        </a>

        @endcan
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

{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
      const statusToggleBtns = document.querySelectorAll('.status-toggle-btn');

      statusToggleBtns.forEach(function(button) {
        button.addEventListener('click', function(event) {
          event.preventDefault(); // Prevent default form submission

          const userId = button.dataset.id;
          const currentStatus = button.dataset.status;
          const newStatus = currentStatus === '1' ? '0' : '1'; // Toggle status

          Swal.fire({
            title: 'Confirm Status Change',
            text: `Are you sure you want to change the status to ${newStatus === '1' ? 'Active' : 'Inactive'}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6', // Blue confirmation button
            cancelButtonColor: '#d33', // Red cancel button
            confirmButtonText: 'Yes, Change',
            cancelButtonText: 'Cancel'
          }).then((result) => {
            if (result.isConfirmed) {
              // Send AJAX request to update user status
              fetch(`/users/${userId}/status`, {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravel CSRF protection
                },
                body: JSON.stringify({ status: newStatus })
              })
              .then(response => response.json())
              .then(data => {
                if (data.success) {
                  // Update button text and class based on new status
                  button.textContent = newStatus === '1' ? 'Active' : 'Inactive';
                  button.classList.remove(currentStatus === '1' ? 'btn-success' : 'btn-danger');
                  button.classList.add(newStatus === '1' ? 'btn-success' : 'btn-danger');

                  Swal.fire({
                    title: 'Success!',
                    text: 'User status updated successfully.',
                    icon: 'success'
                  });
                } else {
                  Swal.fire({
                    title: 'Error!',
                    text: data.message || 'An error occurred while updating status.',
                    icon: 'error'
                  });
                }
              })
              .catch(error => {
                console.error('Error updating user status:', error);
                Swal.fire({
                  title: 'Error!',
                  text: 'An error occurred while updating status.',
                  icon: 'error'
                });
              });
            }
          });
        });
      });
    });
</script> --}}
