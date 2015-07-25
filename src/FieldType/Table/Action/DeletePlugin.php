<?php namespace Anomaly\AddonsModule\FieldType\Table\Action;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeCollection;
use Anomaly\Streams\Platform\Ui\Table\Component\Action\ActionHandler;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Filesystem\Filesystem;

/**
 * Class DeleteFieldType
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\FieldType\Table\Action
 */
class DeleteFieldType extends ActionHandler implements SelfHandling
{

    /**
     * Handle the action.
     *
     * @param $selected
     */
    public function handle(FieldTypeCollection $fieldTypes, Filesystem $files, $selected)
    {
        $count = 0;

        foreach ($selected as $fieldType) {

            /* @var FieldType $fieldType */
            $fieldType = $fieldTypes->get($fieldType);

            if ($files->isWritable($fieldType->getPath()) && $files->deleteDirectory($fieldType->getPath())) {
                $count++;
            }
        }

        $this->messages->success(trans('module::success.delete_plugins', compact('count')));
    }
}
