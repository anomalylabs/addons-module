<?php namespace Anomaly\Streams\Addon\Module\Addons\Ui\Table\View;

use Anomaly\Streams\Platform\Ui\Table\View\Contract\ViewInterface;
use Anomaly\Streams\Platform\Ui\Table\View\View;

class InstalledModulesView extends View implements ViewInterface
{

    function __construct(
        $text = 'misc.all',
        $slug = 'installed',
        $active = false,
        $prefix = null,
        $handler = null,
        array $attributes = []
    ) {
        parent::__construct(
            $text,
            $slug,
            $active,
            $prefix,
            $handler,
            $attributes
        );
    }
}
 