<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Payment Result</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<?php

  // include configuration file
  require_once('config.php');
  
  // include Stripe PHP library
  require_once('stripe-php/init.php');
  
  //set Stripe API key
  \Stripe\Stripe::setApiKey($stripe['secret_key']);

  $customerEmail = $_POST['customerEmail'];
  $amountTotal = $_POST['amountTotal'];
  $amountTotalStr = $_POST['amountTotalStr'];
  $description = $_POST['description'];
  
  $token  = $_POST['stripeToken'];

  $success =  FALSE;
  $result = "";
  $err = "";
  $content = "";
  $headerColor = "row header green";
  
  if (!empty($token)){
      try {
          // add customer to stripe
          $customer = \Stripe\Customer::create(array(
              'email' => $customerEmail,
              'source'  => $token
          ));

          // charge a credit or a debit card
          $charge = \Stripe\Charge::create(array(
              'customer' => $customer->id,
              'description' => $description,
              'amount'   => $amountTotal,
              'currency' => 'aud'));
          
          // get charge details
          $response = $charge->jsonSerialize(); 
          
          $status = $response['status'];
              
          if ($status == 'succeeded'){
              $success = TRUE;
          } else {
              $err = $response['failure_message'];
          }
          
      } catch(Stripe_Error $e) {
          $err = $e->getMessage();
      } catch (Exception $e) {
          $err = $e->getMessage();
      }
  } else {
      $err = "Payment form submission fails";
  }

  if ($success == TRUE) {
      $result = "Payment sucessful";
      $content = "Your payment (".$amountTotalStr.") has been received, thank you!";
  } else {
      $result = "Payment error";
      $content = $err;
      $headerColor = "row header";
  }
  
?>
<body>
  <div class="wrapper"><br>
  <form method="get" action="">
    <div class="table">
      <div class="<?php echo $headerColor;?>">
        <div class="cell">
          <?php echo $result;?>
        </div>
      </div>
      <div class="row">
        <div class="cell">
          <?php echo $content;?>
        </div>
      </div>
    </div>
  </form>
  </div>
</body>
</html>