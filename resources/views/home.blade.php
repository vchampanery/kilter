
@extends('adminlte')   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v11.0" nonce="ccaa4s"></script>
                        <div 
                            class="fb-like" 
                            data-layout="standard" 
                            data-action="like" 
                            data-size="large" 
                            data-show-faces="true" 
                            data-href="https://developers.facebook.com/docs/plugins/" 
                            data-share="true">
                        </div>
                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
