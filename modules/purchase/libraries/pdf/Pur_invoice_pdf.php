<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(APPPATH . 'libraries/pdf/App_pdf.php');

class Pur_invoice_pdf extends App_pdf
{
    protected $pur_invoice;

    public function __construct($pur_invoice)
    {
        $GLOBALS['pur_invoice_pdf'] = $pur_invoice;
        parent::__construct();
        $this->pur_invoice = $pur_invoice;
        $this->SetTitle(_l('purchase_invoice'));
    }

    public function prepare()
    {
        $this->set_view_vars('pur_invoice', $this->pur_invoice);
        return $this->build();
    }

    public function get_format_array()
    {
        return ['orientation' => 'L', 'format' => 'A4'];
    }

    protected function type()
    {
        return 'pur_invoice';
    }

    protected function file_path()
    {
        return APP_MODULES_PATH . '/purchase/views/invoices/pur_invoice_pdf.php';
    }
}
