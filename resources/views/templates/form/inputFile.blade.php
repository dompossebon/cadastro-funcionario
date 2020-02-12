<div class="row">
    <label class="{{ $class ?? null }}">
    <span>
        @error($input)
        <div class="alert alert-danger" role="alert">
            <div class="error">{{ $message }}</div>
        </div>
        @enderror
    </span>
        <span>{{ $label }}</span>
        <p> {!! Form::file($input) !!} </p>
    </label>
</div>
