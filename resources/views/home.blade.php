@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid pt-4">
        <div class="row">
            @php
                $colors = [
                    'text-bg-primary',
                    'text-bg-info',
                    'text-bg-success',
                    'text-bg-danger',
                    'text-bg-warning',
                    'text-bg-light',
                    'text-bg-secondary',
                    'text-bg-dark',
                ];

                $icon = [
					'fa-solid fa-users',
					'fa-solid fa-user-lock',
					'fa-solid fa-folder-tree',
					'fa-solid fa-users-gear'
                ];
            @endphp

            @foreach ($types as $key => $item)
                <div class="col-lg-3 col-6">
                    <a href="{{ $item['link'] }}" class="text-decoration-none">
                        <div class="small-box {{ $colors[$key % count($colors)] }} py-1">
                            <div class="inner">
                                <h3>{{ $item['value'] ?? 0 }}</h3>
                                <h5>{{ $item['title'] }}</h5>
                            </div>
                            <i class="{{ $icon[$key] }} small-box-icon"></i>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
