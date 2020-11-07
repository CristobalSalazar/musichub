#!/bin/bash

function is_fresh_install() {
  # returns if is fresh install of laravel
  return $([ -d $LARAVEL_DIR ] &&  [ ! -z "$(ls -A $LARAVEL_DIR)" ] && echo 1 || echo 0)
}

alias pa="php artisan"

if  is_fresh_install; then
  pushd $LARAVEL_DIR
  git clone https://github.com/laravel/laravel.git .
  rm -rf .git
  composer update
  npm install
  popd
  else
  composer update
  php artisan key:generate
  php artisan migrate
  npm install
fi

cd $LARAVEL_DIR && php artisan serve --host=0.0.0.0