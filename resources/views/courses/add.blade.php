<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@extends('layouts.app')

@section('pageTitle', 'Add Course')

@section('content')
@include('partials.sidebar')
@include('partials.headerdashboard')
<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Courses View</h5>
                        </div>
                    </div>
                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Courses</a></li>
                            <li class="breadcrumb-item" aria-current="page">Add</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Course Add</h5>
                    </div>
                    <div class="card-body">
                        <form id="createCourseForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Course Name</label>
                                        <input type="text" name="course_name" class="form-control"
                                            placeholder="Enter Course Name" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Course Code</label>
                                        <input type="text" name="course_code" class="form-control"
                                            placeholder="Enter Course Code" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Start Date</label>
                                        <input type="date" name="start_date" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Course Duration</label>
                                        <input type="text" name="duration" class="form-control"
                                            placeholder="Enter Course Duration" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Course Price</label>
                                        <input type="number" name="price" class="form-control"
                                            placeholder="Enter Course Price" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Teacher Name</label>
                                        <input type="text" name="teacher_name" class="form-control"
                                            placeholder="Enter Teacher Name" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Maximum Students</label>
                                        <input type="number" name="max_students" class="form-control"
                                            placeholder="Enter Maximum Students" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Course Image</label>
                                        <input type="file" name="course_image" class="form-control" accept="image/*">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Course Details</label>
                                        <textarea name="details" class="form-control" rows="1"
                                            placeholder="Enter Course Details"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="status">Course Status:</label>
                                        <div style="margin-top: 10px;">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="statusActive" value="1">
                                                <label class="form-check-label" for="statusActive">Active</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="statusInactive" value="0">
                                                <label class="form-check-label" for="statusInactive">Inactive</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 text-end">
                                    <button type="submit" class="btn btn-primary">Create Course</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('createCourseForm').addEventListener('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        fetch('{{ route('courses_create') }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
    title: 'Success!',
    text: data.message,
    icon: 'success',
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true
})
.then(() => {

            window.location.href = '{{ route("courses") }}';
        });

                // document.getElementById('createCourseForm').reset();   //// if course create form empty

            } else {
                Swal.fire({
                    title: 'Error!',
                    text: data.message || 'There was an issue with your submission.',
                    icon: 'error',
                    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true
                });
            }
        })
        .catch(error => {
            Swal.fire({
                title: 'Error!',
                text: 'Something went wrong. Please try again.',
                icon: 'error',
                showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true
            });
        });
    });
</script>
@include('partials.footer')
@endsection
