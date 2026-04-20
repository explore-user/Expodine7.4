<!--auth by code-->
<div class="kotcancel_reason_popup_new" style="display:none">
    <input type="hidden" name="focusedtext" id="focusedtext" />
 <div class="kotcancel_reason_popup_new_left_cc">
    <div class="kotcancel_reason_popup_new_head"><img class="auth_head_ico" src="img/alert.png" /> Authorisation</div>
    <div class="kotcancel_reason_popup_new_textbox_contant">
    
    	<div class="kotcancel_reason_popup_new_textbox_cc">
            <select class="kotcancel_reason_popup_new_textbox_input" id="authcodersn">
               
                <?php 
                                                $sql_rsn = "select cr_id, cr_reason FROM tbl_cancellation_reasons where cr_active = 'Y' ";
                                                $sql_rsns = $database->mysqlQuery($sql_rsn);
                                                $num_rsns = $database->mysqlNumRows($sql_rsns);
                                                if ($num_rsns) {
                                                    while ($result_rsns = $database->mysqlFetchArray($sql_rsns)) {
                                                        ?>
                                                 
                                                         <option value="<?= $result_rsns['cr_id']?>"><?= $result_rsns['cr_reason']?></option>
                                                   
                                                          <?php  }}?>
            </select>
        </div>
        <div style="width: 100%;float: left;height: 20px;line-height: 10px;text-align: center"><span id="pin_error" style="color:red;"></span></div>
        <div class="kotcancel_reason_popup_new_textbox_cc" style="margin-bottom:10px;">
            <input type="password" class="kotcancel_reason_popup_new_textbox_input" placeholder="CODE" id="pin" onkeypress="return numonly(event)" autofocus="true" maxlength="4" autocomplete="off"/>
        </div>
    </div>
    <div class="kotcancel_reason_popup_new_textbox_btn_cc">
        <a href="#"><div class="kotcancel_reason_popup_new_textbox_btn" id="kotcancel_reason_popup_new_cancel_btn">Cancel</div></a>
    	<a href="#"><div class="kotcancel_reason_popup_new_textbox_btn" id="kotcancel_reason_popup_new_proceed_btn">Proceed</div></a>
    </div>
  </div><!--kotcancel_reason_popup_new_left_cc-->
  <div class="kotcancel_reason_popup_new_right_cc">
  		<div class="keys settle_key">
            <span class="calculator_settle">1</span>
            <span class="calculator_settle">2</span>
            <span class="calculator_settle">3</span>
             <span class="calculator_settle_back">&nbsp;</span>
            <span class="calculator_settle">4</span>
            <span class="calculator_settle">5</span>
            <span class="calculator_settle">6</span>
             <span class="calculator_settle">Clear</span>
            <span class="calculator_settle">7</span>
            <span class="calculator_settle">8</span>
            <span class="calculator_settle">9</span>
            <span class="calculator_settle">0</span>
        </div>
  </div><!--kotcancel_reason_popup_new_right_cc-->
</div>   
<!--auth by code end-->
