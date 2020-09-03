@extends('layouts.app',['page' => 'category.edit','text' => 'Sửa chuyên mục'])
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
                                Sửa chuyên mục
                            </h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form class="kt-form" method="POST"
                          action="{{ route('admin.category.update',['id' => $data->id ]) }}"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="kt-portlet__body">
                            @if(session()->has('success'))
                                <div class="alert alert-solid-success alert-bold" role="alert">
                                    <div class="alert-text">{{ session()->get('success') }}</div>
                                </div>
                            @endif

                            <div class="kt-section mb-0">
                                <div class="form-group validated">
                                    <label>Tên chuyên mục:</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                           name="title" value="{{ $data->title }}">
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group validated">
                                    <label>Mô tả:</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" rows="5"
                                              name="description">{{ $data->description }}</textarea>
                                    @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group validated">
                                    <label>Giới thiệu:</label>
                                    <textarea class="form-control @error('summary') is-invalid @enderror" rows="5"
                                              name="summary">{{ $data->summary }}</textarea>
                                    @error('summary')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group validated form-group-last">
                                            <label>Ảnh đại diện :</label>
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
                                                <div class="row" id="img-preview-avatar">
                                                    <div class="col-lg-6">
                                                        <img id="img-preview-avatar-source" src="{{ $data->avatar }}"
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
                                                <div class="row" id="img-preview-icon">
                                                    <div class="col-lg-6">
                                                        <img id="img-preview-icon-source" src="{{ $data->icon }}"
                                                             class="img-fluid img-thumbnail mt-3"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--<div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group validated form-group-last">
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
                                                    <div class="row" id="img-preview-background">
                                                        <div class="col-lg-4">
                                                            <img id="img-preview-background-source" src="{{ $data->background }}"
                                                                 class="img-fluid img-thumbnail mt-3"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row mt-3">
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
                                            @if($data->images)
                                                <div class="row">
                                                    @foreach($data->images as $index => $image)
                                                        @php
                                                            $_image = explode('/',$image);
                                                            $_image = end($_image);
                                                        @endphp
                                                        <div class="col-3 mt-3" data-image-index="{{ $index }}">
                                                            <label for="file-upload-images-{{ $index }}"
                                                                   class="btn btn-brand btn-elevate btn-icon-sm mb-0">
                                                                <i class="la la-image"></i> Chọn ảnh
                                                            </label>
                                                            <input id="file-upload-images-{{ $index }}" accept="image/*"
                                                                   name="images[]"
                                                                   class="d-none file-upload-multiple"
                                                                   type="file"/>
                                                            <div class="row" id="img-preview-images-{{ $index }}">
                                                                <div class="col-lg-12">
                                                                    <div class="position-relative mt-3">
                                                                        <input type="hidden" name="images_old[]"
                                                                               value="{{ $_image }}">
                                                                        <img id="img-preview-images-source-{{ $index }}"
                                                                             src="{{ $image }}"
                                                                             class="img-fluid img-thumbnail"/>
                                                                        <button data-index="{{ $index }}" type="button"
                                                                                class="btn btn-remove-image btn-danger btn-elevate btn-sm btn-icon-sm">
                                                                            <i class="la la-trash m-0"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>--}}
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm">
                                    <i class="la la-save"></i>
                                    Sửa
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
                readURL(this, elm);
            });

            $(".form-images").on('change', ".file-upload-multiple", function () {
                var index = $(this).parent().data('image-index');
                let elm = '#img-preview-images-' + index;
                console.log('elm', elm);
                $(elm).show();
                readURL(this, elm, index);
            });

            $(".form-images").on('click', ".btn-remove-image", function () {
                var index = $(this).data('index');
                $("[data-image-index=" + index + "]").remove();
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
