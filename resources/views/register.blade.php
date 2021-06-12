<x-model-layout title="Registration">
    <!-- Nested Row within Card Body -->
    <div class="row">
        <div class="col-lg-5 d-none d-lg-block regiser-bg"></div>
        <div class="col-lg-7">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                </div>
                <form class="user" id="registerForm">
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" class="form-control form-control-user" name="firstname" id="FirstName"
                                placeholder="First Name">
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control form-control-user" name="lastname" id="LastName"
                                placeholder="Last Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control form-control-user" name="email" id="InputEmail"
                            placeholder="Email Address">
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="password" class="form-control form-control-user" name="password" id="InputPassword"
                                placeholder="Password">
                        </div>
                        <div class="col-sm-6">
                            <input type="password" class="form-control form-control-user" name="password_confirmation" id="RepeatPassword"
                                placeholder="Repeat Password">
                        </div>
                    </div>
                    <button type="submit" id="RegisterBtn" class="btn btn-primary btn-user btn-block">Register Account</button>
                    <hr>
                    <a href="index.html" class="btn btn-google btn-user btn-block">
                        <i class="fab fa-google fa-fw"></i> Register with Google
                    </a>
                    <a href="index.html" class="btn btn-facebook btn-user btn-block">
                        <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                    </a>
                </form>
                <hr>
                <div class="text-center">
                    <a class="small" href="/forgetpassword">Forgot Password?</a>
                </div>
                <div class="text-center">
                    <a class="small" href="/">Already have an account? Login!</a>
                </div>
            </div>
        </div>
    </div>
</x-model-layout>
