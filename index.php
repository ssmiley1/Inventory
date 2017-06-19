<html>
<head><title>Inventory</title>
<script type="text/javascript" src="/www/js/jquery.js"></script>
<script type="text/javascript" src="/www/js/bootstrap.min.js"></script>
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

<div class="modal fade" id="modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		</div>
	</div>
</div>

<script>
	$("#modal").on('hidden.bs.modal', function () {
    	$(this).data('bs.modal', null);
	});
</script>

</body>

</html>