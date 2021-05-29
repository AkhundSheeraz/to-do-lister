// registration request
$('#registerForm').on('submit', function (event) {
    event.preventDefault();
    const $form = $('#registerForm');
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: '/registersuccess',
        type: 'POST',
        data: $form.serialize()
    }).done(res => {
        if (res.status == true) {
            console.log(res);
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
                    const btn = $('#RegisterBtn');
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
    })
});