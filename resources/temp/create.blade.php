@extends('layouts.app',['page' => 'page.create','text' => 'Thêm trang'])
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
                                Thêm trang
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <select @change="changeLanguage()" v-model="language" class="form-control">
                                <option value="vi">Tiếng việt</option>
                                <option value="en">English</option>
                            </select>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="kt-form" method="POST"
                          action="{{ route('admin.page.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="kt-portlet__body">
                            <div class="kt-section mb-0">
                                <div class="form-group validated" v-show="language === 'vi'">
                                    <label>Tên trang:</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           name="name" value="{{ old('name') }}">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group validated" v-show="language === 'en'">
                                    <label>Tên trang tiếng anh:</label>
                                    <input type="text" class="form-control @error('name_en') is-invalid @enderror"
                                           name="name_en" value="{{ old('name_en') }}">
                                    @error('name_en')
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
                                                <div class="row" id="img-preview-avatar" style="display: none;">
                                                    <div class="col-lg-6">
                                                        <img id="img-preview-avatar-source" src=""
                                                             class="img-fluid img-thumbnail mt-3"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group validated" v-show="language === 'vi'">
                                    <label>Mô tả:</label>
                                    <textarea class="form-control @error('summary') is-invalid @enderror" rows="5"
                                              name="summary">{{ old('summary') }}</textarea>
                                    @error('summary')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group validated" v-show="language === 'en'">
                                    <label>Mô tả tiếng anh:</label>
                                    <textarea class="form-control @error('summary_en') is-invalid @enderror" rows="5"
                                              name="summary_en">{{ old('summary_en') }}</textarea>
                                    @error('summary_en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group validated" v-show="language === 'vi'">
                                    <label>Nội dung:</label>
                                    <textarea class="summernote @error('content') is-invalid @enderror"
                                              name="content">{{ old('content') }}</textarea>
                                    @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group validated" v-show="language === 'en'">
                                    <label>Nội dung tiếng anh:</label>
                                    <textarea class="summernote @error('content_en') is-invalid @enderror"
                                              name="content_en">{{ old('content_en') }}</textarea>
                                    @error('content_en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group validated">
                                    <label>Kiểu:</label>
                                    <select name="type" class="form-control @error('type') is-invalid @enderror">
                                        <option value="introduction">Introduction</option>
                                        <option value="news">News</option>
                                        <option value="support">Support</option>
                                        <option value="term">Điều khoản</option>
                                        <option value="thanks">Cám ơn</option>
                                    </select>
                                    @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group validated form-group-last">
                                    <label>Số thứ tự ưu tiên: </label>
                                    <input type="number" class="form-control @error('sort') is-invalid @enderror"
                                           name="sort" value="{{ old('sort') ? old('sort') : 1 }}">
                                    @error('sort')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
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
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.11"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>

        var app = new Vue({
            el: '#app',
            data: {
                language: 'vi'
            },
            delimiters: ['<%', '%>'],
            methods: {
                changeLanguage: function () {
                }
            }
        });

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
