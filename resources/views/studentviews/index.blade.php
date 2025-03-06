@extends('layouts.studentdashlayout')
@section('title', 'Grades')
@section('studentcontent')
<div class="container-fluid py-2">
  <div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3 mb-0">Welcome, {{ $student->name }}</h6>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <!-- Student Information and GWA -->
          <div class="row px-3 mb-4">
            <div class="col-md-6">
              <h5 class="mb-1">Student Information</h5>
              <p class="mb-0"><strong>Name:</strong> {{ $student->name }}</p>
              <p class="mb-0"><strong>Email:</strong> {{ $student->email }}</p>
            </div>
            <div class="col-md-6 text-md-end">
              <h5 class="mb-1">General Weighted Average (GWA)</h5>
              <h3 class="mb-0">{{ $gwa ?? 'N/A' }}</h3>
            </div>
          </div>

          <!-- Enrolled Subjects and Grades Table -->
          <h4 class="px-3">Your Enrolled Subjects and Grades</h4>

          @if ($enrollments->isEmpty())
            <div class="alert alert-warning text-center mx-3">
              You are not enrolled in any subjects yet.
            </div>
          @else
            <div class="table-responsive p-0" style="max-height: 550px; overflow-y: auto;">
              <table class="table align-items-center mb-0">
                <thead class="sticky-top bg-white">
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Subject</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Units</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Grade</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Remarks</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($enrollments as $enrollment)
                    @php
                      $grade = optional($enrollment->grades->first())->grade;
                      $remarks = $grade ? ($grade <= 3.0 ? 'Passed' : 'Failed') : 'N/A';
                    @endphp
                    <tr>
                      <td>
                        <p class="text-xs font-weight-bold mb-0 px-3">{{ $enrollment->subject->name }}</p>
                      </td>
                      <td>
                        <p class="text-xs text-secondary mb-0 px-3">{{ $enrollment->subject->units }}</p>
                      </td>
                      <td>
                        <p class="text-xs text-secondary mb-0 px-3">{{ $grade ?? 'N/A' }}</p>
                      </td>
                      <td>
                        <p class="text-xs text-secondary mb-0 px-3">{{ $remarks }}</p>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

<style>
/* Custom scrollbar styling */
.table-responsive::-webkit-scrollbar {
  width: 6px;
  height: 6px;
}

.table-responsive::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 3px;
}

.table-responsive::-webkit-scrollbar-thumb {
  background: #888;
  border-radius: 3px;
}

.table-responsive::-webkit-scrollbar-thumb:hover {
  background: #555;
}

/* Sticky header styles */
.sticky-top {
  top: 0;
  z-index: 1020;
}

.table thead.sticky-top {
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

/* Ensure consistent column widths */
.table th, .table td {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
</style>
@endsection