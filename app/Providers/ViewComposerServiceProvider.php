<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composeAdminPages();
    }

    /**
     * Compose the admin pages
     *
     * e-g: admin page titles etc.
     */
    private function composeAdminPages()
    {
        /*
         * Dashboard
         */
        view()->composer('admin.dashboard.index', function ($view) {
            $view->with(['pageTitle' => 'Dashboard']);
        });

        /*
         * Administrators
         */
        view()->composer('admin.administrators.index', function ($view) {
            $view->with(['pageTitle' => 'Admin Users List']);
        });
        view()->composer('admin.administrators.create', function ($view) {
            $view->with(['pageTitle' => 'Add Admin User']);
        });
        view()->composer('admin.administrators.show', function ($view) {
            $view->with(['pageTitle' => 'Show Admin User']);
        });
        view()->composer('admin.administrators.edit', function ($view) {
            $view->with(['pageTitle' => 'Edit Admin User']);
        });


        /*
            Blog BreadCrum
        */
        view()->composer('admin.blog.index', function ($view) {
            $view->with(['pageTitle' => 'Blog List']);
        });
        view()->composer('admin.blog.create', function ($view) {
            $view->with(['pageTitle' => 'Add Blog']);
        });
        view()->composer('admin.blog.show', function ($view) {
            $view->with(['pageTitle' => 'Show Blog']);
        });
        view()->composer('admin.blog.edit', function ($view) {
            $view->with(['pageTitle' => 'Edit Blog']);
        });

        /*
 * Category
 */
        view()->composer('admin.category.index', function ($view) {
            $view->with(['pageTitle' => 'Category List']);
        });
        view()->composer('admin.category.create', function ($view) {
            $view->with(['pageTitle' => 'Add Category']);
        });
        view()->composer('admin.category.show', function ($view) {
            $view->with(['pageTitle' => 'Show Category']);
        });
        view()->composer('admin.category.edit', function ($view) {
            $view->with(['pageTitle' => 'Edit Category']);
        });


        /*
         * Pages
         */
        view()->composer('admin.pages.index', function ($view) {
            $view->with(['pageTitle' => 'Page List']);
        });
        view()->composer('admin.pages.create', function ($view) {
            $view->with(['pageTitle' => 'Add Page']);
        });
        view()->composer('admin.pages.show', function ($view) {
            $view->with(['pageTitle' => 'Show Page']);
        });
        view()->composer('admin.pages.edit', function ($view) {
            $view->with(['pageTitle' => 'Edit Page']);
        });

        /*
         * Media File
         */
        view()->composer('admin.media_files.index', function ($view) {
            $view->with(['pageTitle' => 'Media File List']);
        });
        view()->composer('admin.media_files.create', function ($view) {
            $view->with(['pageTitle' => 'Add Media File']);
        });
        view()->composer('admin.media_files.show', function ($view) {
            $view->with(['pageTitle' => 'Show Media File']);
        });
        view()->composer('admin.media_files.edit', function ($view) {
            $view->with(['pageTitle' => 'Edit Media File']);
        });


        /*
         * Permissions
         */
        view()->composer('admin.permissions.index', function ($view) {
            $view->with(['pageTitle' => 'Permissions List']);
        });
        view()->composer('admin.permissions.create', function ($view) {
            $view->with(['pageTitle' => 'Add Permission']);
        });
        view()->composer('admin.permissions.show', function ($view) {
            $view->with(['pageTitle' => 'Show Permission']);
        });
        view()->composer('admin.permissions.edit', function ($view) {
            $view->with(['pageTitle' => 'Edit Permission']);
        });

        /*
         * Roles
         */
        view()->composer('admin.roles.index', function ($view) {
            $view->with(['pageTitle' => 'Roles List']);
        });
        view()->composer('admin.roles.create', function ($view) {
            $view->with(['pageTitle' => 'Add Role']);
        });
        view()->composer('admin.roles.show', function ($view) {
            $view->with(['pageTitle' => 'Show Role']);
        });
        view()->composer('admin.roles.edit', function ($view) {
            $view->with(['pageTitle' => 'Edit Role']);
        });


        /*
         * Users
         */
        view()->composer('admin.users.index', function ($view) {
            $view->with(['pageTitle' => 'Users List']);
        });
        view()->composer('admin.users.create', function ($view) {
            $view->with(['pageTitle' => 'Add User']);
        });
        view()->composer('admin.users.show', function ($view) {
            $view->with(['pageTitle' => 'Show User']);
        });
        view()->composer('admin.users.edit', function ($view) {
            $view->with(['pageTitle' => 'Edit User']);
        });

        /*
         * Site Setting
         */
        view()->composer('admin.siteSettings', function ($view) {
            $view->with(['pageTitle' => 'Site Settings']);
        });

        /*
         * Change Password
         */
        view()->composer('admin.users.changePassword', function ($view) {
            $view->with(['pageTitle' => 'Change Password']);
        });


    }
}
