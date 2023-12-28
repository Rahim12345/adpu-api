@extends('back.layouts.master')

@section('title')
    {{ auth()->user()->name.' '.auth()->user()->last_name }}
@endsection

@section('css')

@endsection

@section('content')
    <div class="container-xl mt-3">
        <div class="row row-cards">
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body p-4 text-center">
                        <form action="{{ route('profil.store') }}" id="profile-form" method="POST" enctype="multipart/form-data">
                            <span class="avatar avatar-xl mb-3 avatar-rounded"
                            @if(auth()->user()->avatar)
                              style="background-image: url({{ asset(auth()->user()->avatar) }})"
                            @endif
                            >
                            @if(!auth()->user()->avatar)
                                {{ substr(auth()->user()->name,0,1).substr(auth()->user()->last_name,0,1) }}
                            @endif
                            <label for="profile-avatar">
                                <img id="change-avatar" src="{{ asset('images/add-image.png') }}" style="position: absolute;float: right;bottom: 0;right: 0;width: 30px;cursor: pointer" alt="">
                            </label>

                            </span>
                            <input type="file" name="avatar" id="profile-avatar" style="display: none">
                            <div class="progress" style="display: none" id="avatarProgress">
                                <div class="progress-bar progress-bar-indeterminate bg-green"></div>
                            </div>
                            <h3 class="m-0 mb-1"><a href="#" id="sidebar-name">{{ auth()->user()->name_lastname }}</a></h3>
                            <div class="text-muted">{{ auth()->user()->email }}</div>
                            <div class="mt-3">
                                <span class="badge bg-purple-lt">{{ auth()->user()->name.' '.auth()->user()->last_name }}</span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-9">
                <div class="card">
                    <div class="card-body p-4 text-center">
                        <form action="{{ route('account.update') }}" id="account-update-form" method="POST" onsubmit="return false">
                            @csrf
                            <label class="form-label">Hesab ayarları</label>
                            <fieldset class="form-fieldset">
                                <div class="mb-3">
                                    <input type="text" name="name" id="name" value="{{ old('name',auth()->user()->name) }}" class="form-control" autocomplete="off"/>
                                    <small class="text-danger float-start mb-1" id="name-error"></small>
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name',auth()->user()->last_name) }}" class="form-control" autocomplete="off"/>
                                    <small class="text-danger float-start mb-1" id="last_name-error"></small>
                                </div>
                                <div class="mb-3">
                                    <input type="password" placeholder="Köhnə şifrəniz" name="password" id="password" class="form-control" autocomplete="off"/>
                                    <small class="text-danger float-start mb-1" id="password-error"></small>
                                </div>
                                <div class="mb-3">
                                    <input type="password" placeholder="Yeni şifrəniz" name="ypassword" id="ypassword" class="form-control" autocomplete="off"/>
                                    <small class="text-danger float-start mb-1" id="ypassword-error"></small>
                                </div>
                                <div class="mb-3 float-end">
                                    <button type="button" id="updateProfileBtn" class="btn btn-primary">Yadda saxla</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $( 'input[type=file][id="profile-avatar"]' ).change( function ( event ) {
            $('#avatarProgress').css('display','flex');

            let profileForm = document.getElementById("profile-form");
            let data = new FormData(profileForm);

            $.ajax({
                type : 'POST',
                data : data,
                url  : '{!! route('profil.store') !!}',
                cache: false,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success : function (response) {
                    $('span.avatar').css("background-image", "url(" + response.avatarUrl + ")");
                    $('#avatarProgress').css('display','none');

                    toastr.options = {
                        "debug": false,
                        "positionClass": "toast-bottom-right",
                        "onclick": null,
                        "fadeIn": 300,
                        "fadeOut": 1000,
                        "timeOut": 5000,
                        "extendedTimeOut": 1000
                    }
                    toastr.success(response.message);
                },
                error : function (myErrors) {
                    $.each(myErrors.responseJSON.errors,function (key, value) {
                        toastr.error(value,'Xəta');
                    });
                    $('#avatarProgress').css('display','none');
                }
            });
        } );

        $('#updateProfileBtn').click(function () {
            $('.text-danger').html('');
            let accountForm = document.getElementById("account-update-form");
            let dataAccount = new FormData(accountForm);

            $.ajax({
                type : 'POST',
                data : dataAccount,
                url  : '{!! route('account.update') !!}',
                cache: false,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success : function (response) {
                    $('#header-fname').html(response.fname);
                    toastr.options = {
                        "debug": false,
                        "positionClass": "toast-bottom-right",
                        "onclick": null,
                        "fadeIn": 300,
                        "fadeOut": 1000,
                        "timeOut": 5000,
                        "extendedTimeOut": 1000
                    }
                    toastr.success(response.message);
                },
                error : function (myErrors) {
                    $.each(myErrors.responseJSON.errors,function (key, value) {
                        $('#'+key+'-error').html(value);
                    });
                }
            });
        });
    </script>
@endsection
