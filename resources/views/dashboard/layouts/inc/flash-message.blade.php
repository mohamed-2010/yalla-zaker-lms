{{-- <div style="margin-top: 100px;"> --}}
    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                <p class="text-center">
                    {!! $error !!}
                </p>
            </div>
        @endforeach
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            <p class="text-center">
                <i class="fa fa-check-square fa-lg" aria-hidden="true"></i>
                {!! session('success') !!}
            </p>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            <p class="text-center">
                <i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i>
                {!! session('error') !!}
            </p>
        </div>


    @endif
{{-- </div> --}}
{{-- @if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        {{ $error }}
    @endforeach
@endif

@if (session('success'))
    {{ session('success') }}
@endif

@if (session('error'))
    {{ session('error') }}
@endif   --}}
