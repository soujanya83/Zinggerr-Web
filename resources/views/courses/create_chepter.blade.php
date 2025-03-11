<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/resumable.js/1.0.2/resumable.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/resumablejs/resumable.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />



@extends('layouts.app')

@section('pageTitle', 'Create Chapter')

@section('content')
@include('partials.sidebar')
@include('partials.headerdashboard')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/resumable.js/1.0.0/resumable.min.js"></script> --}}
<style>
    #uploadProgress {
        width: 100%;
        height: 20px;
        background-color: #e0e0e0;
        margin: 10px 0;
        position: relative;
    }

    #uploadProgress div {
        width: 0%;
        height: 100%;
        background-color: #4caf50;
    }
    .swal2-container {
    z-index: 9999 !important; /* Ensure it's above everything */
}

.swal2-highest-zindex {
    z-index: 9999 !important;
}



.quiz-overlay {
    transition: all 0.3s ease;
    background-color: rgba(255, 255, 255, 0.95);
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.quiz-overlay .form-check {
    margin-bottom: 8px;
}

.quiz-overlay .btn {
    width: 100%;
}

.options-container {
    margin: 15px 0;
}

</style>
<style>
#checkpoint-container {
    position: absolute;
    pointer-events: none;
}

.quiz-checkpoint {
    position: absolute;
    background-color: #ff4444;
    box-shadow: 0 0 2px rgba(0,0,0,0.3);
    border-radius: 1px;
    transition: transform 0.2s ease;
}

/* Adjust video controls appearance */
#editVideoPlayer::-webkit-media-controls-timeline {
    margin-left: 10px;
    margin-right: 10px;
}

/* Make sure video container is relative for absolute positioning */
.modal-body {
    position: relative;
}

/* Ensure checkpoints are visible above video controls */
#checkpoint-container {
    z-index: 2147483647;
    margin-bottom:2px;
    margin-left:26px;
    /* margin-right:50px; */
}
    </style>

<style>
    #fillblanks-container {
    position: absolute;
    pointer-events: none;
    z-index: 2147483647;
    margin-top: 2px;
    margin-left: 26px;
}

.fillblank-checkpoint {
    position: absolute;
    background-color: #4CAF50;
    box-shadow: 0 0 2px rgba(0,0,0,0.3);
    border-radius: 1px;
    transition: transform 0.2s ease;
}
    </style>
<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Create Chapter</h5>
                        </div>
                    </div>
                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Course</a></li>
                            <li class="breadcrumb-item" aria-current="page">Create Chapter</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif


        <div class="row col-12" style="margin-left: 0px;">

            <div class="card">


                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <h5>Create Chapters</h5>

                        <div class="row">
                            <div class="card-body">

                                {{--
                                ..............................................................................................--}}

                                <form action="{{ route('chepter.submit')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $id }}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="chepter_name">Chapter Name:</label>
                                                <input type="text" id="chepter_name" name="chepter_name"
                                                    class="form-control" placeholder="Enter Chapter Name" required
                                                    value="{{ old('chepter_name') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="status">Chapter Visible:</label>
                                                <div style="margin-top: 10px;">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="status"
                                                            id="yesmode" value="1" checked>
                                                        <label class="form-check-label" for="yesmode">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="status"
                                                            id="nostatus" value="0">
                                                        <label class="form-check-label" for="nostatus">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="upload-area text-end p-2">
                                            <input id="uploadButton_form" type="Submit" class="btn btn-primary"
                                                value="Submit">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <hr>
                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <h3>Chapters List</h3>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr id="showtr">
                                                <th style="width:2%">#</th>
                                                <th style="width:50%">Chapter Name</th>
                                                <th style="width:3%">Status</th>
                                                <th style="width:6%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="userTableBody">
                                            @if ($data->count() > 0)
                                            @foreach ($data as $keys => $user)
                                            <tr>
                                                @php
                                                $assetsdata =
                                                DB::table('courses_assets')->where(['chapter_id'=>
                                                $user->id,'status'=>1])->get();
                                                $assets_count=$assetsdata->count();
                                                @endphp

                                                <td>{{ $keys + 1 }}</td>
                                                <td>
                                                    <div class="accordion" id="accordionChapter{{ $user->id }}">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="headingChapter{{ $user->id }}">
                                                                <button class="accordion-button collapsed" type="button"
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#collapseChapter{{ $user->id }}"
                                                                    aria-expanded="false"
                                                                    aria-controls="collapseChapter{{ $user->id }}">
                                                                    <span>{{ $user->chepter_name }}</span>
                                                                    <span class="position-absolute end-0  p-2"
                                                                    style="margin-right: 59px;">Lectures: {{
                                                                    $assets_count }}</span>
                                                                </button>
                                                            </h2>
                                                            <div id="collapseChapter{{ $user->id }}"
                                                                class="accordion-collapse collapse"
                                                                aria-labelledby="headingChapter{{ $user->id }}"
                                                                data-bs-parent="#accordionChapter{{ $user->id }}">
                                                                <div class="accordion-body">

                                                                    {{-- Add the list of assets here if necessary --}}

                                                                    <form action="{{ route('blogs.assets.form') }}"
                                                                        method="get" style="margin-left: 85%;">
                                                                        @csrf
                                                                        <input type="hidden" name="chapter_id"
                                                                            value="{{ $user->id }}">
                                                                        <input type="hidden" name="course_id"
                                                                            value="{{ $user->courses_id }}">
                                                                        <button type="submit"
                                                                            class="btn btn-sm btn-primary">
                                                                            Manage Assets
                                                                        </button>
                                                                    </form>
                                                                    <div class="accordion-body">

                                                                        @if($assetsdata->count() > 0)
                                                                        <table class="table table-bordered">
                                                                            <thead>
                                                                                <tr>
                                                                                    {{-- <th>#</th> --}}
                                                                                    <th style="width: 80%;">Topic</th>
                                                                                    <th style="width: 20%;">Lectures
                                                                                    </th>
                                                                                    {{-- <th>Actions</th> --}}
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach($assetsdata as $key => $asset)
                                                                                <tr>
                                                                                    {{-- <td>{{ $key + 1 }} .</td> --}}
                                                                                    <td>{{ $asset->topic_name }}</td>


                                                                                    <td>

                                                                                        @if ($asset->assets_video)
                                                                                        <i class="ti ti-video"
                                                                                            style="color:aliceblue;background-color: #1862a9;padding: 4px;border-radius: 50px;"></i>&nbsp;
                                                                                        <a href="#"
                                                                                            onclick="openEditModal('{{ asset('storage/' . $asset->assets_video) }}', '{{ $asset->topic_name }}')"
                                                                                            class="text-primary">
                                                                                            <u>Preview</u>
                                                                                        </a>

                                                                                        @elseif ($asset->video_url ??
                                                                                        $asset->youtube_links)
                                                                                        <i class="ti ti-link"
                                                                                            style="color:aliceblue;background-color: #1862a9;padding: 4px;border-radius: 50px;"></i>&nbsp;&nbsp;
                                                                                        <a href="{{ $asset->video_url ?? $asset->youtube_links }}"
                                                                                            target="_blank">
                                                                                            <u>View</u>
                                                                                        </a>
                                                                                        @else

                                                                                        <i class="ti ti-notes"
                                                                                            style="color:aliceblue;background-color: #1862a9;padding: 4px;border-radius: 50px;"></i>&nbsp;&nbsp;
                                                                                        <a href="#blogModal"
                                                                                            data-bs-toggle="modal"
                                                                                            data-bs-target="#blogModal"
                                                                                            data-description="{{ strip_tags($asset->blog_description) }}"
                                                                                            data-topic="{{ $asset->topic_name }}">
                                                                                            <u>Blog</u>
                                                                                        </a>

                                                                                        @endif
                                                                                    </td>




                                                                                    {{-- <td>

                                                                                        <a href="{{ route('edit_asset', $asset->id) }}"
                                                                                            class="btn btn-sm btn-warning">Edit</a>
                                                                                        <a href="{{ route('delete_asset', $asset->id) }}"
                                                                                            class="btn btn-sm btn-danger"
                                                                                            onclick="return confirm('Are you sure you want to delete this asset?');">Delete</a>

                                                                                    </td> --}}
                                                                                </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                        @else
                                                                        <p>No assets found for this chapter.</p>
                                                                        @endif

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <form action="{{ route('chapterStatus') }}" method="post"
                                                        style="display: inline;">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                                        <input type="hidden" name="status"
                                                            value="{{ $user->status == 1 ? 0 : 1 }}">

                                                        <button type="submit" style="padding:4px"
                                                            class="btn {{ $user->status == 1 ? 'btn-success' : 'btn-danger' }}">
                                                            {{ $user->status == 1 ? 'Active' : 'Inactive' }}
                                                        </button>
                                                    </form>
                                                </td>
                                                <td class="text-center">
                                                    <!-- Edit Button -->
                                                    <a href="#" class="btn btn-sm btn-primary me-2 editButton"
                                                        data-id="{{ $user->id }}" data-name="{{ $user->chepter_name }}"
                                                        data-status="{{ $user->status }}" data-bs-toggle="modal"
                                                        data-bs-target="#editChapterModal">
                                                        <i class="ti ti-edit"></i>
                                                    </a>

                                                    <!-- Delete Button -->
                                                    <a href="{{ route('chapter_delete', $user->id) }}"
                                                        class="btn btn-sm btn-danger me-2"
                                                        onclick="return confirmDelete(this)">
                                                        <i class="ti ti-trash"></i>
                                                    </a>
                                                </td>

                                            </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                                <td colspan="8" class="text-center">No Data Found!</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="blogModal" tabindex="-1" aria-labelledby="blogModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #ececec">
                <h5 class="modal-title" id="blogModalLabel"></h5> <!-- Header will be dynamically updated -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="modalBlogDescription" style="font-size: 16px"></p>
                <!-- Blog description will be dynamically updated -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Video Modal -->
<div id="videoModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lecture Videos</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <button id="editButton" class="btn btn-outline-info" style="float:right;margin-bottom:6px;" onclick="openEditModal()">
    Manage Interactives
</button>
                <video id="videoPlayer" width="100%" controls>
                    <source src="" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <h4 id="videoTopic" class="mt-0"></h4> <!-- Display topic name dynamically here -->
            </div>
            <div class="modal-footer">

</div>
        </div>
    </div>
</div>



<div id="videoEditModal" class="modal fade" tabindex="-1">
<div class="modal-dialog modal-xl" style="height: 600px;width:1300px;margin-top:0px;"> <!-- Set your desired height here -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Interactive Video Editor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="max-height:600px;overflow-y:auto;">
            <button class="btn btn-primary" style="margin-bottom:5px;" onclick="addQuiz()">Add Quiz &nbsp;<i class="fa-solid fa-bars fa-fade" style="vertical-align: bottom;"></i> </button>
            <button class="btn btn-info" style="margin-bottom:5px;" onclick="addFillintheBlanks()">Fill in the Blanks &nbsp;<i class="fa-solid fa-pen-to-square fa-fade"></i> </button>
            <button class="btn btn-warning" style="margin-bottom:5px;" onclick="addintractivegames()">Add InterActive &nbsp;<i class="fa-solid fa-pen-to-square fa-fade"></i> </button>
            <div id="quizContainer" style="position: relative; width: 100%; height: auto;"></div>
            <div class="video-container" style="position: relative;">
                <video id="editVideoPlayer" width="100%" controls>
                    <source src="" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                </div>

                <!-- <h4 id="editVideoTopic" class="mt-3"></h4> -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="editChapterModal" tabindex="-1" aria-labelledby="editChapterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('chapter.update') }}" method="post">
                @csrf
                <input type="hidden" name="id" id="editChapterId">
                <div class="modal-header">
                    <h5 class="modal-title" id="editChapterModalLabel">Edit Chapter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editChapterName">Chapter Name:</label>
                        <input type="text" id="editChapterName" name="chepter_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="editChapterStatus">Chapter Visible:</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="editStatusYes" value="1">
                                <label class="form-check-label" for="editStatusYes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="editStatusNo" value="0">
                                <label class="form-check-label" for="editStatusNo">No</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button> --}}
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>




