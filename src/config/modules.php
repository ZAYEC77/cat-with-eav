<?php

return array_merge(require(__DIR__ . '/installed_modules.php'), [
    'core' => ['class' => \nullref\core\Module::class],
    'admin' => ['class' => \nullref\admin\Module::class],
    'category' => [
        'class' => nullref\category\Module::class,
        'classMap' => [
            'Category' => app\models\Category::class,
        ],
    ],

    'product' => [
        'class' => app\modules\product\Module::class,
    ],
]);