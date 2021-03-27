<?php
    include('connection.php');
    session_start();
    $email = $_SESSION['login_user'];
    $sql2 = "SELECT * FROM customer where custemail = '$email'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);

    $user = $row2['custid'];

    $sql = "select * from cart where custid='$user'";
    $result = mysqli_query($conn, $sql);
    $total=0;
?>
<html>
<head>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<style type="text/css">
	.table>tbody>tr>td, .table>tfoot>tr>td{
    vertical-align: middle;
}
@media screen and (max-width: 600px) {
    table#cart tbody td .form-control{
		width:20%;
		display: inline !important;
	}
	.actions .btn{
		width:36%;
		margin:1.5em 0;
	}
	
	.actions .btn-info{
		float:left;
	}
	.actions .btn-danger{
		float:right;
	}
	
	table#cart thead { display: none; }
	table#cart tbody td { display: block; padding: .6rem; min-width:320px;}
	table#cart tbody tr td:first-child { background: #333; color: #fff; }
	table#cart tbody td:before {
		content: attr(data-th); font-weight: bold;
		display: inline-block; width: 8rem;
	}
	
	
	
	table#cart tfoot td{display:block; }
	table#cart tfoot td .btn{display:block;}
	
}
</style>
</head>

<body>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
	<table id="cart" class="table table-hover table-condensed">
    				<thead>
						<tr>
							<th style="width:50%">Product</th>
							<th style="width:10%">Price</th>
							<!--<th style="width:8%">Quantity</th>-->
							<th style="width:22%" class="text-center">Subtotal</th>
							<th style="width:10%"></th>
						</tr>
					</thead>
					<tbody>
						<?php if($result->num_rows > 0){
                                            while ($row = $result->fetch_assoc()) {
                                        $fid = $row['fid'];
                                        $sql3 = "SELECT * FROM fooditem where fid = '$fid'";
                                        $result3 = mysqli_query($conn, $sql3);
                                        $row3 = mysqli_fetch_assoc($result3);
                                        $image = $row3['photo'];
                                        $image_src = "../adrest/examples/foodimage/".$image;
                                        $total = $total + $row3['fprice'];
                                            ?>
						<tr>
							<td data-th="Product">
								<div class="row">
									<div class="col-sm-2 hidden-xs"><img width="200" src="<?php echo $image_src; ?>" alt="..." class="img-responsive"/></div>
									<div class="col-sm-10">
										<h4 class="nomargin"><?php echo $row3['fname']; ?></h4>
										<p></p>
									</div>
								</div>
							</td>
							<td data-th="Price">₹<?php echo $row3['fprice']; ?></td>
							<!--<td data-th="Quantity">
								<input type="number" class="form-control text-center" value="1">
							</td>-->
							<td data-th="Subtotal" class="text-center">₹<?php echo $row3['fprice']; ?></td>
							<td class="actions" data-th="">
								<!--<button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>-->
				<?php		echo		'<button class="btn btn-danger btn-sm"><a href="remove.php?fid='.$fid.'"><i class="fa fa-trash-o"></i></a></button>'	?>							
							</td>
						</tr>
						<?php }}?>
					</tbody>
					<tfoot>
						<tr class="visible-xs">
							<!--<td class="text-center"><strong>Total 1.99</strong></td>-->
						</tr>
						<tr>
							<!--<td><a href="#" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>-->
							<td colspan="2" class="hidden-xs"></td>
							<td class="hidden-xs text-center"><strong>₹<?php echo $total ?></strong></td>
							<td><a href="order.php" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
						</tr>
					</tfoot>
				</table>
</div>
</body>
</html>