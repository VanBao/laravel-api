@extends('layouts.app',['page' => 'staff','text' => 'Trang quản lý của kỹ thuật viên'])
@section('content')
    <div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet kt-portlet--tabs">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
											<svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                                 width="24px" height="24px" viewBox="0 0 24 24"
                                                 version="1.1" class="kt-svg-icon">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"/>
													<rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"/>
													<path
                                                        d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
                                                        fill="#000000" opacity="0.3"/>s
												</g>
											</svg>
										</span>
                        <h3 class="kt-portlet__head-title">
                            Trang quản lý của kỹ thuật viên
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-right" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#kt_portlet_base_demo_1_tab_content"
                                   role="tab">
                                    <i class="flaticon-suitcase"></i> Công Việc
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_portlet_base_demo_2_tab_content"
                                   role="tab">
                                    <i class="flaticon-comment"></i> Chat với khách hàng
                                </a>
                            </li>
                            {{--                            <li class="nav-item">--}}
                            {{--                                <a class="nav-link" data-toggle="tab" href="#kt_portlet_base_demo_3_tab_content"--}}
                            {{--                                   role="tab">--}}
                            {{--                                    <i class="flaticon-lifebuoy"></i> Logs--}}
                            {{--                                </a>--}}
                            {{--                            </li>--}}
                        </ul>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="kt_portlet_base_demo_1_tab_content" role="tabpanel">
                            <div class="kt-portlet__body kt-portlet__body--fit-x pt-0">
                                <!--begin: Search Form -->
                                <div class="kt-form kt-form--label-right">
                                    <div class="row align-items-center">
                                        <div class="col-xl-8 order-2 order-xl-1">
                                            <div class="row align-items-center">
                                                <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                                    <div class="kt-input-icon kt-input-icon--left">
                                                        <input type="text" class="form-control"
                                                               placeholder="Tìm kiếm"
                                                               id="generalSearch">
                                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
										    <span><i class="la la-search"></i></span>
										</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                                    <div class="kt-form__group kt-form__group--inline">
                                                        <div class="kt-form__label">
                                                            <label>Trạng thái:</label>
                                                        </div>
                                                        <div class="kt-form__control">
                                                            <select class="form-control bootstrap-select"
                                                                    id="kt_form_status">
                                                                <option value="">Tất cả</option>
                                                                <option value="create">Mới tạo</option>
                                                                <option value="processing">Đang xử lý</option>
                                                                <option value="reject">Từ chối</option>
                                                                <option value="cancel">Huỷ</option>
                                                                <option value="done">Hoàn thành</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!--end: Search Form -->
                            </div>
                            <div class="kt-portlet__body kt-portlet__body--fit">

                                <!--begin: Datatable -->
                                <div class="kt-datatable" id="ajax_data"></div>

                                <!--end: Datatable -->
                            </div>
                        </div>
                        <div class="tab-pane" id="kt_portlet_base_demo_2_tab_content" role="tabpanel">
                            <!--Begin::App-->
                            <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">

                                <!--Begin:: App Aside Mobile Toggle-->
                                <button class="kt-app__aside-close" id="kt_chat_aside_close">
                                    <i class="la la-close"></i>
                                </button>

                                <!--End:: App Aside Mobile Toggle-->

                                <!--Begin:: App Aside-->
                                <div
                                    class="kt-grid__item kt-app__toggle kt-app__aside kt-app__aside--lg kt-app__aside--fit"
                                    id="kt_chat_aside">

                                    <!--begin::Portlet-->
                                    <div class="kt-portlet kt-portlet--last">
                                        <div class="kt-portlet__body">
                                            <div class="kt-widget kt-widget--users">
                                                <div class="kt-scroll kt-scroll--pull">
                                                    <div class="kt-widget__items">
                                                        {{--                                                        @dump($chat->toArray())--}}
                                                        @php
                                                            $stt = 0;
                                                            $current_booking_id = 0;
                                                        @endphp
                                                        @if(count($chat) > 0)
                                                            @foreach($chat as $item)
                                                                @if($stt == 0) @php $current_booking_id = $item['id'] @endphp @endif
                                                                <div
                                                                    class="kt-widget__item p-3 @if($stt == 0) bg-secondary @endif">
                                                                    @php
                                                                        $stt++;
                                                                        $totalMessage = collect($item['messages'])->where('is_read',0)->where('from_type','user')->count();
                                                                    @endphp
                                                                    <span class="kt-media kt-media--circle">
																<img src="{{ $item['user']['avatar'] }}" alt="image">
															</span>
                                                                    <div class="kt-widget__info">
                                                                        <div class="kt-widget__section">
                                                                            <a href="javascript:void(0);"
                                                                               data-booking-id="{{ $item['id'] }}"
                                                                               class="kt-widget__username">{{ $item['user']['name'] }}</a>
                                                                            @if($totalMessage > 0)
                                                                                <span
                                                                                    class="kt-badge kt-badge--primary kt-badge--dot"></span>
                                                                            @endif

                                                                        </div>
                                                                        <span class="kt-widget__desc">
																	Đơn hàng: #{{ $item['booking_code'] }}
																</span>
                                                                    </div>
                                                                    <div class="kt-widget__action">
                                                                        @if($totalMessage > 0)
                                                                            <span
                                                                                class="kt-badge kt-badge--primary kt-font-bold">{{ $totalMessage }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                            @endforeach
                                                        @else
                                                            <p>Không có tin nhắn nào</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--end::Portlet-->
                                </div>

                                <!--End:: App Aside-->

                                <!--Begin:: App Content-->
                                <div class="kt-grid__item kt-grid__item--fluid kt-app__content" id="kt_chat_content">
                                    <div class="kt-chat">
                                        <div class="kt-portlet kt-portlet--head-lg- kt-portlet--last">
                                            <div class="kt-portlet__head">
                                                <div class="kt-chat__head ">
                                                    <div class="kt-chat__left">

                                                        <!--begin:: Aside Mobile Toggle -->
                                                        <button type="button"
                                                                class="btn btn-clean btn-sm btn-icon btn-icon-md kt-hidden-desktop"
                                                                id="kt_chat_aside_mobile_toggle">
                                                            <i class="flaticon2-open-text-book"></i>
                                                        </button>

                                                        <!--end:: Aside Mobile Toggle-->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-portlet__body" data-booking-id="{{ $current_booking_id }}">
                                                <div class="kt-scroll kt-scroll--pull" data-mobile-height="300">
                                                    <div class="kt-chat__messages">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-portlet__foot">
                                                <div class="kt-chat__input">
                                                    <div>
                                                        <div class="img-preview mb-3 " style="display: none;">
                                                            <div class="position-relative d-inline-block">
                                                                <img src="" id="img-preview-tag"
                                                                     style="width: 65px;height: 65px"
                                                                     class="img-thumbnail">
                                                                <i class="la la-remove text-danger position-absolute"
                                                                   id="remove-image"
                                                                   style="top: 0;right: 0;cursor:pointer; background: rgba(255,255,255,0.5); padding: 5px;"></i>
                                                            </div>
                                                        </div>
                                                        <div class="kt-chat__editor">
                                                            <textarea style="height: 50px"
                                                                      placeholder="Nội dung tin nhắn ..."
                                                                      name="message"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="kt-chat__toolbar">
                                                        <div class="kt_chat__tools">
                                                            <a href="javascript:void(0);" id="choose_image"><i
                                                                    class="flaticon2-photograph"></i></a>
                                                            <input type="file" class="d-none" name="image">
                                                        </div>
                                                        <div class="kt_chat__actions">
                                                            <button type="button"
                                                                    class="btn btn-brand btn-md btn-upper btn-bold"
                                                                    id="send-message">
                                                                Trả lời
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--End:: App Content-->
                            </div>
                            <!--End::App-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('pre_scripts')
    <script type="text/javascript">
        var KTDB_URL = '{{ route('admin.staff.pagination') }}';
        var DETAIL_URL = '{{ route('admin.staff.detail',':id') }}';
        var KTDB_COLUMNS = [
            {
                field: 'booking_code',
                title: 'Mã đơn hàng',
                template: function (data) {
                    return '#' + data.booking_code;
                },
            }, {
                field: 'customer_name',
                title: 'Tên khách hàng'
            },
            {
                field: 'customer_phone',
                title: 'SĐT',
            },
            {
                field: 'booking_status',
                title: 'Trạng thái',
                template: function (data, index) {
                    var status = '#ffffff';
                    var statusText = '';
                    if (data.booking_status === 'create') {
                        status = '#ffefb5ad';
                        statusText = 'mới tạo';
                    } else if (data.booking_status === 'processing') {
                        status = '#a2b6ffdb';
                        statusText = 'đang xử lý';
                    } else if (data.booking_status === 'cancel') {
                        status = '#ff9999f0';
                        statusText = 'huỷ';
                    } else if (data.booking_status === 'done') {
                        status = '#c0ffc0d9';
                        statusText = 'hoàn thành'
                    } else if (data.booking_status === 'reject') {
                        status = '#ff4242cf';
                        statusText = 'từ chối';
                    }
                    $('[data-row=' + index + '] [data-field="booking_code"]').css('border-left', '5px solid ' + status);
                    return '\
						<span class="kt-badge kt-badge--inline kt-badge--pill kt-badge--rounded" style="background-color: ' + status + ' ">' + statusText + '</span>\
					';
                },
            },
            {
                field: 'created_at',
                title: 'Tạo lúc',
            },
            {
                field: 'actions',
                title: 'Hành động',
                sortable: false,
                width: 110,
                overflow: 'visible',
                autoHide: false,
                class: 'text-right',
                template: function (data) {
                    return '\
						<a href="' + DETAIL_URL.replace(':id', data.id) + '" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Edit details">\
							<i class="flaticon-search"></i>\
						</a>\
					';
                },
            }
        ];
    </script>
@endsection

@section('scripts')
    <script>
        var PAGE_LENGTH = 50;
        var CURRENT_BOOKING_ID = {{ $current_booking_id }};
        var AUTH_ID = {{ auth()->user()->id }};
    </script>
    <!--begin::Page Scripts(used by this page) -->
    <script src="{{ asset('assets/js/pages/crud/metronic-datatable/base/data-ajax.js') }}"
            type="text/javascript"></script>
    <!--end::Page Scripts -->
    <script src="{{ asset('assets/js/pages/custom/chat/chat.js') }}" type="text/javascript"></script>
    <script>
        function xhtmlMessage({time, message}, type, isImage = false) {
            var messageCls = '';
            var messageBg = 'bg-primary text-white';
            if (type !== 'user') {
                messageCls = 'kt-chat__message--right';
                messageBg = 'bg-light';
            }
            if (!isImage)
                return `<div class="kt-chat__message ${messageCls}">
                <div class="kt-chat__user">
            <span class="kt-chat__datetime">${time}</span>
            </div>
            <div class="kt-chat__text p-1 px-2 text-center ${messageBg}">
                ${message}
            </div>
            </div>`;
            else
                return `<div class="kt-chat__message ${messageCls}">
                <div class="kt-chat__user">
            <span class="kt-chat__datetime">${time}</span>
            </div>
            <div class="kt-chat__text ${messageBg} p-1">
                <img style="width:300px;height:300px;" class="img-fluid img-thumbnail" src="${message}" alt="">
            </div>
            </div>`;
        }

        OneSignal.push(function () {
            OneSignal.on('notificationDisplay', function (event) {
                if (typeof event.data !== 'undefined' && typeof event.data.type !== 'undefined') {
                    var isImage = event.data.type === 'image' ? true : false;
                    var xhtml = xhtmlMessage({
                        time: event.data.time,
                        message: event.data.message
                    }, 'user', isImage);
                    var id = $('.kt-chat .kt-portlet__body').data('booking-id');
                    $(".kt-chat .kt-portlet__body[data-booking-id=" + event.data.booking_id + "] .kt-chat__messages").append(xhtml);
                    $(".kt-chat .kt-scroll").scrollTop($(".kt-chat__messages").height());
                }

            });
        });

        function sendMessage(message, type) {
            $.ajax({
                url: '{{ route('admin.chat.send-message') }}',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    message: message,
                    type: type,
                    booking_id: CURRENT_BOOKING_ID
                },
                beforeSend: function () {
                    KTApp.block('.kt-chat .kt-portlet__body', {});
                },
                success: function (response) {
                    if (response) {
                        var isImage = type === 'image' ? true : false;
                        KTApp.unblock('.kt-chat .kt-portlet__body');
                        $(".kt-chat__messages").append(xhtmlMessage({
                            message: response.message,
                            time: response.time,
                        }, 'mine', isImage));
                        $(".kt-chat .kt-scroll").scrollTop($(".kt-chat__messages").height());
                        setTimeout(function () {
                            $(".kt-chat .kt-scroll").stop().animate({scrollTop: 0}, 100, 'swing', function () {
                                $(".kt-chat .kt-scroll").scrollTop($(".kt-chat__messages").height());
                            });
                        }, 100);
                        if (type === 'image') {
                            $(".img-preview").hide();
                            $("#img-preview-tag").attr('src', null);
                            $('input[name=image]').val(null);
                        }
                        if (type === 'text') {
                            $("textarea[name=message]").val(null);
                        }
                    }
                },
                error: function () {
                    toastr.error('Lỗi !', 'Đã có lỗi xảy ra khi gửi tin nhắn !');
                }
                // beforeSend
            });
        }

        function readAll(id) {
            $.ajax({
                url: '{{ route('admin.chat.read-all') }}',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    booking_id: id
                },
                success: function (response) {
                    if (response) {
                        $(".kt-widget__username[data-booking-id=" + id + "]").parent().parent().parent().find(".kt-widget__action").find('.kt-badge').remove();
                        $(".kt-widget__username[data-booking-id=" + id + "]").next().remove();
                    }
                }
            });
        }

        function loadMessages(id = null) {
            if (id !== 0) {
                CURRENT_BOOKING_ID = id;
                $.ajax({
                    url: '{{ route('admin.chat.load-messages') }}',
                    type: 'GET',
                    data: {
                        booking_id: id
                    },
                    beforeSend: function () {
                        // kt-portlet__body
                        KTApp.block('.kt-chat .kt-portlet__body', {});
                    },
                    success: function (response) {
                        console.log('res', response);
                        var xhtml = '';
                        KTApp.unblock('.kt-chat .kt-portlet__body');
                        for (let item of response) {
                            var type_ = item.from_type === 'staff' || item.from_type === 'admin' ? 'mine' : 'user';
                            var type = item.type === 'image' ? true : false;
                            if (type_ === 'user') {
                                xhtml += xhtmlMessage({
                                    message: item.message,
                                    time: item.created_at
                                }, type_, type);
                            } else {
                                xhtml += xhtmlMessage({
                                    message: item.message,
                                    time: item.created_at
                                }, type_, type);
                            }
                        }
                        $(".kt-chat__messages").append(xhtml);
                        $(".kt-chat .kt-scroll").scrollTop($(".kt-chat__messages").height());
                        setTimeout(function () {
                            $(".kt-chat .kt-scroll").stop().animate({scrollTop: 0}, 100, 'swing', function () {
                                $(".kt-chat .kt-scroll").scrollTop($(".kt-chat__messages").height());
                            });
                        }, 100);
                    }
                });
            }
        }

        $(document).ready(function () {

            loadMessages(CURRENT_BOOKING_ID);

            KTUtil.ready(function () {
                KTAppChat.init();
            });

            $("textarea[name=message]").click(function () {
                readAll(CURRENT_BOOKING_ID);
            });

            $("textarea[name=message]").keydown(function (e) {
                if (e.which === 13) {
                    var image = $('input[name=image]').val();
                    var text = $("textarea[name=message]").val();
                    if (image) {
                        data = new FormData();
                        data.append('image', $('input[name=image]')[0].files[0]);
                        $.ajax({
                            url: '{{ route('admin.chat.upload-image') }}',
                            data: data,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            processData: false,
                            contentType: false,
                            type: 'POST',
                            success: function (data) {
                                sendMessage(data, 'image');
                            }
                        });
                    }
                    if (text) {
                        console.log('text');
                        sendMessage(text, 'text');
                    }
                }
            });

            $("#send-message").click(function () {
                var image = $('input[name=image]').val();
                var text = $("textarea[name=message]").val();
                if (image) {
                    data = new FormData();
                    data.append('image', $('input[name=image]')[0].files[0]);
                    $.ajax({
                        url: '{{ route('admin.chat.upload-image') }}',
                        data: data,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        processData: false,
                        contentType: false,
                        type: 'POST',
                        success: function (data) {
                            sendMessage(data, 'image');
                        }
                    });
                }
                if (text) {
                    console.log('text');
                    sendMessage(text, 'text');
                }
            });

            $("#remove-image").click(function () {
                $(".img-preview").hide();
                $("#img-preview-tag").attr('src', null);
                $('input[name=image]').val(null);
            });

            $(".kt-widget__username").click(function () {
                $(".kt-chat__messages").html("");
                var booking_id = $(this).data('booking-id');
                loadMessages(booking_id);
                readAll(booking_id);
                $(".kt-widget__item").removeClass('bg-secondary');
                $(this).parent().parent().parent().addClass('bg-secondary');
                $('.kt-chat .kt-portlet__body').attr('data-booking-id', booking_id);
                $(".kt-chat .kt-scroll").scrollTop($(".kt-chat__messages").height());
                setTimeout(function () {
                    $(".kt-chat .kt-scroll").stop().animate({scrollTop: 0}, 100, 'swing', function () {
                        $(".kt-chat .kt-scroll").scrollTop($(".kt-chat__messages").height());
                    });
                }, 100);
                // kt-scroll
            });

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $("#img-preview-tag").attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

            $("#choose_image").click(function () {
                $(this).next('input[name=image]').click();
            });

            $("input[name=image]").change(function () {
                $(".img-preview").show();
                readURL(this);
                var val = $('input[name=image]').val();
                if (!val) {
                    $(".img-preview").hide();
                    $("#img-preview-tag").attr('src', null);
                    $('input[name=image]').val(null);
                } else {
                    $("textarea[name=message]").focus();
                }
            });

            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                KTUtil.ready(function () {
                    KTAppChat.init();
                    $(".kt-chat .kt-scroll").scrollTop($(".kt-chat__messages").height());
                    setTimeout(function () {
                        $(".kt-chat .kt-scroll").stop().animate({scrollTop: 0}, 100, 'swing', function () {
                            $(".kt-chat .kt-scroll").scrollTop($(".kt-chat__messages").height());
                        });
                    }, 100);
                });
            })
        });
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function () {

            $('#kt_form_status').on('change', function () {
                datatable.search($(this).val().toLowerCase(), 'status');
            });

            $('#kt_form_type').on('change', function () {
                datatable.search($(this).val().toLowerCase(), 'Type');
            });

            $('#kt_form_status,#kt_form_type,#kt_form_action').selectpicker();
        });
    </script>
@endsection
