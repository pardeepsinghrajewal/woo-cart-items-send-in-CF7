<?php 
function wcCartContentFun() 
{
  $output = '';
  global $woocommerce;
  if( WC()->cart && sizeof( WC()->cart->get_cart() ) > 0 ) 
  { 
    $output .= '<table class="shop_table cart" cellspacing="0">';
      $output .= '<thead>';
        $output .= '<tr>';
          $output .= '<th class="product-thumbnail">Image</th>';
          $output .= '<th class="product-name">Title</th>';
          $output .= '<th class="product-price">Price</th>';
        $output .= '</tr>';
      $output .= '</thead>';
      $output .= '<tbody>';

      foreach( $woocommerce->cart->get_cart() as $cartItemKey => $cartItem ) 
      {    
        $productID = 0;
        if(isset($cartItem['product_id']) && !empty($cartItem['product_id']) && $cartItem['product_id'] != 0 ) 
        {
          $productID = $cartItem['product_id'];
        }
        if(isset($cartItem['variation_id']) && !empty($cartItem['variation_id']) && $cartItem['variation_id'] != 0 ) 
        {
          $productID = $cartItem['variation_id'];
        }
        if($productID)
        {
          $wcProduct    = wc_get_product($productID);
          $wcPermalink  = esc_url(get_permalink($wcProduct->get_id()));


          $output .= '<tr class="cart_item">';
            
					  $output .= '<td class="product-thumbnail">';
						  $output .= '<a href="'.$wcPermalink.'">';
                $output .=  $wcProduct->get_image();
              $output .= '</a>';
            $output .= '</td>';

            $output .= '<td class="product-name">';
              $output .= '<a href="'.$wcPermalink.'">';
              $output .= $wcProduct->get_name();
              $output .= '</a>';
            $output .= '</td>';

					  $output .= '<td class="product-price">';
              $output .= $wcProduct->get_price_html();
            $output .= '</td>';
          $output .= '</tr>';
        }
      } 
      $output .= '</tbody>';
    $output .= '</table>';
  }
  return $output;
} 
add_shortcode('wcCartContent', 'wcCartContentFun'); 


add_action('wpcf7_before_send_mail', 'wcLoadCartProductsIntoEmail');  
function wcLoadCartProductsIntoEmail($cf7) 
{
  if($cf7->title() == 'Contact form 1')
  {
    $submission = WPCF7_Submission::get_instance();  
    if($submission ) 
    {
      $data = $submission->get_posted_data();
      
      /* data['wc-cart-content'] hiden field */
      if(isset($data['wc-cart-content']) && !empty($data['wc-cart-content'])) 
      {
        $wpcf = WPCF7_ContactForm::get_current();
        $mail = $wpcf->prop( 'mail' ); 
        $mail['body'] = str_replace('[wcCartContent]',$data['wc-cart-content'],$mail['body']);
        $cf7->set_properties( array( 'mail' => $mail ) );    
      }
    }
  }
}