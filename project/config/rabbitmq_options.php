<?php

return [
    'users_queue' => [
        'exchange' => 'user_events_direct',
        'exchange_type' => 'direct',
        'exchange_routing_key' => 'create_users',
    ],
];