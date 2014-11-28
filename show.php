<?php
session_start();
require "db_connect.php";
    $sql="SELECT * from products where id = ?";
    $id=filter_input ( INPUT_GET , 'id' ,FILTER_SANITIZE_NUMBER_INT);
    $sth=$dbh->prepare($sql);
    $sth->execute(array($id,));
    $item = $sth->fetch();
    $dbh = null;
    ?>
  <html>
  <body>
  <table>
  <tbody>
  <tr><td>名前</td><td>価格(円)</td></tr>
  <tr>
        <td><?php echo $item["name"]; ?></td>
      <td style="text-align:right;"><?php echo $item["price"]; ?></td>
  </tr>
  </tbody>
  </table>
<form action="/cart.php" method="post">
  <input type="hidden" name="id" value='<?php echo $item["id"];?>'>
  <input type="hidden" name="name" value='<?php echo $item["name"];?>'>
  <input type="hidden" name="price" value='<?php echo $item["price"];?>'>
  <input type="number" name="amount" value='1' min="1" max="100">個数
  <input type="hidden" name="category_id" value='<?php echo $item["category_id"];?>'>
  <input type="submit" value="カートに追加">
</form>
<a href ="/index.php">ホーム</a>
</body>
</html>