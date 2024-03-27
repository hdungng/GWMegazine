<div class="modal fade" id="academicYearEditModal" tabindex="-1" aria-labelledby="academicYearEditLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.academic-year.update') }}">
                <div class="modal-header">
                    <h5 class="modal-title">Update Academic Year
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="academicYearId" id="academicYearIdEdit">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="academicYearNameEdit" name="name">
                        <label for="academicYearNameEdit">Academic Year Name <span class="text-danger">*</span></label>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Closure Date <span class="text-danger">*</span></label>
                                <input type="text" id="closureDateEdit" class="form-control datetimepickerEdit"
                                    name="closure_date" placeholder="Choose closure date...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Final Closure Date <span class="text-danger">*</span></label>
                                <input type="text" id="finalClosureDateEdit" class="form-control datetimepickerEdit"
                                    name="final_closure_date" placeholder="Choose final closure date...">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save
                        Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
