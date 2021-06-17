<x-model-layout title="Resetpassword">
    <div class="alertContainer">
        <div class="alert alert-success m-1 d-none">
            <h5 class="text-center flash"></h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 d-none d-lg-block forgetpass-bg"></div>
        <div class="col-lg-6">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                    <p class="mb-4">We get it, stuff happens. Just enter your email address below
                        and we'll send you a link to reset your password!</p>
                </div>
                <form id="passRecoverymail" class="user" method="POST">
                    <div class="form-group">
                        <input type="email" class="form-control form-control-user" name="email" id="forgetPassEmail"
                            aria-describedby="emailHelp" placeholder="Enter Email Address...">
                    </div>
                    <button type="submit" id="fpbtn" class="btn btn-primary btn-user btn-block">Reset Password</button>
                </form>
                <hr>
                <div class="text-center">
                    <a class="small" href="/register">Create an Account!</a>
                </div>
                <div class="text-center">
                    <a class="small" href="/">Already have an account? Login!</a>
                </div>
            </div>
        </div>
    </div>
</x-model-layout>
