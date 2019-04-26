<!-- modal -->
<div class="modal fade" id="saveToCollectionModal" tabindex="-1" role="dialog" aria-labelledby="saveModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="saveModalLabel">Save to Collection</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-success hidden alertsave" role="alert">
          Save Success
        </div>
        <form>
          <div class="form-group w-50">
            <input type="hidden" id="post_id" value="" />
            <select id="select-collection" class="form-control @foreach($collections as $collection) @if($collection->find_collection(Auth::user()->id) > 0) have-select @break @else hide-select @break @endif @endforeach">
              <option value="">--- Choose collection ---</option>
              @foreach($collections as $collection)
                @if($collection->user_id == Auth::user()->id)
                  <option value="collection-{{ $collection->id }}" data-collectid="{{$collection->id}}">{{ $collection->title }}</option>
                @endif
              @endforeach
              </select>
          </div>
          <div class="row">
            <div class="col-10">
              <a href="#createCollectionModal" id="newcollection-btn" data-toggle="modal" data-target="#createCollectionModal">+ New Collection</a>
            </div>
            <div class="col-2 p-0">
              <input id="save-btn-tocollection" type="button" class="btn btn-primary" value="Save">
            </div>
          </div>
      </form>
    </div>
  </div>
</div>
<!-- end modal -->
