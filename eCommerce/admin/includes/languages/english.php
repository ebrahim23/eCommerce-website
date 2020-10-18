<?php

  function lang($word) {
    static $lang = array(
      // Dashboard

      // Navbar
      'HOMAPAGE'    => 'Dashboard',
      'USERNAME'    => 'Ibrahim',
      'CATS'        => 'Categories',
      'ITEMS'       => 'Items',
      'MEMBER'      => 'Members',
      'COMMENT'     => 'Comments',
      'STATS'       => 'Statistics',
      'LOGS'        => 'Logs',
      'EDIT_PROF'   => 'Edit Profile',
      'INDEX'       => 'Visit Shop',
      'SETTINGS'    => 'Settings',
      'OUT'         => 'Log Out'
    );
    return $lang[$word];
  }
