<?php

/**
 * AssetHelper
 *
 * @author Muhammad Shahab <muhammad.shahab@vservices.com>
 * @date   07/19/19
 */

/**
 * Return's admin assets directory
 *
 * CALLING PROCEDURE
 *
 * In controller call it like this:
 * $adminAssetsDirectory = adminAssetsDir() . $site_settings->site_logo;
 *
 * In View call it like this:
 * {{ asset(adminAssetsDir() . $site_settings->site_logo) }}
 *
 * @param string $role
 *
 * @return bool
 */
function uploadsDir()
{
    return 'uploads/';
}

function uploadsUrl($file = '')
{
    return $file != '' && file_exists('uploads/' . $file) ? url('uploads') . '/' . $file : '';
}

function adminHasAssets($image)
{
    if (!empty($image) && file_exists(uploadsDir() . $image)) {
        return true;
    } else {
        return false;
    }
}

function defaultUserImage()
{
    return 'assets/admin/img/avatar.png';
}

function defaultStoreCoverUrl()
{
    return 'assets/front/images/store-cover.png';
}

/**
 * Return's admin invoice directory
 *
 * CALLING PROCEDURE
 *
 * In controller call it like this:
 * $invoiceDir = invoiceDir() . $invoice->invoice_file;
 *
 * In View call it like this:
 * {{ asset(invoiceDir() . $invoice->invoice_file) }}
 *
 * @return string
 */
function invoiceDir()
{
    return 'invoices/';
}
