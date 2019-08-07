<!DOCTYPE html>
<html >
<?php 
    require_once('config.php');
    $customerName = "Tony";
    $customerEmail = "tony@tonyemail.com";
    $freight = "AUD$10";
    $amountTotal = 6000;
    $amountTotalStr = "AUD$60";
    $description = "Payment from ".$customerName;
?>
<head>
  <meta charset="UTF-8">
  <title>Stripe Payment Form</title>  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="wrapper">
  <form action="charge.php" method="post">
  <input type="hidden" name="customerEmail" value="<?php echo $customerEmail; ?>">
  <input type="hidden" name="amountTotal" value="<?php echo $amountTotal; ?>">
  <input type="hidden" name="amountTotalStr" value="<?php echo $amountTotalStr; ?>">
  <input type="hidden" name="description" value="<?php echo $description; ?>">
  
  <div class="table">
    
    <div class="row header green">
      <div class="cell">
        Customer
      </div>
      <div class="cell">
        &nbsp;
      </div>

    </div>
    
    <div class="row">
      <div class="cell">
        Name
      </div>
      <div class="cell">
        <?php echo $customerName;?>
      </div>

    </div>
    <div class="row">
      <div class="cell">
        Email
      </div>
      <div class="cell">
        <?php echo $customerEmail;?>
      </div>

    </div>
  </div> 
 
  <div class="table">
    <div class="row header blue">
      <div class="cell">
        Product ID
      </div>
      <div class="cell">
        Description
      </div>
      <div class="cell">
        Quantity
      </div>
      <div class="cell">
        Unit Price
      </div>
      <div class="cell">
        Line Total
      </div> 
    </div>
    
    <div class="row">
      <div class="cell">
        1
      </div>
      <div class="cell">
        item 1
      </div>
      <div class="cell">
        1
      </div>
      <div class="cell">
        AUD$10
      </div>
      <div class="cell">
        AUD$10
      </div>
    </div>
    <div class="row">
      <div class="cell">
        2
      </div>
      <div class="cell">
        item 2
      </div>
      <div class="cell">
        2
      </div>
      <div class="cell">
        AUD$5
      </div>
      <div class="cell">
        AUD$10
      </div>
    </div>
    <div class="row">
      <div class="cell">
        3
      </div>
      <div class="cell">
        item 3
      </div>
      <div class="cell">
        1
      </div>
      <div class="cell">
        AUD$30
      </div>
      <div class="cell">
        AUD$30
      </div>
    </div>    

    <div class="row">
      <div class="cell">
        &nbsp;
      </div>
      <div class="cell">
        &nbsp;
      </div>
      <div class="cell">
        &nbsp;
      </div>
      <div class="cell-align-right">
        Freight
      </div>
      <div class="cell">
        <?php echo $freight;?>
      </div>
    </div> 
    <div class="row">
      <div class="cell">
        &nbsp;
      </div>
      <div class="cell">
        &nbsp;
      </div>
      <div class="cell">
        &nbsp;
      </div>
      <div class="cell-align-right">
        Total
      </div>
      <div class="cell">
        <?php echo $amountTotalStr;?>
      </div>
    </div>
  </div>
  
  <div class="payment-button">
    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
          data-key="<?php echo $stripe['publishable_key']; ?>"
          data-amount="<?php echo $amountTotal; ?>" 
          data-description="Payment from: <?php echo $customerName; ?>"
          data-currency="aud">
    </script>
  </div>
  </form>  
  
  </div>

  </body>
</html>
