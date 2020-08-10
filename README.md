# php-mail
Universal PHP mail sending script for any HTML theme

1. html From example
 * for recieve messages form should be inlcude selector *.alerts_box
 
<addr>
<form class="js-ajax-form">
    <div class="alerts_box"></div>
    <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
    <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    <input name="name" type="text" class="form-control" id="exampleInputName" placeholder="Name">
    <input name="check" type="checkbox" class="form-check-input" id="exampleCheck1">
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</addr>

2. Jquery example, requred jquery
<addr>
 * 
 * Set class for forms like "js-ajax-form" or change to another selector
 * in "data_ajax" , define url to php send file
<script>
    $('.js-ajax-form').submit(function(e){
        e.preventDefault();
        var form = $(this);
        var data = form.serializeArray();
        var data_ajax = form.attr('data-ajax') || "http://localhost/mail/mail_send.php";
        $.post(data_ajax, data, function(data){
            if(data.success) {
                form.find('input').val('');
            }
            form.find('.alerts_box').html('')
            if(data.message) {
                form.find('.alerts_box').html(data.message)
            }
        })
    })
</script>
</addr>
