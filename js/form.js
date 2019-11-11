$(document).ready(function(){

    //проверка полей
    function check(message) {
        if (message) {

            $('#messageShow').html(message);
            $('#messageShow').show();
        }
    }

    //подсветка пустого поля
    function lightEmpty(field) {
        field.css("border", "red solid 1px");
        // Через полсекунды удаляем подсветку
        setTimeout(function () {
            field.removeAttr('style');
        }, 500);
    }

    $('#contact-form').submit(function (event) {
        event.preventDefault();
        var name = $('#name').val();
        var lastname = $('#lastname').val();
        var email = $('#email').val();
        var phone = $('#phone').val();

        var error = false; // прeдвaритeльнo oшибoк нeт
        var msg = [];

        //проверка имени
        if ( name.length < 2) {
            msg = 'Имя не должно быть короче 2-х символов';
            check(msg);
            lightEmpty($('#name'));
            error = true; // oшибкa
        }
    else if (lastname.length < 2) {
            msg = 'Фамилия не должна быть короче 2-х символов';
            check( msg);
            lightEmpty($('#lastname'));
            error = true; // oшибкa
        }
        else if ( email == '') {
            msg = 'Введите свой электронный адрес';
            check(msg);
            lightEmpty($('#email'));
            error = true; // oшибкa
        }
        else if ( phone == '' || !phone.replace (/\D/g, '')) {
            msg = 'Введите корректный номер телефона';
            check( msg);
            lightEmpty($('#phone'));
            error = true; // oшибкa
        }
        if ( !error) {
             msg == null;

            check( msg);

            //записываем в массив данные
          //  var postData =  $(this).serialize();
            var postData = {
                name: name,
                lastname: lastname,
                email: email,
                phone: phone,
            };

            $.ajax({
                type: 'POST',
                async: true,
                url: '/index.php',
                data: postData,
                dataType: 'json',
                success: function (result) {

                    console.log('OK!');
                    if (result['success']) {

                        $('.regOk').html(result['message']); //вывод успеха редактирования на страницу
                    }
                },
                error: function(jqxhr, textStatus, errorThrown) {
                    console.log("jqXHR: ", jqxhr);
                    console.log("textStatus: ", textStatus);
                    console.log("errorThrown: ", errorThrown);
                    alert('ОШИБКА!!');
                }
            });
            return false;
        }
    });
});