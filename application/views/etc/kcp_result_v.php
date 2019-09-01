<div class="pay_content">
	
	<h1 class="pay_tit_h1">[결제완료] 결제가 완료되었습니다.</h1>

	<div class="pay_sub">

		<p>
			고객님의 결제가 완료되었습니다. 결제내역을 확인해 주세요.
		</p>

		<form name="cancel" method="post">

		<div style="position:relative; width:100%;">
			<h1 style="font-size:1.3em;">처리 결과</h1>
			<table cellspacing=0 cellpadding=0 class="pay_tbl2">
				<!-- 결과 코드 -->
                <!--tr>
					<th>결과 코드</th>
                    <td><?=$res_cd?></td>
                </tr-->
                <!-- 결과 메시지 -->
                <tr>
					<th class="tb_bor_t">결과 메세지</th>
                    <td class="tb_bor_t"><?=$res_msg?></td>
                </tr>
				<? if( !$res_msg_bsucc == ""){ ?>
				<tr>
					<th>결과 상세 메세지</th>
					<td><?=$res_msg_bsucc?></td>
                </tr>
				<? } ?>
			</table>

			<?
				if($req_tx == "pay"){
					if($bSucc != "false"){
						if($res_cd == "0000"){
			?>

			<h1 style="font-size:1.3em; padding-top:25px;">결제 정보</h1>
			<table cellspacing=0 cellpadding=0 class="pay_tbl2">
				<!-- 주문번호 -->
                <!--tr>
					<th class="tb_bor_t">주문 번호</th>
                    <td class="tb_bor_t"><?=$ordr_idxx ?></td>
                </tr-->
                <!-- KCP 거래번호 -->
                <!--tr>
                    <th>KCP 거래번호</th>
                    <td><?=$tno ?></td>
                </tr-->
                <!-- 결제금액 -->
                <tr>
                    <th class="tb_bor_t">결제 금액</th>
                    <td class="tb_bor_t"><?=$good_mny ?>원</td>
                </tr>
                <!-- 상품명(good_name) -->
                <tr>
                    <th>상 품 명</th>
                    <td><?=$good_name ?></td>
                </tr>
                <!-- 주문자명 -->
                <tr>
                    <th>주문자명</th>
                    <td><?=$buyr_name ?></td>
                </tr>
                <!-- 주문자 전화번호 -->
                <!--tr>
                    <th>주문자 전화번호</th>
                    <td><?=$buyr_tel1 ?></td>
                </tr-->
                <!-- 주문자 휴대폰번호 -->
                <tr>
                    <th>주문자 휴대폰번호</th>
                    <td><?=$buyr_tel2 ?></td>
                </tr>
                <!-- 주문자 E-mail -->
                <tr>
                    <th>주문자 E-mail</th>
                    <td><?=$buyr_mail ?></td>
                </tr>
			</table>

			<?if ($use_pay_method == "100000000000"){	//신용카드 결제정보?>

			<h1 style="font-size:1.3em; padding-top:25px;">신용카드 정보</h1>
			<table cellspacing=0 cellpadding=0 class="pay_tbl2">
				<!-- 결제수단 : 신용카드 -->
                <tr>
                    <th class="tb_bor_t">결제 수단</th>
                    <td class="tb_bor_t">신용 카드</td>
                </tr>
                <!-- 결제 카드 -->
                <tr>
                    <th>결제 카드</th>
                    <td><?=$card_name ?></td>
                </tr>
                <!-- 승인시간 -->
                <tr>
                    <th>승인 시간</th>
                    <td><?=$app_time ?></td>
                </tr>
                <!-- 승인번호 -->
                <tr>
                    <th>승인 번호</th>
                    <td><?=$app_no ?></td>
                </tr>
                <!-- 할부개월 -->
                <tr>
                    <th>할부 개월</th>
                    <td><?=$quota ?></td>
                </tr>
                <!-- 무이자 여부 -->
                <tr>
                    <th>무이자 여부</th>
                    <td><?=$noinf ?></td>
                </tr>

				
			<?if ( $pnt_issue == "SCSK" || $pnt_issue == "SCWB" ){ ?>

			</table>
			<h1 style="font-size:1.3em; padding-top:25px;">포인트 정보</h1>
            <table cellspacing=0 cellpadding=0 class="pay_tbl2">
				<!-- 포인트사 -->
				<tr>
					<th>포인트사</th>
					<td><?=$pnt_issue ?></td>
                </tr>
                <!-- 포인트 승인 시간 -->
                <tr>
                    <th>포인트 승인시간</th>
                    <td><?=$pnt_app_time ?></td>
                </tr>
                <!-- 포인트 승인번호 -->
                <tr>
                    <th>포인트 승인번호</th>
                    <td><?=$pnt_app_no ?></td>
                </tr>
	            <!-- 적립금액 or 사용금액 -->
                <tr>
                    <th>적립금액 or 사용금액</th>
                    <td><?=$pnt_amount ?></td>
                </tr>
                <!-- 발생 포인트 -->
                <tr>
                    <th>발생 포인트</th>
                    <td><?=$add_pnt ?></td>
                </tr>
                <!-- 사용가능 포인트 -->
                <tr>
                    <th>사용가능 포인트</th>
                    <td><?=$use_pnt ?></td>
                </tr>
                <!-- 총 누적 포인트 -->
                <tr>
                    <th>총 누적 포인트</th>
                    <td><?=$rsv_pnt ?></td>
                </tr>
				<tr>
					<th>영수증 확인</th>
                        
				</tr>
			<?}?>
				<tr>
					<th>영수증 확인</th>
                    <td><input type="button" id="" name="" value="영수증 확인 " class="btn_st_bill" onclick="javascript:receiptView('<?=$tno?>','<?=$ordr_idxx?>','<?=$amount?>');"></td>
				</tr>
            </table>

			<?}else if($use_pay_method == "010000000000"){	//계좌이체 결과?>

			<h1 style="font-size:1.3em; padding-top:25px;">계좌이체 정보</h1>
			<table cellspacing=0 cellpadding=0 class="pay_tbl2">
				<!-- 결제수단 : 계좌이체 -->
                <tr>
                    <th class="tb_bor_t">결제 수단</th>
                    <td class="tb_bor_t">계좌이체</td>
                </tr>
				<!-- 이체 은행 -->
                <tr>
                    <th>이체 은행</th>
                    <td><?=$bank_name ?></td>
                </tr>
                <!-- 이체 은행 코드 -->
                <!--tr>
                    <th>이체 은행코드</th>
                    <td><?=$bank_code ?></td>
                </tr-->
                <!-- 승인시간 -->
                <tr>
                    <th>승인 시간</th>
                    <td><?=$app_time ?></td>
                </tr>
            </table>

			<?}else if($use_pay_method == "001000000000"){	//가상계좌 결과?>
				
			<h2>&sdot; 가상계좌 정보</h2>
            <table class="tbl" cellpadding="0" cellspacing="0">
                <!-- 결제수단 : 가상계좌 -->
                <tr>
                    <th>결제 수단</th>
                    <td>가상계좌</td>
                </tr>
                <!-- 입금은행 -->
                <tr>
                    <th>입금 은행</th>
                    <td><?=$bankname ?></td>
                </tr>
                <!-- 입금계좌 예금주 -->
                <tr>
                    <th>입금할 계좌 예금주</th>
                    <td><?=$depositor ?></td>
                </tr>
                <!-- 입금계좌 번호 -->
                <tr>
                    <th>입금할 계좌 번호</th>
                    <td><?=$account ?></td>
                </tr>
                <!-- 가상계좌 입금마감시간 -->
                <tr>
                    <th>가상계좌 입금마감시간</th>
                    <td><?=$va_date ?></td>
                </tr>
                <!-- 가상계좌 모의입금(테스트시) -->
                <tr>
                    <th>가상계좌 모의입금</br>(테스트시 사용)</th>
                    <td class="sub_content1"><a href="javascript:receiptView3()"><img src="<?=IMG_DIR?>/etc/btn_vcn.png" alt="모의입금 페이지로 이동합니다." />
                </tr>
            </table>

			<?}else if($use_pay_method == "000100000000"){		//포인트 결제 결과?>
				
			<h2>&sdot; 포인트 정보</h2>
            <table class="tbl" cellpadding="0" cellspacing="0">
                <!-- 결제수단 : 포인트 -->
                <tr>
                    <th>결제수단</th>
                    <td>포 인 트</td>
                </tr>
                <!-- 포인트사 -->
                <tr>
                    <th>포인트사</th>
                    <td><?=$pnt_issue ?></td>
                </tr>
                <!-- 포인트 승인시간 -->
                <tr>
                    <th>포인트 승인시간</th>
                    <td><?=$pnt_app_time ?></td>
                </tr>
                <!-- 포인트 승인번호 -->
                <tr>
                    <th>포인트 승인번호</th>
                    <td><?=$pnt_app_no ?></td>
                </tr>
                <!-- 적립금액 or 사용금액 -->
                <tr>
                    <th>적립금액 or 사용금액</th>
                    <td><?=$pnt_amount ?></td>
                </tr>
                <!-- 발생 포인트 -->
                <tr>
                    <th>발생 포인트</th>
                    <td><?=$add_pnt ?></td>
                </tr>
                <!-- 사용가능 포인트 -->
                <tr>
                    <th>사용가능 포인트</th>
                    <td><?=$use_pnt ?></td>
                </tr>
                <!-- 총 누적 포인트 -->
                <tr>
                    <th>총 누적 포인트</th>
                    <td><?=$rsv_pnt ?></td>
                </tr>
            </table>

			<?}else if($use_pay_method == "000010000000"){		//휴대폰 결제 결과?>
				
			<h2>&sdot; 휴대폰 정보</h2>
            <table class="tbl" cellpadding="0" cellspacing="0">
                <!-- 결제수단 : 휴대폰 -->
                <tr>
                    <th>결제 수단</th>
                    <td>휴 대 폰</td>
                </tr>
                <!-- 승인시간 -->
                <tr>
                    <th>승인 시간</th>
                    <td><?=$app_time ?></td>
                </tr>
                <!-- 통신사코드 -->
                <tr>
                    <th>통신사 코드</th>
                    <td><?=$commid ?></td>
                </tr>
                <!-- 승인시간 -->
                <tr>
                    <th>휴대폰 번호</th>
                    <td><?=$mobile_no ?></td>
                </tr>
            </table>

			<?}else if($use_pay_method == "000000001000"){		//상품권 결제 결과?>

			<h2>&sdot; 상품권 정보</h2>
            <table class="tbl" cellpadding="0" cellspacing="0">
                <!-- 결제수단 : 상품권 -->
                <tr>
                    <th>결제 수단</th>
                    <td>상 품 권</td>
                </tr>
                <!-- 발급사 코드 -->
                <tr>
                    <th>발급사 코드</th>
                    <td><?=$tk_van_code ?></td>
                </tr>
                <!-- 승인시간 -->
                <tr>
                    <th>승인 시간</th>
                    <td><?=$app_time ?></td>
                </tr>
                <!-- 승인번호 -->
                <tr>
                    <th>승인 번호</th>
                    <td><?=$tk_app_no ?></td>
                </tr>
            </table>

			<?}?>

			<?if($cash_yn != ""){		//현금영수증?>

			<!-- 현금영수증 정보 출력-->
            <h1 style="font-size:1.3em; padding-top:25px;">현금영수증 정보</h1>
			<table cellspacing=0 cellpadding=0 class="pay_tbl2">
                <tr>
                    <th class="tb_bor_t">현금영수증 등록여부</th>
                    <td class="tb_bor_t"><?=$cash_yn ?></td>
                </tr>
		
				<?// 현금영수증이 등록된 경우 승인번호 값이 존재
					if ($cash_authno != ""){	
				?>
                <tr>
                    <th>현금영수증 승인번호</th>
                    <td><?=$cash_authno ?></td>
                </tr>
                <tr>
                    <th>영수증 확인</th>
                    <td>
						<input type="button" id="" name="" value="영수증 확인 " class="btn_st_bill" onclick="javascript:receiptView2('<?=$site_cd?>','<?=$ordr_idxx?>', '<?=$cash_yn?>', '<?=$cash_authno?>');">
					</td>
				</tr>
				<?}?>
			</table>
				
			<?}?>



			<?
						}
					}
				}
			?>

		</div>

		<div class="btn_box">
			<input type="button" id="pay_btn" name="pay_btn" class="btn_st_r" value="닫기" onclick="javascript:kcp_pop_close();">
		</div>


		</form>


	</div>

</div>