@extends('layouts.app')

@section('pageTitle', 'Dashboard')

@section('content')

@include('partials.sidebar')
@include('partials.headerdashboard')

<div class="pc-container">
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">

                        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                            <div class="container-fluid">
                                <a class="navbar-brand" href="#">Dashboard</a>
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#navbarNav">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarNav">
                                    <ul class="navbar-nav">
                                        <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#">Classes</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#">Reports</a></li>
                                    </ul>
                                </div>
                            </div>
                        </nav>

                        <div class="container mt-4">
                            <!-- Dashboard Stats -->
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <div class="card text-white bg-info">
                                        <div class="card-body">
                                            <h5 class="card-title">Total Students</h5>
                                            <p class="card-text fs-3">120</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card text-white bg-success">
                                        <div class="card-body">
                                            <h5 class="card-title">Total Teachers</h5>
                                            <p class="card-text fs-3">15</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card text-white bg-warning">
                                        <div class="card-body">
                                            <h5 class="card-title">Attendance</h5>
                                            <p class="card-text fs-3">85%</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card text-white bg-danger">
                                        <div class="card-body">
                                            <h5 class="card-title">Pending Tasks</h5>
                                            <p class="card-text fs-3">8</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Graph Section -->
                            <div class="row">
                                <div class="col-md-6">
                                    <canvas id="attendanceChart"></canvas>
                                </div>
                                <div class="col-md-6">
                                    <canvas id="performanceChart"></canvas>
                                </div>
                            </div>

                            <!-- Table Section -->
                            <div class="mt-4">
                                <h4>Class Schedule</h4>
                                <table class="table table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Class</th>
                                            <th>Subject</th>
                                            <th>Teacher</th>
                                            <th>Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Grade 10</td>
                                            <td>Math</td>
                                            <td>Mr. Smith</td>
                                            <td>9:00 AM</td>
                                        </tr>
                                        <tr>
                                            <td>Grade 9</td>
                                            <td>Science</td>
                                            <td>Ms. Johnson</td>
                                            <td>10:00 AM</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="container mt-4">
    <div class="row g-4">
      <!-- Revenue Card -->
      <div class="col-md-4">
        <div class="card p-3">
          <h6>Total Revenue</h6>
          <h2>7,265</h2>
          <p class="text-success">+11.02% <i class="bi bi-arrow-up"></i></p>
        </div>
      </div>
      
      <!-- Subscription Card -->
      <div class="col-md-4">
        <div class="card p-3">
          <h6>Total Subscription</h6>
          <h2>5,326</h2>
          <p class="text-danger">+12.02% <i class="bi bi-arrow-down"></i></p>
        </div>
      </div>
      
      <!-- Student States -->
      <div class="col-md-4">
        <div class="card p-3">
          <h6>Student States</h6>
          <div class="chart-container">
            <canvas id="studentChart"></canvas>
          </div>
          <div class="d-flex justify-content-center mt-3">
            <div class="me-3"><span class="badge bg-primary">&nbsp;&nbsp;</span> Total Signups</div>
            <div><span class="badge bg-info">&nbsp;&nbsp;</span> Active Student</div>
          </div>
        </div>
      </div>
    </div>

    <div class="row g-4 mt-3">
      <!-- Student Queries -->
      <div class="col-md-12">
        <div class="card p-3">
          <h6>Student Queries</h6>
          <div class="student-query d-flex align-items-center mb-3">
            <img src="https://via.placeholder.com/40" alt="Avatar">
            <div class="ms-3 flex-grow-1">Python & Data Manage</div>
            <button class="icon-btn"><i class="bi bi-eye"></i></button>
            <button class="icon-btn"><i class="bi bi-trash"></i></button>
          </div>
          <div class="student-query d-flex align-items-center mb-3">
            <img src="https://via.placeholder.com/40" alt="Avatar">
            <div class="ms-3 flex-grow-1">Website Error</div>
            <button class="icon-btn"><i class="bi bi-eye"></i></button>
            <button class="icon-btn"><i class="bi bi-trash"></i></button>
          </div>
          <div class="student-query d-flex align-items-center mb-3">
            <img src="https://via.placeholder.com/40" alt="Avatar">
            <div class="ms-3 flex-grow-1">How to Illustrate</div>
            <button class="icon-btn"><i class="bi bi-eye"></i></button>
            <button class="icon-btn"><i class="bi bi-trash"></i></button>
          </div>
          <div class="student-query d-flex align-items-center">
            <img src="https://via.placeholder.com/40" alt="Avatar">
            <div class="ms-3 flex-grow-1">PHP Learning</div>
            <button class="icon-btn"><i class="bi bi-eye"></i></button>
            <button class="icon-btn"><i class="bi bi-trash"></i></button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    const ctx = document.getElementById('studentChart').getContext('2d');
    const studentChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ['Total Signups', 'Active Student'],
        datasets: [{
          data: [70, 30],
          backgroundColor: ['#007bff', '#17a2b8'],
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            display: false,
          }  <div class="container mt-4">
    <div class="row g-4">
      <!-- Revenue Card -->
      <div class="col-md-4">
        <div class="card p-3">
          <h6>Total Revenue</h6>
          <h2>7,265</h2>
          <p class="text-success">+11.02% <i class="bi bi-arrow-up"></i></p>
        </div>
      </div>
      
      <!-- Subscription Card -->
      <div class="col-md-4">
        <div class="card p-3">
          <h6>Total Subscription</h6>
          <h2>5,326</h2>
          <p class="text-danger">+12.02% <i class="bi bi-arrow-down"></i></p>
        </div>
      </div>
      
      <!-- Student States -->
      <div class="col-md-4">
        <div class="card p-3">
          <h6>Student States</h6>
          <div class="chart-container">
            <canvas id="studentChart"></canvas>
          </div>
          <div class="d-flex justify-content-center mt-3">
            <div class="me-3"><span class="badge bg-primary">&nbsp;&nbsp;</span> Total Signups</div>
            <div><span class="badge bg-info">&nbsp;&nbsp;</span> Active Student</div>
          </div>
        </div>
      </div>
    </div>

    <div class="row g-4 mt-3">
      <!-- Student Queries -->
      <div class="col-md-12">
        <div class="card p-3">
          <h6>Student Queries</h6>
          <div class="student-query d-flex align-items-center mb-3">
            <img src="https://via.placeholder.com/40" alt="Avatar">
            <div class="ms-3 flex-grow-1">Python & Data Manage</div>
            <button class="icon-btn"><i class="bi bi-eye"></i></button>
            <button class="icon-btn"><i class="bi bi-trash"></i></button>
          </div>
          <div class="student-query d-flex align-items-center mb-3">
            <img src="https://via.placeholder.com/40" alt="Avatar">
            <div class="ms-3 flex-grow-1">Website Error</div>
            <button class="icon-btn"><i class="bi bi-eye"></i></button>
            <button class="icon-btn"><i class="bi bi-trash"></i></button>
          </div>
          <div class="student-query d-flex align-items-center mb-3">
            <img src="https://via.placeholder.com/40" alt="Avatar">
            <div class="ms-3 flex-grow-1">How to Illustrate</div>
            <button class="icon-btn"><i class="bi bi-eye"></i></button>
            <button class="icon-btn"><i class="bi bi-trash"></i></button>
          </div>
          <div class="student-query d-flex align-items-center">
            <img src="https://via.placeholder.com/40" alt="Avatar">
            <div class="ms-3 flex-grow-1">PHP Learning</div>
            <button class="icon-btn"><i class="bi bi-eye"></i></button>
            <button class="icon-btn"><i class="bi bi-trash"></i></button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container mt-4">
    <div class="row g-4">
      <!-- Activity Chart -->
      <div class="col-lg-8">
        <div class="card p-3">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h6>Activity</h6>
            <div class="dropdown">
              <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                Monthly
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="#">Weekly</a></li>
                <li><a class="dropdown-item" href="#">Monthly</a></li>
                <li><a class="dropdown-item" href="#">Yearly</a></li>
              </ul>
            </div>
          </div>
          <canvas id="activityChart"></canvas>
        </div>
      </div>

      <!-- Calendar -->
      <div class="col-lg-4">
        <div class="card p-3">
          <div class="calendar">
            <h6>December 2024</h6>
            <table class="table table-borderless text-center">
              <thead>
                <tr>
                  <th>Su</th>
                  <th>Mo</th>
                  <th>Tu</th>
                  <th>We</th>
                  <th>Th</th>
                  <th>Fr</th>
                  <th>Sa</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td></td><td></td><td></td><td></td><td>1</td><td>2</td><td>3</td>
                </tr>
                <tr>
                  <td>4</td><td>5</td><td>6</td><td>7</td><td>8</td><td>9</td><td>10</td>
                </tr>
                <tr>
                  <td>11</td><td>12</td><td>13</td><td>14</td><td>15</td><td>16</td><td>17</td>
                </tr>
                <tr>
                  <td>18</td><td>19</td><td>20</td><td>21</td><td>22</td><td>23</td><td>24</td>
                </tr>
                <tr>
                  <td>25</td><td class="bg-primary text-white rounded">26</td><td>27</td><td>28</td><td>29</td><td>30</td><td>31</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    const ctx = document.getElementById('activityChart').getContext('2d');
    const activityChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['1', '2', '3', '4', '5', '6', '7'],
        datasets: [
          {
            label: 'Free Course',
            data: [70, 50, 30, 80, 60, 20, 90],
            borderColor: '#28a745',
            backgroundColor: 'rgba(40, 167, 69, 0.2)',
            fill: true,
            tension: 0.4,
          },
          {
            label: 'Subscription',
            data: [30, 60, 80, 40, 50, 70, 100],
            borderColor: '#007bff',
            backgroundColor: 'rgba(0, 123, 255, 0.2)',
            fill: true,
            tension: 0.4,
          }
        ]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            display: true,
            position: 'top',
          }
        }
      }
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    const ctx = document.getElementById('studentChart').getContext('2d');
    const studentChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ['Total Signups', 'Active Student'],
        datasets: [{
          data: [70, 30],
          backgroundColor: ['#007bff', '#17a2b8'],
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            display: false,
          }
        }
      }
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
        }
      }
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>

                        <!-- Bootstrap JS -->
                        <script
                            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js">
                        </script>
                        <!-- Charts -->
                        <script>
                        const attendanceCtx = document.getElementById('attendanceChart').getContext('2d');
                        const performanceCtx = document.getElementById('performanceChart').getContext('2d');

                        new Chart(attendanceCtx, {
                            type: 'bar',
                            data: {
                                labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                                datasets: [{
                                    label: 'Attendance (%)',
                                    data: [85, 88, 90, 87, 89],
                                    backgroundColor: 'rgba(75, 192, 192, 0.5)'
                                }]
                            }
                        });

                        new Chart(performanceCtx, {
                            type: 'line',
                            data: {
                                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                                datasets: [{
                                    label: 'Average Performance',
                                    data: [70, 75, 80, 78, 85],
                                    borderColor: 'rgba(54, 162, 235, 1)'
                                }]
                            }
                        });
                        </script>

                    </div>
                    <!-- [ Main Content ] end -->
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>

@include('partials.footer')
@endsection