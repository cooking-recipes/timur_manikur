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

                
	<script>

    //$("#input-telephone").inputmask("7(999)999-99-99");

    $(document).ready(function () {

        $('#button-oneclick').on('click', function () {
            $('.alert, .text-danger').remove();

            var tel_number = $("#input-telephone").val();
            var product_id = $('input[name="product_id"]').val();

            var pattern = /^\+[1-9]{1}[0-9]{3,14}$/;

            if (pattern.test($("#input-telephone").val())) {
                $.ajax({
                    url: 'index.php?route=product/buyoneclick/oneclickadd',
                    type: 'post',
                    data: 'product_id=' + product_id + '&tel_number=' + tel_number,
                    dataType: 'json',
                    complete: function () {
                        $('#cart > button').button('reset');
                    },
                    success: function (json) {
                        if (json['redirect']) {
                            location = json['redirect'];
                        }

                        if (json['success']) {
                           $('.form-one-click-call').html('<label class="control-label" for="input-telephone">' + json['text_order_success'] + ' ' + json['code'] + '</label>');
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        //console.log(xhr.status);
                        //console.log(thrownError);
                        $('#content').parent().before('<div class="alert alert-danger"><i class="fa fa-minus-circle"></i>'+ xhr.responseText +' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
					}
                });
            }
            else {
                $('#content').parent().before('<div class="alert alert-danger"><i class="fa fa-minus-circle"></i> Телефонный номер неверен. Он должен состаять из цифр.<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
            }
        });

    });

</script>

            

	<script>

    //$("#input-telephone").inputmask("7(999)999-99-99");

    $(document).ready(function () {

        $('#button-oneclick').on('click', function () {
            $('.alert, .text-danger').remove();

            var tel_number = $("#input-telephone").val();
            var product_id = $('input[name="product_id"]').val();

            var pattern = /^\+[1-9]{1}[0-9]{3,14}$/;

            if (pattern.test($("#input-telephone").val())) {
                $.ajax({
                    url: 'index.php?route=product/buyoneclick/oneclickadd',
                    type: 'post',
                    data: 'product_id=' + product_id + '&tel_number=' + tel_number,
                    dataType: 'json',
                    complete: function () {
                        $('#cart > button').button('reset');
                    },
                    success: function (json) {
                        if (json['redirect']) {
                            location = json['redirect'];
                        }

                        if (json['success']) {
                           $('.form-one-click-call').html('<label class="control-label" for="input-telephone">' + json['text_order_success'] + ' ' + json['code'] + '</label>');
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        //console.log(xhr.status);
                        //console.log(thrownError);
                        $('#content').parent().before('<div class="alert alert-danger"><i class="fa fa-minus-circle"></i>'+ xhr.responseText +' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
					}
                });
            }
            else {
                $('#content').parent().before('<div class="alert alert-danger"><i class="fa fa-minus-circle"></i> Телефонный номер неверен. Он должен состаять из цифр.<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
            }
        });

    });

</script>

<script src="catalog/view/theme/theme509/js/livesearch.js" type="text/javascript"></script>

</div>

</body></html>