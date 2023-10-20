<?php
error_reporting(0);
require __DIR__ . '/vendor/autoload.php';

use Orhanerday\OpenAi\OpenAi;


$open_ai = new OpenAi('YOUR_KEYS');

	include "connect.php";

if (isset($_POST['msg'])) {

    $userInput = $_POST['msg'];
    $theTime = time();
    $messageType = "sent";
    //Save the search record to database
    $saves = "INSERT INTO gptChats (message,timestamp, message_type) VALUES (?,?,?)";
    //Prepare Statements
    $spush = $pdo->prepare($saves);
    //Execution
    $spush->execute([$userInput, $theTime, $messageType]);

    $primary = "The following is a conversation with an AI assistant. The assistant is helpful, creative, clever, and very friendly.\n\nHuman: Hello, who are you?
	\nAI: I am an AI created by OpenAI. How can I help you today?
	\nHuman: $pp ";
    $prom = "$primary ";
    $s = "\nA:";
    $r = "\nHuman: ";
    $complete = $open_ai->complete(['engine' => 'davinci', 'prompt' => $prom, 'temperature' => 0.9, 'max_tokens' => 150, 'frequency_penalty' => 0, 'presence_penalty' => 0.6

    ]);
    //$obj = json_decode($complete, true);
}

	    $searchs = "SELECT * FROM gptChats  ORDER BY id ASC LIMIT 100 ";
		$stmt = $pdo->prepare($searchs);
		$stmt->execute();
		$QP = $stmt->fetchAll();
