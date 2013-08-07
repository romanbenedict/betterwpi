<div id="invoice_page" class="wpi_invoice_form wpi_payment_form clearfix">
<style>
#invoicetopheader{
text-align:center;
}
.wpi_left_col, wpi_right_col{
width:100%;
}
#invoiceto {
  display:inline-block;
  float: left;
  width: 50%;
}
#invoicefrom {
  display:inline-block;
  width: 50%;
  text-align:right;
}
#invoicefrom p {
  margin-top:0px;
  margin-bottom:0px;
  padding:0px;
}
.wpi_subtotal{
font-weight:bold;
}
.bottom_line_title{
text-align:center !important;
}
.invoiceinformation{
height:250px;
}
.invoice_page_subheading{
display:none
}
.wpi_greeting{
padding-top:0px;
margin-top:0px;
}
.invoice_description_custom{
font-size:90%
}
.invoicetopheader{
font-weight:bold !important;
font-size:120% !important;
}
#invoicebottominfo{
text-align:center;
}
</style>
  	<h1 id="invoicetopheader">Tax Invoice</h1>	  
		<div class="wpi_left_col">

			<div id="invoiceto">
				<h3 class="wpi_greeting">To: <?php echo recipients_name(array('return' => true)); ?></h3>
				<div class="invoice_top_message">
	        <?php if (is_quote()) : ?>
	          <p><?php echo 'Quote in the amount of ' . balance_due(array('return' => true)); ?></p>
	        <?php endif; ?>
	
	        <?php if (!is_quote()) : ?>
	          <p><?php echo 'Invoice no. ' . invoice_id(array('return' => true)) . ' with a total of ' . balance_due(array('return' => true)) . ' due'. wpi_invoice_due_date() . '.'; ?></p>
	        <?php endif; ?>
			
	        <?php if (is_recurring()): ?>
	          <p>(This is a recurring bill)</p>
	        <?php endif; ?>
			</div>
			</div>
				<?php if (show_business_info()) { ?><div id="invoicefrom">
				<?php wp_invoice_show_business_information(); ?></div>
				<?php } ?>
	    <div class="invoice_description">
	      
		  
	      <div class="invoice_description_custom">
		  <h3>For: <?php echo $wpi_invoice_object->data['post_title']; ?></h3>
	        <?php the_description(); ?>
	      </div>
	    </div>
	
	    <div class="wpi_itemized_table">
		<h3>Itemised Invoice</h3>
	      <?php show_itemized_table(); ?>
	    </div>
		<div id="invoicebottominfo">
		<p><strong>Additional Notes</strong></p>
	     <p><?php echo!empty($wpi_settings['manual_payment_info']) ? $wpi_settings['manual_payment_info'] : __('Contact site Administrator for payment information please.', WPI); ?></p>
	    <?php do_action('wpi_front_end_left_col_bottom'); ?> </div> 
</div>

	  <div class="wpi_right_col">

	    <?php if (!is_quote()) { ?>
	      <div class="wpi_checkout">
	        <?php if (allow_partial_payments()): ?>
	          <?php show_partial_payments(); ?>
	        <?php endif; ?>
	
	        <?php show_payment_selection(); ?>
	
	        <?php
	        $method = !empty($invoice['default_payment_method']) ? $invoice['default_payment_method'] : 'manual';
	        if ($method == 'manual') {
	          ?>
	          <p><strong><?php _e('Manual Payment Information', WPI); ?></strong></p>
	          <p><?php echo!empty($wpi_settings['manual_payment_info']) ? $wpi_settings['manual_payment_info'] : __('Contact site Administrator for payment information please.', WPI); ?></p>
	          <?php
	        } else {
	          $wpi_settings['installed_gateways'][$method]['object']->frontend_display($invoice);
	        }
	        apply_filters("wpi_closed_comments", $invoice);
	        ?>
	      </div>
	    <?php } ?>
	    <div class="clear"></div>
	    <div class="wpi_front_end_right_col_bottom">
	      <?php do_action('wpi_front_end_right_col_bottom'); ?>
	    </div>
	
	  </div>

	</div>
