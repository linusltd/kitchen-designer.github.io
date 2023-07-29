 <!-- Modal -->
 <div class="modal fade" id="createAuthorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1"><i class="fa fa-plus"></i> Create New Author</h5>

        </div>
        <form action="{{ route('admin.authors.store') }}" method="POST" id="createAuthorForm" onsubmit="return false">
            @csrf
            <div class="modal-body">
                <div class="row">
                  <div class="col mb-2">
                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name" />
                  </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                      <label for="name" class="form-label">Status</label>
                      <select name="status" id="status" class="form-control">
                        <option value="0">Active</option>
                        <option value="1">Inactive</option>
                      </select>
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
<div class="modal fade" id="updateAuthorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1"><i class="fa fa-edit"></i> Update Author</h5>

        </div>
        <form action="" method="POST" id="updateAuthorForm" onsubmit="return false">
            @csrf
            @method('put')
            <input type="hidden" name="id">
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-2">
                      <label for="name" class="form-label">Author Name <span class="text-danger">*</span></label>
                      <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name" />
                    </div>
                  </div>
                  <div class="row">
                      <div class="col mb-2">
                        <label for="name" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control">
                          <option value="0">Active</option>
                          <option value="1">Inactive</option>
                        </select>
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
