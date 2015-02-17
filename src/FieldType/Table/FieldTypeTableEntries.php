<?php namespace Anomaly\AddonsModule\FieldType\Table;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeCollection;
use Anomaly\Streams\Platform\Ui\Table\Table;
use Illuminate\Http\Request;

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
     * The request object.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Create a new FieldTypeTableEntries instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the table entries.
     *
     * @param Table               $table
     * @param FieldTypeCollection $field_types
     */
    public function handle(Table $table, FieldTypeCollection $field_types)
    {
        $table->setEntries($field_types->orderBySlug());
    }
}
