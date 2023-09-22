

<style>

#loading-center{
	width: 100%;
	height: 100%;
	position: relative;
	}
#loading-center-absolute {
	position: absolute;
	left: 0;
	top: 45%;
  right: 0;
  margin: 0 auto;
  text-align: center;

}
#loading-center-absolute img{
  width: 269px;
}
.object{
	width: 25px;
	height: 25px;
	background-color: <?php echo $preloader_obj; ?>;
	margin-right: 50px;
	float: left;
	margin-bottom: 50px;

	}
.object:nth-child(2n+0) {
	margin-right: 0px;

}


#object_one {
	-webkit-animation: object_one 2s infinite;
	animation: object_one 2s infinite;
	}
#object_two {
	-webkit-animation: object_two 2s infinite;
	animation: object_two 2s infinite;
	}
#object_three {
	-webkit-animation: object_three 2s infinite;
	animation: object_three 2s infinite;
	}
#object_four {
	-webkit-animation: object_four 2s infinite;
	animation: object_four 2s infinite;
	}
	


@-webkit-keyframes object_one {
  25% { -webkit-transform: translate(75px,0) rotate(-90deg) scale(0.5); }
  50% { -webkit-transform: translate(75px,75px) rotate(-180deg); }
  75% { -webkit-transform:  translate(0,75px) rotate(-270deg) scale(0.5); }
  100% { -webkit-transform: rotate(-360deg); }
}

@keyframes object_one {
  25% { 
    transform: translate(75px,0) rotate(-90deg) scale(0.5);
    -webkit-transform: translate(75px,0) rotate(-90deg) scale(0.5);
  } 
  50% { 
    transform: translate(75px,75px) rotate(-180deg);
    -webkit-transform: translate(75px,75px) rotate(-180deg);
  } 
  75% { 
    transform: translate(0,75px) rotate(-270deg) scale(0.5);
    -webkit-transform: translate(0,75px) rotate(-270deg) scale(0.5);
  } 
  100% { 
    transform: rotate(-360deg);
    -webkit-transform: rotate(-360deg);
  }
}


@-webkit-keyframes object_two {
  25% { -webkit-transform: translate(0,75px) rotate(-90deg) scale(0.5); }
  50% { -webkit-transform: translate(-75px,75px) rotate(-180deg); }
  75% { -webkit-transform:  translate(-75px,0) rotate(-270deg) scale(0.5); }
  100% { -webkit-transform: rotate(-360deg); }
}

@keyframes object_two {
  25% { 
    transform: translate(0,75px) rotate(-90deg) scale(0.5); 
    -webkit-transform: translate(0,75px) rotate(-90deg) scale(0.5); 
  } 
  50% { 
    transform: translate(-75px,75px) rotate(-180deg);
    -webkit-transform: translate(-75px,75px) rotate(-180deg);
  } 
  75% { 
    transform: translate(-75px,0) rotate(-270deg) scale(0.5);
    -webkit-transform: translate(-75px,0) rotate(-270deg) scale(0.5);
  } 
  100% { 
    transform: rotate(-360deg);
    -webkit-transform: rotate(-360deg);
  }
}

@-webkit-keyframes object_three {
  25% { -webkit-transform: translate(0,-75px)  rotate(-90deg) scale(0.5); }
  50% { -webkit-transform: translate(75px,-75px) rotate(-180deg); }
  75% { -webkit-transform:  translate(75px,0) rotate(-270deg) scale(0.5); }
  100% { -webkit-transform: rotate(-360deg); }
}

@keyframes object_three {
  25% { 
    transform: translate(0,-75px)  rotate(-90deg) scale(0.5);
    -webkit-transform: translate(0,-75px)  rotate(-90deg) scale(0.5);
  } 
  50% { 
    transform: translate(75px,-75px) rotate(-180deg);
    -webkit-transform: translate(75px,-75px) rotate(-180deg);
  } 
  75% { 
    transform:  translate(75px,0) rotate(-270deg) scale(0.5);
    -webkit-transform: translate(75px,0) rotate(-270deg) scale(0.5);
  } 
  100% { 
    transform: rotate(-360deg);
    -webkit-transform: rotate(-360deg);
  }
}


@-webkit-keyframes object_four {
  25% { -webkit-transform: translate(-75px,0)  rotate(-90deg) scale(0.5); }
  50% { -webkit-transform: translate(-75px,-75px) rotate(-180deg); }
  75% { -webkit-transform:  translate(0,-75px) rotate(-270deg) scale(0.5); }
  100% { -webkit-transform: rotate(-360deg); }
}

@keyframes object_four {
  25% { 
    transform: translate(-75px,0)  rotate(-90deg) scale(0.5); 
    -webkit-transform: translate(-75px,0)  rotate(-90deg) scale(0.5); 
  } 
  50% { 
    transform: translate(-75px,-75px) rotate(-180deg);
    -webkit-transform: translate(-75px,-75px) rotate(-180deg);
  } 
  75% { 
    transform: translate(0,-75px) rotate(-270deg) scale(0.5);
    -webkit-transform: translate(0,-75px) rotate(-270deg) scale(0.5);
  } 
  100% { 
    transform: rotate(-360deg);
    -webkit-transform: rotate(-360deg);
  }
}


</style>
<div id="loading">
    <div id="loading-center">
        <div id="loading-center-absolute">
           <img src="https://ads.strokedev.net/uploads/logo_image/logo_81.png">
        </div>
    </div>
</div>


