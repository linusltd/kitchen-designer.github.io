 <!-- Modal -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1"><i class="fa fa-plus"></i> Create New Category</h5>

        </div>
        <form action="{{ route('admin.categories.store') }}" method="POST" id="createCategoryForm" onsubmit="return false">
            @csrf
            <div class="modal-body">
                <div class="row">
                  <div class="col mb-2">
                    <label for="name" class="form-label">Category Name <span class="text-danger">*</span></label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name" />
                  </div>
                </div>
                <div class="row">
                  <div class="col mb-2">
                    <label for="name" class="form-label">Slug <span class="text-danger">*</span></label>
                    <input type="text" id="slug" name="slug" class="form-control" placeholder="eg. category-name" />
                </div>
                </div>
                <div class="row">
                  <div class="col mb-2">
                    <label for="name" class="form-label">Image</label>
                    <input type="file" id="image" name="image" class="form-control" accept="image/*" />
                  </div>
                  <div class="image_preview">
                    <img src="" alt="" id="preview_image" width="50px" height="50px">
                </div>
                </div>
                <div class="row">
                  <div class="col mb-2">
                    <label for="name" class="form-label">Color</label>
                    <input type="text" id="color" name="color" class="form-control" placeholder="eg. #00000" />
                </div>
                </div>
                <div class="row">
                  <div class="col mb-2">
                    <label for="parent_id" class="form-label">Select Parent Category</label>
                    <select name="parent_id" id="paren_id" class="form-control">
                        <option value="0">--select parent category--</option>
                        @foreach ($categories as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @if ($item->child->count())
                                @foreach ($item->child as $level_one)
                                    <option value="{{ $level_one->id }}">---{{ $level_one->name }}</option>
                                @endforeach
                            @endif
                        @endforeach
                    </select>
                  </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                      <label for="name" class="form-label">Show as Top Category</label>
                      <select name="show_top" id="show_top" class="form-control">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                      </select>
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
<div class="modal fade" id="updateCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1"><i class="fa fa-edit"></i> Update Category</h5>

        </div>
        <form action="" method="POST" id="updateCategoryForm" onsubmit="return false">
            @csrf
            @method('put')
            <input type="hidden" name="id">
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-2">
                      <label for="name" class="form-label">Category Name <span class="text-danger">*</span></label>
                      <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name" />
                    </div>
                  </div>
                  <div class="row">
                    <div class="col mb-2">
                      <label for="name" class="form-label">Slug <span class="text-danger">*</span></label>
                      <input type="text" id="slug" name="slug" class="form-control" placeholder="eg. category-name" />
                  </div>
                  </div>
                  <div class="row">
                    <div class="col mb-2">
                      <label for="name" class="form-label">Image</label>
                      <input type="file" id="image" name="image" class="form-control" accept="image/*" />
                    </div>
                    <div class="image_preview">
                        <img src="" alt="" id="preview_image" width="50px" height="50px">
                  </div>
                  </div>
                  <div class="row">
                    <div class="col mb-2">
                      <label for="name" class="form-label">Color</label>
                      <input type="text" id="color" name="color" class="form-control" placeholder="eg. #00000" />
                  </div>
                  </div>
                  <div class="row">
                    <div class="col mb-2">
                      <label for="parent_id" class="form-label">Select Parent Category</label>
                      <select name="parent_id" id="paren_id" class="form-control">
                          <option value="0">--select parent category--</option>
                          @foreach ($categories as $item)
                              <option value="{{ $item->id }}">{{ $item->name }}</option>
                              @if ($item->child->count())
                                  @foreach ($item->child as $level_one)
                                      <option value="{{ $level_one->id }}">---{{ $level_one->name }}</option>
                                  @endforeach
                              @endif
                          @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="row">
                      <div class="col mb-2">
                        <label for="name" class="form-label">Show as Top Category</label>
                        <select name="show_top" id="show_top" class="form-control">
                          <option value="0">No</option>
                          <option value="1">Yes</option>
                        </select>
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
