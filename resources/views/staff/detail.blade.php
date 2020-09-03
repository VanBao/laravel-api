@extends('layouts.app',['page' => 'staff.detail','text' => 'Chi tiết đơn hàng : #' . $data['booking_code']])
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/lightbox/css/lightbox.css') }}">
@endsection
@section('header-action')
    <div class="d-inline-block mr-2">
        <label class="mr-2">Trạng thái :</label>
        @php $status = $data['booking_status'] @endphp
        @if($status == 'create')
            <span class="kt-font-bolder kt-font-warning">
            Mới tạo
        </span>
        @elseif($status == 'accept')
            <span class="kt-font-bolder kt-font-primary">
            Chấp nhận
        </span>
        @elseif($status == 'processing')
            <span class="kt-font-bolder kt-font-warning">
            Đang xử lý
        </span>
        @elseif($status == 'cancel')
            <span class="kt-font-bolder kt-font-dark">
            Huỷ bỏ
        </span>
        @elseif($status == 'reject')
            <span class="kt-font-bolder kt-font-danger">
            Từ chối
        </span>
        @elseif($status == 'done')
            <span class="kt-font-bolder kt-font-success">
            Hoàn thành
        </span>
        @endif
    </div>

    {{--    <select class="select-change-status border-danger">--}}
    {{--        <option value="create" @if($data['status'] == 'create') selected @endif>Chưa xử lý</option>--}}
    {{--        <option value="answer" @if($data['status'] == 'answer') selected @endif>Đã xử lý</option>--}}
    {{--    </select>--}}
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
                                Chi tiết đơn hàng : <span class="kt-font-bolder">#{{ $data['booking_code'] }}</span>
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="kt-portlet__head-actions">
                                @if($data['booking_status'] == 'processing')
                                    <button type="button" id="done" class="btn btn-success btn-elevate btn-sm">
                                        Đã hoàn thành
                                    </button>
                                    <button type="button" id="cancel" class="btn btn-danger btn-elevate btn-sm">
                                        Huỷ bỏ
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="kt-portlet__body">
                        <div class="kt-section mb-0">
                            <div class="row">
                                <div class="col-8">
                                    <div class="p-3 border">

                                        <div class="alert alert-secondary py-1 border rounded-0" role="alert">
                                            <div class="alert-icon"><i class="flaticon-statistics kt-font-brand"></i>
                                            </div>
                                            <div class="alert-text kt-font-bolder">
                                                Thông tin đơn hàng <span style="text-decoration: underline;">( Thời gian từ : {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data['time_from'])->format('d-m-Y') }} - tới : @if($data['time_to']) {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data['time_from'])->format('d-m-Y') }} @else <em class="text-muted">Không có</em> @endif ) </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Phương thức thanh toán:</label>
                                            <span class="kt-font-bolder">{{ $data['payment_method']['name'] }}</span>
                                        </div>
                                        {{--<div class="form-group">
                                            <label>Mã giảm giá:</label>
                                            @if($data['discount_code'])
                                                <span class="kt-font-bolder">
                                                    {{ $data['discount_code'] }}
                                                </span>
                                            @else
                                                <em>Không sử dụng mã giảm giá</em>
                                            @endif
                                        </div>
                                        @if($data['discount_code'])
                                            <div class="form-group">
                                                <label>Số tiền được giảm:</label>
                                                <span class="kt-font-bolder">
                                                    {{ number_format($data['discount_price']) }} VNĐ
                                                </span>
                                            </div>
                                        @endif--}}
                                        <div class="form-group">
                                            <label>Ghi chú từ khách hàng:</label>
                                            @if($data['note'])
                                                <span class="kt-font-bolder">
                                                    {{ $data['note'] }}
                                                </span>
                                            @else
                                                <em>Không có ghi chú</em>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Ghi chú từ admin:</label>
                                            @if($data['admin_note'])
                                                <span class="kt-font-bolder">
                                                    {{ $data['admin_note'] }}
                                                </span>
                                            @else
                                                <em>Không có ghi chú</em>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Tổng tiền:</label>
                                            @if($data['costs_incurred'] > 0)
                                                <span
                                                    class="kt-font-bolder">{{ number_format($data['total_price']) }} + {{ number_format($data['costs_incurred']) }} = {{ number_format($data['total_price'] + $data['costs_incurred']) }} VNĐ</span>
                                            @else
                                                <span
                                                    class="kt-font-bolder">{{ number_format($data['total_price']) }} VNĐ</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Chi phí phát sinh thêm:</label>
                                            <span
                                                class="kt-font-bolder">{{ number_format($data['costs_incurred']) }} VNĐ</span>
                                        </div>
                                        <div class="form-group">
                                            <label>Số lượng:</label>
                                            <span class="kt-font-bolder">{{ $data['total_item'] }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-3">Dịch vụ đã chọn:</label>
                                            <!--begin::Accordion-->
                                            <div class="accordion  accordion-toggle-arrow" id="accordionExample4">
                                                @foreach($data['booking_services'] as $index => $booking_service)
                                                    @php $service_price = $booking_service['service_price'] @endphp
                                                    <div class="card">
                                                        <div class="card-header" id="headingTwo4">
                                                            <div
                                                                class="card-title kt-font-dark collapsed d-flex justify-content-between align-items-center"
                                                                data-toggle="collapse"
                                                                data-target="#collapseTwo{{$index}}"
                                                                aria-expanded="false"
                                                                aria-controls="collapseTwo4">
                                                                <div>
                                                                    <img src="{{ $service_price['avatar'] }}"
                                                                         class="img-thumbnail mr-2"
                                                                         style="width: 30px;height: 30px;" alt="">
                                                                    {{ $service_price['name'] }}
                                                                    <i class="la la-circle-thin mx-2"></i>
                                                                    <span>
                                                                        Số lượng : <span
                                                                            class="kt-font-bolder"> {{ $booking_service['quantity'] }} </span>
                                                                    </span>
                                                                    <i class="la la-circle-thin mx-2"></i>
                                                                    <span>
                                                                         Kiểu : <span
                                                                            class="kt-font-bolder"> {{ $booking_service['type'] == 'offline' ? 'Tận nơi' : 'Online' }} <span class="text-muted kt-font-lighter"><em>( {{ $service_price['price_' . $booking_service['type'] .'_type'] == 'price' ? 'Giá' : 'Thoả thuận' }} )</em></span> </span>
                                                                    </span>
                                                                </div>
                                                                <div>
                                                                    Số tiền :
                                                                    @if($service_price['price_' . $booking_service['type'] .'_type'] == 'price')
                                                                        {{ number_format($booking_service['price']) }}
                                                                        x {{ $booking_service['quantity'] }} = <span
                                                                            class="kt-font-bolder">
                                                                            {{ number_format($booking_service['price'] * $booking_service['quantity']) }}</span>
                                                                    @else
                                                                        <span class="kt-font-bolder">
                                                                        {{ number_format($booking_service['price']) }}
                                                                        </span>
                                                                    @endif
                                                                    VNĐ
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="collapseTwo{{$index}}" class="collapse"
                                                             aria-labelledby="headingTwo1"
                                                             data-parent="#accordionExample4">
                                                            <div class="card-body">
                                                                <p>Số lượng : <span
                                                                        class="kt-font-bolder"> {{ $booking_service['quantity'] }} </span>
                                                                </p>
                                                                <p>
                                                                    Số tiền :
                                                                    @if($service_price['price_' . $booking_service['type'] .'_type'] == 'price')
                                                                        {{ number_format($booking_service['price']) }}
                                                                        x {{ $booking_service['quantity'] }} = <span
                                                                            class="kt-font-bolder">
                                                                            {{ number_format($booking_service['price'] * $booking_service['quantity']) }}</span>
                                                                    @else
                                                                        <span class="kt-font-bolder">
                                                                        {{ number_format($booking_service['price']) }}
                                                                        </span>
                                                                    @endif
                                                                    VNĐ
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <!--end::Accordion-->
                                        </div>
                                        <div class="form-group form-group-last">
                                            <label>Hình ảnh từ khách hàng:</label>
                                            @if($data['images'])
                                                <div class="row">
                                                    @foreach($data['images'] as $index => $image)
                                                        <div class="col-4">
                                                            <a href="{{ $image }}" data-lightbox="images">
                                                                <img src="{{ $image }}"
                                                                     class="img-fluid img-thumbnail">
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <em>Không có hình ảnh</em>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="p-3 border">
                                        <div class="alert alert-secondary py-1 border rounded-0" role="alert">
                                            <div class="alert-icon"><i class="flaticon-user kt-font-brand"></i></div>
                                            <div class="alert-text kt-font-bolder">
                                                Thông tin khách hàng
                                            </div>
                                        </div>
                                        <div class="form-group validated">
                                            <label>Tên khách hàng:</label>
                                            <span class="kt-font-bolder">{{ $data['customer_name'] }}</span>
                                        </div>
                                        <div class="form-group validated">
                                            <label>Email khách hàng:</label>
                                            <span class="kt-font-bolder">{{ $data['customer_email'] }}</span>
                                        </div>
                                        <div class="form-group validated">
                                            <label>Số điện thoại khách hàng:</label>
                                            <span class="kt-font-bolder">{{ $data['customer_phone'] }}</span>
                                        </div>
                                        <div class="form-group validated form-group-last">
                                            <label>Địa chỉ khách hàng:</label>
                                            <span class="kt-font-bolder">{{ $data['customer_address'] }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <!--end::Portlet-->
            </div>
        </div>
        <!--End::Row-->
    </div>
@endsection

@section('scripts')
    <!--begin::Page Scripts(used by this page) -->
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/select2.js') }}" type="text/javascript"></script>
    <!--end::Page Scripts -->
    <script src="{{ asset('assets/plugins/lightbox/js/lightbox.js') }}"></script>
    <script>
        $(document).ready(function () {
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-bottom-right",
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

            $("#cancel").click(function () {
                $.ajax({
                    url: '{{ route('admin.staff.update') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        status: 'cancel',
                        id: {{ $data['id'] }}
                    },
                    success: function (data) {
                        if (data) {
                            swal.fire("Thành công !", "Cập nhật trạng thái thành công !", "success").then(function () {
                                window.location.reload();
                            });
                        } else
                            swal.fire("Lỗi !", "Đã có lỗi xảy ra!", "error");
                    },
                    error: function (err) {
                        swal.fire("Lỗi !", "Đã có lỗi xảy ra!", "error").then(function () {
                            window.location.reload();
                        });
                    }
                });
            });

            $("#done").click(function () {
                $.ajax({
                    url: '{{ route('admin.staff.update') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        status: 'done',
                        id: {{ $data['id'] }}
                    },
                    success: function (data) {
                        if (data) {
                            swal.fire("Thành công !", "Cập nhật trạng thái thành công !", "success").then(function () {
                                window.location.reload();
                            });
                        } else
                            swal.fire("Lỗi !", "Đã có lỗi xảy ra!", "error");
                    },
                    error: function (err) {
                        swal.fire("Lỗi !", "Đã có lỗi xảy ra!", "error").then(function () {
                            window.location.reload();
                        });
                    }
                });
            });
        });
    </script>
@endsection
