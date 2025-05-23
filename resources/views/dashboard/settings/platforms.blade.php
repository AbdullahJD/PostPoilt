@extends('dashboard.settings.layouts.app')

@section('content')
<div class="container">
    <h2>Manage Platforms</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="/settings/platforms" method="POST">
        @csrf
        @foreach($platforms as $platform)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="platforms[]" value="{{ $platform->id }}"
                    {{ auth()->user()->platforms->contains($platform->id) ? 'checked' : '' }}>
                <label class="form-check-label">{{ $platform->name }}</label>
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary mt-3">Save Preferences</button>
    </form>
</div>
@endsection