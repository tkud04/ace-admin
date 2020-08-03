<?php
 $tu = "http://www.aceluxurystore.com/track?o=".$order['reference'];
?>
<center><img src="http://www.aceluxurystore.com/images/logo.png" width="150" height="150"/></center>
<h3 style="background: #ff9bbc; color: #fff; padding: 10px 15px;">New tracking update for order {{$order['reference']}}</h3>
Hello {{$name}},<br> this is to inform you of a new update to your order:<br><br>
Reference #: <b>{{$order['reference']}}</b><br>
Update: <b>{{$tracking}}</b><br>

<h5 style="background: #ff9bbc; color: #fff; padding: 10px 15px;">Next steps</h5>

<p>Click the <b>Track Order</b> button to view delivery information. Alternatively you can log in to your Dashboard to view tracking info for this order (go to Orders and click either the Track button beside the order).</p><br>
<a href="{{$tu}}" target="_blank" style="background: #ff9bbc; color: #fff; padding: 10px 15px; margin-right: 10px;">Track order</a>
<br><br>
