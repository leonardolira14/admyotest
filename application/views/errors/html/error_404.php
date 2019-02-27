<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta charset="UTF-8">
	<title>InfoAdmyo</title>
</head>
<style>
	body{
    margin: 0;
    padding: 20px;
    background-color:#005d8f;
    font-family: arial;
  height: 100%;
}

.info{
  position: absolute;
  top:0;
  left:0;
  padding: 10px 0;
  font-size: 110%;
  text-transform: capitalize;
  color:#005d8f;
  font-weight: 700;
  background-color:#fff;
  width:100%;
  text-align:center
}

.info a{
  text-decoration: none;
  color:#333
}
.info a:after{
  content:" | ";
  color:#005d8f
}

.info a:last-of-type:after{content:""}

.box{
    text-align: center;
    position: relative;
}

.box div{
    width: 250px;
    height: 80px;
    line-height: 80px;
    color:#005d8f;
    background-color: #fff;
    font-size: 280%;
    position: absolute;
    top:390px;
    left:40%;
    text-transform: capitalize;
    animation: moving 8s linear infinite;
  -webkit-animation: moving 8s linear infinite;
  -moz-animation: moving 8s linear infinite;
  -o-animation: moving 8s linear infinite;
  
    transform-origin: 50% -400%;
  -webkittransform-origin: 50% -400%;
  -moz-transform-origin: 50% -400%;
  -o-transform-origin: 50% -400%;
}

.box div:before{
    content: "";
    width: 25px;
    height: 25px;
    background-color:#fff;
    border-radius: 50%;
    display: block;
    position: absolute;
    left:45%;
    top:-350px;
}

.box div:after{
    content: "";
    width: 3px;
    height: 335px;
    background-color: #fff;
    display: block;
    position: absolute;
    left: 50%;
    top: -330px;
}

.box p{
    position: absolute;
    top:460px;
    left:38%;
    font-weight: 700;
    text-transform: uppercase;
  color:#fff;
  width: 300px
}

.box p span{
  display: block;
  font-size:300%
}

@keyframes moving{
    0%,100%{
        transform: rotate(0)
    }
    25%{
        transform: rotate(3deg);
    }
    50%{
        transform: rotate(-3deg)
    }
}

@-webkit-keyframes moving{
    0%,100%{
        transform: rotate(0)
    }
    25%{
        transform: rotate(3deg);
    }
    50%{
        transform: rotate(-3deg)
    }
}

@-moz-keyframes moving{
    0%,100%{
        transform: rotate(0)
    }
    25%{
        transform: rotate(3deg);
    }
    50%{
        transform: rotate(-3deg)
    }
}

@-o-keyframes moving{
    0%,100%{
        transform: rotate(0)
    }
    25%{
        transform: rotate(3deg);
    }
    50%{
        transform: rotate(-3deg)
    }
}
</style>
<body>
<div class="box">
            <div>
                close !
            </div>
            <p><span>error 404 !</span> Lo sentimos la página solicitada no se encuentra. </p>
        </div>
</body>
</html>