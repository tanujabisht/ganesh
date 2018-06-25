<html>
	<head>
		<style>
			p{
				text-align:justify;				
			}
			table td{
				border:solid 1px #000
			}
			body{
				margin:20px;
			}
		</style>
	</head>
	<body>
		
<?php if(!empty($pagedata)){?>
	
		<h3><?php echo $pagedata->title;?></h3>
			<?php echo $pagedata->content;?>
<?php } ?>
	</body>
</html>