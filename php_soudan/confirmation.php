<?php


function get_json( $type = null ){
  $city = "Sapporo,jp";
  $appid = "6bc820162c1d3f5f8645679bdf4eccde";
  $url = "http://api.openweathermap.org/data/2.5/weather?q=" . $city . "&units=metric&APPID=" . $appid;

  $json = file_get_contents( $url );
  $json = mb_convert_encoding( $json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN' );
  $json_decode = json_decode( $json );

  //現在の天気
  if( $type  === "weather" ):
    $out = $json_decode->weather[0]->main;

  //現在の天気アイコン
  elseif( $type === "icon" ):
    $out = "<img src='https://openweathermap.org/img/wn/" . $json_decode->weather[0]->icon . "@2x.png'>";

  //現在の気温
  elseif( $type  === "temp" ):
    $out = $json_decode->main->temp;

  //パラメータがないときは配列を出力
  else:
    $out = $json_decode;

  endif;

  return $out;
}


?>





<!DOCTYPE html>
<html lang='ja'>
<head>
  <meta charset='UTF-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>山鼻綜合法律事務所</title>
  <link rel='stylesheet' href='css/reset.css'>
  <link rel='stylesheet' href='css/style.css'>
</head>

<body>
  <div class='contents'>
    <h1 class='title'>予約申込完了画面</h1>
</div>

<div class="icon">
<img src='img/shikaru.jpg' alt=''>
</div>

<form action="next.php" method="post">

<table>
<tr>
<td>名　　　　　前：</td>
<td><?php echo $_POST["name"]; ?></td>
</tr>
<tr>
<td>メールアドレス：</td>
<td><?php echo $_POST["mail"]; ?></td>
</tr>
<tr>
<td>相　談　内　容：</td>
<td><?php echo $_POST["inquiry"]; ?></td>
</tr>
</table>

</form>

　



<div style="text-align:center">現在の札幌市の天気</div>

<table class="ta1">
<tr>
  <th>天気</th>
  <th>気温</th>
</tr>
<tr>
  <th>
    <?php echo get_json("icon"); ?><br>
    <?php echo get_json("weather"); ?>
  </th>
  <th><?php echo get_json("temp"); ?>℃</th>
</tr>
</table>
　


</body>
    
</html>