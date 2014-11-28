<?php
session_start();
$total_price=$_POST['total_price'];
require "db_connect.php";
    $values=array($total_price);
    $sql="insert into orders (total_price) values (?)";
    $sth = $dbh->prepare($sql);
    $flag=false;
    try{
    $dbh->beginTransaction();
    $flag=$sth->execute($values);
    $lastInsertId=$dbh->lastInsertId('orders_id_seq');
    $dbh->commit();
    }catch (Exception $e) {
    $dbh->rollBack();
    echo "エラーが発生しました。" . $e->getMessage();
    }
    if ($flag){
        print('正常に処理しました。<br>');
    }else{
        print('エラーが発生しました。<br>');
    }
    $items=$_SESSION["cart"];
    foreach($items as $item){
    $d_order=array($lastInsertId,$item['id'],$item['amount'],$item['price']);
    $sql="insert into d_orders (order_id,product_id,piece,p_price) values (?,?,?,?)";
    $sth = $dbh->prepare($sql);
        $flag=false;
    try{
    $dbh->beginTransaction();
    $flag=$sth->execute($d_order);
    $dbh->commit();
    }catch (Exception $e) {
    $dbh->rollBack();
    echo "エラーが発生しました。" . $e->getMessage();
    }
    if ($flag){
        print('正常に処理しました。<br>');
    }else{
        print('エラーが発生しました。<br>');
    }
    $dbh = null;
  }
?>
<html>
<?php
echo "order id: $lastInsertId <br>";
  ?>
<table>
<thead></thead>
<tr><td>名前</td><td>価格</td><td>個数</td><td>小計</td></tr>
<?php foreach ($_SESSION['cart'] as $item): ?>
  <tr>
        <td><?php echo $item["name"]; ?></td>
      <td><?php echo $item["price"]; ?></td>
      <td><?php echo $item["amount"]; ?></td>
      <td><?php echo $a=$item["price"]*$item["amount"]; ?></td>
</tr>
<?php endforeach; ?>
</table>
<?php
echo "合計: $total_price <br>";
unset($_SESSION["cart"]);
?>
<a href ="/index.php">ホーム</a>
</html>