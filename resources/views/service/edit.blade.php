@extends('layouts.app',['page' => 'service.edit','text' => 'Sửa dịch vụ'])
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
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
                                Sửa dịch vụ
                            </h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form class="kt-form" id="form-service" method="POST"
                          action="{{ route('admin.service.update',['id' => $data['id']]) }}"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="kt-portlet__body">
                            <div class="kt-section mb-0">
                                <div class="form-group validated">
                                    <label>Tên dịch vụ:</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           name="name" value="{{ $data['name' ]}}">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group validated">
                                    <label>Nội dung:</label>
                                    <textarea class="form-control @error('summary') is-invalid @enderror" rows="8"
                                              name="summary">{{ $data['summary'] }}</textarea>
                                    @error('summary')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{--<div class="form-group validated">
                                    <label>Nội dung:</label>
                                    <textarea class="summernote @error('content') is-invalid @enderror"
                                              name="content">{{ $data['content'] }}</textarea>
                                    @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>--}}
                                <div class="form-group validated">
                                    <label>Chuyên mục:</label>
                                    @if(count($categories) > 0)
                                        <select name="category"
                                                class="form-control @error('category') is-invalid @enderror">
                                            @foreach($categories as $category)
                                                <option value="{{ $category['id'] }}"
                                                        @if($data['category_id'] == $category['id']) selected="selected" @endif>{{ $category['title'] }}</option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    @else
                                        <p class="text-muted">Bạn chưa có chuyên mục nào cả, ấn <a
                                                href="{{ route('admin.category.create') }}">vào đây</a> để tạo</p>
                                    @endif
                                </div>
                                <div class="form-group validated">
                                    <label>Bảng giá dịch vụ:</label>
                                    <table class="table table-bordered mt-2" id="table-service-price">
                                        <thead>
                                        <tr>
                                            <th>Ảnh đại diện</th>
                                            <th>Tên dịch vụ</th>
                                            <th>Giá online</th>
                                            <th>Giá offline</th>
                                            <th>Nội dung</th>
                                            <th></th>
                                        </tr>

                                        </thead>
                                        <tbody>
                                        @php
                                            $servicePrices = [];
                                            foreach($data['service_prices'] as $index => $servicePrice) {
                                                if($servicePrice['status'] == 1) {
                                                    $servicePrices[] = $servicePrice;
                                                }
                                            }
                                        @endphp
                                        @if(count($servicePrices) > 0)
                                            @foreach($servicePrices as $index => $servicePrice)
                                                <tr>
                                                    <td>
                                                        <div>
                                                            <img class="border img-service-price"
                                                                 src="{{ $servicePrice['avatar'] }}"
                                                                 style="width: 40px;height:40px;" alt="">
                                                            <label
                                                                class="btn btn-brand btn-elevate btn-icon-sm mb-0 btn-trigger-file">
                                                                <i class="la la-image p-0"></i>
                                                            </label>
                                                            <input accept="image/*" name="service_price[avatar][]"
                                                                   class="d-none service_price_avatar"
                                                                   type="file"/>
                                                            @php
                                                                $_avatar = explode('/',$servicePrice['avatar']);
                                                                $_avatar = end($_avatar);
                                                            @endphp
                                                            <input type="hidden" value="{{ $_avatar }}" name="service_price[avatar_old][]">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="service_price[name][]"
                                                               class="w-100 form-control rounded-0"
                                                               value="{{ $servicePrice['name'] }}">
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <input
                                                                <?php echo ($servicePrice['price_online_type'] == 'deal') ? 'readonly' : '' ?> type="number"
                                                                min="0" style="flex:1;"
                                                                name="service_price[price_online][]"
                                                                class="w-100 form-control rounded-0"
                                                                value="{{ $servicePrice['price_online'] }}">
                                                            <select style="flex:1;"
                                                                    class="form-control rounded-0 sl-price-online"
                                                                    name="service_price[price_online_type][]"
                                                                    >
                                                                <option
                                                                    value="price" <?php echo ($servicePrice['price_online_type'] == 'input') ? 'selected' : '' ?>>
                                                                    Giá
                                                                </option>
                                                                <option
                                                                    value="deal" <?php echo ($servicePrice['price_online_type'] == 'deal') ? 'selected' : '' ?>>
                                                                    Thoả thuận
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <input
                                                                <?php echo ($servicePrice['price_offline_type'] == 'deal') ? 'readonly' : '' ?> type="number"
                                                                min="0" style="flex:1;"
                                                                name="service_price[price_offline][]"
                                                                class="w-100 form-control rounded-0"
                                                                value="{{ $servicePrice['price_offline'] }}">
                                                            <select style="flex:1;"
                                                                    class="form-control rounded-0 sl-price-offline"
                                                                    name="service_price[price_offline_type][]"
                                                                    >
                                                                <option
                                                                    value="price" <?php echo ($servicePrice['price_offline_type'] == 'input') ? 'selected' : '' ?>>
                                                                    Giá
                                                                </option>
                                                                <option
                                                                    value="deal" <?php echo ($servicePrice['price_offline_type'] == 'deal') ? 'selected' : '' ?>>
                                                                    Thoả thuận
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="service_price[content][]"
                                                               class="w-100 form-control rounded-0"
                                                               value="{{ $servicePrice['content'] }}">
                                                    </td>
                                                    <td class="text-right">
                                                        @if(count($servicePrices) > 1 && $index == 0)
                                                            <button type="button"
                                                                    class="btn btn-sm btn-danger btn-remove-service-price"
                                                                    style="display:inline-block;"><i
                                                                    class="la la-trash m-0"></i>
                                                            </button>
                                                        @elseif($index === array_key_last($servicePrices))
                                                            <button type="button"
                                                                    class="btn btn-sm btn-danger btn-remove-service-price"
                                                                    style="display:none;"><i
                                                                    class="la la-trash m-0"></i>
                                                            </button>
                                                            <button type="button"
                                                                    class="btn btn-sm btn-success btn-add-service-price">
                                                                <i
                                                                    class="la la-plus m-0"></i></button>
                                                        @else
                                                            <button type="button"
                                                                    class="btn btn-sm btn-danger btn-remove-service-price"
                                                                    style="display:inline-block;"><i
                                                                    class="la la-trash m-0"></i>
                                                            </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <!-- <tr>
                                                <td>
                                                    <input type="text" name="service_price[name][]"
                                                           class="w-100 form-control rounded-0">
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <input type="number" min="0" style="flex:1;"
                                                               name="service_price[price_online][]"
                                                               class="w-100 form-control rounded-0">
                                                        <select style="flex:1;"
                                                                class="form-control rounded-0 sl-price-online"
                                                                name="service_price[price_online_type][]"
                                                                >
                                                            <option value="input" selected="selected">Giá</option>
                                                            <option value="deal">Thoả thuận</option>
                                                        </select>
                                                    </div>

                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <input type="number" min="0" style="flex:1;"
                                                               name="service_price[price_offline][]"
                                                               class="w-100 form-control rounded-0">
                                                        <select style="flex:1;"
                                                                class="form-control sl-price-offline rounded-0"
                                                                name="service_price[price_offline_type][]"
                                                                >
                                                            <option value="input" selected="selected">Giá</option>
                                                            <option value="deal">Thoả thuận</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" name="service_price[content][]"
                                                           class="w-100 form-control rounded-0">
                                                </td>
                                                <td class="text-right">
                                                    <button type="button"
                                                            class="btn btn-sm btn-danger btn-remove-service-price"
                                                            style="display:none;"><i class="la la-trash m-0"></i>
                                                    </button>
                                                    <button type="button"
                                                            class="btn btn-sm btn-success btn-add-service-price"><i
                                                            class="la la-plus m-0"></i></button>
                                                </td>
                                            </tr> -->
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group validated">
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
                                                        <img id="img-preview-avatar-source"
                                                             src="{{ $data['avatar'] }}"
                                                             class="img-fluid img-thumbnail mt-3"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group validated">
                                            <label>Ảnh bìa:</label>
                                            <div>
                                                <label for="file-upload-background"
                                                       class="btn btn-brand btn-elevate btn-icon-sm mb-0">
                                                    <i class="la la-image"></i> Chọn ảnh
                                                </label>
                                                <input id="file-upload-background" accept="image/*" class="d-none"
                                                       name="background"
                                                       type="file"/>
                                                @error('background')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                                <div class="row" id="img-preview-background">
                                                    <div class="col-lg-6">
                                                        <img id="img-preview-background-source"
                                                             src="{{ $data['background'] }}"
                                                             class="img-fluid img-thumbnail mt-3"/>
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
                                            @if($data['images'])
                                                <div class="row">
                                                    @foreach($data['images'] as $index => $image)
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
                                                                        <img id="img-preview-images-source-{{ $index }}" src="{{ $image }}"
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
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm">
                                    <i class="la la-save"></i>
                                    Sửa dịch vụ
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

            $(".kt-form").on('change', '.sl-price-online,.sl-price-offline', function () {
                console.log('123');
                var value = $(this).val();
                if (value == 'deal') {
                    $(this).prev().val('')
                    $(this).prev().attr('readonly', true);
                } else {
                    $(this).prev().attr('readonly', false);
                }
            });

            $('.kt-form').on('click', '.btn-remove-service-price', function () {
                $(this).parent('td').parent('tr').remove();
            });

            $('.kt-form').on('click', '.btn-add-service-price', function () {
                $(this).prev('button').show();
                $(this).remove();
                $("#table-service-price").append(`
                   <tr>
                                            <td>
                                                    <div>
                                                        <img class="border img-service-price" src="" style="width: 40px;height:40px;display: none;" alt="">
                                                        <label class="btn btn-brand btn-elevate btn-icon-sm mb-0 btn-trigger-file">
                                                            <i class="la la-image p-0"></i>
                                                        </label>
                                                        <input accept="image/*" name="service_price[avatar][]"
                                                               class="d-none service_price_avatar"
                                                               type="file"/>
                                                    </div>
                                            </td>
                                            <td>
                                                <input type="text" name="service_price[name][]" class="w-100 form-control rounded-0">
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                        <input type="number" min="0" style="flex:1;"
                                                               name="service_price[price_online][]"
                                                               class="w-100 form-control rounded-0">
                                                        <select style="flex:1;"
                                                                class="form-control rounded-0 sl-price-online" name="service_price[price_online_type][]"
                                                                >
                                                            <option value="price" selected="selected">Giá</option>
                                                            <option value="deal">Thoả thuận</option>
                                                        </select>
                                                    </div>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                        <input type="number" min="0" style="flex:1;"
                                                               name="service_price[price_offline][]"
                                                               class="w-100 form-control rounded-0">
                                                        <select style="flex:1;" class="form-control sl-price-offline rounded-0" name="service_price[price_offline_type][]"
                                                                >
                                                            <option value="price" selected="selected">Giá</option>
                                                            <option value="deal">Thoả thuận</option>
                                                        </select>
                                                    </div>
                                            </td>
                                            <td>
                                                <input type="text" name="service_price[content][]" class="w-100 form-control rounded-0">
                                            </td>
                                            <td class="text-right">
                                                <button type="button" class="btn btn-sm btn-danger btn-remove-service-price" style="display:none;"><i class="la la-trash m-0"></i></button>
                                                <button type="button" class="btn btn-sm btn-success btn-add-service-price"><i class="la la-plus m-0"></i></button>
                                            </td>
                                        </tr>
                `);
            });

            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

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

            $("#file-upload-avatar,#file-upload-background").change(function () {
                let name = $(this).attr('name');
                let elm = '#img-preview-' + name;
                readURL(this, elm);
            });

            function readURLSerivcePrice(input, elm) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        elm.attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

            $("#form-service").on('change', '.service_price_avatar', function () {
                var img = $(this).prev().prev(".img-service-price");
                img.show();
                readURLSerivcePrice(this, img);
            });

            $("#form-service").on('click', '.btn-trigger-file', function () {
                $(this).next().click();
            });

            $(".form-images").on('change', ".file-upload-multiple", function () {
                var index = $(this).parent().data('image-index');
                let elm = '#img-preview-images-' + index;
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
