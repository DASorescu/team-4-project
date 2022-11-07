@extends('layouts.app')

@section('content')
<div >
    <div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        <div class="container">
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">

                    <h1>{{ $chart1->options['chart_title'] }}</h1>
                    {!! $chart1->renderHtml() !!}

                </div>

            </div>
        </div>
    </div>
</div>

    {!! $chart1->renderChartJsLibrary() !!}
    {!! $chart1->renderJs() !!}

</div>
@endsection
