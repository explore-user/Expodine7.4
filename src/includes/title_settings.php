<?php
error_reporting(0);
// title settings

$sql_table_nos = "select * from tbl_languages  where ls_status='Y'";
$sql_table = $database->mysqlQuery($sql_table_nos);
$num_table = $database->mysqlNumRows($sql_table);
if ($num_table) {
    while ($result_table = $database->mysqlFetchArray($sql_table)) {
        $_SESSION['main_language'] = $result_table['ls_language'];
    }
}

if ($_SESSION['main_language_login'] != '') {
    $_SESSION['main_language'] = $_SESSION['main_language_login'];
}
//main_pages.xml
$xml = simplexml_load_file("xml/main_pages.xml") or die("Error: Cannot create object");
//if(!isset($_SESSION['login_submitbutton'])) //*********after completion, please uncomment this condition
//{
foreach ($xml->children() as $lang) {
    if ($lang->number['lang'] == $_SESSION['main_language']) {
        $_SESSION['main_language_array'] = (int) trim($lang->number);
    }
}
$_SESSION['login_submitbutton'] = (string) $xml->login[$_SESSION['main_language_array']]->submitbutton;
$_SESSION['login_alert_info'] = (string) $xml->login[$_SESSION['main_language_array']]->alert_info;
$_SESSION['login_alert_info_pin'] = (string) $xml->login[$_SESSION['main_language_array']]->alert_info_pin;
$_SESSION['error_logout'] = (string) $xml->error[$_SESSION['main_language_array']]->logout;
$_SESSION['error_invalid'] = (string) $xml->error[$_SESSION['main_language_array']]->invalid;
$_SESSION['error_invalid_pin'] = (string) $xml->error[$_SESSION['main_language_array']]->invalid_pin;
$_SESSION['error_invalid_pin_login'] = (string) $xml->error[$_SESSION['main_language_array']]->invalid_pin_login;
$_SESSION['error_sorry'] = (string) $xml->error[$_SESSION['main_language_array']]->sorry;
$_SESSION['placeholder_username'] = (string) $xml->placeholder[$_SESSION['main_language_array']]->username;
$_SESSION['placeholder_password'] = (string) $xml->placeholder[$_SESSION['main_language_array']]->password;

$_SESSION['status_msg_closed'] = (string) $xml->status_msg[$_SESSION['main_language_array']]->closed;
$_SESSION['status_msg_cancelled'] = (string) $xml->status_msg[$_SESSION['main_language_array']]->cancelled;
$_SESSION['status_msg_billed'] = (string) $xml->status_msg[$_SESSION['main_language_array']]->billed;

//procedures
$_SESSION['procedures_proc_bill_regenerate'] = (string) $xml->procedures[$_SESSION['main_language_array']]->proc_bill_regenerate;
$_SESSION['procedures_proc_billclose_null'] = (string) $xml->procedures[$_SESSION['main_language_array']]->proc_billclose_null;
$_SESSION['procedures_proc_billclose_closed'] = (string) $xml->procedures[$_SESSION['main_language_array']]->proc_billclose_closed;
$_SESSION['procedures_proc_billgenerate_split'] = (string) $xml->procedures[$_SESSION['main_language_array']]->proc_billgenerate_split;
$_SESSION['procedures_proc_billpayment_change'] = (string) $xml->procedures[$_SESSION['main_language_array']]->proc_billpayment_change;
$_SESSION['procedures_proc_copyfloorrate'] = (string) $xml->procedures[$_SESSION['main_language_array']]->proc_copyfloorrate;
$_SESSION['procedures_proc_dayend_closeok'] = (string) $xml->procedures[$_SESSION['main_language_array']]->proc_dayend_closeok;
$_SESSION['procedures_proc_dayend_error'] = (string) $xml->procedures[$_SESSION['main_language_array']]->proc_dayend_error;
$_SESSION['procedures_proc_daystart_inok'] = (string) $xml->procedures[$_SESSION['main_language_array']]->proc_daystart_inok;
$_SESSION['procedures_proc_daystart_error'] = (string) $xml->procedures[$_SESSION['main_language_array']]->proc_daystart_error;
$_SESSION['procedures_proc_rate_copytotakeaway'] = (string) $xml->procedures[$_SESSION['main_language_array']]->proc_rate_copytotakeaway;
$_SESSION['procedures_proc_ratechange'] = (string) $xml->procedures[$_SESSION['main_language_array']]->proc_ratechange;
$_SESSION['procedures_proc_tablechange_changed'] = (string) $xml->procedures[$_SESSION['main_language_array']]->proc_tablechange_changed;
$_SESSION['procedures_proc_tablechange_parcel'] = (string) $xml->procedures[$_SESSION['main_language_array']]->proc_tablechange_parcel;
$_SESSION['procedures_proc_tableorder_update_sucess'] = (string) $xml->procedures[$_SESSION['main_language_array']]->proc_tableorder_update_sucess;
$_SESSION['procedures_proc_tableorder_update_already'] = (string) $xml->procedures[$_SESSION['main_language_array']]->proc_tableorder_update_already;
$_SESSION['procedures_proc_tableordernentry_updated'] = (string) $xml->procedures[$_SESSION['main_language_array']]->proc_tableordernentry_updated;
$_SESSION['procedures_proc_tableordernentry_success'] = (string) $xml->procedures[$_SESSION['main_language_array']]->proc_tableordernentry_success;
$_SESSION['procedures_proc_tableordernentry_rate'] = (string) $xml->procedures[$_SESSION['main_language_array']]->proc_tableordernentry_rate;
$_SESSION['procedures_proc_tableordernentry_billed'] = (string) $xml->procedures[$_SESSION['main_language_array']]->proc_tableordernentry_billed;
$_SESSION['procedures_proc_billgenerate_error'] = (string) $xml->procedures[$_SESSION['main_language_array']]->proc_billgenerate_error;
$_SESSION['procedures_proc_billgenerate_pend'] = (string) $xml->procedures[$_SESSION['main_language_array']]->proc_billgenerate_pend;
$_SESSION['procedures_proc_billgenerate_bill'] = (string) $xml->procedures[$_SESSION['main_language_array']]->proc_billgenerate_bill;

//index page
//$_SESSION['home_super_admin']		                    =(string)$xml->home[$_SESSION['main_language_array']]->super_admin;
//$_SESSION['home_change_password']		                =(string)$xml->home[$_SESSION['main_language_array']]->change_password;
//$_SESSION['home_logout']		                        =(string)$xml->home[$_SESSION['main_language_array']]->logout;
$_SESSION['sale_open_new'] = (string) $xml->home[$_SESSION['main_language_array']]->sale_open_new;
$_SESSION['home_dashboard'] = (string) $xml->home[$_SESSION['main_language_array']]->dashboard;
$_SESSION['home_day_open'] = (string) $xml->home[$_SESSION['main_language_array']]->day_open;
$_SESSION['home_day_close'] = (string) $xml->home[$_SESSION['main_language_array']]->day_close;
$_SESSION['home_open_date'] = (string) $xml->home[$_SESSION['main_language_array']]->open_date;
$_SESSION['home_open_time'] = (string) $xml->home[$_SESSION['main_language_array']]->open_time;
$_SESSION['home_close_date'] = (string) $xml->home[$_SESSION['main_language_array']]->close_date;
$_SESSION['home_close_time'] = (string) $xml->home[$_SESSION['main_language_array']]->close_time;
$_SESSION['home_updatebutton'] = (string) $xml->home[$_SESSION['main_language_array']]->updatebutton; 
$_SESSION['home_menus'] = (string) $xml->home[$_SESSION['main_language_array']]->menus;
$_SESSION['home_home'] = (string) $xml->home[$_SESSION['main_language_array']]->home;
$_SESSION['home_order'] = (string) $xml->home[$_SESSION['main_language_array']]->order;
$_SESSION['home_kot'] = (string) $xml->home[$_SESSION['main_language_array']]->kot;
$_SESSION['home_completedorder'] = (string) $xml->home[$_SESSION['main_language_array']]->completedorder;
$_SESSION['home_generatebill'] = (string) $xml->home[$_SESSION['main_language_array']]->generatebill;
$_SESSION['home_settlebill'] = (string) $xml->home[$_SESSION['main_language_array']]->settlebill;
$_SESSION['home_paymentpending'] = (string) $xml->home[$_SESSION['main_language_array']]->paymentpending;
$_SESSION['home_creditsettlement'] = (string) $xml->home[$_SESSION['main_language_array']]->creditsettlement;
$_SESSION['home_billhistory'] = (string) $xml->home[$_SESSION['main_language_array']]->billhistory;
$_SESSION['home_administration'] = (string) $xml->home[$_SESSION['main_language_array']]->administration;
$_SESSION['home_takeaway'] = (string) $xml->home[$_SESSION['main_language_array']]->takeaway;
$_SESSION['home_registration'] = (string) $xml->home[$_SESSION['main_language_array']]->registration;
$_SESSION['home_kothistory'] = (string) $xml->home[$_SESSION['main_language_array']]->kothistory;
$_SESSION['home_kodscreen'] = (string) $xml->home[$_SESSION['main_language_array']]->kodscreen;
$_SESSION['home_analyticreport'] = (string) $xml->home[$_SESSION['main_language_array']]->analyticreport;
$_SESSION['home_packingcounter'] = (string) $xml->home[$_SESSION['main_language_array']]->packingcounter;
$_SESSION['home_error_confirm_dayopen'] = (string) $xml->home_error[$_SESSION['main_language_array']]->confirm_dayopen;
$_SESSION['home_error_confirm_dayclose'] = (string) $xml->home_error[$_SESSION['main_language_array']]->confirm_dayclose;
$_SESSION['home_inventory'] = (string) $xml->home[$_SESSION['main_language_array']]->inventory;
$_SESSION['home_error_confirm_dayopenmsg'] = (string) $xml->home_error[$_SESSION['main_language_array']]->confirm_dayopenmsg;
$_SESSION['home_error_confirm_nopermisn'] = (string) $xml->home_error[$_SESSION['main_language_array']]->confirm_nopermisn;
$_SESSION['home_headdinein'] = (string) $xml->home[$_SESSION['main_language_array']]->headdinein;
$_SESSION['home_headtakeaway'] = (string) $xml->home[$_SESSION['main_language_array']]->headtakeaway;
$_SESSION['home_headcounter'] = (string) $xml->home[$_SESSION['main_language_array']]->headcounter;
$_SESSION['home_headsettings'] = (string) $xml->home[$_SESSION['main_language_array']]->headsettings;
$_SESSION['home_livetrack'] = (string) $xml->home[$_SESSION['main_language_array']]->livetrack;
$_SESSION['home_custtrack'] = (string) $xml->home[$_SESSION['main_language_array']]->custtrack;
$_SESSION['home_hdstaffassign'] = (string) $xml->home[$_SESSION['main_language_array']]->hdstaffassign;
$_SESSION['home_hdstaffsettle'] = (string) $xml->home[$_SESSION['main_language_array']]->hdstaffsettle;
$_SESSION['home_gensettings'] = (string) $xml->home[$_SESSION['main_language_array']]->gensettings;
$_SESSION['home_menumaster'] = (string) $xml->home[$_SESSION['main_language_array']]->menumaster;
$_SESSION['home_reports'] = (string) $xml->home[$_SESSION['main_language_array']]->reports;
$_SESSION['home_masters'] = (string) $xml->home[$_SESSION['main_language_array']]->masters;
$_SESSION['home_open_t'] = (string) $xml->home[$_SESSION['main_language_array']]->open_t;
$_SESSION['home_close_t'] = (string) $xml->home[$_SESSION['main_language_array']]->close_t;
$_SESSION['home_orderdisplay'] = (string) $xml->home[$_SESSION['main_language_array']]->orderdisplay;
$_SESSION['home_loyalitypgm'] = (string) $xml->home[$_SESSION['main_language_array']]->loyalitypgm;
$_SESSION['home_voucherexp'] = (string) $xml->home[$_SESSION['main_language_array']]->voucherexp;
$_SESSION['printer_master1'] = (string) $xml->home[$_SESSION['main_language_array']]->printermaster;
$_SESSION['stock1'] = (string) $xml->home[$_SESSION['main_language_array']]->stock;

