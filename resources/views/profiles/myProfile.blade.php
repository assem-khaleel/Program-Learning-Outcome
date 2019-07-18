@php
    /**
     * Created by PhpStorm.
     * User: dura
     * Date: 7/3/19
     * Time: 8:34 AM
     */
@endphp

@extends('layouts.app')

@section('wrapper')

  <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('profiles.profile')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">{{trans('profiles.home')}}</a></li>
            </ol>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <!-- Row -->
        <div class="row">
            <!-- Column -->
            <div class="col-lg-4 col-xlg-3 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <center class="m-t-30"><img class="img-circle" width="150" src="@if(!empty($user->image->path)){{asset('storage/'.$user->image->path)}}">@else /images/avatar.png">@endif
                            <h4 class="card-title m-t-10">{{$user->name}}</h4>
                            <div class="row text-center justify-content-md-center">
                            </div>
                        </center>
                    </div>
                    <div>
                        <hr>
                    </div>
                    <div class="card-body">
                        <small class="text-muted">{{trans('profiles.emailAddress')}}</small>
                        <h6>{{$user->email}}</h6>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs profile-tab" role="tablist">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#profile" role="tab">{{trans('profiles.profile')}}</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#settings"
                                                role="tab">{{trans('profiles.settings')}}</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#security"
                                                role="tab">{{trans('profiles.security')}}</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="profile" role="tabpanel">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-xs-6 b-r"><strong>{{trans('profiles.fullName')}}</strong>
                                        <br>
                                        <p class="text-muted">{{$user->name}}</p>
                                    </div>
                                    <div class="col-md-4 col-xs-6 b-r"><strong>{{trans('profiles.email')}}</strong>
                                        <br>
                                        <p class="text-muted">{{$user->email}}</p>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="settings" role="tabpanel">
                            <div class="card-body">
                                <form class="form-horizontal form-material"
                                      action="{{route('profiles.update',$user->id)}}" method="post" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-md-12">{{trans('profiles.fullName')}}</label>
                                        <div class="col-md-12">
                                            <input type="text" value="{{$user->name}}"
                                                   class="form-control form-control-line" name="name" required>
                                        </div>
                                        @error('name')
                                        <div class="form-control-feedback"><code> {{ $message }} </code></div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">{{trans('profiles.email')}}</label>
                                        <div class="col-md-12">
                                            <input type="email" value="{{$user->email}}"
                                                   class="form-control form-control-line" name="email" required>
                                        </div>
                                        @error('email')
                                        <div class="form-control-feedback"><code> {{ $message }} </code></div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12">{{trans('profiles.imageUpload')}}</label>
                                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                            <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                                            <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">{{trans('profiles.selectImage')}}</span> <span class="fileinput-exists">{{trans('profiles.change')}}</span>
                                            <input type="file" name="image"> </span>
                                            <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">{{trans('profiles.remove')}}</a>
                                        </div>
                                        @error('image')
                                        <div class="form-control-feedback"><code> {{ $message }} </code></div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-linkedin">{{trans('profiles.updateProfile')}}</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <div class="tab-pane" id="security" role="tabpanel">
                            <div class="card-body">
                                <form class="form-horizontal form-material"
                                      action="{{route('profiles.changePassword')}}" method="post">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-md-12">{{trans('profiles.password')}}</label>
                                        <div class="col-md-12">
                                            <input type="password" class="form-control" name="current-password"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">{{trans('profiles.newPassword')}}</label>
                                        <div class="col-md-12">
                                            <input type="password" class="form-control" name="new-password" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">{{trans('profiles.newPasswordConfirmation')}}</label>
                                        <div class="col-md-12">
                                            <input type="password" class="form-control" name="new-password_confirmation"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-linkedin">{{trans('profiles.updatePassword')}}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
        <!-- Row -->
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->

    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
    @push('script')
        <script src="{{asset('js/jasny-bootstrap.js')}}"></script>

    @endpush
@endsection
