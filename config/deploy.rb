# config valid for current version and patch releases of Capistrano
lock "~> 3.11.0"

set :application, "application_name"
set :repo_url, "git@gitlab.com:nipeharefa/jkago-sym.git"
append :linked_dirs, "config/jwt"

# Force install when requirements failed
set :composer_install_flags, '--no-dev --no-interaction --quiet --ignore-platform-reqs'

set :file_permissions_paths, ["var/log", "var/cache"]
set :file_permissions_users, ["www-data", "deploy"]

# Symfony Configuration
set :symfony_directory_structure, 3
set :sensio_distribution_version, 5
# set :app_config_path, nil
set :controllers_to_clear, []
set :log_path, "var/logs"
set :cache_path, "var/cache"

set :linked_files, []

set :default_env, {
    APP_ENV: 'prod',
    APP_SECRET: 'b901a223cabbd459c37fdbee793e5170b335db55',
    NELMIO_KEY: 'develop',
    NELMIO_SECRET: '12345678',
    NELMIO_URL: 'https://cdn.moangi.com',
    NELMIO_BUCKET: 'jkago',
    RESOLVE_CACHE_URL: 'https://cdn.moangi.com/jkago'
}

before "deploy:symlink:release", "deploy:set_permissions:acl"
