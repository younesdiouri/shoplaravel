(function ($) {


    // Auto-formattage des champs

var cleave_credit_card = new Cleave('.credit-card', {
    creditCard: true
});

var cleave_expiration = new Cleave('.expiration-date', {
    date: true,
    datePattern: ['m', 'y']
});

// Stripe

$('#payment-form').submit(function (e) {

    e.preventDefault();

    var $bouton = $('#shop-button');
    var bouton_html = $bouton.html();

    $bouton.html("Votre payement est en cours <i class='fa fa-spinner fa-spin '></i>");
    $bouton.attr('disabled' , 'disabled');

    var name = $('#name').val();
    var number = $('#card-number').val();
    var exp_month = $('#card-expiry').val().split('/')[0];
    var exp_year = $('#card-expiry').val().split('/')[1];
    var cvc = $('#cvc').val();

    console.log(name);
    console.log(number);
    console.log(exp_month);
    console.log(exp_year);
    console.log(cvc);

    Stripe.setPublishableKey('pk_test_duCcCwuIqdpydw3NdEVJpMJi');

    Stripe.card.createToken({
        number : number,
        exp_month : exp_month,
        exp_year : exp_year,
        cvc : cvc
    }, stripeResponseHandler);

});


    function stripeResponseHandler(status, response) {

        if (response.error) {

            var $bouton = $('#shop-button');
            var bouton_html = '<i class="fa fa-shopping-cart" aria-hidden="true"></i> Acheter';

            $bouton.html(bouton_html);
            $bouton.removeAttr('disabled');

            if (document.getElementById('shop-error')) $('#shop-error').remove();
            if (document.getElementById('shop-success')) $('#shop-success').remove();

            $('#payment-form').append("<div id='shop-error' class='alert alert-danger'> <strong>" + response.error.message + "</strong> </div>");

        }

        else {

            var token = response.id;
            $('#payment-form').append($('<input id="stripeToken" type="hidden" name="stripeToken">').val(token));


            // Appelle de l'action

            var name = $('#name').val();
            var email = $('#email').val();
            var number = $('#card-number').val();
            var exp_month = $('#card-expiry').val().split('/')[0];
            var exp_year = $('#card-expiry').val().split('/')[1];
            var cvc = $('#cvc').val();
            var stripeToken = $('#stripeToken').val();


             var Stripe = {
                 name : name,
                 number : number,
                 email : email,
                 exp_month : exp_month,
                 exp_year : exp_year,
                 cvc : cvc,
                 stripeToken : stripeToken
             };

            $.post("payement.php", {Stripe: Stripe}, function (data) {

                $('#shop-button').html('<i class="fa fa-shopping-cart" aria-hidden="true"></i> Acheter');
                $('#shop-button').removeAttr('disabled');

                if (document.getElementById('shop-error')) $('#shop-error').remove();
                if (document.getElementById('shop-success')) $('#shop-success').remove();

                if (data == "on") {

                    $('#payment-form').append("<div id='shop-success' class='alert alert-success'> <strong> Votre paiement a été effectué avec succès </strong> </div>");

                    $(':input', '#payment-form')
                        .not(':button, :submit, :reset, :hidden')
                        .val('')
                        .removeAttr('checked')
                        .removeAttr('selected');

                }

                else {

                    $('#payment-form').append("<div id='shop-error' class='alert alert-danger jj'> <strong>" + data + "</strong> </div>");

                }

            });
        }
    }
    

})(jQuery);