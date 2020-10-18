<?php

  function lang($word) {
    static $lang = array(
      // Dashboard

      // Navbar
      'HOMAPAGE'    => 'Homepage'
    );
    return $lang[$word];
  }
