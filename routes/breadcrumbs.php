<?php

/**
 * routes/breadcrumbs.php
 *
 * @author Muhammad Shahab <muhammad.shahab@vservices.com>
 * @Date: 7/18/2019
 */

/*
|--------------------------------------------------------------------------
| Admin Dashboard
|--------------------------------------------------------------------------
*/

// Dashboard
Breadcrumbs::for('admin.dashboard.index', function ($breadcrumbs) {
    $breadcrumbs->push('Dashboard', route('admin.dashboard.index'));
});

/*
|--------------------------------------------------------------------------
| User Management > Administrator
|--------------------------------------------------------------------------
*/

// Administrator
Breadcrumbs::for('admin.administrators.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard.index');
    $breadcrumbs->push('Admin Users List', route('admin.administrators.index'));
});

// Administrator > New
Breadcrumbs::for('admin.administrators.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.administrators.index');
    $breadcrumbs->push('Add', route('admin.administrators.create'));
});

// Administrator > Show
Breadcrumbs::for('admin.administrators.show', function ($breadcrumbs, $data) {
    $breadcrumbs->parent('admin.administrators.index');
    $breadcrumbs->push($data->fullName(), route('admin.administrators.show', $data->id));
});

// Administrator > Edit
Breadcrumbs::for('admin.administrators.edit', function ($breadcrumbs, $data) {
    $breadcrumbs->parent('admin.administrators.show', $data);
    $breadcrumbs->push('Edit', route('admin.administrators.edit', $data->id));
});

/*
|--------------------------------------------------------------------------
| Pages
|--------------------------------------------------------------------------
*/

/*
 * Start Blog BreadCrumbs
 * */
// Category > Listing
Breadcrumbs::for('admin.blog.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard.index');
    $breadcrumbs->push('BLog List', route('admin.blog.index'));
});

Breadcrumbs::for('admin.blog.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.blog.index');
    $breadcrumbs->push('Add', route('admin.blog.create'));
});

// Category > Show
Breadcrumbs::for('admin.blog.show', function ($breadcrumbs, $data) {
    $breadcrumbs->parent('admin.blog.index');
    $breadcrumbs->push($data->title, route('admin.blog.show', $data->id));
});

// Category > Edit
Breadcrumbs::for('admin.blog.edit', function ($breadcrumbs, $data) {
    $breadcrumbs->parent('admin.blog.index', $data);
    $breadcrumbs->push('Edit', route('admin.blog.edit', $data->id));
});

/*
 * End Blog Breadcrumbs
 * */

/* Package BreadCrumbs*/

// Category > Listing
Breadcrumbs::for('admin.package.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard.index');
    $breadcrumbs->push('Package List', route('admin.package.index'));
});

Breadcrumbs::for('admin.package.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.package.index');
    $breadcrumbs->push('Add', route('admin.package.create'));
});

// Category > Show
Breadcrumbs::for('admin.package.show', function ($breadcrumbs, $data) {
    $breadcrumbs->parent('admin.package.index');
    $breadcrumbs->push($data->title, route('admin.package.show', $data->id));
});

// Category > Edit
Breadcrumbs::for('admin.package.edit', function ($breadcrumbs, $data) {
    $breadcrumbs->parent('admin.package.index', $data);
    $breadcrumbs->push('Edit', route('admin.package.edit', $data->id));
});

/*End Package BreadCrumbs*/



/* Tip BreadCrumbs*/

// Category > Listing
Breadcrumbs::for('admin.tip.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard.index');
    $breadcrumbs->push('Tip List', route('admin.tip.index'));
});

Breadcrumbs::for('admin.tip.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.tip.index');
    $breadcrumbs->push('Add', route('admin.tip.create'));
});

// Category > Show
Breadcrumbs::for('admin.tip.show', function ($breadcrumbs, $data) {
    $breadcrumbs->parent('admin.tip.index');
    $breadcrumbs->push($data->title, route('admin.tip.show', $data->id));
});

// Category > Edit
Breadcrumbs::for('admin.tip.edit', function ($breadcrumbs, $data) {
    $breadcrumbs->parent('admin.tip.index', $data);
    $breadcrumbs->push('Edit', route('admin.tip.edit', $data->id));
});

/*End Tip BreadCrumbs*/


/* PodCast BreadCrumbs*/

// Category > Listing
Breadcrumbs::for('admin.podcast.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard.index');
    $breadcrumbs->push('Podcast List', route('admin.podcast.index'));
});

Breadcrumbs::for('admin.podcast.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.podcast.index');
    $breadcrumbs->push('Add', route('admin.podcast.create'));
});

