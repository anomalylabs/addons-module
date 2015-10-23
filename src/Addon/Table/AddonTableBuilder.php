<?php namespace Anomaly\AddonsModule\Addon\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class AddonTableBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Addon\Table
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
