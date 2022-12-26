<div class="content-wrapper">
    <div class="row">
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div>
                        <img id="img-preview" class="avatar-img"
                            @if (!empty($user->avatar)) src="{{ url('/storage/user/avatar/' . $user->avatar->name) }}"
                        @else
                            src="{{ asset('assets/images/faces/face2.jpg') }}" @endif
                            width="100%" alt="hehe">

                        <div style="text-align: center;width: 100%;">
                            <form class="forms-sample" method="POST"
                                @if (Route::has('user.update-avatar')) action="{{ route('user.update-avatar', ['id' => $user->id]) }}" @endif
                                enctype="multipart/form-data">
                                @csrf
                                <div class="template-demo @error('avatar') is-invalid @enderror">
                                    <input type="file" name="avatar" id="file-input" hidden />
                                    <button type="button" class="btn btn-outline-danger btn-icon-text"
                                        onclick="document.getElementById('file-input').click();">
                                        <i class="mdi mdi-upload btn-icon-prepend"></i> Chọn ảnh
                                    </button>
                                    <button type="submit" class="btn btn-outline-primary btn-icon-text">
                                        <i class="mdi mdi-file-check btn-icon-prepend"></i> Lưu
                                    </button>
                                </div>
                                @error('avatar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </form>
                        </div>
                    </div>

                    <div
                        class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                        <div class="text-md-center text-xl-left">
                            <h6 class="mb-1">
                                @if (!empty($user))
                                    {{ $user->name }}
                                @endif
                            </h6>
                            <p class="text-muted mb-0">
                                @if (!empty($user))
                                    {{ $user->date_of_birth }} 
                                @endif
                            </p>
                        </div>
                        {{-- <div
                            class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                            <h6 class="font-weight-bold mb-0">$236</h6>
                        </div> --}}
                    </div>
                    <div
                        class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                        <div class="text-md-center text-xl-left">
                            <h6 class="mb-1">Vị trí công tác</h6>
                            <p class="text-muted mb-0">{{ _('Giam doc') }}</p>
                            <p class="text-muted mb-0">Bat dau lam viec: {{ _('01-01-2000') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="col-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Thông tin</h4>
                                        <form class="forms-sample" method="POST"
                                            @if (Route::has('user.update')) action="{{ route('user.update', ['id' => $user->id]) }}" @endif>
                                            @csrf
                                            <div class="form-group">
                                                <label for="exampleInputName1">Tên TK</label>
                                                <input type="text" class="form-control" id="exampleInputName1"
                                                    @if (!empty($user)) value="{{ $user->name }}" @endif
                                                    placeholder="Name" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Tên</label>
                                                <input type="text"
                                                    class="form-control @error('fullname') is-invalid @enderror"
                                                    id="exampleInputName1" name="fullname"
                                                    @if (!empty($user)) value="{{ $user->fullname }}" @endif
                                                    placeholder="fullname">
                                                @error('fullname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail3">Email</label>
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    id="exampleInputEmail3" name="email"
                                                    @if (!empty($user)) value="{{ $user->email }}" @endif
                                                    placeholder="Email">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword4">Ngày sinh</label>
                                                <input type="date"
                                                    class="form-control @error('date_of_birth') is-invalid @enderror"
                                                    id="exampleInputPassword4" name="date_of_birth"
                                                    @if (!empty($user)) value="{{ $user->date_of_birth }}" @endif
                                                    placeholder="Password">
                                                @error('date_of_birth')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleSelectGender">Giới tính</label>
                                                <select name="gender" class="form-control" id="exampleSelectGender">
                                                    @if (empty($user->gender) || $user->gender == 'other')
                                                        <option value="other">Khác</option>
                                                        <option value="male">Nam</option>
                                                        <option value="female">Nữ</option>
                                                    @else
                                                        @if ($user->gender == 'male')
                                                            <option value="male">Nam</option>
                                                            <option value="female">Nữ</option>
                                                        @else
                                                            <option value="female">Nữ</option>
                                                            <option value="male">Nam</option>
                                                        @endif
                                                        <option value="other">Khác</option>
                                                    @endif


                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputCity1">Địa chỉ</label>
                                                <input type="text"
                                                    class="form-control @error('address') is-invalid @enderror"
                                                    id="exampleInputCity1" name="address"
                                                    @if (!empty($user)) value="{{ $user->address }}" @endif
                                                    placeholder="Location">
                                                @error('address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputCity1">Chức vụ</label>
                                                <input type="text" class="form-control" id="exampleInputCity1"
                                                    @if (!empty($user)) value="{{ $user->position }}" @endif
                                                    placeholder="Location" disabled>
                                            </div>
                                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                            <button class="btn btn-dark">Cancel</button>
                                        </form>
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
