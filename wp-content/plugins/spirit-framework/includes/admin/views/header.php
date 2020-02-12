<?php $theme_name = sf_get_parent_theme_name(); ?>
<div id="sf-admin-wrap" class="about-wrap">
    <h1><?php
        printf(
            __( 'Welcome to %s!', 'spirit' ), // WPCS: XSS ok.
            $theme_name
        ); ?>
    </h1>
    <div class="about-text"><?php
        printf(
            __( '%s is now installed and ready to use! Get ready to build something beautiful! Please register your purchase to get automatic theme updates, import demos and install premium plugins.', 'spirit' ), // WPCS: XSS ok.
            $theme_name
        );
        ?>
    </div>
    <?php global $submenu;
    if ( isset( $submenu['sf_welcome'] ) ) {
        $nav_tabs = $submenu['sf_welcome'];
    }
    if ( ! empty( $nav_tabs ) ) { ?>
        <h2 class="nav-tab-wrapper">
        <?php foreach ( $nav_tabs as $tab ) : ?>
            <?php if ( 'customize.php' == $tab[2] ) : ?>
            <a href="<?php echo esc_attr( $tab[2] ); ?>" class="nav-tab <?php if ( isset( $_GET['page'] ) && $_GET['page'] == $tab[2] ) { echo 'nav-tab-active'; } ?> "><?php echo esc_html( $tab[0] ); ?></a>
            <?php else : ?>
            <a href="admin.php?page=<?php echo esc_attr( $tab[2] ); ?>" class="nav-tab <?php if ( isset( $_GET['page'] ) && $_GET['page'] == $tab[2] ) { echo 'nav-tab-active'; } ?> "><?php echo esc_html( $tab[0] ); ?></a>
            <?php endif; ?>
        <?php endforeach; ?>
        </h2><?php
    }