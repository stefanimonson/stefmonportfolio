<?php
  session_start();
?>
<!DOCTYPE html>
<head>
  <!--Items referenced in page -->
  <link rel="stylesheet" href="../styles.css"> <!-- CSS Stylesheet -->
  <script type="text/javascript" src="../togglenav.js"></script> <!-- Navigation Javascript Script-->
  <link rel="icon" href="../favicon.ico"> <!-- Browser icon -->

  <?php
    if(!isset($_POST['submit'])) {
	  //This page should not be accessed directly. Need to submit the form.
	  $responsetitle = 'Stef Monson - Form Error';
      $response = 'Please be sure to submit the form!';
    }
    
    $name = $_POST['name'];
    $email = $_POST['_replyto'];
    $message = $_POST['message'];
    $responsetitle='';
    $response='';
  
    if(empty($message) or $message == "Enter message...") {
      $responsetitle = 'Stef Monson - Form Error';
      $response = 'Please be sure to enter a message before submitting the form!';
    } else if(IsInjected($email)) {
      $responsetitle = 'Stef Monson - Form Error';
      $response = 'There was an error in the e-Mail address that you submitted.'; 
        
    } else {
      $email_from = 'stefani@stefanimonson.info';
      $email_subject = "Portfolio comment";
      $email_body = "You have received a new message from: $name at $email\n\n".
                            "$message \n".

      $to = "stefani@stefanimonson.info";
      $headers = "From: $email_from \r\n";
      $headers .= "Reply-To: $email \r\n";
      mail($to,$email_subject,$email_body,$headers);

      $responsetitle = 'Stef Monson - Thank You!';
      $response = 'Thank you for your input!';
    }
  ?>

  <title>
    <?php 
      echo $responsetitle;
    ?>
  </title>
  
</head>

<body onclick="togglenav(event)" onresize="togglenavresize()">
  <!-- Mobile Header -->
  <div class="topbar no-select">
    <h1><span class="headleft">STEF MONSON</span><span class="headright">
      <button id="burgerbutton">&#9776;</button></span></h1>
  </div> <!--class="topbar"-->

  <!-- Mobile Navigation Menu -->
  <ul class="topnav no-select" id="menu">
    <li><a href="index.html">Home</a></li>
    <li><a href="professional.html">Experience</a></li>
    <li><a href="educational.html">Education</a></li>
    <li><a href="showcase.html">Showcase</a></li>
    <li><a class="active" href="info.html">Info</a></li>
  </ul>
  
    <!--Side Image -->
    <image class="right" src="images/stefani2.jpg" alt="Stephanie Monson" />
  
    <!-- padded div to house page content -->
    <div class="padded">
    <h2>
    <?php
    echo $response;
    ?>
    </h2>

    <form action="info.html">
      <input type="submit" value="Back to Info Page" />
    </form>

    </div> <!--class="padded"-->
    
    <div class="footer">
      <p class="quote">"You don&#39;t really know how beautiful a girl is until you meet her, all her beauty is in her personality." - Zac Efron</p>
    </div> <!--class="footer"-->
    
  </body>
</html>

<?php
function IsInjected($str)
{
    $injections = array('(\n+)',
           '(\r+)',
           '(\t+)',
           '(%0A+)',
           '(%0D+)',
           '(%08+)',
           '(%09+)'
           );
    $inject = join('|', $injections);
    $inject = "/$inject/i";
    if(preg_match($inject,$str))
    {
      return true;
    }
    else
    {
      return false;
    }
}

?>
