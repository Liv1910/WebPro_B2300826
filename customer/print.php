
<html>
	<head>
		<meta charset="utf-8">
		<title>Salad Atelier</title>
		<link rel="icon" href="../images/title_logo.png" type="image/icon type">
		<link rel="stylesheet" href="style.css">
		<link rel="license" href="https://www.opensource.org/licenses/mit-license/">
		<script src="script.js"></script>
		<style>
		/* reset */

*
{
	border: 1;
	box-sizing: content-box;
	color: inherit;
	font-family: inherit;
	font-size: inherit;
	font-style: inherit;
	font-weight: bold;
	list-style: none;
	margin: 0;
	padding: 0;
	text-decoration: none;
}

/* content editable */

*[contenteditable] { border-radius: 0.25em; min-width: 1em; outline: 0; }

*[contenteditable] { cursor: pointer; }

*[contenteditable]:hover, *[contenteditable]:focus, td:hover *[contenteditable], td:focus *[contenteditable], img.hover { background: #DEF; box-shadow: 0 0 1em 0.5em #DEF; }

span[contenteditable] { display: inline-block; }

/* heading */

h1 { font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase; }

/* table */

table { font-size: 75%; table-layout: fixed; width: 100%; }
table { border-collapse: separate; border-spacing: 2px; }
th, td { border-width: 1px; padding: 0.5em; position: relative; text-align: left; }
th, td { border-radius: 0.25em; border-style: solid; }
th { background: #EEE; border-color: #BBB; }
td { border-color: #DDD; }

/* page */

html { font: 16px/1 'Open Sans', sans-serif; overflow: auto; padding: 0.5in; }
html { background: #999; cursor: default; }

body { box-sizing: border-box; height: 11in; margin: 0 auto; overflow: hidden; padding: 0.5in; width: 8.5in; }
body { background: #FFF; border-radius: 1px; box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); }

/* header */

header { margin: 0 0 3em; }
header:after { clear: both; content: ""; display: table; }

header h1 { background: #ffffff; border-style: solid; border-radius: 0.25em; color: #000; margin: 0 0 1em; padding: 0.5em 0; }
header address { float: left; font-size: 75%; font-style: normal; line-height: 1.25; margin: 0 1em 1em 0; }
header address p { margin: 0 0 0.25em; }
header span, header img { display: block; float: right; }
header span { margin: 0 0 1em 1em; max-height: 25%; max-width: 60%; position: relative; }
header img { max-height: 80%; max-width: 65%; }
header input { cursor: pointer; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; height: 100%; left: 0; opacity: 0; position: absolute; top: 0; width: 100%; }

/* article */

article, article address, table.meta, table.inventory { margin: 0 0 3em; }
article:after { clear: both; content: ""; display: table; }
article h1 { clip: rect(0 0 0 0); position: absolute; }

article address { float: left; font-size: 125%; font-weight: bold; }

/* table meta & balance */

table.meta, table.balance { float: right; width: 36%; }
table.meta:after, table.balance:after { clear: both; content: ""; display: table; }

/* table meta */

table.meta th { width: 40%; }
table.meta td { width: 60%; }

/* table items */

table.inventory { clear: both; width: 100%; }
table.inventory th { font-weight: bold; text-align: center; }

table.inventory td:nth-child(1) { width: 26%; }
table.inventory td:nth-child(2) { width: 38%; }
table.inventory td:nth-child(3) { text-align: right; width: 12%; }
table.inventory td:nth-child(4) { text-align: right; width: 12%; }
table.inventory td:nth-child(5) { text-align: right; width: 12%; }

/* table balance */

table.balance th, table.balance td { width: 50%; }
table.balance td { text-align: right; }

/* aside */

aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
aside h1 { border-color: #999; border-bottom-style: solid; }

/* javascript */

.add, .cut
{
	border-width: 1px;
	display: block;
	font-size: .8rem;
	padding: 0.25em 0.5em;	
	float: left;
	text-align: center;
	width: 0.6em;
}

.add, .cut
{
	background: #9AF;
	box-shadow: 0 1px 2px rgba(0,0,0,0.2);
	background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
	background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
	border-radius: 0.5em;
	border-color: #0076A3;
	color: #FFF;
	cursor: pointer;
	font-weight: bold;
	text-shadow: 0 -1px 2px rgba(0,0,0,0.333);
}
.transaction-id {
    display: block;
    word-wrap: break-word;
    max-width: 200px; /* Adjust max-width as per your layout needs */
}
.add { margin: -2.5em 0 0; }

.add:hover { background: #00ADEE; }

.cut { opacity: 0; position: absolute; top: 0; left: -1.5em; }
.cut { -webkit-transition: opacity 100ms ease-in; }

tr:hover .cut { opacity: 1; }

@media print {
	* { -webkit-print-color-adjust: exact; }
	html { background: none; padding: 0; }
	body { box-shadow: none; margin: 0; }
	span:empty { display: none; }
	.add, .cut { display: none; }
}

@page { margin: 0; }
		</style>
		
	</head>
	<body>
	
	
	
	
	<?php
	ob_start();	
	include ('db.php');
	$pid = $_GET['order_id'];
	$sql ="select * from orders where OrderID = '$pid' ";
	$re = mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($re))
	{
		$OrderID = $row['OrderID'];
		$TransactionID = $row['TransactionID'];
		$UserID = $row['UserID'];
		$FullName = $row['FullName'];
		$LoyaltyNumber = $row['LoyaltyNumber'];
		$Currency = $row['Currency'];
		$Amount = $row['Amount'];
		$Status = $row['Status'];
		$PaymentMethod = $row['PaymentMethod'];
		$Timestamp = $row['Timestamp'];

	}
				
	?>
		<header>
			<h1 style=" border-left-width: 3px; border-bottom-width: 3px; border-right-width: 3px; border-top-width: 3px; ">INVOICE </h1>
			<address >
				<p>Salad Atelier,</p>
				<p> Mall 1, 1 Mont' Kiara, LG-19 & LG-20<br>Jalan Kiara, Mont Kiara,<br> 50480 Kuala Lumpur.</p>
				<p>+60102853920</p>
			</address>
			<span><img alt="" src="assets_customer/img/logo.webp"></span>
		</header>
		<article>
			<h1>Recipient</h1>
			<address >
				<p><?php echo $FullName;?> <br></p>
			</address>
			<table class="meta">
				<tr>
					<th><span >Order ID </span></th>
					<td><span ><?php echo $OrderID; ?></span></td>
				</tr>
				<tr>
					<th><span >Transaction ID</span></th>
					<td><span class="transaction-id" ><?php echo $TransactionID; ?></span></td>
				</tr>
				<tr>
					<th><span >User ID</span></th>
					<td><span ><?php echo $UserID; ?></span></td>
				</tr>
				<tr>
					<th><span >Loyalty No.</span></th>
					<td><span ><?php echo $LoyaltyNumber; ?></span></td>
				</tr>
				<tr>
					<th><span >Order Status</span></th>
					<td><span ><?php echo $Status; ?> </span></td>
				</tr>
				
			</table>
			<table class="inventory">
				<thead>
					<tr>
					    <th><span >Amount</span></th>
						<th><span >Payment Method</span></th>
						<th><span >Timestamp</span></th>
					</tr>
				</thead>
				<tbody>
					<tr>
					    <td><span >$<?php echo $Amount; ?></span></td>
						<td><span ><?php echo $PaymentMethod?></span></td>
						<td><span data-prefix></span><span><?php echo $Timestamp; ?></span></td>
					</tr>
				</tbody>
			</table>
			
			<table class="balance">
				<tr>
					<th><span >Total</span></th>
					<td><span data-prefix>$ </span><span><?php echo $Amount; ?></span></td>
				</tr>
			</table>
		</article>
		<aside>
			<div >
				<p align="center">Email :- bbx457@gmail.com || Web :- www.saladatelier.com || Phone :- +60102853920 </p>
			</div>
			<h1></h1>
		</aside>
		<aside>
		<button class = "btn btn-primary" id="printPageButton" onClick="window.print()"> Print Invoice</button> 
		<button class = "btn btn-primary" id="BackButton" onclick="history.back()"> Back</button> 
       </aside>
		<style>
        body::-webkit-scrollbar{
        display: none;
        }
		@media print { 
        #printPageButton {
        display: none;
        }
        }
		@media print { 
        #BackButton {
        display: none;
        }
        }
	    #printPageButton{
		width: 125px;
        height: 25px;
        border-left-width: 1px;
        border-right-width: 1px;
        border-top-width: 1px;
        border-bottom-width: 1px;
	    }
		#BackButton{
		width: 80px;
        height: 25px;
        border-left-width: 1px;
        border-right-width: 1px;
        border-top-width: 1px;
        border-bottom-width: 1px;
	    }
       </style>  
	</body>
</html>
<?php 

ob_end_flush();

?>