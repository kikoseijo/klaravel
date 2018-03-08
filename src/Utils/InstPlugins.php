<?php

namespace Ksoft\Klaravel\Utils;

class InstPlugins
{
    public static $plugins = [
        'medialibrary' => [
            'name' => 'Spatie Media Library',
            'composer' => 'spatie/laravel-medialibrary',
            'main_class' => 'Spatie\MediaLibrary\MediaLibraryServiceProvider',
            'script_name' => 'spatie_laravel_media_library',
            'help_url' => 'https://docs.spatie.be/laravel-medialibrary/v6/introduction'
        ],
    ];

    public static $postInstall = [
        'medialibrary' => [
            "For Controllers",
            "##### CanUploadMedia TRAIT ######",
            "Ksoft\Klaravel\Traits\CanUploadMedia",
            "For Models",
            "##### HasMediaTrait TRAIT ######",
            "Spatie\MediaLibrary\HasMedia\HasMediaTrait",
            "##### HasMedia INTERFACE ######",
            "Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia",
        ]
    ];
}
