@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet">

@section('pageTitle', 'User Social Profile')

@section('content')
@include('partials.sidebar')
@include('partials.header')

<style>

.social-profile .img-profile-avtar {
    border-radius: 8px;
    width: 140px;
    margin-top: -35%;
}
.follower-card .friend-btn:not(:hover) {
    border-color: var(--bs-border-color);
    background: var(--bs-card-bg);
}

</style>
<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Social Profile View</h5>
                        </div>
                    </div>

                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/app">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Social Profile</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-sm-12">
                <div class="card social-profile">
                    <div class="card-body p-3"><img src="{{ asset('asset/images/user/img-profile-cover.png') }}" alt=""
                            class="w-100 rounded"></div>
                    <div class="card-body pt-2">
                        <div class="row">
                            <div class="col-md-3 text-md-end"><img class="img-fluid wid-140 img-profile-avtar"
                                    src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image"></div>
                            <div class="col-md-9">
                                <div class="row justify-content-between align-items-end">
                                    <div class="col-md-auto soc-profile-data">
                                        <h5 class="mb-0">John Doe</h5>
                                        <p class="mb-0">Android Developer</p>
                                    </div>
                                    <div class="col-md-auto"><button class="btn btn-outline-primary">Message</button>
                                        <button class="btn btn-primary"><i class="ti ti-user-plus me-1"></i> Send
                                            Request</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body py-0">
                        <ul class="nav nav-tabs profile-tabs justify-content-center justify-content-md-end" id="myTab"
                            role="tablist">
                            <li class="nav-item" role="presentation"><a class="nav-link active" id="profile-tab"
                                    data-bs-toggle="tab" href="#profile" role="tab" aria-selected="true"><i
                                        class="ti ti-home me-2"></i> Profile</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" id="followers-tab"
                                    data-bs-toggle="tab" href="#followers" role="tab" aria-selected="false"
                                    tabindex="-1"><i class="ti ti-users me-2"></i> Followers</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" id="friends-tab"
                                    data-bs-toggle="tab" href="#friends" role="tab" aria-controls="friends"
                                    aria-selected="false" tabindex="-1"><i class="ti ti-user-check me-2"></i>
                                    Friends</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" id="gallery-tab"
                                    data-bs-toggle="tab" href="#gallery" role="tab" aria-controls="gallery"
                                    aria-selected="false" tabindex="-1"><i class="ti ti-photo me-2"></i> Gallery</a>
                            </li>
                            <li class="nav-item" role="presentation"><a class="nav-link" id="request-tab"
                                    data-bs-toggle="tab" href="#request" role="tab" aria-controls="request"
                                    aria-selected="false" tabindex="-1"><i class="ti ti-user-plus me-2"></i> Friend
                                    Request</a></li>
                        </ul>
                    </div>
                </div><!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="row">
                            <div class="col-md-4 col-xxl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avtar avtar-lg bg-light-primary"><i
                                                        class="material-icons-two-tone text-primary">people_alt</i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 mx-3">
                                                <h3 class="mb-0 text-primary">239k</h3>
                                                <p class="mb-0">Friends</p>
                                            </div>
                                            <div class="flex-shrink-0"><a href="#"><i
                                                        class="material-icons-two-tone">navigate_next</i></a></div>
                                        </div>
                                        <hr class="my-3">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avtar avtar-lg bg-light-secondary"><i
                                                        class="material-icons-two-tone text-secondary">recent_actors</i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 mx-3">
                                                <h3 class="mb-0 text-secondary">234k</h3>
                                                <p class="mb-0">Followers</p>
                                            </div>
                                            <div class="flex-shrink-0"><a href="#"><i
                                                        class="material-icons-two-tone">navigate_next</i></a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h4>About</h4>
                                        <p class="mb-0">It is a long established fact that a reader will be distracted
                                            by the readable content of a page when looking at its layout.</p>
                                        <hr class="my-3">
                                        <ul class="list-unstyled mb-0">
                                            <li><a class="d-flex align-items-center text-muted text-hover-primary mb-3"
                                                    href="https://codedthemes.com/" target="_blank"><i
                                                        class="material-icons-two-tone me-2 text-secondary">public</i>
                                                    <span
                                                        class="text-truncate w-100">https://codedthemes.com/</span></a>
                                            </li>
                                            <li><a class="d-flex align-items-center text-muted text-hover-primary mb-3"
                                                    href="https://www.instagram.com/codedthemes" target="_blank"><i
                                                        class="ti ti-brand-instagram f-24 me-2 text-danger"></i> <span
                                                        class="text-truncate w-100">https://www.instagram.com/codedthemes</span></a>
                                            </li>
                                            <li><a class="d-flex align-items-center text-muted text-hover-primary mb-3"
                                                    href="https://www.facebook.com/codedthemes" target="_blank"><i
                                                        class="material-icons-two-tone me-2 text-primary">facebook</i>
                                                    <span
                                                        class="text-truncate w-100">https://www.facebook.com/codedthemes</span></a>
                                            </li>
                                            <li><a class="d-flex align-items-center text-muted text-hover-primary mb-3"
                                                    href="https://in.linkedin.com/company/codedthemes"
                                                    target="_blank"><i
                                                        class="ti ti-brand-linkedin f-24 me-2 text-dark"></i> <span
                                                        class="text-truncate w-100">https://in.linkedin.com/company/codedthemes</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 col-xxl-9">
                                <div class="card">
                                    <div class="card-body"><textarea class="form-control" rows="3"></textarea>
                                        <div class="row mt-3">
                                            <div class="col"><button class="btn btn-link-secondary"><i
                                                        class="material-icons-two-tone me-2">attachment</i>
                                                    Gallery</button></div>
                                            <div class="col text-end"><button class="btn btn-secondary"><i
                                                        class="material-icons-two-tone text-white me-2">layers</i>
                                                    Post</button></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                    src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image"></div>
                                            <div class="flex-grow-1 mx-3">
                                                <div class="d-flex align-items-center">
                                                    <h5 class="mb-0 me-3">John Doe</h5><span
                                                        class="text-body text-opacity-50 d-flex align-items-center"><i
                                                            class="fas fa-circle f-8 me-2"></i> now</span>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="dropdown"><a
                                                        class="avtar avtar-xs btn-light-secondary dropdown-toggle arrow-none"
                                                        href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"><i
                                                            class="material-icons-two-tone f-16">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-end"><a
                                                            class="dropdown-item" href="#">Edit</a> <a
                                                            class="dropdown-item" href="#">Delete</a></div>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-header">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                            sed do eiusmod tempor incididunt</p>
                                        <p class="text-header">labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                            consequat Duis aute irure dolor.</p>
                                        <div class="row">
                                            <div class="col"><a href="#" class="btn btn-link-dark"><i
                                                        class="material-icons-two-tone me-1">thumb_up_alt</i> 0 Likes
                                                </a><a href="#" class="btn btn-link-secondary"><i
                                                        class="material-icons-two-tone me-1">mode_comment</i> 0
                                                    Comments</a></div>
                                            <div class="col-auto text-end"><a href="#" class="btn btn-link-dark"><i
                                                        class="material-icons-two-tone">share</i></a></div>
                                        </div>
                                        <div class="d-flex align-items-center mt-3">
                                            <div class="flex-shrink-0"><img
                                                    class="img-radius d-none d-sm-inline-flex me-3 img-fluid wid-35"
                                                    src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                            </div>
                                            <div class="flex-grow-1 me-3">
                                                <div class="form-floating mb-0"><input type="email" class="form-control"
                                                        id="floatingaddcomment" placeholder="Write a comment..."> <label
                                                        for="floatingaddcomment">Write a comment...</label></div>
                                            </div>
                                            <div class="flex-shrink-0"><button
                                                    class="btn btn-secondary btn-lg">Comment</button></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                    src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image"></div>
                                            <div class="flex-grow-1 mx-3">
                                                <div class="d-flex align-items-center">
                                                    <h5 class="mb-0 me-3">John Doe</h5><span
                                                        class="text-body text-opacity-50 d-flex align-items-center"><i
                                                            class="fas fa-circle f-8 me-2"></i> now</span>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="dropdown"><a
                                                        class="avtar avtar-xs btn-light-secondary dropdown-toggle arrow-none"
                                                        href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"><i
                                                            class="material-icons-two-tone f-16">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-end"><a
                                                            class="dropdown-item" href="#">Edit</a> <a
                                                            class="dropdown-item" href="#">Delete</a></div>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-header">labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                            consequat Duis aute irure dolor.</p><img class="rounded img-fluid w-100"
                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                        <div class="row my-3">
                                            <div class="col"><a href="#" class="btn btn-link-dark"><i
                                                        class="material-icons-two-tone me-1">thumb_up_alt</i> 102 Likes
                                                </a><a href="#" class="btn btn-link-secondary"><i
                                                        class="material-icons-two-tone me-1">mode_comment</i> 2
                                                    Comments</a></div>
                                            <div class="col-auto text-end"><a href="#" class="btn btn-link-dark"><i
                                                        class="material-icons-two-tone">share</i></a></div>
                                        </div>
                                        <div class="bg-light rounded p-2 mb-3">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="flex-shrink-0"><img class="img-radius img-fluid wid-30"
                                                        src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image"></div>
                                                <div class="flex-grow-1 mx-3">
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="mb-0 me-3">Barney Thea</h5><span
                                                            class="text-body text-opacity-50 d-flex align-items-center"><i
                                                                class="fas fa-circle f-8 me-2"></i> 8 min ago</span>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div class="dropdown"><a
                                                            class="avtar avtar-xs btn-light-secondary dropdown-toggle arrow-none"
                                                            href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"><i
                                                                class="material-icons-two-tone f-16">more_vert</i></a>
                                                        <div class="dropdown-menu dropdown-menu-end"><a
                                                                class="dropdown-item" href="#">Edit</a> <a
                                                                class="dropdown-item" href="#">Delete</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text-header">It is a long established fact that a reader will be
                                                distracted by the readable content of a page when looking at its layout.
                                            </p><a href="#" class="btn btn-link-dark"><i
                                                    class="material-icons-two-tone me-1">thumb_up_alt</i> 55 Likes
                                            </a><a href="#" class="btn btn-link-primary"><i
                                                    class="material-icons-two-tone me-1">reply</i> 2 reply</a>
                                        </div>
                                        <div class="bg-light rounded p-2 mb-3">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="flex-shrink-0"><img class="img-radius img-fluid wid-30"
                                                        src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image"></div>
                                                <div class="flex-grow-1 mx-3">
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="mb-0 me-3">Barney Thea</h5><span
                                                            class="text-body text-opacity-50 d-flex align-items-center"><i
                                                                class="fas fa-circle f-8 me-2"></i> 8 min ago</span>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div class="dropdown"><a
                                                            class="avtar avtar-xs btn-light-secondary dropdown-toggle arrow-none"
                                                            href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"><i
                                                                class="material-icons-two-tone f-16">more_vert</i></a>
                                                        <div class="dropdown-menu dropdown-menu-end"><a
                                                                class="dropdown-item" href="#">Edit</a> <a
                                                                class="dropdown-item" href="#">Delete</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text-header">It is a long established fact that a reader will be
                                                distracted by the readable content of a page when looking at its layout.
                                            </p><a href="#" class="btn btn-link-dark"><i
                                                    class="material-icons-two-tone me-1">thumb_up_alt</i> 55 Likes
                                            </a><a href="#" class="btn btn-link-primary"><i
                                                    class="material-icons-two-tone me-1">reply</i> 2 reply</a>
                                        </div>
                                        <div class="bg-light rounded p-2 ms-5">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="flex-shrink-0"><img class="img-radius img-fluid wid-30"
                                                        src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image"></div>
                                                <div class="flex-grow-1 mx-3">
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="mb-0 me-3">Barney Thea</h5><span
                                                            class="text-body text-opacity-50 d-flex align-items-center"><i
                                                                class="fas fa-circle f-8 me-2"></i> 8 min ago</span>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div class="dropdown"><a
                                                            class="avtar avtar-xs btn-light-secondary dropdown-toggle arrow-none"
                                                            href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"><i
                                                                class="material-icons-two-tone f-16">more_vert</i></a>
                                                        <div class="dropdown-menu dropdown-menu-end"><a
                                                                class="dropdown-item" href="#">Edit</a> <a
                                                                class="dropdown-item" href="#">Delete</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text-header">It is a long established fact that a reader will be
                                                distracted by the readable content of a page when looking at its layout.
                                            </p><a href="#" class="btn btn-link-dark"><i
                                                    class="material-icons-two-tone me-1">thumb_up_alt</i> 55 Likes
                                            </a><a href="#" class="btn btn-link-primary"><i
                                                    class="material-icons-two-tone me-1">reply</i> 2 reply</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                    src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image"></div>
                                            <div class="flex-grow-1 mx-3">
                                                <div class="d-flex align-items-center">
                                                    <h5 class="mb-0 me-3">John Doe</h5><span
                                                        class="text-body text-opacity-50 d-flex align-items-center"><i
                                                            class="fas fa-circle f-8 me-2"></i> now</span>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="dropdown"><a
                                                        class="avtar avtar-xs btn-light-secondary dropdown-toggle arrow-none"
                                                        href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"><i
                                                            class="material-icons-two-tone f-16">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-end"><a
                                                            class="dropdown-item" href="#">Edit</a> <a
                                                            class="dropdown-item" href="#">Delete</a></div>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-header">labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                            consequat Duis aute irure dolor.</p>
                                        <div class="row g-2">
                                            <div class="col-sm-6">
                                                <div class="position-relative overflow-hidden rounded"><img
                                                        class="img-fluid w-100"
                                                        src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    <div
                                                        class="position-absolute top-0 start-0 w-100 p-3 img-post-title">
                                                        <span class="m-0 h4 text-white">Image Title</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="position-relative overflow-hidden rounded"><img
                                                        class="img-fluid w-100"
                                                        src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    <div
                                                        class="position-absolute top-0 start-0 w-100 p-3 img-post-title">
                                                        <span class="m-0 h4 text-white">Painter</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row my-3">
                                            <div class="col"><a href="#" class="btn btn-link-dark"><i
                                                        class="material-icons-two-tone me-1">thumb_up_alt</i> 102 Likes
                                                </a><a href="#" class="btn btn-link-secondary"><i
                                                        class="material-icons-two-tone me-1">mode_comment</i> 2
                                                    Comments</a></div>
                                            <div class="col-auto text-end"><a href="#" class="btn btn-link-dark"><i
                                                        class="material-icons-two-tone">share</i></a></div>
                                        </div>
                                        <div class="bg-light rounded p-2 mb-3">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="flex-shrink-0"><img class="img-radius img-fluid wid-30"
                                                        src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image"></div>
                                                <div class="flex-grow-1 mx-3">
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="mb-0 me-3">Barney Thea</h5><span
                                                            class="text-body text-opacity-50 d-flex align-items-center"><i
                                                                class="fas fa-circle f-8 me-2"></i> 8 min ago</span>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div class="dropdown"><a
                                                            class="avtar avtar-xs btn-light-secondary dropdown-toggle arrow-none"
                                                            href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"><i
                                                                class="material-icons-two-tone f-16">more_vert</i></a>
                                                        <div class="dropdown-menu dropdown-menu-end"><a
                                                                class="dropdown-item" href="#">Edit</a> <a
                                                                class="dropdown-item" href="#">Delete</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text-header">It is a long established fact that a reader will be
                                                distracted by the readable content of a page when looking at its layout.
                                            </p><a href="#" class="btn btn-link-dark"><i
                                                    class="material-icons-two-tone me-1">thumb_up_alt</i> 55 Likes
                                            </a><a href="#" class="btn btn-link-primary"><i
                                                    class="material-icons-two-tone me-1">reply</i> 2 reply</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                    src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image"></div>
                                            <div class="flex-grow-1 mx-3">
                                                <div class="d-flex align-items-center">
                                                    <h5 class="mb-0 me-3">John Doe</h5><span
                                                        class="text-body text-opacity-50 d-flex align-items-center"><i
                                                            class="fas fa-circle f-8 me-2"></i> now</span>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="dropdown"><a
                                                        class="avtar avtar-xs btn-light-secondary dropdown-toggle arrow-none"
                                                        href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"><i
                                                            class="material-icons-two-tone f-16">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-end"><a
                                                            class="dropdown-item" href="#">Edit</a> <a
                                                            class="dropdown-item" href="#">Delete</a></div>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-header">labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                            consequat Duis aute irure dolor.</p>
                                        <div class="ratio ratio-21x9 rounded overflow-hidden"><iframe
                                                src="https://www.youtube.com/embed/f3NWvUV8MD8" title="YouTube video"
                                                allowfullscreen=""></iframe></div>
                                        <div class="row my-3">
                                            <div class="col"><a href="#" class="btn btn-link-dark"><i
                                                        class="material-icons-two-tone me-1">thumb_up_alt</i> 102 Likes
                                                </a><a href="#" class="btn btn-link-secondary"><i
                                                        class="material-icons-two-tone me-1">mode_comment</i> 2
                                                    Comments</a></div>
                                            <div class="col-auto text-end"><a href="#" class="btn btn-link-dark"><i
                                                        class="material-icons-two-tone">share</i></a></div>
                                        </div>
                                        <div class="d-flex align-items-center mt-3">
                                            <div class="flex-shrink-0"><img
                                                    class="img-radius d-none d-sm-inline-flex me-3 img-fluid wid-35"
                                                    src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                            </div>
                                            <div class="flex-grow-1 me-3">
                                                <div class="form-floating mb-0"><input type="email" class="form-control"
                                                        id="floatingaddcomment1" placeholder="Write a comment...">
                                                    <label for="floatingaddcomment1">Write a comment...</label>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0"><button
                                                    class="btn btn-secondary btn-lg">Comment</button></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="followers" role="tabpanel" aria-labelledby="followers-tab">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center g-2">
                                    <div class="col">
                                        <h5>Followers</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="form-search"><i class="ti ti-search"></i> <input type="search"
                                                class="form-control" placeholder="Search Followers"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Barney</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            Handburgh
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-grid"><button class="btn btn-outline-primary"><i
                                                            class="ti ti-users"></i> Followed</button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Thea</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            New jana
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-grid"><button class="btn btn-primary"><i
                                                            class="ti ti-user-plus"></i> Follow Back</button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Barney</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            Handburgh
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-grid"><button class="btn btn-outline-primary"><i
                                                            class="ti ti-users"></i> Followed</button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Barney</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            Handburgh
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-grid"><button class="btn btn-outline-primary"><i
                                                            class="ti ti-users"></i> Followed</button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Thea</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            New jana
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-grid"><button class="btn btn-outline-primary"><i
                                                            class="ti ti-user-plus"></i> Follow Back</button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Barney</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            Handburgh
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-grid"><button class="btn btn-outline-primary"><i
                                                            class="ti ti-users"></i> Followed</button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Thea</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            New jana
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-grid"><button class="btn btn-outline-primary"><i
                                                            class="ti ti-user-plus"></i> Follow Back</button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Barney</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            Handburgh
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-grid"><button class="btn btn-outline-primary"><i
                                                            class="ti ti-users"></i> Followed</button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Barney</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            Handburgh
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-grid"><button class="btn btn-outline-primary"><i
                                                            class="ti ti-users"></i> Followed</button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Thea</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            New jana
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-grid"><button class="btn btn-primary"><i
                                                            class="ti ti-user-plus"></i> Follow Back</button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Barney</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            Handburgh
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-grid"><button class="btn btn-outline-primary"><i
                                                            class="ti ti-users"></i> Followed</button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Barney</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            Handburgh
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-grid"><button class="btn btn-outline-primary"><i
                                                            class="ti ti-users"></i> Followed</button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Thea</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            New jana
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-grid"><button class="btn btn-outline-primary"><i
                                                            class="ti ti-user-plus"></i> Follow Back</button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Barney</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            Handburgh
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-grid"><button class="btn btn-outline-primary"><i
                                                            class="ti ti-users"></i> Followed</button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Thea</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            New jana
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-grid"><button class="btn btn-outline-primary"><i
                                                            class="ti ti-user-plus"></i> Follow Back</button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Barney</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            Handburgh
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-grid"><button class="btn btn-outline-primary"><i
                                                            class="ti ti-users"></i> Followed</button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Barney</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            Handburgh
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-grid"><button class="btn btn-outline-primary"><i
                                                            class="ti ti-users"></i> Followed</button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Thea</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            New jana
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-grid"><button class="btn btn-primary"><i
                                                            class="ti ti-user-plus"></i> Follow Back</button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Barney</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            Handburgh
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-grid"><button class="btn btn-outline-primary"><i
                                                            class="ti ti-users"></i> Followed</button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Barney</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            Handburgh
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-grid"><button class="btn btn-outline-primary"><i
                                                            class="ti ti-users"></i> Followed</button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Thea</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            New jana
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-grid"><button class="btn btn-outline-primary"><i
                                                            class="ti ti-user-plus"></i> Follow Back</button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Barney</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            Handburgh
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-grid"><button class="btn btn-outline-primary"><i
                                                            class="ti ti-users"></i> Followed</button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Thea</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            New jana
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-grid"><button class="btn btn-outline-primary"><i
                                                            class="ti ti-user-plus"></i> Follow Back</button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Barney</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            Handburgh
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-grid"><button class="btn btn-outline-primary"><i
                                                            class="ti ti-users"></i> Followed</button></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="friends" role="tabpanel" aria-labelledby="friends-tab">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center g-2">
                                    <div class="col">
                                        <h5>Friends <span class="text-muted">(463)</span></h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="form-search"><i class="ti ti-search"></i> <input type="search"
                                                class="form-control" placeholder="Search Followers"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Barney</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            Handburgh
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-secondary"><i
                                                                    class="ti ti-video-plus"></i></button></div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary"><i
                                                                    class="ti ti-message-dots"></i></button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Thea</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            New jana
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-secondary"><i
                                                                    class="ti ti-video-plus"></i></button></div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary"><i
                                                                    class="ti ti-message-dots"></i></button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Guiseppe</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            Jenkinsstad
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-secondary"><i
                                                                    class="ti ti-video-plus"></i></button></div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary"><i
                                                                    class="ti ti-message-dots"></i></button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Henderson</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            South Antonina
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-secondary"><i
                                                                    class="ti ti-video-plus"></i></button></div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary"><i
                                                                    class="ti ti-message-dots"></i></button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Wilber</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            Twilahsven
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-secondary"><i
                                                                    class="ti ti-video-plus"></i></button></div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary"><i
                                                                    class="ti ti-message-dots"></i></button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Barney</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            Handburgh
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-secondary"><i
                                                                    class="ti ti-video-plus"></i></button></div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary"><i
                                                                    class="ti ti-message-dots"></i></button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Thea</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            New jana
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-secondary"><i
                                                                    class="ti ti-video-plus"></i></button></div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary"><i
                                                                    class="ti ti-message-dots"></i></button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Guiseppe</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            Jenkinsstad
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-secondary"><i
                                                                    class="ti ti-video-plus"></i></button></div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary"><i
                                                                    class="ti ti-message-dots"></i></button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Henderson</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            South Antonina
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-secondary"><i
                                                                    class="ti ti-video-plus"></i></button></div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary"><i
                                                                    class="ti ti-message-dots"></i></button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Wilber</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            Twilahsven
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-secondary"><i
                                                                    class="ti ti-video-plus"></i></button></div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary"><i
                                                                    class="ti ti-message-dots"></i></button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Barney</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            Handburgh
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-secondary"><i
                                                                    class="ti ti-video-plus"></i></button></div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary"><i
                                                                    class="ti ti-message-dots"></i></button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Thea</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            New jana
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-secondary"><i
                                                                    class="ti ti-video-plus"></i></button></div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary"><i
                                                                    class="ti ti-message-dots"></i></button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Guiseppe</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            Jenkinsstad
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-secondary"><i
                                                                    class="ti ti-video-plus"></i></button></div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary"><i
                                                                    class="ti ti-message-dots"></i></button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Henderson</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            South Antonina
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-secondary"><i
                                                                    class="ti ti-video-plus"></i></button></div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary"><i
                                                                    class="ti ti-message-dots"></i></button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Wilber</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            Twilahsven
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-secondary"><i
                                                                    class="ti ti-video-plus"></i></button></div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary"><i
                                                                    class="ti ti-message-dots"></i></button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Barney</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            Handburgh
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-secondary"><i
                                                                    class="ti ti-video-plus"></i></button></div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary"><i
                                                                    class="ti ti-message-dots"></i></button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Thea</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            New jana
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-secondary"><i
                                                                    class="ti ti-video-plus"></i></button></div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary"><i
                                                                    class="ti ti-message-dots"></i></button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Guiseppe</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            Jenkinsstad
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-secondary"><i
                                                                    class="ti ti-video-plus"></i></button></div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary"><i
                                                                    class="ti ti-message-dots"></i></button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Henderson</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            South Antonina
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-secondary"><i
                                                                    class="ti ti-video-plus"></i></button></div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary"><i
                                                                    class="ti ti-message-dots"></i></button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Wilber</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            Twilahsven
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-secondary"><i
                                                                    class="ti ti-video-plus"></i></button></div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary"><i
                                                                    class="ti ti-message-dots"></i></button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Barney</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            Handburgh
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-secondary"><i
                                                                    class="ti ti-video-plus"></i></button></div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary"><i
                                                                    class="ti ti-message-dots"></i></button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Thea</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            New jana
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-secondary"><i
                                                                    class="ti ti-video-plus"></i></button></div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary"><i
                                                                    class="ti ti-message-dots"></i></button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Guiseppe</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            Jenkinsstad
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-secondary"><i
                                                                    class="ti ti-video-plus"></i></button></div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary"><i
                                                                    class="ti ti-message-dots"></i></button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Henderson</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            South Antonina
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-secondary"><i
                                                                    class="ti ti-video-plus"></i></button></div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary"><i
                                                                    class="ti ti-message-dots"></i></button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Wilber</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">pin_drop</i>
                                                            Twilahsven
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Removed</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-secondary"><i
                                                                    class="ti ti-video-plus"></i></button></div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary"><i
                                                                    class="ti ti-message-dots"></i></button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="gallery" role="tabpanel" aria-labelledby="gallery-tab">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center g-2">
                                    <div class="col">
                                        <h5>Gallery</h5>
                                    </div>
                                    <div class="col-auto"><button class="btn btn-secondary">Add Photos</button></div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card gallery-card"><img
                                                src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="images"
                                                class="img-card-top img-fluid">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-grow-1 me-2">
                                                        <h5 class="mb-1 text-truncate">1080p_table_denar.pdf</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">event</i> Tue
                                                            Aug 24 2021
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle avtar avtar-xs bg-light-secondary text-secondary arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#">Remove Tag</a> <a
                                                                    class="dropdown-item" href="#">Download</a> <a
                                                                    class="dropdown-item" href="#">Make Profile
                                                                    Picture</a> <a class="dropdown-item" href="#">Make
                                                                    Cover Photo</a> <a class="dropdown-item"
                                                                    href="#">Find Support or Report Photo</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card gallery-card"><img
                                                src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="images"
                                                class="img-card-top img-fluid">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-grow-1 me-2">
                                                        <h5 class="mb-1 text-truncate">1080p_table_denar.pdf</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">event</i> Tue
                                                            Aug 24 2021
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle avtar avtar-xs bg-light-secondary text-secondary arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#">Remove Tag</a> <a
                                                                    class="dropdown-item" href="#">Download</a> <a
                                                                    class="dropdown-item" href="#">Make Profile
                                                                    Picture</a> <a class="dropdown-item" href="#">Make
                                                                    Cover Photo</a> <a class="dropdown-item"
                                                                    href="#">Find Support or Report Photo</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card gallery-card"><img
                                                src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="images"
                                                class="img-card-top img-fluid">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-grow-1 me-2">
                                                        <h5 class="mb-1 text-truncate">1080p_table_denar.pdf</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">event</i> Tue
                                                            Aug 24 2021
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle avtar avtar-xs bg-light-secondary text-secondary arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#">Remove Tag</a> <a
                                                                    class="dropdown-item" href="#">Download</a> <a
                                                                    class="dropdown-item" href="#">Make Profile
                                                                    Picture</a> <a class="dropdown-item" href="#">Make
                                                                    Cover Photo</a> <a class="dropdown-item"
                                                                    href="#">Find Support or Report Photo</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card gallery-card"><img
                                                src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="images"
                                                class="img-card-top img-fluid">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-grow-1 me-2">
                                                        <h5 class="mb-1 text-truncate">1080p_table_denar.pdf</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">event</i> Tue
                                                            Aug 24 2021
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle avtar avtar-xs bg-light-secondary text-secondary arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#">Remove Tag</a> <a
                                                                    class="dropdown-item" href="#">Download</a> <a
                                                                    class="dropdown-item" href="#">Make Profile
                                                                    Picture</a> <a class="dropdown-item" href="#">Make
                                                                    Cover Photo</a> <a class="dropdown-item"
                                                                    href="#">Find Support or Report Photo</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card gallery-card"><img
                                                src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="images"
                                                class="img-card-top img-fluid">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-grow-1 me-2">
                                                        <h5 class="mb-1 text-truncate">1080p_table_denar.pdf</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">event</i> Tue
                                                            Aug 24 2021
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle avtar avtar-xs bg-light-secondary text-secondary arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#">Remove Tag</a> <a
                                                                    class="dropdown-item" href="#">Download</a> <a
                                                                    class="dropdown-item" href="#">Make Profile
                                                                    Picture</a> <a class="dropdown-item" href="#">Make
                                                                    Cover Photo</a> <a class="dropdown-item"
                                                                    href="#">Find Support or Report Photo</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card gallery-card"><img
                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="images"
                                                class="img-card-top img-fluid">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-grow-1 me-2">
                                                        <h5 class="mb-1 text-truncate">1080p_table_denar.pdf</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">event</i> Tue
                                                            Aug 24 2021
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle avtar avtar-xs bg-light-secondary text-secondary arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#">Remove Tag</a> <a
                                                                    class="dropdown-item" href="#">Download</a> <a
                                                                    class="dropdown-item" href="#">Make Profile
                                                                    Picture</a> <a class="dropdown-item" href="#">Make
                                                                    Cover Photo</a> <a class="dropdown-item"
                                                                    href="#">Find Support or Report Photo</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card gallery-card"><img
                                                src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="images"
                                                class="img-card-top img-fluid">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-grow-1 me-2">
                                                        <h5 class="mb-1 text-truncate">1080p_table_denar.pdf</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">event</i> Tue
                                                            Aug 24 2021
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle avtar avtar-xs bg-light-secondary text-secondary arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#">Remove Tag</a> <a
                                                                    class="dropdown-item" href="#">Download</a> <a
                                                                    class="dropdown-item" href="#">Make Profile
                                                                    Picture</a> <a class="dropdown-item" href="#">Make
                                                                    Cover Photo</a> <a class="dropdown-item"
                                                                    href="#">Find Support or Report Photo</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card gallery-card"><img
                                                src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="images"
                                                class="img-card-top img-fluid">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-grow-1 me-2">
                                                        <h5 class="mb-1 text-truncate">1080p_table_denar.pdf</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">event</i> Tue
                                                            Aug 24 2021
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle avtar avtar-xs bg-light-secondary text-secondary arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#">Remove Tag</a> <a
                                                                    class="dropdown-item" href="#">Download</a> <a
                                                                    class="dropdown-item" href="#">Make Profile
                                                                    Picture</a> <a class="dropdown-item" href="#">Make
                                                                    Cover Photo</a> <a class="dropdown-item"
                                                                    href="#">Find Support or Report Photo</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card gallery-card"><img
                                                src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="images"
                                                class="img-card-top img-fluid">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-grow-1 me-2">
                                                        <h5 class="mb-1 text-truncate">1080p_table_denar.pdf</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">event</i> Tue
                                                            Aug 24 2021
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle avtar avtar-xs bg-light-secondary text-secondary arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#">Remove Tag</a> <a
                                                                    class="dropdown-item" href="#">Download</a> <a
                                                                    class="dropdown-item" href="#">Make Profile
                                                                    Picture</a> <a class="dropdown-item" href="#">Make
                                                                    Cover Photo</a> <a class="dropdown-item"
                                                                    href="#">Find Support or Report Photo</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card gallery-card"><img
                                                src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="images"
                                                class="img-card-top img-fluid">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-grow-1 me-2">
                                                        <h5 class="mb-1 text-truncate">1080p_table_denar.pdf</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">event</i> Tue
                                                            Aug 24 2021
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle avtar avtar-xs bg-light-secondary text-secondary arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#">Remove Tag</a> <a
                                                                    class="dropdown-item" href="#">Download</a> <a
                                                                    class="dropdown-item" href="#">Make Profile
                                                                    Picture</a> <a class="dropdown-item" href="#">Make
                                                                    Cover Photo</a> <a class="dropdown-item"
                                                                    href="#">Find Support or Report Photo</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card gallery-card"><img
                                                src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="images"
                                                class="img-card-top img-fluid">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-grow-1 me-2">
                                                        <h5 class="mb-1 text-truncate">1080p_table_denar.pdf</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">event</i> Tue
                                                            Aug 24 2021
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle avtar avtar-xs bg-light-secondary text-secondary arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#">Remove Tag</a> <a
                                                                    class="dropdown-item" href="#">Download</a> <a
                                                                    class="dropdown-item" href="#">Make Profile
                                                                    Picture</a> <a class="dropdown-item" href="#">Make
                                                                    Cover Photo</a> <a class="dropdown-item"
                                                                    href="#">Find Support or Report Photo</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card gallery-card"><img
                                                src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="images"
                                                class="img-card-top img-fluid">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-grow-1 me-2">
                                                        <h5 class="mb-1 text-truncate">1080p_table_denar.pdf</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            <i class="material-icons-two-tone f-14 me-1">event</i> Tue
                                                            Aug 24 2021
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle avtar avtar-xs bg-light-secondary text-secondary arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#">Remove Tag</a> <a
                                                                    class="dropdown-item" href="#">Download</a> <a
                                                                    class="dropdown-item" href="#">Make Profile
                                                                    Picture</a> <a class="dropdown-item" href="#">Make
                                                                    Cover Photo</a> <a class="dropdown-item"
                                                                    href="#">Find Support or Report Photo</a></div>
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
                    <div class="tab-pane" id="request" role="tabpanel" aria-labelledby="request-tab">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center g-2">
                                    <div class="col">
                                        <h5>Friend Request</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="form-search"><i class="ti ti-search"></i> <input type="search"
                                                class="form-control" placeholder="Search Followers"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Barney</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            10 mutual friends</h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Unfriend</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary">Confirm</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Thea</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            89 mutual friends</h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Unfriend</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary">Confirm</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Guiseppe</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            65 mutual friends</h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Unfriend</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary">Confirm</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Henderson</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            1 mutual friends</h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Unfriend</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary">Confirm</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Henderson</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            1 mutual friends</h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Unfriend</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary">Confirm</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Wilber</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            36 mutual friends</h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Unfriend</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary">Confirm</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Barney</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            10 mutual friends</h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Unfriend</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary">Confirm</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Thea</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            89 mutual friends</h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Unfriend</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary">Confirm</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Guiseppe</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            65 mutual friends</h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Unfriend</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary">Confirm</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Henderson</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            1 mutual friends</h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Unfriend</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary">Confirm</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Henderson</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            1 mutual friends</h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Unfriend</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary">Confirm</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Wilber</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            36 mutual friends</h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Unfriend</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary">Confirm</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Barney</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            10 mutual friends</h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Unfriend</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary">Confirm</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Thea</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            89 mutual friends</h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Unfriend</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary">Confirm</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Guiseppe</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            65 mutual friends</h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Unfriend</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary">Confirm</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Henderson</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            1 mutual friends</h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Unfriend</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary">Confirm</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Henderson</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            1 mutual friends</h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Unfriend</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary">Confirm</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Wilber</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            36 mutual friends</h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Unfriend</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary">Confirm</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Barney</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            10 mutual friends</h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Unfriend</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary">Confirm</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Thea</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            89 mutual friends</h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Unfriend</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary">Confirm</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Guiseppe</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            65 mutual friends</h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Unfriend</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary">Confirm</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Henderson</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            1 mutual friends</h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Unfriend</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary">Confirm</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Henderson</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            1 mutual friends</h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Unfriend</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary">Confirm</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card follower-card">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-shrink-0"><img class="img-radius img-fluid wid-40"
                                                            src="{{ asset('asset/images/user/avatar-1.jpg') }}" alt="User image">
                                                    </div>
                                                    <div class="flex-grow-1 mx-2">
                                                        <h5 class="mb-1 text-truncate">Wilber</h5>
                                                        <h6
                                                            class="text-truncate text-muted d-flex align-items-center mb-0">
                                                            36 mutual friends</h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown"><a
                                                                class="dropdown-toggle text-primary opacity-50 arrow-none"
                                                                href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><i
                                                                    class="ti ti-dots f-16"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end"><a
                                                                    class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">favorite</i>
                                                                    Favorites </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">group</i> Edit
                                                                    Friend List </a><a class="dropdown-item" href="#"><i
                                                                        class="material-icons-two-tone">delete</i>
                                                                    Unfriend</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-primary">Confirm</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-grid"><button
                                                                class="btn friend-btn btn-link-danger">Delete</button>
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
            </div><!-- [ sample-page ] end -->
        </div>
    </div>
</div>

@include('partials.footer')
@endsection
