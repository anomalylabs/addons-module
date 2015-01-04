<?php namespace Anomaly\AddonsModule\Ui\Table\Extension\Handler;

use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Illuminate\Html\HtmlBuilder;

/**
 * Class ColumnHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Ui\Table\Extension
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
                'heading' => 'module::admin.addon',
                'value'   => function (Extension $entry) {

                        return view('module::extensions/table/extension', compact('entry'));
                    },
            ],
            [
                'heading' => 'module::admin.author',
                'value'   => function (Extension $entry) {

                        if (!$json = $entry->getComposerJson()) {
                            return null;
                        }

                        if (!isset($json->authors) || !$authors = $json->authors) {
                            return null;
                        }

                        return view('module::extensions/table/authors', compact('authors'));
                    }
            ],
            [
                'heading' => 'module::admin.link',
                'value'   => function (Extension $entry) {

                        if (!$json = $entry->getComposerJson()) {
                            return null;
                        }

                        if (isset($json->homepage)) {
                            return $this->html->link($json->homepage, null, ['target' => '_blank']);
                        }
                    }
            ],
            [
                'heading' => 'module::admin.support',
                'value'   => function (Extension $entry) {

                        if (!$json = $entry->getComposerJson()) {
                            return null;
                        }

                        if (!isset($json->support) || !$support = $json->support) {
                            return null;
                        }

                        return view('module::extensions/table/support', compact('support'));
                    }
            ]
        ];
    }
}
