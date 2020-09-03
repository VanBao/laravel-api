@extends('layouts.app',['page' => 'page.edit','text' => 'Sửa trang'])
@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid" id="app">
        <!--Begin::Row-->
        <div class="row">
            <div class="col-lg-12">

                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Sửa trang
                            </h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form class="kt-form" method="POST"
                          action="{{ route('admin.page.update',['id' => $data->id]) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="kt-portlet__body">
                            <div class="kt-section mb-0">
                                <div class="form-group validated">
                                    <label>Tên trang:</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           name="name" value="{{ $data->name }}">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group validated">
                                            <label>Avatar :</label>
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
                                </div>
                                <div class="form-group validated">
                                    <label>Mô tả:</label>
                                    <textarea class="form-control @error('summary') is-invalid @enderror" rows="5"
                                              name="summary">{{ $data->summary }}</textarea>
                                    @error('summary')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group validated">
                                    <label>Nội dung:</label>
                                    <textarea class="form-control @error('content') is-invalid @enderror"
                                              name="content" rows="5">{{ $data->content }}</textarea>
                                    @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group validated">
                                    <label>Kiểu:</label>
                                    <select name="type" class="form-control @error('type') is-invalid @enderror">
                                        <option value="introduction" @if($data->type == 'introduction') selected @endif>
                                            Introduction
                                        </option>
                                        <option value="news" @if($data->type == 'news') selected @endif>News</option>
                                        <option value="support" @if($data->type == 'support') selected @endif>Support
                                        </option>
                                        <option value="term" @if($data->type == 'term') selected @endif>Điều khoản
                                        </option>
                                        <option value="thanks" @if($data->type == 'thanks') selected @endif>Cám ơn
                                        </option>
                                    </select>
                                    @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group validated form-group-last">
                                    <label>Số thứ tự ưu tiên: </label>
                                    <input type="number" class="form-control @error('sort') is-invalid @enderror"
                                           name="sort" value="{{ $data->sort }}">
                                    @error('sort')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
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
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.11"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>

        $(document).ready(function () {

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

            function sendFile(file, editor, welEditable) {
                data = new FormData();
                data.append("image", file);
                $.ajax({
                    data: data,
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route('admin.upload') }}',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (url) {
                        console.log('success', url);
                        $('.summernote').summernote('editor.insertImage', url);
                    },
                    error: function (xhr, textStatus, error) {
                        let errors = xhr.responseJSON.errors;
                        for (let error in errors) {
                            toastr.error(errors[error]);
                        }
                    }
                });
            }

            $('.summernote').summernote({
                height: 350,
                callbacks: {
                    onImageUpload: function (files, editor, $editable) {
                        console.log('onImageUpload');
                        sendFile(files[0], editor, $editable);
                    }
                }
            });
        });

    </script>
@endsection
