    <div class="footer shadow">
        <div>
        <?php
        wp_nav_menu(array(
                'menu' => 'Site Menu',
                'theme_location' => 'main-menu',
                'container' => '',
                'link_after'      => '<span class="bullet"></span>',
                'items_wrap' => '<ul id="menu" class="list-inline">%3$s</ul>'
            )
        );
        ?>
            </div>
        <div>
            <a href="http://www.credit-card-logos.com"><img alt="" title="" src="http://www.credit-card-logos.com/images/multiple_credit-card-logos-1/credit_card_logos_11.gif" width="235" height="35" border="0" /></a>
        </div>
    </div>


<!-- end main container -->

<?php wp_footer(); ?>
</body>
</html>