<div class="container">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Transaction</th>
        <th>Date/Time</th>
        <th>Symbol</th>
        <th>Shares</th>
        <th>Price</th>
      </tr>
    </thead>
    <tbody>
      <?php
        foreach($transactions as $transaction)
        {
            echo '<tr>';
            echo "<td>$transaction[0]</td>";
            echo "<td>$transaction[1]</td>";
            echo "<td>$transaction[2]</td>";
            echo "<td>$transaction[3]</td>";
            echo "<td>$transaction[4]</td>";
            echo '</tr>';
        }
      ?>
    </tbody>
</div>
