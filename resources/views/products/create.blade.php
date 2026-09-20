@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2 mb-0">{{ __('messages.new_product') }}</h1>
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">{{ __('messages.cancel') }}</a>
        </div>
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('products.store') }}">
                    @include('products._form')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
