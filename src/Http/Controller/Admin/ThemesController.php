<?php namespace Anomaly\AddonsModule\Http\Controller\Admin;

use Anomaly\AddonsModule\Theme\Table\ThemeTableBuilder;
use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Addon\Theme\Theme;
use Anomaly\Streams\Platform\Addon\Theme\ThemeCollection;
use Anomaly\Streams\Platform\Message\MessageBag;
use Illuminate\Routing\Redirector;

/**
 * Class ThemesController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Http\Controller\Admin
 */
class ThemesController extends AddonsController
{

    /**
     * Return an index of existing themes.
     *
     * @param ThemeTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(ThemeTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Activate a theme.
     *
     * @param SettingRepositoryInterface $settings
     * @param Redirector                 $redirect
     * @param MessageBag                 $message
     * @param ThemeCollection            $themes
     * @param                            $theme
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activate(
        SettingRepositoryInterface $settings,
        Redirector $redirect,
        MessageBag $message,
        ThemeCollection $themes,
        $theme
    ) {
        /* @var Theme $theme */
        $theme = $themes->get($theme);

        if ($theme->isAdmin()) {
            $settings->set('streams::admin_theme', $theme->getNamespace());
        } else {
            $settings->set('streams::public_theme', $theme->getNamespace());
        }

        $message->success(trans('module::success.activate_theme', ['title' => trans($theme->getTitle())]));

        return $redirect->back();
    }
}
