@extends('layouts.app',['page' => 'user.edit','text' => 'Sửa tài khoản'])
@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <!--Begin::Row-->
        <div class="row">
            <div class="col-xl-3"></div>
            <div class="col-lg-6">
                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Sửa tài khoản
                            </h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form class="kt-form" method="POST" action="{{ route('admin.user.update',['id' => $data['id']]) }}">
                        {{ csrf_field() }}
                        <div class="kt-portlet__body">
                            @if(session()->has('success'))
                                <div class="alert alert-solid-success alert-bold" role="alert">
                                    <div class="alert-text">{{ session()->get('success') }}</div>
                                </div>
                            @endif
                            <div class="kt-section mb-0">
                                <div class="form-group validated">
                                    <label>Tên tài khoản:</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           name="name" value="{{ $data['name'] }}">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group validated">
                                    <label>Email:</label>
                                    <input type="email" disabled class="form-control @error('email') is-invalid @enderror"
                                           name="email" value="{{ $data['email'] }}">
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group validated">
                                    <label>Mật khẩu:</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                           name="password">
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group validated">
                                    <label>Nhập lại mật khẩu:</label>
                                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                           name="password_confirmation">
                                    @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group validated">
                                    <label>Số điện thoại:</label>
                                    <input disabled type="text" class="form-control @error('phone') is-invalid @enderror"
                                           name="phone" value="{{ $data['phone'] }}">
                                    @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group validated">
                                    <label>Address:</label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror"
                                           name="address" value="{{ $data['address'] }}">
                                    @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group validated">
                                    <label>Tỉnh/thành:</label>
                                    @if($listCity)
                                        <select name="city"
                                                class="form-control @error('content') is-invalid @enderror">
                                            @foreach($listCity as $key => $city)
                                                <option value="{{$city->id}}" {{(old("city") && old("city") == $city->id) || $data['city_id'] == $city->id || $key == 0 ? 'selected' : ''}}>{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <p>Không có nhóm nào , ấn <a href="{{ route('admin.group.create') }}">vào đây</a> để tạo nhóm</p>
                                    @endif
                                    @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group validated form-group-last">
                                    <label>Nhóm:</label>
                                    @if($groups)
                                        <select name="group_id"
                                                class="form-control @error('content') is-invalid @enderror">
                                            @foreach($groups as $role)
                                                <option @if($role->id == $data['group_id']) selected @endif value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <p>Không có nhóm nào , ấn <a href="{{ route('admin.group.create') }}">vào đây</a> để tạo nhóm</p>
                                    @endif
                                    @error('group_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm">
                                    <i class="la la-save"></i>
                                    Sửa tài khoản
                                </button>
                            </div>
                        </div>
                    </form>

                    <!--end::Form-->
                </div>

                <!--end::Portlet-->
            </div>
            <div class="col-xl-3"></div>
        </div>
        <!--End::Row-->

    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/select2.js') }}" type="text/javascript"></script>
@endsection
