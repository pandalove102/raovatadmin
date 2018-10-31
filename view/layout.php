<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
    <?php $this->load('layout/head'); ?>
</head>

<body>
    <div id="wrapper">
    	<!-- ==========Left Menu========== -->
        <?php $this->load('layout/mainmenu'); ?>
        <!-- =============//============== -->
        <div id="page-wrapper" class="gray-bg dashbard-1">
        	<!-- ==========Top Menu========== -->
        		<?php $this->load('layout/topmenu'); ?>
        	<!-- =============//============== -->
           <?php $this->load('layout/title'); ?>
            <?php 
                if(file_exists($this->pathview.$view.'.php'))
                    include  $this->pathview.$view.'.php';
                $this->loadhtml();                   
            ?>

	         <?php $this->load('layout/footer'); ?>
        </div>
        
        <div id="right-sidebar" class="animated">
            <?php $this->load('layout/rightsidebar'); ?>
    	</div>

<!--/=================Js===============/-->
<?php $this->load('layout/script');?>

<?php
        echo $this->js; 
    if($this->msg) {echo $this->msg;$this->msg='';}
?>

<!--/==================================/-->
   
</body>

</html>
