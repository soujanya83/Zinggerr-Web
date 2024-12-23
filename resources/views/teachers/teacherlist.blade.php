@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet">

@section('pageTitle', 'Teachers List')

@section('content')
@include('partials.sidebar')
@include('partials.header')
<style>
    /* Table styling */
    table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 20px;
        /* Add some space from the top */
    }


    /* Search box styling */
    .search-container {

        right: 20px;
        /* Adjust right position as needed */
    }

    input[type="text"] {
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 12px;
    }

    select {
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    #showtr {
        display: table-row !important;
        /* Ensure header row is always displayed */
    }
</style>
<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Tearchs View</h5>
                        </div>
                    </div>

                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/app">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Teacher List</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-sm-12">
                <div class="card table-card">
                    <div class="card-header">
                        <div class="row align-items-center g-2">
                            <div class="col">
                                <select id="entriesPerPage">
                                    <option value="5" selected>5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                </select> entries per page
                            </div>
                            <div class="col-auto">
                                <div class="form-search">
                                    <div class="col-md-12">
                                        <div class="search-container">
                                            <input type="text" id="myInput" onkeyup="myFunction()"
                                                placeholder="Search...">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr id="showtr">
                                            <th>#</th>
                                            <th>Teachers Profile</th>
                                            <th>Username</th>
                                            <th>Phone</th>
                                            <th>Type</th>
                                            <th>Gender</th>
                                            <th>Status</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody id="userTableBody">
                                        @include('teachers.teacherlist_table')
                                    </tbody>
                                </table>
                                <div class="datatable-bottom">
                                    @if ($data->count() > 0)
                                    <div class="datatable-info">
                                        Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total()
                                        }}
                                        entries
                                    </div>
                                    @endif
                                    @include('users.pagination')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ sample-page ] end -->
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function myFunction() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.querySelector("table");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows
        for (i = 0; i < tr.length; i++) {
            // Get all cells of current row
            var tds = tr[i].getElementsByTagName("td");

            // Check if any of the cells contains the search string
            var found = false;
            for (var j = 0; j < tds.length; j++) {
                txtValue = tds[j].textContent || tds[j].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    found = true;
                    break;
                }
            }

            // Show or hide the row based on search result
            tr[i].style.display = found ? "" : "none";
        }
    }

    $('#entriesPerPage').on('change', function() {
    const perPage = $(this).val();
    const url = new URL(window.location.href);

    // Update URL with per_page parameter
    url.searchParams.set('per_page', perPage);
    url.searchParams.set('page', 1);

    $.ajax({
        url: url.toString(),
        type: 'GET',
        success: function(response) {
            if (response.html) { // Check if 'html' property exists
                $('#userTableBody').html(response.html);
            } else {
                console.error('Error: Missing "html" property in response.');
                // Handle the error gracefully (e.g., display an error message to the user)
            }

            if (response.pagination) { // Check if 'pagination' property exists
                $('.datatable-pagination').html(response.pagination);
            } else {
                console.error('Error: Missing "pagination" property in response.');
                // Handle the error gracefully
            }
        },
        error: function(error) {
            console.error('Error fetching data:', error);
            // Handle the error gracefully
        }
    });
});
</script>

@include('partials.footer')
@endsection
