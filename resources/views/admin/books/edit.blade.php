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
        <!-- Basic Layout -->
        <div class="row">
            <div class="col-9">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Basic Information</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="">
                                <strong class="m-0">Product Images <span class="text-danger">*</span></strong>
                                <p>The picture will be displayed on the cover of the Product details page.</p>
                                <div class="upload__box">
                                    <div class="upload__img-wrap">
                                        <div class="upload__img-box">
                                            <div style='background-image: url("{{ asset('storage/' . $book->images[0]->filename) }}")'
                                                class='img-bg'>
                                                <div class='upload__img-close' data-id="{{ $book->images[0]->id }}"></div>
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
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="name">Product Name <span
                                        class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Ex. Attomic Habits " value="{{ $book->name }}" />
                                    <span class="text-danger name-error"></span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="slug">Product Slug <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="slug" id="slug"
                                        placeholder="atomic-habits" value="{{ $book->slug }}">
                                    <span class="text-danger slug-error"></span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Categories <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <select name="category_id[]" id="category_id" class="form-control" multiple>
                                        <option value="">--select categories--</option>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}"
                                                @foreach ($book->categories as $cat)
                                                @selected($cat->id == $item->id) @endforeach
                                                >
                                                {{ $item->name }}
                                            </option>
                                            @foreach ($item->child as $sub_cat)
                                            <option value="{{ $sub_cat->id }}"
                                                @foreach ($book->categories as $cat)
                                                @selected($cat->id == $sub_cat->id) @endforeach>
                                                ----{{ $sub_cat->name }}
                                            </option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                    <span class="text-danger category_id-error"></span>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Product Meta Section</h5>
                    </div>
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label text-right" for="basic-default-name"
                                                style="text-align: right;padding-right:0">Keywords</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="meta_keywords" id="meta_keywords" class="form-control"
                                                    placeholder="Keywords" value="{{ $book->meta_keywords }}">
                                                <span class="text-danger keywords-error"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        </form>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Highlights</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Product Highlights <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <textarea name="highlights" id="highlights" cols="30" rows="10">{!! $book->highlights !!}</textarea>
                                <span class="text-danger highlights-error"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Description</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Product Description <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <textarea name="description" id="description" cols="30" rows="10">{!! $book->description !!}</textarea>
                                <span class="text-danger description-error"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Price & Stock</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <p>Drag and drop pictures below to upload.Add at least 3 images of Product book from different
                                    angles. <span class="text-danger">*</span></p>
                                <div class="">
                                    <div class="upload__box">
                                        <div class="upload__img-wrap">
                                            @foreach ($book->images as $item)
                                                @if ($item->type != 0)

                                                <div class="upload__img-box">
                                                    <div style='background-image: url("{{ asset('storage/' . $item->filename) }}")'
                                                        class='img-bg'>
                                                        <div class='upload__img-close' data-id="{{ $item->id }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="upload__btn-box">
                                            <label class="upload__btn">
                                                <strong><i class="fas fa-plus"></i></strong>
                                                <p><strong>Upload</strong></p>
                                                <input type="file" id="images" name="images[]"
                                                    data-max_length="500000" class="upload__inputfile" accept="image/*"
                                                    multiple />
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <span class="text-danger images-error"></span>
                            </div>

                        </div>
                        <br>
                        <strong>Price & Stock</strong>
                        <div class="row d-flex justify-content-center">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label text-right" for="basic-default-name"
                                                style="text-align: right;padding-right:0">Price <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="price" id="price" class="form-control"
                                                    placeholder="0.00"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                    value="{{ $book->price }}">
                                                <span class="text-danger price-error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label text-right" for="basic-default-name"
                                                style="text-align: right;padding-right:0">Special Price</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="special_price" id="special_price"
                                                    value="{{ $book->special_price }}" class="form-control"
                                                    placeholder="0.00"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                                <span class="price-error">Spcial Price is a discount
                                                    price</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label text-right" for="basic-default-name"
                                                style="text-align: left;padding-right:0">Product Weight (kg) <span
                                                class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="weight" id="weight"
                                                    class="form-control" placeholder="0.0" value="{{ $book->weight }}"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                                    <span class="text-danger weight-error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label text-right" for="basic-default-name"
                                                style="text-align: right;padding-right:0">Low Stock Max.</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="low_stock_min" id="low_stock_min"
                                                    class="form-control" placeholder="Low Stock Value"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                    value="{{ intval($book->low_stock_min) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row mb-4">
                                            <label class="col-sm-3 col-form-label text-right" for="basic-default-name"
                                                style="text-align: right;padding-right:0">Availability.</label>
                                            <div class="col-sm-9">
                                               <select name="in_stock" id="in_stock" class="form-control">
                                                    <option value="0" @selected($book->in_stock == 0)>In Stock</option>
                                                    <option value="1" @selected($book->in_stock == 1)>Out Of Stock</option>
                                               </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label" for="basic-default-name"
                                                style="text-align: right;padding-right:0">SKU (Auto Generated)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="sku" id="sku" class="form-control"
                                                    readonly placeholder="SKU" value="{{ $book->sku }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br> <br>
    <br>
    <br>
    <br>
    <br>
    <footer class="content-footer bg-white footer fixed-bottom"
        style="box-shadow: 0 -1px 8px 0 rgb(39 52 120 / 12%);background: #ffffff;z-index: 99;">
        <div class="container-xxl d-flex flex-wrap justify-content-center py-2 flex-md-row flex-column">
            <div class="mb-2 mb-md-0">
                <div class="row mt-2 d-flex flex-wrap justify-content-center">
                    <div class="col-12">
                        <button class="btn btn-primary btn-lg  mb-3" style="border-radius: 0"
                            id="submitProductBtn">Submit</button>
                    </div>
                </div>
            </div>
            <div>

            </div>
        </div>
    </footer>
    @include('admin.books.js.edit')
@endsection
