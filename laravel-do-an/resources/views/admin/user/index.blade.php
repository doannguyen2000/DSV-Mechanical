@extends('layouts.master')
@section('style-libraries')
    
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/js.js') }}"></script>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="col-lg-12 
-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Danh sách tài khoản</h4>
                    </p>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th> ID </th>
                                    <th> Hình đại diện </th>
                                    <th> Tên </th>
                                    <th> Tên tài khoản </th>
                                    <th> Trạng thái </th>
                                    <th> Kích hoạt </th>
                                    <th> Quyền </th>
                                    <th> </th>
                                </tr>
                            </thead>
                            @isset($users)
                                @foreach ($users as $user)
                                    <tbody>
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td class="py-1">
                                                <img @if (!empty($user->avatar)) src="{{ url('/storage/user/avatar/' . $user->avatar->name) }}"
                                                @else
                                                    src="{{ asset('assets/images/faces/face2.jpg') }}" @endif
                                                    alt="image" />
                                            </td>
                                            <td>{{ $user->fullname }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td
                                                @if ($user->status) class="text-success"
                                            @else
                                            class="text-danger" @endif>
                                                @if ($user->status)
                                                    online
                                                @else
                                                    offline
                                                @endif
                                            </td>
                                            <td>
                                                @if ($user->action)
                                                    Đã kích hoạt
                                                @else
                                                    Chưa kích hoạt
                                                @endif
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control" id="exampleFormControlSelect3">
                                                        <option value=0>User</option>
                                                        <option value=10>Admin</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-outline-success" type="button"
                                                        id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton1">
                                                        <a type="button"
                                                            onclick="showUser('{{ route('admin.user.show', ['id' => $user->id]) }}');"
                                                            data-bs-toggle="modal" data-bs-target="#show-user"
                                                            class="dropdown-item show-user"><i
                                                                class="mdi mdi-account-search
                                                        "></i></a>
                                                        <div class="dropdown-divider"></div>
                                                        <a type="button" class="dropdown-item" class="btn btn-primary"
                                                            onclick="document.getElementById('continue-destroy').href = '{{ route('user.destroy', ['id' => $user->id]) }}';
                                                            document.getElementById('notice-user').text = '{{ $user->name }}';"
                                                            data-bs-toggle="modal" data-bs-target="#notice"><i
                                                                class="mdi mdi-account-minus"></i></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            @endisset
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="notice" tabindex="-1" aria-labelledby="noticeLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title">Thông báo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Bạn có muốn tiếp tục xóa tài khoản:
                    </p>
                    <a id="notice-user"></a>
                </div>
                <div class="modal-footer">
                    <a id="continue-destroy" type="button" class="btn btn-primary">Đồng ý</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="show-user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="show-userLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="show-userLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-show-user">
                </div>
            </div>
        </div>
    </div>
@endsection
