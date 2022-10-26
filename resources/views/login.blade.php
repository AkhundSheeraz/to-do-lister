<x-model-layout title="Login">
    <div class="alertContainer">
        <div class="alert alert-success m-1 d-none">
            <h5 class="text-center flash"></h5>
        </div>
    </div>
    <!-- Nested Row within Card Body -->
    <div class="row">
        <div class="col-lg-6 d-none d-lg-block login-bg"></div>
        <div class="col-lg-6">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                </div>
                <form id="user_Login" class="user">
                    <div class="form-group">
                        <input type="email" class="form-control form-control-user" id="login_email" name="email"
                            aria-describedby="emailHelp" placeholder="Enter Email Address...">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-user" id="login_password"
                            name="password" placeholder="Password">
                    </div>
                    <button type="submit" id="loginBtn" class="btn btn-primary btn-user btn-block">Login</button>
                    <hr>
                    <a href="{{ Route('google') }}" class="btn btn-google btn-user btn-block">
                        <i class="fab fa-google fa-fw"></i> Login with Google
                    </a>
                    <a href="#" class="btn btn-facebook btn-user btn-block">
                        <i class="fab fa-windows"></i> Login with Microsoft
                    </a>
                </form>
                <hr>
                <div class="text-center">
                    <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
                </div>
                <div class="text-center">
                    <a class="small" href="{{ route('register') }}">Create an Account!</a>
                </div>
            </div>
        </div>
    </div>
</x-model-layout>
