<?php 
require_once'includes/config.php';
// use heredoc syntax to assign the html into a variable and heredoc syntax as my identifier I'm going to use EOT

try {
    
 
   $message = Swift_Message::newInstance() 
            ->setSubject('News Letter September')
            ->setFrom($from)
      
            ->addTo('luther@domain.nl','title of your first message')
            ->addTo('user@gmail.com','title other message')
            ->addTo('name3@domain.com','title of your third message');
            
            // embeding using the swift mailer library 
            $image = $message->embed(Swift_Image::fromPath('images/Diana_cracked.jpg'));
            $logo =  $message->embed(Swift_Image::fromPath('images/logo.jpg'));
           
            $html = <<<EOT
<!DOCTYPE html>
<html lang="en">
<head><title>September </title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<style type="text/css">
body {
    
    padding:0;
    margin:0;
}
img {
    
    max-width:100%;
}
#container {
        margin: 0 auto;
        position:relative;
        background-color:#fff;
        width:70%;
        min-height:500px;
        padding:2px;
        
    
}
#container h1 {
    margin: 0 auto;
    text-align:center;
    color:#00b3b3;
}




</style>
</head>
<body>
<div id="container">
<h1>September In Shutrit Art & Design</h1>
<center>
<table>
<tr>
<td style="width:55%;">
<h2 style="color:#00b3b3;">Restoring Diana</h2>
<p>In a  rather dramatic incident the portriat of lady Diana in Scallywags Restaurant The Hague was damaged.
 A crack in the area of the face and neck was created. Shutrit Art & Design  gladly accepted the commission of restoring the painting.<br>
 Sagi and Richard have been enjoying a fruitful  artist and patron relationship for a number of years.  
 The challenge will be to re-complete the canvas after the meticulous work of Janine Hilverdink who excuted this beatiful portrait in 2004
Shutrit Art and design is plannig to tackle this challenge by applying an extra layer to defuse the line created by the crack. </p>
</td>
<td style="width:45%;">
<figure>
 <img src="$image" alt="Painting Lady Diana">
<figcaption>Lady Diana</figcaption>   
</figure>
</td>
</tr>
<tr><td colspan=2>
  <center>
<p>Wishing You a productive month<br></p>
<a href="http://www.sagishutrit.com">
<img src="$logo" alt="logo">
</a>
</center>  
</td></tr>
</table>
</center>
</div>
</body>
</html>
EOT;
            
            $message->setBody($html, 'text/html');
       
            
 
       
            $transport = Swift_SmtpTransport::newINstance($smtp_server,465, 'ssl')
              ->setUsername($username)
              ->setPassword($password);
              
              
              $mailer = Swift_Mailer::newInstance($transport); 
              $result= $mailer->send($message);
               
               if($result) {
                  echo'Number Of emails Send :'. $result;
              } else {
                  echo"could not send Email";
              }
              
        
              
}
catch (Exception $e) {
    
    
   echo $e->getMessage();
}

   
