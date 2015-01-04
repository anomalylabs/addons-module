<?php namespace Anomaly\AddonsModule\Ui\Table\Plugin\Handler;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Illuminate\Html\HtmlBuilder;

/**
 * Class ColumnHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Ui\Table\Plugin
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
                'value'   => function (Plugin $entry) {

                        return view('module::plugins/table/plugin', compact('entry'));
                    },
            ],
            [
                'heading' => 'module::admin.author',
                'value'   => function (Plugin $entry) {

                        if (!$json = $entry->getComposerJson()) {
                            return null;
                        }

                        if (!isset($json->authors) || !$authors = $json->authors) {
                            return null;
                        }

                        return view('module::plugins/table/authors', compact('authors'));
                    }
            ],
            [
                'heading' => 'module::admin.link',
                'value'   => function (Plugin $entry) {

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
                'value'   => function (Plugin $entry) {

                        if (!$json = $entry->getComposerJson()) {
                            return null;
                        }

                        if (!isset($json->support) || !$support = $json->support) {
                            return null;
                        }

                        return view('module::plugins/table/support', compact('support'));
                    }
            ]
        ];
    }
}
