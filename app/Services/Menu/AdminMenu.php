<?php

namespace App\Services\Menu;

use Spatie\Menu\Laravel\Link;
use Spatie\Menu\Laravel\Menu;

class AdminMenu
{
    public function register()
    {
        Menu::macro('admin', function ($user) {

            $menu = Menu::new()
                ->addClass('page-sidebar-menu')
                ->setAttribute('data-keep-expanded', 'false')
                ->setAttribute('data-auto-scroll', 'true')
                ->setAttribute('data-slide-speed', '200')
                ->html('<div class="sidebar-toggler hidden-phone"></div>');

            $menu = $menu->add(Link::toRoute(
                'admin.dashboard.index',
                '<i class="fa fa-home"></i> <span class="title">Dashboard</span>'
            )->addParentClass('start'));

            $menu = $menu->add(Link::toRoute(
                'admin.media-files.index',
                '<i class="fa fa-file"></i> <span class="title">Media Files</span>'
            ));

            // $menu = $menu->add(Link::toRoute(
            //     'admin.users.index',
            //     '<i class="fa fa-users"></i> <span class="title">Users</span>'
            // ));


            $menu = $menu->add(Link::toRoute(
                'admin.pages.index',
                '<i class="fa fa-th"></i> <span class="title">Pages</span>'
            ));

            $menu = $menu->add(Link::toRoute(
                'admin.category.index',
                '<i class="fa fa-meh-o"></i> <span class="title">Category</span>'
            ));


            $menu = $menu->add(Link::toRoute(
                'admin.blog.index',
                '<i class="fa fa-thumb-tack"></i> <span class="title">Blog</span>'
            ));


            $menu = $menu->add(Link::toRoute(
                'admin.administrators.index',
                '<i class="fa fa-user"></i> <span class="title">Admin Users</span>'
            ));

            $menu = $menu->add(Link::toRoute(
                'admin.site-settings.index',
                '<i class="fa fa-cog"></i> <span class="title">Site Settings</span>'
            ));

            $menu = $menu->add(Link::toRoute(
                'admin.users.change-password',
                '<i class="fa fa-lock"></i> <span class="title">Change Password</span>'
            ))
                ->add(Link::toRoute(
                    'admin.auth.logout',
                    '<i class="fa fa-sign-out"></i> <span class="title">Logout</span>'
                )->setAttribute('id', 'leftnav-logout-link'))
                ->setActiveFromRequest();

            return $menu;
        });
    }
}
