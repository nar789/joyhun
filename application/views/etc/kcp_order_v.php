
<div class="pay_content">
	
	<h1 class="pay_tit_h1">[결제요청] 고객님의 결제정보를 확인해주세요.</h1>

	<div class="pay_sub">

		<p>
		고객님의 PC에 PayPlus Plug-in이 설치되지 않은 경우 <font style="color:#000;">브라우저 상단의 노란색 알림표시줄</font>이나<br>
		<a href="http://pay.kcp.co.kr/plugin_new/file/KCPUXWizard.exe"><font style="color:#E15148;">[수동설치]</font></a>클릭을 통해 <font style="color:#000;">PayPlus Plug-in 설치</font>가 가능합니다.
		</p>
		
		<form name="order_info" method="post" action="/etc/kcp_payment/pp_cli_hub" >
		<input type="hidden" name="req_tx"          value="pay" />
		<input type="hidden" name="site_cd"         value="<?=$g_conf_site_cd	?>" />
		<input type="hidden" name="site_name"       value="<?=$g_conf_site_name ?>" />
		<!-- 할부옵션 -->
		<input type="hidden" name="quotaopt"        value="12"/>	
    
		<!-- 필수 항목 : 결제 금액/화폐단위 -->
		<input type="hidden" name="currency"        value="WON"/>
		<!-- PLUGIN 설정 정보입니다(변경 불가) -->
		<input type="hidden" name="module_type"     value="<?=$module_type ?>"/>

		<input type="hidden" name="res_cd"          value=""/>
		<input type="hidden" name="res_msg"         value=""/>
		<input type="hidden" name="tno"             value=""/>
		<input type="hidden" name="trace_no"        value=""/>
		<input type="hidden" name="enc_info"        value=""/>
		<input type="hidden" name="enc_data"        value=""/>
		<input type="hidden" name="ret_pay_method"  value=""/>
		<input type="hidden" name="tran_cd"         value=""/>
		<input type="hidden" name="bank_name"       value=""/>
		<input type="hidden" name="bank_issu"       value=""/>
		<input type="hidden" name="use_pay_method"  value=""/>

		<!--  현금영수증 관련 정보 : Payplus Plugin 에서 설정하는 정보입니다 -->
		<input type="hidden" name="cash_tsdtime"    value=""/>
		<input type="hidden" name="cash_yn"         value=""/>
		<input type="hidden" name="cash_authno"     value=""/>
		<input type="hidden" name="cash_tr_code"    value=""/>
		<input type="hidden" name="cash_id_info"    value=""/>

		<!-- 2012년 8월 18일 전자상거래법 개정 관련 설정 부분 -->
		<!-- 제공 기간 설정 0:일회성 1:기간설정(ex 1:2012010120120131)  -->
		<input type="hidden" name="good_expr" value="0">

		<!-- 가맹점에서 관리하는 고객 아이디 설정을 해야 합니다.(필수 설정) -->
		<input type="hidden" name="shop_user_id"    value=""/>
		<!-- 복지포인트 결제시 가맹점에 할당되어진 코드 값을 입력해야합니다.(필수 설정) -->
		<input type="hidden" name="pt_memcorp_cd"   value=""/>
		
		<!-- 추가 -->
		<input type="hidden" name="pay_method" value="<?=$pay_method?>">			<!-- 결제방법 -->
		<input type="hidden" name="ordr_idxx" value="<?=$m_tradeid?>">				<!-- 주문번호 -->
		<input type="hidden" name="good_name" value="<?=$v_goods?>">				<!-- 상품명 -->
		<input type="hidden" name="good_mny" value="<?=$v_price?>">				<!-- 상품가격(결제가격) -->
		<input type="hidden" name="buyr_name" value="<?=$v_name?>">				<!-- 주문자명 -->


		<div style="position:relative; width:100%; margin-top:20px;">
			<h1 style="font-size:1.3em;">결제정보</h1>
			<table cellspacing=0 cellpadding=0 class="pay_tbl">
				<tr>
					<th class="tb_bor_t">결제방법</th>
					<td class="tb_bor_t"><?=$payment_method?></td>
				</tr><!-- 
				<tr>
					<th>주문번호</th>
					<td><?=$m_tradeid?></td>
				</tr>
				<tr>
					<th>상품명</th>
					<td><?=$v_goods?></td>
				</tr> -->
				<tr>
					<th>결제금액</th>
					<td><?=$v_price?>원</td>
				</tr>
				<tr>
					<th>주문자명</th>
					<td><?=$v_name?></td>
				</tr>
				<tr>
					<th>E-MAIL</th>
					<td><input type="text" name="buyr_mail" class="w200" value="<?=$v_mail?>" maxlength="30" /></td>
				</tr>
				<tr>
					<th>휴대폰번호</th>
					<td><input type="text" name="buyr_tel2" class="w200" value="<?=$v_hptele?>" maxlength="11" /></td>
				</tr>
			</table>
		</div>

		
		
		<div class="btn_box">
			<input type="submit" id="pay_btn" name="pay_btn" class="btn_st_r" value="결제요청" onclick="return jsf__pay(this.form);">
		</div>
		
		</form>

	</div>

</div>