$_SESSION['game_1'] = (string) $xml->home[$_SESSION['main_language_array']]->game_1;
$_SESSION['cus_1'] = (string) $xml->home[$_SESSION['main_language_array']]->cus_1;


////new////

$_SESSION['ta_hd'] = (string) $xml->home[$_SESSION['main_language_array']]->ta_hd;
$_SESSION['cs_new'] = (string) $xml->home[$_SESSION['main_language_array']]->cs_new;
$_SESSION['printer_master_new'] = (string) $xml->home[$_SESSION['main_language_array']]->printer_master_new;
$_SESSION['item_master_new'] = (string) $xml->home[$_SESSION['main_language_array']]->item_master_new;

////new end////


   
//table_selection page
$_SESSION['table_selection_completedorder'] = (string) $xml->table_selection[$_SESSION['main_language_array']]->completedorder;
$_SESSION['table_selection_paymentpending'] = (string) $xml->table_selection[$_SESSION['main_language_array']]->paymentpending;
$_SESSION['table_selection_staff'] = (string) $xml->table_selection[$_SESSION['main_language_array']]->staff;
$_SESSION['table_selection_selectstaff'] = (string) $xml->table_selection[$_SESSION['main_language_array']]->selectstaff;
$_SESSION['table_selection_takeorder'] = (string) $xml->table_selection[$_SESSION['main_language_array']]->takeorder;
$_SESSION['table_selection_reservebutton'] = (string) $xml->table_selection[$_SESSION['main_language_array']]->reservebutton;

$_SESSION['tabe_print_new'] = (string) $xml->table_selection[$_SESSION['main_language_array']]->print_bill_new;
$_SESSION['table_order_split'] = (string) $xml->table_selection[$_SESSION['main_language_array']]->order_split_new;

$_SESSION['table_selection_clearassignedbutton'] = (string) $xml->table_selection[$_SESSION['main_language_array']]->clearassignedbutton;
$_SESSION['table_selection_changetablebutton'] = (string) $xml->table_selection[$_SESSION['main_language_array']]->changetablebutton;
$_SESSION['table_selection_ordered'] = (string) $xml->table_selection[$_SESSION['main_language_array']]->ordered;
$_SESSION['table_selection_pendingdish'] = (string) $xml->table_selection[$_SESSION['main_language_array']]->pendingdish;
$_SESSION['table_selection_billed'] = (string) $xml->table_selection[$_SESSION['main_language_array']]->billed12;
$_SESSION['table_selection_completed'] = (string) $xml->table_selection[$_SESSION['main_language_array']]->completed;
$_SESSION['table_selection_reserved'] = (string) $xml->table_selection[$_SESSION['main_language_array']]->reserved;
$_SESSION['table_selection_staffalert'] = (string) $xml->table_selection[$_SESSION['main_language_array']]->staffalert;
$_SESSION['table_selection_button_add'] = (string) $xml->table_selection[$_SESSION['main_language_array']]->button_add;
$_SESSION['table_selection_popup_tablechange'] = (string) $xml->table_selection_popup[$_SESSION['main_language_array']]->tablechange;
$_SESSION['table_selection_popup_fromtable'] = (string) $xml->table_selection_popup[$_SESSION['main_language_array']]->fromtable;
$_SESSION['table_selection_popup_totable'] = (string) $xml->table_selection_popup[$_SESSION['main_language_array']]->totable;
$_SESSION['table_selection_popup_selecttable'] = (string) $xml->table_selection_popup[$_SESSION['main_language_array']]->selecttable;
$_SESSION['table_selection_popup_submitbutton'] = (string) $xml->table_selection_popup[$_SESSION['main_language_array']]->submitbutton;
$_SESSION['table_selection_popup_cancelbutton'] = (string) $xml->table_selection_popup[$_SESSION['main_language_array']]->cancelbutton;
$_SESSION['table_selection_popup_resettime'] = (string) $xml->table_selection_popup[$_SESSION['main_language_array']]->resettime;
$_SESSION['table_selection_placeholder_entertime'] = (string) $xml->table_selection_placeholder[$_SESSION['main_language_array']]->entertime;
$_SESSION['table_selection_placeholder_no_of_persons'] = (string) $xml->table_selection_placeholder[$_SESSION['main_language_array']]->no_of_persons;
$_SESSION['table_selection_error_selectsteward'] = (string) $xml->table_selection_error[$_SESSION['main_language_array']]->selectsteward;
$_SESSION['table_selection_error_sorry'] = (string) $xml->table_selection_error[$_SESSION['main_language_array']]->sorry;
$_SESSION['table_selection_error_tablechange'] = (string) $xml->table_selection_error[$_SESSION['main_language_array']]->tablechange;
$_SESSION['table_selection_error_tablechanged'] = (string) $xml->table_selection_error[$_SESSION['main_language_array']]->tablechanged;
$_SESSION['table_selection_error_nothingclear'] = (string) $xml->table_selection_error[$_SESSION['main_language_array']]->nothingclear;
$_SESSION['table_selection_error_selectthetable'] = (string) $xml->table_selection_error[$_SESSION['main_language_array']]->selectthetable;
$_SESSION['table_selection_error_personscount'] = (string) $xml->table_selection_error[$_SESSION['main_language_array']]->personscount;
$_SESSION['table_selection_error_clearassigned'] = (string) $xml->table_selection_error[$_SESSION['main_language_array']]->clearassigned;
$_SESSION['table_selection_error_stocktable'] = (string) $xml->table_selection_error[$_SESSION['main_language_array']]->stocktable;
$_SESSION['table_selection_error_cancelreserved'] = (string) $xml->table_selection_error[$_SESSION['main_language_array']]->cancelreserved;
$_SESSION['table_selection_error_printconfirm'] = (string) $xml->table_selection_error[$_SESSION['main_language_array']]->printconfirm;
$_SESSION['table_selection_error_yes_button'] = (string) $xml->table_selection_error[$_SESSION['main_language_array']]->yes_button;
$_SESSION['table_selection_error_no_button'] = (string) $xml->table_selection_error[$_SESSION['main_language_array']]->no_button;
$_SESSION['combine_table'] = (string) $xml->table_selection[$_SESSION['main_language_array']]->combinetable;

//menu-order page
$_SESSION['menu_order_searchby'] = (string) $xml->menu_order[$_SESSION['main_language_array']]->searchby;
$_SESSION['menu_order_code'] = (string) $xml->menu_order[$_SESSION['main_language_array']]->code;
$_SESSION['menu_order_name'] = (string) $xml->menu_order[$_SESSION['main_language_array']]->name;
$_SESSION['menu_order_orderlist'] = (string) $xml->menu_order[$_SESSION['main_language_array']]->orderlist;
$_SESSION['menu_order_backbutton'] = (string) $xml->menu_order[$_SESSION['main_language_array']]->backbutton;
$_SESSION['menu_order_kotcancel1'] = (string) $xml->menu_order[$_SESSION['main_language_array']]->kotcancel1;
$_SESSION['menu_order_all_menulist'] = (string) $xml->menu_order[$_SESSION['main_language_array']]->all_menulist;
$_SESSION['menu_order_selected_table'] = (string) $xml->menu_order[$_SESSION['main_language_array']]->selected_table;
$_SESSION['menu_order_selected_steward'] = (string) $xml->menu_order[$_SESSION['main_language_array']]->selected_steward;
$_SESSION['menu_order_selected_dinein'] = (string) $xml->menu_order[$_SESSION['main_language_array']]->selected_dinein;
$_SESSION['menu_order_edit_qty'] = (string) $xml->menu_order[$_SESSION['main_language_array']]->edit_qty;
$_SESSION['menu_order_edit_pref'] = (string) $xml->menu_order[$_SESSION['main_language_array']]->edit_pref;
$_SESSION['menu_order_edit_selectpref'] = (string) $xml->menu_order[$_SESSION['main_language_array']]->edit_selectpref;
$_SESSION['menu_order_edit_rate'] = (string) $xml->menu_order[$_SESSION['main_language_array']]->edit_rate;
$_SESSION['menu_order_edit_okbutton'] = (string) $xml->menu_order[$_SESSION['main_language_array']]->edit_okbutton;
$_SESSION['menu_order_menu_confirmbutton'] = (string) $xml->menu_order[$_SESSION['main_language_array']]->menu_confirmbutton;
$_SESSION['menu_order_edit_edited'] = (string) $xml->menu_order[$_SESSION['main_language_array']]->edit_edited;
$_SESSION['menu_order_error_alredyconfirm'] = (string) $xml->menu_order_error[$_SESSION['main_language_array']]->alredyconfirm;
$_SESSION['menu_order_error_itenadd_success'] = (string) $xml->menu_order_error[$_SESSION['main_language_array']]->itenadd_success;
$_SESSION['menu_order_error_notedit'] = (string) $xml->menu_order_error[$_SESSION['main_language_array']]->notedit;
$_SESSION['menu_order_error_ratenotadded'] = (string) $xml->menu_order_error[$_SESSION['main_language_array']]->ratenotadded;
$_SESSION['menu_order_error_order_deleted'] = (string) $xml->menu_order_error[$_SESSION['main_language_array']]->order_deleted;
$_SESSION['menu_order_popup_kotprintsure'] = (string) $xml->menu_order_popup[$_SESSION['main_language_array']]->order_kotprintsure;
$_SESSION['menu_order_popup_kotprinted'] = (string) $xml->menu_order_popup[$_SESSION['main_language_array']]->kotprinted;
$_SESSION['menu_order_popup_kotprint_ok'] = (string) $xml->menu_order_popup[$_SESSION['main_language_array']]->kotprint_ok;
$_SESSION['menu_order_popup_kotprint_cancel'] = (string) $xml->menu_order_popup[$_SESSION['main_language_array']]->kotprint_cancel;
$_SESSION['menu_order_popup_quantity_clear'] = (string) $xml->menu_order_popup[$_SESSION['main_language_array']]->quantity_clear;
$_SESSION['menu_order_popup_manualpref'] = (string) $xml->menu_order_popup[$_SESSION['main_language_array']]->manualpref;
$_SESSION['menu_order_popup_no_pref'] = (string) $xml->menu_order_popup[$_SESSION['main_language_array']]->no_pref;
$_SESSION['menu_order_popup_rate'] = (string) $xml->menu_order_popup[$_SESSION['main_language_array']]->rate;
$_SESSION['menu_order_popup_submit_button'] = (string) $xml->menu_order_popup[$_SESSION['main_language_array']]->submit_button;
$_SESSION['menu_order_popup_portion'] = (string) $xml->menu_order_popup[$_SESSION['main_language_array']]->portion;
$_SESSION['menu_order_popup_selectqty'] = (string) $xml->menu_order_popup[$_SESSION['main_language_array']]->selectqty;
$_SESSION['menu_order_popup_addrate'] = (string) $xml->menu_order_popup[$_SESSION['main_language_array']]->addrate;
$_SESSION['menu_order_popup_qty'] = (string) $xml->menu_order_popup[$_SESSION['main_language_array']]->qty;
$_SESSION['menu_order_placeholder_edit_manualpref'] = (string) $xml->menu_order_placeholder[$_SESSION['main_language_array']]->edit_manualpref;
$_SESSION['menu_order_placeholder_nopreference'] = (string) $xml->menu_order_placeholder[$_SESSION['main_language_array']]->nopreference;
$_SESSION['s_portionname123'] = (string) $xml->menu_order_placeholder[$_SESSION['main_language_array']]->portionnmae1;
$_SESSION['menu_order_placeholder_code_search'] = (string) $xml->menu_order_placeholder[$_SESSION['main_language_array']]->code_search;
$_SESSION['menu_order_placeholder_search_menu'] = (string) $xml->menu_order_placeholder[$_SESSION['main_language_array']]->search_menu;
$_SESSION['menu_order_no_zero'] = (string) $xml->menu_order_no[$_SESSION['main_language_array']]->zero;
$_SESSION['menu_order_no_one'] = (string) $xml->menu_order_no[$_SESSION['main_language_array']]->one;
$_SESSION['menu_order_no_two'] = (string) $xml->menu_order_no[$_SESSION['main_language_array']]->two;
$_SESSION['menu_order_no_three'] = (string) $xml->menu_order_no[$_SESSION['main_language_array']]->three;
$_SESSION['menu_order_no_four'] = (string) $xml->menu_order_no[$_SESSION['main_language_array']]->four;
$_SESSION['menu_order_no_five'] = (string) $xml->menu_order_no[$_SESSION['main_language_array']]->five;
$_SESSION['menu_order_no_six'] = (string) $xml->menu_order_no[$_SESSION['main_language_array']]->six;
$_SESSION['menu_order_no_seven'] = (string) $xml->menu_order_no[$_SESSION['main_language_array']]->seven;
$_SESSION['menu_order_no_eight'] = (string) $xml->menu_order_no[$_SESSION['main_language_array']]->eight;
$_SESSION['menu_order_no_nine'] = (string) $xml->menu_order_no[$_SESSION['main_language_array']]->nine;
$_SESSION['menu_order_popup_dine_in'] = (string) $xml->menu_order_popup[$_SESSION['main_language_array']]->dine_in;
$_SESSION['menu_order_popup_take_away'] = (string) $xml->menu_order_popup[$_SESSION['main_language_array']]->take_away;


