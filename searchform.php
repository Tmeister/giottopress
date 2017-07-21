<?php
/**
 * The template for displaying search forms.
 *
 * @package giotto
 */
?>

<form method="get" class="searchform" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="field has-addons">
        <div class="control is-expanded">
            <input type="text" class="input" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'giottopress' ); ?>">
        </div>
        <div class="control">
            <a class="button is-primary">
				<?php esc_attr_e( 'Search', 'giottopress' ); ?>
            </a>
        </div>
    </div>
</form>