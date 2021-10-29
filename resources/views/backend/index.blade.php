@extends('layouts.backend.master')

@section('title', 'Dashboard')

@section('breadcrumb-title', 'Dashboard')

@section('breadcrumb-item') 
<li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('css') 
@endsection

@section('style') 
@endsection


@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard {{Auth::guard('admin')->user()->name }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard {{Auth::guard('admin')->user()->name }}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @if(!empty($permissions))
        <div class="row">
          <div class="col-sm-6">
            @foreach($permissions as $key => $value)
              @if($value == 1)
                <label>{{ $key }}</label><br>
              @endif
            @endforeach
          </div>
        </div>
        @endif
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
@endsection

@section('script-js-last')
<script src="{{asset('backend/dist/js/pages/dashboard2.js')}}"></script>

@endsection

@section('script')
@endsection