// Category > Show
Breadcrumbs::for('admin.podcast.show', function ($breadcrumbs, $data) {
    $breadcrumbs->parent('admin.category.index');
    $breadcrumbs->push($data->title, route('admin.podcast.show', $data->id));
});

// Category > Edit
Breadcrumbs::for('admin.podcast.edit', function ($breadcrumbs, $data) {
    $breadcrumbs->parent('admin.podcast.index', $data);
    $breadcrumbs->push('Edit', route('admin.podcast.edit', $data->id));
});

/*End PodCast BreadCrumbs*/



// Category > Listing
Breadcrumbs::for('admin.category.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard.index');
    $breadcrumbs->push('Category List', route('admin.category.index'));
});

Breadcrumbs::for('admin.category.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.category.index');
    $breadcrumbs->push('Add', route('admin.category.create'));
});

// Category > Show
Breadcrumbs::for('admin.category.show', function ($breadcrumbs, $data) {
    $breadcrumbs->parent('admin.category.index');
    $breadcrumbs->push($data->title, route('admin.category.show', $data->id));
});

// Category > Edit
Breadcrumbs::for('admin.category.edit', function ($breadcrumbs, $data) {
    $breadcrumbs->parent('admin.category.index', $data);
    $breadcrumbs->push('Edit', route('admin.category.edit', $data->id));
});

//End Category BreadCrum

// Pages > Listing
Breadcrumbs::for('admin.pages.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard.index');
    $breadcrumbs->push('Page List', route('admin.pages.index'));
});

// Pages > New
Breadcrumbs::for('admin.pages.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.pages.index');
    $breadcrumbs->push('Add', route('admin.pages.create'));
});

// Pages > Show
Breadcrumbs::for('admin.pages.show', function ($breadcrumbs, $data) {
    $breadcrumbs->parent('admin.pages.index');
    $breadcrumbs->push($data->page_title, route('admin.pages.show', $data->id));
});

// Pages > Edit
Breadcrumbs::for('admin.pages.edit', function ($breadcrumbs, $data) {
    $breadcrumbs->parent('admin.pages.index', $data);
    $breadcrumbs->push('Edit', route('admin.pages.edit', $data->id));
});

/*
|--------------------------------------------------------------------------
| Media Files
|--------------------------------------------------------------------------
*/

// Media Files > Listing
Breadcrumbs::for('admin.media-files.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard.index');
    $breadcrumbs->push('Media Files List', route('admin.media-files.index'));
});

// Media Files > New
Breadcrumbs::for('admin.media-files.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.media-files.index');
    $breadcrumbs->push('Add', route('admin.media-files.create'));
});

// Media Files > Show
Breadcrumbs::for('admin.media-files.show', function ($breadcrumbs, $data) {
    $breadcrumbs->parent('admin.media-files.index', $data);
    $breadcrumbs->push($data->caption, route('admin.media-files.show', $data->id));
});

// Media Files > Edit
Breadcrumbs::for('admin.media-files.edit', function ($breadcrumbs, $data) {
    $breadcrumbs->parent('admin.media-files.index', $data);
    $breadcrumbs->push('Edit', route('admin.media-files.edit', $data->id));
});

/*
|--------------------------------------------------------------------------
| Site Settings
|--------------------------------------------------------------------------
*/

// Site Setting
Breadcrumbs::for('admin.site-settings.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard.index');
    $breadcrumbs->push('Site Settings', route('admin.site-settings.index'));
});

/*
|--------------------------------------------------------------------------
| Change Password
|--------------------------------------------------------------------------
*/

// Change Password
Breadcrumbs::for('admin.users.change-password', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard.index');
    $breadcrumbs->push('Change Password', route('admin.users.change-password'));
});



/*
|--------------------------------------------------------------------------
| Users
|--------------------------------------------------------------------------
*/

// users
Breadcrumbs::for('admin.users.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard.index');
    $breadcrumbs->push('users List', route('admin.users.index'));
});

// users > New
Breadcrumbs::for('admin.users.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.users.index');
    $breadcrumbs->push('Add', route('admin.users.create'));
});

// users > Amazon Inc.
Breadcrumbs::for('admin.users.show', function ($breadcrumbs, $data) {
    $breadcrumbs->parent('admin.users.index');
    $breadcrumbs->push($data->name, route('admin.users.show', $data->id));
});

// users > Edit
Breadcrumbs::for('admin.users.edit', function ($breadcrumbs, $data) {
    $breadcrumbs->parent('admin.users.show', $data);
    $breadcrumbs->push('Edit', route('admin.users.edit', $data->id));
});