<div id="videoEditModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Interactive Video Editor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row">


                    <!-- Right Frame: Asset List -->
                    <div class="col-md-6">
                        <div id="assetContainer" class="asset-list-container">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Asset Name</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="assetsTableBody">
                                    @if(!empty($assetsData) && count($assetsData) > 0)
                                        @foreach($assetsData as $index => $asset)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            @if ($asset['thumbnail'])
                                                                <img src="{{ 'https://assets.zinggerr.com/storage/' .  $asset['thumbnail'] }}"
                                                                    alt="User image" style="height:45px;width: 45px;">
                                                            @else
                                                                <img src="{{ asset('asset/images/user/download.jpg') }}"
                                                                    alt="Default image" style="height:45px;width:45px;">
                                                            @endif
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h5 class="mb-1">{{ Str::limit(strip_tags($asset['topic_name']),20, '...') }}</h5>
                                                            <p class="text-muted f-12">{{ Str::limit(strip_tags($asset['about']), 25, '...') }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ ucfirst($asset['assets_type']) }}</td>
                                                <td>
                                                    @if ($asset['asset_status'] == '0')
                                                        <span class="badge rounded-pill bg-light-danger">Inactive</span>
                                                    @elseif($asset['asset_status'] == '1')
                                                        <span class="badge bg-light-success rounded-pill">Active</span>
                                                    @endif
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($asset['asset_create_date'])->format('d-M-Y') }}</td>
                                                <td class="d-flex align-items-center">
                                                    <button class="btn btn-sm btn-success setAssetBtn me-2"
                                                        data-asset-id="{{ $asset['asset_id'] }}" title="Set Asset">
                                                        Set
                                                    </button>



                                                    <button class="btn btn-sm btn-outline-dark eyeAssetBtn"
                                                        onclick="openAssetModal(event, '{{ $asset['assets_type'] }}', '{{ asset('storage/' . $asset['assets_path']) }}', '{{ strip_tags($asset['topic_name']) }}')"
                                                        title="View Asset">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6" class="text-center text-danger">No Data Available</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- End of row -->
            </div>
        </div>
    </div>
</div>



<script>
    document.getElementById('videoEditModal').addEventListener('hidden.bs.modal', function () {
    location.reload();
});
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.editButton');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const chapterId = this.getAttribute('data-id');
            const chapterName = this.getAttribute('data-name');
            const chapterStatus = this.getAttribute('data-status');

            // Populate modal fields
            document.getElementById('editChapterId').value = chapterId;
            document.getElementById('editChapterName').value = chapterName;
            document.getElementById(chapterStatus == 1 ? 'editStatusYes' : 'editStatusNo').checked = true;
        });
    });
});

</script>

<script>

</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const blogModal = document.getElementById('blogModal');
        blogModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Button that triggered the modal
            const description = button.getAttribute('data-description'); // Extract blog description
            const topic = button.getAttribute('data-topic'); // Extract topic name

            // Update modal content
            const modalDescription = document.getElementById('modalBlogDescription');
            const modalTitle = document.getElementById('blogModalLabel');
            modalDescription.textContent = description; // Set blog description
            modalTitle.textContent = topic; // Set topic name as modal header
        });
    });
</script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        ClassicEditor
            .create(document.querySelector('#assets_discription'))
            .catch(error => {
                console.error(error);
            });
    });
</script>
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
    document.addEventListener('DOMContentLoaded', function () {
    const blogAssetContainer = document.querySelector('#blogAssetContainer');

    // Add Blog (with Assets)
    blogAssetContainer.addEventListener('click', function (event) {
        if (event.target.classList.contains('add-blog')) {
            const blogAssetBlock = event.target.closest('.blog-asset-block');
            const clone = blogAssetBlock.cloneNode(true);

            // Clear input values in the cloned block
            clone.querySelectorAll('input, textarea, select').forEach(input => input.value = '');
            clone.querySelectorAll('input[type="radio"]').forEach(radio => (radio.checked = radio.defaultChecked));

            // Assign unique IDs to any CKEditor fields in the cloned block
            const newDescriptionField = clone.querySelector('textarea[name="assets_discription[]"]');
            const uniqueId = 'assets_discription_' + Date.now();
            newDescriptionField.id = uniqueId;

            // Initialize CKEditor for the new field
            setTimeout(() => CKEDITOR.replace(uniqueId), 0);

            // Show the remove button for the cloned block
            clone.querySelector('.remove-blog').classList.remove('d-none');
            blogAssetContainer.appendChild(clone);
        }

        // Remove Blog (and its Assets)
        if (event.target.classList.contains('remove-blog')) {
            const blogAssetBlock = event.target.closest('.blog-asset-block');
            blogAssetBlock.remove();
        }
    });

    // Add Individual Topic (only Assets Fields)
    blogAssetContainer.addEventListener('click', function (event) {
        if (event.target.classList.contains('add-topic')) {
            const blogAssetBlock = event.target.closest('.blog-asset-block');
            const topicContainer = blogAssetBlock.querySelector('.topic-item');
            const topicItem = topicContainer.cloneNode(true);

            // Clear input values in the cloned topic item
            topicItem.querySelectorAll('input, textarea, select').forEach(input => input.value = '');

            // Assign unique IDs to any CKEditor fields in the cloned topic
            const newDescriptionField = topicItem.querySelector('textarea[name="assets_discription[]"]');
            const uniqueId = 'assets_discription_' + Date.now();
            newDescriptionField.id = uniqueId;

            // Initialize CKEditor for the new field
            setTimeout(() => CKEDITOR.replace(uniqueId), 0);

            // Show the remove button for the cloned topic
            topicItem.querySelector('.remove-topic').classList.remove('d-none');

            // Append the cloned topic item (only asset fields)
            blogAssetBlock.querySelector('.topic-item').parentNode.appendChild(topicItem);
        }

        // Remove Individual Topic
        if (event.target.classList.contains('remove-topic')) {
            const topicItem = event.target.closest('.topic-item');
            topicItem.remove();
        }
    });
});
</script> --}}

{{-- .............model................................................ --}}
{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
    // Get the select element for assets materials
    const assetsMetarialSelect = document.querySelector('[name="assets_metarial[]"]');
    const assetsVideoModal = new bootstrap.Modal(document.getElementById('assetsVideoModal'));

    // Add an event listener to detect changes in the dropdown
    assetsMetarialSelect.addEventListener('change', function () {
        if (assetsMetarialSelect.value === "Assets Videos") {
            // Open the modal if "Assets Videos" is selected
            assetsVideoModal.show();
        }
    });
});
</script> --}}



{{-- <script>
    document.getElementById('uploadButton_form').addEventListener('click', function (e) {
        // Prevent form submission
        e.preventDefault();

        // Toggle the dropdown fields
        const dropdown = document.getElementById('dropdownFields');
        if (dropdown.style.display === 'none') {
            dropdown.style.display = 'block';
        } else {
            dropdown.style.display = 'none';
        }
    });
</script> --}}


{{-- <script>
    document.getElementById('uploadButton').addEventListener('click', function (e) {
        e.preventDefault();

        const uploadButton = document.getElementById('uploadButton');
        const fileInput = document.getElementById('course_assets_video');
        const file = fileInput.files[0];
        if (!file) {
            Swal.fire('Error', 'Please select a file to upload', 'error');
            return;
        }

        const blogName = document.getElementById('blog_name').value; // Get blog_name field
        const courseId = document.querySelector('input[name="course_id"]').value; // Get course_id field

        if (!blogName || !courseId) {
            Swal.fire('Error', 'Please provide the Blog Name and Course ID', 'error');
            return;
        }

        // Disable the upload button to prevent multiple clicks
        uploadButton.disabled = true;
        uploadButton.textContent = 'Uploading...';

        const chunkSize = 2 * 1024 * 1024; // 2 MB per chunk
        const totalChunks = Math.ceil(file.size / chunkSize);
        let currentChunk = 0;

        // Show progress bar
        const progressWrapper = document.getElementById('progressWrapper');
        const progressBar = document.getElementById('progressBar');
        const progressText = document.getElementById('progressText');
        progressWrapper.style.display = 'block';

        function uploadChunk() {
            const start = currentChunk * chunkSize;
            const end = Math.min(start + chunkSize, file.size);
            const chunk = file.slice(start, end);

            const formData = new FormData();
            formData.append('file', chunk);
            formData.append('fileName', file.name);
            formData.append('chunkNumber', currentChunk + 1);
            formData.append('totalChunks', totalChunks);

            // Include additional form fields
            formData.append('course_id', courseId);
            formData.append('blog_name', blogName);

            // Include CSRF token
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '{{ route('assets.submit') }}', true);

            // Progress event for the upload
            xhr.upload.onprogress = function (event) {
                if (event.lengthComputable) {
                    const chunkProgress = (event.loaded / event.total) * 100;
                    const overallProgress = ((currentChunk + chunkProgress / 100) / totalChunks) * 100;

                    progressBar.style.width = `${overallProgress.toFixed(2)}%`;
                    progressText.textContent = `${overallProgress.toFixed(2)}%`;
                }
            };

            xhr.onload = function () {
                if (xhr.status === 200) {
                    currentChunk++;
                    if (currentChunk < totalChunks) {
                        uploadChunk();
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Upload Complete',
                            text: 'Your video has been uploaded successfully!',
                            showConfirmButton: false,
                            timer: 5000,
                            willClose: () => {
                                location.reload();
                            },
                        });
                        // Re-enable the upload button after completion
                        uploadButton.disabled = false;
                        uploadButton.textContent = 'Upload Video';
                    }
                } else {
                    Swal.fire('Error', 'Error uploading chunk', 'error');
                    console.error(xhr.responseText);
                    // Re-enable the button in case of an error
                    uploadButton.disabled = false;
                    uploadButton.textContent = 'Upload Video';
                }
            };

            xhr.onerror = function () {
                Swal.fire('Error', 'Error during upload', 'error');
                // Re-enable the button in case of an error
                uploadButton.disabled = false;
                uploadButton.textContent = 'Upload Video';
            };

            xhr.send(formData);
        }

        uploadChunk();
    });
</script> --}}

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


<script>
//   function playVideo(videoPath, topicName) {
//         // Set the video source
//         const videoPlayer = document.getElementById('videoPlayer');
//         videoPlayer.src = videoPath;

//         // Set the topic name below the video
//         const videoTopic = document.getElementById('videoTopic');
//         videoTopic.textContent = topicName;

//             // Store video path and topic name in modal's button
//          const editButton = document.getElementById('editButton');
//          editButton.setAttribute('data-video-path', videoPath);
//          editButton.setAttribute('data-topic-name', topicName);

//         // Show the modal
//         const videoModal = new bootstrap.Modal(document.getElementById('videoModal'));
//         videoModal.show();
//     }

    // Stop video playback when the modal is closed
    document.getElementById('videoModal').addEventListener('hidden.bs.modal', function () {
        const videoPlayer = document.getElementById('videoPlayer');
        videoPlayer.pause(); // Pause the video
        videoPlayer.currentTime = 0; // Reset video playback to the beginning
    });



let quizzes = []; // Store quizzes locally before saving
let videoPlayer;
let currentVideoPath = ''; // Global variable


function openEditModal(videoPath, topicName) {

//     const editButton = document.getElementById('editButton');

// const videoPath = editButton.getAttribute('data-video-path');
// const topicName = editButton.getAttribute('data-topic-name');
    // const videoModalEl = document.getElementById('videoModal');
    // const videoModal2 = bootstrap.Modal.getInstance(videoModalEl);
    // videoModal2.hide();

    // Show the second modal
    const editModal = new bootstrap.Modal(document.getElementById('videoEditModal'), {
        backdrop: 'static', // Prevent closing by clicking outside
        keyboard: false     // Prevent closing via "Esc" key
    });
    editModal.show();

    currentVideoPath = videoPath;
    videoPlayer = document.getElementById('editVideoPlayer');
    videoPlayer.src = videoPath;
    // document.getElementById('editVideoTopic').textContent = topicName;

    // Show modal
    const videoModal = new bootstrap.Modal(document.getElementById('videoEditModal'));
    videoModal.show();

    fetchQuizData(videoPath);
    fetchFillBlanksData(videoPath);
    fetchInteractiveData(videoPath);

    videoPlayer.addEventListener("play", () => {
    setInterval(() => {
        videoPlayer.controls = true;
    }, 100);
});



}



