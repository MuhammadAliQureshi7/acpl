<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Client chart-of-accounts import compatibility.
 *
 * The client's own import file uses its own vocabulary:
 *   - "Type" column  = name of the PARENT account the row belongs to
 *                      (or the dash "—" for top-level section accounts)
 *   - "Sub Type" column = generic class only (Asset, Liability, Equity,
 *                      Revenue, Expense, Contra Asset, ...)
 *
 * The module import instead requires a native account type + detail type
 * per row (names must match Accounting_model::get_account_types() and
 * get_account_type_details()). Statements only group native types 1-15.
 *
 * So instead of forcing the client to use our template, we translate their
 * rows on import:
 *   - account code lookup table -> exact native type/detail pair
 *   - unknown new codes        -> sensible default pair for their generic
 *                                 "Sub Type" class
 *   - their "Type" column      -> used as the parent account (hierarchy)
 */

/**
 * Account code -> [native account type name, native detail type name].
 *
 * Codes/names follow the client's own chart (same codes used in
 * Import_account_error_* files); pairs were validated against the module
 * built-in lists (types 1-15).
 */
function acc_client_import_get_code_map()
{
    return [
        '1000' => ['Current assets', 'Other current assets'],                  // ASSETS
        '1100' => ['Current assets', 'Other current assets'],                  // Current Assets
        '1110' => ['Cash and cash equivalents', 'Cash on hand'],               // Cash in Hand
        '1120' => ['Cash and cash equivalents', 'Cash on hand'],               // Petty Cash
        '1130' => ['Cash and cash equivalents', 'Bank'],                       // Cash at Bank
        '1131' => ['Cash and cash equivalents', 'Bank'],                       // Bank Account - 1
        '1132' => ['Cash and cash equivalents', 'Bank'],                       // Bank Account - 2
        '1140' => ['Accounts Receivable (A/R)', 'Accounts Receivable (A/R)'],  // Accounts Receivable
        '1150' => ['Current assets', 'Other current assets'],                  // Advance to Suppliers
        '1160' => ['Current assets', 'Employee Cash Advances'],                // Employee Advances
        '1170' => ['Current assets', 'Prepaid Expenses'],                      // Prepaid Expenses
        '1180' => ['Current assets', 'Inventory'],                             // Inventory
        '1190' => ['Current assets', 'Other current assets'],                  // Input Sales Tax / GST
        '1200' => ['Non-current assets', 'Other non-current assets'],          // Non-Current Assets
        '1230' => ['Fixed assets', 'Furniture and Fixtures'],                  // Furniture & Fixtures
        '1240' => ['Fixed assets', 'Machinery and equipment'],                 // Office Equipment
        '1250' => ['Fixed assets', 'Other fixed assets'],                      // Computers & IT Equipment
        '1260' => ['Fixed assets', 'Vehicles'],                                // Vehicles
        '1290' => ['Fixed assets', 'Accumulated depreciation on property, plant and equipment'], // Accumulated Depreciation
        '1292' => ['Fixed assets', 'Accumulated depreciation on property, plant and equipment'], // Accumulated Depreciation - Equipment
        '1293' => ['Fixed assets', 'Accumulated depreciation on property, plant and equipment'], // Accumulated Depreciation - Vehicles
        '1300' => ['Non-current assets', 'Long-term investments'],             // Long-Term Investments
        '1310' => ['Non-current assets', 'Security Deposits'],                 // Security Deposits
        '2000' => ['Current liabilities', 'Other current liabilities'],        // LIABILITIES
        '2100' => ['Current liabilities', 'Other current liabilities'],        // Current Liabilities
        '2110' => ['Accounts Payable (A/P)', 'Accounts Payable (A/P)'],        // Accounts Payable
        '2120' => ['Current liabilities', 'Accrued liabilities'],              // Accrued Expenses
        '2130' => ['Current liabilities', 'Payroll liabilities'],              // Salaries Payable
        '2140' => ['Current liabilities', 'Current Tax Liability'],            // Taxes Payable
        '2141' => ['Current liabilities', 'Sales and service tax payable'],    // Sales Tax / GST Payable
        '2142' => ['Current liabilities', 'Current Tax Liability'],            // Withholding Tax Payable
        '2150' => ['Current liabilities', 'Other current liabilities'],        // Customer Advances
        '2160' => ['Current liabilities', 'Loan Payable'],                     // Short-Term Loan
        '2200' => ['Non-current liabilities', 'Other non-current liabilities'],// Non-Current Liabilities
        '2210' => ['Non-current liabilities', 'Long-term debt'],               // Long-Term Bank Loan
        '2220' => ['Non-current liabilities', 'Other non-current liabilities'],// Lease Liability
        '2230' => ['Non-current liabilities', 'Other non-current liabilities'],// Other Long-Term Liabilities
        '3000' => ["Owner's Equity", "Owner's Equity"],                        // EQUITY
        '3100' => ["Owner's Equity", 'Share capital'],                         // Owner's / Share Capital
        '3110' => ["Owner's Equity", 'Partner Contributions'],                 // Partner / Owner Capital
        '3120' => ["Owner's Equity", 'Paid-in capital or surplus'],            // Additional Capital
        '3200' => ["Owner's Equity", 'Retained Earnings'],                     // Retained Earnings
        '3300' => ["Owner's Equity", 'Retained Earnings'],                     // Current Year Profit / Loss
        '3400' => ["Owner's Equity", 'Partner Distributions'],                 // Drawings / Dividends
        '4000' => ['Income', 'Revenue - General'],                             // REVENUE
        '4100' => ['Income', 'Revenue - General'],                             // Sales Revenue
        '4110' => ['Income', 'Revenue - General'],                             // Local Sales
        '4120' => ['Income', 'Revenue - General'],                             // Export Sales
        '4130' => ['Income', 'Service/Fee Income'],                            // Service Revenue
        '4150' => ['Income', 'Other Primary Income'],                          // Other Operating Revenue
        '4200' => ['Income', 'Discounts/Refunds Given'],                       // Sales Returns & Allowances
        '4300' => ['Other income', 'Other Miscellaneous Income'],              // Other Income
        '4310' => ['Other income', 'Interest earned'],                         // Interest Income
        '4320' => ['Other income', 'Other Miscellaneous Income'],              // Gain on Sale of Assets
        '4330' => ['Other income', 'Other Miscellaneous Income'],              // Exchange Gain
        '5000' => ['Cost of sales', 'Other costs of sales - COS'],             // COST OF SALES / COGS
        '5100' => ['Cost of sales', 'Other costs of sales - COS'],             // Cost of Goods Sold
        '5140' => ['Cost of sales', 'Freight and delivery - COS'],             // Freight / Carriage Inward
        '5150' => ['Cost of sales', 'Other costs of sales - COS'],             // Purchase Expense
        '5200' => ['Cost of sales', 'Other costs of sales - COS'],             // Purchase Returns
        '6000' => ['Expenses', 'Office/General Administrative Expenses'],      // OPERATING EXPENSES
        '6100' => ['Expenses', 'Other selling expenses'],                      // Selling & Distribution Expenses
        '6110' => ['Expenses', 'Advertising/Promotional'],                     // Advertising Expense
        '6120' => ['Expenses', 'Advertising/Promotional'],                     // Marketing Expense
        '6130' => ['Expenses', 'Commissions and fees'],                        // Sales Commission
        '6140' => ['Expenses', 'Shipping and delivery expense'],               // Delivery Expense
        '6150' => ['Expenses', 'Shipping and delivery expense'],               // Freight / Carriage Outward
        '6200' => ['Expenses', 'Office/General Administrative Expenses'],      // Administrative Expenses
        '6210' => ['Expenses', 'Payroll Expenses'],                            // Salaries & Wages
        '6220' => ['Expenses', 'Rent or Lease of Buildings'],                  // Rent Expense
        '6230' => ['Expenses', 'Utilities'],                                   // Electricity Expense
        '6240' => ['Expenses', 'Utilities'],                                   // Gas Expense
        '6250' => ['Expenses', 'Utilities'],                                   // Water Expense
        '6260' => ['Expenses', 'Utilities'],                                   // Telephone Expense
        '6270' => ['Expenses', 'Utilities'],                                   // Internet Expense
        '6280' => ['Expenses', 'Supplies and materials'],                      // Office Supplies
        '6290' => ['Expenses', 'Office/General Administrative Expenses'],      // Printing & Stationery
        '6300' => ['Expenses', 'Repair and maintenance'],                      // Repairs & Maintenance
        '6310' => ['Expenses', 'Auto'],                                        // Vehicle Maintenance
        '6400' => ['Expenses', 'Legal and professional fees'],                 // Professional Expenses
        '6410' => ['Expenses', 'Legal and professional fees'],                 // Audit Fee
        '6420' => ['Expenses', 'Legal and professional fees'],                 // Legal Fee
        '6430' => ['Expenses', 'Legal and professional fees'],                 // Consultancy Fee
        '6500' => ['Other Expense', 'Depreciation'],                           // Depreciation & Amortization
        '6510' => ['Other Expense', 'Depreciation'],                           // Depreciation - Building
        '6520' => ['Other Expense', 'Depreciation'],                           // Depreciation - Equipment
        '6530' => ['Other Expense', 'Depreciation'],                           // Depreciation - Vehicles
        '6600' => ['Expenses', 'Insurance'],                                   // Insurance Expense
        '6700' => ['Expenses', 'Travel expenses - general and admin expenses'],// Travel & Conveyance
        '6710' => ['Expenses', 'Travel expenses - general and admin expenses'],// Local Conveyance
        '6720' => ['Expenses', 'Travel expenses - general and admin expenses'],// Travelling Expense
        '6800' => ['Expenses', 'Finance costs'],                               // Bank & Financial Charges
        '6810' => ['Expenses', 'Bank charges'],                                // Bank Charges
        '6820' => ['Expenses', 'Interest paid'],                               // Interest Expense
        '6900' => ['Expenses', 'Other Miscellaneous Service Cost'],            // Other Operating Expenses
        '6910' => ['Expenses', 'Bad debts'],                                   // Bad Debt Expense
        '6920' => ['Other Expense', 'Exchange Gain or Loss'],                  // Exchange Loss
        '6930' => ['Expenses', 'Other Miscellaneous Service Cost'],            // Miscellaneous Expense
        '7000' => ['Other Expense', 'Other Expense'],                          // TAX EXPENSE
        '7100' => ['Other Expense', 'Other Expense'],                          // Income Tax Expense
        '7200' => ['Other Expense', 'Other Expense'],                          // Deferred Tax Expense
    ];
}

