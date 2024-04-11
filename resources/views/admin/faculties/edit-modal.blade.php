<!-- Modal -->
<div class="modal fade" id="facultyEditModal" tabindex="-1" aria-labelledby="facultyEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.faculty.update') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Update Faculty</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="facultyIdEdit" id="facultyIdEdit">

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="facultyNameEdit" name="name">
                        <label for="facultyNameEdit">Faculty Name <span class="text-danger">*</span></label>
                    </div>

                    <label for="facultyName" class="mb-2" data-bs-toggle="tooltip" data-bs-placement="right"
                        data-bs-title="You must choose the color since the default is #000000 that will be error.">Chart Label <span class="text-danger">*</span></label>

                    <div class="input-group">
                        <div class="input-group-text">
                            <input type="color" id="chartColorEdit" class="form-control form-control-color"
                                id="chart_color" title="Choose your color" name="chart_color">
                        </div>
                        <input type="text" class="form-control @error('short_name') is-invalid @enderror"
                            id="facultyShortNameEdit" name="short_name">
                    </div>
                    @error('short_name')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                    @error('chart_color')
                        <small class="form-text text-danger d-block">{{ $message }}</small>
                    @enderror


                    <div class="form-floating mt-3">
                        <select class="form-select" id="coordinatorEdit" aria-label="coordinatorEdit"
                            name="coordinator_id">
                            <option value="">None</option>
                            <option id="currentCoordinatorOption"></option>
                            @foreach ($coordinatorsAvailable as $coordinatorAvailable)
                                <option value={{ $coordinatorAvailable->id }}>
                                    {{ $coordinatorAvailable->fullname }}</option>;
                            @endforeach
                        </select>
                        <label for="coordinatorEdit">Coordinator</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
