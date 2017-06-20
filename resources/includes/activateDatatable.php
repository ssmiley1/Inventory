<!DOCTYPE html>
<html lang="en">
	<head>
    	<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    	<meta name="description" content="">
    	<meta name="author" content="">
    	<link rel="icon" href="../../favicon.ico">

		<script type="text/javascript" charset="utf8" src="/www/DataTables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" charset="utf8" src="/www/DataTables/media/js/dataTables.bootstrap.min.js"></script>
		<script type="text/javascript" charset="utf8" src="/www/DataTables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
		<script type="text/javascript" charset="utf8" src="/www/DataTables/extensions/Buttons/js/buttons.bootstrap.min.js"></script>
		<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
		<script type="text/javascript" charset="utf8" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
		<script type="text/javascript" charset="utf8" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
		<script type="text/javascript" charset="utf8" src="/www/DataTables/extensions/Buttons/js/buttons.html5.min.js"></script>
		<script type="text/javascript" charset="utf8" src="/www/DataTables/extensions/Buttons/js/buttons.print.min.js"></script>
		<script type="text/javascript" charset="utf8" src="/www/DataTables/extensions/Buttons/js/buttons.flash.min.js"></script>
		<script type="text/javascript" charset="utf8" src="/www/DataTables/extensions/Buttons/js/buttons.colVis.min.js"></script>

		<link href="/www/css/bootstrap.min.css" rel="stylesheet">
		<link href="/www/DataTables/media/css/dataTables.bootstrap4.css" rel="stylesheet">
		<link href="/www/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet">
		
		<script>
		$(document).ready(function(){
    		var table = $('#datatable').DataTable( {
    			"serverside": false,
				"compact": true,
				"paging": false,
				"lengthchange": false,
				"sScrollY": "600px",
				"scrollX": true,
				"bScrollCollapse": true, 
				"order": [[ 1, "asc" ], [ 2, "asc" ]],
				"dom": "<'row'<'col-sm-6 text-left'Bl><'col-sm-6 text-left'f><'col-sm-3'>>" +
    					"<'row'<'col-sm-12'tr>>" +
    					"<'row'<'col-sm-5'i><'col-sm-7'p>>",
				"buttons": [ 
						{
							extend: 'copy',
							exportOptions: {
								columns: ':visible'
							}
						},
						{
							extend: 'excel',
							exportOptions: {
								columns: ':visible'
							}
						},
						{
							extend: 'pdf',
							exportOptions: {
								columns: ':visible'
							}
						},
						{
							extend: 'print',
							exportOptions: {
								columns: ':visible'
							}
						}, 
						'colvis'
				],
			} );
			
			table.buttons().container()
    			.appendTo( $('.col-sm-6:eq(0)', table.table().container() ) );
			
		});
		</script>
    
	</head>