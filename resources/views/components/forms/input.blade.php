<input 
    type="{{ $type }}"
    class="form-control @error($name) is-invalid @enderror"
    name="{{ $name }}"
    id="{{ $id }}"
    placeholder="{{ $placeholder }}"

    @if( $value !== null && $value !== "" )
        value="{{ $value }}"
    @else
        value="{{ old($name) }}"
    @endif

    {{ $attributes['readonly'] ? 'readonly' : '' }}
    {{ $attributes['disabled'] ? 'disabled' : '' }}
    {{ $isRequired ? 'required' : '' }}
>

@props(['error'])
@if($error)
    <div class="invalid-feedback">
        @foreach ($error as $e)
            * <small>{{ $e }}</small><br>
        @endforeach
    </div> 
@endif