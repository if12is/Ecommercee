<?php
// English

function lang($phrase)
{
    static $lang = array(
        //NAVBAR LINKED
        'HOME_ADMIN'    => 'Home',
        'CATEGORIES'    => 'Categories',
        'ITEMS'         => 'Items',
        'MEMBERS'       => 'Members',
        'COMMENTS'      => 'comments',
        'STATISTICS'    => 'Statistics',
        'LOGS'          => 'Logs',
        ''              => '',
        ''              => '',
        ''              => '',
    );
    return $lang[$phrase];
}
