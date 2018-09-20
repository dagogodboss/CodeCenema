/** comment form */

let $form   = $('form#comment-form')
  , $taBody = $form.find('textarea[name=body]')
  , $parent = $form.find('input[name=parent]')
  , $submit = $form.find('[type=submit]')
  , $loader = $form.find('.loader');

$taBody.keyup(function () {
  let body = $(this).val().trim();
  $submit.prop('disabled', !body);
});

$form.on('clear', function () {
  $parent.val('');
  $taBody.val('');
});

$form.submit(function (e) {
  e.preventDefault();

  //trim comment body
  $taBody.val($taBody.val().trim());

  let body = $taBody.val();
  if (!body) {
    $taBody.focus();
    $submit.prop('disabled', true);
    return false;
  }

  $.ajax({
    url: '/comment/add',
    type: 'post',
    data: $form.serialize(),
    beforeSend() {
      $loader.removeClass('invisible');
    },
    complete() {
      $loader.addClass('invisible');
    },
    success(res) {
      $form.trigger('clear');
      $('.comments').append(res.comment);
    }
  });

});