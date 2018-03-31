 @extends('layouts.app') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @auth
                <div class="card-header">Home</div>
                <div class="card-body">
                    Welcome board!
                </div>
                @else
                <div class="card-header">Anauthorized </div>
                <div class="card-body">
                    Please, in order to watch videos
                    <a @click="$modal.show('login')" style="color:blue">{{ __('Login!') }}</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection