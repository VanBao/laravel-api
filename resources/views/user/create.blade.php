@extends('layouts.app',['page' => 'user.create','text' => 'Thêm tài khoản'])
@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <!--Begin::Row-->
        <div class="row">
            <div class="col-xl-3"></div>
            <div class="col-xl-6">
                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Thêm tài khoản
                            </h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form class="kt-form" method="POST" action="{{ route('admin.user.store') }}">
                        {{ csrf_field() }}
                        <div class="kt-portlet__body">
                            <div class="kt-section mb-0">
                                <div class="form-group validated">
                                    <label>Tên tài khoản:</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           name="name" value="{{ old('name') }}">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group validated">
                                    <label>Email:</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                           name="email" value="{{ old('email') }}">
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
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                           name="phone" value="{{ old('phone') }}">
                                    @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group validated">
                                    <label>Address:</label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror"
                                           name="address" value="{{ old('address') }}">
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
                                                <option value="{{$city->id}}" {{(old("city") && old("city") == $city->id) || $key == 0 ? 'selected' : ''}}>{{ $city->name }}</option>
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
                                                <option @if($role->id == old('group_id')) selected @endif value="{{ $role->id }}">{{ $role->name }}</option>
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
                                    <i class="la la-plus"></i>
                                    Thêm tài khoản
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
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
