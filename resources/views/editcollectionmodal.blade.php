<!-- modal -->
<div class="modal fade" id="editCollectionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit your collection</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <div class="row">
              <div class="col-3">
                {{ csrf_field() }}
                <input type="hidden" id="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="collection_id" id="collection-id" value="">
                <input type="hidden" name="user_id_edit" id="user_id_edit" value="{{ Auth::user()->id }}">
                <label for="collection-name">Name</label>
              </div>
              <div class="col-9">
                <input type="text" class="form-control" name="collection-name" id="collection-name" value="">
              </div>
            </div>
            <div class="row my-2">
              <div class="col-3">
                <label for="collection-description">Description</label>
              </div>
              <div class="col-9">
                <textarea class="form-control" name="collection-description" id="collection-description" rows="3" value=""></textarea>
              </div>
            </div>
            <div class="row my-2">
              <div class="col-3">
                <label for="collection-name">Private</label>
              </div>
              <div class="col-9">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="private-chk" id="private-chk" value="">
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <input id="delete-btn" type="button" class="btn btn-danger mr-4" value="Delete">
        <input id="save-btn" type="submit" class="btn btn-primary" value="Save">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- end modal -->
