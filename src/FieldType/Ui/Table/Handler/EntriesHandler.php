<?php namespace Anomaly\AddonsModule\FieldType\Ui\Table\Handler;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeCollection;
use Illuminate\Http\Request;

/**
 * Class EntriesHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\FieldType\Ui\Table\Handler
 */
class EntriesHandler
{

    /**
     * The request object.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Create a new EntriesHandler instance.
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
     * @param FieldTypeCollection $field_types
     * @return FieldTypeCollection
     */
    public function handle(FieldTypeCollection $field_types)
    {
        return $field_types->orderBySlug();
    }
}
