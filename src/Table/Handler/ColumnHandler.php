<?php namespace Anomaly\AddonsModule\Table\Handler;

use Anomaly\Streams\Platform\Addon\Addon;
use Illuminate\Html\HtmlBuilder;
use stdClass;

/**
 * Class ColumnHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Table
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
     * Return author links.
     *
     * @param Addon $addon
     * @return null|string
     */
    public function authors(Addon $addon)
    {
        // If there is no JSON data, skip it.
        if (!$json = $addon->getComposerJson()) {
            return null;
        }

        // If there is not author data, skip it.
        if (!isset($json->authors) || !$authors = $json->authors) {
            return null;
        }

        // Create an array of links.
        $links = array_map(
            function (stdClass $author) {

                // Determine the author homepage.
                $homepage = isset($author->homepage) ? $author->homepage : '#';

                // Return an HTML anchor.
                return $this->html->link($homepage, $author->name, ['target' => '_blank']);
            },
            $authors
        );

        // Return stacked links.
        return implode('<br>', $links);
    }

    /**
     * Return addon link.
     *
     * @param Addon $addon
     * @return null|string
     */
    protected function link(Addon $addon)
    {
        // If there is no JSON data, skip it.
        if (!$json = $addon->getComposerJson()) {
            return null;
        }

        if (isset($json->homepage)) {
            return $this->html->link($json->homepage, null, ['target' => '_blank']);
        }
    }

    /**
     * Return support links.
     *
     * @param Addon $addon
     * @return null|string
     */
    protected function support(Addon $addon)
    {
        // If there is no JSON data, skip it.
        if (!$json = $addon->getComposerJson()) {
            return null;
        }

        if (isset($json->support) && $support = $json->support) {

            $links = [];

            if (isset($support->email)) {
                $links[] = $this->html->mailto($support->email);
            }

            foreach (['forum', 'wiki', 'irc', 'source'] as $link) {
                if (isset($support->{$link})) {
                    $links[] = $this->html->link($support->{$link}, null, ['target' => '_blank']);
                }
            }

            return implode('<br>', $links);
        }
    }

    /**
     * Return the version.
     *
     * @param Addon $addon
     * @return mixed
     */
    protected function version(Addon $addon)
    {
        // If there is no JSON data, skip it.
        if (!$json = $addon->getComposerJson()) {
            return null;
        }

        // If the version is not set then skip it.
        if (!isset($json->version)) {
            return null;
        }

        return $json->version;
    }
}
