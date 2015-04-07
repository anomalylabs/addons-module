<?php namespace Anomaly\AddonsModule\Addon\Table;

use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Ui\Table\Table;
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
     * The addon collection.
     *
     * @var AddonCollection
     */
    protected $addons;

    /**
     * Create a new AddonTableBuilder instance.
     *
     * @param Table           $table
     * @param AddonCollection $addons
     */
    public function __construct(Table $table, AddonCollection $addons)
    {
        $this->addons = $addons;

        parent::__construct($table);
    }

    /**
     * Fire before building the table.
     */
    public function onReady()
    {
        $this->table->setEntries(
            $this->addons->{$this->getOption('addon_type')}()
        );
    }
}
