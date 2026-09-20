@csrf
@if(isset($product))
    @method('PUT')
@endif

<div class="mb-3">
    <label for="name" class="form-label">{{ __('messages.name') }}</label>
    <input type="text" id="name" name="name"
           value="{{ old('name', $product->name ?? '') }}"
           class="form-control @error('name') is-invalid @enderror" required>
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-4">
    <label for="description" class="form-label">{{ __('messages.description') }}</label>
    <textarea id="description" name="description" rows="5"
              class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label d-block">{{ __('messages.categories') }}</label>
    @php($selected = old('categories', isset($product) ? $product->categories->pluck('id')->all() : []))

    <div class="border rounded p-3 bg-body-tertiary @error('categories') border-danger @enderror">
        <div class="row g-2">
            @foreach($categories as $category)
                <div class="col-sm-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="categories[]"
                               value="{{ $category->id }}" id="category-{{ $category->id }}"
                               @checked(in_array($category->id, $selected))>
                        <label class="form-check-label" for="category-{{ $category->id }}">{{ $category->name }}</label>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @error('categories')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
    <div class="form-text">{{ __('messages.required_hint') }}</div>
</div>

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">{{ isset($product) ? __('messages.save') : __('messages.create') }}</button>
    <a class="btn btn-outline-secondary" href="{{ route('products.index') }}">{{ __('messages.cancel') }}</a>
</div>