/**
 * Defaults for NEW accounts the client adds later with the same generic
 * "Sub Type" vocabulary (no code in the map). Type/detail are native.
 */
function acc_client_import_get_subtype_defaults()
{
    return [
        'Asset'           => ['Current assets', 'Other current assets'],
        'Contra Asset'    => ['Current assets', 'Allowance for bad debts'],
        'Liability'       => ['Current liabilities', 'Other current liabilities'],
        'Equity'          => ["Owner's Equity", "Owner's Equity"],
        'Contra Equity'   => ["Owner's Equity", 'Partner Distributions'],
        'Revenue'         => ['Income', 'Revenue - General'],
        'Contra Revenue'  => ['Income', 'Discounts/Refunds Given'],
        'Expense'         => ['Expenses', 'Office/General Administrative Expenses'],
        'Contra Expense'  => ['Expenses', 'Office/General Administrative Expenses'],
    ];
}

/**
 * Normalize an account name for fuzzy comparison: lowercase, keep only
 * letters/digits, collapse whitespace.
 */
function acc_client_import_normalize_name($name)
{
    $s = strtolower(trim((string)$name));
    $s = str_replace('&', ' ', $s);
    $s = preg_replace('/[^a-z0-9]+/', ' ', $s);

    return trim(preg_replace('/\s+/', ' ', $s));
}

/**
 * Find the real account name inside the imported file that the client's
 * "Type" value refers to. Exact match first, then a tolerant comparison so
 * small differences in their own file (e.g. "Bank & Finance Charges" vs
 * "Bank & Financial Charges") do not reject the whole import.
 *
 * @param string $parent             client's Type cell value
 * @param array  $file_account_names file account name => row index
 * @return string|false matched account name from the file, or false
 */
function acc_client_import_find_file_parent($parent, $file_account_names)
{
    $parent = trim((string)$parent);
    if ($parent === '') {
        return false;
    }
    if (isset($file_account_names[$parent])) {
        return $parent;
    }

    $parent_norm = acc_client_import_normalize_name($parent);
    if ($parent_norm === '') {
        return false;
    }

    foreach ($file_account_names as $name => $idx) {
        $name_norm = acc_client_import_normalize_name($name);
        if ($name_norm === '') {
            continue;
        }
        if ($name_norm === $parent_norm) {
            return $name;
        }
        if (levenshtein($name_norm, $parent_norm) <= 4) {
            return $name;
        }
    }

    return false;
}
