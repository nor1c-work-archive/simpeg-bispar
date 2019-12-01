<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Login Page</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
	<link href="<?=base_url('node_modules/mdbootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
	<link rel="stylesheet" href="<?=base_url('public/css/custom.css')?>">
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .header {
            background-color: #333333;
            color: #fff;
            padding: 15px;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
            text-align: center;
            font-size: 18px;
        }
    </style>
</head>
<body>

	<div class="master-container" style="width:500px;margin-top:13%;">

        <div class="header">
        Silahkan Login!
        </div>

		<div id="content">
			<form action="<?=site_url('auth/in')?>" method="post">
                <div class="form-group">
                    <label for="exampleInputNIK1">NIP</label>
                    <input type="text" class="form-control" name="nip" placeholder="NIP Anda">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary">SIGN IN</button>
            </form>
		</div>
		
		<?php $this->load->view('templates/footer'); ?>

	</div>

	<script type="text/javascript" src="<?=base_url('node_modules/mdbootstrap/js/jquery-3.3.1.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('node_modules/mdbootstrap/js/popper.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('node_modules/mdbootstrap/js/bootstrap.min.js')?>"></script>
</body>
</html>