$(document).ready(function(){
    const regular_username = /^([a-zA-Z_]+)([a-zA-Z_0-9]+)$/;
    const regular_email = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    const regular_phone = /^[0-9]{10}$/;

    let error_status;

    let username_elem_signin = $('.form-signin input.username');
    let password_elem_signin = $('.form-signin input.password');
    username_elem_signin.blur(function(){
        if(username_elem_signin.val() === ''){
            error_status = true;
            username_elem_signin.addClass('error');
            username_elem_signin.parent().find($('p.error-msg')).text('Username không được để trống');
            username_elem_signin.parent().find($('label.error')).text('').css('display','none');
        } else {
            error_status = false;
            username_elem_signin.removeClass('error');
            username_elem_signin.parent().find($('p.error-msg')).text('');
        }
    });
    password_elem_signin.blur(function () {
        if(password_elem_signin.val() === ''){
            error_status = true;
            password_elem_signin.addClass('error');
            password_elem_signin.parent().find($('p.error-msg')).text('Password không được để trống');
            password_elem_signin.parent().find($('label.error')).text('').css('display','none');
        } else {
            error_status = false;
            password_elem_signin.removeClass('error');
            password_elem_signin.parent().find($('p.error-msg')).text('');
        }
    });
    $('.form-signin').submit(function(event){
        let form = $(this);
        //validate username
        // debugger;
        if(username_elem_signin.val() === ''){
            event.preventDefault();
            error_status = true;
            username_elem_signin.addClass('error');
            username_elem_signin.parent().find($('p.error-msg')).text('');
        } else {
            error_status = false;
            username_elem_signin.removeClass('error');
        }
        //validate password
        if(username_elem_signin.val() !== ''){
            if(password_elem_signin.val() === ''){
                event.preventDefault();
                error_status = true;
                password_elem_signin.addClass('error');
                password_elem_signin.parent().find($('p.error-msg')).text('');
            } else {
                error_status = false;
                password_elem_signin.removeClass('error');
            }
        }

        console.log(error_status);

        /* Phần bên dưới để xử lí khi bên fe hết lỗi và gửi request sang bên be,
        be check xong xuôi r trả response sang fe làm gì tiếp theo (code dưới là ví dụ ở bài cũ của em),
        tùy thuộc vào a validate ở be ntn thì chỉnh sửa lại */
        if(error_status === false){
            // event.preventDefault();
            console.log('Done!');
            /*$.ajax({
                type: "POST",
                url: "index.php?controller=user&action=checkRegister",
                data: form.serialize(),
                success: function (response) {
                    if(response == 'true'){
                        alert("Đăng ký thành công");
                        location.replace("index.php?controller=user&action=login");
                    } else {
                        alert("Đăng ký thất bại");
                    }
                }
            });*/
        }
    });

    $('.form-signin').validate({
        onfocusout: false,
        onkeyup: false,
        onclick: false,
        rules: {
            "username": {
                required: true
            },
            "password": {
                required: true
            },
        },
        messages: {
            "username": {
                required: "Username không được để trống"
            },
            "password": {
                required: "Password không được để trống"
            },
        }
    });

    let username_elem = $('.form-signup input.username');
    let password_elem = $('.form-signup input.password');
    let email_elem = $('.email');
    let full_name_elem = $('.full-name');
    username_elem.blur(function(){
        if(username_elem.val() === ''){
            error_status = true;
            username_elem.addClass('error');
            username_elem.parent().find($('p.error-msg')).text('Username không được để trống');
            username_elem.parent().find($('label.error')).text('').css('display','none');
        } else if(!regular_username.test(username_elem.val())) {
            error_status = true;
            username_elem.addClass('error');
            username_elem.parent().find($('p.error-msg')).text('Username sai định dạng');
            username_elem.parent().find($('label.error')).text('').css('display','none');
        } else {
            error_status = false;
            username_elem.removeClass('error');
            username_elem.parent().find($('p.error-msg')).text('');
        }
    });
    password_elem.blur(function () {
        if(password_elem.val() === ''){
            error_status = true;
            password_elem.addClass('error');
            password_elem.parent().find($('p.error-msg')).text('Password không được để trống');
            password_elem.parent().find($('label.error')).text('').css('display','none');
        } else if(password_elem.val().length < 5){
            error_status = true;
            password_elem.addClass('error');
            password_elem.parent().find($('p.error-msg')).text('Password phải lớn hơn 5 ký tự');
            password_elem.parent().find($('label.error')).text('').css('display','none');
        } else {
            error_status = false;
            password_elem.removeClass('error');
            password_elem.parent().find($('p.error-msg')).text('');
        }
    });
    email_elem.blur(function () {
        if(email_elem.val() !== '' && !regular_email.test(email_elem.val())){
            error_status = true;
            email_elem.addClass('error');
            email_elem.parent().find($('p.error-msg')).text('Email sai định dạng');
            email_elem.parent().find($('label.error')).text('').css('display','none');
        } else {
            error_status = false;
            email_elem.removeClass('error');
            email_elem.parent().find($('p.error-msg')).text('');
        }
    });
    full_name_elem.blur(function () {
        if(full_name_elem.val() === ''){
            error_status = true;
            full_name_elem.addClass('error');
            full_name_elem.parent().find($('p.error-msg')).text('Họ và tên không được để trống');
            full_name_elem.parent().find($('label.error')).text('').css('display','none');
        } else {
            error_status = false;
            full_name_elem.removeClass('error');
            full_name_elem.parent().find($('p.error-msg')).text('');
        }
    });
    // $('.form-signup').submit(function(event){
    //     let form = $(this);
    //     // debugger;
    //     //validate username
    //     if(username_elem.val() === ''){
    //         event.preventDefault();
    //         error_status = true;
    //         username_elem.addClass('error');
    //         username_elem.parent().find($('p.error-msg')).text('');
    //     } else {
    //         error_status = false;
    //         username_elem.removeClass('error');
    //     }
    //
    //     //validate password
    //     if(password_elem.val() === ''){
    //         event.preventDefault();
    //         error_status = true;
    //         password_elem.addClass('error');
    //         password_elem.parent().find($('p.error-msg')).text('');
    //     } else if(password_elem.val().length < 5){
    //         event.preventDefault();
    //         error_status = true;
    //         password_elem.addClass('error');
    //         password_elem.parent().find($('p.error-msg')).text('');
    //     } else {
    //         error_status = false;
    //         password_elem.removeClass('error');
    //     }
    //
    //     //validate full name
    //     if(full_name_elem.val() === ''){
    //         event.preventDefault();
    //         error_status = true;
    //         full_name_elem.addClass('error');
    //         full_name_elem.parent().find($('p.error-msg')).text('');
    //     } else {
    //         error_status = false;
    //         full_name_elem.removeClass('error');
    //     }
    //
    //     //validate email
    //     if(email_elem.val() !== ''){
    //         if(!regular_email.test(email_elem.val())){
    //             event.preventDefault();
    //             error_status = true;
    //             email_elem.addClass('error');
    //             email_elem.parent().find($('p.error-msg')).text('');
    //         } else {
    //             error_status = false;
    //             email_elem.removeClass('error');
    //         }
    //     }
    //
    //     console.log(error_status);
    //
    //     /* Phần bên dưới để xử lí ajax khi bên fe hết lỗi và gửi request sang bên be,
    //     be check xong xuôi r trả response sang fe làm gì tiếp theo (code dưới là ví dụ ở bài cũ của em),
    //     tùy thuộc vào a validate ở be ntn thì chỉnh sửa lại */
    //     if(error_status === false){
    //         event.preventDefault();
    //         console.log('Done!');
    //         /*$.ajax({
    //             type: "POST",
    //             url: "index.php?controller=user&action=checkRegister",
    //             data: form.serialize(),
    //             success: function (response) {
    //                 if(response == 'true'){
    //                     alert("Đăng ký thành công");
    //                     location.replace("index.php?controller=user&action=login");
    //                 } else {
    //                     alert("Đăng ký thất bại");
    //                 }
    //             }
    //         });*/
    //     }
    // });

    $('.form-signup').validate({
        onfocusout: false,
        onkeyup: false,
        onclick: false,
        rules: {
            "username": {
                required: true
            },
            "password": {
                required: true,
                minlength: 5
            },
            "full_name": {
                required: true
            },
            "email": {
                email: true
            }
        },
        messages: {
            "username": {
                required: "Username không được để trống"
            },
            "password": {
                required: "Password không được để trống",
                minlength: "Password phải lớn hơn 5 ký tự"
            },
            "full_name": {
                required: "Họ và tên không được để trống"
            },
            "email": {
                email: "Email sai định dạng"
            }
        }
    });
})
