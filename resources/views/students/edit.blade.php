<div class="modal fade" id="editStudentModal{{ $student->id }}" tabindex="-1"
  aria-labelledby="editStudentModalLabel{{ $student->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-gradient-dark">
        <h5 class="modal-title text-white" id="editStudentModalLabel{{ $student->id }}">
          Edit Student
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('students.update', $student->id) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label for="name{{ $student->id }}" class="form-label">Name:</label>
            <input type="text" id="name{{ $student->id }}" name="name" class="form-control"
              value="{{ old('name', $student->name) }}" required>
          </div>

          <div class="mb-3">
            <label for="email{{ $student->id }}" class="form-label">Email:</label>
            <input type="email" id="email{{ $student->id }}" name="email" class="form-control"
              value="{{ old('email', $student->email) }}" required>
          </div>

          <!-- <div class="mb-3">
            <label for="course{{ $student->id }}" class="form-label">Course:</label>
            <input type="text" id="course{{ $student->id }}" name="course" class="form-control"
              value="{{ old('course', $student->course) }}" required>
          </div> -->

          <button type="submit" class="btn btn-success">Update Student</button>
        </form>
      </div>
    </div>
  </div>
</div>
