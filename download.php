<?php
require("includes/header.php");
?> 
<?php
require("config/config.php");
?> 


<?php
if(!isset($_SERVER['HTTP_REFERER']))
{
  header("location: index.php");
  exit;
}


$select = $con->query("SELECT * FROM cart WHERE user_id='$_SESSION[user_id]'");
$select->execute();

$allProducts = $select->fetchAll(PDO::FETCH_OBJ);


// // $zipname = 'bookstore.zip';
// // $zip = new ZipArchive;
// // $zip->open($zipname, ZipArchive::CREATE);
// // foreach ($allProducts as $product) {
// //   $zip->addFile("admin-panel/products-admins/books/". $product->pro_file);
// // }
// // $zip->close();


// // header('Content-Type: application/zip');
// // header('Content-disposition: attachment; filename='.$zipname);
// // readfile($zipname);







//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'send2rupayan2002@gmail.com';                     //SMTP username
    $mail->Password   = 'zkltvzsjpuwhtjaf';                               //SMTP password
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Sender
    $mail->setFrom('send2rupayan2002@gmail.com', 'Bookstore');
    //Add a recipient
    $mail->addAddress($_SESSION['email'],'user');     
    

    foreach($allProducts as $products) {
      $path  = 'admin-panel/products-admins/books';
      //$file = $products->pro_file;

      for($i=0; $i<count($allProducts); $i++) {
        
        $mail->addAttachment($path . "/" . $products->pro_file);         //Add attachments

      }
  }


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'The Books you bought';
    $mail->Body    = 'Here are your books, you paid'.$_SESSION['price'].'$ <b>Thanks for buying this from our online store.</b>';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    $select = $con->query("DELETE FROM cart WHERE user_id='$_SESSION[user_id]'");
    $select->execute();

    header("location: success.php");
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
