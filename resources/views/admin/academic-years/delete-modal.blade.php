<div class="modal fade" id="academicYearDeleteModal" tabindex="-1" aria-labelledby="academicYearDeleteLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.academic-year.delete')  }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Delete Academic Year
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="academicYearIdDelete" name="academicYearIdDelete"
                        hidden>
                    <p>Are you sure to delete <strong id="academicYearNameDelete"
                            name="academicYearNameDelete"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
