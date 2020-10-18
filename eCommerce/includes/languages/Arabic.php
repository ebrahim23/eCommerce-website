<?php

    function lang($word) {
        static $lang = array(
            // Dashboard
            'HOMAPAGE'      => 'الصفحة الرئيسية',
            'USERNAME'      => 'ابراهيم',
            'CATS'          => 'الأقسام',
            'EDIT_PROF'     => 'تعديل الملف الشخصى',
            'SETTINGS'      => 'العدادات',
            'OUT'           => 'تسجيل خروج'
        );
        return $lang[$word];
    }
