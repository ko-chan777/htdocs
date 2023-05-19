<!DOCTYPE html>
<html lang="ja">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style type="text/css" >

body {
  background-color: #000800;
  color: #ffffff;
}

button {
  width: 10em;
  height:3em;
}
p.example1 { color: #ffffff; }
p.example2 { color: #008000; }

.tiledBackground {
  background-image: url(space3.gif);
  background-size: auto;
  width: auto;

  border: 0px solid;
  color: white;
}
</style>

<script>
    function resize() {
      var resizeText = document.getElementsByClassName('js-resize-text');
      for (let i = 0; i < resizeText.length; i++) {
        var body = document.getElementsByTagName('body')[0];
        var wrapper = resizeText[i].clientWidth / body.clientWidth;
        var fontSizeVw = wrapper / resizeText[i].innerHTML.length;
        // ▼ letter-spacingを0.1emに指定していた場合、1.1をかける
        // var fontSizeVw = wrapper / (resizeText[i].innerHTML.length; * 1.1);
        resizeText[i].style.fontSize = fontSizeVw * 100 + 'vw' ;
      }
    }
    // 初期
    window.onload = function(){
      resize();
    }
    // リサイズした時
    window.onresize = function(){
      resize();
    }
</script>

<head>
  <meta charset="utf-8">
  <title>占い結果</title>
</head>

<body>
<div class="tiledBackground">

<?php
$dsn = 'mysql:dbname=sendaimirai_cr7;host=mysql8047.xserver.jp';
$user = 'sendaimirai_mibu';
$password = 'ksj1108ksj';

$seizamei = $_POST['seizamei'];
$ketsuekigata = $_POST['ketsuekigata'];
$gender = $_POST['gender'];

$dbh = new PDO($dsn, $user, $password);

$sql = "SELECT * FROM horoscorp2";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
   if($row['sign'] == $seizamei && $row['bloodtype'] == $ketsuekigata && $row['gender'] == $gender)
    {
    $answer = $row['character'];
    break;
    }
}
?>

<center>
</br>
<table width="350px" height="500px">
<tr>
<td>
<center>
<p class="js-resize-text">貴方の性格が診断されました</p>
</center>
</td>
</tr>
<tr>
<td>
<p class="example1">
<?php echo $seizamei ?>
<?php echo $ketsuekigata ?>
<?php echo $gender ?>
</p>
</td>
</tr>

<tr class="example1" width="auto" >
<td width="auto" colspan="2">
<p>
<?php echo $answer ?>
</p>
</td>
</tr>
</table>
</center>

<center>
<button type=“button” onclick="location.href='http://www.shimizu-python.com/horoscorp.html'"><p class="js-resize-text">BACK TO TOP</p></button>
</center>
</div>
</body>

</html>
