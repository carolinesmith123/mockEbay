<?php

$message='';
$db= new mysqli('localhost','caroline','ebay123','MockEbay');

if($db->connect_error){
    $message=$db->connect_error;
} else{
    $message="";


    $sql2='SELECT DISTINCT categoryHierarchy1 FROM maintable';
    $result2= $db->query($sql2);
}


if(isset($_GET['keywords'])){
    $keywords= $db-> escape_string($_GET['keywords']);
    $query= $db -> query("

        SELECT * 
        FROM maintable
        WHERE productName LIKE '%{$keywords}%' OR productDescritpion LIKE '%{$keywords}%' OR categoryHierarchy1 LIKE '%{$keywords}%'

        ");
}

?>





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
    <title>Edatabay Main</title>
    <!-- Bootstrap core CSS -->
    <link href="assets/bootstrap/css/bootstrap.css" rel="stylesheet">


    <link href="assets/css/style.css" rel="stylesheet">

    <!-- styles needed for carousel slider -->
    <link href="assets/plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="assets/plugins/owl-carousel/owl.theme.css" rel="stylesheet">

    <!-- bxSlider CSS file -->
    <link href="assets/plugins/bxslider/jquery.bxslider.css" rel="stylesheet"/>

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
                                    <li class="active dropdown-item"><a href="personalPage.html"><i class="icon-home"></i> Personal Home
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

<div class="search-row-wrapper" style=" padding-bottom: 0px; padding-top: 10px;" >
   <div class="container"  style=" padding-bottom: 0px; padding-top: 0px;">
      <form action="searchadmin.php" method="GET">
         <div class="row" style=" padding-bottom: 10px; padding-top: 0px;" >

            <!-- /.search starts -->
            <div class="col-md-3" >
           </div>
            <div class="col-md-4" >
               <input class="form-control keyword" type="text" placeholder="Search by Keyword(s)" name="keywords" autocomplete="off">
           </div>

          <div class="col-md-2">
           <input class="btn btn-block btn-primary" type="submit" value="Search" >
           </button>
       </div>

       <!-- /.search ends -->
   </div>
</form>



<form action="searchadmin.php" method="GET">
         <div class="row" >

            <!-- /.search starts -->

            <div class="col-md-3" >
           </div>
            <div class="col-md-4">
                            <select class="form-control selecter" name="keywords" id="search-category">
                                <option selected="selected" value="">Search By Category</option>
                                <?php while($row2 = $result2-> fetch_assoc()){ ?>

                                <option value="<?php echo $row2['categoryHierarchy1']; ?>"><?php echo $row2['categoryHierarchy1']; ?></option>

                                <?php } ?>
                               
                            </select>
                        </div>

          <div class="col-md-2">
           <input class="btn btn-block btn-primary" type="submit" value="Search" >
           </button>
       </div>

       <!-- /.search ends -->
   </div>
</form>




</div>
</div>

<!-- /.search-row -->
<div class="main-container">
    <div class="container">
        <div class="row">
            <!-- this (.mobile-filter-sidebar) part will be position fixed in mobile version -->
           <!-- this (.mobile-filter-sidebar) part will be position fixed in mobile version -->
           <div class="col-md-3 page-sidebar">
                    <aside>
                        <div class="inner-box">
                            <div class="user-panel-sidebar">
                                <div class="collapse-box">
                                    <h5 class="collapse-title no-border"> My Account <a class="pull-right"
                                                                                           aria-expanded="true"  data-toggle="collapse"
                                                                                           href="#MyClassified"><i
                                            class="fa fa-angle-down"></i></a></h5>

                                    <div id="MyClassified" class="panel-collapse collapse show">
                                        <ul class="acc-list">
                                            <li><a href="personalpage.html"><i class="icon-home"></i> Personal Home </a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                <!-- /.collapse-box  -->
                                <div class="collapse-box">
                                    <h5 class="collapse-title"> Admin Panel <a class="pull-right" aria-expanded="true"  data-toggle="collapse"
                                                                          href="#MyAds"><i class="fa fa-angle-down"></i></a>
                                    </h5>

                                    <div id="MyAds" class="panel-collapse collapse show">
                                        <ul class="acc-list">
                                            <li><a href="admin-all-users.php"><i class="icon-docs"></i> All Users </a></li>
                                            <li><a href="admin-all-listings.php"><i class="icon-hourglass"></i>
                                                All Listings </a></li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- /.collapse-box  -->
                                <div class="collapse-box">
                                    <h5 class="collapse-title"> Terminate Account <a class="pull-right"
                                                                                     aria-expanded="true"  data-toggle="collapse"
                                                                                     href="#TerminateAccount"><i
                                            class="fa fa-angle-down"></i></a></h5>

                                    <div id="TerminateAccount" class="panel-collapse collapse show">
                                        <ul class="acc-list">
                                            <li><a href="account-close.html"><i class="icon-cancel-circled "></i> Close
                                                account </a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /.collapse-box  -->
                            </div>
                        </div>
                        <!-- /.inner-box  -->

                    </aside>
                </div>
                <!--/.page-sidebar-->
                    <div class="col-md-9 page-content col-thin-left">
                        <div class="category-list">
                            <div class="tab-box ">

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs add-tabs" id="ajaxTabs" role="tablist">
                                    <li class="active nav-item">
                                       <!--  <a  class="nav-link"   role="tab"
                                        data-toggle="tab">Found <?php echo $query-> num_rows; ?> search result(s).</a> -->

                                        <a  class="nav-link"   role="tab"
                                        data-toggle="tab">Search Result(s):</a> 

                                       
                                    </li>

                                </ul>


                                <div class="tab-filter">

                                    <a href="categoryAdmin.php" class="btn btn-info" role="button" style="background-color: #16A085; color: white; margin-top: 5px; margin-right: 5px; border-color:#16A085;">Return to All Ads</a>
                                    
                                </div>
                            </div>
                            <!--/.tab-box-->
                            <!--/.listing-filter-->

                            <?php if($message){
                                echo "<h2>$message<h2>";
                            }?>



                            <table id="addManageTable"
                            class="table table-striped table-bordered add-manage-table table demo"
                            data-filter="#filter" data-filter-text-only="true">


                            <thead>
                                <tr>
                                    <th> Photo</th>
                                    <th data-sort-ignore="true"> Item Details</th>
                                    <th data-type="numeric"> Description</th>
                                    <th> Seller</th>
                                </tr>
                            </thead>



                            <tbody>

                                <?php 

                                if($query->num_rows){
                                    while($r=$query-> fetch_object()){
                                        ?>


                                    <?php 
                                    $date = strtotime($r->endDate);
                                    $remaining = $date - time();
                                    $days = floor($remaining / 86400);
                                    $remaining = $remaining - $days * 86400;
                                    $hrs = floor($remaining / 3600); 
                                    $remaining = $remaining - $hrs * 3600;
                                    $mins = floor($remaining / 60); 
                                //    $secs = $timeLeft - $mins * 60; 
                                    ?>

                                    <?php if($days<0 || $hrs<0 || $mins<0){
                                        continue;
                                    }
                                    ?>

                                     <tr>
                                        <tr>
                                            <td style="width:20%" ><a href="ads-details.html"><img 
                                                src="images/<?php echo $r->imageURL; ?>"
                                                style="width:180px;"
                                                alt="img"></a></td>
                                                <td style="width:30%" class="ads-details-td">
                                                    <div>
                                                        <p><strong> <?php echo $r->productName; ?></strong></p>
                                                         <p><strong> Time remaining: </strong>
                                                                <?php echo $days ." d : ".$hrs . " h : ".$mins . " m" ; ?></p>

                                                                <p><strong> Category: </strong> <?php echo $r->categoryHierarchy1; ?>
                                                                </p>

                                                                <?php $auction= $r->auction;?>
                                                                <?php $bin= $r->buyItNow;?>

                                                                <?php if($auction === '0' && $bin =='1'){ ?>

                                                                <p><strong> Type: </strong>
                                                                Buy it now</p>

                                                                <?php } ?>

                                                                <?php if($auction === '1' && $bin =='0'){ ?>

                                                                <p><strong> Type: </strong>
                                                                Auction </p>

                                                                <?php } ?>

                                                                <?php $var1= $r->startPrice; ?>
                                                                

                                                                <?php if($var1 === NULL){
                                                                    echo "";
                                                                } else{?>


                                                                <p><strong> Start price: </strong>£
                                                                    <?php echo $var1; ?></p>

                                                                    <?php } ?>



                                                                    <?php $bid=$r->maxbid;?>

                                                                    <?php if($bid === NULL){
                                                                        echo "";
                                                                    } else{?>


                                                                    <p><strong> Current Highest Bid: </strong>£
                                                                        <?php echo $bid; ?></p>

                                                                        <?php } ?>


                                                                        <?php $var2= $r->buyItNowPrice;?>

                                                                        <?php if($var2 === NULL){
                                                                            echo "";
                                                                        } else{ ?>


                                                                        <p><strong> Buy it now price: </strong>£
                                                                            <?php echo $var2; ?></p>

                                                                            <?php } ?>

                                                                             <p><strong> Sale Number: </strong> 
                                                                                <?php echo $r->saleID; ?></p>



                                                                            </div>
                                                                        </td>
                                                                        <td style="width:16%" class="price-td">
                                                                            <div> <a><input type="button" style="background-color: #16A085; border-color:#16A085;" class="btn btn-info" value="Delete Listing" href="google.com"></a>

                                                                                <!-- <p><?php echo $row['productDescritpion']; ?> </p> -->


                                                                            </div>
                                                                        </td>

                                                                        <td style="width:16%" class="action-td">
                                                                            <div>
                                                                                <p><strong><a href="#"><?php echo $r->firstName ." ".$r->lastName; ?></a></strong>
                                                                                </p>
                                                                            </div>
                                                                        </td>


                                                                    </tr>






                                        <?php 
                                    }
                                }
                                ?>

                            </tbody>

                            </table>

                            

                            







                            


































                            <!--/.row-box End-->

                        </div>


                    </div>

                    <!--/.pagination-bar -->


                </div>
                <!--/.page-content-->

            </div>
        </div>
    </div>
    <!-- /.main-container -->







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
</html>