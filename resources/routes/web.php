<?php

return [
    'check' => function (
        \Illuminate\Contracts\Cache\Repository $cache,
        \Anomaly\Streams\Platform\Application\Application $application
    ) {

        $output = @file_get_contents($application->getAssetsPath('composer/buffer.output')) or null;
        $exit   = @file_get_contents($application->getAssetsPath('composer/buffer.exit')) or false;

        if ($exit) {
            unlink($application->getAssetsPath('composer/buffer.output'));
        }

        if ($exit && !$output) {
            unlink($application->getAssetsPath('composer/buffer.exit'));
        }

        echo trim($output);

        exit;
    },
];
