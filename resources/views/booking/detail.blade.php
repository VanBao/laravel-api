@extends('layouts.app',['page' => 'booking.detail','text' => 'Chi tiết đơn hàng : #' . $data['booking_code']])
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
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
            Khách huỷ
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

    @if(($status != 'create' || $status != 'cancel' || $status != 'reject') && $data['staff'])
        <i class="la la-circle"></i>
        <label class="ml-2">Người được giao việc : <a class="kt-font-bolder kt-font-dark"
                                                      href="{{ route('admin.user.edit',['id' => $data['staff']['id']]) }}">{{ $data['staff']['name'] }}</a></label>
    @endif


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
                            <span class="kt-portlet__head-icon">
													<i class="flaticon-statistics"></i>
												</span>
                            <h3 class="kt-portlet__head-title">
                                Chi tiết đơn hàng : <span class="kt-font-bolder">#{{ $data['booking_code'] }}</span>
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="kt-portlet__head-actions">
                                @if($data['booking_status'] == 'create')
                                    <button type="button" class="btn btn-brand btn-elevate btn-sm"
                                            data-toggle="modal"
                                            data-target="#job">
                                        Giao công việc
                                    </button>
                                    <button type="button" id="reject" class="btn btn-danger btn-elevate btn-sm">
                                        Từ chối đơn
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
                                        @if (session()->has('success'))
                                            <div class="alert alert-success rounded-0">
                                                <ul class="list-unstyled mb-0">
                                                    <li>{{ session()->get('success') }}</li>
                                                </ul>
                                            </div>
                                        @endif

                                        <div class="alert rounded-0 alert-secondary py-1 border" role="alert">
                                            <div class="alert-icon"><i
                                                    class="flaticon-statistics kt-font-brand"></i>
                                            </div>
                                            <div class="alert-text kt-font-bolder">
                                                Thông tin đơn hàng <span style="text-decoration: underline;">( Thời gian từ : {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data['time_from'])->format('d-m-Y') }} - tới : @if($data['time_to']) {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data['time_from'])->format('d-m-Y') }} @else
                                                        <em class="text-muted">Không có</em> @endif ) </span>
                                            </div>
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#kt_modal_4"
                                               class="text-dark d-flex align-items-center kt-font-bolder">
                                                <i class="flaticon2-pen mr-2"></i> Chỉnh sửa đơn hàng
                                            </a>
                                        </div>
                                        <div class="form-group">
                                            <label>Phương thức thanh toán:</label>
                                            <span
                                                class="kt-font-bolder">{{ $data['payment_method']['name'] }}</span>
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
                                                    {!! nl2br(htmlspecialchars($data['note'])) !!}
                                                </span>
                                            @else
                                                <em>Không có ghi chú</em>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Ghi chú của admin:</label>
                                            @if($data['admin_note'])
                                                <span class="kt-font-bolder">
                                                    {!! nl2br(htmlspecialchars($data['admin_note'])) !!}
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
                                            <label>Dịch vụ:</label>
                                            <a href="{{ route('admin.service.edit',['id' => $data['service']['id']]) }}"
                                               class="kt-font-bolder">{{ $data['service']['name'] }}</a>
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-3">Giá dịch vụ đã chọn:</label>
                                            <!--begin::Accordion-->
                                            <div class="accordion accordion-toggle-arrow" id="accordionExample4">
                                                @foreach($data['booking_services'] as $index => $booking_service)
                                                    @php $service_price = $booking_service['service_price'] @endphp
                                                    <div class="card">
                                                        <div class="card-header" id="headingTwo4">
                                                            <div
                                                                class="card-title kt-font-dark collapsed d-flex justify-content-between align-items-center"
                                                                style="font-weight: 400;"
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
                                                                            class="kt-font-bolder"> {{ $booking_service['type'] == 'offline' ? 'Tận nơi' : 'Online' }} <span
                                                                                class="text-muted kt-font-lighter"><em>( {{ $service_price['price_' . $booking_service['type'] .'_type'] == 'price' ? 'Giá' : 'Thoả thuận' }} )</em></span> </span>
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
                                                                <p class="mb-0">
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
                                                                @if($service_price['price_' . $booking_service['type'] .'_type'] == 'deal')
                                                                    <label class="mt-3">Cập nhật giá thoả
                                                                        thuận</label>
                                                                    <input type="text" class="form-control mb-2"
                                                                           name="price_deal_{{ $booking_service['id'] }}"
                                                                           value="{{ $booking_service['price'] ? $booking_service['price'] : 1000 }}">
                                                                    <button type="button"
                                                                            class="btn w-100 btn-success btn-elevate btn-sm btn-deal-save mt-2"
                                                                            data-id="{{ $booking_service['id'] }}">
                                                                        <i class="la la-save"></i>Lưu
                                                                    </button>
                                                                @endif
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
                                        <div class="alert rounded-0 alert-secondary py-1 border" role="alert">
                                            <div class="alert-icon"><i class="flaticon-user kt-font-brand"></i>
                                            </div>
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
                                            <span class="kt-font-bolder">{{ $data['customer_address'] }} {{isset($data['city']['name']) ? ', ' . $data['city']['name'] : ''}}</span>
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
    <!--begin::Modal-->
    <div class="modal fade modal-form" id="job" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Giao công việc</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group form-group-last">
                        <label class="d-block">Nhân viên : </label>
                        @if($staffs)
                            <select class="form-control kt-select2 w-100" id="kt_select2_1" name="staff">
                                @foreach($staffs as $staff)
                                    <option value="{{ $staff['id'] }}"
                                            @if($data['staff_id'] == $staff['id']) selected="selected" @endif>{{ $staff['name'] }}</option>
                                @endforeach
                            </select>
                        @else
                            <span class="text-muted"><em>Bạn chưa có nhân viên nào !</em></span>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" id="assign" class="btn btn-primary">Chấp thuận đơn hàng này và giao việc
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal-->

    <!--begin::Modal-->
    <div class="modal fade" id="kt_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa đơn hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="list-unstyled mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('admin.booking.update',['id' => $data['id']]) }}" method="POST" id="form">
                        @csrf
                        <div class="form-group">
                            <label class="form-control-label">Từ ngày</label>
                            <input type="text" name="time_from" class="form-control datepicker_chart"
                                   value="{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data['time_from'])->format('d/m/Y') }}"
                                   readonly
                                   placeholder="Select date"/>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Tới ngày</label>
                            @if($data['time_to'])
                                <input type="text" name="time_to" class="form-control datepicker_chart"
                                       value="{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data['time_to'])->format('d/m/Y') }}"
                                       readonly
                                       placeholder="Select date"/>
                            @else
                                <input type="text" name="time_to" class="form-control datepicker_chart"
                                       value=""
                                       readonly
                                       placeholder="Select date"/>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Tên khách hàng:</label>
                            <input type="text" class="form-control" name="customer_name"
                                   value="{{ $data['customer_name'] }}">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Email khách hàng:</label>
                            <input type="text" class="form-control" name="customer_email"
                                   value="{{ $data['customer_email'] }}">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Số điện thoại khách hàng:</label>
                            <input type="text" class="form-control" name="customer_phone"
                                   value="{{ $data['customer_phone'] }}">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Địa chỉ khách hàng:</label>
                            <input type="text" class="form-control" name="customer_address"
                                   value="{{ $data['customer_address'] }}">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Tỉnh/Thành phố:</label>
                            <select class="form-control" name="city">
                                @foreach($listCity as $city)
                                    <option @if($city['id'] == $data['city_id']) selected
                                            @endif value="{{ $city['id'] }}">{{$city['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Phương thức thanh toán:</label>
                            <select class="form-control" name="payment_method_id">
                                @foreach($payment_methods as $payment_method)
                                    <option @if($payment_method['id'] == $data['payment_method_id']) selected
                                            @endif value="{{ $payment_method['id'] }}">{{$payment_method['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Ghi chú từ khách hàng:</label>
                            <textarea class="form-control" name="note">{{ $data['note'] }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Chi phí phát sinh:</label>
                            <input type="text" class="form-control" name="costs_incurred"
                                   value="{{ $data['costs_incurred'] }}">
                        </div>
                        <div class="form-group form-group-last">
                            <label class="form-control-label">Ghi chú cho đơn hàng:</label>
                            <textarea type="text" class="form-control"
                                      name="admin_note">{{ $data['admin_note'] }}</textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" onclick="submit()">Lưu</button>
                </div>
            </div>
        </div>
    </div>

    <!--end::Modal-->
@endsection

@section('scripts')
    <!--begin::Page Scripts(used by this page) -->
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/select2.js') }}" type="text/javascript"></script>
    <!--end::Page Scripts -->
    <script src="{{ asset('assets/plugins/lightbox/js/lightbox.js') }}"></script>
    <script>

        function submit() {
            $("#form").submit();
        }

        $(document).ready(function () {

            @if ($errors->any())
            $("#kt_modal_4").modal('show');
                @endif
            var arrows = {
                    leftArrow: '<i class="la la-angle-left"></i>',
                    rightArrow: '<i class="la la-angle-right"></i>'
                };

            $('.datepicker_chart').datepicker({
                rtl: KTUtil.isRTL(),
                todayHighlight: true,
                orientation: "bottom left",
                templates: arrows,
                format: 'dd/mm/yyyy'
            });


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

            $(".btn-deal-save").click(function () {
                var id = $(this).data('id');
                var price = $("[name=price_deal_" + id + "]").val();
                $.ajax({
                    url: '{{ route('admin.booking.update-deal-price') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        booking_service_id: id,
                        price: price
                    },
                    success: function (data) {
                        if (data) {
                            swal.fire("Thành công !", "Cập nhật số tiền thoả thuận thành công !", "success").then(function () {
                                window.location.reload();
                            });
                        } else
                            swal.fire("Lỗi !", "Đã có lỗi xảy ra!", "error").then(function () {
                                window.location.reload();
                            });
                    },
                    error: function (err) {
                        swal.fire("Lỗi !", "Đã có lỗi xảy ra!", "error").then(function () {
                            window.location.reload();
                        });
                    }
                });
            });

            $("#assign").click(function () {
                var val = $("select[name=staff]").val();
                $.ajax({
                    url: '{{ route('admin.booking.assign') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        booking_id: {{ $data['id'] }},
                        staff_id: val
                    },
                    beforeSend: function () {
                        KTApp.block('#job .modal-content', {
                            type: 'loader',
                            state: 'success',
                            message: 'Đang thực hiện ...'
                        });
                    },
                    success: function (data) {
                        if (data) {
                            KTApp.unblock('#job .modal-content');
                            swal.fire("Thành công !", "Giao việc thành công !", "success").then(function () {
                                window.location.reload();
                            });
                        } else
                            swal.fire("Lỗi !", "Đã có lỗi xảy ra!", "error");
                    },
                    error: function (err) {
                        toastr.error('Đã có lỗi xảy ra !', err.responseJSON.message);
                    }
                });
            });

            $("#reject").click(function () {
                swal.fire({
                    title: 'Nhắc nhở !',
                    text: "Bạn có chắc muốn từ chối đơn này ?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Đồng ý !',
                    cancelButtonText: 'Đóng !',
                    reverseButtons: true
                }).then(function (result) {
                    if (result.value) {
                        $.ajax({
                            url: '{{ route('admin.booking.reject') }}',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'POST',
                            data: {booking_id: {{ $data['id'] }} },
                            success: function (data) {
                                if (data) {
                                    swal.fire("Thành công !", "Từ chối đơn thành công !", "success").then(function () {
                                        window.location.reload();
                                    });
                                } else
                                    swal.fire("Lỗi !", "Đã có lỗi xảy ra!", "error");
                            },
                            error: function (err) {
                                toastr.error('Đã có lỗi xảy ra !', err.responseJSON.message);
                            }
                        });
                    }
                });
            });

            $(".select-change-status").change(function () {
                var val = $(this).val();
                $.ajax({
                    url: '{{ route('admin.request-support.update',['id' => $data['id']]) }}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    data: {status: val},
                    success: function (data) {
                        if (data) toastr.success('Cập nhật trạng thái thành công !')
                        else toastr.error('Đã có lỗi xảy ra !');
                    },
                    error: function (err) {
                        toastr.error('Đã có lỗi xảy ra !', err.responseJSON.message);
                    }
                });
            });
            $('.select-change-status').select2({
                minimumResultsForSearch: -1,
                width: '150px'
            });
        });
    </script>
@endsection
