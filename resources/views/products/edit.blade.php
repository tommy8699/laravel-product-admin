@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2 mb-4">
            <div>
                <h1 class="h2 mb-1">{{ __('messages.edit') }}: {{ $product->name }}</h1>
                <div class="text-body-secondary"><strong>{{ __('messages.hash') }}:</strong> <code>{{ $product->hash }}</code></div>
            </div>
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">{{ __('messages.cancel') }}</a>
        </div>
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('products.update', $product) }}">
                    @include('products._form')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
