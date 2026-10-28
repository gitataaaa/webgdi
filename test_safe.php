<?php
require 'vendor/autoload.php';
\ = require 'bootstrap/app.php';
\->make(Illuminate\\Contracts\\Console\\Kernel::class)->bootstrap();
\ = App\\Models\\ProgramLanding::all();
foreach (\ as \) {
    \ = \->info_items;
    if (is_string(\) && \ !== '') {
        \ = json_decode(\, true);
    }
}
echo 'ok';

