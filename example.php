<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
</head>
<body>
	<div>
		<a href='<?php echo site_url('examples/patients_management')?>'>Patients</a> |
		<a href='<?php echo site_url('examples/prescriptions_management')?>'>Prescriptions</a> |
		<a href='<?php echo site_url('examples/medications_management')?>'>Medications</a> |
		<a href='<?php echo site_url('examples/doctors_management')?>'>Doctors</a> |
		<a href='<?php echo site_url('examples/visits_management')?>'>Visits</a> |
		<a href='<?php echo site_url('examples/fev_management')?>'>FEV1</a> |
		<a href='<?php echo site_url('examples/users')?>'>Users</a> |
		<a href='<?php echo site_url('login/logout')?>'>Logout</a> |
		
	</div>
	<div style='height:20px;'></div>  
    <div style="padding: 10px">
		<?php echo $output; ?>
    </div>
    <?php foreach($js_files as $file): ?>
        <script src="<?php echo $file; ?>"></script>
    <?php endforeach; ?>
</body>
</html>
