<!-- Modal -->
<div class="modal fade" id="facultyEditModal" tabindex="-1" aria-labelledby="facultyEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Faculty</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="facultyNameEdit" name="name">
                        <label for="facultyNameEdit">Faculty Name <span class="text-danger">*</span></label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="facultyShortNameEdit" name="short_name">
                        <label for="facultyShortNameEdit">Faculty Short Name <span class="text-danger">*</span></label>
                    </div>

                    <div class="form-floating">
                        <select class="form-select" id="coordinatorEdit" aria-label="coordinatorEdit"
                            name="coordinator_id">
                            <option selected value="">None</option>
                            @foreach ($coordinatorsAvailable as $coordinatorAvailable)
                                <option value={{ $coordinatorAvailable->id }}>
                                    {{ $coordinatorAvailable->fullname }}</option>;
                            @endforeach
                        </select>
                        <label for="coordinatorEdit">Coordinator</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</div>
