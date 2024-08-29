@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- loop through the stats array -->
        @foreach ($stats as $stat)
            <div class="col-md-4 mb-5">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <h4 class="text-center text-secondary col-span-5">{{ $stat['name'] }}</h4>
                            <h1 class="text-center text-primary col-span-7">{{ $stat['count'] }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
