<?php foreach ($this->modules as $module): ?>
    <p>
        <strong>
            <?php echo $module->getName(); ?>
        </strong>
        &nbsp;
        <?php echo \HTML::link('admin/addons/installer/install/module/'.$module->slug, 'Install'); ?>
         -
        <?php echo \HTML::link('admin/addons/installer/uninstall/module/'.$module->slug, 'Uninstall'); ?>
    </p>
<?php endforeach; ?>