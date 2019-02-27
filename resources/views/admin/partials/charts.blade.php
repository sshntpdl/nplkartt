@extends('admin.app')
@section('breadcrumbs')
  <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
  <li class="breadcrumb-item active" aria-current="page">Charts & Reports</li>
@endsection
@section('content')
<h2 class="modal-title" style="border-bottom:1px solid red;">Charts & Reports</h2><br>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Chart Demo</div>

                <div class="panel-body">
                    {!! $chart->html() !!}
                </div><br>
                <div class="panel-body">
                    {!! $piechart->html() !!}
                </div><br>
                <div class="panel-body">
                    {!! $linechart->html() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
{!! Charts::scripts() !!}
{!! $chart->script() !!}
{!! $piechart->script() !!}
{!! $linechart->script() !!}
@endsection