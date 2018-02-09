<?php

return [
    'check' => function (\Illuminate\Contracts\Cache\Repository $cache) {

        $output = $cache->get('buffer.output');
        $exit   = $cache->get('buffer.exit');

        if ($exit) {
            $output = $cache->pull('buffer.output');
        }

        if ($exit && !$output) {
            $output = $cache->pull('buffer.exit');
        }

        echo trim($output);

        exit;
    },
];
