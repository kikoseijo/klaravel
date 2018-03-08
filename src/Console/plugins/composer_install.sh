#!/bin/bash


PLUGIN="$1"
whoami
# dir=$(cd ../ && pwd -P)
composer require $($1) \
--sort-packages \
--no-scripts
# php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="migrations"
# # php artisan migrate
# php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="config"
# echo "For Controllers"
# echo "##### CanUploadMedia TRAIT ######"
# echo "Ksoft\Klaravel\Traits\CanUploadMedia"
# echo "For Models"
# echo "##### HasMediaTrait TRAIT ######"
# echo "Spatie\MediaLibrary\HasMedia\HasMediaTrait"
# echo "##### HasMedia INTERFACE ######"
# echo "Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia"
# echo "For how to use see https://docs.spatie.be/laravel-medialibrary/v6/introduction"
echo "hehee composer require $($1) as> " + $(whoami)
