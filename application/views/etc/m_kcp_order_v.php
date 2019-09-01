<div id="sample_wrap">
<form id="order_info" name="order_info" method="post" accept-charset="euc-kr">
	
	<!-- 공통정보 -->
	<input type="hidden" id="req_tx"			name="req_tx"          value="pay">								<!-- 요청 구분 -->
	<input type="hidden" id="shop_name"			name="shop_name"       value="<?=$g_conf_site_name?>">			<!-- 사이트 이름 --> 
	<input type="hidden" id="site_cd"			name="site_cd"         value="<?=$g_conf_site_cd?>">			<!-- 사이트 코드 -->
	<input type="hidden" id="currency"			name="currency"        value="410"/>							<!-- 통화 코드 -->
	<input type="hidden" id="eng_flag"			name="eng_flag"        value="N"/>								<!-- 한 / 영 -->
	<!-- 결제등록 키 -->
	<input type="hidden" id="approval"			name="approval_key"    value="">
	<!-- 인증시 필요한 파라미터(변경불가)-->
	<input type="hidden" id="escw_used"			name="escw_used"       value="N">
	<input type="hidden" id="pay_method"		name="pay_method"      value="CARD">
	<input type="hidden" id="van_code"			name="van_code"        value="">
	<!-- 신용카드 설정 -->
	<input type="hidden" id="quotaopt"			name="quotaopt"        value="12"/>								<!-- 최대 할부개월수 -->
	<!-- 가상계좌 설정 -->
	<input type="hidden" id="ipgm_date"			name="ipgm_date"       value=""/>
	<!-- 가맹점에서 관리하는 고객 아이디 설정을 해야 합니다.(필수 설정) -->
	<input type="hidden" id="shop_user_id"		name="shop_user_id"    value="<?=$member_data['m_userid']?>"/>
	<!-- 복지포인트 결제시 가맹점에 할당되어진 코드 값을 입력해야합니다.(필수 설정) -->
	<input type="hidden" id="pt_memcorp_cd"		name="pt_memcorp_cd"   value=""/>
	<!-- 현금영수증 설정 -->
	<input type="hidden" id="disp_tax_yn"		name="disp_tax_yn"     value="Y"/>
	<!-- 리턴 URL (kcp와 통신후 결제를 요청할 수 있는 암호화 데이터를 전송 받을 가맹점의 주문페이지 URL) -->
	<input type="text" id="Ret_URL"			name="Ret_URL"         value="<?=$Ret_URL?>">
	<!-- 화면 크기조정 -->
	<input type="hidden" id="tablet_size"		name="tablet_size"     value="1.0">

	<!-- 추가 파라미터 ( 가맹점에서 별도의 값전달시 param_opt 를 사용하여 값 전달 ) -->
	<input type="hidden" id="param_opt_1"		name="param_opt_1"     value="<?=$mode?>">
	<input type="hidden" id="param_opt_2"		name="param_opt_2"     value="<?=$code?>">
	<input type="hidden" id="param_opt_3"		name="param_opt_3"     value="<?=$member_data['m_userid']?>">

	<input type="hidden" id="PayUrl" name="PayUrl" value="">


	<!-- 주문정보 파라미터 -->
	<input type="hidden" id="ActionResult" name="ActionResult" value="<?=$mode?>">																			<!-- 결제방법 -->
	<input type="hidden" id="ordr_idxx"	 name="ordr_idxx"	 value="<?=$payment_temp_data['m_tradeid']?>">													<!-- 주문번호 -->
	<input type="hidden" id="good_name"	 name="good_name"	 value="<?=$payment_temp_data['m_goods']?>">													<!-- 상품명 -->
	<input type="hidden" id="good_mny"	 name="good_mny"	 value="<?=$payment_temp_data['m_price']?>">													<!-- 상품가격 -->
	<input type="hidden" id="buyr_name"	 name="buyr_name"	 value="<?=$member_data['m_name']?>">															<!-- 주문자 이름 -->
	<input type="hidden" id="buyr_mail"	 name="buyr_mail"	 value="<?=$member_data['m_mail']?>">															<!-- 주문자 이메일 -->
	<input type="hidden" id="buyr_tel1"	 name="buyr_tel1"	 value="">																						<!-- 주문자 전화번호 -->
	<input type="hidden" id="buyr_tel2"	 name="buyr_tel2"	 value="<?=$member_data['m_hp1'].$member_data['m_hp2'].$member_data['m_hp3']?>">				<!-- 주문자 핸드폰번호 -->

