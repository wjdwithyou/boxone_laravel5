<!DOCTYPE html>
<html lang="ko">
  <head>
  	<?php include("libraries.php"); ?>
  </head>

  <body>
    <?php include("header.php"); ?>

	<div id="myCarousel" class="carousel slide" data-ride="carousel">
	  <ol class="carousel-indicators">
	    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
	    <li data-target="#myCarousel" data-slide-to="1"></li>
	    <li data-target="#myCarousel" data-slide-to="2"></li>
	  </ol>
	  <div class="carousel-inner" role="listbox">
	    <div class="item active">
	      <img class="first-slide" src="<?=$adr_img?>main_image_1.jpg" alt="First slide">
	      <div class="container">
	        <div class="carousel-caption">
	          <h1>Example headline.</h1>
	          <p>Note: If you're viewing this page via a <code>file://</code> URL, the "next" and "previous" Glyphicon buttons on the left and right might not load/display properly due to web browser security rules.</p>
	          <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
	        </div>
	      </div>
	    </div>
	    <div class="item">
	      <img class="second-slide" src="<?=$adr_img?>main_image_2.jpg" alt="Second slide">
	      <div class="container">
	        <div class="carousel-caption">
	          <h1>Another example headline.</h1>
	          <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
	          <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
	        </div>
	      </div>
	    </div>
	    <div class="item">
	      <img class="third-slide" src="<?=$adr_img?>main_image_3.jpg" alt="Third slide">
	      <div class="container">
	        <div class="carousel-caption">
	          <h1>One more for good measure.</h1>
	          <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
	          <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
	        </div>
	      </div>
	    </div>
	  </div>
	  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
	    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
	    <span class="sr-only">Previous</span>
	  </a>
	  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
	    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
	    <span class="sr-only">Next</span>
	  </a>
	</div>
	
	<div class="container marketing">
	  <div class="row">
	    <div class="col-lg-4">
	      <img class="img-circle" src="<?=$adr_img?>main_image_1.jpg" alt="Generic placeholder image" width="140" height="140">
	      <h2>Heading</h2>
	      <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
	      <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
	    </div>
	    <div class="col-lg-4">
	      <img class="img-circle" src="<?=$adr_img?>main_image_2.jpg" alt="Generic placeholder image" width="140" height="140">
	      <h2>Heading</h2>
	      <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
	      <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
	    </div>
	    <div class="col-lg-4">
	      <img class="img-circle" src="<?=$adr_img?>main_image_3.jpg" alt="Generic placeholder image" width="140" height="140">
	      <h2>Heading</h2>
	      <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
	      <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
	    </div>
	  </div>
	
	  <hr class="featurette-divider">
	
	  <div class="row featurette">
	    <div class="col-md-7">
	      <h2 class="featurette-heading">First featurette heading. <span class="text-muted">It'll blow your mind.</span></h2>
	      <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
	    </div>
	    <div class="col-md-5">
	      <img class="featurette-image img-responsive center-block" src="<?=$adr_img?>main_image_1.jpg" alt="Generic placeholder image">
	    </div>
	  </div>
	
	  <hr class="featurette-divider">
	
	  <div class="row featurette">
	    <div class="col-md-7 col-md-push-5">
	      <h2 class="featurette-heading">Oh yeah, it's that good. <span class="text-muted">See for yourself.</span></h2>
	      <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
	    </div>
	    <div class="col-md-5 col-md-pull-7">
	      <img class="featurette-image img-responsive center-block" src="<?=$adr_img?>main_image_2.jpg" alt="Generic placeholder image">
	    </div>
	  </div>
	
	  <hr class="featurette-divider">
	
	  <div class="row featurette">
	    <div class="col-md-7">
	      <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
	      <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
	    </div>
	    <div class="col-md-5">
	      <img class="featurette-image img-responsive center-block" src="<?=$adr_img?>main_image_3.jpg" alt="Generic placeholder image">
	    </div>
	  </div>
	</div>
	
    <?php include("footer.php"); ?>
  </body>
</html>
