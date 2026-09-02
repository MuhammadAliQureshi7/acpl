<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pi_serials_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get a single purchase invoice joined with vendor info.
     *
     * @param  int  $id  purchase invoice id
     * @return object|false
     */
    public function get_pur_invoice($id = '')
    {
        if ($id == '' || !is_numeric($id)) {
            return false;
        }

        $this->db->where(db_prefix() . 'pur_invoices.id', intval($id));
        $this->db->join(db_prefix() . 'pur_vendor', db_prefix() . 'pur_vendor.userid = ' . db_prefix() . 'pur_invoices.vendor', 'left');

        return $this->db->get(db_prefix() . 'pur_invoices')->row();
    }

    /**
     * Get the item lines of a purchase invoice from tblitemable.
     *
     * @param  int  $pi_id  purchase invoice id
     * @return array
     */
    public function get_pur_invoice_items($pi_id)
    {
        $this->db->select(db_prefix() . 'itemable.*, ' . db_prefix() . 'items.commodity_code, ' . db_prefix() . 'items.description');
        $this->db->from(db_prefix() . 'itemable');
        $this->db->join(db_prefix() . 'items', db_prefix() . 'items.id = ' . db_prefix() . 'itemable.item_code', 'left');
        $this->db->where(db_prefix() . 'itemable.rel_id', intval($pi_id));
        $this->db->where(db_prefix() . 'itemable.rel_type', 'pur_invoice');
        $this->db->order_by(db_prefix() . 'itemable.item_order', 'ASC');

        return $this->db->get()->result_array();
    }

    /**
     * Get the serials attached to a purchase invoice.
     *
     * @param  int  $pi_id  purchase invoice id
     * @return array
     */
    public function get_serials($pi_id)
    {
        $this->db->select(db_prefix() . 'itemserials.*, ' . db_prefix() . 'items.commodity_code, ' . db_prefix() . 'items.description');
        $this->db->from(db_prefix() . 'itemserials');
        $this->db->join(db_prefix() . 'items', db_prefix() . 'items.id = ' . db_prefix() . 'itemserials.item_id', 'left');
        $this->db->where(db_prefix() . 'itemserials.pi_id', intval($pi_id));
        $this->db->order_by(db_prefix() . 'itemserials.id', 'ASC');

        return $this->db->get()->result_array();
    }

    /**
     * Count serials attached to a purchase invoice.
     *
     * @param  int  $pi_id  purchase invoice id
     * @return int
     */
    public function count_serials($pi_id)
    {
        $this->db->where('pi_id', intval($pi_id));
        $this->db->from(db_prefix() . 'itemserials');

        return $this->db->count_all_results();
    }

    /**
     * Replace all serials of a purchase invoice with the given rows.
     * Each row is an array: [item_code, serial_number]. The item code is
     * resolved against tblitems.commodity_code (fallback: numeric item id).
     *
     * @param  int    $pi_id        purchase invoice id
     * @param  array  $serial_rows  rows to save
     * @return array  ['saved' => int, 'skipped' => int]
     */
    public function save_serials($pi_id, $serial_rows)
    {
        $rows    = [];
        $skipped = 0;
        $now     = date('Y-m-d H:i:s');

        foreach ($serial_rows as $row) {
            $item_code = isset($row[0]) ? trim($row[0]) : '';
            $serial    = isset($row[1]) ? trim($row[1]) : '';

            if ($item_code == '' || $serial == '') {
                continue;
            }

            $item_id = $this->resolve_item_id($item_code);
            if (!$item_id) {
                $skipped++;
                continue;
            }

            $rows[] = [
                'item_id'      => $item_id,
                'pi_id'        => intval($pi_id),
                'serial_number' => $serial,
                'is_sold'      => 0,
                'created_at'   => $now,
                'updated_at'   => $now,
            ];
        }

        $this->delete_serials($pi_id);

        if (count($rows) > 0) {
            $this->db->insert_batch(db_prefix() . 'itemserials', $rows);
        }

        return ['saved' => count($rows), 'skipped' => $skipped];
    }

    /**
     * Delete all serials of a purchase invoice.
     *
     * @param  int  $pi_id  purchase invoice id
     * @return bool
     */
    public function delete_serials($pi_id)
    {
        $this->db->where('pi_id', intval($pi_id));

        return $this->db->delete(db_prefix() . 'itemserials');
    }

    /**
     * Search items by commodity code / description / sku for the select2 picker.
     *
     * @param  string  $q  search term
     * @return array
     */
    public function search_items($q = '')
    {
        $this->db->select('id, commodity_code, description, sku_code');
        $this->db->from(db_prefix() . 'items');

        if ($q != '') {
            $this->db->group_start();
            $this->db->like('commodity_code', $q);
            $this->db->or_like('description', $q);
            $this->db->or_like('sku_code', $q);
            $this->db->group_end();
        }

        $this->db->limit(50);
        $items = $this->db->get()->result_array();

        $results = [];
        foreach ($items as $item) {
            $code = $item['commodity_code'] != '' ? $item['commodity_code'] : $item['id'];
            $results[] = [
                'id'   => $code,
                'name' => $code . ' - ' . (isset($item['description']) ? $item['description'] : ''),
            ];
        }

        return $results;
    }

    /**
     * Resolve an item code entered by the user to tblitems.id.
     *
     * @param  string  $item_code  commodity code or numeric item id
     * @return int
     */
    private function resolve_item_id($item_code)
    {
        $item = $this->db->query('SELECT id FROM ' . db_prefix() . "items WHERE commodity_code = '" . $this->db->escape_str($item_code) . "' LIMIT 1")->row();
        if ($item) {
            return intval($item->id);
        }

        if (is_numeric($item_code)) {
            return intval($item_code);
        }

        return 0;
    }
}
