@extends('admin.layouts.master')

@section('content')
@push('styles')
    <style>
        .disabled{
            cursor: default;
            background-color: -internal-light-dark(rgba(239, 239, 239, 0.3), rgba(59, 59, 59, 0.3));
            color: -internal-light-dark(rgb(84, 84, 84), rgb(170, 170, 170));
            border-color: rgba(118, 118, 118, 0.3);
        }
    </style>
@endpush
@push('styles')
<style>
    .upload__box,
    .mobile_upload__box {
        padding: 10px;
        border: 1px dashed;
        display: flex;
        gap: 5px;
    }

    .upload__inputfile {
        width: .1px;
        height: .1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
    }

    .upload__btn {
        vertical-align: middle;
        width: 120px;
        height: 120px;
        border: 1px dashed rgba(103, 103, 103, 0.39);
        display: inline-block;
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        gap: 1px;
    }

    .upload__btn:hover {
        background-color: unset;
        color: #4045ba;
        border: 1px dashed #4045ba;
        transition: all .3s ease;
    }

    .upload__btn-box {
        display: flex;
        justify-content: flex-start;
        gap: 5px;

    }

    .upload__img-wrap,
    .mobile_upload__img-wrap {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
    }

    .upload__img-box {
        height: 120px;
        width: 120px;
    }

    .upload__img-close,
    .mobile_upload__img-close,
    .upload__imges-close {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background-color: rgba(0, 0, 0, 0.5);
        position: absolute;
        top: 10px;
        right: 10px;
        text-align: center;
        line-height: 24px;
        z-index: 1;
        cursor: pointer;
    }

    .upload__img-close:after,
    .mobile_upload__img-close:after,
    .upload__imges-close:after {
        content: '\2716';
        font-size: 14px;
        color: white;
    }


    .img-bg {
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain;
        position: relative;
        padding-bottom: 100%;
        height: 100%;
        width: 100%;
        object-fit: contain;
    }
</style>
@endpush
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-2">Slider</h4>
    <!-- Basic Bootstrap Table -->
    <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0"><i class="fas fa-plus"></i> Create Slider</h5>
            </div>
            <div class="card-body">
              <form method="POST"  enctype="multipart/form-data" onsubmit="return false">
                @csrf
                <div class="row mb-3">
                    <div class="col-6">
                        <label class="form-label" for="type">Page <span class="text-danger">*</span></label>
                        <select name="type" class="form-control">
                            <option value="0">Home</option>
                            <option value="1">Shop</option>
                            <option value="2">English</option>
                        </select>
                      </div>
                </div>
                <div class="">
                    <label class="m-0">Slider Desktop Image <span class="text-danger">*</span></label>
                    <div class="upload__box">
                        <div class="upload__img-wrap"></div>
                        <div class="upload__btn-box">
                            <label class="upload__btn upload__btn-img">
                                <strong><i class="fas fa-plus"></i></strong>
                                <p><strong>Upload</strong></p>
                                <input type="file" id="image" name="image" data-max_length="1"
                                    class="upload__inputfile" accept="image/*" />
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <span class="text-danger main_image-error"></span>
                </div>
                <div class="">
                    <label class="m-0">Slider Mobile Image <span class="text-danger">*</span></label>
                    <div class="mobile_upload__box">
                        <div class="mobile_upload__img-wrap"></div>
                        <div class="upload__btn-box">
                            <label class="upload__btn mobile_upload__btn-img">
                                <strong><i class="fas fa-plus"></i></strong>
                                <p><strong>Upload</strong></p>
                                <input type="file" id="mobile_image" name="mobile_image" data-max_length="1"
                                    class="upload__inputfile" accept="image/*" />
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <span class="text-danger mobile_image-error"></span>
                </div>
                <div class="row mb-3">
                    <div class="col-6 mb-3">
                        <label for="">Banner Background Color Code<span class="text-danger">*</span></label>
                        <input type="text" name="color" id="color" placeholder="#ccc" class="form-control">
                    <span class="text-danger color-error"></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12 mb-3">
                        <label for="">Where User Should Redirect After Cliking the Banner Image</label>
                    </div>
                    <div class="col-3">
                        <div class="form-check">
                            <input name="redirect" class="form-check-input" type="radio" value="0" id="category" checked="">
                            <label class="form-check-label" style="cursor: pointer" for="category"> Redirect To a Book Detail Page </label>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-check">
                            <input name="redirect" class="form-check-input" type="radio" value="1" id="book" >
                            <label class="form-check-label" style="cursor: pointer" for="book"> Redirect To a Category Page </label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-check">
                            <input name="redirect" class="form-check-input" type="radio" value="2" id="url" >
                            <label class="form-check-label" style="cursor: pointer" for="url"> Redirect To a Custom URL </label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3" id="bookDiv">
                    <div class="col-6 mb-3">
                        <label class="form-label" for="issue_date">Books <span class="text-danger">*</span></label>
                        <select name="book_id" id="book_id" class="form-control">
                            <option value="">---select a book---</option>
                            @foreach ($books as $book)
                                <option value="{{ $book->id }}">{{ $book->name }}</option>
                            @endforeach
                        </select>
                        <small class="book_id-error text-danger"></small>
                    </div>
                </div>
                <div class="row mb-3 d-none" id="categoryDiv">
                    <div class="col-6 mb-3">
                        <label class="form-label" for="category_id">Categories <span class="text-danger">*</span></label>
                        <select name="category_id" class="form-control" id="category_id">
                            <option value="">---select a category---</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @foreach ($cat->child as $item)
                                <option value="{{ $item->id }}">---{{ $item->name }}</option>
                                @endforeach
                            @endforeach
                        </select>
                      </div>
                      <small class="category_id-error text-danger"></small>

                </div>
                <div class="row mb-3 d-none" id="urlDiv">
                    <div class="col-6 mb-3">
                        <label class="form-label" for="category_id">URL <span class="text-danger">*</span></label>
                        <input type="text" name="url" id="url" placeholder="e.g /shop" class="form-control">
                      </div>
                      <small class="url-error text-danger"></small>
                </div>
                <div class="row mb-3">
                    <div class="col-12 mb-3">
                        <label for="">Status</label>
                    </div>
                    <div class="col-1">
                        <div class="form-check">
                            <input name="status" class="form-check-input" type="radio" value="0" id="active" checked="">
                            <label class="form-check-label" style="cursor: pointer" for="active"> Active </label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-check">
                            <input name="status" class="form-check-input" type="radio" value="1" id="inactive" >
                            <label class="form-check-label" style="cursor: pointer" for="inactive"> Inactive </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary float-end btn-lg" id="submit">Submit</button>
                    </div>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->
</div>
@include('admin.cms.slider.js.create')
@endsection
