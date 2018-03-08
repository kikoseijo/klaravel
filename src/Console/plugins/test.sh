#!/bin/bash
DIR="$( pwd )"
PACKAGE="$1"
composer require $PACKAGE --no-interaction --verbose
echo "composer require $PACKAGE"
echo $DIR
