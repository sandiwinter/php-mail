# php-mail
Universal PHP mail sending script for any HTML theme

1. html From example
 * for recieve messages form should be inlcude selector *.alerts_box
 

```html
<form class="js-ajax-form">
    <div class="alerts_box"></div>
    <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
    <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    <input name="name" type="text" class="form-control" id="exampleInputName" placeholder="Name">
    <input name="check" type="checkbox" class="form-check-input" id="exampleCheck1">
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
```

2. Jquery example, requred jquery
```javascript
 * 
 * Set class for forms like "js-ajax-form" or change to another selector
 * in "data_ajax" , define url to php send file
<script>
    $('.js-ajax-form').submit(function(e){
        
        e.preventDefault();
        var form = $(this);
        var form_data = form.serializeArray();
        var ajax_url = form.attr('data-ajax') || "mail_send.php";

        var original_button_text = form.find('button').html();

        form.find('button').append("...");
        
        $.post(ajax_url, form_data, function(response_data){
            
            if(response_data.success) {
                form.find('input').val('');
            }
            form.find('.alerts_box').html('');

            if(response_data.message) {
                form.find('.alerts_box').html(response_data.message)
            }
        }, 'json').fail(function(xhr, status, error) {
            console.log(xhr.responseText);
            console.log(error);
        }).always(function() {
            form.find('button').html(original_button_text);
        });

        return false;
    })
</script>
```
