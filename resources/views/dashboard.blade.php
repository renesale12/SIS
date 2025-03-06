@extends('layouts.dashlayout')



@section('content')
    <!-- End Navbar -->
    <div class="container-fluid py-2">
      <div class="row">
        <div class="ms-3">
          <h3 class="mb-0 h4 font-weight-bolder">Dashboard</h3>
          <p class="mb-4">
            Check the entries, monitor students and facilitate.
          </p>
        </div>
        <div class="row">
        <div class="row">
    <!-- Total Students -->
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-2 ps-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-sm mb-0 text-capitalize">Total Students</p>
                        <h4 class="mb-0">{{ $totalStudents }}</h4>
                    </div>
                    <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                        <i class="material-symbols-rounded opacity-10">group</i>
                    </div>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2 ps-3">
                <!-- <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+5% </span>than last month</p> -->
            </div>
        </div>
    </div>

    <!-- Total Subjects -->
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-2 ps-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-sm mb-0 text-capitalize">Subjects</p>
                        <h4 class="mb-0">{{ $totalSubjects }}</h4>
                    </div>
                    <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                        <i class="material-symbols-rounded opacity-10">book</i>
                    </div>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2 ps-3">
                <!-- <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+3% </span> than last month</p> -->
            </div>
        </div>
    </div>

    <!-- Enrolled Students -->
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-2 ps-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-sm mb-0 text-capitalize">Enrolled Students</p>
                        <h4 class="mb-0">{{ $totalEnrolled }}</h4>
                    </div>
                    <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                        <i class="material-symbols-rounded opacity-10">school</i>
                    </div>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2 ps-3">
                <!-- <p class="mb-0 text-sm"><span class="text-danger font-weight-bolder">-2% </span> than yesterday</p> -->
            </div>
        </div>
    </div>

    <!-- Unenrolled Students -->
    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-header p-2 ps-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-sm mb-0 text-capitalize">Unenrolled</p>
                        <h4 class="mb-0">{{ $unenrolledStudents }}</h4>
                    </div>
                    <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                        <i class="material-symbols-rounded opacity-10">person_off</i>
                    </div>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2 ps-3">
                <!-- <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+5% </span> than yesterday</p> -->
            </div>
        </div>
    </div>
</div>

<div class="col-lg-6 col-md-6 mt-4 mb-4">
    <div class="card" style="height: 450px;"> <!-- Fixed height -->
        <div class="card-body d-flex flex-column">
            <h6 class="mb-0">Subject Enrollment Insights</h6>
            <p class="text-sm">Number of students per subject</p>
            <div class="pe-2 flex-grow-1" style="max-height: 300px; overflow-y: auto;">
                <ul class="list-group">
                    @foreach($subjectNames as $index => $subject)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $subject }}
                            <span class="badge bg-primary rounded-pill">{{ $enrolledCounts[$index] }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            <hr class="dark horizontal">
            <div class="d-flex">
                <i class="material-symbols-rounded text-sm my-auto me-1">schedule</i>
                <p class="mb-0 text-sm">Updated just now</p>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-6 col-md-6 mt-4 mb-4">
    <div class="card" style="height: 450px;"> <!-- Fixed height to match -->
        <div class="card-body d-flex flex-column">
            <h6 class="mb-0">Student Status Distribution</h6>
            <p class="text-sm">Enrolled vs. Unenrolled Students</p>
            <div class="pe-2 flex-grow-1 d-flex justify-content-center align-items-center">
                <canvas id="enrollmentChart" class="chart-canvas" style="max-height: 300px;"></canvas>
            </div>
            <hr class="dark horizontal">
            <div class="d-flex">
                <i class="material-symbols-rounded text-sm my-auto me-1">schedule</i>
                <p class="mb-0 text-sm">Updated just now</p>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById('enrollmentChart').getContext('2d');

        var enrolledStudents = {{ $totalEnrolled }};
        var unenrolledStudents = {{ $unenrolledStudents }};

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Enrolled', 'Unenrolled'],
                datasets: [{
                    data: [enrolledStudents, unenrolledStudents],
                    backgroundColor: ['#6c757d','#28a745'], // Green for enrolled, Gray for unenrolled
                    borderColor: [ '#6c757d','#28a745'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom'
                    }
                }
            }
        });
    });
</script>

      <footer class="footer py-4  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart"></i> by
                <a href="https://www.facebook.com/enerreysale/" class="font-weight-bold" target="_blank">Rene Rey Sale</a>
                for a better web.
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
  @endsection