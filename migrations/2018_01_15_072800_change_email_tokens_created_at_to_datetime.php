<?php

/*
 * This file is part of Flarum.
 *
 * (c) Toby Zerner <toby.zerner@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        // do this manually because dbal doesn't recognize timestamp columns
        $connection = $schema->getConnection();
        $prefix = $connection->getTablePrefix();
        $connection->statement("ALTER TABLE {$prefix}email_tokens MODIFY created_at DATETIME");
    },

    'down' => function (Builder $schema) {
        $connection = $schema->getConnection();
        $prefix = $connection->getTablePrefix();
        $connection->statement("ALTER TABLE {$prefix}email_tokens MODIFY created_at TIMESTAMP");
    }
];