// Function to add quiz when button is clicked
function addQuiz() {
    if (!videoPlayer.paused) {
        alert("Pause the video first to add a quiz.");
        return;
    }

    const timePosition = videoPlayer.currentTime;

    // Create quiz div
    const quizDiv = document.createElement("div");
    quizDiv.classList.add("quiz-box");
    quizDiv.style.position = "absolute";
    quizDiv.style.zIndex = "10000";
    quizDiv.style.background = "rgba(255,255,255,0.9)";
    quizDiv.style.padding = "10px";
    quizDiv.style.border = "2px solid #007bff";
    quizDiv.style.borderRadius = "5px";
    quizDiv.style.cursor = "move";

    let quizId = `quiz-${Date.now()}`;
    quizDiv.id = quizId;

    // Quiz Form
    quizDiv.innerHTML = `
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <strong>Quiz at ${timePosition.toFixed(2)}s</strong>
            <button class="btn btn-sm delete-quiz"
                    style="padding: 2px 6px; font-size: 12px; border-radius: 50%;"
                    onclick="deleteQuiz2('${quizId}')">
                    <i class="fa-solid fa-trash fa-fade" style="color:#f70808;"></i>
            </button>
        </div>
        <input type="text" placeholder="Enter question" class="form-control mt-2 quiz-question" onmousedown="event.stopPropagation()"><br>
        <div class="option-group mt-1">
            <div class="d-flex align-items-center">
                <input type="radio" name="correct-${quizId}" value="0" class="me-2" onmousedown="event.stopPropagation()">
                <input type="text" placeholder="Option 1" class="form-control" onmousedown="event.stopPropagation()">
            </div>
        </div>
        <div class="option-group mt-1">
            <div class="d-flex align-items-center">
                <input type="radio" name="correct-${quizId}" value="1" class="me-2" onmousedown="event.stopPropagation()">
                <input type="text" placeholder="Option 2" class="form-control" onmousedown="event.stopPropagation()">
            </div>
        </div>
        <div class="option-group mt-1">
            <div class="d-flex align-items-center">
                <input type="radio" name="correct-${quizId}" value="2" class="me-2" onmousedown="event.stopPropagation()">
                <input type="text" placeholder="Option 3" class="form-control" onmousedown="event.stopPropagation()">
            </div>
        </div>
        <div class="option-group mt-1">
            <div class="d-flex align-items-center">
                <input type="radio" name="correct-${quizId}" value="3" class="me-2" onmousedown="event.stopPropagation()">
                <input type="text" placeholder="Option 4" class="form-control" onmousedown="event.stopPropagation()">
            </div>
        </div>
        <div class="form-check mt-2">
        <input type="checkbox" class="form-check-input skip-quiz" id="skip-${quizId}" checked onmousedown="event.stopPropagation()">
        <label class="form-check-label" for="skip-${quizId}">Skippable</label>
    </div>
        <center><button class="btn btn-success btn-sm mt-2" onclick="saveQuiz(this, ${timePosition})" onmousedown="event.stopPropagation()">Save</button></center>
    `;
    // Append to quiz container
    document.getElementById("quizContainer").appendChild(quizDiv);

    // Make it draggable
    makeDraggable(quizDiv);
}

function deleteQuiz2(quizId) {
    let quizElement = document.getElementById(quizId);
    if (quizElement) {
        quizElement.remove();
    }
}

function makeDraggable(element) {
    // Remove any existing event listeners to prevent multiple bindings
    element.onmousedown = null;

    element.addEventListener('mousedown', function(dragEvent) {
        // Prevent dragging if clicked on interactive elements
        if (dragEvent.target.tagName === 'INPUT' ||
            dragEvent.target.tagName === 'BUTTON' ||
            dragEvent.target.closest('.delete-quiz')) {
            return;
        }

        // Calculate the exact offset from the mouse click to the element's top-left corner
        let startX = dragEvent.clientX;
        let startY = dragEvent.clientY;
        let initialLeft = element.offsetLeft;
        let initialTop = element.offsetTop;

        // Function to move the element
        function moveAt(pageX, pageY) {
            // Calculate the new position based on the difference from the initial click
            element.style.left = (initialLeft + pageX - startX) + 'px';
            element.style.top = (initialTop + pageY - startY) + 'px';
        }

        // Move the element on mousemove
        function onMouseMove(moveEvent) {
            moveAt(moveEvent.pageX, moveEvent.pageY);
        }

        // Add listeners for moving
        document.addEventListener('mousemove', onMouseMove);

        // Remove listeners when mouse up
        function onMouseUp() {
            document.removeEventListener('mousemove', onMouseMove);
            document.removeEventListener('mouseup', onMouseUp);
        }

        // Add mouseup listener to stop dragging
        document.addEventListener('mouseup', onMouseUp);

        // Prevent default drag behavior
        dragEvent.preventDefault();
    });

    // Prevent default drag start
    element.ondragstart = function() {
        return false;
    };

    // Ensure inputs and buttons are interactive
    const inputs = element.querySelectorAll('input, button');
    inputs.forEach(input => {
        input.addEventListener('mousedown', function(event) {
            event.stopPropagation();
        });
    });
}


// Save quiz
function saveQuiz(button, timePosition) {
    button.innerHTML = "Saving...";
    button.disabled = true;
    const quizDiv = button.closest('.quiz-box');
    const question = quizDiv.querySelector(".quiz-question").value;
    const options = Array.from(quizDiv.querySelectorAll(".option-group input[type='text']")).map(opt => opt.value);
    const correctOptionIndex = quizDiv.querySelector('input[type="radio"]:checked')?.value;
    const correctOption = parseInt(correctOptionIndex) + 1;
    const isSkippable = quizDiv.querySelector(".skip-quiz").checked ? 1 : 0;
    const position = quizDiv.getBoundingClientRect();
    const videoContainer = document.getElementById("quizContainer").getBoundingClientRect();

    const posX = position.left - videoContainer.left;
    const posY = position.top - videoContainer.top;

    if (!question || options.some(opt => !opt) || correctOption === undefined) {
        alert("Please fill all fields and select correct answer");
        return;
    }

    $.ajax({
        url: '{{ route('upload.quizess') }}',
        method: 'POST',
        data: {
            question: question,
            options: options,
            correct_option: correctOption,
            time_position: timePosition,
            position_x: posX,
            position_y: posY,
            VideoPaths: currentVideoPath,
            skippable: isSkippable,
            _token: $('meta[name="csrf-token"]').attr('content') // Add CSRF token
        },
        success: function(response) {
            quizDiv.style.display = 'none';
            Swal.fire({
                title: 'Success!',
                text: `Question added successfully at ${timePosition.toFixed(2)}s`,
                icon: 'success',
                timer: 2000,
                customClass: {
            popup: 'swal2-highest-zindex' // Add custom class
        }
            });
            fetchQuizData(currentVideoPath);
        },
        error: function(xhr, status, error) {
    Swal.fire({
        title: 'Error!',
        text: 'Error saving quiz: ' + error,
        icon: 'error',
        customClass: {
            popup: 'swal2-highest-zindex' // Add custom class
        }
    }).then(() => {
        // Re-enable button after error message is dismissed
        button.innerHTML = "Save";
        button.disabled = false;
    });
}

    });
}

// Fetch quizzes when video reaches time
// videoPlayer.addEventListener("timeupdate", function() {
//     quizzes.forEach(quiz => {
//         if (Math.abs(videoPlayer.currentTime - quiz.time) < 0.5) {
//             showQuiz(quiz);
//         }
//     });
// });

// Show quiz popup
function showQuiz(quiz) {
    const quizDiv = document.createElement("div");
    quizDiv.classList.add("quiz-popup");
    quizDiv.style.position = "absolute";
    quizDiv.style.left = quiz.x + "px";
    quizDiv.style.top = quiz.y + "px";
    quizDiv.style.background = "white";
    quizDiv.style.padding = "10px";
    quizDiv.style.border = "2px solid #ff0000";
    quizDiv.style.borderRadius = "5px";

    quizDiv.innerHTML = `
        <strong>${quiz.question}</strong><br>
        ${quiz.options.map(opt => `<input type="radio" name="quiz-${quiz.time}"> ${opt}<br>`).join("")}
    `;

    document.getElementById("quizContainer").appendChild(quizDiv);
}


// Function to fetch quiz data
function fetchQuizData(videoPath) {
    $.ajax({
        url: '{{ route('get.video.quizzes') }}',
        method: 'POST',
        data: {
            video_path: videoPath,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.quizzes && response.quizzes.length > 0) {
                // console.log(response.quizzes);
                setupVideoQuizzes(response.quizzes);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching quiz data:', error);
        }
    });
}

function setupVideoQuizzes(quizzes) {
    const videoPlayer = document.getElementById('editVideoPlayer');

    // console.log("quizzes",quizzes);
    // Create checkpoint container (your existing code)
    let checkpointContainer = document.getElementById('checkpoint-container');
    if (!checkpointContainer) {
        checkpointContainer = document.createElement('div');
        checkpointContainer.id = 'checkpoint-container';
        checkpointContainer.style.cssText = `
            position: absolute;
            bottom: 14px;
            left: 0;
            width: 94%;
            height: 16px;
            pointer-events: none;
            z-index: 1;
        `;
        videoPlayer.parentNode.insertBefore(checkpointContainer, videoPlayer);
    }

    // Clear existing markers
    clearCheckpoints();

    // Function to add checkpoints
    const addCheckpoints = () => {
        quizzes.forEach(quiz => {
            addCheckpointMarker(quiz.quiz_time, videoPlayer.duration);
        });
    };

    // Handle metadata loading
    if (videoPlayer.readyState >= 1) {
        addCheckpoints();
    } else {
        videoPlayer.addEventListener('loadedmetadata', addCheckpoints);
    }

    // Sort quizzes by time
    const sortedQuizzes = quizzes.sort((a, b) => a.quiz_time - b.quiz_time);

    // Reset tracking variables
    shownQuizzes = new Set();
    lastPausedQuizId = null;

    // Setup event handlers
    setupQuizVideoHandlers();

    // Add timeupdate listener
    videoPlayer.addEventListener('timeupdate', () => {
        handleQuizDisplay(sortedQuizzes, videoPlayer.currentTime);
    });
}


function addCheckpointMarker(quizTime, videoDuration) {
    const checkpointContainer = document.getElementById('checkpoint-container');

    const marker = document.createElement('div');
    marker.className = 'quiz-checkpoint';

    // Calculate position percentage
    const positionPercentage = (quizTime / videoDuration) * 100;

    marker.style.cssText = `
        position: absolute;
        width: 3px;
        height: 10px;
        background-color: #2689E2;
        bottom: 0;
        left: calc(${positionPercentage}% - 1px);
        pointer-events: none;
        z-index: 2;
    `;

    checkpointContainer.appendChild(marker);
}

function clearCheckpoints() {
    const checkpointContainer = document.getElementById('checkpoint-container');
    if (checkpointContainer) {
        checkpointContainer.innerHTML = '';
    }
}

// Keep track of shown quizzes
let shownQuizzes = new Set();
let lastPausedQuizId = null;

