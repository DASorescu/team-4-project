@extends('layouts.app')

@section('content')
    <div>
        @if (session('status'))
        <div class="card-body">
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            </div>
        @endif
        <div class="container">
        <div class="row h-100 ">
            <div class="col-8 mx-2 my-4">
                <div class="card graphics rounded border-primary ">
                    <div class="card-header bg-primary"><h5>{{ $reviews_chart->options['chart_title'] }}</h5></div>
                    <div class="card-body p-0">
                            {!! $reviews_chart->renderHtml() !!}
                            
                    </div>

                </div>
                    
            </div>
            <div class="col-8  offset-4">
                <div class="card graphics  rounded border-danger">
                    <div class="card-header bg-danger "><h5>{{ $messages_chart->options['chart_title'] }}</h5></div>

                    <div class="card-body p-0">
                        {!! $messages_chart->renderHtml() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
{!! $messages_chart->renderChartJsLibrary() !!}
{!! $messages_chart->renderJs() !!}
{!! $reviews_chart->renderChartJsLibrary() !!}
{!! $reviews_chart->renderJs() !!}
@endsection
