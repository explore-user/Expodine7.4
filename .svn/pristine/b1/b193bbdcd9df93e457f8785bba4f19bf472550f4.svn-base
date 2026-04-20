-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 26, 2025 at 09:05 AM
-- Server version: 8.0.43-0ubuntu0.22.04.1
-- PHP Version: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cloudtestdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_accounthead`
--

CREATE TABLE `tbl_accounthead` (
  `branchid` int NOT NULL,
  `ac_accountid` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ac_accountname` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ac_status` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account_stock`
--

CREATE TABLE `tbl_account_stock` (
  `branchid` int NOT NULL,
  `tas_id` int NOT NULL,
  `tas_date` date NOT NULL,
  `tas_open_stock_value` decimal(15,3) DEFAULT NULL,
  `tas_close_stock_value` decimal(15,3) DEFAULT NULL,
  `tas_login` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_appmachinedetails`
--

CREATE TABLE `tbl_appmachinedetails` (
  `branchid` int NOT NULL,
  `as_appmachineid` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `as_appmachiesych` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `as_appmachiesychid` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `as_status` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Active',
  `as_lastupdated` datetime DEFAULT NULL,
  `as_cur_ver` int DEFAULT NULL,
  `as_new_ver` int DEFAULT NULL,
  `as_update_found` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `as_em_lastupdated` datetime DEFAULT NULL,
  `as_em_cur_ver` int DEFAULT '0',
  `as_em_new_ver` int DEFAULT NULL,
  `as_em_update_found` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `as_enable_cash_drawer` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `as_cash_drawer_ip` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `as_cash_drawer_port` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `as_cash_drawer_usb` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `as_sync_floormaster` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `as_sync_kotcounter` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `as_sync_prefemaster` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `as_sync_menumaincat` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `as_sync_menusubcat` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `as_sync_portionmas` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `as_sync_menumaster` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `as_sync_menuprefemaster` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `as_sync_menuratemaster` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `as_sync_counterrate` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `as_sync_menustock` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `as_sync_menuimage` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `as_sync_menucombination` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `as_sync_nutrition` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `as_sync_ingredient` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_asset_purchase_invoice_detail`
--

CREATE TABLE `tbl_asset_purchase_invoice_detail` (
  `branchid` int DEFAULT NULL,
  `tpd_id` int DEFAULT NULL,
  `tpd_invoice` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tpd_vendor` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tpd_date` date DEFAULT NULL,
  `tpd_subtotal` decimal(15,3) DEFAULT NULL,
  `tpd_tax_total` decimal(15,3) DEFAULT NULL,
  `tpd_netamount` decimal(15,3) DEFAULT NULL,
  `tpd_from_acc` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tpd_paid_amount` decimal(15,3) DEFAULT NULL,
  `tpd_credit_amount` decimal(15,3) DEFAULT NULL,
  `tpd_trn_detail` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tpd_remarks` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tpd_entry_date` date DEFAULT NULL,
  `tpd_type_pay` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tpd_discount` decimal(15,3) DEFAULT NULL,
  `tpd_to_acc` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bankmaster`
--

CREATE TABLE `tbl_bankmaster` (
  `branchid` int NOT NULL,
  `bm_id` int NOT NULL,
  `bm_name` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `bm_active` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `bm_account` int DEFAULT NULL,
  `bm_lukado` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_base_unit_master`
--

CREATE TABLE `tbl_base_unit_master` (
  `branchid` int NOT NULL,
  `bu_id` int NOT NULL,
  `bu_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `bu_is_central` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_billdetails`
--

CREATE TABLE `tbl_billdetails` (
  `branchid` int NOT NULL,
  `billno` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `billslno` smallint NOT NULL,
  `bill_addon_slno` int DEFAULT NULL,
  `menuid` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `rate_type` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'Portion',
  `unit_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `portion` int DEFAULT NULL,
  `unit_weight` decimal(15,3) DEFAULT '0.000',
  `unit_id` int DEFAULT NULL,
  `base_unit_id` int DEFAULT NULL,
  `base_rate` decimal(15,3) DEFAULT '0.000',
  `org_rate` decimal(15,3) DEFAULT '0.000',
  `discount` decimal(15,3) DEFAULT '0.000',
  `rate` decimal(15,3) DEFAULT '0.000',
  `qty` int DEFAULT NULL,
  `amount` decimal(15,3) DEFAULT '0.000',
  `tax_total` decimal(15,3) DEFAULT '0.000',
  `taxable_amount` decimal(15,3) DEFAULT '0.000',
  `type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `symbol_for_tax` char(3) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'Y',
  `status` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `packedtime` datetime DEFAULT NULL,
  `preferencetext` varchar(300) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `dayclose_new` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_billmaster`
--

CREATE TABLE `tbl_billmaster` (
  `branchid` int NOT NULL,
  `billno` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `billmode` char(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'DI',
  `billdate` date DEFAULT NULL,
  `billtime` time DEFAULT NULL,
  `orderno` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `totalpax` int DEFAULT '0',
  `floorid` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `subtotal` decimal(15,3) DEFAULT '0.000',
  `subtotal_final` decimal(15,3) DEFAULT '0.000',
  `discountid` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `discountvalue` decimal(15,3) DEFAULT '0.000',
  `tax_exempt` decimal(15,3) DEFAULT '0.000',
  `taxable_amount` decimal(15,3) DEFAULT '0.000',
  `total` decimal(15,3) DEFAULT '0.000',
  `roundoff_value` decimal(15,3) DEFAULT '0.000',
  `finaltotal` decimal(15,3) DEFAULT '0.000',
  `corporatecode` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `paymode` int DEFAULT NULL,
  `credit` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'N',
  `room_credit` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'N',
  `creditmasterid` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `complimentary` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'N',
  `complimentaryremark` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `amountbalace` decimal(15,3) DEFAULT '0.000',
  `transactionamount` decimal(15,3) DEFAULT '0.000',
  `amountpaid` decimal(15,3) DEFAULT '0.000',
  `upi_amount` decimal(15,3) DEFAULT '0.000',
  `upi_txn_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `transcbank` int DEFAULT NULL,
  `voucherid` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `couponcompany` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `couponamt` decimal(15,3) DEFAULT '0.000',
  `chequeno` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `chequebankname` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `chequebankamount` decimal(15,3) DEFAULT '0.000',
  `dayclosedatedate` date DEFAULT NULL,
  `billprinted` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'N',
  `lastprintime` datetime DEFAULT NULL,
  `status` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'Billed',
  `tableno` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `discountlabel` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `bill_is_split` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'N',
  `bill_no_of_split` int DEFAULT NULL,
  `compl_mgmt_staff` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `can_regenerate` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'Y',
  `cancelledby_careof` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cancelledreason` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cancelledsecretkey` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cancelledlogin` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cancelled_date_time` datetime DEFAULT NULL,
  `bill_ref` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `settlement_login` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `comments` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `steward` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `creditremark` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cname` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cnumber` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `gst` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `upi_requestid` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `qrcode_mode` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `settlement_time` datetime DEFAULT NULL,
  `bill_gen_login` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `payment_settled` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'N',
  `kotno` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `loginid` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `hd` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'N',
  `hdcustomerid` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `assignedto` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `delivery_status` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `esttime` datetime DEFAULT NULL,
  `assignedtime` datetime DEFAULT NULL,
  `cancelled` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'N',
  `customerstatus` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'N',
  `staffstatus` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'N',
  `bill_reorder` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cancelamount` decimal(15,3) DEFAULT '0.000',
  `discount_mode` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `discount_of` decimal(15,3) DEFAULT '0.000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bill_card_payments`
--

CREATE TABLE `tbl_bill_card_payments` (
  `branchid` int NOT NULL,
  `mc_id` int NOT NULL,
  `mc_billno` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `mc_slno` smallint NOT NULL,
  `mc_cardtype` int DEFAULT NULL,
  `mc_cardamount` decimal(15,3) NOT NULL,
  `mc_carnumber` char(4) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mc_to_bank` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bill_item_discount`
--

CREATE TABLE `tbl_bill_item_discount` (
  `branchid` int NOT NULL,
  `billno` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `billslno` smallint NOT NULL,
  `discount_id` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `discount_of` decimal(8,3) DEFAULT NULL,
  `menuid` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mode` char(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `discount_remarks` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `discount` decimal(15,3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bill_item_tax_details`
--

CREATE TABLE `tbl_bill_item_tax_details` (
  `branchid` int NOT NULL,
  `billno` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `billslno` smallint NOT NULL,
  `tax_id` int NOT NULL,
  `menuid` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tax_value` decimal(8,3) NOT NULL DEFAULT '0.000',
  `tax_amount` decimal(15,3) DEFAULT '0.000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bill_tax`
--

CREATE TABLE `tbl_bill_tax` (
  `branchid` int NOT NULL,
  `billno` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `taxid` int NOT NULL,
  `total_value` decimal(15,3) DEFAULT NULL,
  `label` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_br_cloud_tables`
--

CREATE TABLE `tbl_br_cloud_tables` (
  `branchid` int DEFAULT NULL,
  `id` int DEFAULT NULL,
  `table_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `status` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cancellation_reasons`
--

CREATE TABLE `tbl_cancellation_reasons` (
  `branchid` int NOT NULL,
  `cr_id` int NOT NULL DEFAULT '1',
  `cr_reason` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `cr_active` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cardmaster`
--

CREATE TABLE `tbl_cardmaster` (
  `branchid` int NOT NULL,
  `crd_id` int NOT NULL,
  `crd_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `crd_active` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `crd_imageurl` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_central_kitchen_transfer`
--

CREATE TABLE `tbl_central_kitchen_transfer` (
  `branchid` int NOT NULL,
  `tct_id` int NOT NULL,
  `tct_central_id` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tct_product` int DEFAULT NULL,
  `tct_rate_type` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tct_unit_type` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tct_qty` decimal(15,3) DEFAULT NULL,
  `tct_weight` decimal(15,3) DEFAULT NULL,
  `tct_rate` decimal(15,3) DEFAULT NULL,
  `tct_total` decimal(15,3) DEFAULT NULL,
  `tct_tax` decimal(15,3) DEFAULT NULL,
  `tct_total_tax` decimal(15,3) DEFAULT NULL,
  `tct_final_total` decimal(15,3) DEFAULT NULL,
  `tct_date` datetime DEFAULT NULL,
  `tct_login` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tct_local_branch` int DEFAULT NULL,
  `tct_local_store` int DEFAULT NULL,
  `tct_to_branch` int DEFAULT NULL,
  `tct_to_store` int DEFAULT NULL,
  `tct_set` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tct_barcode` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tct_brand` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tct_current_stock` decimal(15,3) DEFAULT NULL,
  `tct_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tct_mode` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tct_received` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tct_receive_time` datetime DEFAULT NULL,
  `tct_receive_login` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tct_status_live` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tct_cancel_time` datetime DEFAULT NULL,
  `tc_cancel_login` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tc_receieved_id` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tct_central_menu_id` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tct_reject_update` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tct_reject_reason` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tct_edit_value` decimal(15,3) DEFAULT NULL,
  `tct_edited_by` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tct_edited_stage` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tct_edited_time` datetime DEFAULT NULL,
  `tct_from_store_name` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tct_to_store_name` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tct_from_branch_name` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tct_to_branch_name` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tct_live_id` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tct_live_or_local` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tct_option` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_city_master`
--

CREATE TABLE `tbl_city_master` (
  `id` int NOT NULL,
  `city_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `state_id` int NOT NULL,
  `branchid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cloud_consumption`
--

CREATE TABLE `tbl_cloud_consumption` (
  `tcc_id` int NOT NULL,
  `tcc_con_id` int NOT NULL,
  `tcc_con_no` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tcc_product` int NOT NULL,
  `tcc_prod_central_id` int DEFAULT NULL,
  `tcc_product_name` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tcc_brand` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tcc_barcode` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tcc_rate_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tcc_unit_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tcc_weight` decimal(15,3) NOT NULL,
  `tcc_quantity` int NOT NULL,
  `tcc_balance` decimal(15,3) NOT NULL,
  `tcc_current_stock` decimal(15,3) NOT NULL,
  `tcc_unit_rate` decimal(15,3) NOT NULL,
  `tcc_total` decimal(15,3) NOT NULL,
  `tcc_branch` int NOT NULL,
  `tcc_store` int NOT NULL,
  `tcc_created_by` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tcc_created_date` datetime NOT NULL,
  `tcc_confirm` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tcc_log_branch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cloud_grn_order`
--

CREATE TABLE `tbl_cloud_grn_order` (
  `grn_id` int NOT NULL,
  `grn_no` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `grn_no_id` int DEFAULT NULL,
  `grn_item_id` int NOT NULL,
  `grn_item_central_id` int DEFAULT NULL,
  `grn_item_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `grn_barcode` varchar(155) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `grn_brand` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `grn_quantity` int DEFAULT NULL,
  `grn_weight` decimal(15,3) DEFAULT NULL,
  `grn_rate_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `grn_unit_type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `grn_unit_rate` float(15,3) NOT NULL,
  `grn_total_rate` float(15,3) NOT NULL,
  `grn_tax_percnt` decimal(15,3) DEFAULT NULL,
  `grn_tax_rate` decimal(15,3) DEFAULT NULL,
  `grn_final_rate` decimal(15,3) NOT NULL,
  `grn_exp_date` date DEFAULT NULL,
  `grn_reorder` int DEFAULT NULL,
  `grn_created` varchar(225) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `grn_confirm` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `grn_purchase_date` date DEFAULT NULL,
  `grn_branch` int DEFAULT NULL,
  `grn_store` int DEFAULT NULL,
  `grn_supplier` int DEFAULT NULL,
  `grn_invoice` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `grn_pur_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cloud_grn_summery`
--

CREATE TABLE `tbl_cloud_grn_summery` (
  `sm_grn_id` int NOT NULL,
  `sm_grn_no` varchar(155) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `sm_grn_date` datetime NOT NULL,
  `sm_grn_branch` int NOT NULL,
  `sm_grn_store` int NOT NULL,
  `sm_grn_supplier` int NOT NULL,
  `sm_grn_purchase_date` date DEFAULT NULL,
  `sm_grn_invoice_no` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `sm_grn_final_total` float(13,2) NOT NULL,
  `sm_grn_tax_perc` decimal(15,3) DEFAULT NULL,
  `sm_grn_tax_amount` decimal(15,3) DEFAULT NULL,
  `sm_grn_grand_total` decimal(15,3) NOT NULL,
  `sm_grn_adjustment` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `sm_grn_total_transit` float(10,3) NOT NULL DEFAULT '0.000',
  `sm_grn_submitted` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `sm_status` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `sm_status_datetime` datetime DEFAULT NULL,
  `sm_grn_status_updated_by` varchar(225) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `sm_grn_pur_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cloud_menu_data`
--

CREATE TABLE `tbl_cloud_menu_data` (
  `branchid` int NOT NULL,
  `tm_id` int NOT NULL,
  `tm_menu_id` int NOT NULL,
  `tm_menu_name` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tm_status` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tm_mmr_id` int DEFAULT NULL,
  `tm_mode` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tm_rate` decimal(15,3) DEFAULT NULL,
  `tm_maincat` int DEFAULT NULL,
  `tm_subcat` int DEFAULT NULL,
  `tm_kot` int DEFAULT NULL,
  `tm_desc` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tm_dynamic` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tm_method` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tm_type` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tm_area_id` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tm_portion` int DEFAULT NULL,
  `tm_unit_type` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tm_unit_wt` decimal(15,5) DEFAULT NULL,
  `tm_unit_id` int DEFAULT NULL,
  `tm_base_unit` int DEFAULT NULL,
  `tm_code` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tm_central_id` int DEFAULT NULL,
  `tm_central_menu` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `tm_new_menu` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `tm_copy_from` int DEFAULT NULL,
  `tm_raw_barcode` varchar(225) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tm_item_type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tm_inv_store` int DEFAULT NULL,
  `tm_entry_time` date DEFAULT NULL,
  `tm_local_updated` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cloud_menu_detail`
--

CREATE TABLE `tbl_cloud_menu_detail` (
  `branchid` int NOT NULL,
  `tcd_menu_count` int NOT NULL,
  `tcd_cloudmenu_count` int NOT NULL DEFAULT '0',
  `tcd_order_count` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tcd_qr_enable` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `tcd_map` varchar(2500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tcd_staff_count` int DEFAULT NULL,
  `tcd_disc_count` int DEFAULT NULL,
  `tcd_accounts_start_date` date DEFAULT NULL,
  `tcd_arabic_bill` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `be_others2` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `be_others3` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `be_others4` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `be_footer2` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `be_footer3` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `be_phone` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `be_printall` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `updation_status` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `be_dbbackuplocation` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `dynamic_invoice_name` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `di_roundoff` decimal(15,2) NOT NULL DEFAULT '0.00',
  `di_table_sharing` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `di_discount` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `di_duplicate` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `ta_roundoff` decimal(15,2) NOT NULL DEFAULT '0.00',
  `ta_hold` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `ta_discount` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `ta_duplicate` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `ta_bill_print` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `ta_bill_before` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `ta_kot_before` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `ta_kot_after` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `hd_charge` decimal(15,2) NOT NULL DEFAULT '0.00',
  `cs_roundoff` decimal(15,2) NOT NULL DEFAULT '0.00',
  `cs_hold` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `cs_discount` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `cs_duplicate` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `cs_bill_print` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `cs_bill_before` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `cs_kot_before` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `cs_kot_after` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `kot_footer_msg` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `kot_other_lang` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `kot_cancel_print` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `kot_cons_print` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `kot_ip_lock` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `kot_cons_ip_lock` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `kot_font_size` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `kot_cons_customer` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `kod_di` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `kod_ta` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `kod_option` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `bill_logo` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `bill_lang` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `bill_iplock` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `bill_without_print` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `bill_long_name` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `bill_font` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `otp_item_cancel` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `otp_bill_cancel` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `otp_mail` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `dayclose_mail` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `dayclose_print` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `dayclose_mail_list` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_on` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `cloud_notify` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `cloud_br` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_gr` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mail_from` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mail_psw` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `adm_timezone` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `adm_archive` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `adm_floot_table_change` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `adm_uae_format` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `adm_uae_value` decimal(15,2) DEFAULT NULL,
  `adm_sa_format` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `adm_disc_settle` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `adm_accounts` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `adm_staffwise_reduction` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `adm_invnentory` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `adm_sales_reduction` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `adm_online_order` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cloud_physical_stock`
--

CREATE TABLE `tbl_cloud_physical_stock` (
  `tcps_id` int NOT NULL,
  `tcps_phy_id` int NOT NULL,
  `tcps_phy_no` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tcps_product` int NOT NULL,
  `tcps_prod_central_id` int DEFAULT NULL,
  `tcps_product_name` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tcps_brand` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tcps_barcode` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tcps_rate_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tcps_unit_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tcps_weight` decimal(15,3) NOT NULL,
  `tcps_quantity` int NOT NULL,
  `tcps_old_weight` decimal(15,3) DEFAULT NULL,
  `tcps_old_quantity` int DEFAULT NULL,
  `tcps_unit_rate` decimal(15,3) DEFAULT NULL,
  `tcps_total` decimal(15,3) DEFAULT NULL,
  `tcps_branch` int NOT NULL,
  `tcps_store` int NOT NULL,
  `tcps_created_by` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tcps_created_date` datetime DEFAULT NULL,
  `tcps_confirm` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `tcps_approved` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `tcps_approved_by` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tcps_approved_date` datetime DEFAULT NULL,
  `tcps_log_branch` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cloud_purchase_order`
--

CREATE TABLE `tbl_cloud_purchase_order` (
  `tcp_id` int NOT NULL,
  `tcp_pur_id` int DEFAULT NULL,
  `tcp_pur_no` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tcp_product` int NOT NULL,
  `tcp_prod_central_id` int DEFAULT NULL,
  `tcp_product_name` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tcp_brand` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tcp_rate_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tcp_unit_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tcp_weight` decimal(15,3) DEFAULT NULL,
  `tcp_quantity` int DEFAULT NULL,
  `tcp_supplier` int DEFAULT NULL,
  `tcp_store` int DEFAULT NULL,
  `tcp_log_branch` int DEFAULT NULL,
  `tcp_puchase_branch` int DEFAULT NULL,
  `tcp_created` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tcp_created_date` datetime NOT NULL,
  `tcp_status` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tcp_status_updated` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tcp_status_updated_date` datetime DEFAULT NULL,
  `tcp_submitted_by` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tcp_submitted_date` datetime DEFAULT NULL,
  `tcp_barcode` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tcp_confirm` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `tcp_req_id` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cloud_purchase_return`
--

CREATE TABLE `tbl_cloud_purchase_return` (
  `tcpr_id` int NOT NULL,
  `tcpr_return_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tcpr_return_no` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tcpr_store` int DEFAULT NULL,
  `tcpr_supplier` int DEFAULT NULL,
  `tcpr_product` int DEFAULT NULL,
  `tcpr_product_name` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tcpr_rate_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tcpr_unit_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tcpr_quantity` int DEFAULT NULL,
  `tcpr_weight` decimal(15,3) DEFAULT NULL,
  `tcpr_unit_rate` decimal(15,3) DEFAULT NULL,
  `tcpr_total_rate` decimal(15,3) DEFAULT NULL,
  `tcpr_tax_percent` decimal(15,3) DEFAULT NULL,
  `tcpr_tax_rate` decimal(15,3) DEFAULT NULL,
  `tcpr_final_rate` decimal(15,3) DEFAULT NULL,
  `tcpr_return_date` datetime DEFAULT NULL,
  `tcpr_return_by` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tcpr_grn_no` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tcpr_branch` int DEFAULT NULL,
  `tcpr_confirm` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'N',
  `tcpr_confirmed_by` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tcpr_confirm_date` datetime DEFAULT NULL,
  `tcpr_remarks` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cloud_requisition`
--

CREATE TABLE `tbl_cloud_requisition` (
  `tcr_id` int NOT NULL,
  `tcr_req_id` int NOT NULL,
  `tcr_req_no` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tcr_product` int NOT NULL,
  `tcr_prod_central_id` int DEFAULT NULL,
  `tcr_product_name` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tcr_rate_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tcr_created_date` datetime NOT NULL,
  `tcr_barcode` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tcr_unit_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tcr_weight` decimal(15,3) DEFAULT NULL,
  `tcr_quantity` int DEFAULT NULL,
  `tcr_brand` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tcr_confirm` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `tcr_log_branch` int DEFAULT NULL,
  `tcr_puchase_branch` int DEFAULT NULL,
  `tcr_created` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tcr_status` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tcr_status_updated` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tcr_status_updated_date` datetime DEFAULT NULL,
  `tcr_store` int DEFAULT NULL,
  `tcr_submitted_by` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tcr_submitted_date` datetime DEFAULT NULL,
  `tcr_intend_id` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cloud_store_stock`
--

CREATE TABLE `tbl_cloud_store_stock` (
  `tcs_id` int NOT NULL,
  `tcs_branchid` int DEFAULT NULL,
  `tcs_store` int DEFAULT NULL,
  `tcs_product` int NOT NULL,
  `tcs_prod_central_id` int NOT NULL,
  `tcs_product_name` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tcs_barcode` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tcs_unit_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tcs_rate_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tcs_quantity` int DEFAULT NULL,
  `tcs_weight` decimal(15,3) DEFAULT NULL,
  `tcs_unit_price` decimal(15,3) DEFAULT NULL,
  `tcs_avg_price` decimal(15,3) DEFAULT NULL,
  `tcs_total` decimal(15,3) DEFAULT NULL,
  `tcs_tax` decimal(15,3) DEFAULT NULL,
  `tcs_tax_amount` decimal(15,3) DEFAULT NULL,
  `tcs_expiry_date` date DEFAULT NULL,
  `tcs_reorder` int DEFAULT NULL,
  `tcs_last_grn` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tcs_last_stock_updated_date` datetime DEFAULT NULL,
  `tcs_last_stock_updated_by` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cloud_store_transfer`
--

CREATE TABLE `tbl_cloud_store_transfer` (
  `tct_id` int NOT NULL,
  `tct_trn_id` int NOT NULL,
  `tct_trn_no` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tct_product` int NOT NULL,
  `tct_prod_central_id` int NOT NULL,
  `tct_product_name` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tct_quantity` int DEFAULT '0',
  `tct_weight` decimal(15,3) DEFAULT NULL,
  `tct_qty_wgt` decimal(15,3) DEFAULT NULL,
  `tct_to_transfer` decimal(15,3) DEFAULT NULL,
  `tct_unit_rate` decimal(15,3) NOT NULL,
  `tct_brand` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tct_rate_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tct_unit_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tct_total_rate` decimal(15,3) DEFAULT NULL,
  `tct_barcode` varchar(155) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tct_current_stock` decimal(15,3) DEFAULT NULL,
  `tct_reorder` decimal(15,3) NOT NULL,
  `tct_from_branch` int DEFAULT NULL,
  `tct_from_store` int DEFAULT NULL,
  `tct_to_branch` int DEFAULT NULL,
  `tct_to_store` int DEFAULT NULL,
  `tct_created` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tct_created_date` datetime DEFAULT NULL,
  `tct_login_branch` int DEFAULT NULL,
  `tct_confirm` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'N',
  `tct_confirm_date` date DEFAULT NULL,
  `tct_tax_value` decimal(15,3) DEFAULT NULL,
  `tct_tax_rate` decimal(15,3) DEFAULT NULL,
  `tct_last_grn` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tct_last_expiry` date DEFAULT NULL,
  `tct_intent_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tct_local_accepted` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'N',
  `tct_local_accepted_date` datetime DEFAULT NULL,
  `tct_rejected` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `tct_cancel_time` datetime DEFAULT NULL,
  `tc_cancel_login` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tct_reject_reason` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tct_rejected_updated` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `tct_rejected_updated_on` datetime NOT NULL,
  `tct_partial_option` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tct_cancel_updated` varchar(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `tct_cancel_updated_on` datetime NOT NULL,
  `tct_option_remarks` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cloud_wastage`
--

CREATE TABLE `tbl_cloud_wastage` (
  `tcw_id` int NOT NULL,
  `tcw_was_id` int NOT NULL,
  `tcw_was_no` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tcw_product` int NOT NULL,
  `tcw_prod_central_id` int NOT NULL,
  `tcw_product_name` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tcw_brand` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tcw_barcode` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tcw_rate_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tcw_unit_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tcw_weight` decimal(15,3) NOT NULL,
  `tcw_quantity` int NOT NULL,
  `tcw_current_stock` decimal(15,3) NOT NULL,
  `tcw_unit_rate` decimal(15,3) NOT NULL,
  `tcw_total` decimal(15,3) NOT NULL,
  `tcw_reason` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tcw_branch` int NOT NULL,
  `tcw_store` int NOT NULL,
  `tcw_created_by` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tcw_created_date` datetime NOT NULL,
  `tcw_confirm` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tcw_log_branch` int NOT NULL,
  `tcw_from_local` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `tcw_remarks_local` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tcw_was_accepted_on` datetime NOT NULL,
  `tcw_was_accepted_branch` int DEFAULT NULL,
  `tcw_was_accepted_store` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_combo_bill_details`
--

CREATE TABLE `tbl_combo_bill_details` (
  `branchid` int NOT NULL,
  `cbd_billno` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `cbd_billslno` int NOT NULL,
  `cbd_count_combo_ordering` int DEFAULT NULL,
  `cbd_combo_id` int DEFAULT NULL,
  `cbd_combo_pack_id` int DEFAULT NULL,
  `cbd_combo_qty` int DEFAULT NULL,
  `cbd_combo_pack_rate` decimal(15,3) NOT NULL DEFAULT '0.000',
  `cbd_combo_total_rate` decimal(15,3) NOT NULL DEFAULT '0.000',
  `cbd_menu_id` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cbd_menu_qty` int DEFAULT NULL,
  `cbd_entry_date` datetime DEFAULT NULL,
  `cbd_dayclosedate` date DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_combo_bill_details_ta`
--

CREATE TABLE `tbl_combo_bill_details_ta` (
  `branchid` int NOT NULL,
  `cbd_id` int NOT NULL,
  `cbd_count_combo_ordering` int DEFAULT NULL,
  `cbd_billno` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cbd_combo_id` int DEFAULT NULL,
  `cbd_combo_pack_id` int DEFAULT NULL,
  `cbd_slno` int NOT NULL DEFAULT '1',
  `cbd_combo_qty` int DEFAULT NULL,
  `cbd_combo_pack_rate` decimal(15,3) NOT NULL DEFAULT '0.000',
  `cbd_combo_total_rate` decimal(15,3) NOT NULL DEFAULT '0.000',
  `cbd_menu_id` int DEFAULT NULL,
  `cbd_menu_qty` int DEFAULT NULL,
  `cbd_combo_preference` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cbd_entry_date` datetime DEFAULT NULL,
  `cbd_dayclosedate` date DEFAULT NULL,
  `cbd_order_status` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `cbd_kot_no` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cbd_cancel` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `cbd_regen_status` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_combo_menu_labels`
--

CREATE TABLE `tbl_combo_menu_labels` (
  `branchid` int NOT NULL,
  `cml_id` int NOT NULL,
  `cml_label` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cml_active` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_combo_name`
--

CREATE TABLE `tbl_combo_name` (
  `branchid` int DEFAULT NULL,
  `cn_id` int NOT NULL,
  `cn_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cn_type` int NOT NULL,
  `cn_active` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `cn_stock_check` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_combo_ordering_details`
--

CREATE TABLE `tbl_combo_ordering_details` (
  `branchid` int NOT NULL,
  `cod_id` int NOT NULL,
  `cod_count_combo_ordering` int DEFAULT NULL,
  `cod_orderno` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cod_combo_id` int DEFAULT NULL,
  `cod_combo_pack_id` int DEFAULT NULL,
  `cod_slno` int DEFAULT NULL,
  `cod_combo_qty` int DEFAULT NULL,
  `cod_combo_pack_rate` decimal(15,3) DEFAULT NULL,
  `cod_combo_total_rate` decimal(15,3) DEFAULT NULL,
  `cod_menu_id` int DEFAULT NULL,
  `cod_menu_qty` int DEFAULT NULL,
  `cod_combo_preference` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cod_entry_date` datetime DEFAULT NULL,
  `cod_dayclosedate` date DEFAULT NULL,
  `cod_order_status` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cod_kot_no` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cod_cancel` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_combo_packs`
--

CREATE TABLE `tbl_combo_packs` (
  `branchid` int DEFAULT NULL,
  `cp_id` int NOT NULL,
  `cp_pack_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cp_combo` int DEFAULT NULL,
  `cp_pack_qty` int DEFAULT '0',
  `cp_pack_active` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_combo_pack_menus`
--

CREATE TABLE `tbl_combo_pack_menus` (
  `branchid` int NOT NULL,
  `cpm_id` int NOT NULL,
  `cpm_menu_id` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cpm_combo_pack_id` int DEFAULT NULL,
  `cpm_combo_id` int DEFAULT NULL,
  `cpm_menu_sale_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cpm_menu_type_label_id` int DEFAULT NULL,
  `cpm_menu_qty` int DEFAULT NULL,
  `cpm_menu_active` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_combo_pack_rates`
--

CREATE TABLE `tbl_combo_pack_rates` (
  `branchid` int NOT NULL,
  `cpr_id` int NOT NULL,
  `cpr_combo_pack_id` int DEFAULT NULL,
  `cpr_combo_id` int DEFAULT NULL,
  `cpr_floor_id` int DEFAULT NULL,
  `cpr_mode` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cpr_rate` decimal(15,3) DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cpr_online_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_combo_stock`
--

CREATE TABLE `tbl_combo_stock` (
  `branchid` int NOT NULL,
  `cs_id` int NOT NULL,
  `cs_pack_id` int DEFAULT NULL,
  `cs_combo_id` int DEFAULT NULL,
  `cs_stock_number` int NOT NULL DEFAULT '0',
  `cs_stock_status` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `cs_stock_date` date DEFAULT NULL,
  `cs_last_updated` datetime DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_combo_type`
--

CREATE TABLE `tbl_combo_type` (
  `branchid` int NOT NULL,
  `ct_id` int NOT NULL,
  `ct_type` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complementory_reasons`
--

CREATE TABLE `tbl_complementory_reasons` (
  `branchid` int NOT NULL,
  `id` int NOT NULL,
  `cor_reason` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `cor_active` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_consumption`
--

CREATE TABLE `tbl_consumption` (
  `branchid` int NOT NULL,
  `tc_id` int NOT NULL,
  `tc_con_id` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tc_product` int DEFAULT NULL,
  `tc_name` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tc_barcode` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tc_qty` int DEFAULT NULL,
  `tc_weight` decimal(15,3) DEFAULT NULL,
  `tc_rate_type` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tc_unit_type` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tc_rate` decimal(15,3) DEFAULT NULL,
  `tc_total` decimal(15,3) DEFAULT NULL,
  `tc_set` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tc_date` date DEFAULT NULL,
  `tc_login` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tc_store` int DEFAULT NULL,
  `tc_brand` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tc_current_stock` decimal(15,3) DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tc_balance` decimal(15,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contra_voucher`
--

CREATE TABLE `tbl_contra_voucher` (
  `branchid` int NOT NULL,
  `cv_id` int NOT NULL,
  `cv_date` date DEFAULT NULL,
  `cv_from_acc` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cv_to_acc` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cv_amount` decimal(15,3) DEFAULT NULL,
  `cv_transaction_data` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cv_remarks` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cv_entry_date` date DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cv_cloud_added` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cv_cloud_edited` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_corporatemaster`
--

CREATE TABLE `tbl_corporatemaster` (
  `branchid` int NOT NULL,
  `ct_corporatecode` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ct_corporatename` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ct_status` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ct_online_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_country_master`
--

CREATE TABLE `tbl_country_master` (
  `id` int NOT NULL,
  `country_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `branchid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_couponcompany`
--

CREATE TABLE `tbl_couponcompany` (
  `branchid` int NOT NULL,
  `cy_coupid` int NOT NULL,
  `cy_companyname` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `cy_active` char(3) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Yes',
  `cy_startdate` date NOT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_credit_details`
--

CREATE TABLE `tbl_credit_details` (
  `branchid` int NOT NULL,
  `cd_slno` int NOT NULL,
  `cd_billno` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `cd_modeofentry` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cd_masterid` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `cd_amount` decimal(15,2) NOT NULL,
  `cd_dateofentry` datetime NOT NULL,
  `cd_settled` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `cd_dateofsettle` datetime DEFAULT NULL,
  `cd_dayclosedate` date DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_credit_details_payment`
--

CREATE TABLE `tbl_credit_details_payment` (
  `branchid` int NOT NULL,
  `cdp_master_id` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `cdp_dayclosedate` date NOT NULL,
  `cdp_slno` int NOT NULL,
  `cdp_paid_cash` decimal(15,3) NOT NULL DEFAULT '0.000',
  `cdp_transaction_amount` decimal(15,3) NOT NULL DEFAULT '0.000',
  `cdp_balance` decimal(15,3) NOT NULL DEFAULT '0.000',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `cdp_entry_time` datetime DEFAULT NULL,
  `cdp_login_id` int DEFAULT NULL,
  `cdp_bank` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_credit_master`
--

CREATE TABLE `tbl_credit_master` (
  `branchid` int NOT NULL,
  `crd_id` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `crd_type` int NOT NULL,
  `crd_branchid` bigint NOT NULL,
  `crd_totalamount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `crd_staffid` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `crd_roomid` int DEFAULT NULL,
  `crd_corporateid` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `crd_guestid` int DEFAULT NULL,
  `crd_active` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_credit_types`
--

CREATE TABLE `tbl_credit_types` (
  `branchid` int NOT NULL,
  `ct_creditid` int NOT NULL,
  `ct_credit_type` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ct_active` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `ct_labels` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_currency_conv_rate`
--

CREATE TABLE `tbl_currency_conv_rate` (
  `branchid` int NOT NULL,
  `cc_base_currency` int NOT NULL,
  `cc_currency` int NOT NULL,
  `cc_conversion_rate` decimal(15,6) NOT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_currency_master`
--

CREATE TABLE `tbl_currency_master` (
  `branchid` int NOT NULL,
  `c_id` int NOT NULL,
  `c_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `c_short_code` char(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `c_status` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Active',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_ebill_details`
--

CREATE TABLE `tbl_customer_ebill_details` (
  `branchid` int DEFAULT NULL,
  `tc_review` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tc_billno` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dayclose`
--

CREATE TABLE `tbl_dayclose` (
  `branchid` int NOT NULL,
  `dc_day` date NOT NULL,
  `dc_id` bigint NOT NULL,
  `dc_dateopen` date NOT NULL,
  `dc_timeopen` time NOT NULL,
  `dc_dateclose` date DEFAULT NULL,
  `dc_timeclose` time DEFAULT NULL,
  `dc_open_total_deno` decimal(15,2) NOT NULL DEFAULT '0.00',
  `dc_close_total_deno` decimal(15,2) NOT NULL DEFAULT '0.00',
  `dc_dayclose_sms_success` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `dc_dayclose_email_success` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `dc_last_sms_time` datetime DEFAULT NULL,
  `dc_last_email_time` datetime DEFAULT NULL,
  `dc_dayclose_sms_attempts` int NOT NULL DEFAULT '0',
  `dc_dayclose_email_attempts` int NOT NULL DEFAULT '0',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `dc_asset` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `dc_liab` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `dc_income` decimal(15,3) DEFAULT NULL,
  `dc_expense` decimal(15,3) DEFAULT NULL,
  `dc_profit` decimal(15,3) DEFAULT NULL,
  `dc_loss` decimal(15,3) DEFAULT NULL,
  `dc_closing_user` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `dc_closing_pc` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `dc_continue_sale` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `dc_monthy_send` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_delivery_status`
--

CREATE TABLE `tbl_delivery_status` (
  `branchid` int NOT NULL,
  `ds_id` int NOT NULL,
  `ds_name` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ds_short_code` varchar(3) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_denomination_master`
--

CREATE TABLE `tbl_denomination_master` (
  `branchid` int NOT NULL,
  `dm_id` int NOT NULL,
  `dm_denomination` varchar(11) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `dm_active` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `dm_display_order` int NOT NULL DEFAULT '1',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_departmentmaster`
--

CREATE TABLE `tbl_departmentmaster` (
  `branchid` int NOT NULL,
  `der_departmentid` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `der_departmentname` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `der_branch` bigint NOT NULL DEFAULT '1',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_designationmaster`
--

CREATE TABLE `tbl_designationmaster` (
  `branchid` int NOT NULL,
  `dr_designationid` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `dr_designationname` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `dr_branch` bigint NOT NULL DEFAULT '1',
  `dr_login` varchar(3) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Yes',
  `dr_takeorder` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `dr_authorisation_code` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_discountmaster`
--

CREATE TABLE `tbl_discountmaster` (
  `branchid` int NOT NULL,
  `ds_discountid` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ds_discountname` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ds_item_discount` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `ds_branchid` bigint NOT NULL,
  `ds_status` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Active',
  `ds_discountof` decimal(8,3) NOT NULL,
  `ds_mode` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'P',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ds_cloud_added` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ds_cloud_edit` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_master`
--

CREATE TABLE `tbl_employee_master` (
  `branchid` int DEFAULT NULL,
  `emp_id` int DEFAULT NULL,
  `emp_first_name` varchar(50) DEFAULT NULL,
  `emp_last_name` varchar(50) DEFAULT NULL,
  `emp_employee_id` varchar(50) DEFAULT NULL,
  `emp_vendor` varchar(50) DEFAULT NULL,
  `emp_department` varchar(50) DEFAULT NULL,
  `emp_designation` varchar(50) DEFAULT NULL,
  `emp_status` varchar(50) DEFAULT NULL,
  `emp_mail` varchar(50) DEFAULT NULL,
  `emp_number` varchar(50) DEFAULT NULL,
  `emp_salary` decimal(15,3) DEFAULT NULL,
  `emp_mode` varchar(50) DEFAULT NULL,
  `emp_alternate_no` varchar(50) DEFAULT NULL,
  `emp_dob` date DEFAULT NULL,
  `emp_join_date` date DEFAULT NULL,
  `emp_id_no` varchar(50) DEFAULT NULL,
  `emp_id_type` varchar(50) DEFAULT NULL,
  `emp_address` varchar(100) DEFAULT NULL,
  `emp_remarks` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_voucher`
--

CREATE TABLE `tbl_employee_voucher` (
  `branchid` int NOT NULL,
  `ev_id` int NOT NULL,
  `ev_employee_id` int DEFAULT NULL,
  `ev_department` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ev_pay_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ev_date` date DEFAULT NULL,
  `ev_amount` decimal(15,3) DEFAULT NULL,
  `ev_from` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ev_approved_by` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ev_trans` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ev_remarks` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ev_entry_date` date DEFAULT NULL,
  `ev_entry_login` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ev_month` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ev_year` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ev_pay_type_acc` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ev_net_salary_new` decimal(15,3) DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ev_entry_time` datetime DEFAULT NULL,
  `ev_login` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ev_cloud_added` varchar(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ev_cloud_edited` varchar(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expense_voucher`
--

CREATE TABLE `tbl_expense_voucher` (
  `branchid` int NOT NULL,
  `ev_id` int NOT NULL,
  `ev_date` date DEFAULT NULL,
  `ev_acc_type` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ev_from_acc` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ev_to_acc` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ev_amount` decimal(15,3) DEFAULT NULL,
  `ev_transaction_data` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ev_remarks` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ev_entry_date` date DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ev_entry_time` datetime DEFAULT NULL,
  `ev_login` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ev_cloud_added` varchar(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ev_cloud_edited` varchar(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expodine_machines`
--

CREATE TABLE `tbl_expodine_machines` (
  `branchid` int NOT NULL,
  `cm_id` int NOT NULL,
  `cm_ip_address` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cm_ip_port` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cm_ip_folder` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cm_is_server` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `cm_status` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `cm_lastupdated_time` datetime DEFAULT NULL,
  `cm_xml_update_found` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `cm_xml_update_from_link` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cm_xml_update_found_time` datetime DEFAULT NULL,
  `cm_ip_remarks` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cm_enable_cash_drawer` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `cm_cash_drawer_ip` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cm_cash_drawer_port` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cm_cash_drawer_usb` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `cm_machine_type` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_extra_tax_master`
--

CREATE TABLE `tbl_extra_tax_master` (
  `branchid` int NOT NULL,
  `amc_id` int NOT NULL,
  `amc_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `amc_value` decimal(5,2) NOT NULL DEFAULT '0.00',
  `amc_unit` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'P',
  `amc_label` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `amc_active` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `amc_symbol` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `amc_entrydate` datetime DEFAULT NULL,
  `amc_modified_date` datetime DEFAULT NULL,
  `amc_item_tax` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `amc_enable_cs` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `amc_enable_ta` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `amc_enable_hd` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedbackmaster`
--

CREATE TABLE `tbl_feedbackmaster` (
  `branchid` int NOT NULL,
  `fbm_id` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `fbm_question` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `fbm_active` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `fbm_branchid` bigint DEFAULT NULL,
  `fbm_avgrating` decimal(2,1) NOT NULL DEFAULT '0.0',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedbackrating`
--

CREATE TABLE `tbl_feedbackrating` (
  `branchid` int NOT NULL,
  `fbr_id` int NOT NULL,
  `fbr_fbm_id` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `fbr_rate` decimal(2,1) NOT NULL,
  `fbr_table` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fbr_entrytime` datetime NOT NULL,
  `fbr_orderid` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedbackratingcount`
--

CREATE TABLE `tbl_feedbackratingcount` (
  `branchid` int NOT NULL,
  `frc_menuid` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `frc_5star` int NOT NULL DEFAULT '0',
  `frc_4star` int NOT NULL DEFAULT '0',
  `frc_3star` int NOT NULL DEFAULT '0',
  `frc_2star` int NOT NULL DEFAULT '0',
  `frc_1star` int NOT NULL DEFAULT '0',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_floormaster`
--

CREATE TABLE `tbl_floormaster` (
  `branchid` int NOT NULL,
  `fr_floorid` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `fr_branchid` bigint NOT NULL,
  `fr_floorname` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `fr_status` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Active',
  `fr_vbill_discount` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `fr_enable_extra_tax` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `fr_extra_prefix` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fr_bill_series` int NOT NULL DEFAULT '1',
  `fr_android_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fr_order_display` int DEFAULT NULL,
  `fr_qr_order` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `bu_is_central` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_floor_tax`
--

CREATE TABLE `tbl_floor_tax` (
  `branchid` int NOT NULL,
  `ft_floorid` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ft_tax_id` int NOT NULL,
  `ft_active` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `ft_entry_date` date DEFAULT NULL,
  `ft_modified_date` date DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food_cost`
--

CREATE TABLE `tbl_food_cost` (
  `branchid` int NOT NULL,
  `tfc_id` int NOT NULL,
  `tfc_menu` int DEFAULT NULL,
  `tfc_portion` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tfc_ing_menu` int DEFAULT NULL,
  `tfc_qty` decimal(15,3) DEFAULT NULL,
  `tfc_weight` decimal(15,3) DEFAULT NULL,
  `tfc_rate` decimal(15,3) DEFAULT NULL,
  `tfc_total` decimal(15,3) DEFAULT NULL,
  `tfc_date` datetime DEFAULT NULL,
  `tfc_login` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tfc_di` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tfc_ta` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tfc_hd` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tfc_cs` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tfc_store` int DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tfc_yield` decimal(15,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_function_details`
--

CREATE TABLE `tbl_function_details` (
  `branchid` int NOT NULL,
  `fd_id` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `fd_reg_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fd_date` date DEFAULT NULL,
  `fd_time` time DEFAULT NULL,
  `fd_session` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fd_function_type` int DEFAULT NULL,
  `fd_venue` int DEFAULT NULL,
  `fd_billing_type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fd_no_of_pax` int DEFAULT NULL,
  `fd_per_head_cost` decimal(15,3) DEFAULT NULL,
  `fd_customer` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fd_email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fd_mobile_1` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fd_mobile_2` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fd_landline` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fd_contact_person` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fd_address` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fd_remarks` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `fd_total_rate` float DEFAULT '0',
  `fd_status` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Open',
  `fd_advance_given` decimal(15,3) DEFAULT '0.000',
  `fd_reg_date` date DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fd_dayclosedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_function_details_menu`
--

CREATE TABLE `tbl_function_details_menu` (
  `branchid` int NOT NULL,
  `fdm_function_id` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `fdm_slno` int NOT NULL,
  `fdm_menu` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `fdm_qty` int NOT NULL DEFAULT '1',
  `fdm_unit_rate` float NOT NULL DEFAULT '0',
  `fdm_total_rate` float NOT NULL DEFAULT '0',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_function_extra_costs`
--

CREATE TABLE `tbl_function_extra_costs` (
  `branchid` int NOT NULL,
  `fec_id` int NOT NULL,
  `fec_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `fec_cost` int NOT NULL DEFAULT '0',
  `fec_unit` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'V',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_function_invoice`
--

CREATE TABLE `tbl_function_invoice` (
  `branchid` int NOT NULL,
  `fi_invoice_no` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `fi_function_id` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `fi_total_cost` decimal(15,3) NOT NULL,
  `fi_total_extra_cost` decimal(15,3) NOT NULL,
  `fi_total_discount` decimal(15,3) NOT NULL,
  `fi_total_final_rate` decimal(15,3) NOT NULL,
  `fi_discount_amount` decimal(15,3) NOT NULL DEFAULT '0.000',
  `fi_paid_by_mode` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fi_balance_amt` decimal(15,3) NOT NULL DEFAULT '0.000',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_function_invoice_extras`
--

CREATE TABLE `tbl_function_invoice_extras` (
  `branchid` int NOT NULL,
  `fi_invoice_no` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `fi_slno` int NOT NULL,
  `fi_extra_id` int NOT NULL,
  `fi_extra_cost` decimal(15,3) NOT NULL,
  `fi_extra_rate` decimal(15,3) NOT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_function_type`
--

CREATE TABLE `tbl_function_type` (
  `branchid` int NOT NULL,
  `ft_id` int NOT NULL,
  `ft_name` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ft_status` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Active',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_function_venue`
--

CREATE TABLE `tbl_function_venue` (
  `branchid` int NOT NULL,
  `fv_id` int NOT NULL,
  `fv_name` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `fv_status` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grn_order`
--

CREATE TABLE `tbl_grn_order` (
  `branchid` int NOT NULL,
  `tg_id` int NOT NULL,
  `tg_grn_id` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tg_dayclosedate` date DEFAULT NULL,
  `tg_product` int DEFAULT NULL,
  `tg_name` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tg_rate_type` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tg_barcode` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tg_unittype` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tg_weight` decimal(15,3) DEFAULT NULL,
  `tg_qty` int DEFAULT NULL,
  `tg_unit_rate` decimal(15,3) DEFAULT NULL,
  `tg_total_rate` decimal(15,3) DEFAULT NULL,
  `tg_tax_percent` decimal(15,3) DEFAULT NULL,
  `tg_tax_rate` decimal(15,3) DEFAULT NULL,
  `tg_final_rate` decimal(15,3) DEFAULT NULL,
  `tg_expiry_date` date DEFAULT NULL,
  `tg_brand` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tg_supplier` int DEFAULT NULL,
  `tg_store` int DEFAULT NULL,
  `tg_set` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tg_login` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tg_status_login` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tg_status_date` datetime DEFAULT NULL,
  `tg_status` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tg_direct_transfer` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tg_ip` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tg_direct_accept` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tg_accept_direct_by` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tg_accept_direct_time` datetime DEFAULT NULL,
  `tg_batch_id` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grn_summary`
--

CREATE TABLE `tbl_grn_summary` (
  `branchid` int NOT NULL,
  `tgs_id` int NOT NULL,
  `tgs_grn_id` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tg_final_total` decimal(15,3) DEFAULT NULL,
  `tg_tax` decimal(15,3) DEFAULT NULL,
  `tg_tax_amount` decimal(15,3) DEFAULT NULL,
  `tg_grand_total` decimal(15,3) DEFAULT NULL,
  `tg_date` date DEFAULT NULL,
  `tgs_invoice_no` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tgs_adjustment` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tgs_ip` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tgs_remarks` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tgs_edited_time` datetime DEFAULT NULL,
  `tgs_edit_login` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ingredientmaster`
--

CREATE TABLE `tbl_ingredientmaster` (
  `branchid` int NOT NULL,
  `ir_ingredientid` bigint NOT NULL,
  `ir_ingredientname` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ir_headofficeid` bigint NOT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inv_kitchen`
--

CREATE TABLE `tbl_inv_kitchen` (
  `branchid` int NOT NULL,
  `ti_id` int NOT NULL,
  `ti_name` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ti_status` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ti_type` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `central_created` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `updated_in_local` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `central_edited` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inv_settings`
--

CREATE TABLE `tbl_inv_settings` (
  `branchid` int NOT NULL,
  `ti_id` int NOT NULL,
  `ti_requistion_id` int DEFAULT NULL,
  `ti_purchase_id` int DEFAULT NULL,
  `ti_grn_id` int DEFAULT NULL,
  `ti_transfer_id` int DEFAULT NULL,
  `ti_physical_id` int DEFAULT NULL,
  `ti_return_id` int DEFAULT NULL,
  `ti_consumption_id` int DEFAULT NULL,
  `ti_wastage_id` int DEFAULT NULL,
  `ti_production_id` int DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ti_central_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kotcountermaster`
--

CREATE TABLE `tbl_kotcountermaster` (
  `branchid` int NOT NULL,
  `kr_kotcode` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `kr_branchid` bigint NOT NULL,
  `kr_kotname` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `kr_printerid` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `kr_android_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `new_from_cloud` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `central_edited` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `central_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kotmaster`
--

CREATE TABLE `tbl_kotmaster` (
  `branchid` int NOT NULL,
  `kr_date` date NOT NULL,
  `kr_kotno` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `kr_print` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `kr_firstprint` datetime DEFAULT NULL,
  `kr_lastprint` datetime DEFAULT NULL,
  `kr_time` time DEFAULT NULL,
  `kr_mode_of_order` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `kr_order_confirming_staff` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kot_cancellation`
--

CREATE TABLE `tbl_kot_cancellation` (
  `branchid` int DEFAULT NULL,
  `kc_cancellation_id` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `kc_date` date NOT NULL,
  `kc_time` time NOT NULL,
  `kc_table` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `kc_login` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_languages`
--

CREATE TABLE `tbl_languages` (
  `branchid` int NOT NULL,
  `ls_id` int NOT NULL,
  `ls_language` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ls_shortcode` char(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ls_status` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ledger_group`
--

CREATE TABLE `tbl_ledger_group` (
  `branchid` int NOT NULL,
  `tlg_id` int NOT NULL,
  `tlg_name` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tlg_status` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tlg_group_type` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tlg_exp_inc_type` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_edited` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_edited_by` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ledger_master`
--

CREATE TABLE `tbl_ledger_master` (
  `branchid` int NOT NULL,
  `tlm_id` int NOT NULL,
  `tlm_ledger_name` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tlm_group` int DEFAULT NULL,
  `tlm_open_bal` decimal(15,3) DEFAULT NULL,
  `tlm_type` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tlm_vendor_id` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tlm_staff_id` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tlm_guest_id` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tlm_company_id` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tlm_close_bal` decimal(15,3) DEFAULT NULL,
  `tlm_capital_cb` int DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tlm_cloud_add` char(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tlm_cloud_add_by` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tlm_cloud_edit` char(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tlm_cloud_edit_by` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ledger_setting`
--

CREATE TABLE `tbl_ledger_setting` (
  `branchid` int DEFAULT NULL,
  `tps_id` int DEFAULT NULL,
  `tps_ledger_id` int DEFAULT NULL,
  `tps_ledger_open_bal` decimal(15,3) DEFAULT NULL,
  `tps_closing_balance` decimal(15,3) DEFAULT NULL,
  `tps_dayclosedate` date DEFAULT NULL,
  `tps_open_bal_updated` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logindetails`
--

CREATE TABLE `tbl_logindetails` (
  `branchid` int NOT NULL,
  `ls_username` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ls_password` varchar(35) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ls_branchid` bigint DEFAULT NULL,
  `ls_applogin` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `ls_staffid` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ls_status` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `ls_restrict_login` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `ls_login_status` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ls_login_time` datetime DEFAULT NULL,
  `ls_logout_time` datetime DEFAULT NULL,
  `ls_login_machineip` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login_restrict_logs`
--

CREATE TABLE `tbl_login_restrict_logs` (
  `branchid` int NOT NULL,
  `r_id` int NOT NULL,
  `r_date` datetime DEFAULT NULL,
  `r_message` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loyalty_campaign`
--

CREATE TABLE `tbl_loyalty_campaign` (
  `branchid` int NOT NULL,
  `lc_id` int NOT NULL,
  `lc_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `lc_from` date NOT NULL,
  `lc_to` date NOT NULL,
  `lc_active` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `lc_condent` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loyalty_campaign_group`
--

CREATE TABLE `tbl_loyalty_campaign_group` (
  `branchid` int NOT NULL,
  `gp_id` int NOT NULL,
  `gp_groupname` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `gp_status` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `gp_value` decimal(6,3) DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loyalty_discount`
--

CREATE TABLE `tbl_loyalty_discount` (
  `branchid` int NOT NULL,
  `ld_visitcount` int NOT NULL,
  `ld_discount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `ld_type` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loyalty_group_details`
--

CREATE TABLE `tbl_loyalty_group_details` (
  `branchid` int NOT NULL,
  `tgp_groupid` int DEFAULT NULL,
  `tgp_customerid` int DEFAULT NULL,
  `tgp_groupcode` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tgp_datetime` datetime DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tgp_code_active` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tgp_campaign_id` int DEFAULT NULL,
  `tgp_id` int NOT NULL,
  `tgp_bill_amount` decimal(15,3) DEFAULT NULL,
  `tgp_coupon_amount` decimal(15,3) DEFAULT NULL,
  `tgp_bill_date_time` datetime DEFAULT NULL,
  `tgp_billno` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loyalty_levels`
--

CREATE TABLE `tbl_loyalty_levels` (
  `branchid` int NOT NULL,
  `ll_id` int NOT NULL,
  `ll_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ll_description` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ll_condition_value` int DEFAULT NULL,
  `ll_reward_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ll_reward_code` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ll_reward_value` int DEFAULT NULL,
  `ll_minorder_value` int DEFAULT NULL,
  `ll_customers` int DEFAULT NULL,
  `ll_active` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `ll_special_rewards` int DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loyalty_pointadd_bill`
--

CREATE TABLE `tbl_loyalty_pointadd_bill` (
  `branchid` int NOT NULL,
  `lob_id` int NOT NULL,
  `lob_billno` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `lob_bill_amount` decimal(15,3) DEFAULT NULL,
  `lob_point_add` decimal(15,2) DEFAULT NULL,
  `lob_point_redeem` decimal(15,2) DEFAULT NULL,
  `lob_redeem_amount` decimal(15,3) DEFAULT NULL,
  `lob_date` datetime DEFAULT NULL,
  `lob_loyalty_customer` int DEFAULT NULL,
  `lob_mode` varchar(11) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loyalty_pointrule`
--

CREATE TABLE `tbl_loyalty_pointrule` (
  `branchid` int NOT NULL,
  `lyp_id` int NOT NULL,
  `lyp_point` decimal(15,2) DEFAULT NULL,
  `lyp_amount` decimal(15,3) DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=FIXED;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loyalty_point_transfers`
--

CREATE TABLE `tbl_loyalty_point_transfers` (
  `branchid` int NOT NULL,
  `lpt_id` int NOT NULL,
  `lpt_from_id` int NOT NULL,
  `lpt_to_id` int NOT NULL,
  `lpt_points` int NOT NULL,
  `lpt_reason` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `lpt_secret_key` int DEFAULT NULL,
  `lpt_date` datetime NOT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loyalty_redeem_rule`
--

CREATE TABLE `tbl_loyalty_redeem_rule` (
  `branchid` int NOT NULL,
  `lyr_id` int NOT NULL,
  `lyr_point` decimal(15,2) DEFAULT NULL,
  `lyr_amount` decimal(15,3) DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=FIXED;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loyalty_reg`
--

CREATE TABLE `tbl_loyalty_reg` (
  `branchid` int NOT NULL,
  `ly_id` int NOT NULL,
  `ly_firstname` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ly_lastname` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ly_gender` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ly_mobileno` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ly_emailid` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ly_birthdaydate` date DEFAULT NULL,
  `ly_maritalstatus` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ly_anniversarydate` date DEFAULT NULL,
  `ly_profession` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ly_totalvisit` int NOT NULL DEFAULT '1',
  `ly_mailreceive` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `ly_smsreceive` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `ly_entrydatetime` datetime DEFAULT NULL,
  `ly_branchid` int DEFAULT NULL,
  `ly_status` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Active',
  `ly_entry_from` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Credit',
  `ly_points` decimal(15,2) DEFAULT '0.00',
  `ly_voucher_count` int NOT NULL DEFAULT '1',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `ly_loy_dayclose` date DEFAULT NULL,
  `ly_loy_login` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ly_gst` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ly_default` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ly_module` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ly_customer_table` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ly_customer_floor` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loyalty_rules`
--

CREATE TABLE `tbl_loyalty_rules` (
  `branchid` int NOT NULL,
  `lr_id` int NOT NULL,
  `lr_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `lr_description` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `lr_active` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `lr_start_at` date NOT NULL,
  `lr_end_at` date NOT NULL,
  `lr_type` int NOT NULL,
  `lr_bill_amount` decimal(15,3) NOT NULL DEFAULT '0.000',
  `lr_redemption_min_point` int NOT NULL DEFAULT '0',
  `lr_redemption_cash_value` decimal(15,3) NOT NULL DEFAULT '0.000',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loyalty_rules_type`
--

CREATE TABLE `tbl_loyalty_rules_type` (
  `branchid` int NOT NULL,
  `lrt_id` int NOT NULL,
  `lrt_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `lrt_active` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loyalty_sendto`
--

CREATE TABLE `tbl_loyalty_sendto` (
  `branchid` int NOT NULL,
  `ls_id` int NOT NULL,
  `ls_type` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ls_query` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ls_selected` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'N',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loyalty_sms_source`
--

CREATE TABLE `tbl_loyalty_sms_source` (
  `branchid` int NOT NULL,
  `ls_id` int NOT NULL,
  `ls_sms_data` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ls_date_sendon` datetime DEFAULT NULL,
  `ls_login_name` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loyalty_voucher`
--

CREATE TABLE `tbl_loyalty_voucher` (
  `branchid` int NOT NULL,
  `vr_voucherid` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `vr_vouchername` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `vr_voucherfrom` date NOT NULL,
  `vr_voucherexpiry` date NOT NULL,
  `vr_vouchercost` decimal(15,2) NOT NULL DEFAULT '0.00',
  `vr_vouchercost_unit` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'V',
  `vr_voucherholder` int NOT NULL,
  `vr_active` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menuimages`
--

CREATE TABLE `tbl_menuimages` (
  `branchid` int NOT NULL,
  `mes_imagename` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `mes_imagethumb` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `mes_menuid` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `mes_android_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menumaincategory`
--

CREATE TABLE `tbl_menumaincategory` (
  `branchid` int NOT NULL,
  `mmy_maincategoryid` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `mmy_maincategoryname` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `mmy_active` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `mmy_branchid` bigint NOT NULL,
  `mmy_displayorder` int DEFAULT '1',
  `mmy_imagename` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mmy_orderof_print` int NOT NULL DEFAULT '1',
  `mmy_android_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mmy_qr_image` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mmy_inventory` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mmy_is_central` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `mmy_new_cate` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `mmy_accepted_outlets` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `new_from_cloud` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `central_edited` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `central_id` int DEFAULT NULL,
  `pref_ids` varchar(2500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `addons_id` varchar(2500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `last_printer_kitchen` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mmy_delete_mode` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menumaster`
--

CREATE TABLE `tbl_menumaster` (
  `branchid` int NOT NULL,
  `mr_menuid` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `mr_menuname` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `mr_maincatid` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `mr_subcatid` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mr_description` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mr_diet` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `mr_time_min` tinyint NOT NULL,
  `mr_active` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `mr_kotcounter` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `mr_modifieddate` datetime NOT NULL,
  `mr_modifieduser` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mr_rating` tinyint DEFAULT '0',
  `mr_prepmode` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mr_branchid` bigint NOT NULL,
  `mr_itemshortcode` varchar(17) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `mr_dailystock` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `mr_manualrateentry` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `mr_itemcode` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mr_dailystock_in_number` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `mr_android_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `mr_show_in_kod` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `mr_excempt_tax` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `mr_rate_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Portion',
  `mr_unit_type` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mr_base_unit` int DEFAULT NULL,
  `mr_add_on` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `mr_show_in_kot_print` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `manual_barcode` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mr_ingredient` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mr_replacer` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mr_product_type` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mr_inventory_kitchen` int DEFAULT NULL,
  `inv_pdt_id` varchar(11) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mr_pkd_date` date DEFAULT NULL,
  `mr_exp_date` date DEFAULT NULL,
  `mr_plu` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mr_reorder_level` int DEFAULT NULL,
  `mr_purchase_price` decimal(15,3) DEFAULT NULL,
  `mr_raw_barcode` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mr_qr_set` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `mr_delete_mode` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mr_central_id` int DEFAULT NULL,
  `mr_excempt_disc` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mr_central_menu` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `mr_new_menu` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `mr_copy_from` int DEFAULT NULL,
  `mr_added_branches` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `mr_accepted_outlets` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `mr_stock_inventory` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mr_hsn` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mr_stock_in_out` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menuratemaster`
--

CREATE TABLE `tbl_menuratemaster` (
  `branchid` int NOT NULL,
  `mmr_id` int NOT NULL,
  `mmr_menuid` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `mmr_floorid` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `mmr_rate_type` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Portion',
  `mmr_portion` int DEFAULT NULL,
  `mmr_unit_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mmr_unit_weight` decimal(15,5) NOT NULL DEFAULT '0.00000',
  `mmr_unit_id` int DEFAULT NULL,
  `mmr_base_unit_id` int DEFAULT NULL,
  `mmr_rate` decimal(15,3) NOT NULL DEFAULT '0.000',
  `mmr_default` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `mmr_barcode` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mmr_android_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mmr_menu_tax_amount` decimal(15,3) DEFAULT NULL,
  `mmr_menu_final_amount` decimal(15,3) DEFAULT NULL,
  `mmr_menu_tax_value` decimal(15,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menuratetakeaway`
--

CREATE TABLE `tbl_menuratetakeaway` (
  `branchid` int NOT NULL,
  `mta_id` int NOT NULL,
  `mta_menuid` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `mta_rate_type` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Portion',
  `mta_portion` int DEFAULT NULL,
  `mta_unit_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mta_unit_weight` decimal(15,5) NOT NULL DEFAULT '0.00000',
  `mta_unit_id` int DEFAULT NULL,
  `mta_base_unit_id` int DEFAULT NULL,
  `mta_branchid` bigint NOT NULL,
  `mta_rate` decimal(15,3) NOT NULL DEFAULT '0.000',
  `mta_default` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `mta_barcode` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mta_food_partner` int DEFAULT NULL,
  `mta_menu_tax_amount` decimal(15,3) DEFAULT NULL,
  `mta_menu_final_amount` decimal(15,3) DEFAULT NULL,
  `mta_menu_tax_value` decimal(15,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menurate_counter`
--

CREATE TABLE `tbl_menurate_counter` (
  `branchid` int NOT NULL,
  `mrc_id` int NOT NULL,
  `mrc_menuid` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `mrc_rate_type` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Portion',
  `mrc_portion` int DEFAULT NULL,
  `mrc_unit_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mrc_unit_weight` decimal(15,5) NOT NULL DEFAULT '0.00000',
  `mrc_unit_id` int DEFAULT NULL,
  `mrc_base_unit_id` int DEFAULT NULL,
  `mrc_branchid` bigint NOT NULL,
  `mrc_rate` decimal(15,3) NOT NULL DEFAULT '0.000',
  `mrc_default` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `mrc_android_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `mrc_barcode` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mrc_menu_tax_amount` decimal(15,3) DEFAULT NULL,
  `mrc_menu_final_amount` decimal(15,3) DEFAULT NULL,
  `mrc_menu_tax_value` decimal(15,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menurate_roomservice`
--

CREATE TABLE `tbl_menurate_roomservice` (
  `branchid` int NOT NULL,
  `mrs_menuid` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `mrs_portion` int NOT NULL,
  `mrs_branchid` bigint NOT NULL,
  `mrs_rate` decimal(15,3) NOT NULL DEFAULT '0.000',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menustock`
--

CREATE TABLE `tbl_menustock` (
  `branchid` int NOT NULL,
  `mk_id` int NOT NULL,
  `mk_date` date NOT NULL,
  `mk_menuid` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `mk_portion` int DEFAULT NULL,
  `mk_unit_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mk_unit_weight` decimal(15,5) DEFAULT '0.00000',
  `mk_unit_id` int DEFAULT NULL,
  `mk_base_unit_id` int DEFAULT NULL,
  `mk_stock` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `mk_stocktime` datetime DEFAULT NULL,
  `mk_stock_number` decimal(10,2) DEFAULT '0.00',
  `mk_android_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `mk_opening_stock` int DEFAULT NULL,
  `mk_open_stock_date` date DEFAULT NULL,
  `mk_added_stock_total` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menusubcategory`
--

CREATE TABLE `tbl_menusubcategory` (
  `branchid` int NOT NULL,
  `msy_subcategoryid` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `msy_branchid` bigint NOT NULL,
  `msy_subcategoryname` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `msy_active` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `msy_android_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `msy_sub_displayorder` int NOT NULL DEFAULT '1',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `msy_is_central` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `msy_accepted_outlets` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `msy_new_subcat` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `new_from_cloud` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `central_edited` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `central_id` int DEFAULT NULL,
  `msy_delete_mode` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu_addons`
--

CREATE TABLE `tbl_menu_addons` (
  `branchid` int NOT NULL,
  `ma_menuid` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ma_addon_menuid` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ma_android_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu_discount`
--

CREATE TABLE `tbl_menu_discount` (
  `branchid` int NOT NULL,
  `md_menuid` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `md_slno` int NOT NULL,
  `md_discount` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `md_date_limit` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `md_time_limit` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `md_day_limit` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `md_day` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `md_from_date` date DEFAULT NULL,
  `md_to_date` date DEFAULT NULL,
  `md_di_active` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `md_cs_active` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `md_ta_active` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `md_active` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `md_from_time` time DEFAULT NULL,
  `md_to_time` time DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `md_cloud_added` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `md_cloud_edited` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu_ingredient_detail`
--

CREATE TABLE `tbl_menu_ingredient_detail` (
  `branchid` int NOT NULL,
  `tmi_id` int NOT NULL,
  `tmi_menuid` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tmi_ing_menuid` int DEFAULT NULL,
  `tmi_ing_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tmi_ing_qty` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tmi_ing_unit` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tmi_rate_type` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tmi_ing_rate` decimal(15,3) DEFAULT NULL,
  `tmi_ing_total` decimal(15,3) DEFAULT NULL,
  `tmi_ing_dayclosedate` date DEFAULT NULL,
  `tmi_weight` decimal(15,3) DEFAULT NULL,
  `tmi_wastage_qty` decimal(15,3) DEFAULT NULL,
  `tmi_wastage_rate` decimal(15,3) DEFAULT NULL,
  `tmi_di` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tmi_ta` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tmi_hd` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tmi_cs` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tmi_store` int DEFAULT NULL,
  `tmi_yield` decimal(15,3) DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tmi_portion` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu_tax_master`
--

CREATE TABLE `tbl_menu_tax_master` (
  `branchid` int NOT NULL,
  `mtm_menuid` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `mtm_slno` tinyint NOT NULL,
  `mtm_tax_id` int NOT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_online_billdetails`
--

CREATE TABLE `tbl_online_billdetails` (
  `branchid` int NOT NULL,
  `tab_billno` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tab_slno` int NOT NULL,
  `tab_menu` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tab_portion` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tab_qty` int NOT NULL DEFAULT '1',
  `tab_preferencetext` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tab_rate` decimal(15,3) NOT NULL DEFAULT '0.000',
  `tab_amount` decimal(15,3) NOT NULL DEFAULT '0.000',
  `tab_status` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tab_entrytime` datetime DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_online_billmaster`
--

CREATE TABLE `tbl_online_billmaster` (
  `branchid` int NOT NULL,
  `on_billno` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `on_billdatetime` date NOT NULL,
  `on_orderno` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `on_kotno` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `on_customer_id` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `on_customer_name` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `on_customer_phone` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `on_total_items` int DEFAULT NULL,
  `on_order_type` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `on_delivery_charge` decimal(15,3) DEFAULT NULL,
  `on_delivery_street` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `on_delivery_building` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `on_delivery_floor` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `on_delivery_apartment` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `on_delivery_state` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `on_delivery_zip_code` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `on_subtotal` decimal(15,3) NOT NULL DEFAULT '0.000',
  `on_subtotal_final` decimal(15,3) DEFAULT '0.000',
  `on_discountvalue` decimal(15,3) NOT NULL DEFAULT '0.000',
  `on_taxable_amount` decimal(15,3) NOT NULL DEFAULT '0.000',
  `on_total` decimal(15,3) NOT NULL DEFAULT '0.000',
  `on_roundoff_value` decimal(15,3) DEFAULT '0.000',
  `on_finaltotal` decimal(15,3) DEFAULT '0.000',
  `on_paymode` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `remarks` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `on_billprinted` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `on_lastprintime` datetime DEFAULT NULL,
  `on_status` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Billed',
  `on_discountlabel` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `on_bill_ref` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_online_order`
--

CREATE TABLE `tbl_online_order` (
  `branchid` int NOT NULL,
  `tol_id` int NOT NULL,
  `tol_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tol_discount` decimal(15,3) DEFAULT '0.000',
  `tol_tax` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `tol_tax_value` decimal(15,3) DEFAULT '0.000',
  `tol_credit_settle` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `tol_status` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `tol_order_status` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tol_logo_url` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tol_urban_name` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tol_local_order` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `tol_qr_order` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `bu_is_central` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_online_tax`
--

CREATE TABLE `tbl_online_tax` (
  `branchid` int DEFAULT NULL,
  `tox_id` int NOT NULL,
  `tox_partner` int DEFAULT NULL,
  `tox_tax_id` int DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_addon`
--

CREATE TABLE `tbl_order_addon` (
  `branchid` int NOT NULL,
  `ad_orderno` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ad_order_slno` int NOT NULL,
  `ad_addon_menu` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ad_rate` decimal(15,3) NOT NULL DEFAULT '0.000',
  `ad_qty` int NOT NULL,
  `ad_total_rate` decimal(15,3) DEFAULT '0.000',
  `ad_dayclosedate` date NOT NULL,
  `ad_entrydate` datetime DEFAULT NULL,
  `ad_kotno` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ad_cancelled` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_addon_changes`
--

CREATE TABLE `tbl_order_addon_changes` (
  `branchid` int NOT NULL,
  `adc_cancel_id` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `adc_cancel_orderno` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `adc_cancel_order_slno` int NOT NULL,
  `adc_cancel_menu` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `adc_cancelled_qty` int DEFAULT NULL,
  `adc_cancelledreason` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `adc_cancelledlogin` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `adc_cancelledby_careof` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `adc_cancelled_date` datetime DEFAULT NULL,
  `adc_dayclosedate` date DEFAULT NULL,
  `adc_kotno` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_paymentmode`
--

CREATE TABLE `tbl_paymentmode` (
  `branchid` int NOT NULL,
  `pym_id` int NOT NULL,
  `pym_code` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `pym_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `pym_active` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `pym_credit_view` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `pym_changesettled_view` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `pym_takeaway_view` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `pym_counter_view` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_physical_stock`
--

CREATE TABLE `tbl_physical_stock` (
  `branchid` int NOT NULL,
  `tps_id` int NOT NULL,
  `tps_phy_id` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tps_product` int DEFAULT NULL,
  `tps_name` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tps_brand` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tps_barcode` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tps_rate_type` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tps_unittype` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tps_qty` int DEFAULT NULL,
  `tps_weight` decimal(15,3) DEFAULT NULL,
  `tps_store_qty` int DEFAULT NULL,
  `tps_store_weight` decimal(15,3) DEFAULT NULL,
  `tps_login` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tps_date` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tps_set` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tps_store` int DEFAULT NULL,
  `tps_rate` decimal(15,3) DEFAULT NULL,
  `tps_total` decimal(15,3) DEFAULT NULL,
  `tps_approve_date` date DEFAULT NULL,
  `tps_approved_by` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tps_reason` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tps_aprroving_status` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_portionmaster`
--

CREATE TABLE `tbl_portionmaster` (
  `branchid` int NOT NULL,
  `pm_id` int NOT NULL,
  `pm_portionname` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `pm_portionshortcode` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `pm_viewinbill` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `pm_viewinkot` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `pm_ratio` decimal(3,2) DEFAULT '1.00',
  `pm_android_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `display_order` int DEFAULT NULL,
  `pm_is_central` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_preferencemaster`
--

CREATE TABLE `tbl_preferencemaster` (
  `branchid` int NOT NULL,
  `pmr_id` int NOT NULL,
  `pmr_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `pmr_android_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_production`
--

CREATE TABLE `tbl_production` (
  `branchid` int NOT NULL,
  `tp_id` int NOT NULL,
  `tp_production_id` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tp_product` int DEFAULT NULL,
  `tp_name` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tp_rate_type` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tp_unit_type` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tp_qty` decimal(15,3) DEFAULT NULL,
  `tp_weight` decimal(15,3) DEFAULT NULL,
  `tp_date` date DEFAULT NULL,
  `tp_set` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tp_login` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tp_store` int DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tp_portion` int DEFAULT NULL,
  `tp_prod_central_id` int DEFAULT NULL,
  `tp_cloud_added` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_conversion`
--

CREATE TABLE `tbl_product_conversion` (
  `branchid` int NOT NULL,
  `tpc_id` int NOT NULL,
  `tpc_from_product` int DEFAULT NULL,
  `tpc_to_product` int DEFAULT NULL,
  `tpc_from_store` int DEFAULT NULL,
  `tpc_to_store` int DEFAULT NULL,
  `tpc_date` date DEFAULT NULL,
  `tpc_login` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tpc_qty` decimal(15,3) DEFAULT NULL,
  `tpc_weight` decimal(15,3) DEFAULT NULL,
  `tpc_from_weight` decimal(15,3) DEFAULT NULL,
  `tpc_from_qty` decimal(15,3) DEFAULT NULL,
  `tpc_set` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tpc_from_cloud` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_order`
--

CREATE TABLE `tbl_purchase_order` (
  `branchid` int NOT NULL,
  `tp_id` int NOT NULL,
  `tp_purchase_id` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tp_dayclosedate` date DEFAULT NULL,
  `tp_product` int DEFAULT NULL,
  `tp_name` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tp_rate_type` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tp_barcode` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tp_unittype` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tp_weight` decimal(15,3) DEFAULT NULL,
  `tp_qty` int DEFAULT NULL,
  `tp_brand` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tp_supplier` int DEFAULT NULL,
  `tp_store` int DEFAULT NULL,
  `tp_set` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tp_login` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tp_status_login` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tp_status_date` datetime DEFAULT NULL,
  `tp_status` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tp_ip` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_return`
--

CREATE TABLE `tbl_purchase_return` (
  `branchid` int NOT NULL,
  `tpr_id` int NOT NULL,
  `tpr_return_id` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tpr_store` int DEFAULT NULL,
  `tpr_menu` int DEFAULT NULL,
  `tpr_rate_type` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tpr_unit_type` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tpr_qty` int DEFAULT NULL,
  `tpr_weight` decimal(15,3) DEFAULT NULL,
  `tpr_rate` decimal(15,3) DEFAULT NULL,
  `tpr_total` decimal(15,3) DEFAULT NULL,
  `tp_tax` decimal(15,3) DEFAULT NULL,
  `tpp_tax_rate` decimal(15,3) DEFAULT NULL,
  `tpr_final` decimal(15,3) DEFAULT NULL,
  `tpr_date` date DEFAULT NULL,
  `tpr_login` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tpr_grn` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tpr_remarks` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tpr_set` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tpr_batch` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_qr_order_details`
--

CREATE TABLE `tbl_qr_order_details` (
  `tq_id` int NOT NULL,
  `tq_branch` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tq_order_no` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tq_order_time` datetime DEFAULT NULL,
  `tq_amount` decimal(15,3) DEFAULT NULL,
  `tq_tax` decimal(15,3) DEFAULT NULL,
  `tq_delivery_charge` decimal(15,3) DEFAULT NULL,
  `tq_final` decimal(15,3) DEFAULT NULL,
  `tq_synced` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `tq_user` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tq_running_order` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'N',
  `tq_localy_confirmed` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'N',
  `tq_local_status_update_time` datetime DEFAULT NULL,
  `tq_cancelled` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'N',
  `tq_cancelled_reason` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tq_cancelled_time` datetime DEFAULT NULL,
  `tq_localy_ready` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'N',
  `td_local_ready_time` datetime DEFAULT NULL,
  `tq_order_picked` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `tq_order_picked_time` datetime DEFAULT NULL,
  `tq_localy_delivered` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'N',
  `tq_food_ready_time` datetime DEFAULT NULL,
  `tq_deliverd_time` datetime DEFAULT NULL,
  `tq_mode` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tq_table` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tq_floor` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tq_bill_request` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'N',
  `tq_req_time` datetime DEFAULT NULL,
  `tq_bill_printed` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `tq_print_time` datetime DEFAULT NULL,
  `tq_printed_by` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tq_running` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_qr_order_item`
--

CREATE TABLE `tbl_qr_order_item` (
  `tqi_id` int NOT NULL,
  `tqi_branch` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tqi_orderno` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tqi_menuid` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tqi_portion` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tqi_qty` int DEFAULT NULL,
  `tqi_rate` decimal(15,3) DEFAULT NULL,
  `tqi_total` decimal(15,3) DEFAULT NULL,
  `tqi_synced` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'N',
  `tqi_running` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `tqi_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_qr_pincodes`
--

CREATE TABLE `tbl_qr_pincodes` (
  `tqp_id` int NOT NULL,
  `tpq_branchid` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tpq_pincode` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tpq_deliverycharge` decimal(15,3) DEFAULT NULL,
  `tpq_active` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `tpq_timezone` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Asia/Kolkata'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_qr_user_detail`
--

CREATE TABLE `tbl_qr_user_detail` (
  `tu_id` int NOT NULL,
  `tu_branchid` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tu_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tu_number` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tu_mail` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tu_password` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tu_running_order` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tu_created_date` datetime DEFAULT NULL,
  `tu_pincode` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tu_buliding_home_name` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tu_lanmark` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tu_area` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tu_city` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tu_login_status` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tu_reset_otp` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tu_service_call` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_receipts`
--

CREATE TABLE `tbl_receipts` (
  `branchid` int NOT NULL,
  `tr_id` int NOT NULL,
  `tr_date` date NOT NULL,
  `tr_acc_type` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tr_from` int DEFAULT NULL,
  `tr_to` int DEFAULT NULL,
  `tr_amount` decimal(15,3) DEFAULT NULL,
  `tr_transaction` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tr_received` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tr_particulars` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tr_entry_date` datetime DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_regenerate_reasons`
--

CREATE TABLE `tbl_regenerate_reasons` (
  `branchid` int NOT NULL,
  `rr_id` int NOT NULL,
  `rr_reason` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `rr_active` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_regenrate_log`
--

CREATE TABLE `tbl_regenrate_log` (
  `branchid` int NOT NULL,
  `re_id` int NOT NULL,
  `re_billno` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `re_datetime` datetime NOT NULL,
  `re_staffid` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `re_reason` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `re_loginid` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `re_secretkey` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `re_amount` decimal(15,3) NOT NULL DEFAULT '0.000',
  `re_order_no` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `re_new_bill_no` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_requisition`
--

CREATE TABLE `tbl_requisition` (
  `branchid` int NOT NULL,
  `tr_id` int NOT NULL,
  `tr_req_id` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tr_dayclosedate` date DEFAULT NULL,
  `tr_product` int DEFAULT NULL,
  `tr_name` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tr_rate_type` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tr_barcode` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tr_unittype` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tr_weight` decimal(15,3) DEFAULT NULL,
  `tr_qty` int DEFAULT NULL,
  `tr_brand` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tr_set` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tr_login` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tr_status_login` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tr_status` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tr_status_date` datetime DEFAULT NULL,
  `tr_store` int DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tr_branchid` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tr_central` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tr_central_accept` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tr_indent` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tr_indent_done` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tr_indent_accepted` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tr_ip` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tr_central_menu_id` int DEFAULT NULL,
  `tr_central_partial` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'N',
  `tr_partial_option` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tr_cancel_updated` varchar(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `tr_cancel_updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_return_payment`
--

CREATE TABLE `tbl_return_payment` (
  `branchid` int NOT NULL,
  `tr_id` int NOT NULL,
  `tr_vendor` int DEFAULT NULL,
  `tr_to_acc` int DEFAULT NULL,
  `tr_return_amount` decimal(15,3) DEFAULT NULL,
  `tr_date` datetime NOT NULL,
  `tr_particulars` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tr_invoice` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tr_sv_id` int DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roommaster`
--

CREATE TABLE `tbl_roommaster` (
  `branchid` int NOT NULL,
  `rm_roomid` int NOT NULL,
  `rm_roomno` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `rm_status` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'Y',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shift_card_detail_close`
--

CREATE TABLE `tbl_shift_card_detail_close` (
  `branchid` int NOT NULL,
  `sb_shiftdate_close` date NOT NULL,
  `sb_shiftid_close` smallint NOT NULL,
  `sb_bankid_close` int NOT NULL,
  `sb_card_amount_close` decimal(15,3) DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shift_card_detail_open`
--

CREATE TABLE `tbl_shift_card_detail_open` (
  `branchid` int NOT NULL,
  `sb_shiftdate` date NOT NULL,
  `sb_shiftid` smallint NOT NULL,
  `sb_bankid` int NOT NULL,
  `sb_card_amount` decimal(15,3) DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shift_close_denomination`
--

CREATE TABLE `tbl_shift_close_denomination` (
  `branchid` int NOT NULL,
  `dod_day` date NOT NULL,
  `dod_shidt_slno` smallint NOT NULL,
  `dod_deno_id` int NOT NULL,
  `dod_count` int NOT NULL DEFAULT '0',
  `dod_value` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shift_details`
--

CREATE TABLE `tbl_shift_details` (
  `branchid` int NOT NULL,
  `sd_day` date NOT NULL,
  `sd_id` smallint NOT NULL,
  `sd_open` datetime NOT NULL,
  `sd_open_staff` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `sd_open_balance` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `sd_open_petty` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `sd_total_value` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `sd_total_deno_value` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `sd_open_machineid` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `sd_close` datetime DEFAULT NULL,
  `sd_close_balance` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `sd_close_petty` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `sd_total_value_close` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `sd_total_deno_value_close` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `sd_close_machineid` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `sd_changein_open` decimal(15,4) DEFAULT NULL,
  `sd_changein_close` decimal(15,4) DEFAULT NULL,
  `sd_open_method` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shift_open_denomination`
--

CREATE TABLE `tbl_shift_open_denomination` (
  `branchid` int NOT NULL,
  `dod_day` date NOT NULL,
  `dod_shidt_slno` smallint NOT NULL,
  `dod_deno_id` int NOT NULL,
  `dod_count` int NOT NULL DEFAULT '0',
  `dod_value` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staffmaster`
--

CREATE TABLE `tbl_staffmaster` (
  `branchid` int NOT NULL,
  `ser_staffid` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ser_firstname` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ser_lastname` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_gender` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ser_designation` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_department` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_dob` date DEFAULT NULL,
  `ser_address1` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_address2` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_dateofjoin` date DEFAULT NULL,
  `ser_mobileno` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_alternateno` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_email` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_employeestatus` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_remarks` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_idtype` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_idno` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_branchofficeid` bigint DEFAULT NULL,
  `ser_cancelpermission` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `ser_cancelwithkey` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `ser_defaultfloor` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_mode` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'B',
  `ser_discountpermission` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `ser_compl_mgmt` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `ser_stockchng_permission` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `ser_discount_manual` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `ser_counter_enable_generate` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `ser_counter_enable_hold` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'N',
  `ser_permit_cash_drawer_open` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `ser_kot_cancel_permission` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `ser_confirm_code` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_authorisation_code` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_bill_cancel_permission` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `ser_rate_edit` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `ser_dayclose_permission` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `ser_shift_permission` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `ser_release_login` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `ser_bill_regen_per` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `ser_bill_reprint_per` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `ser_kot_reprint_per` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `ser_bill_settle_change_per` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `ser_order_split_permission` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_tip_edit_permission` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_dayclose_revert_permission` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_bill_reset` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_salary` decimal(15,3) DEFAULT NULL,
  `ser_credit_view` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_comp_view` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_credit_permission` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_comp_permission` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_bill_print_permission` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_bill_settle_permission` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_bill_edit_permission` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_change_table_permission` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_advance_pay_permission` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_counter_settle_permission` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_reset_accounts` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_last_inherit_staff` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_online_order` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_inv_permission` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_physical_stock_permission` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_wastage_entry` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_stock_entry` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_req` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_po` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_rps` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_store_transfer` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_return_history` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_inventory_reports` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_purchase_return` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_consumption` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_store_stock` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_dashboard` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_recipe` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_production` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_central_kitchen` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_central_accept` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_com_item` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_inv_check_all` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_force_close` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_discount_after` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_all_shift_closer` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_item_discount_manual` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_indent` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_delete_menu` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_menu_unit_edit` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_store_inv` int DEFAULT NULL,
  `ser_stores` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_approve_cancel_inv` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_direct_transfer` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_indent_accept` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_normal_transfer_accept` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_direct_transfer_accept` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_created_by` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_created_time` datetime DEFAULT NULL,
  `ser_last_update` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_cloud_added` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_cloud_edit` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_perm_edited_cloud` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_delete_mode` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_last_inherit_permision` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_last_inherit_user_permision` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_last_inherit_app_permision` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_app_change` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ser_enable_type` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_state_master`
--

CREATE TABLE `tbl_state_master` (
  `id` int NOT NULL,
  `state_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `country_id` int NOT NULL,
  `branchid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock_details`
--

CREATE TABLE `tbl_stock_details` (
  `branchid` int NOT NULL,
  `sd_id` int NOT NULL,
  `sd_date` date DEFAULT NULL,
  `sd_opening_stock` decimal(15,3) DEFAULT NULL,
  `sd_stock_value` decimal(15,3) DEFAULT NULL,
  `sd_stock_transfer` decimal(15,3) DEFAULT NULL,
  `sd_stock_purchase` decimal(15,3) DEFAULT NULL,
  `sd_closing_stock` decimal(15,3) DEFAULT NULL,
  `sd_store_id` int DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_store_stock`
--

CREATE TABLE `tbl_store_stock` (
  `branchid` int NOT NULL,
  `ts_id` int NOT NULL,
  `ts_store` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ts_product` int DEFAULT NULL,
  `ts_barcode` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ts_qty` int DEFAULT NULL,
  `ts_weight` decimal(15,3) DEFAULT NULL,
  `ts_unit` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ts_rate_type` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ts_average` decimal(15,3) DEFAULT NULL,
  `ts_unit_price` decimal(15,3) DEFAULT NULL,
  `ts_total` decimal(15,3) DEFAULT NULL,
  `ts_reorder` decimal(15,3) DEFAULT NULL,
  `ts_expiry` date DEFAULT NULL,
  `ts_last_grn` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ts_stock_update_date` date DEFAULT NULL,
  `ts_updating` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ts_tax` decimal(15,3) DEFAULT NULL,
  `ts_tx_amount` decimal(15,3) DEFAULT NULL,
  `ts_last_qty_on_1st` decimal(15,3) DEFAULT NULL,
  `ts_last_weight_on_1st` decimal(15,3) DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_store_transfer`
--

CREATE TABLE `tbl_store_transfer` (
  `branchid` int NOT NULL,
  `tt_id` int NOT NULL,
  `tt_trn_id` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tt_product` int DEFAULT NULL,
  `tt_name` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tt_qty` int DEFAULT NULL,
  `tt_weight` decimal(15,3) DEFAULT NULL,
  `tt_rate` decimal(15,3) DEFAULT NULL,
  `tt_brand` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tt_rate_type` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tt_unit_type` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tt_barcode` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tt_total` decimal(15,3) DEFAULT NULL,
  `tt_reorder` decimal(15,3) DEFAULT NULL,
  `tt_current_stock` decimal(15,3) DEFAULT NULL,
  `tt_from_store` int DEFAULT NULL,
  `tt_to_store` int DEFAULT NULL,
  `tt_transfer_login` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tt_transfer_date` datetime DEFAULT NULL,
  `tt_dayclosedate` date DEFAULT NULL,
  `tt_set` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tt_tax` decimal(15,3) DEFAULT NULL,
  `tt_tax_value` decimal(15,3) DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tt_indent` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tt_transfer_from_central` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tt_indent_accepted` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tt_indent_accepted_time` datetime DEFAULT NULL,
  `tt_indent_accepted_login` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tt_direct_grn` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tt_ip` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tt_normal` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tt_normal_accept` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tt_normal_accept_login` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tt_normal_accept_time` datetime DEFAULT NULL,
  `tt_direct_accept` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tt_direct_accept_by` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tt_batch_id` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier_voucher`
--

CREATE TABLE `tbl_supplier_voucher` (
  `branchid` int NOT NULL,
  `sv_id` int NOT NULL,
  `sv_vendor_id` int DEFAULT NULL,
  `sv_date` date DEFAULT NULL,
  `sv_address` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `sv_invoice_no` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `sv_invoice_amount` decimal(15,3) DEFAULT NULL,
  `sv_from` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `sv_paid_amount` decimal(15,3) DEFAULT NULL,
  `sv_credit_amount` decimal(15,3) DEFAULT NULL,
  `sv_entry_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `sv_trn_detail` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `sv_remarks` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `sv_entry_date` date DEFAULT NULL,
  `sv_type_pay` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `sv_discount` decimal(15,3) DEFAULT NULL,
  `sv_pr_return` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `sv_purchase_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `sv_return_amount` decimal(15,3) DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `sv_paid_fully` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `sv_tax` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `sv_subtotal` decimal(15,3) DEFAULT NULL,
  `sv_entry_time` datetime DEFAULT NULL,
  `sv_login` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `sv_from_inventory` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `sv_cloud_added` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `sv_cloud_edited` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sync_log`
--

CREATE TABLE `tbl_sync_log` (
  `id` int NOT NULL,
  `sync_datetime` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `sync_remarks` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tablebill_item_discount`
--

CREATE TABLE `tbl_tablebill_item_discount` (
  `branchid` int NOT NULL,
  `bd_billno` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `bd_billslno` smallint NOT NULL,
  `bd_discount_id` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `bd_menuid` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `bd_discount_of` decimal(8,3) NOT NULL,
  `bd_mode` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `bd_discount_remarks` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `bd_discount` decimal(15,3) NOT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tablebill_paymentchange`
--

CREATE TABLE `tbl_tablebill_paymentchange` (
  `branchid` int NOT NULL,
  `bcp_old_billno` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `bcp_old_branchid` bigint NOT NULL DEFAULT '0',
  `bcp_old_billno_slno` int NOT NULL DEFAULT '0',
  `bcp_old_paymode` int DEFAULT NULL,
  `bcp_old_credit` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `bcp_old_creditmasterid` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `bcp_old_complimentary` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `bcp_old_complimentaryremark` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `bcp_old_amountbalace` decimal(15,2) DEFAULT NULL,
  `bcp_old_transactionamount` decimal(15,2) DEFAULT NULL,
  `bcp_old_amountpaid` decimal(15,2) DEFAULT NULL,
  `bcp_old_transcbank` int DEFAULT NULL,
  `bcp_old_voucherid` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `bcp_old_couponcompany` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `bcp_old_couponamt` decimal(15,2) DEFAULT NULL,
  `bcp_old_chequeno` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `bcp_old_chequebankname` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `bcp_old_chequebankamount` decimal(15,2) DEFAULT NULL,
  `bcp_cancelledby_careof` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `bcp_cancelledreason` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `bcp_cancelledsecret` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `bcp_entrydate` datetime DEFAULT NULL,
  `bcp_cancelledlogin` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tablebill_split`
--

CREATE TABLE `tbl_tablebill_split` (
  `branchid` int NOT NULL,
  `tbs_orderno` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tbs_newbillno` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tbs_billtotal` decimal(15,3) DEFAULT NULL,
  `tbs_modifieddate` datetime DEFAULT NULL,
  `tbs_billstatus` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tabledetails`
--

CREATE TABLE `tbl_tabledetails` (
  `branchid` int NOT NULL,
  `ts_tableid` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ts_tableidprefix` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ts_status` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ts_dineintime` time DEFAULT NULL,
  `ts_noofpersons` tinyint DEFAULT NULL,
  `ts_orderno` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ts_floorid` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ts_orderstaff` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ts_reservetime` time DEFAULT NULL,
  `ts_totalamount` float DEFAULT NULL,
  `ts_entrydate` datetime DEFAULT NULL,
  `ts_interface` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ts_billnumber` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ts_paxcount` int DEFAULT NULL,
  `ts_username` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ts_in_access` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ts_completed_order` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ts_machineid` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tablemaster`
--

CREATE TABLE `tbl_tablemaster` (
  `branchid` int NOT NULL,
  `tr_tableid` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tr_branchid` bigint NOT NULL,
  `tr_floorid` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tr_tableno` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tr_status` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Active',
  `tr_maxchaircount` int NOT NULL,
  `tr_vaccantcount` int NOT NULL DEFAULT '0',
  `tr_nextprefix_ascii` int NOT NULL DEFAULT '65',
  `tr_displayorder` int NOT NULL,
  `tr_max_ascii` int NOT NULL,
  `tr_timealloted` int DEFAULT '0',
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tableorder`
--

CREATE TABLE `tbl_tableorder` (
  `branchid` int NOT NULL,
  `ter_orderno` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ter_slno` int NOT NULL,
  `ter_branchid` bigint NOT NULL,
  `ter_menuid` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ter_rate_type` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ter_unit_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ter_portion` int DEFAULT NULL,
  `ter_unit_weight` decimal(15,5) DEFAULT '0.00000',
  `ter_unit_id` int DEFAULT NULL,
  `ter_base_unit_id` int DEFAULT NULL,
  `ter_base_rate` decimal(15,3) DEFAULT NULL,
  `ter_org_rate` decimal(15,3) NOT NULL DEFAULT '0.000',
  `ter_discount` decimal(15,3) DEFAULT '0.000',
  `ter_rate` decimal(15,3) DEFAULT '0.000',
  `ter_qty` int NOT NULL,
  `ter_total_rate` decimal(15,3) DEFAULT '0.000',
  `ter_status` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ter_preference` int DEFAULT NULL,
  `ter_preferencetext` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ter_orderfrom` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ter_entrydate` date NOT NULL,
  `ter_entrytime` time NOT NULL,
  `ter_entryuser` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ter_esttime` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ter_staff` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ter_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ter_kotno` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '0',
  `ter_billnumber` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ter_feedbackrating` decimal(2,1) NOT NULL DEFAULT '0.0',
  `ter_feedbackremarks` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ter_feedbackenter` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `ter_dayclosedate` date NOT NULL,
  `ter_floorid` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ter_cancel` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'N',
  `ter_cancelledby_careof` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ter_cancelledreason` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ter_cancelledsecretkey` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ter_cancelledlogin` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ter_orderno_temp` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ter_waiter_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ter_kot_canceltime` datetime DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ter_combo_entry_id` int DEFAULT NULL,
  `ter_count_combo_ordering` int DEFAULT NULL,
  `ter_addon_slno` int DEFAULT NULL,
  `ter_new_rate_incl` decimal(15,3) DEFAULT NULL,
  `ter_kot_printed` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ter_cons_printed` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ter_rate_before_comp` decimal(15,3) DEFAULT NULL,
  `ter_item_disc_manual` decimal(15,3) DEFAULT NULL,
  `ter_disc_type` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ter_disc_before` decimal(15,3) DEFAULT NULL,
  `ter_qr_order` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tableorder_changes`
--

CREATE TABLE `tbl_tableorder_changes` (
  `branchid` int NOT NULL,
  `ch_kot_cancel_id` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ch_orderno` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ch_orderslno` int NOT NULL,
  `ch_slno` int NOT NULL,
  `ch_cancelled_qty` int NOT NULL,
  `ch_cancelledby_careof` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ch_entrydate` datetime NOT NULL,
  `ch_kotno` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ch_cancelledreason` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ch_cancelledsecret` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ch_cancelledlogin` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ch_dayclosedate` date DEFAULT NULL,
  `sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `ch_sms` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `ch_email` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'N',
  `ch_sms_time` datetime DEFAULT NULL,
  `ch_email_time` datetime DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ch_combo_pack_cancelled_qty` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_takeaway_cancel_items`
--

CREATE TABLE `tbl_takeaway_cancel_items` (
  `branchid` int NOT NULL,
  `tc_cancel_id` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tc_billno` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tc_bill_slno` int NOT NULL,
  `tc_slno` int NOT NULL,
  `tc_cancel_qty` int DEFAULT NULL,
  `tc_cancelled_by` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tc_cancelled_login` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tc_cancelled_time` datetime DEFAULT NULL,
  `tc_reason` int DEFAULT NULL,
  `tc_cancel_kotno` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tc_dayclosedate` date DEFAULT NULL,
  `tc_mode` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tc_combo_pack_cancelled_qty` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_takeaway_customer`
--

CREATE TABLE `tbl_takeaway_customer` (
  `branchid` int NOT NULL,
  `tac_customerid` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tac_customername` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tac_contactno` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tac_address` varchar(300) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tac_landmark` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tac_area` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tac_remarks` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tac_branchid` bigint DEFAULT NULL,
  `tac_per_address` varchar(300) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tac_takeaway_count` int NOT NULL DEFAULT '1',
  `tac_homedelivery_count` int NOT NULL DEFAULT '1',
  `tac_entrydate` datetime NOT NULL,
  `tac_gst` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tac_def` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tac_del_boy` int DEFAULT NULL,
  `tac_ref_data` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tac_phone_order` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transit_charges`
--

CREATE TABLE `tbl_transit_charges` (
  `transit_id` int NOT NULL,
  `transit_grn_no` varchar(225) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `transit_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `transit_charge` float(10,3) NOT NULL,
  `transit_created` varchar(225) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `transit_updated` varchar(225) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `branchid` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_unit_master`
--

CREATE TABLE `tbl_unit_master` (
  `branchid` int NOT NULL,
  `u_id` int NOT NULL,
  `u_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_unit_master_combination`
--

CREATE TABLE `tbl_unit_master_combination` (
  `branchid` int NOT NULL,
  `um_first_id` int NOT NULL,
  `um_second_id` int NOT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vendor_master`
--

CREATE TABLE `tbl_vendor_master` (
  `branchid` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `v_id` int NOT NULL,
  `v_name` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `v_branchid` bigint DEFAULT NULL,
  `v_address` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `v_city` int DEFAULT NULL,
  `v_state` int DEFAULT NULL,
  `v_country` int DEFAULT NULL,
  `v_email` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `v_contact_no` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `v_open_bal` decimal(15,3) DEFAULT NULL,
  `v_tin_no` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `gst` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `v_srvctax_reg_no` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `v_pan` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `v_bank_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `v_branch_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `v_acct_no` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `v_ifsc` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `v_mode_of_pay` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `v_credit_period` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `v_favour` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `v_conc_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `v_conc_desg` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `v_conc_contact` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `v_conc_email` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `v_active` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `v_entry_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `v_entry_date` date DEFAULT NULL,
  `central_created` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `updated_in_local` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `central_edited` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_version`
--

CREATE TABLE `tbl_version` (
  `branchid` int NOT NULL,
  `pv_current_version` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `pv_date_of_change` date NOT NULL,
  `pv_time_of_change` time NOT NULL,
  `pv_expodine_staff_by` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `pv_apk_ver_name` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `pv_apk_ver_code` int DEFAULT NULL,
  `pve_apk_ver_name` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `pve_apk_ver_code` int DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `payment_overdue` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_version_log`
--

CREATE TABLE `tbl_version_log` (
  `branchid` int NOT NULL,
  `vl_old_version` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `vl_old_date_of change` date NOT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_voucherhead`
--

CREATE TABLE `tbl_voucherhead` (
  `branchid` int NOT NULL,
  `vh_id` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `vh_vouchername` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `vh_active` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `vh_branchid` bigint NOT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_voucherpayment`
--

CREATE TABLE `tbl_voucherpayment` (
  `branchid` int NOT NULL,
  `vp_id` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `vp_vhid` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `vp_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `vp_date` datetime DEFAULT NULL,
  `vp_paymentmode` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `vp_paidto` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `vp_chequebank` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `vp_chequebranch` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `vp_chequeleafno` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `vp_receivedby` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `vp_branchid` bigint DEFAULT NULL,
  `vp_status` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `vp_remarks` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `vp_approveddate` datetime DEFAULT NULL,
  `vp_approvedby` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `vp_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Expense',
  `vp_voucherno` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `vp_add_remark` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `vp_system_ip` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `vp_dayclose_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_voucher_delete_log`
--

CREATE TABLE `tbl_voucher_delete_log` (
  `branchid` int NOT NULL,
  `tvd_id` int NOT NULL,
  `tvd_type` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tvd_data` varchar(5000) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tvd_date` datetime DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tv_cloud_id_deleted` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tv_deleted_local` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wastage`
--

CREATE TABLE `tbl_wastage` (
  `branchid` int NOT NULL,
  `tw_id` int NOT NULL,
  `tw_wastage_id` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tw_product` int DEFAULT NULL,
  `tw_name` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tw_barcode` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tw_qty` decimal(15,3) DEFAULT NULL,
  `tw_weight` decimal(15,3) DEFAULT NULL,
  `tw_rate_type` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tw_unit_type` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tw_rate` decimal(15,3) DEFAULT NULL,
  `tw_total` decimal(15,3) DEFAULT NULL,
  `tw_set` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tw_date` date DEFAULT NULL,
  `tw_login` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tw_store` int DEFAULT NULL,
  `tw_brand` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tw_current_stock` decimal(15,3) DEFAULT NULL,
  `tw_reason` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cloud_sync` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tw_central_return` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tw_item_central_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_accounthead`
--
ALTER TABLE `tbl_accounthead`
  ADD PRIMARY KEY (`branchid`,`ac_accountid`);

--
-- Indexes for table `tbl_account_stock`
--
ALTER TABLE `tbl_account_stock`
  ADD PRIMARY KEY (`branchid`,`tas_id`,`tas_date`);

--
-- Indexes for table `tbl_appmachinedetails`
--
ALTER TABLE `tbl_appmachinedetails`
  ADD PRIMARY KEY (`branchid`,`as_appmachineid`);

--
-- Indexes for table `tbl_bankmaster`
--
ALTER TABLE `tbl_bankmaster`
  ADD PRIMARY KEY (`branchid`,`bm_id`);

--
-- Indexes for table `tbl_base_unit_master`
--
ALTER TABLE `tbl_base_unit_master`
  ADD PRIMARY KEY (`branchid`,`bu_id`);

--
-- Indexes for table `tbl_billdetails`
--
ALTER TABLE `tbl_billdetails`
  ADD PRIMARY KEY (`branchid`,`billno`,`billslno`);

--
-- Indexes for table `tbl_billmaster`
--
ALTER TABLE `tbl_billmaster`
  ADD PRIMARY KEY (`branchid`,`billno`);

--
-- Indexes for table `tbl_bill_card_payments`
--
ALTER TABLE `tbl_bill_card_payments`
  ADD PRIMARY KEY (`branchid`,`mc_id`);

--
-- Indexes for table `tbl_bill_item_discount`
--
ALTER TABLE `tbl_bill_item_discount`
  ADD PRIMARY KEY (`branchid`,`billno`,`billslno`,`discount_id`);

--
-- Indexes for table `tbl_bill_item_tax_details`
--
ALTER TABLE `tbl_bill_item_tax_details`
  ADD PRIMARY KEY (`branchid`,`billno`,`billslno`,`tax_id`,`menuid`);

--
-- Indexes for table `tbl_bill_tax`
--
ALTER TABLE `tbl_bill_tax`
  ADD PRIMARY KEY (`branchid`,`billno`,`taxid`);

--
-- Indexes for table `tbl_cancellation_reasons`
--
ALTER TABLE `tbl_cancellation_reasons`
  ADD PRIMARY KEY (`branchid`,`cr_id`);

--
-- Indexes for table `tbl_cardmaster`
--
ALTER TABLE `tbl_cardmaster`
  ADD PRIMARY KEY (`branchid`,`crd_id`);

--
-- Indexes for table `tbl_central_kitchen_transfer`
--
ALTER TABLE `tbl_central_kitchen_transfer`
  ADD PRIMARY KEY (`branchid`,`tct_id`);

--
-- Indexes for table `tbl_city_master`
--
ALTER TABLE `tbl_city_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_cloud_consumption`
--
ALTER TABLE `tbl_cloud_consumption`
  ADD PRIMARY KEY (`tcc_id`);

--
-- Indexes for table `tbl_cloud_grn_order`
--
ALTER TABLE `tbl_cloud_grn_order`
  ADD PRIMARY KEY (`grn_id`);

--
-- Indexes for table `tbl_cloud_grn_summery`
--
ALTER TABLE `tbl_cloud_grn_summery`
  ADD PRIMARY KEY (`sm_grn_id`);

--
-- Indexes for table `tbl_cloud_menu_data`
--
ALTER TABLE `tbl_cloud_menu_data`
  ADD PRIMARY KEY (`tm_id`);

--
-- Indexes for table `tbl_cloud_menu_detail`
--
ALTER TABLE `tbl_cloud_menu_detail`
  ADD PRIMARY KEY (`branchid`,`tcd_menu_count`);

--
-- Indexes for table `tbl_cloud_physical_stock`
--
ALTER TABLE `tbl_cloud_physical_stock`
  ADD PRIMARY KEY (`tcps_id`);

--
-- Indexes for table `tbl_cloud_purchase_order`
--
ALTER TABLE `tbl_cloud_purchase_order`
  ADD PRIMARY KEY (`tcp_id`);

--
-- Indexes for table `tbl_cloud_purchase_return`
--
ALTER TABLE `tbl_cloud_purchase_return`
  ADD PRIMARY KEY (`tcpr_id`);

--
-- Indexes for table `tbl_cloud_requisition`
--
ALTER TABLE `tbl_cloud_requisition`
  ADD PRIMARY KEY (`tcr_id`);

--
-- Indexes for table `tbl_cloud_store_stock`
--
ALTER TABLE `tbl_cloud_store_stock`
  ADD PRIMARY KEY (`tcs_id`);

--
-- Indexes for table `tbl_cloud_store_transfer`
--
ALTER TABLE `tbl_cloud_store_transfer`
  ADD PRIMARY KEY (`tct_id`);

--
-- Indexes for table `tbl_cloud_wastage`
--
ALTER TABLE `tbl_cloud_wastage`
  ADD PRIMARY KEY (`tcw_id`);

--
-- Indexes for table `tbl_combo_bill_details`
--
ALTER TABLE `tbl_combo_bill_details`
  ADD PRIMARY KEY (`branchid`,`cbd_billno`,`cbd_billslno`);

--
-- Indexes for table `tbl_combo_bill_details_ta`
--
ALTER TABLE `tbl_combo_bill_details_ta`
  ADD PRIMARY KEY (`branchid`,`cbd_id`);

--
-- Indexes for table `tbl_combo_menu_labels`
--
ALTER TABLE `tbl_combo_menu_labels`
  ADD PRIMARY KEY (`branchid`,`cml_id`);

--
-- Indexes for table `tbl_combo_name`
--
ALTER TABLE `tbl_combo_name`
  ADD PRIMARY KEY (`cn_id`);

--
-- Indexes for table `tbl_combo_ordering_details`
--
ALTER TABLE `tbl_combo_ordering_details`
  ADD PRIMARY KEY (`branchid`,`cod_id`);

--
-- Indexes for table `tbl_combo_packs`
--
ALTER TABLE `tbl_combo_packs`
  ADD PRIMARY KEY (`cp_id`);

--
-- Indexes for table `tbl_combo_pack_menus`
--
ALTER TABLE `tbl_combo_pack_menus`
  ADD PRIMARY KEY (`branchid`,`cpm_id`);

--
-- Indexes for table `tbl_combo_pack_rates`
--
ALTER TABLE `tbl_combo_pack_rates`
  ADD PRIMARY KEY (`branchid`,`cpr_id`);

--
-- Indexes for table `tbl_combo_stock`
--
ALTER TABLE `tbl_combo_stock`
  ADD PRIMARY KEY (`branchid`,`cs_id`);

--
-- Indexes for table `tbl_combo_type`
--
ALTER TABLE `tbl_combo_type`
  ADD PRIMARY KEY (`branchid`,`ct_id`);

--
-- Indexes for table `tbl_complementory_reasons`
--
ALTER TABLE `tbl_complementory_reasons`
  ADD PRIMARY KEY (`branchid`,`id`);

--
-- Indexes for table `tbl_consumption`
--
ALTER TABLE `tbl_consumption`
  ADD PRIMARY KEY (`branchid`,`tc_id`);

--
-- Indexes for table `tbl_contra_voucher`
--
ALTER TABLE `tbl_contra_voucher`
  ADD PRIMARY KEY (`branchid`,`cv_id`);

--
-- Indexes for table `tbl_corporatemaster`
--
ALTER TABLE `tbl_corporatemaster`
  ADD PRIMARY KEY (`branchid`,`ct_corporatecode`);

--
-- Indexes for table `tbl_country_master`
--
ALTER TABLE `tbl_country_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_couponcompany`
--
ALTER TABLE `tbl_couponcompany`
  ADD PRIMARY KEY (`branchid`,`cy_coupid`);

--
-- Indexes for table `tbl_credit_details`
--
ALTER TABLE `tbl_credit_details`
  ADD PRIMARY KEY (`branchid`,`cd_slno`);

--
-- Indexes for table `tbl_credit_details_payment`
--
ALTER TABLE `tbl_credit_details_payment`
  ADD PRIMARY KEY (`branchid`,`cdp_master_id`,`cdp_dayclosedate`,`cdp_slno`);

--
-- Indexes for table `tbl_credit_master`
--
ALTER TABLE `tbl_credit_master`
  ADD PRIMARY KEY (`branchid`,`crd_id`);

--
-- Indexes for table `tbl_credit_types`
--
ALTER TABLE `tbl_credit_types`
  ADD PRIMARY KEY (`branchid`,`ct_creditid`);

--
-- Indexes for table `tbl_currency_conv_rate`
--
ALTER TABLE `tbl_currency_conv_rate`
  ADD PRIMARY KEY (`branchid`,`cc_base_currency`,`cc_currency`);

--
-- Indexes for table `tbl_currency_master`
--
ALTER TABLE `tbl_currency_master`
  ADD PRIMARY KEY (`branchid`,`c_id`);

--
-- Indexes for table `tbl_dayclose`
--
ALTER TABLE `tbl_dayclose`
  ADD PRIMARY KEY (`branchid`,`dc_day`);

--
-- Indexes for table `tbl_delivery_status`
--
ALTER TABLE `tbl_delivery_status`
  ADD PRIMARY KEY (`branchid`,`ds_id`);

--
-- Indexes for table `tbl_denomination_master`
--
ALTER TABLE `tbl_denomination_master`
  ADD PRIMARY KEY (`branchid`,`dm_id`);

--
-- Indexes for table `tbl_departmentmaster`
--
ALTER TABLE `tbl_departmentmaster`
  ADD PRIMARY KEY (`branchid`,`der_departmentid`);

--
-- Indexes for table `tbl_designationmaster`
--
ALTER TABLE `tbl_designationmaster`
  ADD PRIMARY KEY (`branchid`,`dr_designationid`);

--
-- Indexes for table `tbl_discountmaster`
--
ALTER TABLE `tbl_discountmaster`
  ADD PRIMARY KEY (`branchid`,`ds_discountid`);

--
-- Indexes for table `tbl_employee_voucher`
--
ALTER TABLE `tbl_employee_voucher`
  ADD PRIMARY KEY (`branchid`,`ev_id`);

--
-- Indexes for table `tbl_expense_voucher`
--
ALTER TABLE `tbl_expense_voucher`
  ADD PRIMARY KEY (`branchid`,`ev_id`);

--
-- Indexes for table `tbl_expodine_machines`
--
ALTER TABLE `tbl_expodine_machines`
  ADD PRIMARY KEY (`branchid`,`cm_id`);

--
-- Indexes for table `tbl_extra_tax_master`
--
ALTER TABLE `tbl_extra_tax_master`
  ADD PRIMARY KEY (`branchid`,`amc_id`);

--
-- Indexes for table `tbl_feedbackmaster`
--
ALTER TABLE `tbl_feedbackmaster`
  ADD PRIMARY KEY (`branchid`,`fbm_id`);

--
-- Indexes for table `tbl_feedbackrating`
--
ALTER TABLE `tbl_feedbackrating`
  ADD PRIMARY KEY (`branchid`,`fbr_id`);

--
-- Indexes for table `tbl_feedbackratingcount`
--
ALTER TABLE `tbl_feedbackratingcount`
  ADD PRIMARY KEY (`branchid`,`frc_menuid`);

--
-- Indexes for table `tbl_floormaster`
--
ALTER TABLE `tbl_floormaster`
  ADD PRIMARY KEY (`branchid`,`fr_floorid`);

--
-- Indexes for table `tbl_floor_tax`
--
ALTER TABLE `tbl_floor_tax`
  ADD PRIMARY KEY (`branchid`,`ft_floorid`,`ft_tax_id`);

--
-- Indexes for table `tbl_food_cost`
--
ALTER TABLE `tbl_food_cost`
  ADD PRIMARY KEY (`branchid`,`tfc_id`);

--
-- Indexes for table `tbl_function_details`
--
ALTER TABLE `tbl_function_details`
  ADD PRIMARY KEY (`branchid`,`fd_id`);

--
-- Indexes for table `tbl_function_details_menu`
--
ALTER TABLE `tbl_function_details_menu`
  ADD PRIMARY KEY (`branchid`,`fdm_function_id`,`fdm_slno`);

--
-- Indexes for table `tbl_function_extra_costs`
--
ALTER TABLE `tbl_function_extra_costs`
  ADD PRIMARY KEY (`branchid`,`fec_id`);

--
-- Indexes for table `tbl_function_invoice`
--
ALTER TABLE `tbl_function_invoice`
  ADD PRIMARY KEY (`branchid`,`fi_invoice_no`);

--
-- Indexes for table `tbl_function_invoice_extras`
--
ALTER TABLE `tbl_function_invoice_extras`
  ADD PRIMARY KEY (`branchid`,`fi_invoice_no`,`fi_slno`);

--
-- Indexes for table `tbl_function_type`
--
ALTER TABLE `tbl_function_type`
  ADD PRIMARY KEY (`branchid`,`ft_id`);

--
-- Indexes for table `tbl_function_venue`
--
ALTER TABLE `tbl_function_venue`
  ADD PRIMARY KEY (`branchid`,`fv_id`);

--
-- Indexes for table `tbl_grn_order`
--
ALTER TABLE `tbl_grn_order`
  ADD PRIMARY KEY (`branchid`,`tg_id`);

--
-- Indexes for table `tbl_grn_summary`
--
ALTER TABLE `tbl_grn_summary`
  ADD PRIMARY KEY (`branchid`,`tgs_id`);

--
-- Indexes for table `tbl_ingredientmaster`
--
ALTER TABLE `tbl_ingredientmaster`
  ADD PRIMARY KEY (`branchid`,`ir_ingredientid`);

--
-- Indexes for table `tbl_inv_kitchen`
--
ALTER TABLE `tbl_inv_kitchen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_inv_settings`
--
ALTER TABLE `tbl_inv_settings`
  ADD PRIMARY KEY (`branchid`,`ti_id`);

--
-- Indexes for table `tbl_kotcountermaster`
--
ALTER TABLE `tbl_kotcountermaster`
  ADD PRIMARY KEY (`branchid`,`kr_kotcode`);

--
-- Indexes for table `tbl_kotmaster`
--
ALTER TABLE `tbl_kotmaster`
  ADD PRIMARY KEY (`branchid`,`kr_date`,`kr_kotno`);

--
-- Indexes for table `tbl_languages`
--
ALTER TABLE `tbl_languages`
  ADD PRIMARY KEY (`branchid`,`ls_id`);

--
-- Indexes for table `tbl_ledger_group`
--
ALTER TABLE `tbl_ledger_group`
  ADD PRIMARY KEY (`branchid`,`tlg_id`);

--
-- Indexes for table `tbl_ledger_master`
--
ALTER TABLE `tbl_ledger_master`
  ADD PRIMARY KEY (`branchid`,`tlm_id`);

--
-- Indexes for table `tbl_logindetails`
--
ALTER TABLE `tbl_logindetails`
  ADD PRIMARY KEY (`branchid`,`ls_username`);

--
-- Indexes for table `tbl_login_restrict_logs`
--
ALTER TABLE `tbl_login_restrict_logs`
  ADD PRIMARY KEY (`branchid`,`r_id`);

--
-- Indexes for table `tbl_loyalty_campaign`
--
ALTER TABLE `tbl_loyalty_campaign`
  ADD PRIMARY KEY (`branchid`,`lc_id`);

--
-- Indexes for table `tbl_loyalty_campaign_group`
--
ALTER TABLE `tbl_loyalty_campaign_group`
  ADD PRIMARY KEY (`branchid`,`gp_id`);

--
-- Indexes for table `tbl_loyalty_discount`
--
ALTER TABLE `tbl_loyalty_discount`
  ADD PRIMARY KEY (`branchid`,`ld_visitcount`);

--
-- Indexes for table `tbl_loyalty_group_details`
--
ALTER TABLE `tbl_loyalty_group_details`
  ADD PRIMARY KEY (`branchid`,`tgp_id`);

--
-- Indexes for table `tbl_loyalty_levels`
--
ALTER TABLE `tbl_loyalty_levels`
  ADD PRIMARY KEY (`branchid`,`ll_id`);

--
-- Indexes for table `tbl_loyalty_pointadd_bill`
--
ALTER TABLE `tbl_loyalty_pointadd_bill`
  ADD PRIMARY KEY (`branchid`,`lob_id`);

--
-- Indexes for table `tbl_loyalty_pointrule`
--
ALTER TABLE `tbl_loyalty_pointrule`
  ADD PRIMARY KEY (`branchid`,`lyp_id`);

--
-- Indexes for table `tbl_loyalty_point_transfers`
--
ALTER TABLE `tbl_loyalty_point_transfers`
  ADD PRIMARY KEY (`branchid`,`lpt_id`);

--
-- Indexes for table `tbl_loyalty_redeem_rule`
--
ALTER TABLE `tbl_loyalty_redeem_rule`
  ADD PRIMARY KEY (`branchid`,`lyr_id`);

--
-- Indexes for table `tbl_loyalty_reg`
--
ALTER TABLE `tbl_loyalty_reg`
  ADD PRIMARY KEY (`branchid`,`ly_id`);

--
-- Indexes for table `tbl_loyalty_rules`
--
ALTER TABLE `tbl_loyalty_rules`
  ADD PRIMARY KEY (`branchid`,`lr_id`);

--
-- Indexes for table `tbl_loyalty_rules_type`
--
ALTER TABLE `tbl_loyalty_rules_type`
  ADD PRIMARY KEY (`branchid`,`lrt_id`);

--
-- Indexes for table `tbl_loyalty_sendto`
--
ALTER TABLE `tbl_loyalty_sendto`
  ADD PRIMARY KEY (`branchid`,`ls_id`);

--
-- Indexes for table `tbl_loyalty_sms_source`
--
ALTER TABLE `tbl_loyalty_sms_source`
  ADD PRIMARY KEY (`branchid`,`ls_id`);

--
-- Indexes for table `tbl_loyalty_voucher`
--
ALTER TABLE `tbl_loyalty_voucher`
  ADD PRIMARY KEY (`branchid`,`vr_voucherid`);

--
-- Indexes for table `tbl_menuimages`
--
ALTER TABLE `tbl_menuimages`
  ADD PRIMARY KEY (`mes_imagename`);

--
-- Indexes for table `tbl_menumaincategory`
--
ALTER TABLE `tbl_menumaincategory`
  ADD PRIMARY KEY (`branchid`,`mmy_maincategoryid`);

--
-- Indexes for table `tbl_menumaster`
--
ALTER TABLE `tbl_menumaster`
  ADD PRIMARY KEY (`branchid`,`mr_menuid`,`mr_central_menu`);

--
-- Indexes for table `tbl_menuratemaster`
--
ALTER TABLE `tbl_menuratemaster`
  ADD PRIMARY KEY (`mmr_id`);

--
-- Indexes for table `tbl_menuratetakeaway`
--
ALTER TABLE `tbl_menuratetakeaway`
  ADD PRIMARY KEY (`mta_id`);

--
-- Indexes for table `tbl_menurate_counter`
--
ALTER TABLE `tbl_menurate_counter`
  ADD PRIMARY KEY (`mrc_id`);

--
-- Indexes for table `tbl_menurate_roomservice`
--
ALTER TABLE `tbl_menurate_roomservice`
  ADD PRIMARY KEY (`branchid`,`mrs_menuid`,`mrs_portion`,`mrs_branchid`);

--
-- Indexes for table `tbl_menustock`
--
ALTER TABLE `tbl_menustock`
  ADD PRIMARY KEY (`branchid`,`mk_id`);

--
-- Indexes for table `tbl_menusubcategory`
--
ALTER TABLE `tbl_menusubcategory`
  ADD PRIMARY KEY (`branchid`,`msy_subcategoryid`);

--
-- Indexes for table `tbl_menu_addons`
--
ALTER TABLE `tbl_menu_addons`
  ADD PRIMARY KEY (`branchid`,`ma_menuid`,`ma_addon_menuid`);

--
-- Indexes for table `tbl_menu_discount`
--
ALTER TABLE `tbl_menu_discount`
  ADD PRIMARY KEY (`branchid`,`md_menuid`,`md_slno`);

--
-- Indexes for table `tbl_menu_ingredient_detail`
--
ALTER TABLE `tbl_menu_ingredient_detail`
  ADD PRIMARY KEY (`branchid`,`tmi_id`);

--
-- Indexes for table `tbl_menu_tax_master`
--
ALTER TABLE `tbl_menu_tax_master`
  ADD PRIMARY KEY (`branchid`,`mtm_menuid`,`mtm_slno`,`mtm_tax_id`);

--
-- Indexes for table `tbl_online_billdetails`
--
ALTER TABLE `tbl_online_billdetails`
  ADD PRIMARY KEY (`branchid`,`tab_billno`,`tab_slno`);

--
-- Indexes for table `tbl_online_billmaster`
--
ALTER TABLE `tbl_online_billmaster`
  ADD PRIMARY KEY (`branchid`,`on_billno`);

--
-- Indexes for table `tbl_online_order`
--
ALTER TABLE `tbl_online_order`
  ADD PRIMARY KEY (`branchid`,`tol_id`);

--
-- Indexes for table `tbl_online_tax`
--
ALTER TABLE `tbl_online_tax`
  ADD PRIMARY KEY (`tox_id`);

--
-- Indexes for table `tbl_order_addon`
--
ALTER TABLE `tbl_order_addon`
  ADD PRIMARY KEY (`branchid`,`ad_orderno`,`ad_order_slno`,`ad_addon_menu`);

--
-- Indexes for table `tbl_order_addon_changes`
--
ALTER TABLE `tbl_order_addon_changes`
  ADD PRIMARY KEY (`branchid`,`adc_cancel_id`,`adc_cancel_orderno`,`adc_cancel_order_slno`,`adc_cancel_menu`);

--
-- Indexes for table `tbl_paymentmode`
--
ALTER TABLE `tbl_paymentmode`
  ADD PRIMARY KEY (`branchid`,`pym_id`);

--
-- Indexes for table `tbl_physical_stock`
--
ALTER TABLE `tbl_physical_stock`
  ADD PRIMARY KEY (`branchid`,`tps_id`);

--
-- Indexes for table `tbl_portionmaster`
--
ALTER TABLE `tbl_portionmaster`
  ADD PRIMARY KEY (`branchid`,`pm_id`);

--
-- Indexes for table `tbl_preferencemaster`
--
ALTER TABLE `tbl_preferencemaster`
  ADD PRIMARY KEY (`branchid`,`pmr_id`);

--
-- Indexes for table `tbl_production`
--
ALTER TABLE `tbl_production`
  ADD PRIMARY KEY (`branchid`,`tp_id`);

--
-- Indexes for table `tbl_product_conversion`
--
ALTER TABLE `tbl_product_conversion`
  ADD PRIMARY KEY (`branchid`,`tpc_id`);

--
-- Indexes for table `tbl_purchase_order`
--
ALTER TABLE `tbl_purchase_order`
  ADD PRIMARY KEY (`branchid`,`tp_id`);

--
-- Indexes for table `tbl_purchase_return`
--
ALTER TABLE `tbl_purchase_return`
  ADD PRIMARY KEY (`branchid`,`tpr_id`);

--
-- Indexes for table `tbl_qr_order_details`
--
ALTER TABLE `tbl_qr_order_details`
  ADD PRIMARY KEY (`tq_id`);

--
-- Indexes for table `tbl_qr_order_item`
--
ALTER TABLE `tbl_qr_order_item`
  ADD PRIMARY KEY (`tqi_id`);

--
-- Indexes for table `tbl_qr_pincodes`
--
ALTER TABLE `tbl_qr_pincodes`
  ADD PRIMARY KEY (`tqp_id`);

--
-- Indexes for table `tbl_qr_user_detail`
--
ALTER TABLE `tbl_qr_user_detail`
  ADD PRIMARY KEY (`tu_id`);

--
-- Indexes for table `tbl_receipts`
--
ALTER TABLE `tbl_receipts`
  ADD PRIMARY KEY (`branchid`,`tr_id`,`tr_date`);

--
-- Indexes for table `tbl_regenerate_reasons`
--
ALTER TABLE `tbl_regenerate_reasons`
  ADD PRIMARY KEY (`branchid`,`rr_id`);

--
-- Indexes for table `tbl_regenrate_log`
--
ALTER TABLE `tbl_regenrate_log`
  ADD PRIMARY KEY (`branchid`,`re_id`);

--
-- Indexes for table `tbl_requisition`
--
ALTER TABLE `tbl_requisition`
  ADD PRIMARY KEY (`branchid`,`tr_id`);

--
-- Indexes for table `tbl_return_payment`
--
ALTER TABLE `tbl_return_payment`
  ADD PRIMARY KEY (`branchid`,`tr_id`,`tr_date`);

--
-- Indexes for table `tbl_roommaster`
--
ALTER TABLE `tbl_roommaster`
  ADD PRIMARY KEY (`branchid`,`rm_roomid`);

--
-- Indexes for table `tbl_shift_card_detail_close`
--
ALTER TABLE `tbl_shift_card_detail_close`
  ADD PRIMARY KEY (`branchid`,`sb_shiftdate_close`,`sb_shiftid_close`,`sb_bankid_close`);

--
-- Indexes for table `tbl_shift_card_detail_open`
--
ALTER TABLE `tbl_shift_card_detail_open`
  ADD PRIMARY KEY (`branchid`,`sb_shiftdate`,`sb_shiftid`,`sb_bankid`);

--
-- Indexes for table `tbl_shift_close_denomination`
--
ALTER TABLE `tbl_shift_close_denomination`
  ADD PRIMARY KEY (`branchid`,`dod_day`,`dod_shidt_slno`,`dod_deno_id`);

--
-- Indexes for table `tbl_shift_details`
--
ALTER TABLE `tbl_shift_details`
  ADD PRIMARY KEY (`branchid`,`sd_day`,`sd_id`);

--
-- Indexes for table `tbl_shift_open_denomination`
--
ALTER TABLE `tbl_shift_open_denomination`
  ADD PRIMARY KEY (`branchid`,`dod_day`,`dod_shidt_slno`,`dod_deno_id`);

--
-- Indexes for table `tbl_staffmaster`
--
ALTER TABLE `tbl_staffmaster`
  ADD PRIMARY KEY (`branchid`,`ser_staffid`);

--
-- Indexes for table `tbl_state_master`
--
ALTER TABLE `tbl_state_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_stock_details`
--
ALTER TABLE `tbl_stock_details`
  ADD PRIMARY KEY (`branchid`,`sd_id`);

--
-- Indexes for table `tbl_store_stock`
--
ALTER TABLE `tbl_store_stock`
  ADD PRIMARY KEY (`branchid`,`ts_id`);

--
-- Indexes for table `tbl_store_transfer`
--
ALTER TABLE `tbl_store_transfer`
  ADD PRIMARY KEY (`branchid`,`tt_id`);

--
-- Indexes for table `tbl_supplier_voucher`
--
ALTER TABLE `tbl_supplier_voucher`
  ADD PRIMARY KEY (`branchid`,`sv_id`);

--
-- Indexes for table `tbl_sync_log`
--
ALTER TABLE `tbl_sync_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_tablebill_item_discount`
--
ALTER TABLE `tbl_tablebill_item_discount`
  ADD PRIMARY KEY (`branchid`,`bd_billno`,`bd_billslno`,`bd_discount_id`);

--
-- Indexes for table `tbl_tablebill_paymentchange`
--
ALTER TABLE `tbl_tablebill_paymentchange`
  ADD PRIMARY KEY (`branchid`,`bcp_old_billno`,`bcp_old_branchid`,`bcp_old_billno_slno`);

--
-- Indexes for table `tbl_tablebill_split`
--
ALTER TABLE `tbl_tablebill_split`
  ADD PRIMARY KEY (`branchid`,`tbs_orderno`,`tbs_newbillno`);

--
-- Indexes for table `tbl_tabledetails`
--
ALTER TABLE `tbl_tabledetails`
  ADD PRIMARY KEY (`branchid`,`ts_tableid`,`ts_tableidprefix`);

--
-- Indexes for table `tbl_tablemaster`
--
ALTER TABLE `tbl_tablemaster`
  ADD PRIMARY KEY (`branchid`,`tr_tableid`);

--
-- Indexes for table `tbl_tableorder`
--
ALTER TABLE `tbl_tableorder`
  ADD PRIMARY KEY (`branchid`,`ter_orderno`,`ter_slno`);

--
-- Indexes for table `tbl_tableorder_changes`
--
ALTER TABLE `tbl_tableorder_changes`
  ADD PRIMARY KEY (`branchid`,`ch_kot_cancel_id`,`ch_orderno`,`ch_orderslno`,`ch_slno`);

--
-- Indexes for table `tbl_takeaway_cancel_items`
--
ALTER TABLE `tbl_takeaway_cancel_items`
  ADD PRIMARY KEY (`branchid`,`tc_cancel_id`,`tc_billno`,`tc_bill_slno`,`tc_slno`);

--
-- Indexes for table `tbl_takeaway_customer`
--
ALTER TABLE `tbl_takeaway_customer`
  ADD PRIMARY KEY (`branchid`,`tac_customerid`);

--
-- Indexes for table `tbl_transit_charges`
--
ALTER TABLE `tbl_transit_charges`
  ADD PRIMARY KEY (`transit_id`);

--
-- Indexes for table `tbl_unit_master`
--
ALTER TABLE `tbl_unit_master`
  ADD PRIMARY KEY (`branchid`,`u_id`);

--
-- Indexes for table `tbl_unit_master_combination`
--
ALTER TABLE `tbl_unit_master_combination`
  ADD PRIMARY KEY (`branchid`,`um_first_id`,`um_second_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_vendor_master`
--
ALTER TABLE `tbl_vendor_master`
  ADD PRIMARY KEY (`branchid`,`v_id`);

--
-- Indexes for table `tbl_version`
--
ALTER TABLE `tbl_version`
  ADD PRIMARY KEY (`branchid`,`pv_current_version`);

--
-- Indexes for table `tbl_version_log`
--
ALTER TABLE `tbl_version_log`
  ADD PRIMARY KEY (`branchid`,`vl_old_version`);

--
-- Indexes for table `tbl_voucherhead`
--
ALTER TABLE `tbl_voucherhead`
  ADD PRIMARY KEY (`branchid`,`vh_id`);

--
-- Indexes for table `tbl_voucherpayment`
--
ALTER TABLE `tbl_voucherpayment`
  ADD PRIMARY KEY (`branchid`,`vp_id`);

--
-- Indexes for table `tbl_voucher_delete_log`
--
ALTER TABLE `tbl_voucher_delete_log`
  ADD PRIMARY KEY (`branchid`,`tv_cloud_id_deleted`);

--
-- Indexes for table `tbl_wastage`
--
ALTER TABLE `tbl_wastage`
  ADD PRIMARY KEY (`branchid`,`tw_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_city_master`
--
ALTER TABLE `tbl_city_master`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_cloud_consumption`
--
ALTER TABLE `tbl_cloud_consumption`
  MODIFY `tcc_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_cloud_grn_order`
--
ALTER TABLE `tbl_cloud_grn_order`
  MODIFY `grn_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_cloud_grn_summery`
--
ALTER TABLE `tbl_cloud_grn_summery`
  MODIFY `sm_grn_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_cloud_menu_data`
--
ALTER TABLE `tbl_cloud_menu_data`
  MODIFY `tm_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_cloud_physical_stock`
--
ALTER TABLE `tbl_cloud_physical_stock`
  MODIFY `tcps_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_cloud_purchase_order`
--
ALTER TABLE `tbl_cloud_purchase_order`
  MODIFY `tcp_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_cloud_purchase_return`
--
ALTER TABLE `tbl_cloud_purchase_return`
  MODIFY `tcpr_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_cloud_requisition`
--
ALTER TABLE `tbl_cloud_requisition`
  MODIFY `tcr_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_cloud_store_stock`
--
ALTER TABLE `tbl_cloud_store_stock`
  MODIFY `tcs_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_cloud_store_transfer`
--
ALTER TABLE `tbl_cloud_store_transfer`
  MODIFY `tct_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_cloud_wastage`
--
ALTER TABLE `tbl_cloud_wastage`
  MODIFY `tcw_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_combo_name`
--
ALTER TABLE `tbl_combo_name`
  MODIFY `cn_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_combo_packs`
--
ALTER TABLE `tbl_combo_packs`
  MODIFY `cp_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_country_master`
--
ALTER TABLE `tbl_country_master`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_inv_kitchen`
--
ALTER TABLE `tbl_inv_kitchen`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_loyalty_pointadd_bill`
--
ALTER TABLE `tbl_loyalty_pointadd_bill`
  MODIFY `lob_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_loyalty_pointrule`
--
ALTER TABLE `tbl_loyalty_pointrule`
  MODIFY `lyp_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_loyalty_redeem_rule`
--
ALTER TABLE `tbl_loyalty_redeem_rule`
  MODIFY `lyr_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_loyalty_sms_source`
--
ALTER TABLE `tbl_loyalty_sms_source`
  MODIFY `ls_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_menuratemaster`
--
ALTER TABLE `tbl_menuratemaster`
  MODIFY `mmr_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_menuratetakeaway`
--
ALTER TABLE `tbl_menuratetakeaway`
  MODIFY `mta_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_menurate_counter`
--
ALTER TABLE `tbl_menurate_counter`
  MODIFY `mrc_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_online_order`
--
ALTER TABLE `tbl_online_order`
  MODIFY `tol_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_qr_order_details`
--
ALTER TABLE `tbl_qr_order_details`
  MODIFY `tq_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_qr_order_item`
--
ALTER TABLE `tbl_qr_order_item`
  MODIFY `tqi_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_qr_pincodes`
--
ALTER TABLE `tbl_qr_pincodes`
  MODIFY `tqp_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_qr_user_detail`
--
ALTER TABLE `tbl_qr_user_detail`
  MODIFY `tu_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_state_master`
--
ALTER TABLE `tbl_state_master`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_sync_log`
--
ALTER TABLE `tbl_sync_log`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_transit_charges`
--
ALTER TABLE `tbl_transit_charges`
  MODIFY `transit_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
