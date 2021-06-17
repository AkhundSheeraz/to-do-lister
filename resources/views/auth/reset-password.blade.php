<x-model-layout title="NewPassword">
    <div class="alertContainer">
        <div class="alert alert-danger m-1 d-none">
            <h5 class="text-center flash"></h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 d-none d-lg-block forgetpass-bg"></div>
        <div class="col-lg-6">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">Reset Your Password</h1>
                    <p class="mb-4">Please enter your info to reset password for your account!</p>
                </div>
                <form id="ResetpassForm" class="user" method="POST">
                    <div class="form-group">
                        <input type="email" class="form-control form-control-user" name="email" 
                            aria-describedby="emailHelp" placeholder="Enter Email Address...">
                    </div>
                    <div class="d-none">
                        <input type="text" class="form-control form-control-user" name="token" 
                            aria-describedby="emailHelp" value="{{ $token }}">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-user" name="password" 
                            aria-describedby="emailHelp" placeholder="Enter your new password...">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-user" name="password_confirmation" 
                            aria-describedby="emailHelp" placeholder="Confirm you password">
                    </div>
                    <button type="submit" id="passresetbtn" class="btn btn-primary btn-user btn-block">Change Password!</button>
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