function handleQuizDisplay(sortedQuizzes, currentTime) {
    // console.log("sortedQuizzes",sortedQuizzes);
    const videoPlayer = document.getElementById('editVideoPlayer');

    // If video is playing, hide any previously shown quiz
    if (!videoPlayer.paused && lastPausedQuizId) {
        const lastQuizDiv = document.getElementById(`quiz-${lastPausedQuizId}`);
        if (lastQuizDiv) {
            lastQuizDiv.style.display = 'none';
        }
        lastPausedQuizId = null;
        return;
    }

    // Check each quiz
    sortedQuizzes.forEach(quiz => {
        const quizId = `quiz-${quiz.id}`;
        const existingQuiz = document.getElementById(quizId);

        // If we're within 0.5 seconds of the quiz time
        if (Math.abs(currentTime - quiz.quiz_time) < 0.15) {
            // If the quiz exists but is hidden, show it
            if (existingQuiz) {
                if (existingQuiz.style.display === 'none') {
                    existingQuiz.style.display = 'block';
                    videoPlayer.pause();
                    lastPausedQuizId = quiz.id;
                }
            } else {
                // Create new quiz div
                createQuizDiv(quiz);
                videoPlayer.pause();
                lastPausedQuizId = quiz.id;
            }
            shownQuizzes.add(quiz.id);
        } else {
            // If we're not at quiz time and the quiz is shown, hide it
            if (existingQuiz && lastPausedQuizId !== quiz.id) {
                existingQuiz.style.display = 'none';
            }
        }
    });
}

// Add this function to setup the video player event listeners
function setupQuizVideoHandlers() {
    const videoPlayer = document.getElementById('editVideoPlayer');

    // When video starts playing, hide current quiz
    videoPlayer.addEventListener('play', () => {
        if (lastPausedQuizId) {
            const quizDiv = document.getElementById(`quiz-${lastPausedQuizId}`);
            if (quizDiv) {
                quizDiv.style.display = 'none';
            }
            lastPausedQuizId = null;
        }
    });

    // When video is seeked, reset the shown quizzes
    videoPlayer.addEventListener('seeked', () => {
        shownQuizzes.clear();
        lastPausedQuizId = null;
        // Hide all quiz divs
        document.querySelectorAll('[id^="quiz-"]').forEach(div => {
            div.style.display = 'none';
        });
    });
}




// Function to create quiz div
// function createQuizDiv(quiz) {
//     const quizContainer = document.getElementById('quizContainer');
//     const quizDiv = document.createElement('div');
//     quizDiv.id = `quiz-${quiz.id}`;
//     quizDiv.className = 'quiz-overlay';
//     quizDiv.style.cssText = `
//         position: absolute;
//         top: ${quiz.position_y}px;
//         left: ${quiz.position_x}px;
//         background-color: rgba(255, 255, 255, 0.9);
//         padding: 15px;
//         border-radius: 8px;
//         box-shadow: 0 2px 10px rgba(0,0,0,0.1);
//         z-index: 1000;
//         min-width: 300px;
//     `;

//     // Create quiz content with your specific data structure
//     quizDiv.innerHTML = `
//         <h5>${quiz.quiz_question}</h5>
//         <div class="options-container">
//             <div class="form-check">
//                 <input class="form-check-input" type="radio" name="quiz-${quiz.id}" value="1">
//                 <label class="form-check-label">${quiz.option_1}</label>
//             </div>
//             <div class="form-check">
//                 <input class="form-check-input" type="radio" name="quiz-${quiz.id}" value="2">
//                 <label class="form-check-label">${quiz.option_2}</label>
//             </div>
//             <div class="form-check">
//                 <input class="form-check-input" type="radio" name="quiz-${quiz.id}" value="3">
//                 <label class="form-check-label">${quiz.option_3}</label>
//             </div>
//             <div class="form-check">
//                 <input class="form-check-input" type="radio" name="quiz-${quiz.id}" value="4">
//                 <label class="form-check-label">${quiz.option_4}</label>
//             </div>
//         </div>
//         <button class="btn btn-primary mt-2" onclick="submitQuizAnswer('${quiz.id}', ${quiz.correct_option})">Submit</button>
//     `;

//     quizContainer.appendChild(quizDiv);
// }


function createQuizDiv(quiz) {
    const quizContainer = document.getElementById('quizContainer');
    const quizDiv = document.createElement('div');
    quizDiv.id = `quiz-${quiz.id}`;
    quizDiv.classList.add('quiz-box');
    quizDiv.style.position = 'absolute';
    quizDiv.style.top = `${quiz.position_y}px`;
    quizDiv.style.left = `${quiz.position_x}px`;
    quizDiv.style.zIndex = '10000';
    quizDiv.style.background = 'rgba(255,255,255,0.9)';
    quizDiv.style.padding = '10px';
    quizDiv.style.border = '2px solid #007bff';
    quizDiv.style.borderRadius = '5px';
    quizDiv.style.cursor = 'move';
    quizDiv.style.minWidth = '300px';

    // Create quiz content with editable fields
    quizDiv.innerHTML = `
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <strong>Quiz at ${quiz.quiz_time.toFixed(2)}s</strong>
            <button class="btn btn-sm delete-quiz"
                    style="padding: 2px 6px; font-size: 12px; border-radius: 50%;"
                    onclick="deleteQuiz('${quiz.id}')">
                    <i class="fa-solid fa-trash fa-fade" style="color:#f70808;"></i>
            </button>
        </div>
        <input type="hidden" class="quiz-id" value="${quiz.id}">
        <input type="hidden" class="chapter-id" value="${quiz.chapter_id}">
        <input type="hidden" class="course-id" value="${quiz.course_id}">
        <input type="text" placeholder="Enter question" class="form-control mt-2 quiz-question"
               value="${quiz.quiz_question}" onmousedown="event.stopPropagation()"><br>
        <div class="option-group mt-1">
            <div class="d-flex align-items-center">
                <input type="radio" name="correct-${quiz.id}" value="1" class="me-2"
                       ${quiz.correct_option === 1 ? 'checked' : ''} onmousedown="event.stopPropagation()">
                <input type="text" placeholder="Option 1" class="form-control"
                       value="${quiz.option_1}" onmousedown="event.stopPropagation()">
            </div>
        </div>
        <div class="option-group mt-1">
            <div class="d-flex align-items-center">
                <input type="radio" name="correct-${quiz.id}" value="2" class="me-2"
                       ${quiz.correct_option === 2 ? 'checked' : ''} onmousedown="event.stopPropagation()">
                <input type="text" placeholder="Option 2" class="form-control"
                       value="${quiz.option_2}" onmousedown="event.stopPropagation()">
            </div>
        </div>
        <div class="option-group mt-1">
            <div class="d-flex align-items-center">
                <input type="radio" name="correct-${quiz.id}" value="3" class="me-2"
                       ${quiz.correct_option === 3 ? 'checked' : ''} onmousedown="event.stopPropagation()">
                <input type="text" placeholder="Option 3" class="form-control"
                       value="${quiz.option_3}" onmousedown="event.stopPropagation()">
            </div>
        </div>
        <div class="option-group mt-1">
            <div class="d-flex align-items-center">
                <input type="radio" name="correct-${quiz.id}" value="4" class="me-2"
                       ${quiz.correct_option === 4 ? 'checked' : ''} onmousedown="event.stopPropagation()">
                <input type="text" placeholder="Option 4" class="form-control"
                       value="${quiz.option_4}" onmousedown="event.stopPropagation()">
            </div>
        </div>

        <div class="form-check mt-2">
        <input type="checkbox" class="form-check-input skip-quiz" id="skip-${quiz.id}"
               ${quiz.skippable == 1 ? 'checked' : ''} onmousedown="event.stopPropagation()">
        <label class="form-check-label" for="skip-${quiz.id}">Skippable</label>
    </div>

        <center>
            <button class="btn btn-success btn-sm mt-2"
                    onclick="updateQuiz(this, ${quiz.quiz_time})"
                    onmousedown="event.stopPropagation()">Update</button>
        </center>
    `;

    quizContainer.appendChild(quizDiv);

    // Make the quiz div draggable
    makeDraggable(quizDiv);
}



function updateQuiz(button, timePosition) {
    const quizDiv = button.closest('.quiz-box');
    const originalButtonText = button.innerHTML;
    button.innerHTML = "Updating...";
    button.disabled = true;

    // Collect all options into an array
    const options = Array.from(quizDiv.querySelectorAll('.option-group input[type="text"]'))
        .map(input => input.value);

    const isSkippable = quizDiv.querySelector(".skip-quiz").checked ? 1 : 0;


    const quizData = {
        id: quizDiv.querySelector('.quiz-id').value,
        question: quizDiv.querySelector('.quiz-question').value,
        options: options,
        correct_option: parseInt(quizDiv.querySelector('input[type="radio"]:checked').value),
        time_position: timePosition,
        position_x: parseInt(quizDiv.style.left),
        position_y: parseInt(quizDiv.style.top),
        VideoPaths: currentVideoPath,
        skippable: isSkippable,
        _token: $('meta[name="csrf-token"]').attr('content')
    };

    // console.log(quizData);
    $.ajax({
        url: '/update-quiz/' + quizData.id, // Update with your actual route
        method: 'POST',
        data: quizData,
        success: function(response) {
            button.innerHTML = originalButtonText;
            button.disabled = false;

            Swal.fire({
                title: 'Success!',
                text: 'Quiz updated successfully',
                icon: 'success',
                timer: 2000,
                customClass: {
                    popup: 'swal2-highest-zindex'
                }
            });

            // Refresh quiz data
            fetchQuizData(currentVideoPath);
        },
        error: function(xhr, status, error) {
            Swal.fire({
                title: 'Error!',
                text: 'Error updating quiz: ' + error,
                icon: 'error',
                customClass: {
                    popup: 'swal2-highest-zindex'
                }
            }).then(() => {
                button.innerHTML = originalButtonText;
                button.disabled = false;
            });
        }
    });
}

function deleteQuiz(quizId) {

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        customClass: {
            popup: 'swal2-highest-zindex'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/delete-quiz/' + quizId, // Update with your actual route
                method: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Quiz has been deleted.',
                        icon: 'success',
                        timer: 1000,
                        customClass: {
                            popup: 'swal2-highest-zindex'
                        }
                    });

                    // Remove the quiz div from DOM
                    $(`#quiz-${quizId}`).remove();
                    // Refresh quiz data
                    fetchQuizData(currentVideoPath);
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Error deleting quiz: ' + error,
                        icon: 'error',
                        customClass: {
                            popup: 'swal2-highest-zindex'
                        }
                    });
                    $(`#quiz-${quizId}`).remove();
                }
            });
        }
    });
}

// Function to submit quiz answer
function submitQuizAnswer(quizId, correctOption) {
    const selectedOption = document.querySelector(`input[name="quiz-${quizId}"]:checked`);
    if (selectedOption) {
        const isCorrect = parseInt(selectedOption.value) === correctOption;
        const quizDiv = document.getElementById(`quiz-${quizId}`);

        // Show result
        const resultDiv = document.createElement('div');
        resultDiv.className = `alert alert-${isCorrect ? 'success' : 'danger'} mt-2`;
        resultDiv.textContent = isCorrect ? 'Correct!' : 'Incorrect. Try again!';
        quizDiv.appendChild(resultDiv);

        if (isCorrect) {
            // Remove quiz after 1.5 seconds if correct
            setTimeout(() => {
                quizDiv.remove();
                document.getElementById('editVideoPlayer').play();
            }, 1500);
        }
    } else {
        alert('Please select an answer!');
    }
}

// Function to handle time updates
// function timeUpdateHandler(sortedQuizzes) {
//     const videoPlayer = document.getElementById('editVideoPlayer');
//     const currentTime = videoPlayer.currentTime;

//     sortedQuizzes.forEach(quiz => {
//         // Check if we're within 0.5 seconds of the quiz time
//         if (Math.abs(currentTime - quiz.quiz_time) < 0.5) {
//             const existingQuiz = document.getElementById(`quiz-${quiz.id}`);
//             if (!existingQuiz) {
//                 createQuizDiv(quiz);
//                 videoPlayer.pause();
//             }
//         }
//     });
// }



