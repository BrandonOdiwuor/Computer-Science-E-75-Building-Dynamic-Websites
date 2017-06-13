<div class="container">
  <table class="table table-hover table-bordered">
    <thead>
      <tr>
        <th colspan="2" rowspan="2">Stock</th>
        <th rowspan="2">Quantity</th>
        <th colspan="2">Stock Price</th>
        <th colspan="2" >Total Value</th>
        <th colspan="2" rowspan="2">Total Gains / Losses</th>
      </tr>
      <tr>
        <th>@purchase</th>
        <th>@current</th>
        <th>@purchase</th>
        <th>@current</th>
      </tr>
    </thead>
    <tbody>
      <?php
        foreach($stocks as $stock)
        {
          echo '<tr>';
          echo '<td>'.$stock['symbol'].'</td>';
          echo '<td>'.$stock['name'].'</td>';
          echo '<td>'.$stock['quantity'].'</td>';
          echo '<td>'.$stock['purchase_price'].'</td>';
          echo '<td>'.$stock['current_price'].'</td>';
          echo '<td>'.$stock['total_purchase_price'].'</td>';
          echo '<td>'.$stock['total_current_price'].'</td>';
          if ($stock['profit'] > 0) {
            echo '<td>'.$stock['profit'].'</td>';
          }
          else
          {
            echo '<td style="color:red;">'.$stock['profit'].'</td>';
          }
          echo '</tr>';
        }
        echo '<tr>';
        echo '<td colspan="6" align="right">';
        echo '<strong>Total Stock Value: </strong>';
        echo '</td>';
        echo '<td>';
        echo '<strong>'.$total_stock_value.'</strong>';
        echo '</td>';
        echo '<td rowspan="3">';
        echo "<strong>$total_profit</strong>";
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td colspan="6" align="right">';
        echo '<strong>Cash Balance: </strong>';
        echo '</td>';
        echo '<td>';
        echo '<strong>'.$balance.'</strong>';
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td colspan="6" align="right">';
        echo '<strong>TOTAL: </strong>';
        echo '</td>';
        echo '<td>';
        echo '<strong>'.$total.'</strong>';
        echo '</td>';
        echo '</tr>';
      ?>
    </tbody>
  </table>
</div>
