<!DOCTYPE html>
<html lang="en">
	<head>
   	 	<!-- Bootstrap core CSS -->
    	<link href="/www/css/bootstrap.min.css" rel="stylesheet">
	</head>
<body>

<div class="container">
	<div class="row">
		<div class="panel panel-default" >
		<div class="panel-heading">Xerox 7775 Supplies</div>
			<table class="table table-sm">
				<thead>
					<th>Printer Name</th>
					<th>IP Address</th>
				</thead>
				<tbody>
					{% for printer in all_7775s %}
					<tr>
						<td>{{printer.printer_name}}</td>
						<td>{{printer.ip_address}}</td>
					</tr>
					{% endfor %}
				</tbody>
			</table>
		</div> <!-- div panel -->
	</div> <!-- div row -->
</div> <!-- div container -->

</body>
</html>