$('#add_btn').click(function () {
    $('#modal').fadeToggle();
});

$(document).click(function (e) {
    const $modal = $('#modal');
    const $btn = $('#add_btn');
    if (!$modal.is(e.target) && $modal.has(e.target).length === 0 &&
        !$btn.is(e.target) && $btn.has(e.target).length === 0) {
        $modal.fadeOut();
    }
});

// registration request
$('#registerForm').on('submit', function (event) {
    event.preventDefault();
    const $form = $('#registerForm');
    const btn = $('#RegisterBtn');
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: '/registersuccess',
        type: 'POST',
        data: $form.serialize()
    }).done(res => {
        if (res.status == true) {
            btn.addClass('successColor');
            btn.html(res.message);
            setTimeout(() => {
                btn.removeClass('successColor');
                btn.html('Register Account');
            }, 4000);
            document.getElementById('registerForm').reset();
        } else {
            if (res.Email_error) {
                btn.addClass('errcolor');
                btn.html(res.Email_error);
                setTimeout(() => {
                    btn.removeClass('errcolor');
                    btn.html('Register Account');
                }, 4000);
            } else {
                if (res.error.firstname != undefined) {
                    const firstname = $('#FirstName');
                    firstname.addClass('err');
                    firstname.attr("placeholder", res.error.firstname[0]);
                    setTimeout(() => {
                        firstname.removeClass('err');
                        firstname.attr("placeholder", "First Name");
                    }, 4000);
                }
                if (res.error.lastname != undefined) {
                    const lastname = $('#LastName');
                    lastname.addClass('err');
                    lastname.attr("placeholder", res.error.lastname[0]);
                    setTimeout(() => {
                        lastname.removeClass('err');
                        lastname.attr("placeholder", "Last Name");
                    }, 4000);
                }
                if (res.error.email != undefined) {
                    const email = $('#InputEmail');
                    email.addClass('err');
                    email.attr("placeholder", res.error.email[0]);
                    setTimeout(() => {
                        email.removeClass('err');
                        email.attr("placeholder", "Email Address");
                    }, 4000);
                }
                if (res.error.password != undefined) {
                    const passcode = $('#InputPassword');
                    if (passcode.val().length == 0) {
                        passcode.addClass('err');
                        passcode.attr("placeholder", res.error.password[0]);
                        setTimeout(() => {
                            passcode.removeClass('err');
                            passcode.attr("placeholder", "Password");
                        }, 4000);
                    } else {
                        btn.addClass('errcolor');
                        btn.html(res.error.password[0]);
                        setTimeout(() => {
                            btn.removeClass('errcolor');
                            btn.html('Register Account');
                        }, 4000);
                    }
                }
                if (res.error.password_confirmation != undefined) {
                    const passcode2 = $('#RepeatPassword');
                    if (passcode2.val().length == 0) {
                        passcode2.addClass('err');
                        passcode2.attr("placeholder", res.error.password_confirmation[0]);
                        setTimeout(() => {
                            passcode2.removeClass('err');
                            passcode2.attr("placeholder", "Repeat Password");
                        }, 4000);
                    }
                }
            }
        }
    })
});

//login request
$('#user_Login').on('submit', function (event) {
    event.preventDefault();
    const $mail = $('#login_email');
    const $pass = $('#login_password');
    const $btn = $('#loginBtn');
    const $form = $('#user_Login');
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: '/login_user',
        type: 'POST',
        data: $form.serialize()
    }).done(res => {
        if (res.status == true) {
            window.location.href = res.message;
        } else {
            if (res.authentication) {
                $btn.addClass('errcolor');
                $btn.html(res.authentication);
                setTimeout(() => {
                    $btn.removeClass('errcolor');
                    $btn.html('Login');
                }, 4000);
            } else {
                if (res.Email_error) {
                    $btn.addClass('errcolor');
                    $btn.html(res.Email_error);
                    setTimeout(() => {
                        $btn.removeClass('errcolor');
                        $btn.html('Login');
                    }, 4000);
                } else {
                    if (res.error.email != undefined) {
                        $mail.addClass('err');
                        $mail.attr("placeholder", res.error.email[0]);
                        setTimeout(() => {
                            $mail.removeClass('err');
                            $mail.attr("placeholder", "Enter Email Address...");
                        }, 4000);
                    }
                    if (res.error.password != undefined) {
                        $pass.addClass('err');
                        $pass.attr("placeholder", res.error.password[0]);
                        setTimeout(() => {
                            $pass.removeClass('err');
                            $pass.attr("placeholder", "Password");
                        }, 4000);
                    }
                }
            }
        }
    });
});

//add a group
$('#group_form').on('submit', function (event) {
    event.preventDefault();
    const $form = $('#group_form');
    const $inpfield = $('#grp_inp');
    const $msg = $('#msg');
    const $check = $('#group_ul').children('#null_groups');
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: '/add_group',
        type: 'POST',
        data: $form.serialize()
    }).done(res => {
        if (res.status == true) {
            $msg.html(res.message);
            setTimeout(() => {
                $msg.html('');
            }, 3000);
            document.getElementById('group_form').reset();
            if ($check.length > 0) {
                $('#group_ul').empty();
                $('#group_ul').append('<li><a href="#">' + res.data.type + '</a></li>')
            } else {
                $('#group_ul').append('<li><a href="#">' + res.data.type + '</a></li>')
            }
        } else {
            $inpfield.addClass('err');
            $inpfield.attr("placeholder", res.error.group_type[0]);
            setTimeout(() => {
                $inpfield.removeClass('err');
                $inpfield.attr("placeholder", "Enter Group Name..");
            }, 3000);
        }
    });
});

//add a checklist
$('#checklist_form').on('submit', function (event) {
    event.preventDefault();
    const $form = $('#checklist_form');
    const $chkinput = $('#check_inp');
    const $check_defualt = $('#check_defualt');
    const $checkoptinputs = $('#check_opts');
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: '/add_checklist',
        type: 'POST',
        data: $form.serialize()
    }).done(res => {
        if (res.status == true) {
            console.log(res);
            document.getElementById('checklist_form').reset();
        } else {
            $chkinput.addClass('err');
            $checkoptinputs.addClass('err errcoloronly');
            $chkinput.attr("placeholder", res.error.checklist[0]);
            $check_defualt.html(res.error.group_id[0]);
            setTimeout(() => {
                $chkinput.removeClass('err');
                $checkoptinputs.removeClass('err errcoloronly');
                $chkinput.attr("placeholder", 'Enter checklist name..');
                $check_defualt.html('Select-group');
            }, 3000);
        }
    });
});