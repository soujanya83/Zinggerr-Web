

<div class="container my-5">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center">
            <h2>Dashboard</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Online Courses</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
        </div>

        <!-- Statistics Cards -->
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card-stat">
                    <div>
                        <h4>New Students</h4>
                        <p>400+</p>
                    </div>
                    <span class="percentage">30.6%</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-stat">
                    <div>
                        <h4>Total Courses</h4>
                        <p>520+</p>
                    </div>
                    <span class="percentage">30.6%</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-stat">
                    <div>
                        <h4>New Visitors</h4>
                        <p>800+</p>
                    </div>
                    <span class="percentage">30.6%</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-stat">
                    <div>
                        <h4>Total Sales</h4>
                        <p>1,065</p>
                    </div>
                    <span class="percentage">30.6%</span>
                </div>
            </div>
        </div>

        <!-- Statistics and Chart -->
        <div class="row mt-4">
            <div class="col-md-8">
                <div class="card p-3">
                    <h5>Statistics</h5>
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 text-center">
                    <h5>Invites Goal</h5>
                    <div class="d-flex justify-content-center">
                        <div style="width: 150px; height: 150px;">
                            <canvas id="progressChart"></canvas>
                        </div>
                    </div>
                    <p>You earned $240 today, higher than yesterday</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Revenue Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
                datasets: [
                    {
                        label: 'Revenue',
                        data: [200, 250, 300, 400, 350, 450, 300, 380, 400, 450, 400, 500],
                        borderColor: 'orange',
                        fill: false
                    },
                    {
                        label: 'Sales',
                        data: [100, 150, 200, 300, 250, 350, 220, 300, 330, 400, 370, 450],
                        borderColor: 'blue',
                        fill: false
                    }
                ]
            }
        });

        // Progress Chart
        const progressCtx = document.getElementById('progressChart').getContext('2d');
        new Chart(progressCtx, {
            type: 'doughnut',
            data: {
                labels: ['Completed', 'Remaining'],
                datasets: [
                    {
                        data: [76, 24],
                        backgroundColor: ['#4caf50', '#f8f9fa']
                    }
                ]
            }
        });
    </script>