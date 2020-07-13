<?php if( is_active_sidebar( 'maxstore-footer-area' ) ) { ?>  				
  <div id="content-footer-section" class="row clearfix">    				
    <?php
      // Calling the header sidebar if it exists.
      dynamic_sidebar( 'maxstore-footer-area' );
    ?>  				
  </div>		
<?php } ?> 
        
<footer id="colophon" class="rsrc-footer" role="contentinfo">                
  <div class="row rsrc-author-credits">   
	<div class="address">
					<h5>
					
CÔNG TY CỔ PHẦN CÔNG NGHỆ MAXBUY VIỆT NAM</h5>
<p>- MAXBUY Miền Bắc: Số 19, Lô 1C, Đường Trung Yên 11D, KĐT Trung Yên, Cầu Giấy, Hà Nội. (Số 19, Ngõ 40, Trung Kính - Có chỗ đậu ôtô)</p>
<p>- Điện thoại: 024 6285 4021</p>
<p>- MAXBUY Miền Nam: Số 101/28 Đường Đinh Bộ Lĩnh, P.26, Quận Bình Thạnh, Tp. Hồ Chí Minh</p>
<p>- Điện thoại: 028 3511 1078</p>
<p>- Email: support@maxbuy.vn</p>
    </div>	
  
    <p class="text-center">
			<?php printf( __( '©2016 ketsatantoangiadinh.com', '' ), '<a href="' . esc_url( __( '', ' ' ) ) . '"></a>' ); ?>
			<span class="sep"> </span>
			<?php printf( __( '', '' ), '<a href="" title="' . esc_attr__( '', '' ) . '"></a>', '' ); ?>
		</p>                
  </div> 
</footer>

<div id="back-top">  
  <a href="#top">
    <span></span>
  </a>
</div>
</div>
<!-- end main container -->
<?php wp_footer(); ?>
<script async type="text/javascript" src="https://nikawa.vn/livechat/maxbuy.js"></script>
</body>
</html>