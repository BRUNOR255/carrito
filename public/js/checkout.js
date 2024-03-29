Stripe.setPublishableKey('pk_test_gfxAiOXto5Ldd3ENO6uDVFot00Q5TXAnGb');

var $form = $('#checkout-form');

$form.submit(function(event) {
  $('#charge-error').addClass('hidden');
  $form.find('button').prop('disabled',true);

    Stripe.card.createToken({
      name:$('#card-name').val(),
      number: $('#card-number').val(),
      exp_month: $('#card-expiry-month').val(),
      exp_year: $('#card-expiry-year').val(),
      cvc: $('#card-cvc').val(),
      address_zip: $('#address_zip').val(),

  }, stripeResponseHandler);
  return false;
});

function stripeResponseHandler(status, response)
{
  if (response.error)
  {
    $('#charge-error').removeClass('hidden');
    $('#charge-error').text(response.error.message);
    $form.find('button').prop('disabled', false);
  }
  else
  {
    var token = response.id;
    $form.append($('<input type="hidden" name="stripeToken"/>').val(token));

    // submit the form:
    $form.get(0).submit();
  }
}
