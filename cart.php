<?php
session_start();
    if(!isset($_SESSION['cart'])){
      $_SESSION['cart']=array();
    }
    $flag=false;
    for( $i=0; $i<count($_SESSION['cart']); $i++ ){
    if( $_SESSION['cart'][$i]['id'] == $_POST['id'] )
      {
        $_SESSION['cart'][$i]['amount'] += $_POST['amount'];
        $flag=true;
        break;
      }
    }
    if($flag){
      $item=array("id"=>null,"name"=>null,"price"=>null,"amount"=>null);
      $item['id']=$_POST['id'];
      $item['name']=$_POST['name'];
      $item['price']=$_POST['price'];
      $item['amount']=$_POST['amount'];
      $_SESSION['cart'][]=$item;
    }
?>
<html>
<table>
<tbody>
<thead><h2>カート</h2></thead>
<tr><td>名前</td><td>価格</td><td>個数</td><td>小計</td></tr>
<?php
$total_price=0;
if(!empty($_SESSION['cart'])){
 foreach ($_SESSION['cart'] as $item): ?>
  <tr>
        <td><?php echo $item["name"]; ?></td>
      <td><?php echo $item["price"]; ?></td>
      <td><?php echo $item["amount"]; ?></td>
      <td><?php echo $a=$item["price"]*$item["amount"]; ?></td>
</tr>
<?php $total_price+=$a?>
<?php endforeach;} ?>
<tr><td></td><td></td><td>合計</td><td><?php echo $total_price;?></td></tr>
</tbody>
</table>
<a href='/order.php'>注文</a><br>
<a href ="/index.php">ホーム</a>
</html>
