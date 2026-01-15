@php($page_title = __('admin.profile'))
<?php
$delete_success = 'تم حذف الملف الشخصي بنجاح';

?>
@extends('layouts.main')
@section('content')

    <div class="content-wrapper">
        <div class="content-detached">
            <div class="content-body">

                <div class="content-wrapper">
                    <div class="content-header row mb-1">
                        <div class="content-header-left col-md-6 col-12 mb-2">
                            <h3 class="content-header-title">{{__('admin.profile')}}</h3>
                            <div class="row breadcrumbs-top">
                                <div class="breadcrumb-wrapper col-12">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/">{{__('admin.Dashboard')}}</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="#">{{__('admin.show')}}</a>
                                        </li>
                                        <li class="breadcrumb-item active">{{__('admin.profile')}}
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="content-header-right col-md-6 col-12"></div>
                        @if(session('success'))
                            <div id="messageSave" class="modal fade text-left" role="dialog">
                                <div class="modal-dialog">
                                    <div class="card-content collapse show">
                                        <div class="card-body">
                                            <div class="alert bg-info alert-icon-left mb-2" role="alert">
                                                <span class="alert-icon"><i class="la la-pencil-square"></i></span>
                                                <strong class="span">{{__('admin.successfully_done')}}!</strong>
                                                <p>{{session('success')}}.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div id="messageError" class="modal fade text-left" role="dialog">
                            <div class="modal-dialog">
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <div class="alert bg-danger alert-icon-left mb-2" role="alert">
                                            <span class="alert-icon"><i class="la la-pencil-square"></i></span>
                                            <strong class="span">{{__('admin.error_message')}}!</strong>
                                            {{--                                <p id="message-empty" class="span">رسالة خطاء.</p>--}}
                                            <p id="message-empty" class="span">{{session('error')}}.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="card-edit-profile" hidden class="col-lg-5 col-md-12">
                            <div class="card" style="margin-top: 35px; border-radius:15px">
                                <div class="card-header"><h4 class="card-title"
                                                             id="from-actions-top-bottom-center">{{__('admin.Edit_Profile')}}</h4>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a class="btn-edit"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <form class="form" action="{{ route('profile.update')}}" method="POST"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input id="name" type="text" value=""
                                                       placeholder="{{__('admin.enter_name')}} {{__('admin.the__new')}}"
                                                       class="form-control span @error('name') is-invalid @enderror" name="name"
                                                       autocomplete="name">
                                                <div class="form-control-position">
                                                    <i class="la la-user"></i>
                                                </div>
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input id="email" type="email" value=""
                                                       placeholder="{{__('admin.enter_new_email')}}"
                                                       class="form-control span @error('email') is-invalid @enderror" name="email"
                                                       autocomplete="email">
                                                <div class="form-control-position">
                                                    <i class="ft-mail"></i>
                                                </div>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <div class="input-group">
                                                    <input id="phone" type="number" value=""
                                                           placeholder="{{__('admin.enter_new_phone')}}"
                                                           class="form-control span @error('phone') is-invalid @enderror" name="phone"
                                                           autocomplete="current-password">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" dir="ltr">+967</span>
                                                    </div>
                                                    <div class="form-control-position">
                                                        <i class="la la-key"></i>
                                                    </div>
                                                    @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                    @enderror
                                                </div>
                                            </fieldset>
                                            <button type="submit" class="btn btn-outline-reddit span {{--button-blue-profile--}} col-md-12"
                                                    title="{{__('admin.edit')}}"><i class="ft-edit"></i> {{__('admin.edit')}}
                                            </button>
                                        </div>
                                        <div class="profile-card-ctr">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div id="center-card" class="col-lg-2 col-md-12"></div>
                        <div id="card-min" class="col-lg-8 col-md-12">
                            <div class="card" style="margin-top: 35px; border-radius:15px">
                                <div class="card-content">
                                    <div class="card-body">


                                            <img id="image-src" src="{{asset('storage/'. Auth::User()->image)}}" alt="{{Auth::User()->name}}"
                                            onerror="this.src='{{asset('storage/profile.png')}}'"
                                                 class="image-profile">

                                        <br>
                                        <div class="text-center text-profile ">

                                            <h3>{{Auth::User()->name}}</h3>
                                            <h4>{{Auth::User()->email}}</h4>
                                            <h4 dir="ltr">{{Auth::User()->phone}} </h4>

                                            <button id="edit" class="btn btn-outline-info button-blue-profile"
                                                    title="{{__('admin.Edit_Profile')}}"><i class="ft-edit"></i>
                                            </button>
                                            <a href="{{ route('profile.edit_password', Auth::User()->id)}}"
                                               class="btn btn-outline-warning button-blue-profile"
                                               title="{{__('admin.edit_password')}}"><i class="la la-key"></i></a>
                                            <button id="edit-image" class="btn btn-outline-danger button-blue-profile"
                                                    title="{{__('admin.edit_image')}}"><i class="ft-image"></i></button>

                                        </div>


                                    </div>
                                    <div class="profile-card-ctr">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="card-edit-image" hidden class="col-lg-4 col-md-12">
                            <div class="card" style="margin-top: 35px; border-radius:15px">
                                <div class="card-header"><h4 class="card-title"
                                                             id="from-actions-top-bottom-center">{{__('admin.edit_image_profile')}}</h4>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a class="btn-edit"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <form class="form" action="{{ route('profile.edit_image')}}" method="POST" id="my_form_id"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <input id="image" accept=".jpg, .jpeg, .png" type="file"
                                                   placeholder="{{__('admin.enter_image')}}"
                                                   class="form-control @error('image') is-invalid @enderror" name="image"
                                                   onchange="loadAvatar(this);" required>
                                            <img id="avatar" style="max-width: 140px; height: auto; margin:10px;">
                                            @error('image')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                            <br><br><br>
                                            <div class="pu6ll-right" style="margin-bottom: 25px">
                                                <button type="button" class="btn btn-outline-danger deleteB"
                                                        style="border-radius: 15px"
                                                        title="{{__('admin.delete')}}"><i
                                                        class="ft-trash"></i> {{__('admin.delete')}}</button>
                                                <button type="submit" class="btn btn-outline-reddit button-blue-profile"
                                                        title="{{__('admin.edit')}}"><i
                                                        class="ft-edit"></i> {{__('admin.edit')}}</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="profile-card-ctr">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-12 col-md-12"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- start model check Delete Message--}}
    <div id="confirmModalDelete" class="modal fade text-left" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">{{__('admin.message_alerte')}} !</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 align="center" style="margin:0;">{{__('admin.are_you_sure_you_want_to_remove_this_data')}}</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" name="ok_button" id="ok_button"
                            class="btn btn-outline-danger">{{__('admin.yes')}}</button>
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">{{__('admin.cancel')}}</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end model check Delete Message--}}

    {{-- start model Don Delete Message--}}
    <div id="messageDonDelete" class="modal fade text-left" role="dialog">
        <div class="modal-dialog">
            <div class="card-content collapse show">
                <div class="card-body">
                    <div class="alert bg-danger alert-icon-left mb-2" role="alert">
                        <span class="alert-icon"><i class="ft ft-trash-2"></i></span>
                        <strong>{{__('admin.successfully_done')}}!</strong>
                        <p>{{__('admin.deleted_successfully')}}.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--end model Don Delete Message--}}
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>

        /*end  message error*/
        $(document).ready(function() {
        $(document).on('click', '#edit', function () {
            /* document.getElementById('my_form_id').submit();*/
            console.log(153);
            $('#card-edit-profile').attr('hidden', false);
            $('#center-card').attr('hidden', true);
            $('#edit').attr('hidden', true);
            $('#card-edit-image').attr('hidden', true);
            $('#edit-image').attr('hidden', false);
            $('#card-min').removeClass('col-lg-8');
            $('#card-min').addClass('col-lg-7');
        });
        });
        $(document).on('click', '.btn-edit', function () {
            $('#card-edit-profile').attr('hidden', true);
            $('#center-card').attr('hidden', false);
            $('#edit').attr('hidden', false);
            $('#card-edit-image').attr('hidden', true);
            $('#edit-image').attr('hidden', false);
            $('#card-min').addClass('col-lg-8');
            $('#card-min').removeClass('col-lg-7');
        });
        $(document).on('click', '#edit-image', function () {
            $('#card-edit-profile').attr('hidden', true);
            $('#center-card').attr('hidden', true);
            $('#edit').attr('hidden', false);
            $('#edit-image').attr('hidden', true);
            $('#card-edit-image').attr('hidden', false);
            $('#card-min').addClass('col-lg-8');
            $('#card-min').removeClass('col-lg-7');
        });

        /*start code Delete ajax*/
        $(document).on('click', '.deleteB', function () {
            $('#confirmModalDelete').modal('show');
        });
        $('#ok_button').click(function () {
            $.ajax({
                url: "{{ url('profile_management/profile/delete_image')}}",
                beforeSend: function () {
                        $('#ok_button').text('{{__('admin.deleting')}}...');
                },
                success: function (data) {
                    setTimeout(function () {
                        $('#confirmModalDelete').modal('hide');
                        if(data.image != undefined){
                            $('#image-src').attr('src', "{{asset('storage/admins/360')}}"+"/"+data.image);
                            $('#image-sidebar').attr('src', "{{asset('storage/admins/64')}}"+"/"+data.image);
                        }
                        $('#ok_button').text('{{__('admin.yes')}}');
                    }, 500);
                    $('#messageDonDelete').modal('hide');
                    if (data.message == undefined) {
                        $('#message-empty').text("{{session('error')}}.");
                        setTimeout(function () {
                            $('#card-edit-profile').attr('hidden', true);
                            $('#center-card').attr('hidden', false);
                            $('#edit').attr('hidden', false);
                            $('#card-edit-image').attr('hidden', true);
                            $('#edit-image').attr('hidden', false);
                            $('#card-min').addClass('col-lg-8');
                            $('#card-min').removeClass('col-lg-7');
                            $('#messageDonDelete').modal('show');
                        }, 510,);
                        setTimeout(function () {
                            $('#messageDonDelete').modal('hide');
                        }, 3000,);
                    } else {
                        console.log(data.message);
                        $('#message-empty').text(data.message + '.');
                        setTimeout(function () {
                            $('#messageError').modal('show');
                        }, 510,);
                        setTimeout(function () {
                            $('#messageError').modal('hide');
                        }, 3000,);
                    }
                },
                error: function (data) {
                    $('#message-loading-or-error').html(' فشل التحميل <i class="ft-alert-triangle color-red"></i>');
                    $('#confirm-modal-loading-show').modal('show');
                }
            })
        });

        /*end code Delete ajax*/
        function loadAvatar(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#avatar').attr('hidden', false);
                    $('#delete-img').attr('hidden', false);
                    var image = document.getElementById('avatar');
                    image.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
