<!-- Edit Subject Modal -->
<div class="modal fade" id="editSubjectModal" tabindex="-1" aria-labelledby="editSubjectModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-gradient-dark">
        <h5 class="modal-title text-white" id="editSubjectModalLabel">Edit Subject</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('subjects.update', $subject->id) }}" method="POST">
            @csrf
            @method('PUT')  <!-- Ensures Laravel processes it as an update -->

            <div class="mb-3">
                <label for="code" class="form-label">Subject Code:</label>
                <input type="text" name="code" class="form-control" value="{{ old('code', $subject->code) }}" required>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Subject Name:</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $subject->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="units" class="form-label">Units:</label>
                <input type="number" name="units" class="form-control" value="{{ old('units', $subject->units) }}" required>
            </div>

            <button type="submit" class="btn btn-success">Update Subject</button>
        </form>
      </div>
    </div>
  </div>
</div>
