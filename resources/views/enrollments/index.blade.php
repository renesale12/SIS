@extends('layouts.dashlayout')

@section('content')
<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                        <h6 class="text-white text-capitalize ps-3 mb-0">Enroll Students</h6>
                        <!-- Button to open modal -->
                        <button type="button" class="btn btn-success me-3" data-bs-toggle="modal" data-bs-target="#addEnrollmentModal">
                            <i class="material-symbols-rounded">add</i> Enroll New Student
                        </button>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <!-- Enrollment Table -->
                    <div class="table-responsive p-0" style="max-height: 550px; overflow-y: auto;">
                        <table class="table align-items-center mb-0">
                            <thead class="sticky-top bg-white">
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 35%">Student Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 35%">Subject</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 20%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($enrollments as $enrollment)
                                <tr>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0 px-3">{{ $enrollment->student->name }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0 px-3">{{ $enrollment->subject->name }}</p>
                                    </td>
                                    <td class="align-middle">
                                    <button type="button" class="btn btn-link text-warning text-gradient px-3 mb-0" data-bs-toggle="modal" data-bs-target="#editEnrollmentModal{{ $enrollment->id }}">
                                        <i class="material-symbols-rounded">edit</i> Edit
                                    </button>


                                        <form action="{{ route('enrollments.destroy', $enrollment->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger text-gradient px-3 mb-0">
                                                <i class="material-symbols-rounded">delete</i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>


                                @include('enrollments.edit', ['enrollment' => $enrollment, 'subjects' => $subjects])
                                
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Include the modal here and pass the students and subjects -->
@include('enrollments.create')

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

/* Ensure sticky header works properly */
.sticky-top {
  top: 0;
  z-index: 1020;
}

/* Add shadow to sticky header */
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
