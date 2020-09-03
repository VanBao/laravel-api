@extends('layouts.app',['page' => 'category.create','text' => 'Thêm chuyên mục'])
@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <!--Begin::Row-->
        <div class="row">
            <div class="col-lg-12">

                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Thêm chuyên mục
                            </h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form class="kt-form" method="POST" action="{{ route('admin.category.store') }}"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="kt-portlet__body">
                            <div class="kt-section mb-0">
                                <div class="form-group validated">
                                    <label>Tên chuyên mục:</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                           name="title" value="{{ old('title') }}">
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group validated">
                                    <label>Mô tả:</label>
                                    <input type="text" class="form-control @error('description') is-invalid @enderror"
                                           name="description" value="{{ old('description') }}">
                                    @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group validated">
                                    <label>Giới thiệu:</label>
                                    <textarea class="form-control" rows="5"
                                              name="summary">{{ old('summary') }}</textarea>
                                    @error('summary')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group validated form-group-last">
                                            <label>Ảnh nền dưới icon :</label>
                                            <div>
                                                <label for="file-upload-avatar"
                                                       class="btn btn-brand btn-elevate btn-icon-sm mb-0">
                                                    <i class="la la-image"></i> Chọn ảnh
                                                </label>
                                                <input id="file-upload-avatar" accept="image/*" name="avatar"
                                                       class="d-none"
                                                       type="file"/>
                                                @error('avatar')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                                <div class="row" id="img-preview-avatar" style="display: none;">
                                                    <div class="col-lg-6">
                                                        <img id="img-preview-avatar-source" src=""
                                                             class="img-fluid img-thumbnail mt-3"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group validated form-group-last">
                                            <label>Icon:</label>
                                            <div>
                                                <label for="file-upload-icon"
                                                       class="btn btn-brand btn-elevate btn-icon-sm mb-0">
                                                    <i class="la la-image"></i> Chọn ảnh
                                                </label>
                                                <input id="file-upload-icon" accept="image/*" class="d-none"
                                                       name="icon"
                                                       type="file"/>
                                                @error('icon')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                                <div class="row" id="img-preview-icon" style="display: none;">
                                                    <div class="col-lg-6">
                                                        <img id="img-preview-icon-source" src=""
                                                             class="img-fluid img-thumbnail mt-3"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--<div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group validated">
                                            <label>Ảnh bìa :</label>
                                            <div>
                                                <label for="file-upload-background"
                                                       class="btn btn-brand btn-elevate btn-icon-sm mb-0">
                                                    <i class="la la-image"></i> Chọn ảnh
                                                </label>
                                                <div>
                                                    <input id="file-upload-background" accept="image/*"
                                                           name="background"
                                                           class="d-none"
                                                           type="file"/>
                                                    @error('background')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                    <div class="row" id="img-preview-background" style="display: none;">
                                                        <div class="col-lg-4">
                                                            <img id="img-preview-background-source" src=""
                                                                 class="img-fluid img-thumbnail mt-3"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group validated form-images">
                                            <label>Hình ảnh mô tả :
                                                <button type="button"
                                                        class="ml-2 btn btn-add-image btn-success btn-elevate btn-sm btn-icon-sm">
                                                    <i class="la la-plus m-0"></i>
                                                </button>
                                            </label>
                                            @error('images')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                            @error('images.*')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                            <div class="row">
                                                <div class="col-3 mt-3" data-image-index="0">
                                                    <label for="file-upload-images-0"
                                                           class="btn btn-brand btn-elevate btn-icon-sm mb-0">
                                                        <i class="la la-image"></i> Chọn ảnh
                                                    </label>
                                                    <input id="file-upload-images-0" accept="image/*" name="images[]"
                                                           class="d-none file-upload-multiple"
                                                           type="file"/>
                                                    <div class="row" id="img-preview-images-0" style="display: none;">
                                                        <div class="col-lg-12">
                                                            <div class="position-relative mt-3">
                                                                <img id="img-preview-images-source-0" src=""
                                                                     class="img-fluid img-thumbnail"/>
                                                                <button data-index="0" type="button"
                                                                        class="btn btn-remove-image btn-danger btn-elevate btn-sm btn-icon-sm">
                                                                    <i class="la la-trash m-0"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>--}}
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm">
                                    <i class="la la-plus"></i>
                                    Thêm
                                </button>
                            </div>
                        </div>
                    </form>

                    <!--end::Form-->
                </div>

                <!--end::Portlet-->
            </div>
        </div>
        <!--End::Row-->

    </div>
@endsection

@section('scripts')
    <script src="{{asset('assets/js/pages/custom/user/profile.js')}}"></script>
    <script>

        $(document).ready(function () {
            // $("#img-preview[src='']").hide();
            function readURL(input, elm, index = null) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        if (index === null) {
                            $(elm + '-source').attr('src', e.target.result);
                        } else {
                            $("#img-preview-images-source-" + index).attr('src', e.target.result);
                        }
                    }

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

            $("#file-upload-avatar,#file-upload-icon,#file-upload-background").change(function () {
                let name = $(this).attr('name');
                let elm = '#img-preview-' + name;
                $(elm).show();
                readURL(this, elm);
            });

            $(".form-images").on('change', ".file-upload-multiple", function () {
                var index = $(this).parent().data('image-index');
                let elm = '#img-preview-images-' + index;
                $(elm).show();
                readURL(this, elm, index);
            });

            $(".form-images").on('click', ".btn-remove-image", function () {
                var index = $(this).data('index');
                $("[data-image-index="+index+"]").remove();
            });

            $(".btn-add-image").click(function () {
                var index = $("[data-image-index]").last().data('image-index') ? $("[data-image-index]").last().data('image-index') : 0;
                ++index;
                var xhtml = `
                <div class="col-3 mt-3" data-image-index="${index}">
                                                <label for="file-upload-images-${index}"
                                                       class="btn btn-brand btn-elevate btn-icon-sm mb-0">
                                                    <i class="la la-image"></i> Chọn ảnh
                                                </label>
                                                <input id="file-upload-images-${index}" accept="image/*" name="images[]"
                                                       class="d-none file-upload-multiple"
                                                       type="file"/>
                                                <div class="row" id="img-preview-images-${index}" style="display: none;">
                                                    <div class="col-lg-12">
                                                            <div class="position-relative mt-3">
                                                                <img id="img-preview-images-source-${index}" src=""
                                                                     class="img-fluid img-thumbnail"/>
                                                                <button data-index="${index}" type="button"
                                                                        class="btn btn-remove-image btn-danger btn-elevate btn-sm btn-icon-sm">
                                                                    <i class="la la-trash m-0"></i>
                                                                </button>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>`;
                $(".form-images > .row").append(xhtml);
            });
        });

    </script>
@endsection
