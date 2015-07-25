<?php namespace Anomaly\AddonsModule\FieldType\Table;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeCollection;

/**
 * Class FieldTypeTableEntries
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\FieldType\Table
 */
class FieldTypeTableEntries
{

    /**
     * Handle the table entries.
     *
     * @param FieldTypeTableBuilder $builder
     * @param FieldTypeCollection   $fieldTypes
     */
    public function handle(FieldTypeTableBuilder $builder, FieldTypeCollection $fieldTypes)
    {
        $builder->setTableEntries($fieldTypes);
    }
}
