@extends('layouts.app',['page' => 'ranking','text' => 'Bảng xếp hạng'])
@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
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
                                                        fill="#000000" opacity="0.3"/>
												</g>
											</svg>
										</span>
                    <h3 class="kt-portlet__head-title">
                        Bảng xếp hạng
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="tab-content">
                    <div class="tab-pane active" id="kt_widget31_tab1_content">
                        <div class="kt-widget31">
                            @if($data)
                                @foreach($data as $index => $staff)
                                    @if($staff['score'] > 0)
                                        <div class="kt-widget31__item">
                                            <div class="kt-widget31__content">
                                                <div class="kt-widget31__pic">
                                                    <img src="{{ asset('assets/media/users/default.jpg') }}" alt="">
                                                </div>
                                                <div class="kt-widget31__info">
                                                    <a href="{{ route('admin.user.edit',['id' => $staff['id']]) }}"
                                                       class="kt-widget31__username">
                                                        {{ $staff['name'] }}
                                                    </a>
                                                    <p class="kt-widget31__text">
                                                        SĐT : {{ $staff['phone'] }}
                                                    </p>
                                                    <p class="kt-widget31__text">
                                                        Số đơn hoàn thành : {{ $staff['booking_times'] }}
                                                    </p>
                                                    <p class="kt-widget31__text">
                                                        Thu nhập : <span class="kt-font-bolder">{{ number_format($staff['total']) }}</span> VNĐ
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="kt-widget31__content">
                                                @php
                                                    $progress =  $staff['score'] * 100 / 5;
                                                @endphp
                                                <div class="kt-widget31__progress">
                                                    Số sao : {{ round($staff['score'],1) }}
                                                </div>
                                                <button type="button"
                                                        class="btn btn-light border btn-circle btn-icon">{{ ++$index }}</button>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <p class="text-muted m-0 text-center">Chưa có dữ liệu</p>
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane" id="kt_widget31_tab2_content">
                        <div class="kt-widget31">
                            <div class="kt-widget31__item">
                                <div class="kt-widget31__content">
                                    <div class="kt-widget31__pic kt-widget4__pic--pic">
                                        <img src="assets/media/users/100_11.jpg" alt="">
                                    </div>
                                    <div class="kt-widget31__info">
                                        <a href="#" class="kt-widget31__username">
                                            Nick Bold
                                        </a>
                                        <p class="kt-widget31__text">
                                            Web Developer, Facebook Inc
                                        </p>
                                    </div>
                                </div>
                                <div class="kt-widget31__content">
                                    <div class="kt-widget31__progress">
                                        <a href="#" class="kt-widget31__stats">
                                            <span>13%</span>
                                            <span>London</span>
                                        </a>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 35%"
                                                 aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <a href="#" class="btn-label-brand btn btn-sm btn-bold">Follow</a>
                                </div>
                            </div>
                            <div class="kt-widget31__item">
                                <div class="kt-widget31__content">
                                    <div class="kt-widget31__pic kt-widget4__pic--pic">
                                        <img src="assets/media/users/100_1.jpg" alt="">
                                    </div>
                                    <div class="kt-widget31__info">
                                        <a href="#" class="kt-widget31__username">
                                            Wiltor Delton
                                        </a>
                                        <p class="kt-widget31__text">
                                            Project Manager, Amazon Inc
                                        </p>
                                    </div>
                                </div>
                                <div class="kt-widget31__content">
                                    <div class="kt-widget31__progress">
                                        <div class="kt-widget31__stats">
                                            <span>93%</span>
                                            <span>New York</span>
                                        </div>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 45%"
                                                 aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <a href="#" class="btn-label-brand btn btn-sm btn-bold">Follow</a>
                                </div>
                            </div>
                            <div class="kt-widget31__item">
                                <div class="kt-widget31__content">
                                    <div class="kt-widget31__pic">
                                        <img src="assets/media/users/100_14.jpg" alt="">
                                    </div>
                                    <div class="kt-widget31__info">
                                        <a href="#" class="kt-widget31__username">
                                            Milano Esco
                                        </a>
                                        <p class="kt-widget31__text">
                                            Product Designer, Apple Inc
                                        </p>
                                    </div>
                                </div>
                                <div class="kt-widget31__content">
                                    <div class="kt-widget31__progress">
                                        <a href="#" class="kt-widget31__stats">
                                            <span>33%</span>
                                            <span>Paris</span>
                                        </a>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 55%"
                                                 aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <a href="#" class="btn-label-brand btn btn-sm btn-bold">Follow</a>
                                </div>
                            </div>
                            <div class="kt-widget31__item">
                                <div class="kt-widget31__content">
                                    <div class="kt-widget31__pic">
                                        <img src="assets/media/users/100_6.jpg" alt="">
                                    </div>
                                    <div class="kt-widget31__info">
                                        <a href="#" class="kt-widget31__username">
                                            Sam Stone
                                        </a>
                                        <p class="kt-widget31__text">
                                            Project Manager, Kilpo Inc
                                        </p>
                                    </div>
                                </div>
                                <div class="kt-widget31__content">
                                    <div class="kt-widget31__progress">
                                        <div class="kt-widget31__stats">
                                            <span>50%</span>
                                            <span>New York</span>
                                        </div>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 65%"
                                                 aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <a href="#" class="btn-label-brand btn btn-sm btn-bold">Follow</a>
                                </div>
                            </div>
                            <div class="kt-widget31__item">
                                <div class="kt-widget31__content">
                                    <div class="kt-widget31__pic">
                                        <img src="assets/media/users/100_4.jpg" alt="">
                                    </div>
                                    <div class="kt-widget31__info">
                                        <a href="#" class="kt-widget31__username">
                                            Anna Strong
                                        </a>
                                        <p class="kt-widget31__text">
                                            Visual Designer,Google Inc
                                        </p>
                                    </div>
                                </div>
                                <div class="kt-widget31__content">
                                    <div class="kt-widget31__progress">
                                        <a href="#" class="kt-widget31__stats">
                                            <span>63%</span>
                                            <span>London</span>
                                        </a>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-brand" role="progressbar" style="width: 75%"
                                                 aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <a href="#" class="btn-label-brand btn btn-sm btn-bold">Follow</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/pages/dashboard.js') }}" type="text/javascript"></script>
@endsection
