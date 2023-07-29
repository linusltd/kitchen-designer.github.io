 <!-- Modal -->
<div class="modal fade" id="createPublisherModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1"><i class="fa fa-plus"></i> Create New Publisher</h5>

        </div>
        <form action="{{ route('admin.publishers.store') }}" method="POST" id="createPublisherForm" onsubmit="return false">
            @csrf
            <div class="modal-body">
                <div class="row">
                  <div class="col mb-3">
                    <label for="name" class="form-label">Publisher Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name" />
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                  Close
                </button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
        </form>
      </div>
    </div>
</div>

 <!-- Modal -->
<div class="modal fade" id="updatePublisherModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1"><i class="fa fa-edit"></i> Update Publisher</h5>

        </div>
        <form action="" method="POST" id="updatePublisherForm" onsubmit="return false">
            @csrf
            @method('put')
            <input type="hidden" name="id">
            <div class="modal-body">
                <div class="row">
                  <div class="col mb-3">
                    <label for="name" class="form-label">Publisher Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name" />
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                  Close
                </button>
                <button type="submit" class="btn btn-primary">Update & Save changes</button>
              </div>
        </form>
      </div>
    </div>
</div>
