<footer>
  <div class="container">
	<div class="row">
	  <?php if ($informations) { ?>
	  <div class="col-sm-2">
		<h5><?php echo $text_information; ?></h5>
		<ul class="list-unstyled">
		  <?php foreach ($informations as $information) { ?>
		  <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
		  <?php } ?>
		</ul>
	  </div>
	  <?php } ?>
	  <div class="col-sm-2">
		<h5><?php echo $text_service; ?></h5>
		<ul class="list-unstyled">
		  <li><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
		</ul>
	  </div>
	  <div class="col-sm-2">
		<h5><?php echo $text_extra; ?></h5>
		<ul class="list-unstyled">
		  <li><a href="<?php echo $manufacturer; ?>"><?php echo $text_manufacturer; ?></a></li>
		  <li><a href="<?php echo $special; ?>"><?php echo $text_special; ?></a></li>
		</ul>
	  </div>
	  <div class="col-sm-2">
		<h5><?php echo $text_account; ?></h5>
		<ul class="list-unstyled">
		  <li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
		  <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
		  <li><a href="<?php echo $wishlist; ?>"><?php echo $text_wishlist; ?></a></li>
		  <li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
		</ul>
	  </div>
	  <div class="col-sm-4">

			<?php echo $footer_top; ?>
			
		<!--<h5><?php echo $text_contact; ?></h5>
		<ul class="list-unstyled">
		  <li><?php echo $address; ?></li>
		  <li class="phone"><?php echo $telephone; ?></li>
		  <li class="phone"><?php echo $fax; ?></li>
		  
		</ul>
		<div class="socials">
			<a href="//www.facebook.com/"><i class="fa fa-facebook"></i></a>
			<a href="//www.facebook.com/"><i class="fa fa-twitter"></i></a>
			<a href="//www.facebook.com/"><i class="fa fa-rss"></i></a>
		</div>-->
	  </div>
	</div>
	
  </div> 
	</div>
</footer>
<script src="catalog/view/theme/theme509/js/livesearch.js" type="text/javascript"></script>

</div>

</body></html>