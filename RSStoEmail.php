<?php
include 'simple_html_dom.php';
include $_SERVER['DOCUMENT_ROOT'].'/RSStoEmail/PHPMailer-master/PHPMailerAutoload.php'; //Select Path to PHPMailerAutoload.php
Header("Content-Type: text/html;charset=UTF-8");

$title = array();
$pubDate = array();
$description = array();
$link = array();
$dataToMail = "";


$rss = "http://k.img.com.ua/rss/ru/ukraine.xml";     //set preference RSS Feed.

$xml = @simplexml_load_file($rss);
if($xml===false)die('Error parse RSS: '.$rss);

$i = 0;
foreach($xml->xpath('//item') as $item){
    $title[$i] = $item->title;
    $pubDate[$i] = $item->pubDate;
    $link[$i] = $item->link;

    $html = file_get_html($link[$i]);

    $description[$i] = $html->find('div.post-item__text',0)->plaintext; // SET div or .class marker in HTML markup

    $html->clear(); // clear the data
    unset($html); // clear the data

     $dataToMail= $dataToMail."<center><h2>".$title[$i]."</h2>"."<h4>(".$pubDate[$i].")</h4></center>"."<br>".$description[$i]."<br><br>" ;
    $i++;
}

//send to destination;
$mail = new PHPMailer;
$mail->isSMTP();

//set data sender 
$mail->Host = 'smtp.mail.ru';  // STMP connection with server, in sample we connection with Mail.ru
$mail->SMTPAuth = true;
$mail->Username = 'LOGIN';  //login in mail.ru (sample) may be anything google, yahoo etc.
$mail->Password = 'PASSWORD'; //password in mail.ru (sample) may be anything google, yahoo etc.
$mail->SMTPSecure = 'ssl'; //set SMTP secure
$mail->Port = '465';  

$mail->CharSet = 'UTF-8';
$mail->From = 'sample@mail.ru'; //Your Email in account LOGIN
$mail->FromName = 'Breaking News'; //Your name or anything else

//set data addressee
$mail->addAddress('testAddressee@google.com', 'TitleForAddressee');
$mail->isHTML(true); // true - only text. or false - allows use html markup: photo, table, picture, h1,h2,h3 etc.

$mail->Subject = "News of the World at ".date(DATE_RFC850);  // Theme message with date sending
$mail->Body =  $dataToMail; //body message

$mail->send();  //sent message to Addressee

?>
