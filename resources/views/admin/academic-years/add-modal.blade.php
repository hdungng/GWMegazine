<div class="modal fade" id="academicYearAddModal" tabindex="-1" aria-labelledby="academicYearAddLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.academic-year.store') }}">
                <div class="modal-header">
                    <h5 class="modal-title">Add Academic Year
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="height: 200px;">
                    @csrf
                    <input type="hidden" name="academicYearId" id="academicYearId">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="academicYearName" name="name">
                        <label for="academicYearName">Academic Year Name <span class="text-danger">*</span></label>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Starting Date <span class="text-danger">*</span></label>
                                <input type="text" id="startingDate" class="form-control datetimepickerAdd"
                                    name="starting_date" placeholder="Choose closure date...">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Closure Date <span class="text-danger">*</span></label>
                                <input type="text" id="closureDate" class="form-control datetimepickerAdd"
                                    name="closure_date" placeholder="Choose closure date...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Final Closure Date <span class="text-danger">*</span></label>
                                <input type="text" id="finalClosureDate" class="form-control datetimepickerAdd"
                                    name="final_closure_date" placeholder="Choose final closure date...">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
