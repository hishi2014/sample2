<?php
    session_start();
require "db_connect.php";
    $sql="SELECT * from products";
    $items=$dbh->query($sql);
    $dbh = null;?>
<html>
<body>
<table>
<thead><h2>products</h2></thead>
<tbody>
<tr><td>名前</td><td>価格(円)</td><td></td></tr>
<?php foreach ($items as $item): ?>
  <tr>
        <td><?php echo $item["name"]; ?></td>
      <td style="text-align:right;"><?php echo $item["price"]; ?></td>
      <td><?php echo "<a href='show.php?id=$item[0]'>個別表示</a>"; ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</body>
</html>