@extends('layouts.studentdashlayout')

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
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Grade</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($enrollments as $enrollment)
                    <tr>
                      <td>
                        <p class="text-xs font-weight-bold mb-0 px-3">{{ $enrollment->subject->name }}</p>
                      </td>
                      <td>
                        <p class="text-xs text-secondary mb-0 px-3">  {{ optional($enrollment->grades->first())->grade ?? 'N/A' }}</p>
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
