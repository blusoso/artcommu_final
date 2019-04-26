<!-- modal -->
<div class="modal fade" id="createCollectionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create collection</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="/collection/insert">
          <div class="alert alert-success hidden alertsave" role="alert">
            Save Success
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-3">
                {{ csrf_field() }}
                <!-- {{ Auth::user()->id }} -->
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <label for="collection-name">Name</label>
              </div>
              <div class="col-9">
                <input type="text" class="form-control" name="collection-name" placeholder="eg. Illustration, Fan Art">
              </div>
            </div>
            <div class="row my-2">
              <div class="col-3">
                <label for="collection-name">Private</label>
              </div>
              <div class="col-9">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="private-chk" value="1">
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <input type="submit" id="save-btn" name="submit" class="btn btn-primary" value="Save">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- end modal -->
