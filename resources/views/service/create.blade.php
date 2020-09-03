@extends('layouts.app',['page' => 'service.create','text' => 'Thêm dịch vụ'])
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
                                Thêm dịch vụ
                            </h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form class="kt-form" id="form-service" method="POST" action="{{ route('admin.service.store') }}"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="kt-portlet__body">
                            <div class="kt-section mb-0">
                                <div class="form-group validated">
                                    <label>Tên dịch vụ:</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           name="name" value="{{ old('name') }}">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group validated">
                                    <label>Nội dung:</label>
                                    <textarea class="form-control @error('summary') is-invalid @enderror" rows="8"
                                              name="summary">{{ old('summary') }}</textarea>
                                    @error('summary')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{--<div class="form-group validated">
                                    <label>Nội dung:</label>
                                    <textarea class="summernote @error('content') is-invalid @enderror"
                                              name="content">{{ old('content') }}</textarea>
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
                                                <option value="{{ $category['id'] }}">{{ $category['title'] }}</option>
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
                                    <label>Tỉnh thành hoạt động:</label>
                                    <select class="form-control kt-select2" id="kt_select2_3" name="cities[]"
                                            multiple="multiple">
                                        @foreach(config('city') as $city_id => $city)
                                            <option value="{{ $city_id }}">{{ $city['Title'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group validated">
                                    <label>Huyện hoạt động:</label>
                                    <select class="form-control kt-select2" id="kt-select2-district" name="districts[]"
                                            multiple="multiple">

                                        {{--@foreach(config('city') as $city_id => $city)
                                            <optgroup label="{{ $city['Title'] }}">
                                                @foreach($city['Districts'] as $district)
                                                    <option value="{{ $district['ID'] }}">{{ $district['Title'] }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach--}}
                                    </select>
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
                                        @if(old('service_price'))
                                            @foreach(old('service_price')['name'] as $index => $servicePriceName)
                                                @php
                                                    $servicePriceOnline = isset(old('service_price')['price_online'][$index]) ? old('service_price')['price_online'][$index] : null;
                                                    $servicePriceOnlineType = isset(old('service_price')['price_online_type'][$index]) ? old('service_price')['price_online_type'][$index] : null;
                                                    $servicePriceOffline = isset(old('service_price')['price_offline'][$index]) ? old('service_price')['price_offline'][$index] : null;
                                                    $servicePriceOfflineType = isset(old('service_price')['price_offline_type'][$index]) ? old('service_price')['price_offline_type'][$index] : null;
                                                    $servicePriceContent = isset(old('service_price')['content'][$index]) ? old('service_price')['content'][$index] : null;
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <div>
                                                            <img class="border img-service-price" src=""
                                                                 style="width: 40px;height:40px;display: none;" alt="">
                                                            <label
                                                                class="btn btn-brand btn-elevate btn-icon-sm mb-0 btn-trigger-file">
                                                                <i class="la la-image p-0"></i>
                                                            </label>
                                                            <input accept="image/*" name="service_price[avatar][]"
                                                                   class="d-none service_price_avatar"
                                                                   type="file"/>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="service_price[name][]"
                                                               class="w-100 form-control rounded-0"
                                                               value="{{ $servicePriceName }}">
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <input
                                                                <?php echo ($servicePriceOnlineType == 'deal') ? 'readonly' : '' ?> type="number"
                                                                min="0" style="flex:1;"
                                                                name="service_price[price_online][]"
                                                                class="w-100 form-control rounded-0"
                                                                value="{{ $servicePriceOnline }}">
                                                            <select style="flex:1;"
                                                                    class="form-control rounded-0 sl-price-online"
                                                                    name="service_price[price_online_type][]">
                                                                <option
                                                                    value="input" <?php echo ($servicePriceOnlineType == 'input') ? 'selected' : '' ?>>
                                                                    Giá
                                                                </option>
                                                                <option
                                                                    value="deal" <?php echo ($servicePriceOnlineType == 'deal') ? 'selected' : '' ?>>
                                                                    Thoả thuận
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <input
                                                                <?php echo ($servicePriceOfflineType == 'deal') ? 'readonly' : '' ?> type="number"
                                                                min="0" style="flex:1;"
                                                                name="service_price[price_online][]"
                                                                class="w-100 form-control rounded-0"
                                                                value="{{ $servicePriceOffline }}">
                                                            <select style="flex:1;"
                                                                    class="form-control rounded-0 sl-price-online"
                                                                    name="service_price[price_online_type][]">
                                                                <option
                                                                    value="input" <?php echo ($servicePriceOfflineType == 'input') ? 'selected' : '' ?>>
                                                                    Giá
                                                                </option>
                                                                <option
                                                                    value="deal" <?php echo ($servicePriceOfflineType == 'deal') ? 'selected' : '' ?>>
                                                                    Thoả thuận
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="service_price[content][]"
                                                               class="w-100 form-control rounded-0"
                                                               value="{{ $servicePriceContent }}">
                                                    </td>
                                                    <td class="text-right">
                                                        @if(count(old('service_price')['name']) > 1 && $index == 0)
                                                            <button type="button"
                                                                    class="btn btn-sm btn-danger btn-remove-service-price"
                                                                    style="display:inline-block;"><i
                                                                    class="la la-trash m-0"></i>
                                                            </button>
                                                        @elseif($index === array_key_last(old('service_price')['name']))
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
                                            <tr>
                                                <td>
                                                    <div>
                                                        <img class="border img-service-price" src=""
                                                             style="width: 40px;height:40px;display: none;" alt="">
                                                        <label
                                                            class="btn btn-brand btn-elevate btn-icon-sm mb-0 btn-trigger-file">
                                                            <i class="la la-image p-0"></i>
                                                        </label>
                                                        <input accept="image/*" name="service_price[avatar][]"
                                                               class="d-none service_price_avatar"
                                                               type="file"/>
                                                    </div>
                                                </td>
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
                                                        <select style="flex:1;"
                                                                class="form-control sl-price-offline rounded-0"
                                                                name="service_price[price_offline_type][]">
                                                            <option value="price" selected="selected">Giá</option>
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
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group validated">
                                            <label>Ảnh nền :</label>
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
                                    <div class="col-lg-6">
                                        <div class="form-group validated">
                                            <label>Ảnh đại diện:</label>
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
                                                <div class="row" id="img-preview-background" style="display: none;">
                                                    <div class="col-lg-6">
                                                        <img id="img-preview-background-source" src=""
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
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm">
                                    <i class="la la-plus"></i>
                                    Thêm dịch vụ
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
        var CITIES = {!! json_encode(config('city')) !!}
    </script>
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/select2.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $("#kt-select2-district").select2({
                placeholder: "Select a state"
            });
            ;
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

            function readURLSerivcePrice(input, elm) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        elm.attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

            function loadDistricts(cities) {
                console.log(cities);
                var options = '';
                for (let city of cities) {
                    for (let district in CITIES[city]['Districts']) {
                        district = CITIES[city]['Districts'][district];
                        options += '<option value="' + district['ID'] + '">'+ district['Title'] +'</option>';
                    }
                }
                return options;
            }

            $("#kt_select2_3").change(function () {
                $("#kt-select2-district").html(loadDistricts($(this).val()));
            });

            $("#file-upload-avatar,#file-upload-background").change(function () {
                let name = $(this).attr('name');
                let elm = '#img-preview-' + name;
                $(elm).show();
                readURL(this, elm);
            });

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
