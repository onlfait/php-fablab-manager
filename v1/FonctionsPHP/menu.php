<!-- Le menu -->
<nav>

<style>
body {margin: 0;}

ul.topnav {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #303745;
}

ul.topnav li {float: left;}

ul.topnav li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

ul.topnav li a:hover:not(.active) {background-color: #000000;}

ul.topnav li a.active {background-color: #000000;}

ul.topnav li.right {float: right;}

@media screen and (max-width: 600px){
    ul.topnav li.right,
    ul.topnav li {float: none;}
}
</style>

<?php include("config.php"); ?>
<div id="centercolumn">
     <ul class="topnav">
        <li><a href=<?php echo $LienPage[0] ?>><p class="TexteC"><?php echo $NomPage[0] ?></p></a></li>
        <li><a href=<?php echo $LienPage[1] ?>><p class="TexteC"><?php echo $NomPage[1] ?></p></a></li>
        <li><a href=<?php echo $LienPage[2] ?>><p class="TexteC"><?php echo $NomPage[2] ?></p></a></li>
        <li><a href=<?php echo $LienPage[3] ?>><p class="TexteC"><?php echo $NomPage[3] ?></p></a></li>
        <li><a href=<?php echo $LienPage[4] ?>><p class="TexteC"><?php echo $NomPage[4] ?></p></a></li>
        <li><a href=<?php echo $LienPage[5] ?>><p class="TexteC"><?php echo $NomPage[5] ?></p></a></li>
        <li><a href=<?php echo $LienPage[6] ?>><p class="TexteC"><?php echo $NomPage[6] ?></p></a></li>
        <li class="right"><a href=<?php echo $LienPage[7] ?>><p class="TexteC"><?php echo $NomPage[7] ?></p></a></li>
     </ul>
</div>
</nav>
