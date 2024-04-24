<div class="modal fade" id="contributionPublishForGuestModal" tabindex="-1" aria-labelledby="contributionPublishForGuestLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.contributions.publish-for-guest')  }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Publish For Guest Contribution 
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="contributionIdPublishForGuest" name="contributionIdPublishForGuest"
                        hidden>
                    <p>Are you sure to publish for Guest accounts this contribution: <strong id="contributionNamePublishForGuest"
                            name="contributionNamePublishForGuest"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Publish</button>
                </div>
            </form>
        </div>
    </div>
</div>
