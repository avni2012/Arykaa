@extends('layouts.backend.master')

@section('title', 'Manage Users')

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
                            <h1>Manage Users</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active">Manage Users</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="manage_staff_page">
                        <div class="row drpdn_btn_add_btn">
                            <div class="col-sm-6">
                                @if(auth()->user()->can('delete-user'))
                                    {{--<div class="dropdown_select form-group">
                                        <select class="form-control">
                                            <option>Delete</option>
                                        </select>
                                        <button type="button" onclick="deleteMultipleTableRow('{{ route('admin.delete-multiple-user') }}','usersDatatable')" class="btn btn-default btn-purple">Apply</button>
                                    </div>--}}
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <div class="add_staff_btn">
                                    @if(Auth::user()->can('create-user'))
                                        <a type="button" class="btn btn-default btn-purple" href="{{route('manage-users.create')}}">
                                            <i class="fas fa-plus-circle"></i> Add User
                                        </a>
                                    @endif
                                    @if(Auth::guard()->user()->can('delete-user'))<button type="button" onclick="MultipleDelete('{{ route('admin.delete-multiple-user') }}','usersDatatable')" class="btn btn-default btn-purple"> <i class="fas fa-trash-alt"></i>  Delete Selected</button>@endif
                                </div>
                            </div>
                        </div>
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
                                        <div class="table-responsive">
                                            <table id="usersDatatable" class="table table-condensed">
                                                <thead>
                                                <tr>
                                                    <th class="select_all">
                                                        @if( auth()->guard()->user()->can('delete-user') )
                                                            <label class="container_chk ">
                                                                <input type="checkbox" >
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        @endif
                                                    </th>
                                                    <th>No</th>
                                                    <th>Username</th>
                                                    <th>Email Id</th>
                                                    <th>Mobile No</th>
                                                    <th>Status</th>
                                                    <th>Email Verify</th>
                                                    @if( auth()->guard()->user()->can('delete-user') || auth()->guard()->user()->can('edit-user') )
                                                        <th>Action</th>
                                                    @endif
                                                </tr>
                                                </thead>
                                            </table>
                                        </div>
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
    <script src="{{ asset('backend/developer/users/users-list.js') }}"></script>
@endsection

@section('script')

@endsection

