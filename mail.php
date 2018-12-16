<? php 
if (isset($_POST['send'])) {  
    $to = 'kaseylawrence@gmail.com';
    $subject = 'From $name';
    $message = 'Name: ' . $_POST['name'] . "\r\n\r\n";
    $message .= 'Email: ' . $_POST['email'] . "\r\n\r\n"
    $message .= 'Comments: ' . $_POST['comments'];
    echo $message;
}
?>