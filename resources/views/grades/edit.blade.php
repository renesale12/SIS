@foreach($grades as $grade)
    <!-- Edit Grade Modal for each grade -->
    <div class="modal fade" id="editGradeModal{{ $grade->id }}" tabindex="-1" aria-labelledby="editGradeModalLabel{{ $grade->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header bg-gradient-dark text-white">
                    <h5 class="modal-title" id="editGradeModalLabel{{ $grade->id }}">Edit Grade</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <form id="editGradeForm{{ $grade->id }}" action="{{ route('grades.update', $grade->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="student_id" value="{{ $grade->student_id }}">
                        <input type="hidden" name="subject_id" value="{{ $grade->subject_id }}">

                        <div class="mb-3">
                            <label for="student_name{{ $grade->id }}" class="form-label fw-bold">Student</label>
                            <input type="text" id="student_name{{ $grade->id }}" class="form-control border-2"  
                                   value="{{ optional($grade->student)->name ?? 'Unknown Student' }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="subject_name{{ $grade->id }}" class="form-label fw-bold">Subject</label>
                            <input type="text" id="subject_name{{ $grade->id }}" class="form-control border-2" 
                                   value="{{ optional($grade->subject)->name ?? 'Unknown Subject' }}" readonly>
                        </div>
                        <div class="mb-3">
                <label for="edit_grade" class="form-label fw-bold">Grade</label>
                <select name="grade" id="edit_grade" class="form-select border-2" required>
                    @foreach(['1.0', '1.25', '1.5', '1.75', '2.0', '2.25', '2.5', '2.75', '3.0', '3.25', '3.5', '3.75', '4.0', '4.25', '4.5', '4.75', '5.0', 'INC', 'FDA'] as $gradeOption)
                        <option value="{{ $gradeOption }}" {{ $gradeOption == $grade->grade ? 'selected' : '' }}>
                            {{ $gradeOption }}
                        </option>
                    @endforeach
                </select>
            </div>

                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach