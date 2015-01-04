<?php namespace Anomaly\AddonsModule\Ui\Table\Module\Handler;

use Anomaly\Streams\Platform\Addon\Module\Module;
use Illuminate\Html\HtmlBuilder;

/**
 * Class ColumnHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Ui\Table\Module
 */
class ColumnHandler
{

    /**
     * The HTML builder.
     *
     * @var \Illuminate\Html\HtmlBuilder
     */
    protected $html;

    /**
     * Create a new ColumnHandler instance.
     *
     * @param HtmlBuilder $html
     */
    public function __construct(HtmlBuilder $html)
    {
        $this->html = $html;
    }

    /**
     * Handle table columns.
     *
     * @return array
     */
    public function handle()
    {
        return [
            [
                'heading' => 'module::admin.module',
                'value'   => function (Module $entry) {

                        return view('module::modules/table/module', compact('entry'));
                    },
            ],
            [
                'heading' => 'module::admin.authors',
                'value'   => function (Module $entry) {

                        if (!$json = $entry->getComposerJson()) {
                            return null;
                        }

                        if (!isset($json->authors) || !$authors = $json->authors) {
                            return null;
                        }

                        return view('module::modules/table/authors', compact('authors'));
                    }
            ],
            [
                'heading' => 'module::admin.support',
                'value'   => function (Module $entry) {

                        if (!$json = $entry->getComposerJson()) {
                            return null;
                        }

                        if (!isset($json->support) || !$support = $json->support) {
                            return null;
                        }

                        return view('module::modules/table/support', compact('support'));
                    }
            ]
        ];
    }
}
