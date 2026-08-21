<?php

declare(strict_types=1);

require __DIR__ . '/app/render.php';

http_response_code(404);
render_static_page('404.html');