//completed_order page
$_SESSION['completed_order_table_selection'] = (string) $xml->completed_order[$_SESSION['main_language_array']]->table_selection;
$_SESSION['completed_order_completed_orders'] = (string) $xml->completed_order[$_SESSION['main_language_array']]->completed_orders;
$_SESSION['completed_order_payment_pending'] = (string) $xml->completed_order[$_SESSION['main_language_array']]->payment_pending;
$_SESSION['completed_order_table_details'] = (string) $xml->completed_order[$_SESSION['main_language_array']]->table_details;
$_SESSION['completed_order_order_details'] = (string) $xml->completed_order[$_SESSION['main_language_array']]->order_details;
$_SESSION['completed_order_combine123'] = (string) $xml->completed_order[$_SESSION['main_language_array']]->combine123;
$_SESSION['completed_order_floor_select'] = (string) $xml->completed_order[$_SESSION['main_language_array']]->floor_select;
$_SESSION['completed_order_select_area'] = (string) $xml->completed_order[$_SESSION['main_language_array']]->select_area;
$_SESSION['completed_order_tableno'] = (string) $xml->completed_order[$_SESSION['main_language_array']]->tableno;
$_SESSION['completed_order_ordertime'] = (string) $xml->completed_order[$_SESSION['main_language_array']]->ordertime;
$_SESSION['completed_order_orderrate'] = (string) $xml->completed_order[$_SESSION['main_language_array']]->orderrate;
$_SESSION['completed_order_printbutton'] = (string) $xml->completed_order[$_SESSION['main_language_array']]->printbutton;
$_SESSION['completed_order_varifybutton'] = (string) $xml->completed_order[$_SESSION['main_language_array']]->varifybutton;
$_SESSION['completed_order_closebutton'] = (string) $xml->completed_order[$_SESSION['main_language_array']]->closebutton;
$_SESSION['completed_order_disccbutton'] = (string) $xml->completed_order[$_SESSION['main_language_array']]->disccbutton;
$_SESSION['completed_order_slno'] = (string) $xml->completed_order[$_SESSION['main_language_array']]->slno;
$_SESSION['completed_order_menuitem'] = (string) $xml->completed_order[$_SESSION['main_language_array']]->menuitem;
$_SESSION['completed_order_portion'] = (string) $xml->completed_order[$_SESSION['main_language_array']]->portion;
$_SESSION['completed_order_orderqty'] = (string) $xml->completed_order[$_SESSION['main_language_array']]->orderqty;
$_SESSION['completed_order_order_rate'] = (string) $xml->completed_order[$_SESSION['main_language_array']]->order_rate;
$_SESSION['completed_order_order_amount'] = (string) $xml->completed_order[$_SESSION['main_language_array']]->order_amount;
$_SESSION['completed_order_cancel_rate'] = (string) $xml->completed_order[$_SESSION['main_language_array']]->cancel_rate;
$_SESSION['completed_order_total_rate'] = (string) $xml->completed_order[$_SESSION['main_language_array']]->total_rate;
$_SESSION['completed_order_proceedbillbutton'] = (string) $xml->completed_order[$_SESSION['main_language_array']]->proceedbillbutton;
$_SESSION['completed_order_all_flr'] = (string) $xml->completed_order[$_SESSION['main_language_array']]->all_flr;
$_SESSION['completed_order_bilprint'] = (string) $xml->completed_order[$_SESSION['main_language_array']]->bilprint;
$_SESSION['completed_order_removcclmsg'] = (string) $xml->completed_order[$_SESSION['main_language_array']]->removcclmsg;
$_SESSION['completed_order_itemcclmsg'] = (string) $xml->completed_order[$_SESSION['main_language_array']]->itemcclmsg;
$_SESSION['completed_order_mode_select'] = (string) $xml->completed_order[$_SESSION['main_language_array']]->mode_select;
$_SESSION['completed_order_popup_loyality'] = (string) $xml->completed_order_popup[$_SESSION['main_language_array']]->loyality;
$_SESSION['completed_order_popup_reg_yes'] = (string) $xml->completed_order_popup[$_SESSION['main_language_array']]->reg_yes;
$_SESSION['completed_order_popup_reg_no'] = (string) $xml->completed_order_popup[$_SESSION['main_language_array']]->reg_no;
$_SESSION['completed_order_popup_registered'] = (string) $xml->completed_order_popup[$_SESSION['main_language_array']]->registered;
$_SESSION['completed_order_popup_loyality_details'] = (string) $xml->completed_order_popup[$_SESSION['main_language_array']]->loyality_details;
$_SESSION['completed_order_popup_mobile'] = (string) $xml->completed_order_popup[$_SESSION['main_language_array']]->mobile;
$_SESSION['completed_order_popup_loyality_submit'] = (string) $xml->completed_order_popup[$_SESSION['main_language_array']]->loyality_submit;
$_SESSION['completed_order_popup_loyality_cancel'] = (string) $xml->completed_order_popup[$_SESSION['main_language_array']]->loyality_cancel;
$_SESSION['completed_order_popup_enter_discount'] = (string) $xml->completed_order_popup[$_SESSION['main_language_array']]->enter_discount;
$_SESSION['completed_order_popup_discount_type'] = (string) $xml->completed_order_popup[$_SESSION['main_language_array']]->discount_type;
$_SESSION['completed_order_popup_type_none'] = (string) $xml->completed_order_popup[$_SESSION['main_language_array']]->type_none;
$_SESSION['completed_order_popup_type_or'] = (string) $xml->completed_order_popup[$_SESSION['main_language_array']]->type_or;
$_SESSION['completed_order_popup_type_manual'] = (string) $xml->completed_order_popup[$_SESSION['main_language_array']]->type_manual;
$_SESSION['completed_order_popup_bill_printbutton'] = (string) $xml->completed_order_popup[$_SESSION['main_language_array']]->bill_printbutton;
$_SESSION['completed_order_popup_bill_cancelbutton'] = (string) $xml->completed_order_popup[$_SESSION['main_language_array']]->bill_cancelbutton;
$_SESSION['completed_order_popup_discount_value'] = (string) $xml->completed_order_popup[$_SESSION['main_language_array']]->discount_value;
$_SESSION['completed_order_popup_msg_discclose'] = (string) $xml->completed_order_popup[$_SESSION['main_language_array']]->msg_discclose;    
$_SESSION['completed_order_popup_msg_cancel'] = (string) $xml->completed_order_popup[$_SESSION['main_language_array']]->msg_cancel;
$_SESSION['completed_order_popup_msg_enable'] = (string) $xml->completed_order_popup[$_SESSION['main_language_array']]->msg_enable;
$_SESSION['completed_order_popup_msg_closedirt'] = (string) $xml->completed_order_popup[$_SESSION['main_language_array']]->msg_closedirt;
$_SESSION['completed_order_popup_msg_print'] = (string) $xml->completed_order_popup[$_SESSION['main_language_array']]->msg_print;
$_SESSION['completed_order_popup_msg_verify'] = (string) $xml->completed_order_popup[$_SESSION['main_language_array']]->msg_verify;
$_SESSION['completed_order_popup_msg_proceed'] = (string) $xml->completed_order_popup[$_SESSION['main_language_array']]->msg_proceed;
$_SESSION['completed_order_popup_password'] = (string) $xml->completed_order_popup[$_SESSION['main_language_array']]->password;
$_SESSION['completed_order_popup_otp'] = (string) $xml->completed_order_popup[$_SESSION['main_language_array']]->otp;


$_SESSION['completed_order_error_selectorder_proceed'] = (string) $xml->completed_order_error[$_SESSION['main_language_array']]->selectorder_proceed;
$_SESSION['completed_order_error_number_error'] = (string) $xml->completed_order_error[$_SESSION['main_language_array']]->number_error;
$_SESSION['completed_order_error_error_mg'] = (string) $xml->completed_order_error[$_SESSION['main_language_array']]->error_mg;


