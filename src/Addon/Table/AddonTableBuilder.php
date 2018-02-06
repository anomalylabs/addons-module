<?php namespace Anomaly\AddonsModule\Addon\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class AddonTableBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AddonTableBuilder extends TableBuilder
{

    /**
     * The addon type to list.
     *
     * @var null|string
     */
    protected $type = null;

    /**
     * The table buttons.
     *
     * @var array
     */
    protected $buttons = [
        'view'     => [
            'href' => '{request.uri}/view/{entry.name}',
        ],
        'download' => [
            'target' => '_blank',
            'type'   => 'primary',
            'icon'   => 'download',
            'text'   => 'Download',
            'href'   => 'admin/addons/download?package={entry.name}',
        ],
    ];

    /**
     * Get the type.
     *
     * @return null|string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the type.
     *
     * @param $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
}
