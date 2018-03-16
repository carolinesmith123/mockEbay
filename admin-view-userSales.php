<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="assets/ico/favicon.png">
    <title>Admin View User Sales</title>
    <!-- Bootstrap core CSS -->
    <link href="assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

   
    <!-- Just for debugging purposes. -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- include pace script for automatic web page progress bar  -->
    <script>
        paceOptions = {
            elements: true
        };
    </script>
    <script src="assets/js/pace.min.js"></script>



</head>
<body>
<div id="wrapper">

<?php 
include 'DbConnection.php';

if (  isset($_GET['userID'])  ) {

	$query_thisSeller = "SELECT Users.userID, firstName, sellerID FROM Users JOIN SellerDetails ON SellerDetails.userID = Users.userID WHERE Users.userID = $_GET[userID] LIMIT 1";
    $result_thisSeller = mysqli_query($db, $query_thisSeller)
        or die('Error making select users query' . mysql_error());
	$row1 = mysqli_fetch_array($result_thisSeller);
	
	//FETCHING DETAILS OF ALL ITEMS SELLER IS SELLING / HAS SOLD 
	$query_allSelling  = "SELECT imageURL, productName, startDate, endDate, viewing, auction, buyItNow, saleDescription.saleID
	FROM Product
		JOIN itemForSale
			ON Product.productID = itemForSale.productID
		JOIN SaleDescription
			ON SaleDescription.saleID = itemForSale.saleID
		JOIN Sale 
			On Sale.saleID = SaleDescription.saleID
	WHERE sellerID = $row1[sellerID]";

	$result_allSelling = mysqli_query($db, $query_allSelling)
		or die('Error making select users query' . mysql_error());
 
}


