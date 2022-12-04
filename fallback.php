
<?php
error_reporting(1);
require __DIR__ . '/vendor/autoload.php';

use Orhanerday\OpenAi\OpenAi;

$open_ai = new OpenAi('AUTHORIZATION TOKEN');
include"connect.php";
if(isset($_POST['msg'])) {
	$pp = $_POST['msg'];

			$tshifhing = time();
		$mtype = "sent";
		//Save the search record to database
		$saves = "INSERT INTO messages (message,timestamp, type) VALUES (?,?,?)";
		//Prepare Statements
		$spush= $pdo->prepare($saves);
		//Execution
		$spush->execute([$pp, $tshifhing, $mtype]);
		
		
		
    $complete = $open_ai->complete([
 'engine' => 'davinci',
    'prompt' => $pp,
    'temperature' => 0.9,
    'max_tokens' => 150,
	'start_text'    => "\nA:",
    'restart_text'  => "\nHuman: ",
    'frequency_penalty' => 0,
    'presence_penalty' => 0.6
    ]);

    

    //$obj = json_decode($complete, true);
	$text_field = json_decode($complete, true); 
    $feedback= $text->text;
	
	 $tt= $text_field['choices'];
					 foreach($tt as $tin){
						$them = $tin['text'];
						
							
		
		$tshifhinga = time();
		$metype = "received";
		//Save the search record to database
		$saves = "INSERT INTO messages (message,timestamp, type) VALUES (?,?,?)";
		//Prepare Statements
		$spush= $pdo->prepare($saves);
		//Execution
		$spush->execute([$them, $tshifhinga, $metype]);
	
}

	
	
		$searchs = "SELECT * FROM messages  ORDER BY id DESC LIMIT 100 ";
		$stmt = $pdo->prepare($searchs);
		$stmt->execute();
		$QP = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, viewport-fit=cover">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <meta name="theme-color" content="#2196f3">
  <meta http-equiv="Content-Security-Policy" content="default-src * 'self' 'unsafe-inline' 'unsafe-eval' data:">
  <title>saint</title>
  <link rel="icon" href="save.png">
  <link rel="stylesheet" href="https://unpkg.com/framework7/framework7-bundle.min.css">
  <link rel="stylesheet" href="https://unpkg.com/framework7-icons">
  <style>
    :root {

      --f7-navbar-height: 60px;
      /* --f7-searchbar-height: 50px; */
    }
    .panel-left {
      --f7-panel-width: 30%;
      min-width: 250px;
    }
    .navbar {
      --f7-navbar-bg-color: #EEE;
      --f7-navbar-text-color: #5C5C5C;
      --f7-navbar-border-color: #D7D0CA;
      --f7-navbar-link-color: var(--f7-navbar-text-color);
    }

    .navbar img {
      width: 40px;
      border-radius: 20px;
    }
    .navbar .icon {
      font-size: 28px;
    }
    .aurora .navbar .right a + a {
      margin-left: 15px;
    }
    .panel-left {
      border-right: 1px solid #D7D0CA;
    }
    .panel-left .page-content {
      --f7-page-navbar-offset: 60px;
    }
    .select-chat-page {
      --f7-list-margin-vertical: 0px;
      /* --f7-bars-bg-color: #FFF; */
      --f7-page-bg-color: #FFF;
      --f7-bars-border-color: transparent;
      --f7-navbar-font-size: 18px;
      --f7-navbar-title-font-weight: bold;

      --f7-searchbar-in-page-content-input-border-radius: 25px;
      --f7-searchbar-inner-padding-left: 15px;
      --f7-searchbar-inner-padding-right: 15px;
      --f7-searchbar-input-height: 35px;
      --f7-searchbar-input-border-radius: 18px;
      --f7-searchbar-height: 48px;
      --f7-searchbar-bg-color: #F8F8F8;
      --f7-searchbar-input-bg-color: #FFF;
      --f7-searchbar-input-text-color: #666;

      --f7-list-bg-color: transparent;
      --f7-list-border-color: #ebebeb;
      --f7-list-item-border-color: #ebebeb;

      --f7-list-item-min-height: 72px;
      --f7-list-item-title-text-color: #474747;
      --f7-list-item-subtitle-text-color: #666;
      --f7-list-item-after-text-color: #666;
      --f7-list-item-title-font-size: 16px;
      --f7-list-link-pressed-bg-color: rgba(0,0,0,0.2);
      --f7-list-link-hover-bg-color: rgb(235,235,235);
      --f7-list-media-item-padding-vertical: 12px;
      color: rgba(255,255,255,0.7);
    }
    .select-chat-page img {
      width: 48px;
      border-radius: 24px;
    }
    .select-chat-page .chat-menu-icon {
      display: none;
    }
    .select-chat-page .item-subtitle .text-container {
      overflow: hidden;
      white-space: nowrap;
      max-width: 100%;
      text-overflow: ellipsis;
      display: inline-block;
    }
    .select-chat-page .item-link:hover .item-subtitle .text-container {
      max-width: calc(100% - 15px);
    }

    .select-chat-page .item-link:hover .chat-menu-icon {
      display: inline-block;
      position: absolute;
      right: 0px;
    }

    .chat-page {
      --f7-page-bg-color: #e5ddd5;
      --f7-navbar-subtitle-text-align: left;
      --f7-navbar-title-margin-left: 15px;

      --f7-messagebar-height: 60px;
      --f7-messagebar-bg-color: #EEE;
      --f7-messagebar-textarea-bg-color: #fff;
      --f7-messagebar-textarea-height: 48px;
      --f7-messagebar-textarea-border-radius: 24px;
      --f7-messagebar-textarea-font-size: 16px;
      --f7-messagebar-textarea-line-height: 40px;
      --f7-messagebar-textarea-border: none;

      --f7-messages-content-bg-color: transparent;
      --f7-message-sent-bg-color: #dcf8c6;
      --f7-message-sent-text-color: #262626;
      --f7-message-received-bg-color: #fff;
      --f7-message-received-text-color: #262626;
      --f7-message-bubble-border-radius: 8px;
      --f7-message-bubble-font-size: 14px;

      background-image: url('whatsapp-bg.png');
      background-position: center;
      background-size: contain;
    }

    .emoji-container{
      padding-right: 20px;
      padding-left: 10px;
    }

    .emoji-container .icon,
    .send-message-container .icon {
      font-size: 25px;
      color: #525b60;
    }

    .send-message-container {
      padding-right: 10px;
      padding-left: 20px;
    }


    .messagebar textarea::placeholder {
      color: #b6b6b6;
    }

    .chat-page .message-bubble {
      min-height: 35px;
    }
  </style>
</head>

<body>
  <div id="app">
    <div class="panel panel-left panel-reveal panel-init" data-visible-breakpoint="1">
      <div class="view view-init">
        <div class="page select-chat-page">
          <div class="navbar">
            <div class="navbar-bg"></div>
            <div class="navbar-inner">
              <div class="left">
                <img src="avatar.png" alt="profile img">
              </div>
              <div class="right">
                <a href="#" class="link">
                  <i class="icon f7-icons">arrow_clockwise</i>
                </a>
                <a href="#" class="link">
                  <i class="icon f7-icons">plus</i>
                </a>
                <a href="#" class="link">
                  <i class="icon f7-icons">ellipsis_fill</i>
                </a>
              </div>
            </div>
          </div>
          <div class="searchbar">
            <div class="searchbar-inner">
              <div class="searchbar-input-wrap">
                <input type="text" placeholder="Search...">
                <i class="searchbar-icon"></i>
                <span class="input-clear-button"></span>
              </div>
            </div>
          </div>
          <div class="page-content">
            <div class="list media-list no-chevron">
              <ul>
                <li>
                  <a href="#" class="item-link item-content">
                    <div class="item-media"><img src="save.png" width="50" /></div>
                    <div class="item-inner">
                      <div class="item-title-row">
                        <div class="item-title">saint AI</div>
                        <div class="item-after">00:00</div>
                      </div>
                      <div class="item-subtitle">
                        <div class='text-container'>
                          saint: Let us talk about anything..
                        </div>
                        <i class="icon f7-icons chat-menu-icon">chevron_down</i>
                      </div>
                    </div>
                  </a>
                </li>
            
            
           
   

              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="view view-main view-init">
      <div class="page chat-page">
        <div class="navbar">
            <div class="navbar-bg"></div>
            <div class="navbar-inner">
              <div class="left">
                <img src="save.png" alt="profile img">
                <div class="title">
                    <span>saint AI</span>
                    <div class="subtitle">
                      <span class="description">Online</span>
                    </div>
                  </div>
              </div>
              <div class="right">
                <a href="#" class="link">
                  <i class="icon f7-icons">search</i>
                </a>
                <a href="#" class="link">
                  <i class="icon f7-icons">paperclip</i>
                </a>
                <a href="#" class="link">
                  <i class="icon f7-icons">ellipsis_fill</i>
                </a>
              </div>
            </div>
          </div>
        <div class="toolbar messagebar">
          <div class="toolbar-inner">
            <div class='emoji-container'>
              <a href="#" class="link">
                <i class="icon f7-icons">circle</i>
              </a>
            </div>
            <div class="messagebar-area">
			 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
              <textarea class="resizable" style="max-height: 230px" placeholder="Let's talk about anything..." name="msg"></textarea>
			  
            </div>
            <div class='send-message-container'>
			<input type="submit" value="send"	style="font-weight: bold;
				color:#11392e;
				background: linear-gradient(90deg, rgb(56,209,74, 0.7), rgb(56,209,74,1),rgb(56,209,74, 1),rgb(33,191,163, 1));
				font-size: 1em;
				border-radius: 9999px;
				padding-left: calc(1em + 0.25em);
				padding-right: calc(1em + 0.25em);
				-webkit-box-shadow: -7px 11px 25px -9px rgba(10,200,60,1);
				-moz-box-shadow: -7px 11px 25px -9px rgba(10,200,60,1);
				box-shadow: -7px 11px 25px -9px rgba(10,200,60,1);"></input>
            
			</form>
			</div>
          </div>
        </div>
        <div class="page-content">
          <div class="messages">
		  <?php 
		  
		  foreach($QP as $content){
			  $id = $content['id'];
			  $mtext = $content['message'];
			  $typ = $content['type'];
			  $positionleft = "received";
			  $positionright = "sent";
			  
			  if($typ == $positionright){
				  
				 echo '  <div class="message message-sent">
              <div class="message-content">
                <div class="message-bubble">
                  <div class="message-text">';
				
				$mm = $_POST['msg'];
				 
			
				 if(!$mtext){
					 
				  echo"How are you doing today?";
				  
				  }else{
					 
				
					echo "$mtext";
				
				  }					
				 echo' 
				 </div>
                </div>
              </div>
            </div>';
			
			
			  }else{
				    echo' <div class="message message-received">
              <div class="message-content">
                <div class="message-bubble">
                  <div class="message-text"> ';
				  
				  if(!$complete){
					  echo"Let us talk about anything you might think of... ";
				  }else{
					
		
			
		
					 echo"$mtext";
					 
					 }
					 echo" <br>
					  <br>
					  ";
				  //var_dump($complete);
				  
				  }
				
 
     echo" </div>
                </div>
              </div>
            </div>";
			  }
			  
		  }
		  ?>
           
 
         
         
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://unpkg.com/framework7/framework7-bundle.min.js"></script>
  <script>
    const app = new Framework7({
      el: '#app',
      theme: 'dark',
      routes: [{
        path: '/',
        master: true
      }, ],
      navbar: {
        iosCenterTitle: false,
        auroraCenterTitle: false,
      }
    });
    const messages = app.messages.create({
      el: '.messages',
      firstmessageRule: function (message, previousmessage, nextmessage) {
        if (message.isTitle) return false;
        if (!previousmessage || previousmessage.type !== message.type || previousmessage.name !== message.name)
          return true;
        return false;
      },
      lastmessageRule: function (message, previousmessage, nextmessage) {
        if (message.isTitle) return false;
        if (!nextmessage || nextmessage.type !== message.type || nextmessage.name !== message.name) return true;
        return false;
      },
      tailmessageRule: function (message, previousmessage, nextmessage) {
        if (message.isTitle) return false;
        if (!nextmessage || nextmessage.type !== message.type || nextmessage.name !== message.name) return true;
        return false;
      }
    });

  </script>
</body>

</html>
