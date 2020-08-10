<?php

/*
 * Mail send form
 *  
 * 
 */
/*
 * 
1. html From example
 * for recieve messages form should be inlcude selector *.alerts_box
<form class="js-ajax-form">
    <div class="alerts_box"></div>
    <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
    <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    <input name="name" type="text" class="form-control" id="exampleInputName" placeholder="Name">
    <input name="check" type="checkbox" class="form-check-input" id="exampleCheck1">
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

2. Jquery example, requred jquery
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
  
*/
 
$output = array();
$output['success'] = true;
$post = $_POST;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
    // to
    $to = 'from_mail';

    // to
    $from = 'to_mail';

    // subject
    $subject = 'Example Subject';

    // message
    $message = '
    <html>
    <head>
      <title>Example Message Title</title>
    </head>
    <body>
        <p>From Servicos</p>
        {dynamic_values}                            
    </body>
    </html>
    ';

    $data_mess= array();
    foreach($_POST as $key => $value){
        $data_mess []= '<p><strong>'.$key.':</strong> '.$value.'</p>';
    }

    $data_mess = implode('', $data_mess);
    $message = str_replace('{dynamic_values}', $data_mess, $message);


    // headers
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    // headers
    $headers .= 'From: Example text <'.$from.'>' . "\r\n";

    // Send
    if(mail($to, $subject, $message, $headers)) {
        $output['message'] = '<div class="alert alert-primary">
                               Message sent success
                            </div>';
    } else {
        $output['message'] = '<div class="alert alert-danger" role="alert">Message not sent!</div>';
    }
} else {
    /* error */
    $output['message'] = '<div class="alert alert-danger" role="alert">All fields are empty</div>';
    $output['success'] = false;
}


$json_output = json_encode($output);

header('Pragma: no-cache');
header('Cache-Control: no-store, no-cache');
header('Content-Type: application/json; charset=utf8');

echo $json_output;

exit();



