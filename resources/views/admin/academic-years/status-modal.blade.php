<div class="modal fade" id="academicYearStatusModal" tabindex="-1" aria-labelledby="academicYearStatusLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.academic-year.status')  }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Change Status Academic Year
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="academicYearIdStatus" name="academicYearIdForStatus"
                        hidden>
                    <p>Are you sure to change status <strong id="academicYearNameStatus"
                            name="academicYearNameStatus"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
