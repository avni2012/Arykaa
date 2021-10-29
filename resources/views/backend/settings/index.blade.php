@extends('layouts.backend.master')

@section('title', 'Manage General Settings')

@section('breadcrumb-title', 'Manage General Settings')

@section('breadcrumb-item')
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <li class="breadcrumb-item active">Manage General Settings</li>
@endsection

@section('css')
@endsection

@section('style')
@endsection

@section('content')
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Manage General Settings</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Manage General Settings</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="manage_staff_page">
                        <div class="row">
                            <div class="col-12">
                                <div class="flash-message">
                                    @if(session()->has('message.level'))
                                        <div class="alert alert-{{ session('message.level') }}">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            {{ session('message.content') }}
                                            <?php Session::forget('message')?>
                                        </div>
                                    @endif
                                </div>
                                <div class="card">
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        @if(isset($setting))
                                            <form name="setting-form" id="setting-form" method="Post" action="{{ route('manage-settings.update') }}" enctype="multipart/form-data" data-parsley-validate>
                                                @csrf
                                                @foreach(array_keys($setting) as $key)
                                                    @if($key != 'id' && $key != 'created_at' && $key != 'updated_at')
                                                        <div class="form-group">
                                                            <label for="name"
                                                                   class="col-sm-2 control-label">{{ ucfirst(str_replace('_' , " ", $key)) }}</label>
                                                            <div class="col-sm-12">
                                                                @if($key == 'auth_key' || $key == 'auth_secret')
                                                                    <input type="text" class="form-control" id="{{ $key }}" name="{{ $key }}" placeholder="Settings" value="{{ $setting[$key] }}" readonly>

                                                                @elseif($key == 'logo')
                                                                    <div class="col-md-9" style="display: inline-block">
                                                                        <input type="file" class="form-control" id="{{ $key }}" name="{{ $key }}"
                                                                               placeholder="Settings" onchange="readURL(this);" @if(!auth()->user()->can('edit-setting')) readonly @endif>
                                                                    </div>
                                                                    <div class="col-md-1" style="float: right; margin-right: 130px">
                                                                        <img id="image" src="@if(!$setting['logo']) {{asset('backend/img/img.png')}} @else {{asset('frontend/images/'.$setting['logo'])}} @endif" height="100px" width="100px"/>
                                                                    </div>
                                                                @else
                                                                    <input type="text" class="form-control" id="{{ $key }}" name="{{ $key }}"
                                                                           placeholder="Settings" value="{{ $setting[$key] }}" @if(!auth()->user()->can('edit-setting')) readonly @endif>
                                                                @endif
                                                                @if ($errors->has($key))
                                                                    <div class="error" style="color: #FF0000;">{{ $errors->first($key) }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                                <div class="form-group">
                                                    <input type="submit" form="setting-form" class="btn btn-purple" id="submit">
                                                </div>
                                            </form>
                                        @endif
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>

    </div>
@endsection


@section('script-js-last')
    <script src="{{asset('backend/developer/developer.js')}}"></script>
@endsection

@section('script')
@endsection

