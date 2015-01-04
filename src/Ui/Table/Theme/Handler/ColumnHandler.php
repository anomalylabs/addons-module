<?php namespace Anomaly\AddonsModule\Ui\Table\Theme\Handler;

use Anomaly\Streams\Platform\Addon\Theme\Theme;
use Illuminate\Html\HtmlBuilder;

/**
 * Class ColumnHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Ui\Table\Theme
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
                'value'   => function (Theme $entry) {

                        return view('module::themes/table/theme', compact('entry'));
                    },
            ],
            [
                'heading' => 'module::admin.author',
                'value'   => function (Theme $entry) {

                        if (!$json = $entry->getComposerJson()) {
                            return null;
                        }

                        if (!isset($json->authors) || !$authors = $json->authors) {
                            return null;
                        }

                        return view('module::themes/table/authors', compact('authors'));
                    }
            ],
            [
                'heading' => 'module::admin.link',
                'value'   => function (Theme $entry) {

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
                'value'   => function (Theme $entry) {

                        if (!$json = $entry->getComposerJson()) {
                            return null;
                        }

                        if (!isset($json->support) || !$support = $json->support) {
                            return null;
                        }

                        return view('module::themes/table/support', compact('support'));
                    }
            ]
        ];
    }
}
