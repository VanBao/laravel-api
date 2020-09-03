@extends('layouts.app',['page' => 'dashboard','text' => 'Dashboard'])
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <!--Begin::Row-->
        <div class="row">
            <div class="col-3">
                <div class="kt-portlet kt-portlet--fit kt-portlet--head-noborder bg-success">
                    <div class="kt-portlet__head kt-portlet__space-x">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title text-light">
                                Thu nhập
                            </h3>
                            <i class="la la-money icon-box" style="color:#ffffffb0;">

                            </i>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-widget20">
                            <div class="kt-widget20__content kt-portlet__space-x">
                                <span class="kt-widget20__number text-light">{{ number_format($statics['earnings']) }} VNĐ</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="kt-portlet kt-portlet--fit kt-portlet--head-noborder" style="background:#00AEFD;">
                    <div class="kt-portlet__head kt-portlet__space-x">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title text-light">
                                Chuyên mục
                            </h3>
                            <i class="la la-thumb-tack icon-box" style="color:#ffffffb0;">

                            </i>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-widget20">
                            <div class="kt-widget20__content kt-portlet__space-x">
                                <span class="kt-widget20__number text-light">{{ $statics['categories'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="kt-portlet kt-portlet--fit kt-portlet--head-noborder bg-warning position-relative">
                    <div class="kt-portlet__head kt-portlet__space-x">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title text-light">
                                Dịch vụ
                            </h3>
                            <i class="la la-mobile-phone icon-box" style="color:#ffffffb0;">

                            </i>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-widget20">
                            <div class="kt-widget20__content kt-portlet__space-x">
                                <span class="kt-widget20__number text-light">{{ $statics['services'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="kt-portlet kt-portlet--fit kt-portlet--head-noborder bg-light">
                    <div class="kt-portlet__head kt-portlet__space-x">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title text-dark">
                                Khách hàng
                            </h3>
                            <i class="la la-user icon-box" style="color:#00000087;">

                            </i>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-widget20">
                            <div class="kt-widget20__content kt-portlet__space-x">
                                <span class="kt-widget20__number text-dark">{{ $statics['users'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End::Row-->
        <!--Begin::Export Excel -->

        <!--End::Export Excel -->
        <div class="row">
            <div class="col-lg-12">

                <!--begin::Portlet-->
                <div class="kt-portlet kt-portlet--tab">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Thống kê doanh thu
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="kt-portlet__head-actions">
                                <div class="d-flex align-items-center justify-content-center flex-wrap">
                                    <label class="m-0 mr-3">Từ ngày : </label>
                                    <div class="mr-3">
                                        <input type="text" name="from" class="form-control datepicker_chart"
                                               value="{{ now()->startOfMonth()->format('d/m/Y') }}" readonly
                                               placeholder="Select date"/>
                                    </div>
                                    <label class="m-0 mr-3">Đến ngày : </label>
                                    <div class="mr-3">
                                        <input type="text" name="to" class="form-control datepicker_chart"
                                               value="{{ now()->endOfMonth()->format('d/m/Y') }}" readonly
                                               placeholder="Select date"/>
                                    </div>
                                    <label class="m-0 mr-3">Thu nhập từ kỹ thuật viên : </label>
                                    @if($staffs)
                                        <select class="form-control w-25 kt-select2" name="staff" id="kt_select2_1">
                                            <option></option>
                                            <option value="0">-- Không chọn --</option>
                                            @foreach($staffs as $staff)
                                                <option value="{{ $staff['id'] }}">{{ $staff['name'] }}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <label class="m-0 mr-3 text-muted">Không có kỹ thuật viên nào</label>
                                    @endif
                                    <button class="btn btn-sm btn-dark ml-3" id="btn-search-chart">Tìm kiếm</button>
                                    <button id="btn-export" class="btn btn-sm ml-3 btn-info btn-elevated">Export File</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body" id="kt_blockui_1_content">
                        <div id="revenue" style="height:500px;"></div>
                    </div>
                </div>

                <!--end::Portlet-->
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/select2.js') }}"></script>
    <script>
        var M = new Morris.Bar({
            element: 'revenue',
            data: @if(count(json_decode($chart,true)) > 0) {!! $chart !!} @else [
                { time:"Không có dữ liệu", price:0 }
            ] @endif,
            xkey: 'time',
            ykeys: ['price'],
            labels: ['Doanh thu'],
            barColors: ['#757576']
        });

        $(document).ready(function () {

            $('#kt_select2_1').select2({
                placeholder: "Chọn kỹ thuật viên"
            });

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
{{--            {{ route('admin.dashboard.export.booking') }}--}}
            $("#btn-search-chart").click(function () {
                var data = {
                    from: $("input[name=from]").val(),
                    to: $("input[name=to]").val(),
                    staff: $("select[name=staff]").length ? +$("select[name=staff]").val() : 0
                }
                if(data.staff === 0) data.staff = "";
                if (data.from && data.to) {
                    $.ajax({
                        url: '{{ route('admin.dashboard.chart') }}',
                        type: 'POST',
                        data: data,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        beforeSend: function () {
                            KTApp.block('#kt_blockui_1_content', {});
                        },
                        success: function (data) {
                           if (data) {
                                data = JSON.parse(data);
                                KTApp.unblock('#kt_blockui_1_content');
                                if(data.length === 0) {
                                    M.setData([
                                        { time:"Không có dữ liệu", price:0 }
                                    ]);
                                } else {
                                    M.setData(data);
                                }
                            }
                        },
                        error: function (err) {
                            toastr.error('Đã xảy ra lỗi !');
                        }
                    });
                }
            });

            $("#btn-export").click(function () {
                var data = {
                    from: $("input[name=from]").val(),
                    to: $("input[name=to]").val(),
                    staff: $("select[name=staff]").length ? +$("select[name=staff]").val() : 0
                }
                if(data.staff === 0) data.staff = "";
                if (data.from && data.to) {
                    $.ajax({
                        url: '{{ route('admin.dashboard.export.booking') }}',
                        type: 'POST',
                        data: data,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        beforeSend: function () {
                            KTApp.block('#kt_blockui_1_content', {});
                        },
                        success: function (data) {
                            if (data) {
                                KTApp.unblock('#kt_blockui_1_content');
                                window.location.replace(data);
                            }
                        },
                        error: function (err) {
                            toastr.error('Đã xảy ra lỗi !');
                        }
                    });
                }
            });

        {{--$(".select-type").click(function () {--}}
            {{--    $("#chart .kt-nav__item").removeClass("kt-nav__item--active");--}}
            {{--    $(this).parent().addClass("kt-nav__item--active");--}}
            {{--    var type = $(this).data('type');--}}
            {{--    if (type === 'month') {--}}
            {{--        $.ajax({--}}
            {{--            url: '{{ route('admin.dashboard.month') }}',--}}
            {{--            type: 'POST',--}}
            {{--            headers: {--}}
            {{--                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
            {{--            },--}}
            {{--            beforeSend: function () {--}}
            {{--                KTApp.block('#kt_blockui_1_content', {});--}}
            {{--            },--}}
            {{--            success: function (data) {--}}
            {{--                if (data) {--}}
            {{--                    KTApp.unblock('#kt_blockui_1_content');--}}
            {{--                    M.setData(JSON.parse(data));--}}
            {{--                }--}}
            {{--            },--}}
            {{--            error: function (err) {--}}
            {{--                toastr.error('Đã xảy ra lỗi !');--}}
            {{--            }--}}
            {{--        });--}}
            {{--    } else if (type === 'day') {--}}
            {{--        $.ajax({--}}
            {{--            url: '{{ route('admin.dashboard.day') }}',--}}
            {{--            type: 'POST',--}}
            {{--            headers: {--}}
            {{--                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
            {{--            },--}}
            {{--            beforeSend: function () {--}}
            {{--                KTApp.block('#kt_blockui_1_content', {});--}}
            {{--            },--}}
            {{--            success: function (data) {--}}
            {{--                if (data) {--}}
            {{--                    KTApp.unblock('#kt_blockui_1_content');--}}
            {{--                    M.setData(JSON.parse(data));--}}
            {{--                }--}}
            {{--            },--}}
            {{--            error: function (err) {--}}
            {{--                toastr.error('Đã xảy ra lỗi !');--}}
            {{--            }--}}
            {{--        });--}}
            {{--    } else if (type === 'option') {--}}
            {{--        $("#option").modal('show');--}}
            {{--    }--}}
            {{--});--}}
        });
    </script>
@endsection
