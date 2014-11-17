<?php
global $dm_settings;
?>

    <div class="footer shadow">
        <div>
        <?php
        wp_nav_menu(array(
                'menu' => 'Site Menu',
                'theme_location' => 'main-menu',
                'container' => '',

                'items_wrap' => '<ul id="menu" class="list-inline">%3$s</ul>'
            )
        );
        ?>
            </div>
        <div class="license">
            <i>Fully Licenced by Oxford City Council Licence number <?php echo $dm_settings['license']; ?></i>
        </div>
        <div>
           <img alt="" title="" src="http://www.credit-card-logos.com/images/multiple_credit-card-logos-1/credit_card_logos_11.gif" width="235" height="35" border="0" />
        </div>
    </div>


<!-- end main container -->

<?php wp_footer(); ?>
</body>
</html>