@extends('layouts.app')

@section('content')
<div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
    <div>
        <h1 class="h2 mb-1">{{ __('messages.products') }}</h1>
        <p class="text-body-secondary mb-0">{{ $products->total() }} {{ __('messages.products') }}</p>
    </div>
    <a class="btn btn-primary" href="{{ route('products.create') }}">+ {{ __('messages.new_product') }}</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">
                <tr>
                    <th class="px-4 py-3" style="width: 80px;">
                        ID
                    </th>

                    <th class="py-3">
                        {{ __('messages.name') }}
                    </th>

                    <th class="py-3">
                        {{ __('messages.hash') }}
                    </th>

                    <th class="py-3">
                        {{ __('messages.categories') }}
                    </th>

                    <th class="text-end px-4 py-3" style="width: 220px;">
                        {{ __('messages.actions') }}
                    </th>
                </tr>
                </thead>

                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td class="px-4 py-3 text-secondary">
                            {{ $product->id }}
                        </td>

                        <td class="py-3">
                                <span class="fw-semibold">
                                    {{ $product->name }}
                                </span>
                        </td>

                        <td class="py-3">
                            <code class="small">
                                {{ $product->hash }}
                            </code>
                        </td>

                        <td class="py-3">
                            <div class="d-flex flex-wrap gap-1">

                                @foreach($product->categories as $category)
                                    <span class="badge rounded-pill text-bg-secondary">
                                            {{ $category->name }}
                                        </span>
                                @endforeach

                            </div>
                        </td>

                        <td class="text-end px-4 py-3">

                            <div class="d-inline-flex gap-2">

                                <a href="{{ route('products.edit', $product) }}"
                                   class="btn btn-outline-primary btn-sm">
                                    {{ __('messages.edit') }}
                                </a>

                                <form method="POST"
                                      action="{{ route('products.destroy', $product) }}"
                                      class="d-inline"
                                      onsubmit="return confirm('{{ __('messages.delete_confirm') }}')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-outline-danger btn-sm">
                                        {{ __('messages.delete') }}
                                    </button>

                                </form>

                            </div>

                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>

    </div>
</div>

@if($products->hasPages())
    <div class="mt-4">{{ $products->links() }}</div>
@endif
@endsection
