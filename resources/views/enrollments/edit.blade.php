<!-- Edit Enrollment Modal -->
<div class="modal fade" id="editEnrollmentModal{{ $enrollment->id }}" tabindex="-1" aria-labelledby="editEnrollmentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content border-0">
      <div class="modal-header bg-gradient-dark text-white">
        <h5 class="modal-title" id="editEnrollmentModalLabel">Edit Enrollment</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body px-4">
        <form action="{{ route('enrollments.update', $enrollment->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Student Name (Fixed, Cannot be Edited) -->
            <div class="mb-3">
                <label class="form-label fw-bold">Student</label>
                <input type="text" class="form-control border-2" value="{{ $enrollment->student->name }}" readonly>
            </div>

            <!-- Subject (Can Be Edited) -->
            <div class="mb-3">
                <label for="edit_subject_id" class="form-label fw-bold">Subject</label>
                <select name="subject_id" id="edit_subject_id" class="form-select border-2" required>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}" {{ $enrollment->subject_id == $subject->id ? 'selected' : '' }}>
                            {{ $subject->name }}
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
