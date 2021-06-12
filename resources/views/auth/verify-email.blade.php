<x-model-layout title="Unverified email">
    <h3 class="text-center my-3 text-gray-900">Unable to Log-in, Your email address is Unverified, please verify your email!</h3>
    <div id="alertContainer">
        @if (Session::has('message'))
        <div class="alert alert-success m-0">
            <h5 class="text-center">{{ Session::get('message') }}</h5>
        </div>
        @endif
    </div>
    <div class="row">
        <div class="col-lg-6 d-none d-lg-block emailunverfied-bg"></div>
        <div class="col-lg-6">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Resend verification E-mail to</h1>
                </div>
                <form id="verify-mail" method="POST" action="{{ route('verification.send') }}" class="user">
                    @csrf
                    <h4 class="text-center my-4 text-gray-900">{{auth()->user()->email}}</h4>
                    <button type="submit" id="loginBtn" class="btn btn-primary btn-user btn-block">Send</button>
                </form>
                <hr>
                <div class="text-center">
                    <a class="small" href="/forgetpassword">Forgot Password?</a>
                </div>
                <div class="text-center">
                    <a class="small" href="/register">Create an Account!</a>
                </div>
            </div>
        </div>
    </div>
</x-model-layout>