function addFillintheBlanks() {
    if (!videoPlayer.paused) {
        alert("Pause the video first to add fill in the blanks.");
        return;
    }

    const timePosition = videoPlayer.currentTime;

    // Create fill in the blanks div
    const fillBlanksDiv = document.createElement("div");
    fillBlanksDiv.classList.add("fill-blanks-box");
    fillBlanksDiv.style.position = "absolute";
    fillBlanksDiv.style.width = "500px";
    fillBlanksDiv.style.zIndex = "10000";
    fillBlanksDiv.style.background = "rgba(255,255,255,0.9)";
    fillBlanksDiv.style.padding = "10px";
    fillBlanksDiv.style.border = "2px solid #17a2b8";
    fillBlanksDiv.style.borderRadius = "5px";
    fillBlanksDiv.style.cursor = "move";

    let fillBlanksId = `fill-blanks-${Date.now()}`;
    fillBlanksDiv.id = fillBlanksId;

// Add custom styles for the preview div
const styleEl = document.createElement('style');
styleEl.textContent = `
    .blank-preview {
        min-height: 80px;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        padding: 0.375rem 0.75rem;
        background-color: #f8f9fa;
        margin-top: 5px;
    }
    .blank-space {
        display: inline-block;
        min-width: 80px;
        border-bottom: 2px solid #007bff;
        margin: 0 4px;
        background-color: #e7f1ff;
        padding: 0 4px;
    }
`;
document.head.appendChild(styleEl);

    // Fill in the blanks Form
    fillBlanksDiv.innerHTML = `
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <strong>Fill in the Blanks at ${timePosition.toFixed(2)}s</strong>
            <button class="btn btn-sm delete-fill-blanks"
                    style="padding: 2px 6px; font-size: 12px; border-radius: 50%;"
                    onclick="deleteFillBlanks('${fillBlanksId}')">
                    <i class="fa-solid fa-trash fa-fade" style="color:#f70808;"></i>
            </button>
        </div>
        <div class="mt-2">
            <label class="form-label">Instructions:</label>
            <input type="text"
                   placeholder="Enter instructions (e.g., Fill in the missing words)"
                   class="form-control fill-blanks-instructions"
                   onmousedown="event.stopPropagation()">
        </div>

       <div class="mt-2">
            <label class="form-label">Sentence with blanks:</label>
            <textarea class="form-control fill-blanks-sentence"
                      placeholder="Enter sentence with ___ for blanks (e.g., The sky is ___ and the grass is ___.)"
                      rows="3"
                      onmousedown="event.stopPropagation()"
                      oninput="updateBlankPreview('${fillBlanksId}')"></textarea>
            <div class="blank-preview" id="preview-${fillBlanksId}"></div>
        </div>

        <div id="answers-${fillBlanksId}" class="answers-container mt-2" style="max-height:100px;overflow-y:auto;">
            <label class="form-label">Correct Answers:</label>
            <div class="answer-group mt-1">
                <input type="text"
                       placeholder="Answer for blank 1"
                       class="form-control fill-blanks-answer"
                       onmousedown="event.stopPropagation()">
            </div>
        </div>
        <button class="btn btn-sm btn-primary mt-2"
                onclick="addAnswerField('${fillBlanksId}')"
                onmousedown="event.stopPropagation()">
            Add Another Blank
        </button>
        <div class="form-check mt-2">
            <input type="checkbox"
                   class="form-check-input skip-fill-blanks"
                   id="skip-${fillBlanksId}"
                   checked
                   onmousedown="event.stopPropagation()">
            <label class="form-check-label" for="skip-${fillBlanksId}">Skippable</label>
        </div>
        <center>
            <button class="btn btn-success btn-sm mt-2"
                    onclick="saveFillBlanks(this, ${timePosition})"
                    onmousedown="event.stopPropagation()">
                Save
            </button>
        </center>
    `;

    // Append to quiz container
    document.getElementById("quizContainer").appendChild(fillBlanksDiv);

    // Make it draggable
    makeDraggable(fillBlanksDiv);
}

function deleteFillBlanks(fillBlanksId) {
    let element = document.getElementById(fillBlanksId);
    if (element) {
        element.remove();
    }
}

function addAnswerField(fillBlanksId) {
    const answersContainer = document.getElementById(`answers-${fillBlanksId}`);
    const answerGroups = answersContainer.getElementsByClassName('answer-group');
    const newAnswerGroup = document.createElement('div');
    newAnswerGroup.className = 'answer-group mt-1';
    newAnswerGroup.innerHTML = `
        <div class="d-flex gap-2">
            <input type="text"
                   placeholder="Answer for blank ${answerGroups.length + 1}"
                   class="form-control fill-blanks-answer"
                   onmousedown="event.stopPropagation()">
            <button class="btn btn-danger btn-sm"
                    onclick="removeAnswerField('${fillBlanksId}', this)"
                    onmousedown="event.stopPropagation()">
                <i class="fa-solid fa-minus"></i>
            </button>
        </div>
    `;
    answersContainer.appendChild(newAnswerGroup);
}

function removeAnswerField(fillBlanksId, button) {
    const answersContainer = document.getElementById(`answers-${fillBlanksId}`);

    // Remove the answer group
    button.closest('.answer-group').remove();

    // Update placeholders for remaining answers
    const remainingAnswers = answersContainer.getElementsByClassName('fill-blanks-answer');
    for (let i = 0; i < remainingAnswers.length; i++) {
        remainingAnswers[i].placeholder = `Answer for blank ${i + 1}`;
    }
}


function updateBlankPreview(fillBlanksId) {
    const textarea = document.querySelector(`#${fillBlanksId} .fill-blanks-sentence`);
    const previewDiv = document.getElementById(`preview-${fillBlanksId}`);
    const text = textarea.value;

    // Replace underscores with styled spans
    const formattedText = text.replace(/_{1,}/g, match => {
        return '<span class="blank-space">' + '&nbsp;'.repeat(match.length) + '</span>';
    });

    previewDiv.innerHTML = formattedText;

    // Update answer fields based on number of blanks
    const blankCount = (text.match(/_{1,}/g) || []).length;
    const answersContainer = document.getElementById(`answers-${fillBlanksId}`);
    const currentAnswerFields = answersContainer.getElementsByClassName('answer-group');

    // Add or remove answer fields to match blank count
    while (currentAnswerFields.length < blankCount) {
        addAnswerField(fillBlanksId);
    }
    while (currentAnswerFields.length > blankCount && currentAnswerFields.length > 1) {
        currentAnswerFields[currentAnswerFields.length - 1].remove();
    }
}



function saveFillBlanks(button, timePosition) {
    // Get the parent fill-blanks div
    const fillBlanksDiv = button.closest('.fill-blanks-box');
    const fillBlanksId = fillBlanksDiv.id;

    // Get all the required elements
    const instructions = fillBlanksDiv.querySelector('.fill-blanks-instructions').value.trim();
    const sentence = fillBlanksDiv.querySelector('.fill-blanks-sentence').value.trim();
    const answerFields = fillBlanksDiv.querySelectorAll('.fill-blanks-answer');
    const isSkippable = fillBlanksDiv.querySelector('.skip-fill-blanks').checked ? 1 : 0;

    const position = fillBlanksDiv.getBoundingClientRect();
    const videoContainer = document.getElementById("quizContainer").getBoundingClientRect();

    const posX = position.left - videoContainer.left;
    const posY = position.top - videoContainer.top;

    // Check if instructions and sentence are not empty
    if (!instructions) {
        alert('Please enter instructions for the fill in the blanks.');
        return;
    }
    if (!sentence) {
        alert('Please enter a sentence with blanks.');
        return;
    }

    // Count number of blanks in the sentence
    const blankCount = (sentence.match(/_{1,}/g) || []).length;

    // Check if there are any blanks
    if (blankCount === 0) {
        alert('Please add at least one blank (_) in your sentence.');
        return;
    }

    // Check if number of blanks matches number of answer fields
    if (blankCount !== answerFields.length) {
        alert(`Mismatch between number of blanks (${blankCount}) and answer fields (${answerFields.length}). Please correct this.`);
        return;
    }

    // Check if all answer fields are filled
    const answers = [];
    for (let i = 0; i < answerFields.length; i++) {
        const answer = answerFields[i].value.trim();
        if (!answer) {
            alert(`Please fill in the answer for blank ${i + 1}.`);
            return;
        }
        answers.push(answer);
    }

    // Prepare data for submission
    const formData = {
        video_time: timePosition,
        instructions: instructions,
        sentence: sentence,
        answers: answers,
        position_x: posX,
        position_y: posY,
        VideoPaths: currentVideoPath,
        is_skippable: isSkippable,
        _token: document.querySelector('meta[name="csrf-token"]').content // For Laravel CSRF protection
    };

    // Disable the save button and show loading state
    button.disabled = true;
    const originalButtonText = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';


    // Send data to Laravel backend using Ajax
    $.ajax({
        url: '{{ route('add.fillintheblanks') }}', // Update this to your actual route
        method: 'POST',
        data: formData,
        success: function(response) {
            if (response.success) {
                // Show success message
                Swal.fire({
                    icon: 'success',
                    title: 'Saved!',
                    text: 'Fill in the blanks has been saved successfully.',
                    showConfirmButton: false,
                    timer: 1500
                });

                // Remove the fill blanks div
                fillBlanksDiv.remove();

                fetchFillBlanksData(currentVideoPath);
            } else {
                // Show error message
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message || 'Something went wrong. Please try again.'
                });
            }
        },
        error: function(xhr) {
            // Handle error response
            let errorMessage = 'Something went wrong. Please try again.';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMessage = xhr.responseJSON.message;
            }

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: errorMessage
            });
        },
        complete: function() {
            // Re-enable the save button and restore original text
            button.disabled = false;
            button.innerHTML = originalButtonText;
        }
    });
}



function fetchFillBlanksData(videoPath) {
    $.ajax({
        url: '{{ route("get.video.fillblanks") }}',
        method: 'POST',
        data: {
            video_name: videoPath,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.fillBlanks && response.fillBlanks.length > 0) {
                setupFillBlanksCheckpoints(response.fillBlanks);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching fill-in-the-blanks data:', error);
        }
    });
}

function setupFillBlanksCheckpoints(fillBlanks) {
    const videoPlayer = document.getElementById('editVideoPlayer');

    // Create checkpoint container if it doesn't exist
    let fillBlanksContainer = document.getElementById('fillblanks-container');
    if (!fillBlanksContainer) {
        fillBlanksContainer = document.createElement('div');
        fillBlanksContainer.id = 'fillblanks-container';
        fillBlanksContainer.style.cssText = `
            position: absolute;
            bottom: 14px;
            left: 0;
            width: 94%;
            height: 16px;
            pointer-events: none;
            z-index: 1;
        `;
        videoPlayer.parentNode.insertBefore(fillBlanksContainer, videoPlayer);
    }

    // Clear existing fill-in-the-blanks markers
    clearFillBlanksCheckpoints();

    // Function to add fill-in-the-blanks checkpoints
    const addFillBlanksCheckpoints = () => {
        fillBlanks.forEach(blank => {
            addFillBlankMarker(blank.video_time, videoPlayer.duration);
        });
    };

    // Handle metadata loading
    if (videoPlayer.readyState >= 1) {
        addFillBlanksCheckpoints();
    } else {
        videoPlayer.addEventListener('loadedmetadata', addFillBlanksCheckpoints);
    }

    // Sort fill-in-the-blanks by time
    const sortedFillBlanks = fillBlanks.sort((a, b) => a.video_time - b.video_time);

    // Reset tracking variables
    shownFillBlanks = new Set();
    lastPausedFillBlankId = null;

    // Setup event handlers
    setupFillBlanksVideoHandlers();

    // Add timeupdate listener
    videoPlayer.addEventListener('timeupdate', () => {
        handleFillBlanksDisplay(sortedFillBlanks, videoPlayer.currentTime);
    });
}

function addFillBlankMarker(blankTime, videoDuration) {
    const fillBlanksContainer = document.getElementById('fillblanks-container');

    const marker = document.createElement('div');
    marker.className = 'fillblank-checkpoint';

    // Calculate position percentage
    const positionPercentage = (blankTime / videoDuration) * 100;

    marker.style.cssText = `
        position: absolute;
        width: 3px;
        height: 15px;
        background-color: #3EC9D6;  // Different color for fill-in-the-blanks
        bottom: 14px;
        left: calc(${positionPercentage}% - 1px);
        pointer-events: none;
        z-index: 2;
    `;

    fillBlanksContainer.appendChild(marker);
}

function clearFillBlanksCheckpoints() {
    const fillBlanksContainer = document.getElementById('fillblanks-container');
    if (fillBlanksContainer) {
        fillBlanksContainer.innerHTML = '';
    }
}

// Keep track of shown fill-in-the-blanks
let shownFillBlanks = new Set();
let lastPausedFillBlankId = null;

function handleFillBlanksDisplay(sortedFillBlanks, currentTime) {
    const videoPlayer = document.getElementById('editVideoPlayer');

    // If video is playing, hide any previously shown fill-in-the-blank
    if (!videoPlayer.paused && lastPausedFillBlankId) {
        const lastFillBlankDiv = document.getElementById(`fillblank-${lastPausedFillBlankId}`);
        if (lastFillBlankDiv) {
            lastFillBlankDiv.style.display = 'none';
        }
        lastPausedFillBlankId = null;
        return;
    }

    // Check each fill-in-the-blank
    sortedFillBlanks.forEach(blank => {
        const fillBlankId = `fillblank-${blank.id}`;
        const existingFillBlank = document.getElementById(fillBlankId);

        // If we're within 0.5 seconds of the fill-in-the-blank time
        if (Math.abs(currentTime - blank.video_time) < 0.15) {
            // If the fill-in-the-blank exists but is hidden, show it
            if (existingFillBlank) {
                if (existingFillBlank.style.display === 'none') {
                    existingFillBlank.style.display = 'block';
                    videoPlayer.pause();
                    lastPausedFillBlankId = blank.id;
                }
            } else {
                // Create new fill-in-the-blank div
                createFillBlankDiv(blank);
                videoPlayer.pause();
                lastPausedFillBlankId = blank.id;
            }
            shownFillBlanks.add(blank.id);
        } else {
            // If we're not at fill-in-the-blank time and it's shown, hide it
            if (existingFillBlank && lastPausedFillBlankId !== blank.id) {
                existingFillBlank.style.display = 'none';
            }
        }
    });
}

function setupFillBlanksVideoHandlers() {
    const videoPlayer = document.getElementById('editVideoPlayer');

    // When video starts playing, hide current fill-in-the-blank
    videoPlayer.addEventListener('play', () => {
        if (lastPausedFillBlankId) {
            const fillBlankDiv = document.getElementById(`fillblank-${lastPausedFillBlankId}`);
            if (fillBlankDiv) {
                fillBlankDiv.style.display = 'none';
            }
            lastPausedFillBlankId = null;
        }
    });

    // When video is seeked, reset the shown fill-in-the-blanks
    videoPlayer.addEventListener('seeked', () => {
        shownFillBlanks.clear();
        lastPausedFillBlankId = null;
        // Hide all fill-in-the-blank divs
        document.querySelectorAll('[id^="fillblank-"]').forEach(div => {
            div.style.display = 'none';
        });
    });
}



function createFillBlankDiv(blank) {
    const videoPlayer = document.getElementById('editVideoPlayer');

    // Create fill in the blanks div
    const fillBlanksDiv = document.createElement("div");
    fillBlanksDiv.classList.add("fill-blanks-box");
    fillBlanksDiv.style.position = "absolute";
    fillBlanksDiv.style.width = "500px";
    fillBlanksDiv.style.zIndex = "10000";
    fillBlanksDiv.style.background = "rgba(255,255,255,0.9)";
    fillBlanksDiv.style.padding = "10px";
    fillBlanksDiv.style.border = "2px solid #17a2b8";
    fillBlanksDiv.style.borderRadius = "5px";
    fillBlanksDiv.style.cursor = "move";

    const fillBlanksId = `fillblank-${blank.id}`;
    fillBlanksDiv.id = fillBlanksId;

    // Add style for preview if not already present
    if (!document.getElementById('blank-preview-style')) {
        const styleEl = document.createElement('style');
        styleEl.id = 'blank-preview-style';
        styleEl.textContent = `
            .blank-preview {
                min-height: 80px;
                border: 1px solid #ced4da;
                border-radius: 0.25rem;
                padding: 0.375rem 0.75rem;
                background-color: #f8f9fa;
                margin-top: 5px;
            }
            .blank-space {
                display: inline-block;
                min-width: 80px;
                border-bottom: 2px solid #007bff;
                margin: 0 4px;
                background-color: #e7f1ff;
                padding: 0 4px;
            }
        `;
        document.head.appendChild(styleEl);
    }

    // Parse answers from the response
    const answers = Array.isArray(blank.answers) ? blank.answers : JSON.parse(blank.answers);

    // Fill in the blanks Form with pre-filled data
    fillBlanksDiv.innerHTML = `
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <strong>Fill in the Blanks at ${blank.video_time.toFixed(2)}s</strong>
            <div>
                <button class="btn btn-sm btn-primary me-2"
                        onclick="updateFillBlanks('${fillBlanksId}', '${blank.id}')"
                        onmousedown="event.stopPropagation()">
                    <i class="fas fa-save"></i> Update
                </button>
                <button class="btn btn-sm delete-fill-blanks"
                        style="padding: 2px 6px; font-size: 12px; border-radius: 50%;"
                        onclick="deleteFillBlanksFromDB('${blank.id}', '${fillBlanksId}')">
                        <i class="fa-solid fa-trash fa-fade" style="color:#f70808;"></i>
                </button>
            </div>
        </div>
        <div class="mt-2">
            <label class="form-label">Instructions:</label>
            <input type="text"
                   value="${blank.instructions}"
                   class="form-control fill-blanks-instructions"
                   onmousedown="event.stopPropagation()">
        </div>

        <div class="mt-2">
            <label class="form-label">Sentence with blanks:</label>
            <textarea class="form-control fill-blanks-sentence"
                      rows="3"
                      onmousedown="event.stopPropagation()"
                      oninput="updateBlankPreview('${fillBlanksId}')">${blank.sentence}</textarea>
            <div class="blank-preview" id="preview-${fillBlanksId}"></div>
        </div>

        <div id="answers-${fillBlanksId}" class="answers-container mt-2" style="max-height:100px;overflow-y:auto;">
            <label class="form-label">Correct Answers:</label>
            ${answers.map((answer, index) => `
                <div class="answer-group mt-1">
                    <div class="d-flex gap-2">
                        <input type="text"
                               value="${answer}"
                               placeholder="Answer for blank ${index + 1}"
                               class="form-control fill-blanks-answer"
                               onmousedown="event.stopPropagation()">
                        ${answers.length > 1 ? `
                            <button class="btn btn-danger btn-sm"
                                    onclick="removeAnswerField('${fillBlanksId}', this)"
                                    onmousedown="event.stopPropagation()">
                                <i class="fa-solid fa-minus"></i>
                            </button>
                        ` : ''}
                    </div>
                </div>
            `).join('')}
        </div>
        <button class="btn btn-sm btn-primary mt-2"
                onclick="addAnswerField('${fillBlanksId}')"
                onmousedown="event.stopPropagation()">
            Add Another Blank
        </button>
        <div class="form-check mt-2">
            <input type="checkbox"
                   class="form-check-input skip-fill-blanks"
                   id="skip-${fillBlanksId}"
                   ${blank.is_skippable ? 'checked' : ''}
                   onmousedown="event.stopPropagation()">
            <label class="form-check-label" for="skip-${fillBlanksId}">Skippable</label>
        </div>
    `;

    // Append to quiz container
    document.getElementById("quizContainer").appendChild(fillBlanksDiv);

    // Set position if available
    if (blank.position_x !== undefined && blank.position_y !== undefined) {
        fillBlanksDiv.style.left = `${blank.position_x}px`;
        fillBlanksDiv.style.top = `${blank.position_y}px`;
    }

    // Make it draggable
    makeDraggable(fillBlanksDiv);

    // Update preview
    updateBlankPreview(fillBlanksId);

    return fillBlanksDiv;
}

// Function to update fill in the blanks in database
function updateFillBlanks(fillBlanksId, blankId) {

    const updateButton = document.querySelector(`button[onclick="updateFillBlanks('${fillBlanksId}', '${blankId}')"]`);

    // Change the button's inner HTML and disable it
    updateButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Updating...';
    updateButton.disabled = true;

    const VideoPath = currentVideoPath;

    const fillBlanksDiv = document.getElementById(fillBlanksId);
    const instructions = fillBlanksDiv.querySelector('.fill-blanks-instructions').value.trim();
    const sentence = fillBlanksDiv.querySelector('.fill-blanks-sentence').value.trim();
    const answerFields = fillBlanksDiv.querySelectorAll('.fill-blanks-answer');
    const isSkippable = fillBlanksDiv.querySelector('.skip-fill-blanks').checked ? 1 : 0;

    const position = fillBlanksDiv.getBoundingClientRect();
    const videoContainer = document.getElementById("quizContainer").getBoundingClientRect();
    const posX = position.left - videoContainer.left;
    const posY = position.top - videoContainer.top;

    // Validation checks
    if (!instructions || !sentence) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Please fill in all required fields.'
        });
        updateButton.innerHTML = '<i class="fas fa-save"></i> Update';
            updateButton.disabled = false;
        return;
    }

    const blankCount = (sentence.match(/_{1,}/g) || []).length;
    if (blankCount === 0) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Please add at least one blank (_) in your sentence.'
        });
        updateButton.innerHTML = '<i class="fas fa-save"></i> Update';
            updateButton.disabled = false;
        return;
    }

    const answers = Array.from(answerFields).map(field => field.value.trim());
    if (answers.some(answer => !answer)) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Please fill in all answer fields.'
        });
        updateButton.innerHTML = '<i class="fas fa-save"></i> Update';
        updateButton.disabled = false;
        return;
    }

    // Prepare update data
    const updateData = {
        id: blankId,
        instructions: instructions,
        sentence: sentence,
        answers: answers,
        position_x: posX,
        position_y: posY,
        is_skippable: isSkippable,
        _token: document.querySelector('meta[name="csrf-token"]').content
    };

    // Update in database
    $.ajax({
        url: '{{ route("update.fillintheblanks") }}',
        method: 'POST',
        data: updateData,
        success: function(response) {
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Updated!',
                    text: 'Fill in the blanks has been updated successfully.',
                    showConfirmButton: false,
                    timer: 1500
                });
                fillBlanksDiv.style.display = 'none';
                updateButton.innerHTML = '<i class="fas fa-save"></i> Update';
            updateButton.disabled = false;

            fetchFillBlanksData(currentVideoPath);

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message || 'Something went wrong. Please try again.'
                });
            updateButton.innerHTML = '<i class="fas fa-save"></i> Update';
            updateButton.disabled = false;
            }
        },
        error: function(xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: xhr.responseJSON?.message || 'Something went wrong. Please try again.'
            });
            updateButton.innerHTML = '<i class="fas fa-save"></i> Update';
            updateButton.disabled = false;
        }
    });
}

// Function to delete fill in the blanks from database
function deleteFillBlanksFromDB(blankId, fillBlanksId) {
    const VideoPath = currentVideoPath;
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '{{ route("delete.fillintheblanks") }}',
                method: 'POST',
                data: {
                    id: blankId,
                    _token: document.querySelector('meta[name="csrf-token"]').content
                },
                success: function(response) {
                    if (response.success) {
                        document.getElementById(fillBlanksId).remove();
                        Swal.fire(
                            'Deleted!',
                            'Fill in the blanks has been deleted.',
                            'success'
                        );

                        fetchFillBlanksData(currentVideoPath);
                    } else {
                        Swal.fire(
                            'Error!',
                            response.message || 'Something went wrong.',
                            'error'
                        );
                    }
                },
                error: function(xhr) {
                    Swal.fire(
                        'Error!',
                        xhr.responseJSON?.message || 'Something went wrong.',
                        'error'
                    );
                }
            });
        }
    });
}





//interactive codes ...........


