<?php  

require_once'includes/config.php';
//config.php has the email addresses  for  $recipients
$recipients = [

   $testing=>'Test Account 1',
   $test2,
   $test3=>'Test Account 3',
   $secret
];

try {
        //prepare email 
         $message = Swift_Message::newInstance()
         ->setSubject('FARBRENGEN/commemorating ג Tammuz')
         ->setFrom($from)
         ->setBody('test multiple');
         
         // create the transport use smtp of your hosting account 
          $transport = Swift_SmtpTransport::newInstance($smtp_server,465, 'ssl')
          ->setUsername($username)
          ->setPassword($password);
          
          $mailer = Swift_Mailer::newInstance($transport);
          
          $sent = 0;  
          $failures = [];   
          //send individual emails 
          foreach($recipients as $key=> $value) {
              // ensure numeric key 
              if(is_int($key)) {
                 $message->setTo($value);
              } else {
                     $message->setTo([$key=> $value]);
              }
              $sent += $mailer->send($message,$failures);
              }
          
              if($sent) {
                echo"number of emails send : $sent<br>";
              }
              
              if($failures) {
                 echo "could not send to the following addresses:<br>";
               
                 foreach($failures as $failure) {
                   echo $failure; 
                 }
              }
    
  } 
  catch (Exception $e) {
     echo $e->getMessage();
  }
    