<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@extends('layouts.app')

@section('pageTitle', 'Add Course')

@section('content')
@include('partials.sidebar')
@include('partials.header')
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
                            <li class="breadcrumb-item" aria-current="page">Update</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Course Edit</h5>
                    </div>
                    <div class="card-body">
                        <form id="createCourseForm" method="POST" enctype="multipart/form-data"
                            action="{{ route('course_update', $course->id) }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Course Name</label>
                                        <input type="text" name="course_name" class="form-control"
                                            placeholder="Enter Course Name" required value="{{ $course->course_name }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Course Code</label>
                                        <input type="text" name="course_code" class="form-control"
                                            placeholder="Enter Course Code" required value="{{ $course->code }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Start Date</label>
                                        <input type="date" name="start_date" class="form-control" required
                                            value="{{ $course->start_date }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Course Duration</label>
                                        <input type="text" name="duration" class="form-control"
                                            placeholder="Enter Course Duration" required
                                            value="{{ $course->duration }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Course Price</label>
                                        <input type="number" name="price" class="form-control"
                                            placeholder="Enter Course Price" required value="{{ $course->price }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Teacher Name</label>
                                        <input type="text" name="teacher_name" class="form-control"
                                            placeholder="Enter Teacher Name" required
                                            value="{{ $course->teacher_name }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Maximum Students</label>
                                        <input type="number" name="max_students" class="form-control"
                                            placeholder="Enter Maximum Students" required
                                            value="{{ $course->max_students }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Course Status</label>
                                        <select name="status" class="form-select" required>
                                            <option value="0" {{ $course->status == 0 ? 'selected' : '' }}>Deactive
                                            </option>
                                            <option value="1" {{ $course->status == 1 ? 'selected' : '' }}>Active
                                            </option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Course Details</label>
                                        <textarea name="details" class="form-control" rows="3"
                                            placeholder="Enter Course Details">{{ $course->details }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Course Image</label>
                                        <input type="file" name="course_image" class="form-control" accept="image/*">
                                        @if($course->course_image)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $course->course_image) }}"
                                                alt="Course Image" class="img-fluid"
                                                style="max-width: 150px; height: auto;">
                                        </div>
                                        @endif
                                        <!-- File input for uploading a new image -->

                                    </div>
                                </div>

                                <div class="col-md-12 text-end">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
        var courseId = '{{ $course->id }}';
        fetch(`/courses-update/${courseId}`, {
            method: 'post',
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
    timer: 3000,
    timerProgressBar: true
})

.then(() => {
            // Redirect to the course list page after the success message
            window.location.href = '{{ route("courses") }}';
        });
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: data.message || 'There was an issue with your submission.',
                    icon: 'error',
                    showConfirmButton: false,
    timer: 4000,
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
    timer: 4000,
    timerProgressBar: true
            });
        });
    });
</script>
@include('partials.footer')
@endsection
