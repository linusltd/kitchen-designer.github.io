@extends('admin.layouts.master')

@section('content')
@push('styles')
    <style>
        .upload__box {
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

        .upload__btn, .footer_upload__btn {
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

        .upload__btn:hover, .footer_upload__btn:hover {
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

        .upload__img-wrap {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }

        .upload__img-box {
            height: 120px;
            width: 120px;
        }



        .upload__img-close,
        .footer_upload__img-close,
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
        .footer_upload__img-close:after,
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
    <!-- Basic Bootstrap Table -->
    <div class="row">
        <div class="col-md-10 col-12 mb-md-0 mb-4">
          <div class="card">
            <h5 class="card-header">Project General Settings</h5>
            <div class="card-body">
              <p>Display Project General Information</p>
              <!-- Connections -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="" class="mb-2">Logo <span class="text-danger">*</span></label>
                                <div class="upload__box">
                                    <div class="upload__img-wrap">
                                        <div class="upload__img-box">
                                            <div style='background-image: url("{{ asset('storage/' . $general->logo) }}")'
                                                class='img-bg'>
                                                <div class='upload__img-close' data-id="{{ $general->id }}"></div>
                                            </div>
                                        </div>
                                    </div>
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
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="" class="mb-2">Footer Logo <span class="text-danger">*</span></label>
                                <div class="upload__box">
                                    <div class="upload__img-wrap">
                                        <div class="upload__img-box">
                                            <div style='background-image: url("{{ asset('storage/' . $general->footer_logo) }}")'
                                                class='img-bg'>
                                                <div class='footer_upload__img-close' data-id="{{ $general->id }}"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="upload__btn-box">
                                        <label class="footer_upload__btn footer_upload__btn-img">
                                            <strong><i class="fas fa-plus"></i></strong>
                                            <p><strong>Upload</strong></p>
                                            <input type="file" id="footer_image" name="footer_image" data-max_length="1"
                                                class="upload__inputfile" accept="image/*" />
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-5">
                                <span class="text-danger footer_image-error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="" class="mb-2">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" placeholder="Name" value="{{ $general->name }}" class="form-control">
                                <span class="text-danger name-error"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="" class="mb-2">Address <span class="text-danger">*</span></label>
                                <input type="text" name="address" placeholder="Address" value="{{ $general->address }}" class="form-control">
                                <span class="text-danger address-error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="" class="mb-2">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" placeholder="Email" value="{{ $general->email }}" class="form-control">
                                <span class="text-danger email-error"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="" class="mb-2">Phone <span class="text-danger">*</span></label>
                                <input type="text" name="phone" placeholder="Phone" value="{{ $general->phone }}" class="form-control">
                                <span class="text-danger phone-error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="" class="mb-2">Office Timing <span class="text-danger">*</span></label>
                                <input type="office_timing" name="office_timing" placeholder="Office Timing" value="{{ $general->office_timing }}" class="form-control">
                                <span class="text-danger office_timing-error"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="" class="mb-2">Warehouse Address <span class="text-danger">*</span></label>
                                <input type="text" name="warehouse_address" placeholder="Warehouse Address" value="{{ $general->warehouse_address }}" class="form-control">
                                <span class="text-danger warehouse_address-error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="" class="mb-2">Map Link</label>
                                <input type="text" name="map" placeholder="Map Link" value="{{ $general->map }}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2 p-0">
                        <h5 class="card-header">Social Links</h5>
                    </div>
                     <!-- Social Accounts -->
                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0">
                        <img src="{{ asset('/assets/admin') }}/img/icons/brands/facebook.png" alt="facebook" class="me-3" height="30">
                        </div>
                        <div class="flex-grow-1 row mb-3">
                        <div class="col-8 col-sm-7 mb-sm-0 mb-2">
                            <h6 class="mb-0">Facebook</h6>
                            <input type="text" name="facebook" id="facebook" value="{{ $general->facebook }}" class="form-control" placeholder="https://www.facebook.com">
                        </div>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0">
                        <img src="{{ asset('/assets/admin') }}/img/icons/brands/instagram.png" alt="instagram" class="me-3" height="30">
                        </div>
                        <div class="flex-grow-1 row mb-3">
                        <div class="col-8 col-sm-7 mb-sm-0 mb-2">
                            <h6 class="mb-0">instagram</h6>
                            <input type="text" name="instagram" id="instagram" value="{{ $general->instagram }}" class="form-control" placeholder="https://www.instagram.com">
                        </div>
                        </div>
                    </div>
                    <div class="d-flex mb-5">
                        <div class="flex-shrink-0">
                        <img src="{{ asset('/assets/admin') }}/img/icons/brands/twitter.png" alt="twitter" class="me-3" height="30">
                        </div>
                        <div class="flex-grow-1 row">
                        <div class="col-8 col-sm-7 mb-sm-0 mb-2">
                            <h6 class="mb-0">Twitter</h6>
                            <input type="text" name="twitter" id="twitter" value="{{ $general->twitter }}" class="form-control" placeholder="https://www.twitter.com">
                        </div>
                        </div>
                    </div>
                    <!-- /Social Accounts -->
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" id="submit" class="btn btn-primary btn-lg">Submit</button>
                        </div>
                    </div>
              <!-- /Connections -->
            </div>
          </div>
        </div>

      </div>
    <!--/ Basic Bootstrap Table -->
@include('admin.cms.general.js.index')
@endsection
