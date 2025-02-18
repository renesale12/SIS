<!-- Add Subject Modal -->
<div class="modal fade" id="addSubjectModal" tabindex="-1" aria-labelledby="addSubjectModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-gradient-dark">
        <h5 class="modal-title text-white" id="addSubjectModalLabel">Add New Subject</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('subjects.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="code" class="form-label">Subject Code:</label>
                <input type="text" name="code" class="form-control" value="{{ old('code') }}" required>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Subject Name:</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label for="units" class="form-label">Units:</label>
                <input type="number" name="units" class="form-control" value="{{ old('units') }}" required>
            </div>

            <button type="submit" class="btn btn-success">Save Subject</button>
        </form>
      </div>
    </div>
  </div>
</div>