?> 

        <div class="header">
            <nav class="navbar  fixed-top navbar-site navbar-light bg-light navbar-expand-md"
                 role="navigation">
                <div class="container">

                <div class="navbar-identity">

                    <a href="categoryAdmin.php" class="navbar-brand logo logo-title">
                    <img src="images/edatabay.png" alt="Available on the App Store">
                    </a>

                </div>

                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav ml-auto navbar-right">
                            <li class="nav-item"><a href="categoryAdmin.php" class="nav-link"><i class="icon-th-thumb"></i> Browse Items</a>
                            </li>
                            <li class="dropdown no-arrow nav-item"><a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">

                                <span>User</span> <i class="icon-user fa"></i> <i class=" icon-down-open-big fa"></i></a>
                                <ul class="dropdown-menu user-menu dropdown-menu-right">
                                    <li class="active dropdown-item"><a href="personalpage.html"><i class="icon-home"></i> Personal Home
                                    </a>
                                    </li>
                                    <li class="dropdown-item"><a href="admin-all-users.php"><i class="icon-th-thumb"></i> All Users </a>
                                    </li>
                                    <li class="dropdown-item"><a href="admin-all-listings.php"><i class="icon-hourglass"></i> All Listings
                                    </a>
                                    </li>

                                    <li class="dropdown-item"><a href="index.php"><i class=" icon-logout "></i> Log out </a>
                                    </li>
                                </ul>
                            </li>
                            
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
                <!-- /.container-fluid -->
            </nav>
        </div>
        <!-- /.header -->

    <!-- /.intro-inner -->

    <div class="main-container inner-page">
        <div class="container">
            <div class="row clearfix">
                <h1 class="text-center title-1"> <?php echo $row1['firstName'] ?>'s Items for Sale </h1>
                <hr class="mx-auto small text-hr">

                <div style="clear:both">
                    <hr>
                </div>
                <div class="col-xl-12">
                    <div class="white-box text-center" style="min-height: 400px">
					<table id="addManageTable"
                                   class="table table-striped table-bordered add-manage-table table demo"
                                   data-filter="#filter" data-filter-text-only="true">
                                <thead>
                                <tr>
                                    <th> Photo</th>
                                    <th data-sort-ignore="true"> Lising Details</th>
                                    <th data-type="numeric"> Sold For</th>
                                    <th data-type="numeric"> Buyer</th>
                                </tr>
                                </thead>
                                <tbody>


                                <?php 
                                while($row2 = mysqli_fetch_array($result_allSelling)) {   
                                    
                                    //FETCHING THE SALE DETAILS FOR ITEMS THAT HAVE SOLD AND ARE THEREFORE IN THE PURCHASE TABLE
                                    $query_sold = "SELECT buyerID, salePrice, buyerRated, sellerRated FROM Purchase WHERE saleID = $row2[saleID] LIMIT 1";
                                    $result_sold = mysqli_query($db, $query_sold)
                                        or die('Error making select users query' . mysql_error());
                                    $row3 = mysqli_fetch_array($result_sold);

                                    //FETCHING THE DETAILS FOR THE BUYER IF THE ITEM HAS SOLD
                                    if ($row3) {
                                        $query_buyer = "SELECT Users.userID, firstName FROM Users JOIN BuyerDetails ON BuyerDetails.userID = Users.userID WHERE buyerID = $row3[buyerID] LIMIT 1";
                                        $result_buyer = mysqli_query($db, $query_buyer)
                                            or die('Error making select users query' . mysql_error());
                                        $row4 = mysqli_fetch_array($result_buyer);
                                    }
                                    ?>

                                    <tr>

                                    <?php if ($row2['auction']) { ?>
                                        <td style="width:14%" class="add-img-td"><a href="item-page.php?saleID=<?php echo $row2['saleID'] ?>"><img
                                                class="thumbnail  img-responsive"
                                                src="images/<?php echo htmlspecialchars($row2['imageURL']); ?>"
                                                alt="img"></a></td>
                                        <td style="width:40%" class="ads-details-td">
                                    <?php } else {  ?> 
                                        <td style="width:14%" class="add-img-td"><img
                                                class="thumbnail  img-responsive"
                                                src="images/<?php echo htmlspecialchars($row2['imageURL']); ?>"
                                                alt="img"></td>
                                        <td style="width:40%" class="ads-details-td">
                                    <?php } ?>

                                            <div>

                                                <?php if ($row2['auction']) { ?>
                                                    <p><strong> <a href="item-page.php?saleID=<?php echo $row2['saleID'] ?>" > <?php echo $row2['productName'] ?> 
                                                    </a> </strong></p>
                                                <?php } else {  ?> 
                                                    <p><strong> <?php echo $row2['productName'] ?> 
                                                    </strong></p>
                                                <?php } ?>
                                               

                                                <p><strong> Start Date </strong>: <?php echo $row2['startDate'] ?> </p>
                                                <p><strong> End Date </strong>: <?php echo $row2['endDate'] ?></p>

                                                <p><strong>Views </strong>: <?php echo $row2['viewing'] ?>  
                                                    <strong> Type </strong>: 

                                                        <?php if ($row2['auction']) { ?>
                                                            Auction
                                                        <?php } else {  ?> 
                                                             Buy It Now
                                                        <?php } ?>

                                                </p>
                                            </div>
                                        </td>
                                        
                                        <td style="width:16%" class="price-td">
                                            <div>
                                                <p><strong>

                                                    <?php if ($row3) 
                                                            echo '<span>£</span>'. $row3['salePrice'];
                                                        else 
                                                            echo '<p><strong> Ongoing Sale </strong></p>';
                                                    ?>

                                                </strong>
                                                </p>
                                            </div>
                                        </td>

                                        <td style="width:16%" class="price-td">
                                            <div><p><strong>
                                                
                                                <?php if ($row3) {  ?>
                                                    <a href='#'> <?php echo $row4['firstName'] ?>  </a></strong></p>

                                                <?php } else { ?>
                                                    <p><strong> Ongoing Sale </strong></p>
                                                <?php } ?>

                                            </div>
                                        </td>
                                    
                                    </tr>

                                <?php ;
                                } ?>

                         
                                </tbody>
                            </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /.main-container -->
  
</div>
<!-- /.wrapper -->

<!-- Le javascript
================================================== -->

<!-- Placed at the end of the document so the pages load faster -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/vendors.min.js"></script>

<!-- include custom script for site  -->
<script src="assets/js/script.js"></script>

</body>

<?php
mysqli_close($db);
?>

</html>
