<?php foreach ($themes as $theme): ?>
    <p>
        <strong>
            <?php echo $theme->getName(); ?>
        </strong>
        &nbsp;
        <?php echo \HTML::link('admin/addons/installer/install/theme/'.$theme->slug, 'Install'); ?>
        -
        <?php echo \HTML::link('admin/addons/installer/uninstall/theme/'.$theme->slug, 'Uninstall'); ?>
    </p>
<?php endforeach; ?>