</form>
</div>

<!-- 스마트폰에서 KCP 결제창을 레이어 형태로 구현-->
<div id="layer_all" style="position:absolute; left:0px; top:0px; width:100%;height:100%; z-index:1; display:none;">
    <table height="100%" width="100%" border="-" cellspacing="0" cellpadding="0" style="hidden-align:center">
        <tr height="100%" width="100%">
            <td>
                <iframe name="frm_all" frameborder="0" marginheight="0" marginwidth="0" border="0" width="100%" height="100%" scrolling="auto"></iframe>
            </td>
        </tr>
    </table>
</div>


<form id="pay_form" name="pay_form" method="post" action="/etc/kcp_payment/pp_cli_hub_mobile">
    <input type="hidden" id="req_tx"			name="req_tx"				value="<?=@$req_tx?>">               <!-- 요청 구분          -->
    <input type="hidden" id="res_cd"			name="res_cd"				value="<?=@$res_cd?>">               <!-- 결과 코드          -->
    <input type="hidden" id="tran_cd"			name="tran_cd"				value="<?=@$tran_cd?>">              <!-- 트랜잭션 코드      -->
    <input type="hidden" id="ordr_idxx"			name="ordr_idxx"			value="<?=@$ordr_idxx?>">            <!-- 주문번호           -->
    <input type="hidden" id="good_mny"			name="good_mny"				value="<?=@$good_mny?>">             <!-- 휴대폰 결제금액    -->
    <input type="hidden" id="good_name"			name="good_name"			value="<?=@$good_name?>">            <!-- 상품명             -->
    <input type="hidden" id="buyr_name"			name="buyr_name"			value="<?=@$buyr_name?>">            <!-- 주문자명           -->
    <input type="hidden" id="buyr_tel1"			name="buyr_tel1"			value="<?=@$buyr_tel1?>">            <!-- 주문자 전화번호    -->
    <input type="hidden" id="buyr_tel2"			name="buyr_tel2"			value="<?=@$buyr_tel2?>">            <!-- 주문자 휴대폰번호  -->
    <input type="hidden" id="buyr_mail"			name="buyr_mail"			value="<?=@$buyr_mail?>">            <!-- 주문자 E-mail      -->
	<input type="hidden" id="cash_yn"			name="cash_yn"				value="<?=@$cash_yn?>">              <!-- 현금영수증 등록여부-->
    <input type="hidden" id="enc_info"			name="enc_info"				value="<?=@$enc_info?>">
    <input type="hidden" id="enc_data"			name="enc_data"				value="<?=@$enc_data?>">
    <input type="hidden" id="use_pay_method"	name="use_pay_method"		value="<?=@$use_pay_method?>">
    <input type="hidden" id="cash_tr_code"		name="cash_tr_code"			value="<?=@$cash_tr_code?>">
	
    <!-- 추가 파라미터 -->
	<input type="hidden" id="param_opt_1"		name="param_opt_1"			value="<?=@$param_opt_1?>">
	<input type="hidden" id="param_opt_2"		name="param_opt_2"			value="<?=@$param_opt_2?>">
	<input type="hidden" id="param_opt_3"		name="param_opt_3"			value="<?=@$param_opt_3?>">

	<input type="hidden" id="tno" name="tno" value="">
</form>
