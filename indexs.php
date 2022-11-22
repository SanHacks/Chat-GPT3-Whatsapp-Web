<?php

require __DIR__ . '/vendor/autoload.php';

use Orhanerday\OpenAi\OpenAi;

$open_ai = new OpenAi('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');

if (isset($_POST['msg'])) {
    $complete = $open_ai->complete([
 'engine' => 'davinci',
    'prompt' => 'Hello',
    'temperature' => 0.9,
    'max_tokens' => 300,
    'frequency_penalty' => 0,
    'presence_penalty' => 0.6
    ]);

    var_dump($complete);

    //$obj = json_decode($complete, true);
	$text_field = json_decode($complete, true); 
    $feedback= $text_field->text;
	
}
?>

<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chat</title>
    	<link rel="stylesheet" type="text/css" media="screen" href="ext.css" />
  </head>
  <body>
    <h1>Chat</h1>
    <div id="chat">
      <div id="chat-header">
        Chatbot
      </div>
      <?php if (isset($feedback)) { ?>
        <div class="msg ai">
          <?php echo $feedback; ?>
        </div>
      <?php } ?>
      <div class="msg human">
        <?php echo $_POST['msg']; ?>
      </div>
    </div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <input type="text" name="msg">
      <input type="submit" value="Send">
    </form>
  </body>
</html>