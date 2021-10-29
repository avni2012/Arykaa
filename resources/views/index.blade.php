@extends('layouts.master')

@section('title', 'Home')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/css/custom.css') }}">
@endsection

@section('style')
@endsection

@section('content')

  <div class="container" id="container_template">
    <h1><center>Resume Builder</center></h1>
    <div id="viewResumeAsImage"></div>
    <img src="{{ asset('/frontend/images/resume_templates/Paris.png') }}" width="100" height="100" style="border: ridge;">
   <!--  <a href="javascript:void(0)" id="SelectTemplate" class="ajax"><button id="" class="btn">Use this template</button></a> -->
    <a href="{{ url('/resumes') }}" id="SelectTemplate" class="ajax"><button id="" class="btn">Use this template</button></a>
  </div>
    <div id="page-main"></div>

@endsection

@section('script-js-last')
<!-- <script src="{{ asset('/frontend/js/custom.js') }}"></script> -->
<script type="text/javascript">
    var base_url = "{{ url('/') }}";
    var csrftoken = '{{ csrf_token() }}';
</script>
@endsection

@section('script')
@endsection
