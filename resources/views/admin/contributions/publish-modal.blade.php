<div class="modal fade" id="contributionPublishModal" tabindex="-1" aria-labelledby="contributionPublishLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.contributions.publish')  }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Publish Contribution
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="contributionIdPublish" name="contributionIdPublish"
                        hidden>
                    <p>Are you sure to publish this contribution: <strong id="contributionNamePublish"
                            name="contributionNamePublish"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Publish</button>
                </div>
            </form>
        </div>
    </div>
</div>
