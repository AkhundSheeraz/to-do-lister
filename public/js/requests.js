// registration request
$('#registerForm').on('submit',function(event){
    event.preventDefault();
    const $form = $('#registerForm');
    $.ajax({
        headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
        url: '/registersuccess',
        type: 'POST',
        data: $form.serialize()
    }).done(res=>{
        console.log(res);
        // append to blade from here.
    })
});