function addintractivegames() {
    if (!videoPlayer.paused) {
        alert("Pause the video first to add interactive content.");
        return;
    }

    const timePosition = videoPlayer.currentTime;

    // Create interactive selection div
    const interactiveDiv = document.createElement("div");
    interactiveDiv.classList.add("interactive-box");
    interactiveDiv.style.position = "absolute";
    interactiveDiv.style.width = "500px";
    interactiveDiv.style.zIndex = "10000";
    interactiveDiv.style.background = "rgba(255,255,255,0.95)";
    interactiveDiv.style.padding = "15px";
    interactiveDiv.style.border = "2px solid #ffc107"; // Warning color to match the button
    interactiveDiv.style.borderRadius = "5px";
    interactiveDiv.style.cursor = "move";
    interactiveDiv.style.boxShadow = "0 4px 8px rgba(0,0,0,0.1)";

    let interactiveId = `interactive-${Date.now()}`;
    interactiveDiv.id = interactiveId;

    // Add custom styles
    const styleEl = document.createElement('style');
    styleEl.textContent = `
        .interactive-asset-item {
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .interactive-asset-item:hover {
            background-color: #f8f9fa;
            transform: translateY(-2px);
        }
        .interactive-asset-item.selected {
            background-color: #fff3cd;
            border-color: #ffc107;
            box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.25);
        }
        .interactive-asset-img {
            width: 45px;
            height: 45px;
            object-fit: cover;
            border-radius: 4px;
        }
    `;
    document.head.appendChild(styleEl);

    // Interactive selection Form
    interactiveDiv.innerHTML = `
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <strong>Add Interactive Content at ${timePosition.toFixed(2)}s</strong>
            <button class="btn btn-sm delete-interactive"
                    style="padding: 2px 6px; font-size: 12px; border-radius: 50%;"
                    onclick="deleteInteractive('${interactiveId}')">
                    <i class="fa-solid fa-trash fa-fade" style="color:#f70808;"></i>
            </button>
        </div>

        <div class="mt-3">
            <div class="mb-2">
                <label class="form-label"><i class="fa-solid fa-gamepad me-1"></i> Select an Interactive Asset:</label>
                <div class="input-group mb-2">
                    <input type="text" class="form-control form-control-sm"
                           id="search-${interactiveId}"
                           placeholder="Search assets..."
                           onmousedown="event.stopPropagation()"
                           oninput="filterAssets('${interactiveId}')">
                    <button class="btn btn-outline-secondary btn-sm" type="button"
                            onclick="filterAssets('${interactiveId}')">
                        <i class="fa-solid fa-search"></i>
                    </button>
                </div>
            </div>

            <div class="interactive-assets-list mb-3" style="max-height: 250px; overflow-y: auto;" id="assets-list-${interactiveId}">
                <div class="text-center p-3">
                    <div class="spinner-border text-warning" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2 text-muted">Loading available interactive assets...</p>
                </div>
            </div>
        </div>

        <input type="hidden" id="selected-asset-${interactiveId}" value="">
        <input type="hidden" id="video-id-${interactiveId}" value="${currentVideoPath || ''}">

        <div class="text-center">
            <button class="btn btn-warning"
                    onclick="saveInteractive(this, ${timePosition})"
                    onmousedown="event.stopPropagation()">
                <i class="fa-solid fa-save me-1"></i> Save Interactive
            </button>
        </div>
    `;

    // Append to quiz container
    document.getElementById("quizContainer").appendChild(interactiveDiv);

    // Make it draggable
    makeDraggable(interactiveDiv);

    // Load assets
    loadInteractiveAssets(interactiveId);
}

function deleteInteractive(interactiveId) {
    let element = document.getElementById(interactiveId);
    if (element) {
        element.remove();
    }
}

function loadInteractiveAssets(interactiveId) {
    // Fetch assets from the asset list in the modal
    const assetsList = document.getElementById(`assets-list-${interactiveId}`);
    const assetsTableBody = document.getElementById('assetsTableBody');

    if (!assetsTableBody) {
        assetsList.innerHTML = `
            <div class="alert alert-warning">
                <i class="fa-solid fa-exclamation-triangle me-2"></i>
                No asset data available. Please add assets first.
            </div>
        `;
        return;
    }

    // Get assets from the table
    const assetRows = assetsTableBody.querySelectorAll('tr');
    let assetsHtml = '';

    if (assetRows.length === 0 || (assetRows.length === 1 && assetRows[0].querySelector('td[colspan]'))) {
        assetsList.innerHTML = `
            <div class="alert alert-warning">
                <i class="fa-solid fa-exclamation-triangle me-2"></i>
                No assets available. Please add assets first.
            </div>
        `;
        return;
    }

    assetRows.forEach(row => {
        // Skip if row contains "No Data Available"
        if (row.querySelector('td[colspan]')) return;

        const assetId = row.querySelector('.setAssetBtn')?.dataset.assetId;
        if (!assetId) return;

        const imageElement = row.querySelector('img');
        const imageSrc = imageElement ? imageElement.src : `${baseUrl}/asset/images/user/download.jpg`;

        const nameElement = row.querySelector('h5');
        const assetName = nameElement ? nameElement.textContent.trim() : 'Unnamed Asset';

        const descElement = row.querySelector('p.text-muted');
        const assetDesc = descElement ? descElement.textContent.trim() : '';

        const typeCell = row.querySelectorAll('td')[2];
        const assetType = typeCell ? typeCell.textContent.trim() : 'Unknown';

        // Only include assets that are active
        const statusElement = row.querySelector('.badge');
        if (statusElement && statusElement.textContent.includes('Active')) {
            assetsHtml += `
                <div class="interactive-asset-item d-flex align-items-center"
                     data-asset-id="${assetId}"
                     onclick="selectAsset('${interactiveId}', '${assetId}', this)">
                    <div class="flex-shrink-0">
                        <img src="${imageSrc}" class="interactive-asset-img" alt="${assetName}">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-1">${assetName}</h6>
                        <p class="text-muted mb-0 small">${assetDesc}</p>
                        <span class="badge rounded-pill bg-light-info">${assetType}</span>
                    </div>
                </div>
            `;
        }
    });

    if (assetsHtml === '') {
        assetsList.innerHTML = `
            <div class="alert alert-warning">
                <i class="fa-solid fa-exclamation-triangle me-2"></i>
                No active assets found. Please activate some assets first.
            </div>
        `;
    } else {
        assetsList.innerHTML = assetsHtml;
    }
}

function filterAssets(interactiveId) {
    const searchInput = document.getElementById(`search-${interactiveId}`);
    const searchTerm = searchInput.value.toLowerCase();
    const assetItems = document.querySelectorAll(`#assets-list-${interactiveId} .interactive-asset-item`);

    assetItems.forEach(item => {
        const assetName = item.querySelector('h6').textContent.toLowerCase();
        const assetDesc = item.querySelector('p').textContent.toLowerCase();
        const assetType = item.querySelector('.badge').textContent.toLowerCase();

        if (assetName.includes(searchTerm) || assetDesc.includes(searchTerm) || assetType.includes(searchTerm)) {
            item.style.display = 'flex';
        } else {
            item.style.display = 'none';
        }
    });
}

function selectAsset(interactiveId, assetId, element) {
    // Remove selected class from all items
    const assetItems = document.querySelectorAll(`#assets-list-${interactiveId} .interactive-asset-item`);
    assetItems.forEach(item => {
        item.classList.remove('selected');
    });

    // Add selected class to clicked item
    element.classList.add('selected');

    // Store selected asset ID
    document.getElementById(`selected-asset-${interactiveId}`).value = assetId;
}

function saveInteractive(button, timePosition) {
    // Get the parent interactive div
    const interactiveDiv = button.closest('.interactive-box');
    const interactiveId = interactiveDiv.id;

    // Get the selected asset ID
    const selectedAssetId = document.getElementById(`selected-asset-${interactiveId}`).value;
    const videoId = document.getElementById(`video-id-${interactiveId}`).value || currentVideoPath;

    // Validation
    if (!selectedAssetId) {
        Swal.fire({
            icon: 'error',
            title: 'Selection Required',
            text: 'Please select an interactive asset first.'
        });
        return;
    }

    // Disable the save button and show loading state
    button.disabled = true;
    const originalButtonText = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';

    // Prepare data for submission
    const formData = {
        video_id: videoId,
        asset_id: selectedAssetId,
        video_time: timePosition,
        _token: document.querySelector('meta[name="csrf-token"]').content
    };

    // Send data to Laravel backend using Ajax
    $.ajax({
        url: '{{ route("interactive.setup") }}',
        method: 'POST',
        data: formData,
        success: function(response) {
            if (response.success) {
                // Show success message
                Swal.fire({
                    icon: 'success',
                    title: 'Saved!',
                    text: 'Interactive checkpoint has been saved successfully.',
                    showConfirmButton: false,
                    timer: 1500
                });

                // Remove the interactive div
                interactiveDiv.remove();

                // Refresh interactive checkpoints
                fetchInteractiveData(currentVideoPath);
            } else {
                // Show error message
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message || 'Something went wrong. Please try again.'
                });
            }
        },
        error: function(xhr) {
            // Handle error response
            let errorMessage = 'Something went wrong. Please try again.';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMessage = xhr.responseJSON.message;
            }

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: errorMessage
            });
        },
        complete: function() {
            // Re-enable the save button and restore original text
            button.disabled = false;
            button.innerHTML = originalButtonText;
        }
    });
}

// Function to fetch interactive checkpoints from the database
function fetchInteractiveData(videoPath) {
    $.ajax({
        url: '{{ route("get.video.interactives") }}',
        method: 'POST',
        data: {
            video_name: videoPath,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.interactives && response.interactives.length > 0) {
                setupInteractiveCheckpoints(response.interactives);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching interactive data:', error);
        }
    });
}

// Function to setup interactive checkpoints on the video timeline
function setupInteractiveCheckpoints(interactives) {
    const videoPlayer = document.getElementById('editVideoPlayer');

    // Create checkpoint container if it doesn't exist
    let interactiveContainer = document.getElementById('interactive-container');
    if (!interactiveContainer) {
        interactiveContainer = document.createElement('div');
        interactiveContainer.id = 'interactive-container';
        interactiveContainer.style.cssText = `
            position: absolute;
            bottom: 14px;
            left: 0;
            width: 94%;
            height: 16px;
            pointer-events: none;
            z-index: 1;
        `;
        videoPlayer.parentNode.insertBefore(interactiveContainer, videoPlayer);
    }

    // Clear existing interactive markers
    clearInteractiveCheckpoints();

    // Function to add interactive checkpoints
    const addInteractiveCheckpoints = () => {
        interactives.forEach(interactive => {
            addInteractiveMarker(interactive.checkpoint_time, videoPlayer.duration);
        });
    };

    // Handle metadata loading
    if (videoPlayer.readyState >= 1) {
        addInteractiveCheckpoints();
    } else {
        videoPlayer.addEventListener('loadedmetadata', addInteractiveCheckpoints);
    }

    // Sort interactives by time
    const sortedInteractives = interactives.sort((a, b) => a.checkpoint_time - b.checkpoint_time);

    // Reset tracking variables
    shownInteractives = new Set();
    lastPausedInteractiveId = null;

    // Setup event handlers
    setupInteractiveVideoHandlers();

    // Add timeupdate listener
    videoPlayer.addEventListener('timeupdate', () => {
        handleInteractiveDisplay(sortedInteractives, videoPlayer.currentTime);
    });
}

function addInteractiveMarker(checkpointTime, videoDuration) {
    const interactiveContainer = document.getElementById('interactive-container');

    const marker = document.createElement('div');
    marker.className = 'interactive-checkpoint';

    // Calculate position percentage
    const positionPercentage = (checkpointTime / videoDuration) * 100;

    marker.style.cssText = `
        position: absolute;
        width: 3px;
        height: 15px;
        background-color: #ffc107;  // Yellow color for interactive content
        bottom: 14px;
        left: calc(${positionPercentage}% - 1px);
        pointer-events: none;
        z-index: 2;
    `;

    interactiveContainer.appendChild(marker);
}

function clearInteractiveCheckpoints() {
    const interactiveContainer = document.getElementById('interactive-container');
    if (interactiveContainer) {
        interactiveContainer.innerHTML = '';
    }
}

