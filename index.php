<html>
<head><title>Inventory</title>
<script type="text/javascript" charset="utf8" src="/www/js/jquery.js"></script>
</head>
<body>

<?php
include_once("config.php");

include_once(INCLUDES ."header.php");

if(isset($_GET['page']) && $_GET['page'] != '' ){    
$page = 'www/php/'.$_GET['page'].'.php';
}else{
$page = 'www/php/reports/generalreport.php'; // default page
}

?>

<div id="mainwindow">
<?php include($page); ?>
</div>
</body>

</html>