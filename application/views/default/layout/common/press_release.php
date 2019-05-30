<!--Why Use ENTOWORK start-->
<style type="text/css">
            ul.blog-item li.left, ul.blog-item li.right {
                float: left;
                list-style: outside none none;
                margin: 0;
                padding: 0;
                width: 48%;
            }
            ul.blog-item li.right {
                float: right;
            }
            
            .blogger-photo {
                float: left;
                text-align:left
            }
            
            
            a, a:visited {
                text-decoration: none;
            }
            
            
            .rating {
                float: left;
                margin: 10px 0 0;
                width: 100%;
            }
            p {
            margin-bottom:20px;
            }
            
            .clearout {
            height:20px;
            clear:both;
            }
            
            #flexiselDemo1, #flexiselDemo2, #flexiselDemo3 {
            display:none;
            }
            .nbs-flexisel-container {
                position:relative;
                max-width:100%;
            }
            .nbs-flexisel-ul {
                position:relative;
                width:9999px;
                margin:0px;
                padding:0px;
                list-style-type:none;   
                text-align:center;  
            }
            
            .nbs-flexisel-inner {
                border-radius: 5px;
                float: left;
                height: 151px;
                overflow: hidden;
                width: 100%; 
            }
            
            .nbs-flexisel-item {
                float:left;
            }
            .nbs-flexisel-item img {
                cursor: pointer;
                position: relative;
               /* max-width:100px;
                max-height:45px;*/
            }
            
            /*** Navigation ***/
            
            .nbs-flexisel-nav-left,
            .nbs-flexisel-nav-right {
                width: 22px;
                height: 22px; 
                position: absolute;
                cursor: pointer;
                z-index: 100;
                opacity: 0.5;
            }
            
            .nbs-flexisel-nav-left {
                left: -30px;
                background: url(<?php echo base_url().getThemeName()?>/images/button-previous.png) no-repeat;
            }
            
            .nbs-flexisel-nav-right {
                right: -30px;
                background: url(<?php echo base_url().getThemeName()?>/images/button-next.png) no-repeat;
            }
            
            .img-container{
                float: left;
                width: 30%;
                padding: 5px;
            }
            .clearfix1::after{
                box-sizing: border-box;
                content: "";
                clear: both;
                display: table;
            }
            hr { 
  display: block;
  margin-top: 0.5em;
  margin-bottom: 0.5em;
  margin-left: 0em;
  margin-right: 0em;
  border-style: solid;
  border-width: 1px;
  border-color: #ec6600;
} 
            </style>
<script type="text/javascript">

$(window).load(function() {
    $("#flexiselDemo1").flexisel({
		visibleItems: 3,
		animationSpeed: 1000,
        autoPlay: false,
        autoPlaySpeed: 4000	
	});
    $("#flexiselDemo2").flexisel({
        enableResponsiveBreakpoints: true,
        responsiveBreakpoints: { 
            portrait: { 
                changePoint:480,
                visibleItems: 1
            }, 
            landscape: { 
                changePoint:640,
                visibleItems: 2
            },
            tablet: { 
                changePoint:768,
                visibleItems: 3
            }
        }
    });

    $("#flexiselDemo3").flexisel({
        visibleItems: 5,
        animationSpeed: 1000,
        autoPlay: true,
        autoPlaySpeed: 3000,            
        pauseOnHover: true,
        enableResponsiveBreakpoints: true,
        responsiveBreakpoints: { 
            portrait: { 
                changePoint:480,
                visibleItems: 1
            }, 
            landscape: { 
                changePoint:640,
                visibleItems: 2
            },
            tablet: { 
                changePoint:768,
                visibleItems: 3
            }
        }
    });

    $("#flexiselDemo4").flexisel({
        clone:false
    });
    
});
</script>
<!--Why Use ENTOWORK ends-->
<div id="stastic-content">
    <div class="container">
                    
        <h2 align="center" style="color: #585858;">" The best place for drone pilots to reach out. "</h2>
    </div>
    <br/>
    <br/>      
    <hr>
</div>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

body {
  margin: 0;
}

/* The grid: Four equal columns that floats next to each other */
.column {
  float: left;
  width: 118.85px;
  height: 118.85px;
  padding: 8px;
}

/* Style the images inside the grid */
.column img {
    height: 50px;
    width: 50px;
  opacity: 0.8; 
  cursor: pointer; 
}

.column img:hover {
  opacity: 1;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* The expanding image container */
.container1 {
    padding-left: 10px;
    padding-top: 15px;
    padding-bottom: 10px;
  position: relative;
  display: none;
}

/* Expanding image text */
#imgtext {
  position: absolute;
  bottom: 15px;
  left: 15px;
  color: white;
  font-size: 20px;
}

/* Closable button inside the expanded image */
.closebtn {
  position: absolute;
  top: 15px;
  right: 15px;
  color: #ec6600;
  font-size: 30px;
  cursor: pointer;
}
</style>


<div style="text-align:center;">
  <h2>Our Image Gallery</h2>
  <p>Our pilots are hard at work. Click on an image to view more.</p>
</div>

<!-- The four columns -->
<div class="row" style="padding-left: 45px;">
  <div class="column">
    <img src="default/images/drones/1.png" alt="" style="height: 114.81px; width: 114.81px;" onclick="myFunction(this);">
  </div>
  <div class="column">
    <img src="default/images/drones/2.png" alt="" style="height: 114.81px; width: 114.81px;" onclick="myFunction(this);">
  </div>
  <div class="column">
    <img src="default/images/drones/3.png" alt="" style="height: 114.81px; width: 114.81px;" onclick="myFunction(this);">
  </div>
  <div class="column">
    <img src="default/images/drones/4.png" alt="" style="height: 114.81px; width: 114.81px;" onclick="myFunction(this);">
  </div>
  <div class="column">
    <img src="default/images/drones/5.png" alt="" style="height: 114.81px; width: 114.81px;" onclick="myFunction(this);">
  </div>
  <div class="column">
    <img src="default/images/drones/6.png" alt="" style="height: 114.81px; width: 114.81px;" onclick="myFunction(this);">
  </div>
  <div class="column">
    <img src="default/images/drones/7.png" alt="" style="height: 114.81px; width: 114.81px;" onclick="myFunction(this);">
  </div>
  <div class="column">
    <img src="default/images/drones/8.png" alt="" style="height: 114.81px; width: 114.81px;" onclick="myFunction(this);">
  </div>
  <div class="column">
    <img src="default/images/drones/9.png" alt="" style="height: 114.81px; width: 114.81px;" onclick="myFunction(this);">
  </div>
  <div class="column">
    <img src="default/images/sdrones/10.png" alt="" style="height: 114.81px; width: 114.81px;" onclick="myFunction(this);">
  </div>
  <div class="column">
    <img src="default/images/sdrones/11.png" alt="" style="height: 114.81px; width: 114.81px;" onclick="myFunction(this);">
  </div>
  <div class="column">
    <img src="default/images/sdrones/12.png" alt="" style="height: 114.81px; width: 114.81px;" onclick="myFunction(this);">
  </div>
</div>

<div class="container1">
  <span onclick="this.parentElement.style.display='none'" class="closebtn">close &times;</span>
  <img id="expandedImg" style="width:100%">
  <div id="imgtext"></div>
</div>

<script>
function myFunction(imgs) {
  var expandImg = document.getElementById("expandedImg");
  var imgText = document.getElementById("imgtext");
  expandImg.src = imgs.src;
  imgText.innerHTML = imgs.alt;
  expandImg.parentElement.style.display = "block";
}
</script>