// Keep track of shown interactives
let shownInteractives = new Set();
let lastPausedInteractiveId = null;

function handleInteractiveDisplay(sortedInteractives, currentTime) {
    const videoPlayer = document.getElementById('editVideoPlayer');

    // If video is playing, hide any previously shown interactive
    if (!videoPlayer.paused && lastPausedInteractiveId) {
        const lastInteractiveDiv = document.getElementById(`interactive-checkpoint-${lastPausedInteractiveId}`);
        if (lastInteractiveDiv) {
            lastInteractiveDiv.style.display = 'none';
        }
        lastPausedInteractiveId = null;
        return;
    }

    // Check each interactive checkpoint
    sortedInteractives.forEach(interactive => {
        const interactiveElementId = `interactive-checkpoint-${interactive.id}`;
        const existingInteractive = document.getElementById(interactiveElementId);

        // If we're within 0.15 seconds of the interactive checkpoint time
        if (Math.abs(currentTime - interactive.checkpoint_time) < 0.15) {
            // If the interactive exists but is hidden, show it
            if (existingInteractive) {
                if (existingInteractive.style.display === 'none') {
                    existingInteractive.style.display = 'block';
                    videoPlayer.pause();
                    lastPausedInteractiveId = interactive.id;
                }
            } else {
                // Create new interactive div
                createInteractiveCheckpointDiv(interactive);
                videoPlayer.pause();
                lastPausedInteractiveId = interactive.id;
            }
            shownInteractives.add(interactive.id);
        } else {
            // If we're not at interactive time and it's shown, hide it
            if (existingInteractive && lastPausedInteractiveId !== interactive.id) {
                existingInteractive.style.display = 'none';
            }
        }
    });
}

function setupInteractiveVideoHandlers() {
    const videoPlayer = document.getElementById('editVideoPlayer');

    // When video starts playing, hide current interactive
    videoPlayer.addEventListener('play', () => {
        if (lastPausedInteractiveId) {
            const interactiveDiv = document.getElementById(`interactive-checkpoint-${lastPausedInteractiveId}`);
            if (interactiveDiv) {
                interactiveDiv.style.display = 'none';
            }
            lastPausedInteractiveId = null;
        }
    });

    // When video is seeked, reset the shown interactives
    videoPlayer.addEventListener('seeked', () => {
        shownInteractives.clear();
        lastPausedInteractiveId = null;
        // Hide all interactive divs
        document.querySelectorAll('[id^="interactive-checkpoint-"]').forEach(div => {
            div.style.display = 'none';
        });
    });
}

function createInteractiveCheckpointDiv(interactive) {
    const videoPlayer = document.getElementById('editVideoPlayer');

    // Create interactive checkpoint div
    const interactiveDiv = document.createElement("div");
    interactiveDiv.classList.add("interactive-checkpoint-box");
    interactiveDiv.style.position = "absolute";
    interactiveDiv.style.width = "500px";
    interactiveDiv.style.zIndex = "10000";
    interactiveDiv.style.background = "rgba(255,255,255,0.95)";
    interactiveDiv.style.padding = "15px";
    interactiveDiv.style.border = "2px solid #ffc107";
    interactiveDiv.style.borderRadius = "5px";
    interactiveDiv.style.cursor = "move";
    interactiveDiv.style.boxShadow = "0 4px 8px rgba(0,0,0,0.1)";

    const interactiveElementId = `interactive-checkpoint-${interactive.id}`;
    interactiveDiv.id = interactiveElementId;

    // Fetch asset details
    $.ajax({
        url: '{{ route("get.asset.details") }}',
        method: 'POST',
        data: {
            asset_id: interactive.asset_id,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success && response.asset) {
                const asset = response.asset;
                console.log(asset.thumbnail);
                // Create HTML for the interactive checkpoint
                interactiveDiv.innerHTML = `
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <strong>Interactive Content at ${interactive.checkpoint_time.toFixed(2)}s</strong>
                        <div>
                            <button class="btn btn-sm btn-warning me-2"
                                    onclick="openInteractiveEditor('${interactive.id}', '${interactive.asset_id}')"
                                    onmousedown="event.stopPropagation()">
                                <i class="fas fa-edit"></i> Change
                            </button>
                            <button class="btn btn-sm delete-interactive"
                                    style="padding: 2px 6px; font-size: 12px; border-radius: 50%;"
                                    onclick="deleteInteractiveFromDB('${interactive.id}', '${interactiveElementId}')">
                                    <i class="fa-solid fa-trash fa-fade" style="color:#f70808;"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mt-3 d-flex">
                        <div class="flex-shrink-0">
                            <img src="${asset.thumbnail ? 'https://assets.zinggerr.com/storage/' + asset.thumbnail : `${baseUrl}/asset/images/user/download.jpg`}"
                                 alt="${asset.topic_name}"
                                 style="width: 80px; height: 80px; object-fit: cover; border-radius: 4px;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-1">${asset.topic_name}</h5>
                            <p class="mb-1">${asset.about}</p>
                            <span class="badge rounded-pill bg-light-info">${asset.assets_type}</span>
                            <div class="mt-3">
                                <button class="btn btn-sm btn-primary"
                                        onclick="launchInteractive('${interactive.asset_id}')"
                                        onmousedown="event.stopPropagation()">
                                    <i class="fa-solid fa-gamepad me-1"></i> Launch Interactive
                                </button>
                            </div>
                        </div>
                    </div>
                `;

                // Set position if available
                if (interactive.position_x !== undefined && interactive.position_y !== undefined) {
                    interactiveDiv.style.left = `${interactive.position_x}px`;
                    interactiveDiv.style.top = `${interactive.position_y}px`;
                }

                // Make it draggable
                makeDraggable(interactiveDiv);

            } else {
                interactiveDiv.innerHTML = `
                    <div class="alert alert-danger">
                        <i class="fa-solid fa-exclamation-triangle me-2"></i>
                        Asset not found or has been deleted.
                        <div class="mt-2">
                            <button class="btn btn-sm btn-danger"
                                    onclick="deleteInteractiveFromDB('${interactive.id}', '${interactiveElementId}')">
                                Remove Checkpoint
                            </button>
                        </div>
                    </div>
                `;
            }
        },
        error: function() {
            interactiveDiv.innerHTML = `
                <div class="alert alert-danger">
                    <i class="fa-solid fa-exclamation-triangle me-2"></i>
                    Failed to load asset details.
                    <div class="mt-2">
                        <button class="btn btn-sm btn-danger"
                                onclick="deleteInteractiveFromDB('${interactive.id}', '${interactiveElementId}')">
                            Remove Checkpoint
                        </button>
                    </div>
                </div>
            `;
        }
    });

    // Append to quiz container
    document.getElementById("quizContainer").appendChild(interactiveDiv);

    return interactiveDiv;
}

function openInteractiveEditor(interactiveId, currentAssetId) {
    // Create a new interactive selection form
    const interactiveEditorDiv = document.createElement("div");
    interactiveEditorDiv.classList.add("interactive-editor-box");
    interactiveEditorDiv.style.position = "absolute";
    interactiveEditorDiv.style.width = "500px";
    interactiveEditorDiv.style.zIndex = "10001"; // Higher than the checkpoint div
    interactiveEditorDiv.style.background = "rgba(255,255,255,0.98)";
    interactiveEditorDiv.style.padding = "15px";
    interactiveEditorDiv.style.border = "2px solid #0dcaf0"; // Info color
    interactiveEditorDiv.style.borderRadius = "5px";
    interactiveEditorDiv.style.cursor = "move";
    interactiveEditorDiv.style.boxShadow = "0 4px 12px rgba(0,0,0,0.15)";

    const editorId = `interactive-editor-${Date.now()}`;
    interactiveEditorDiv.id = editorId;

    interactiveEditorDiv.innerHTML = `
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <strong><i class="fa-solid fa-edit me-1"></i> Change Interactive Asset</strong>
            <button class="btn btn-sm btn-close"
                    onclick="document.getElementById('${editorId}').remove()">
            </button>
        </div>

        <div class="mt-3">
            <p class="text-muted">Select a new interactive asset to replace the current one.</p>

            <div class="input-group mb-2">
                <input type="text" class="form-control form-control-sm"
                       id="search-${editorId}"
                       placeholder="Search assets..."
                       onmousedown="event.stopPropagation()"
                       oninput="filterEditorAssets('${editorId}')">
                <button class="btn btn-outline-secondary btn-sm" type="button"
                        onclick="filterEditorAssets('${editorId}')">
                    <i class="fa-solid fa-search"></i>
                </button>
            </div>

            <div class="interactive-assets-list mb-3" style="max-height: 250px; overflow-y: auto;" id="assets-list-${editorId}">
                <div class="text-center p-3">
                    <div class="spinner-border text-info" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2 text-muted">Loading available interactive assets...</p>
                </div>
            </div>
        </div>

        <input type="hidden" id="selected-asset-${editorId}" value="${currentAssetId}">

        <div class="d-flex justify-content-between">
            <button class="btn btn-secondary"
                    onclick="document.getElementById('${editorId}').remove()"
                    onmousedown="event.stopPropagation()">
                Cancel
            </button>
            <button class="btn btn-info"
                    onclick="updateInteractive('${interactiveId}', '${editorId}')"
                    onmousedown="event.stopPropagation()">
                <i class="fa-solid fa-save me-1"></i> Update Interactive
            </button>
        </div>
    `;

    // Append to quiz container
    document.getElementById("quizContainer").appendChild(interactiveEditorDiv);

    // Make it draggable
    makeDraggable(interactiveEditorDiv);

    // Load assets
    loadEditorAssets(editorId, currentAssetId);
}

// function loadEditorAssets(editorId, currentAssetId) {
//     // Similar to loadInteractiveAssets but marks the currently selected asset
//     const assetsList = document.getElementById(`assets-list-${editorId}`);
//     const assetsTableBody = document.getElementById('assetsTableBody');

//     if (!assetsTableBody) {
//         assetsList.innerHTML = `<div class="alert alert-warning">No asset data available.</div>`;
//         return;
//     }

//     const assetRows = assetsTableBody.querySelectorAll('tr');
//     let assetsHtml = '';

//     if (assetRows.length === 0 || (assetRows.length === 1 && assetRows[0].querySelector('td[colspan]'))) {
//         assetsList.innerHTML = `<div class="alert alert-warning">No assets available.</div>`;
//         return;
//     }

//     assetRows.forEach(row => {
//         if (row.querySelector('td[colspan]')) return;

//         const assetId = row.querySelector('.setAssetBtn')?.dataset.assetId;
//         if (!assetId) return;

//         const imageElement = row.querySelector('img');
//         const imageSrc = imageElement ? imageElement.src : `${baseUrl}/asset/images/user/download.jpg`;

//         const nameElement = row.querySelector('h5');
//         const assetName = nameElement ? nameElement.textContent.trim() : 'Unnamed Asset';

//         const descElement = row.querySelector('p.text-muted');
//         const assetDesc = descElement ? descElement.textContent.trim() : '';

//         const typeCell = row.querySelectorAll('td')[2];
//         const assetType = typeCell ? typeCell.textContent.trim() : 'Unknown';

//         const statusElement = row.querySelector('.badge');
//         if (statusElement && statusElement.textContent.includes('Active')) {
//             // Check if this is the currently selected asset
//             const isSelected = assetId === currentAssetId;

            // assetsHtml += `
            //     <div class="interactive-asset-item d-flex align-items-center ${isSelected ? 'selected' : ''}"
            //          data-asset-id="${assetId}"
            //          onclick="selectEditorAsset('${editorId}', '${assetId}', this)">
            //         <div class="flex-shrink-0">
            //             <img src="${imageSrc}" class="interactive-asset-img" alt="${assetName}">
            //         </div>
            //         <div class="flex-grow-1 ms-3">
            //             <h6 class="mb-1">${assetName} ${isSelected ? '<span class="badge bg-info ms-2">Current</span>' : ''}</h6>



    </script>


@include('partials.footer')
@endsection
