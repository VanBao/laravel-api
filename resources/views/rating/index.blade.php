@extends('layouts.app',['page' => 'rating','text' => 'Danh sách đánh giá'])
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
                        Danh sách đánh giá
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">

                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                    <tr>
                        <th>Record ID</th>
                        <th>STT</th>
                        <th>Số sao</th>
                        <th>Người đánh giá</th>
                        <th>Kỹ thuật viên</th>
                        <th class="text-right">Thời gian</th>
                        <th width="10%" class="text-center">Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $index => $rating)
                        <tr @if($rating['is_read'] == 0) style="background: #fffada" @endif>
                            <td>{{ $rating->id }}</td>
                            <td>{{ ++$index }}</td>
                            <td>{{ $rating->rating }}</td>
                            <td><a href="{{ route('admin.user.edit',['id' => $rating['user']['id']]) }}" class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill kt-badge--rounded">{{ $rating['user']['name'] }}</a></td>
                            <td><a href="{{ route('admin.user.edit',['id' => $rating['booking']['staff']['id']]) }}" class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill kt-badge--rounded">{{ $rating['booking']['staff']['name'] }}</a></td>
                            <td class="text-right">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$rating['created_at'])->format('H:i:s d/m/Y') }}</td>
                            <td class="text-center">
                                <a title="Edit details"
                                   href="{{ route('admin.rating.detail',['id' => $rating->id]) }}"
                                   class="btn btn-sm btn-clean btn-icon btn-icon-md"> <i
                                        class="la la-search"></i> </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <!--end: Datatable -->
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/pages/crud/datatables/basic/basic.js') }}" type="text/javascript"></script>
@endsection