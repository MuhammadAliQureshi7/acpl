<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: Purchase Invoice Serials
Description: Link item serial numbers to Purchase Invoices. Select a purchase invoice and either upload an Excel/CSV file containing item code and serial number columns, or add serials manually.
Version: 1.0.0
Requires at least: 2.3.*
Author: ACPL
*/

define('PI_SERIALS_MODULE_NAME', 'pi_serials');
define('PI_SERIALS_REVISION', 100);

hooks()->add_action('admin_init', 'pi_serials_permissions');
hooks()->add_action('admin_init', 'pi_serials_module_init_menu_items');
hooks()->add_action('app_admin_head', 'pi_serials_add_head_components');
hooks()->add_action('app_admin_footer', 'pi_serials_add_footer_components');

/**
 * Register activation module hook
 */
register_activation_hook(PI_SERIALS_MODULE_NAME, 'pi_serials_module_activation_hook');

/**
 * Load the module helper
 */
$CI = &get_instance();
$CI->load->helper(PI_SERIALS_MODULE_NAME . '/pi_serials');

function pi_serials_module_activation_hook()
{
    $CI = &get_instance();
    require_once(__DIR__ . '/install.php');
}

/**
 * Register language files, must be registered if the module is using languages
 */
register_language_files(PI_SERIALS_MODULE_NAME, [PI_SERIALS_MODULE_NAME]);

/**
 * Init pi_serials module menu items in admin_init hook
 * @return null
 */
function pi_serials_module_init_menu_items()
{
    $CI = &get_instance();
    if (has_permission('pi_serials', '', 'view') || is_admin()) {
        $CI->db->where('module_name', 'purchase');
        $module = $CI->db->get(db_prefix() . 'modules')->row();

        if ($module) {
            $CI->app_menu->add_sidebar_children_item('purchase', [
                'slug'     => 'pi-serials',
                'name'     => _l('pi_serials'),
                'icon'     => 'fa fa-qrcode',
                'href'     => admin_url('pi_serials'),
                'position' => 11,
            ]);
        } else {
            $CI->app_menu->add_sidebar_menu_item('pi_serials', [
                'name'     => _l('pi_serials'),
                'icon'     => 'fa fa-qrcode',
                'position' => 30,
            ]);

            $CI->app_menu->add_sidebar_children_item('pi_serials', [
                'slug'     => 'pi-serials',
                'name'     => _l('pi_serials'),
                'icon'     => 'fa fa-qrcode',
                'href'     => admin_url('pi_serials'),
                'position' => 1,
            ]);
        }
    }
}

/**
 * pi_serials permissions
 */
function pi_serials_permissions()
{
    $capabilities = [];

    $capabilities['capabilities'] = [
        'view'   => _l('permission_view') . '(' . _l('permission_global') . ')',
        'create' => _l('permission_create'),
        'edit'   => _l('permission_edit'),
        'delete' => _l('permission_delete'),
    ];

    register_staff_capabilities('pi_serials', $capabilities, _l('pi_serials'));
}

/**
 * pi_serials add head components
 * @return
 */
function pi_serials_add_head_components()
{
    $CI = &get_instance();
    $viewuri = $_SERVER['REQUEST_URI'];
    if (!(strpos($viewuri, '/admin/pi_serials') === false)) {
        echo '<link href="' . module_dir_url(PI_SERIALS_MODULE_NAME, 'assets/css/style.css') . '?v=' . PI_SERIALS_REVISION . '"  rel="stylesheet" type="text/css" />';
    }
    if (!(strpos($viewuri, '/admin/pi_serials/serials') === false)) {
        echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>';
    }
}

/**
 * pi_serials add footer components
 * @return
 */
function pi_serials_add_footer_components()
{
    $CI = &get_instance();
    $viewuri = $_SERVER['REQUEST_URI'];
    if (!(strpos($viewuri, '/admin/pi_serials') === false)) {
        echo '<script src="' . module_dir_url(PI_SERIALS_MODULE_NAME, 'assets/js/pi_serials.js') . '?v=' . PI_SERIALS_REVISION . '"></script>';
    }
}
