<!-- Modal -->
<div class="modal fade" id="facultyDeleteModal" tabindex="-1" aria-labelledby="facultyDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.faculty.delete')  }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Delete Faculty</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="facultyIdDelete" name="facultyIdDelete" hidden>
                    <p>Are you sure to delete <strong id="facultyNameDelete" name="facultyNameDelete"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