//payment pending page
$_SESSION['payment_pending_tableselection'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->tableselection;
$_SESSION['payment_pending_paymentpending'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->paymentpending;
$_SESSION['payment_pending_completedorder'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->completedorder;
$_SESSION['payment_pending_billhistorybutton'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->billhistorybutton;
$_SESSION['payment_pending_tabledetails'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->tabledetails;
$_SESSION['payment_pending_orderdetails'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->orderdetails;
$_SESSION['payment_pending_billdetails'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->billdetails;
$_SESSION['payment_pending_totalrate'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->totalrate;
$_SESSION['payment_pending_floorselect'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->floorselect;
$_SESSION['payment_pending_select_area'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->select_area;
$_SESSION['payment_pending_billno'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->billno;
$_SESSION['payment_pending_tableno'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->tableno;
$_SESSION['payment_pending_time'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->time;
$_SESSION['payment_pending_table_amount'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->table_amount;
$_SESSION['payment_pending_slno'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->slno;
$_SESSION['payment_pending_menuitem'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->menuitem;
$_SESSION['payment_pending_qty'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->qty;
$_SESSION['payment_pending_rate'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->rate;
$_SESSION['payment_pending_order_amount'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->order_amount;
$_SESSION['payment_pending_cashsettle'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->cashsettle;
$_SESSION['payment_pending_regeneratebutton'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->regeneratebutton;
$_SESSION['payment_pending_settlebutton'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->settlebutton;
$_SESSION['payment_pending_reprintbutton'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->reprintbutton;
$_SESSION['payment_pending_billsplitbutton'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->billsplitbutton;
$_SESSION['payment_pending_subtotal'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->subtotal;
$_SESSION['payment_pending_discount'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->discount;
$_SESSION['payment_pending_finaltotlal'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->finaltotlal;
$_SESSION['payment_pending_selectpayment'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->selectpayment;
$_SESSION['payment_pending_cash'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->cash;
$_SESSION['payment_pending_card'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->card;
$_SESSION['payment_pending_card_title'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->card_tile;
$_SESSION['payment_pending_coupons'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->coupons;
$_SESSION['payment_pending_cheque'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->cheque;
$_SESSION['payment_pending_credit_types'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->credit_types;
$_SESSION['payment_pending_voucher'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->voucher;
$_SESSION['payment_pending_complementary'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->complementary;
$_SESSION['payment_pending_management'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->management;
$_SESSION['payment_pending_cash_amount'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->cash_amount;
$_SESSION['payment_pending_cash_balance'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->cash_balance;
$_SESSION['payment_pending_table_orderdetails_billno'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->orderdetails_billno;
$_SESSION['payment_pending_credit_debilt'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->credit_debilt;
$_SESSION['payment_pending_transactionbank'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->transactionbank;
$_SESSION['payment_pending_transactionamount'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->transactionamount;
$_SESSION['payment_pending_balancepay'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->balancepay;
$_SESSION['payment_pending_amount_paid'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->amount_paid;
$_SESSION['payment_pending_balance_amount'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->balance_amount;
$_SESSION['payment_pending_card_bankname'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->card_bankname;
$_SESSION['payment_pending_paidbutton'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->paidbutton;
$_SESSION['payment_pending_coupon_title'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->coupon_title;
$_SESSION['payment_pending_coupon_name'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->coupon_name;
$_SESSION['payment_pending_coupon_namelist'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->coupon_namelist;
$_SESSION['payment_pending_coupon_amount'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->coupon_amount;
$_SESSION['payment_pending_coupon_balancepay'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->coupon_balancepay;
//$_SESSION['payment_pending_coupon_amountpaid'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->coupon_amountpaid;
//$_SESSION['payment_pending_coupon_balance'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->coupon_balance;
$_SESSION['payment_pending_voucher_title'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->voucher_title;
$_SESSION['payment_pending_voucher_id'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->voucher_id;
$_SESSION['payment_pending_voucher_balancepay'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->voucher_balancepay;
$_SESSION['payment_pending_voucher_amount'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->voucher_amount;
//$_SESSION['payment_pending_voucher_amountpaid'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->voucher_amountpaid;
//$_SESSION['payment_pending_voucher_balance'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->voucher_balance;
$_SESSION['payment_pending_cheque_title'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->cheque_title;
$_SESSION['payment_pending_cheque_no'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->cheque_no;
$_SESSION['payment_pending_cheque_bankname'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->cheque_bankname;
$_SESSION['payment_pending_check_amount'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->check_amount;
$_SESSION['payment_pending_cheque_balancepay'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->cheque_balancepay;
//$_SESSION['payment_pending_cheque_amountpaid'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->cheque_amountpaid;
//$_SESSION['payment_pending_cheque_balance'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->cheque_balance;
$_SESSION['payment_pending_credit_amount'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->credit_amount;
$_SESSION['payment_pending_credit_balance'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->credit_balance;
$_SESSION['payment_pending_credit_title'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->credit_title;
$_SESSION['payment_pending_credit_select'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->credit_select;
$_SESSION['payment_pending_credit_selectlist'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->credit_selectlist;
$_SESSION['payment_pending_credit_byroom'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->credit_byroom;
$_SESSION['payment_pending_credit_bystaff'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->credit_bystaff;
$_SESSION['payment_pending_credit_bycompany'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->credit_bycompany;
$_SESSION['payment_pending_credit_byguest'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->credit_byguest;
$_SESSION['payment_pending_credit_closebutton'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->credit_closebutton;
$_SESSION['payment_pending_complementary_title'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->complementary_title;
$_SESSION['payment_pending_comp_closebutton'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->comp_closebutton;
$_SESSION['payment_pending_comp_management'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->comp_management;
$_SESSION['payment_pending_comp_staff'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->comp_staff;
$_SESSION['payment_pending_comp_selectstaff'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->comp_selectstaff;
$_SESSION['payment_pending_compmanage_closebutton'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->compmanage_closebutton;
$_SESSION['payment_pending_roomname'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->roomname;
$_SESSION['payment_pending_creditamount'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->creditamount;
$_SESSION['payment_pending_select_roomname'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->select_roomname;
$_SESSION['payment_pending_staffname'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->staffname;
$_SESSION['payment_pending_companyname'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->companyname;
$_SESSION['payment_pending_guestname'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->guestname;
$_SESSION['payment_pending_enteramount'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->enteramount;
$_SESSION['payment_pending_insufamount'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->insufamount;
$_SESSION['payment_pending_entertransdt'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->entertransdt;
$_SESSION['payment_pending_chktransdt'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->chktransdt;
$_SESSION['payment_pending_selectcoupon'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->selectcoupon;
$_SESSION['payment_pending_entervoucher'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->entervoucher;
$_SESSION['payment_pending_enterchequeamt'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->enterchequeamt;
$_SESSION['payment_pending_enterbankname'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->enterbankname;
$_SESSION['payment_pending_enterchecknumber'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->enterchecknumber;
$_SESSION['payment_pending_incrt_amt'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->incrt_amt;
$_SESSION['payment_pending_sel_paytype'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->sel_paytype;
$_SESSION['payment_pending_sel_credttype'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->sel_credttype;
$_SESSION['payment_pending_add_compli_rem'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->add_compli_rem;
$_SESSION['payment_pending_voucher_not'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->voucher_not;
$_SESSION['payment_pending_voucher_ok'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->voucher_ok;
$_SESSION['payment_pending_incrt_coupamt'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->incrt_coupamt;
$_SESSION['payment_pending_incrt_cheqamt'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->incrt_cheqamt;
$_SESSION['payment_pending_sel_tabls'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->sel_tabls;	
$_SESSION['payment_pending_pop_authori'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->pop_authori;
$_SESSION['payment_pending_pop_reason'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->pop_reason;
$_SESSION['payment_pending_pop_staffname'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->pop_staffname;
$_SESSION['payment_pending_pop_selstaff'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->pop_selstaff;
$_SESSION['payment_pending_pop_sendotp'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->pop_sendotp;
$_SESSION['payment_pending_pop_sumbit'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->pop_sumbit;
$_SESSION['payment_pending_pop_cancel'] = (string) $xml->payment_pending[$_SESSION['main_language_array']]->pop_cancel;


$_SESSION['payment_pending_error_selectbill'] = (string) $xml->payment_pending_error[$_SESSION['main_language_array']]->selectbill;
$_SESSION['payment_pending_error_bill_regenerate'] = (string) $xml->payment_pending_error[$_SESSION['main_language_array']]->bill_regenerate;
$_SESSION['payment_pending_error_comp_remark'] = (string) $xml->payment_pending_error[$_SESSION['main_language_array']]->comp_remark;
$_SESSION['payment_pending_error_bill_reprint'] = (string) $xml->payment_pending_error[$_SESSION['main_language_array']]->bill_reprint;
$_SESSION['payment_pending_error_select_staff'] = (string) $xml->payment_pending_error[$_SESSION['main_language_array']]->select_staff;
$_SESSION['payment_pending_error_regennot'] = (string) $xml->payment_pending_error[$_SESSION['main_language_array']]->regennot;
$_SESSION['payment_pending_error_billsplit'] = (string) $xml->payment_pending_error[$_SESSION['main_language_array']]->billsplit;
$_SESSION['payment_pending_palceholder_enteramount'] = (string) $xml->payment_pending_palceholder[$_SESSION['main_language_array']]->enteramount;
$_SESSION['payment_pending_palceholder_balance_amount'] = (string) $xml->payment_pending_palceholder[$_SESSION['main_language_array']]->balance_amount;
$_SESSION['payment_pending_palceholder_transaction_amount'] = (string) $xml->payment_pending_palceholder[$_SESSION['main_language_array']]->transaction_amount;
$_SESSION['payment_pending_palceholder_card_balance'] = (string) $xml->payment_pending_palceholder[$_SESSION['main_language_array']]->card_balance;
$_SESSION['payment_pending_palceholder_card_enteramount'] = (string) $xml->payment_pending_palceholder[$_SESSION['main_language_array']]->card_enteramount;
//$_SESSION['payment_pending_palceholder_cardbalance_amount'] = (string) $xml->payment_pending_palceholder[$_SESSION['main_language_array']]->cardbalance_amount;
$_SESSION['payment_pending_palceholder_coupon_enteramount'] = (string) $xml->payment_pending_palceholder[$_SESSION['main_language_array']]->coupon_enteramount;
$_SESSION['payment_pending_palceholder_coupon_balance'] = (string) $xml->payment_pending_palceholder[$_SESSION['main_language_array']]->coupon_balance;
//$_SESSION['payment_pending_palceholder_coupon_enterpaidamount'] = (string) $xml->payment_pending_palceholder[$_SESSION['main_language_array']]->coupon_enterpaidamount;
//$_SESSION['payment_pending_palceholder_couponbalance_amount'] = (string) $xml->payment_pending_palceholder[$_SESSION['main_language_array']]->couponbalance_amount;
$_SESSION['payment_pending_palceholder_voucher_id'] = (string) $xml->payment_pending_palceholder[$_SESSION['main_language_array']]->voucher_id;
$_SESSION['payment_pending_palceholder_voucher_amount'] = (string) $xml->payment_pending_palceholder[$_SESSION['main_language_array']]->voucher_amount;
$_SESSION['payment_pending_palceholder_voucher_balance'] = (string) $xml->payment_pending_palceholder[$_SESSION['main_language_array']]->voucher_balance;
//$_SESSION['payment_pending_palceholder_voucher_enteramount'] = (string) $xml->payment_pending_palceholder[$_SESSION['main_language_array']]->voucher_enteramount;
//$_SESSION['payment_pending_palceholder_voucherbalance_amount'] = (string) $xml->payment_pending_palceholder[$_SESSION['main_language_array']]->voucherbalance_amount;
$_SESSION['payment_pending_palceholder_cheque_no'] = (string) $xml->payment_pending_palceholder[$_SESSION['main_language_array']]->cheque_no;
$_SESSION['payment_pending_palceholder_cheque_bankname'] = (string) $xml->payment_pending_palceholder[$_SESSION['main_language_array']]->cheque_bankname;
$_SESSION['payment_pending_palceholder_cheque_amount'] = (string) $xml->payment_pending_palceholder[$_SESSION['main_language_array']]->cheque_amount;
$_SESSION['payment_pending_palceholder_cheque_balance'] = (string) $xml->payment_pending_palceholder[$_SESSION['main_language_array']]->cheque_balance;
//$_SESSION['payment_pending_palceholder_cheque_enteramount'] = (string) $xml->payment_pending_palceholder[$_SESSION['main_language_array']]->cheque_enteramount;
//$_SESSION['payment_pending_palceholder_chequebalance_amount'] = (string) $xml->payment_pending_palceholder[$_SESSION['main_language_array']]->chequebalance_amount;
$_SESSION['payment_pending_palceholder_credit_enteramount'] = (string) $xml->payment_pending_palceholder[$_SESSION['main_language_array']]->credit_enteramount;
$_SESSION['payment_pending_palceholder_creditbalance_amount'] = (string) $xml->payment_pending_palceholder[$_SESSION['main_language_array']]->creditbalance_amount;
$_SESSION['payment_pending_palceholder_enter_complimentary'] = (string) $xml->payment_pending_palceholder[$_SESSION['main_language_array']]->enter_complimentary;
$_SESSION['payment_pending_palceholder_enter_compmanagement'] = (string) $xml->payment_pending_palceholder[$_SESSION['main_language_array']]->enter_compmanagement;

//Bill Split
$_SESSION['bill_split_payment_pending'] = (string) $xml->bill_split[$_SESSION['main_language_array']]->payment_pending;
$_SESSION['bill_split_billsplit'] = (string) $xml->bill_split[$_SESSION['main_language_array']]->billsplit;
$_SESSION['bill_split_table_split'] = (string) $xml->bill_split[$_SESSION['main_language_array']]->table_split;
$_SESSION['bill_split_addbutton'] = (string) $xml->bill_split[$_SESSION['main_language_array']]->addbutton;
$_SESSION['bill_split_split_bill'] = (string) $xml->bill_split[$_SESSION['main_language_array']]->split_bill;
$_SESSION['bill_split_confirm_button'] = (string) $xml->bill_split[$_SESSION['main_language_array']]->confirm_button;
$_SESSION['bill_split_total'] = (string) $xml->bill_split[$_SESSION['main_language_array']]->total;
$_SESSION['bill_split_menu_item'] = (string) $xml->bill_split[$_SESSION['main_language_array']]->menu_item;
$_SESSION['bill_split_quantity'] = (string) $xml->bill_split[$_SESSION['main_language_array']]->quantity;
$_SESSION['bill_split_bill'] = (string) $xml->bill_split[$_SESSION['main_language_array']]->bill;
$_SESSION['bill_split_splittotal'] = (string) $xml->bill_split[$_SESSION['main_language_array']]->splittotal;
$_SESSION['bill_split_confirmsplit_okbutton'] = (string) $xml->bill_split[$_SESSION['main_language_array']]->confirmsplit_okbutton;
$_SESSION['bill_split_placeholder_add_bill'] = (string) $xml->bill_split_placeholder[$_SESSION['main_language_array']]->add_bill;
$_SESSION['bill_split_error_select_tables'] = (string) $xml->bill_split_error[$_SESSION['main_language_array']]->select_tables;
$_SESSION['bill_split_error_invalid_split'] = (string) $xml->bill_split_error[$_SESSION['main_language_array']]->invalid_split;
$_SESSION['bill_split_error_invalid_quantity'] = (string) $xml->bill_split_error[$_SESSION['main_language_array']]->invalid_quantity;
$_SESSION['bill_split_popup_confirm_split'] = (string) $xml->bill_split_popup[$_SESSION['main_language_array']]->confirm_split;
$_SESSION['bill_split_popup_table_names'] = (string) $xml->bill_split_popup[$_SESSION['main_language_array']]->table_names;
$_SESSION['bill_split_popup_split_no'] = (string) $xml->bill_split_popup[$_SESSION['main_language_array']]->split_no;
$_SESSION['bill_split_popup_split_sure'] = (string) $xml->bill_split_popup[$_SESSION['main_language_array']]->split_sure;
$_SESSION['bill_split_popup_split_yesbutton'] = (string) $xml->bill_split_popup[$_SESSION['main_language_array']]->split_yesbutton;
$_SESSION['bill_split_popup_split_nobutton'] = (string) $xml->bill_split_popup[$_SESSION['main_language_array']]->split_nobutton;
$_SESSION['bill_split_popup_split_proceed'] = (string) $xml->bill_split_popup[$_SESSION['main_language_array']]->split_proceed;
$_SESSION['bill_split_popup_proceed_yes'] = (string) $xml->bill_split_popup[$_SESSION['main_language_array']]->proceed_yes;
$_SESSION['bill_split_popup_proceed_no'] = (string) $xml->bill_split_popup[$_SESSION['main_language_array']]->proceed_no;

//billspitted_view page
$_SESSION['splited_view_splitted_bill'] = (string) $xml->splited_view[$_SESSION['main_language_array']]->splitted_bill;
$_SESSION['splited_view_slno'] = (string) $xml->splited_view[$_SESSION['main_language_array']]->slno;
$_SESSION['splited_view__menuitem'] = (string) $xml->splited_view[$_SESSION['main_language_array']]->menuitem;
$_SESSION['splited_view_qty'] = (string) $xml->splited_view[$_SESSION['main_language_array']]->qty;
$_SESSION['splited_view_rate'] = (string) $xml->splited_view[$_SESSION['main_language_array']]->rate;
$_SESSION['splited_view_amount'] = (string) $xml->splited_view[$_SESSION['main_language_array']]->amount;
$_SESSION['splited_view_total'] = (string) $xml->splited_view[$_SESSION['main_language_array']]->total;
$_SESSION['splited_view_printbutton'] = (string) $xml->splited_view[$_SESSION['main_language_array']]->printbutton;
$_SESSION['splited_view_popup_loyality'] = (string) $xml->splited_view_popup[$_SESSION['main_language_array']]->loyality;
$_SESSION['splited_view_popup_registered'] = (string) $xml->splited_view_popup[$_SESSION['main_language_array']]->registered;
$_SESSION['splited_view_popup_reg_yesbutton'] = (string) $xml->splited_view_popup[$_SESSION['main_language_array']]->reg_yesbutton;
$_SESSION['splited_view_popup_reg_nobutton'] = (string) $xml->splited_view_popup[$_SESSION['main_language_array']]->reg_nobutton;
$_SESSION['splited_view_popup_enter_loyality'] = (string) $xml->splited_view_popup[$_SESSION['main_language_array']]->enter_loyality;
$_SESSION['splited_view_popup_mobile'] = (string) $xml->splited_view_popup[$_SESSION['main_language_array']]->mobile;
$_SESSION['splited_view_popup_submitbutton'] = (string) $xml->splited_view_popup[$_SESSION['main_language_array']]->submitbutton;
$_SESSION['splited_view_popup_cancelbutton'] = (string) $xml->splited_view_popup[$_SESSION['main_language_array']]->cancelbutton;
$_SESSION['splited_view_popup_enter_discount'] = (string) $xml->splited_view_popup[$_SESSION['main_language_array']]->enter_discount;
$_SESSION['splited_view_popup_discount_type'] = (string) $xml->splited_view_popup[$_SESSION['main_language_array']]->discount_type;
$_SESSION['splited_view_popup_discount_none'] = (string) $xml->splited_view_popup[$_SESSION['main_language_array']]->discount_none;
$_SESSION['splited_view_popup_discount_or'] = (string) $xml->splited_view_popup[$_SESSION['main_language_array']]->discount_or;
$_SESSION['splited_view_popup_discount_manual'] = (string) $xml->splited_view_popup[$_SESSION['main_language_array']]->discount_manual;
$_SESSION['splited_view_popup_discount_value'] = (string) $xml->splited_view_popup[$_SESSION['main_language_array']]->discount_value;
$_SESSION['splited_view_popup_discount_printbutton'] = (string) $xml->splited_view_popup[$_SESSION['main_language_array']]->discount_printbutton;
$_SESSION['splited_view_popup_discount_cancelbutton'] = (string) $xml->splited_view_popup[$_SESSION['main_language_array']]->discount_cancelbutton;
$_SESSION['splited_view_error_bill_printed'] = (string) $xml->splited_view_error[$_SESSION['main_language_array']]->bill_printed;
$_SESSION['splited_view_error_bill_enter_fields'] = (string) $xml->splited_view_error[$_SESSION['main_language_array']]->enter_fields;

//bill history page
$_SESSION['bill_history_backbutton'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->backbutton;
$_SESSION['bill_history_billhistory'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->billhistory;
$_SESSION['bill_history_bill_details'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->bill_details;
$_SESSION['bill_history_order_details'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->order_details;
$_SESSION['bill_history_slno'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->slno;
$_SESSION['bill_history_billno'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->billno;
$_SESSION['bill_history_order_slno'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->order_slno;
$_SESSION['bill_history_dishname'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->dishname;
$_SESSION['bill_history_portion'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->portion;
$_SESSION['bill_history_qty'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->qty;
$_SESSION['bill_history_rate'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->rate;
$_SESSION['bill_history_settlement_details'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->settlement_details;
$_SESSION['bill_history_changebutton'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->changebutton;
$_SESSION['bill_history_reprintbutton'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->reprintbutton;
$_SESSION['bill_history_cancelbutton'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->cancelbutton;
$_SESSION['bill_history_paymentmode'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->paymentmode;
$_SESSION['bill_history_cash'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->cash;
$_SESSION['bill_history_amount'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->amount;
$_SESSION['bill_history_amountpaid'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->amountpaid;
$_SESSION['bill_history_balance'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->balance;
$_SESSION['bill_history_transaction_amount'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->transaction_amount;
$_SESSION['bill_history_trasaction_bank'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->trasaction_bank;
$_SESSION['bill_history_change_settlement'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->change_settlement;
$_SESSION['bill_history_cash_settle'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->cash_settle;
$_SESSION['bill_history_select_payment'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->select_payment;
//$_SESSION['bill_history_settle_cash'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->settle_cash;
//$_SESSION['bill_history_card'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->card;
$_SESSION['bill_history_change_ammountpaid'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->change_ammountpaid;
$_SESSION['bill_history_change_balanceamount'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->change_balanceamount;
$_SESSION['bill_history_cardtitle'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->cardtitle;
$_SESSION['bill_history_change_trans_bank'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->change_trans_bank;
$_SESSION['bill_history_bank_name'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->bank_name;
$_SESSION['bill_history_change_trans_amount'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->change_trans_amount;
$_SESSION['bill_history_balancetopay'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->balancetopay;
$_SESSION['bill_history_paidbutton'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->paidbutton;
$_SESSION['bill_history_table'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->table;
$_SESSION['bill_history_status'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->status;
$_SESSION['bill_history_details_billno'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->details_billno;
$_SESSION['bill_history_date'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->date;
$_SESSION['bill_history_time'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->time;
$_SESSION['bill_history_total_pax'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->total_pax;
$_SESSION['bill_history_subtotal'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->subtotal;
$_SESSION['bill_history_cancel_amount'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->cancel_amount;
$_SESSION['bill_history_service_charge'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->service_charge;
$_SESSION['bill_history_service_tax'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->service_tax;
$_SESSION['bill_history_vat'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->vat;
$_SESSION['bill_history_discount_value'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->discount_value;
$_SESSION['bill_history_finaltotal'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->finaltotal;
$_SESSION['bill_history_last_print'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->last_print;
$_SESSION['bill_history_printed'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->printed;
$_SESSION['bill_history_floor'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->floor;
$_SESSION['bill_history_staff_name'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->staff_name;
$_SESSION['bill_history_day_close'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->day_close;
$_SESSION['bill_history_orderno'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->orderno;
$_SESSION['bill_history_kot'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->kot;
$_SESSION['bill_history_cancelreason'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->cancelreason;
$_SESSION['bill_history_status_closed'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->status_closed;
$_SESSION['bill_history_status_cancelledsplit'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->status_cancelledsplit;
$_SESSION['bill_history_status_billed'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->status_billed;
$_SESSION['bill_history_enter_bankdt'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->enter_bankdt;
$_SESSION['bill_history_nothngtoprint'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->nothngtoprint;
$_SESSION['bill_history_otpsend_msg'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->otpsend_msg;
$_SESSION['bill_history_bill_cancelled'] = (string) $xml->bill_history[$_SESSION['main_language_array']]->bill_cancelled;
$_SESSION['bill_history_error_chagebill'] = (string) $xml->bill_history_error[$_SESSION['main_language_array']]->chagebill;
$_SESSION['bill_history_error_insufficient_amount'] = (string) $xml->bill_history_error[$_SESSION['main_language_array']]->insufficient_amount;
$_SESSION['bill_history_error_payment_process'] = (string) $xml->bill_history_error[$_SESSION['main_language_array']]->payment_process;
$_SESSION['bill_history_error_otp_error'] = (string) $xml->bill_history_error[$_SESSION['main_language_array']]->otp_error;
$_SESSION['bill_history_error_bill_cancelled'] = (string) $xml->bill_history_error[$_SESSION['main_language_array']]->bill_cancelled;
$_SESSION['bill_history_error_cancel_error'] = (string) $xml->bill_history_error[$_SESSION['main_language_array']]->cancel_error;
$_SESSION['bill_history_placeholder_enter_paidamount'] = (string) $xml->bill_history_placeholder[$_SESSION['main_language_array']]->enter_paidamount;
$_SESSION['bill_history_placeholder_balance_amount'] = (string) $xml->bill_history_placeholder[$_SESSION['main_language_array']]->balance_amount;
$_SESSION['bill_history_placeholder_trans_amount'] = (string) $xml->bill_history_placeholder[$_SESSION['main_language_array']]->trans_amount;
$_SESSION['bill_history_placeholder_balance'] = (string) $xml->bill_history_placeholder[$_SESSION['main_language_array']]->balance;
$_SESSION['bill_history_popup_message'] = (string) $xml->bill_history_popup[$_SESSION['main_language_array']]->message;
$_SESSION['bill_history_popup_cancelbill_error'] = (string) $xml->bill_history_popup[$_SESSION['main_language_array']]->cancelbill_error;
$_SESSION['bill_history_popup_yesbutton'] = (string) $xml->bill_history_popup[$_SESSION['main_language_array']]->yesbutton;
$_SESSION['bill_history_popup_nobutton'] = (string) $xml->bill_history_popup[$_SESSION['main_language_array']]->nobutton;
$_SESSION['bill_history_popup_cancelitem_error'] = (string) $xml->bill_history_popup[$_SESSION['main_language_array']]->cancelitem_error;
$_SESSION['bill_history_popup_cancellation'] = (string) $xml->bill_history_popup[$_SESSION['main_language_array']]->cancellation;
$_SESSION['bill_history_popup_reason'] = (string) $xml->bill_history_popup[$_SESSION['main_language_array']]->reason;
$_SESSION['bill_history_popup_staffname'] = (string) $xml->bill_history_popup[$_SESSION['main_language_array']]->staffname;
$_SESSION['bill_history_popup_select_staff'] = (string) $xml->bill_history_popup[$_SESSION['main_language_array']]->select_staff;
$_SESSION['bill_history_popup_enter_password'] = (string) $xml->bill_history_popup[$_SESSION['main_language_array']]->enter_password;
$_SESSION['bill_history_popup_send_otpbutton'] = (string) $xml->bill_history_popup[$_SESSION['main_language_array']]->send_otpbutton;
$_SESSION['bill_history_popup_enter_otp'] = (string) $xml->bill_history_popup[$_SESSION['main_language_array']]->enter_otp;
$_SESSION['bill_history_popup_submitbutton'] = (string) $xml->bill_history_popup[$_SESSION['main_language_array']]->submitbutton;
$_SESSION['bill_history_popup_cancel'] = (string) $xml->bill_history_popup[$_SESSION['main_language_array']]->cancel;

//KOT history page
$_SESSION['kot_history_back_button'] = (string) $xml->kot_history[$_SESSION['main_language_array']]->back_button;
$_SESSION['kot_history_kothistory'] = (string) $xml->kot_history[$_SESSION['main_language_array']]->kothistory;
$_SESSION['kot_history_kot'] = (string) $xml->kot_history[$_SESSION['main_language_array']]->kot;
$_SESSION['kot_history_bill'] = (string) $xml->kot_history[$_SESSION['main_language_array']]->bill;
$_SESSION['kot_history_printed'] = (string) $xml->kot_history[$_SESSION['main_language_array']]->printed;
$_SESSION['kot_history_status'] = (string) $xml->kot_history[$_SESSION['main_language_array']]->status;
$_SESSION['kot_history_print_yes'] = (string) $xml->kot_history[$_SESSION['main_language_array']]->print_yes;
$_SESSION['kot_history_print_no'] = (string) $xml->kot_history[$_SESSION['main_language_array']]->print_no;
$_SESSION['kot_history_all'] = (string) $xml->kot_history[$_SESSION['main_language_array']]->all;
$_SESSION['kot_history_status_all'] = (string) $xml->kot_history[$_SESSION['main_language_array']]->status_all;
$_SESSION['kot_history_served'] = (string) $xml->kot_history[$_SESSION['main_language_array']]->served;
$_SESSION['kot_history_billed'] = (string) $xml->kot_history[$_SESSION['main_language_array']]->billed;
$_SESSION['kot_history_closed'] = (string) $xml->kot_history[$_SESSION['main_language_array']]->closed;
$_SESSION['kot_history_cancelled'] = (string) $xml->kot_history[$_SESSION['main_language_array']]->cancelled;
$_SESSION['kot_history_slno'] = (string) $xml->kot_history[$_SESSION['main_language_array']]->slno;
$_SESSION['kot_history_kot_details'] = (string) $xml->kot_history[$_SESSION['main_language_array']]->kot_details;
$_SESSION['kot_history_item_name'] = (string) $xml->kot_history[$_SESSION['main_language_array']]->item_name;
$_SESSION['kot_history_portion'] = (string) $xml->kot_history[$_SESSION['main_language_array']]->portion;
$_SESSION['kot_history_qty'] = (string) $xml->kot_history[$_SESSION['main_language_array']]->qty;
$_SESSION['kot_history_rate'] = (string) $xml->kot_history[$_SESSION['main_language_array']]->rate;
$_SESSION['kot_history_print_button'] = (string) $xml->kot_history[$_SESSION['main_language_array']]->print_button;
$_SESSION['kot_history_bill_no'] = (string) $xml->kot_history[$_SESSION['main_language_array']]->bill_no;
$_SESSION['kot_history_kot_printed'] = (string) $xml->kot_history[$_SESSION['main_language_array']]->kot_printed;
$_SESSION['kot_history_refresh'] = (string) $xml->kot_history[$_SESSION['main_language_array']]->refresh;
//KOT page
$_SESSION['kot_check_list'] = (string) $xml->kot[$_SESSION['main_language_array']]->check_list;
$_SESSION['kot_orders'] = (string) $xml->kot[$_SESSION['main_language_array']]->orders;
//$_SESSION['kot_orderby'] = (string) $xml->kot[$_SESSION['main_language_array']]->orderby;
$_SESSION['sort']['NEW'] = (string) $xml->kot[$_SESSION['main_language_array']]->new;
$_SESSION['sort']['KOT'] = (string) $xml->kot[$_SESSION['main_language_array']]->select_kot;
$_SESSION['sort']['PENDING DISH'] = (string) $xml->kot[$_SESSION['main_language_array']]->pending_dish;
$_SESSION['sort']['AREA'] = (string) $xml->kot[$_SESSION['main_language_array']]->area;
$_SESSION['sort']['ESTIMATE TIME'] = (string) $xml->kot[$_SESSION['main_language_array']]->estimate_time;


$_SESSION['kot_new'] = (string) $xml->kot[$_SESSION['main_language_array']]->new;
$_SESSION['kot_select_kot'] = (string) $xml->kot[$_SESSION['main_language_array']]->select_kot;
$_SESSION['kot_pending_dish'] = (string) $xml->kot[$_SESSION['main_language_array']]->pending_dish;
$_SESSION['kot_area'] = (string) $xml->kot[$_SESSION['main_language_array']]->area;
$_SESSION['kot_estimate_time'] = (string) $xml->kot[$_SESSION['main_language_array']]->estimate_time;
$_SESSION['kot_est_time'] = (string) $xml->kot[$_SESSION['main_language_array']]->est_time;
$_SESSION['kot_table_details'] = (string) $xml->kot[$_SESSION['main_language_array']]->table_details;
$_SESSION['kot_sort_by'] = (string) $xml->kot[$_SESSION['main_language_array']]->sort_by;
$_SESSION['kot_kot_no'] = (string) $xml->kot[$_SESSION['main_language_array']]->kot_no;
$_SESSION['kot_table_no'] = (string) $xml->kot[$_SESSION['main_language_array']]->table_no;
$_SESSION['kot_slno'] = (string) $xml->kot[$_SESSION['main_language_array']]->slno;
$_SESSION['kot_dish_name'] = (string) $xml->kot[$_SESSION['main_language_array']]->dish_name;
$_SESSION['kot_portion'] = (string) $xml->kot[$_SESSION['main_language_array']]->portion;
$_SESSION['kot_qty'] = (string) $xml->kot[$_SESSION['main_language_array']]->qty;
$_SESSION['kot_ready'] = (string) $xml->kot[$_SESSION['main_language_array']]->ready;
$_SESSION['kot_served'] = (string) $xml->kot[$_SESSION['main_language_array']]->served;
$_SESSION['kot_print_button'] = (string) $xml->kot[$_SESSION['main_language_array']]->print_button;
$_SESSION['kot_ready_button'] = (string) $xml->kot[$_SESSION['main_language_array']]->ready_button;
$_SESSION['kot_served_button'] = (string) $xml->kot[$_SESSION['main_language_array']]->served_button;
$_SESSION['kot_est_timeleft'] = (string) $xml->kot[$_SESSION['main_language_array']]->est_timeleft;
$_SESSION['kot_total_count'] = (string) $xml->kot[$_SESSION['main_language_array']]->total_count;
$_SESSION['kot_time'] = (string) $xml->kot[$_SESSION['main_language_array']]->time;
$_SESSION['kot_backtop'] = (string) $xml->kot[$_SESSION['main_language_array']]->backtop;
$_SESSION['kot_error_iten_serve'] = (string) $xml->kot_error[$_SESSION['main_language_array']]->iten_serve;
$_SESSION['kot_error_update_ready'] = (string) $xml->kot_error[$_SESSION['main_language_array']]->update_ready;
$_SESSION['kot_error_click_item'] = (string) $xml->kot_error[$_SESSION['main_language_array']]->click_item;

//Credit Settlement page
$_SESSION['credit_settlement_settlement'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->settlement;
$_SESSION['credit_settlement_creditmaster'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->creditmaster;
$_SESSION['credit_settlement_credit_details'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->credit_details;
$_SESSION['credit_settlement_order_details'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->order_details;
$_SESSION['credit_settlement_bill_details'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->bill_details;
$_SESSION['credit_settlement_pay'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->pay;
$_SESSION['credit_settlement_credit_types'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->credit_types;
$_SESSION['credit_settlement_all'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->all;
$_SESSION['credit_settlement_select_credit'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->select_credit;
$_SESSION['credit_settlement_by_room'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->by_room;
$_SESSION['credit_settlement_by_guest'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->by_guest;
$_SESSION['credit_settlement_by_staff'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->by_staff;
$_SESSION['credit_settlement_by_company'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->by_company;
$_SESSION['credit_settlement_room_name'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->room_name;
$_SESSION['credit_settlement_staff_name'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->staff_name;
$_SESSION['credit_settlement_guest_name'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->guest_name;
$_SESSION['credit_settlement_company_name'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->company_name;
$_SESSION['credit_settlement_slno'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->slno;
$_SESSION['credit_settlement_name'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->name;
$_SESSION['credit_settlement_type'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->type;
$_SESSION['credit_settlement_amount'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->amount;
$_SESSION['credit_settlement_bill_no'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->bill_no;
$_SESSION['credit_settlement_date'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->date;
$_SESSION['credit_settlement_select_payment'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->select_payment;
$_SESSION['credit_settlement_cash'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->cash;
$_SESSION['credit_settlement_credit_card'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->credit_card;
$_SESSION['credit_settlement_amount_paid'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->amount_paid;
$_SESSION['credit_settlement_balance_amount'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->balance_amount;
$_SESSION['credit_settlement_paid_button'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->paid_button;
$_SESSION['credit_settlement_card'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->card;
$_SESSION['credit_settlement_trans_bank'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->trans_bank;
$_SESSION['credit_settlement_bank_name'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->bank_name;
$_SESSION['credit_settlement_trans_amount'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->trans_amount;
$_SESSION['credit_settlement_balance_pay'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->balance_pay;
$_SESSION['credit_settlement_total_rate'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->total_rate;
$_SESSION['credit_settlement_add_button'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->add_button;
$_SESSION['credit_settlement_filter'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->filter;
$_SESSION['credit_settlement_status'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->status;
$_SESSION['credit_settlement_active'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->active;
$_SESSION['credit_settlement_inactive'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->inactive;
$_SESSION['credit_settlement_credit_to'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->credit_to;
$_SESSION['credit_settlement_active_yes'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->active_yes;
$_SESSION['credit_settlement_active_no'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->active_no;
$_SESSION['credit_settlement_submit_button'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->submit_button;
$_SESSION['credit_settlement_cancel_button'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->cancel_button;
$_SESSION['credit_settlement_room'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->room;
$_SESSION['credit_settlement_staf'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->staf;
$_SESSION['credit_settlement_guest'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->guest;
$_SESSION['credit_settlement_company'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->company;
$_SESSION['credit_settlement_select'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->select;
$_SESSION['credit_settlement_status'] = (string) $xml->credit_settlement[$_SESSION['main_language_array']]->status;
$_SESSION['credit_settlement_error_close'] = (string) $xml->credit_settlement_error[$_SESSION['main_language_array']]->close;
$_SESSION['credit_settlement_error_select_payment'] = (string) $xml->credit_settlement_error[$_SESSION['main_language_array']]->select_payment;
$_SESSION['credit_settlement_error_enter_amount'] = (string) $xml->credit_settlement_error[$_SESSION['main_language_array']]->enter_amount;
$_SESSION['credit_settlement_error_record_display'] = (string) $xml->credit_settlement_error[$_SESSION['main_language_array']]->record_display;
$_SESSION['credit_settlement_error_select_payment'] = (string) $xml->credit_settlement_error[$_SESSION['main_language_array']]->select_payment;
$_SESSION['credit_settlement_popup_confirm'] = (string) $xml->credit_settlement_popup[$_SESSION['main_language_array']]->confirm;
$_SESSION['credit_settlement_popup_credit_cancel'] = (string) $xml->credit_settlement_popup[$_SESSION['main_language_array']]->credit_cancel;
$_SESSION['credit_settlement_popup_save_button'] = (string) $xml->credit_settlement_popup[$_SESSION['main_language_array']]->save_button;
$_SESSION['credit_settlement_popup_close_button'] = (string) $xml->credit_settlement_popup[$_SESSION['main_language_array']]->close_button;
$_SESSION['credit_settlement_placeholder_trans_amount'] = (string) $xml->credit_settlement_placeholder[$_SESSION['main_language_array']]->trans_amount;
$_SESSION['credit_settlement_placeholder_balance'] = (string) $xml->credit_settlement_placeholder[$_SESSION['main_language_array']]->balance;


//registration
//fetch byname byno go export userdetails slno name phone noofvisit status action newuser sendmessage firstname lastname mobile email birthday maritalstatus anniversary profession mailreceive smsreceive backtohome register smsmessage emailmessage charactersleft sendto clear send
$_SESSION['registration_page_page_head'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->page_head;
$_SESSION['registration_page_fetch'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->fetch;
$_SESSION['registration_page_byname'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->byname;
$_SESSION['registration_page_byno'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->byno;
$_SESSION['registration_page_go'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->go;
$_SESSION['registration_page_export'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->export;
$_SESSION['registration_userdetails'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->userdetails;
$_SESSION['registration_slno'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->slno;
$_SESSION['registration_name'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->name;
$_SESSION['registration_phone'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->phone;
$_SESSION['registration_noofvisit'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->noofvisit;
$_SESSION['registration_status'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->status;
$_SESSION['registration_action'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->action;
$_SESSION['registration_newuser'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->newuser;
$_SESSION['registration_sendmessage'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->sendmessage;
$_SESSION['registration_firstname'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->firstname;
$_SESSION['registration_lastname'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->lastname;
$_SESSION['registration_mobile'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->mobile;
$_SESSION['registration_email'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->email;
$_SESSION['registration_birthday'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->birthday;
$_SESSION['registration_maritalstatus'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->maritalstatus;
$_SESSION['registration_anniversary'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->anniversary;
$_SESSION['registration_profession'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->profession;
$_SESSION['registration_mailreceive'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->mailreceive;
$_SESSION['registration_smsreceive'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->smsreceive;
$_SESSION['registration_backtohome'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->backtohome;
$_SESSION['registration_register'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->register;
$_SESSION['registration_smsmessage'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->smsmessage;
$_SESSION['registration_emailmessage'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->emailmessage;
$_SESSION['registration_charactersleft'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->charactersleft;
$_SESSION['registration_sendto'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->sendto;
$_SESSION['registration_clear'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->clear;
$_SESSION['registration_send'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->send;
$_SESSION['registration_married'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->married;
$_SESSION['registration_single'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->single;
$_SESSION['registration_edituserreg'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->edituserreg;
$_SESSION['registration_edit'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->edit;
$_SESSION['registration_mobilealready'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->mobilealready;
$_SESSION['registration_emailalready'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->emailalready;
$_SESSION['registration_update'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->update;
$_SESSION['registration_entername'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->entername;
$_SESSION['registration_enterlastname'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->enterlastname;
$_SESSION['registration_entermobile'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->entermobile;
$_SESSION['registration_enteremail'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->enteremail;
$_SESSION['registration_enterdob'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->enterdob;
$_SESSION['registration_aniverdate'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->aniverdate;
$_SESSION['registration_enterprofession'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->enterprofession;

$_SESSION['registration_msg_deleted'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->msg_deleted;
$_SESSION['registration_msg_added'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->msg_added;
$_SESSION['registration_msg_updated'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->msg_updated;
$_SESSION['registration_msg_emailfsmss'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->msg_emailfsmss;
$_SESSION['registration_msg_emailfailed'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->msg_emailfailed;
$_SESSION['registration_msg_emailssmss'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->msg_emailssmss;
$_SESSION['registration_msg_emailsend'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->msg_emailsend;
$_SESSION['registration_msg_nothingtosend'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->msg_nothingtosend;
$_SESSION['registration_msg_smssend'] = (string) $xml->registration_page[$_SESSION['main_language_array']]->msg_smssend;

        
  
      

//header 
$_SESSION['header_manage'] = (string) $xml->header[$_SESSION['main_language_array']]->manage;
$_SESSION['header_stock_management'] = (string) $xml->header[$_SESSION['main_language_array']]->stock_management;
$_SESSION['header_category'] = (string) $xml->header[$_SESSION['main_language_array']]->category;
$_SESSION['header_sub_category'] = (string) $xml->header[$_SESSION['main_language_array']]->sub_category;
$_SESSION['header_menu_name'] = (string) $xml->header[$_SESSION['main_language_array']]->menu_name;
$_SESSION['header_select_status'] = (string) $xml->header[$_SESSION['main_language_array']]->select_status;
$_SESSION['header_all'] = (string) $xml->header[$_SESSION['main_language_array']]->all;
$_SESSION['header_yes'] = (string) $xml->header[$_SESSION['main_language_array']]->yes;
$_SESSION['header_no'] = (string) $xml->header[$_SESSION['main_language_array']]->no;
$_SESSION['header_search'] = (string) $xml->header[$_SESSION['main_language_array']]->search;
$_SESSION['header_menu'] = (string) $xml->header[$_SESSION['main_language_array']]->menu;
$_SESSION['header_status'] = (string) $xml->header[$_SESSION['main_language_array']]->status;
$_SESSION['header_update'] = (string) $xml->header[$_SESSION['main_language_array']]->update;
$_SESSION['header_error_change_status'] = (string) $xml->header_error[$_SESSION['main_language_array']]->change_status;
$_SESSION['header_error_ok_button'] = (string) $xml->header_error[$_SESSION['main_language_array']]->ok_button;
$_SESSION['header_error_cancel_button'] = (string) $xml->header_error[$_SESSION['main_language_array']]->cancel_button;
$_SESSION['header_super_admin'] = (string) $xml->header[$_SESSION['main_language_array']]->super_admin;
$_SESSION['header_admin'] = (string) $xml->header[$_SESSION['main_language_array']]->admin;


$_SESSION['payment_datails'] = (string) $xml->settlepop[$_SESSION['main_language_array']]->paymentdetail;
$_SESSION['payment_close'] = (string) $xml->settlepop[$_SESSION['main_language_array']]->paymentclose;
$_SESSION['payment_submit'] = (string) $xml->settlepop[$_SESSION['main_language_array']]->paymentsubmit;

$_SESSION['maincategoryta'] = (string) $xml->takeaway[$_SESSION['main_language_array']]->maincategoryta;
$_SESSION['searchby_ta'] = (string) $xml->takeaway[$_SESSION['main_language_array']]->searchbyta;
$_SESSION['code_ta'] = (string) $xml->takeaway[$_SESSION['main_language_array']]->codeta;
$_SESSION['name_ta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->nameta;
$_SESSION['nosub_ta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->nosubta;
$_SESSION['kot_ta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->kotta;
$_SESSION['staffassign_ta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->staffassignta;
$_SESSION['asssign_ta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->assignorderta;
$_SESSION['billhistory_ta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->billhistoryta;
$_SESSION['totalbillhistory_ta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->totalbillhistoryta;
$_SESSION['customerhistory_ta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->customerhistoryta;
$_SESSION['paymentpending_ta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->paymentpendta;
$_SESSION['stock_ta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->stockta1;
$_SESSION['orddetail_ta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->orderdetailta;
$_SESSION['quick_bill']= (string) $xml->takeaway[$_SESSION['main_language_array']]->quick_bill;
$_SESSION['takeway_ta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->takeawayta;
$_SESSION['homedel_ta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->homedelta;
$_SESSION['hold_ta1']= (string) $xml->takeaway[$_SESSION['main_language_array']]->hold1ta;
$_SESSION['slno_ta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->slnota;
$_SESSION['menuitem_ta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->menuitemta;
$_SESSION['qty_ta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->qtyta;
$_SESSION['amount_ta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->amountta;
$_SESSION['portionname_ta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->portionaddta;
$_SESSION['qtyname_ta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->qtynameta1;
$_SESSION['submitname_ta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->submitnameta;
$_SESSION['ratename_ta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->ratenameta;
$_SESSION['nopref_ta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->noprefta;
$_SESSION['delete_ta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->deleteta;
$_SESSION['ok_ta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->okta;
$_SESSION['cancel_ta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->cancelta;
$_SESSION['mobile_ta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->mobileta;
$_SESSION['customerid_ta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->customeridta;
$_SESSION['permnt_ta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->permtta;
$_SESSION['delvry_ta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->delvryta;
$_SESSION['landmark_ta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->lanmarkta;
$_SESSION['gst_trn_vat']= (string) $xml->takeaway[$_SESSION['main_language_array']]->gst_trn_vat;
$_SESSION['area_ta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->areata;
$_SESSION['notes_ta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->notesta;
$_SESSION['plsfill_ta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->plsfillta;
$_SESSION['submit_ta123']= (string) $xml->takeaway[$_SESSION['main_language_array']]->submitta123;
$_SESSION['skip_ta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->skipta123;
$_SESSION['cast_ta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->cashta;
$_SESSION['credit_debitta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->creditdebitta;
$_SESSION['complimentaryta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->compta;
$_SESSION['skip_ta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->skipta11;
$_SESSION['settle_ta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->settle12;
$_SESSION['all_ta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->allcat;
$_SESSION['genset']= (string) $xml->takeaway[$_SESSION['main_language_array']]->gensettle;
$_SESSION['generateta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->generateta;
$_SESSION['backta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->backta;
$_SESSION['kotlistta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->kotlistta;
$_SESSION['proccsta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->processingta;
$_SESSION['readyta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->readyta;
$_SESSION['packedta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->packedta;
$_SESSION['ordernota']= (string) $xml->takeaway[$_SESSION['main_language_array']]->ordernota;
$_SESSION['numta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->numta;
$_SESSION['detailta']= (string) $xml->takeaway[$_SESSION['main_language_array']]->detailta;
 $_SESSION['searchbill']= (string) $xml->takeaway[$_SESSION['main_language_array']]->searchbillta;       
        
        
        
        
        
$_SESSION['home_cs']= (string) $xml->countersale[$_SESSION['main_language_array']]->homecs;
$_SESSION['calc_cs']= (string) $xml->countersale[$_SESSION['main_language_array']]->calccs;
$_SESSION['paymnt_cs']= (string) $xml->countersale[$_SESSION['main_language_array']]->paymnetcs;
$_SESSION['cashpaceholder']= (string) $xml->countersale[$_SESSION['main_language_array']]->cashpaceholder;


///////left_menu//////

$_SESSION['dashbord_lm']= (string) $xml->leftmenu[$_SESSION['main_language_array']]->dashbord_lm;
$_SESSION['menumaster_lm']= (string) $xml->leftmenu[$_SESSION['main_language_array']]->menumaster_lm;
$_SESSION['mastertable_lm']= (string) $xml->leftmenu[$_SESSION['main_language_array']]->mastertable_lm;
$_SESSION['general_settings_lm']= (string) $xml->leftmenu[$_SESSION['main_language_array']]->general_settings_lm;
 $_SESSION['printer_master_lm']= (string) $xml->leftmenu[$_SESSION['main_language_array']]->printer_master_lm;
 $_SESSION['reports_lm']= (string) $xml->leftmenu[$_SESSION['main_language_array']]->reports_lm;
 $_SESSION['user_per_lm']= (string) $xml->leftmenu[$_SESSION['main_language_array']]->user_per_lm;
 $_SESSION['voucher_lm']= (string) $xml->leftmenu[$_SESSION['main_language_array']]->voucher_lm;
 $_SESSION['dayclose_lm']= (string) $xml->leftmenu[$_SESSION['main_language_array']]->dayclose_lm;
 $_SESSION['shift_lm']= (string) $xml->leftmenu[$_SESSION['main_language_array']]->shift_lm;
 $_SESSION['stock_lm']= (string) $xml->leftmenu[$_SESSION['main_language_array']]->stock_lm;
 $_SESSION['banquet_lm']= (string) $xml->leftmenu[$_SESSION['main_language_array']]->banquet_lm;
 $_SESSION['multi_lm']= (string) $xml->leftmenu[$_SESSION['main_language_array']]->multi_lm;
 $_SESSION['db_back_lm']= (string) $xml->leftmenu[$_SESSION['main_language_array']]->db_back_lm;
 $_SESSION['menu_lm']= (string) $xml->leftmenu[$_SESSION['main_language_array']]->menu_lm;
 $_SESSION['trouble_lm']= (string) $xml->leftmenu[$_SESSION['main_language_array']]->trouble_lm;
 $_SESSION['notification_lm']= (string) $xml->leftmenu[$_SESSION['main_language_array']]->notification_lm;
 $_SESSION['module_new_lm']= (string) $xml->home[$_SESSION['main_language_array']]->module_new_lm;
 
 ////////sub headings//////
 
 $_SESSION['geo_lm']= (string) $xml->leftmenu[$_SESSION['main_language_array']]->geo_lm;
 $_SESSION['table_lm']= (string) $xml->leftmenu[$_SESSION['main_language_array']]->table_lm;
 $_SESSION['staff_lm']= (string) $xml->leftmenu[$_SESSION['main_language_array']]->staff_lm;
 $_SESSION['discount_lm']= (string) $xml->leftmenu[$_SESSION['main_language_array']]->discount_lm;
 $_SESSION['feed_lm']= (string) $xml->leftmenu[$_SESSION['main_language_array']]->feed_lm;
 $_SESSION['denom_lm']= (string) $xml->leftmenu[$_SESSION['main_language_array']]->denom_lm;
 $_SESSION['reason_lm']= (string) $xml->leftmenu[$_SESSION['main_language_array']]->reason_lm;
 $_SESSION['cancel_lm']= (string) $xml->leftmenu[$_SESSION['main_language_array']]->cancel_lm;
 $_SESSION['comp_lm']= (string) $xml->leftmenu[$_SESSION['main_language_array']]->comp_lm;
 $_SESSION['reg_lm']= (string) $xml->leftmenu[$_SESSION['main_language_array']]->reg_lm;
 $_SESSION['machine_lm']= (string) $xml->leftmenu[$_SESSION['main_language_array']]->machine_lm;
 $_SESSION['report_lm']= (string) $xml->leftmenu[$_SESSION['main_language_array']]->report_lm;
 $_SESSION['currency_lm']= (string) $xml->leftmenu[$_SESSION['main_language_array']]->currency_lm;
 $_SESSION['currency_convo_lm']= (string) $xml->leftmenu[$_SESSION['main_language_array']]->currency_convo_lm;
 $_SESSION['card_lm']= (string) $xml->leftmenu[$_SESSION['main_language_array']]->card_lm; 
 $_SESSION['tax_lm']= (string) $xml->leftmenu[$_SESSION['main_language_array']]->tax_lm; 
  
  
  
 //right side menu//
  $_SESSION['banquet_list']= (string) $xml->leftmenu[$_SESSION['main_language_array']]->banquet_list;
  $_SESSION['ledger']= (string) $xml->leftmenu[$_SESSION['main_language_array']]->ledger;
  $_SESSION['advance']= (string) $xml->leftmenu[$_SESSION['main_language_array']]->advance;
  
  
  
  
  ////////general setiings////////////
  
  
  $_SESSION['restuarnt_gs']= (string) $xml->gen_setting[$_SESSION['main_language_array']]->restuarnt_gs;
  $_SESSION['common_gs']= (string) $xml->gen_setting[$_SESSION['main_language_array']]->common_gs;
  $_SESSION['loyalty_gs']= (string) $xml->gen_setting[$_SESSION['main_language_array']]->loyalty_gs;
  $_SESSION['android_gs']= (string) $xml->gen_setting[$_SESSION['main_language_array']]->android_gs;
  $_SESSION['kot_gs']= (string) $xml->gen_setting[$_SESSION['main_language_array']]->kot_gs;
  $_SESSION['kod_gs']= (string) $xml->gen_setting[$_SESSION['main_language_array']]->kod_gs;
  $_SESSION['bill_gs']= (string) $xml->gen_setting[$_SESSION['main_language_array']]->bill_gs;
  $_SESSION['cashdrawer_gs']= (string) $xml->gen_setting[$_SESSION['main_language_array']]->cashdrawer_gs;
  $_SESSION['auth_gs']= (string) $xml->gen_setting[$_SESSION['main_language_array']]->auth_gs;
  $_SESSION['dayclose_gs']= (string) $xml->gen_setting[$_SESSION['main_language_array']]->dayclose_gs;
  $_SESSION['cloud_gs']= (string) $xml->gen_setting[$_SESSION['main_language_array']]->cloud_gs;
  $_SESSION['other_gs']= (string) $xml->gen_setting[$_SESSION['main_language_array']]->other_gs;
  $_SESSION['sms_mail_gs']= (string) $xml->gen_setting[$_SESSION['main_language_array']]->sms_mail_gs;
  $_SESSION['admin_gs']= (string) $xml->gen_setting[$_SESSION['main_language_array']]->admin_gs;
  
  $_SESSION['up_logo_gs']= (string) $xml->gen_setting[$_SESSION['main_language_array']]->up_logo_gs;
  $_SESSION['dw_app_gs']= (string) $xml->gen_setting[$_SESSION['main_language_array']]->dw_app_gs;
  
  
  /////common lang ///////
  
  $_SESSION['clear_com']= (string) $xml->common_lang[$_SESSION['main_language_array']]->clear_com;
  $_SESSION['combo_ico_com']= (string) $xml->common_lang[$_SESSION['main_language_array']]->combo_ico_com;
  $_SESSION['subtotal_com']= (string) $xml->common_lang[$_SESSION['main_language_array']]->subtotal_com;
  $_SESSION['payable_com']= (string) $xml->common_lang[$_SESSION['main_language_array']]->payable_com;
  $_SESSION['tax_com']= (string) $xml->common_lang[$_SESSION['main_language_array']]->tax_com;
  $_SESSION['items_com']= (string) $xml->common_lang[$_SESSION['main_language_array']]->items_com;
  
  
  
  ///new words///
  
  $_SESSION['cons_kot_ar_eng']= (string) $xml->common_lang[$_SESSION['main_language_array']]->cons_kot_ar_eng;
  $_SESSION['faq_ar_eng']= (string) $xml->common_lang[$_SESSION['main_language_array']]->faq_ar_eng;
  $_SESSION['cus_dis_ar_eng']= (string) $xml->common_lang[$_SESSION['main_language_array']]->cus_dis_ar_eng;
  
  
 
//$_SESSION['header_change_password'] = (string) $xml->header[$_SESSION['main_language_array']]->change_password;
//$_SESSION['header_change_lang'] = (string) $xml->header[$_SESSION['main_language_array']]->change_lang;
//$_SESSION['header_logout'] = (string) $xml->header[$_SESSION['main_language_array']]->logout;
//$_SESSION['header_change_degault_language'] = (string) $xml->header[$_SESSION['main_language_array']]->change_degault_language;
//}

if ($_SESSION['main_language'] == "arabic") {
    ?>
    <!--dir="rtl" lang="ar"-->
    <style>
        .directionchg {direction:rtl !important;}
    </style>
    <?php
}