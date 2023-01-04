

<style type="text/css">
	#wrapper{
	 	height: 10%; 
	}
    #smain {
		margin-top:  150px;
		text-align: center;   
	}
	#smain > a {
	text-decoration: none;
	padding-top:15px;
	padding-bottom:5px;
	padding-left:15px;
	padding-right:15px;
	border-radius:10px;
	margin:30px;
	box-shadow:0 5px 5px 2px #484848;
	-moz-box-shadow:0 5px 5px 2px #484848;
	-webkit-box-shadow:0 5px 5px 2px #484848;
	border:1px solid #000;
	background: #fff;
	color: #222222;
	font-size:30px;
	display: inline-block;
	width: 265px;
	height: 110px;
	text-align: center;
	/*margin-bottom: 5px;*/
}

	#smain > a:hover {
		text-decoration: underline;
	}
</style>
<div id="wrapper">
<div id="smain">
 <?php check_message(); ?> 
<a href="index.php?view=menu&rem=Dine-In"><i class="fa fa-cutlery"></i><br>Dine In</a>   
<a href="index.php?view=menu&rem=Take-Out"><i class="fa fa-truck icon-2x"></i><br>Take Out</a> 
</div>
</div>