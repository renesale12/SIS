@extends('layouts.dashlayout')
@section('title', 'Grades- Admin Dashboard')
@section('content')
<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                        <h6 class="text-white text-capitalize ps-3 mb-0">Grades</h6>
                        <button type="button" class="btn btn-success me-3" data-bs-toggle="modal" data-bs-target="#addGradeModal">
                            <i class="material-symbols-rounded">add</i> Add Grade
                        </button>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <!-- Grades Table -->
                    <div class="table-responsive p-0" style="max-height: 550px; overflow-y: auto;">
                        <table class="table align-items-center mb-0">
                            <thead class="sticky-top bg-white">
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 35%">Student</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 30%">Subject</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 25%">Grade</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 15%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($grades as $grade)
                                <tr>
                                    <td>
                                    <p class="text-xs font-weight-bold mb-0 px-3">{{ optional($grade->student)->name ?? 'Unknown Student' }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0 px-3">{{ optional($grade->subject)->name ?? 'Unknown Subject' }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0 px-3">{{ $grade->grade }}</p>
                                    </td>
                                    <td class="align-middle">
                                    <button type="button" class="btn btn-link text-warning text-gradient px-3 mb-0" 
                                            data-bs-toggle="modal" data-bs-target="#editGradeModal"
                                            >
                                        <i class="material-symbols-rounded">edit</i> Edit
                                    </button>


                                        <form action="{{ route('grades.destroy', $grade->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger text-gradient px-3 mb-0" onclick="return confirm('Are you sure?')">
                                                <i class="material-symbols-rounded">delete</i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





@include('grades.create')
@include('grades.edit')


<!-- <script>
    function openEditModal(id, studentId, subjectId, grade) {
        document.getElementById("edit_grade_id").value = id;
        document.getElementById("edit_student_id").value = studentId;
        document.getElementById("edit_subject_id").value = subjectId;
        document.getElementById("edit_grade").value = grade;

        // Update form action dynamically
        document.getElementById("editGradeForm").action = "/grades/" + id;

        // Open Bootstrap modal
        var editModal = new bootstrap.Modal(document.getElementById("editGradeModal"));
        editModal.show();
    }
</script> -->

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
