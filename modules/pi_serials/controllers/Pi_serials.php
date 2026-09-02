<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Purchase Invoice Serials module controller
 */
class Pi_serials extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pi_serials/pi_serials_model');
    }

    /**
     * List purchase invoices
     */
    public function index()
    {
        if (!has_permission('pi_serials', '', 'view') && !is_admin()) {
            access_denied('pi_serials');
        }

        $data['title'] = _l('pi_serials');
        $this->load->view('index', $data);
    }

    /**
     * Table of purchase invoices
     */
    public function table_pur_invoices()
    {
        if (!has_permission('pi_serials', '', 'view') && !is_admin()) {
            access_denied('pi_serials');
        }

        $this->app->get_table_data(module_views_path('pi_serials', 'table_pur_invoices'));
    }

    /**
     * Manage serials for a purchase invoice
     *
     * @param  int  $pi_id  purchase invoice id
     */
    public function serials($pi_id = '')
    {
        if (!has_permission('pi_serials', '', 'view') && !is_admin()) {
            access_denied('pi_serials');
        }

        if ($pi_id == '' || !is_numeric($pi_id)) {
            redirect(admin_url('pi_serials'));
        }

        $pur_invoice = $this->pi_serials_model->get_pur_invoice($pi_id);
        if (!$pur_invoice) {
            set_alert('warning', _l('pi_serial_invoice_not_found'));
            redirect(admin_url('pi_serials'));
        }

        $data['title']             = _l('pi_serials') . ' - ' . $pur_invoice->invoice_number;
        $data['pur_invoice']       = $pur_invoice;
        $data['pur_invoice_items'] = $this->pi_serials_model->get_pur_invoice_items($pi_id);
        $data['itemserials']       = $this->pi_serials_model->get_serials($pi_id);

        $this->load->view('serials', $data);
    }

    /**
     * Save serials for a purchase invoice (AJAX)
     *
     * @param  int  $pi_id  purchase invoice id
     */
    public function save($pi_id = '')
    {
        if (!has_permission('pi_serials', '', 'edit') && !has_permission('pi_serials', '', 'create') && !is_admin()) {
            echo json_encode(['success' => false, 'message' => _l('access_denied')]);
            die;
        }

        if (!$this->input->post() || $pi_id == '' || !is_numeric($pi_id)) {
            echo json_encode(['success' => false, 'message' => _l('pi_serial_invalid_request')]);
            die;
        }

        $serials_json = $this->input->post('serials');
        $serial_rows  = json_decode($serials_json, true);
        if (!is_array($serial_rows)) {
            $serial_rows = [];
        }

        $result = $this->pi_serials_model->save_serials($pi_id, $serial_rows);

        echo json_encode([
            'success' => true,
            'count'   => $result['saved'],
            'skipped' => $result['skipped'],
            'message' => _l('pi_serial_saved_successfully'),
        ]);
        die;
    }

    /**
     * Clear all serials of a purchase invoice (AJAX)
     *
     * @param  int  $pi_id  purchase invoice id
     */
    public function clear($pi_id = '')
    {
        if (!has_permission('pi_serials', '', 'delete') && !has_permission('pi_serials', '', 'edit') && !is_admin()) {
            echo json_encode(['success' => false, 'message' => _l('access_denied')]);
            die;
        }

        if ($pi_id == '' || !is_numeric($pi_id)) {
            echo json_encode(['success' => false, 'message' => _l('pi_serial_invalid_request')]);
            die;
        }

        $this->pi_serials_model->delete_serials($pi_id);

        echo json_encode(['success' => true, 'message' => _l('pi_serial_cleared')]);
        die;
    }

    /**
     * Search items for the select2 picker (AJAX)
     */
    public function search_items()
    {
        $q       = $this->input->get('q');
        $results = $this->pi_serials_model->search_items($q);

        echo json_encode($results);
        die;
    }
}
