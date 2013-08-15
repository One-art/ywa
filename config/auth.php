<?php
    /*
     * OPERATION LIST
     */
return array_merge(
    require_once('authOperations.php'),
    array(
        /*
         * ROLES LIST
         */
        'guest' => array(
            'type' => CAuthItem::TYPE_ROLE,
            'description' => 'Guest',
            'bizRule' => null,
            'data' => null
        ),
        'user' => array(
            'type' => CAuthItem::TYPE_ROLE,
            'description' => 'User',
            'children' => array(
                'logout'
            ),
            'bizRule' => null,
            'data' => null
        ),
        'moderator' => array(
            'type' => CAuthItem::TYPE_ROLE,
            'description' => 'Moderator',
            'children' => array(
                'user',
            ),
            'bizRule' => null,
            'data' => null
        ),
        'administrator' => array(
            'type' => CAuthItem::TYPE_ROLE,
            'description' => 'Administrator',
            'children' => array(
                'moderator',
            ),
            'bizRule' => null,
            'data' => null
        ),
    )
);