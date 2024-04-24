<div class="modal fade" id="contributionPublishAllModal" tabindex="-1" aria-labelledby="contributionPublishAllLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.contributions.publish-all')  }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Publish All Contribution 
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="contributionIdPublishAll" name="contributionIdPublishAll"
                        hidden>
                    <p>Are you sure to publish including Guest accounts this contribution: <strong id="contributionNamePublishAll"
                            name="contributionNamePublishAll"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Publish</button>
                </div>
            </form>
        </div>
    </div>
</div>
