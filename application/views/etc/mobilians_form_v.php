<?
	//모빌리언스 결제방법별 form값 정리
?>

<form id="payForm" name="payForm" accept-charset="euc-kr">
	
	<? if($payform['CASH_GB'] == "MC"){ ?>
	
	<!-- 모빌리언스 휴대폰 결제 -->
	<input type="hidden" id="CASH_GB"			name="CASH_GB"				   value="<?=@$payform['CASH_GB']?>"		 >   
	<input type="hidden" id="Okurl"				name="Okurl"				   value="<?=@$payform['Okurl']?>"			 >   
	<input type="hidden" id="MC_SVCID"			name="MC_SVCID"				   value="<?=@$payform['MC_SVCID']?>"		 > 
	<input type="hidden" id="Prdtnm"			name="Prdtnm"				   value="<?=@$payform['Prdtnm']?>"			 > 
	<input type="hidden" id="Prdtprice"			name="Prdtprice"			   value="<?=@$payform['Prdtprice']?>"		 >   
	<input type="hidden" id="Siteurl"			name="Siteurl"				   value="<?=@$payform['Siteurl']?>"		 >   
	<input type="hidden" id="PAY_MODE"			name="PAY_MODE"				   value="<?=@$payform['PAY_MODE']?>"		 > 
	<input type="hidden" id="Tradeid"			name="Tradeid"				   value="<?=@$payform['Tradeid']?>"		 >   
	<input type="hidden" id="LOGO_YN"			name="LOGO_YN"				   value="<?=@$payform['LOGO_YN']?>"		 >   
	<input type="hidden" id="CALL_TYPE"			name="CALL_TYPE"			   value="<?=@$payform['CALL_TYPE']?>"		 >   
	<input type="hidden" id="MC_AUTHPAY"		name="MC_AUTHPAY"			   value="<?=@$payform['MC_AUTHPAY']?>"		 > 
	<input type="hidden" id="Notiurl"			name="Notiurl"				   value="<?=@$payform['Notiurl']?>"		 >   
	<input type="hidden" id="MC_AUTOPAY"		name="MC_AUTOPAY"			   value="<?=@$payform['MC_AUTOPAY']?>"		 > 
	<input type="hidden" id="Closeurl"			name="Closeurl"				   value="<?=@$payform['Closeurl']?>"		 > 
	<input type="hidden" id="MC_PARTPAY"		name="MC_PARTPAY"			   value="<?=@$payform['MC_PARTPAY']?>"		 > 
	<input type="hidden" id="Failurl"			name="Failurl"				   value="<?=@$payform['Failurl']?>"		 >   
	<input type="hidden" id="MC_No"				name="MC_No"				   value="<?=@$payform['MC_No']?>"			 >   
	<input type="hidden" id="MC_FIXNO"			name="MC_FIXNO"				   value="<?=@$payform['MC_FIXNO']?>"		 > 
	<input type="hidden" id="MC_Cpcode"			name="MC_Cpcode"			   value="<?=@$payform['MC_Cpcode']?>"		 >   
	<input type="hidden" id="Userid"			name="Userid"				   value="<?=@$payform['Userid']?>"			 > 
	<input type="hidden" id="Item"				name="Item"					   value="<?=@$payform['Item']?>"			 > 
	<input type="hidden" id="Prdtcd"			name="Prdtcd"				   value="<?=@$payform['Prdtcd']?>"			 > 
	<input type="hidden" id="Payeremail"		name="Payeremail"			   value="<?=@$payform['Payeremail']?>"		 > 
	<input type="hidden" id="MC_DEFAULTCOMMID"	name="MC_DEFAULTCOMMID"		   value="<?=@$payform['MC_DEFAULTCOMMID']?>"> 
	<input type="hidden" id="MC_FIXCOMMID"		name="MC_FIXCOMMID"			   value="<?=@$payform['MC_FIXCOMMID']?>"	 >	 
	<input type="hidden" id="MSTR"				name="MSTR"					   value="<?=@$payform['MSTR']?>"			 > 
	<input type="hidden" id="Sellernm"			name="Sellernm"				   value="<?=@$payform['Sellernm']?>"		 > 
	<input type="hidden" id="Sellertel"			name="Sellertel"			   value="<?=@$payform['Sellertel']?>"		 >   
	<input type="hidden" id="Notiemail"			name="Notiemail"			   value="<?=@$payform['Notiemail']?>"		 >	   
	<input type="hidden" id="IFRAME_NAME"		name="IFRAME_NAME"			   value="<?=@$payform['IFRAME_NAME']?>"	 >   
	<input type="hidden" id="INFOAREA_YN"		name="INFOAREA_YN"			   value="<?=@$payform['INFOAREA_YN']?>"	 >   
	<input type="hidden" id="FOOTER_YN"			name="FOOTER_YN"			   value="<?=@$payform['FOOTER_YN']?>"		 >   
	<input type="hidden" id="HEIGHT"			name="HEIGHT"				   value="<?=@$payform['HEIGHT']?>"			 > 
	<input type="hidden" id="PRDT_HIDDEN"		name="PRDT_HIDDEN"			   value="<?=@$payform['PRDT_HIDDEN']?>"	 >   
	<input type="hidden" id="EMAIL_HIDDEN"		name="EMAIL_HIDDEN"		       value="<?=@$payform['EMAIL_HIDDEN']?>"	 > 
	<input type="hidden" id="CONTRACT_HIDDEN"	name="CONTRACT_HIDDEN"	       value="<?=@$payform['CONTRACT_HIDDEN']?>" >	 
	<input type="hidden" id="Cryptyn"			name="Cryptyn"				   value="<?=@$payform['Cryptyn']?>"		 >		   
	<input type="hidden" id="Cryptstring"		name="Cryptstring"			   value="<?=@$payform['Cryptstring']?>"	 >   
	<input type="hidden" id="Crypthash"			name="Crypthash"			   value="<?=@$payform['Crypthash']?>"		 >   
	<input type="hidden" id="MC_EZ_YN"			name="MC_EZ_YN"				   value="<?=@$payform['MC_EZ_YN']?>"		 > 
	<input type="hidden" id="MC_EZ_KEY"			name="MC_EZ_KEY"			   value="<?=@$payform['MC_EZ_KEY']?>"		 >   			
	
	<? }else if($payform['CASH_GB'] == "VA"){ ?>
	
	<!-- 모빌리언스 가상계좌 결제 -->
	<input type="hidden" id="CASH_GB"   	    name="CASH_GB"   	    value="<?=@$payform['CASH_GB']?>"   		>
	<input type="hidden" id="Okurl"		        name="Okurl"		    value="<?=@$payform['Okurl']?>"				>
	<input type="hidden" id="VA_SVCID"			name="VA_SVCID"	        value="<?=@$payform['VA_SVCID']?>"	        >
	<input type="hidden" id="Prdtnm"	        name="Prdtnm"	        value="<?=@$payform['Prdtnm']?>"			>
	<input type="hidden" id="Prdtprice"	        name="Prdtprice"	    value="<?=@$payform['Prdtprice']?>"			>
	<input type="hidden" id="Siteurl"	        name="Siteurl"	        value="<?=@$payform['Siteurl']?>"	        >
	<input type="hidden" id="PAY_MODE"	        name="PAY_MODE"	        value="<?=@$payform['PAY_MODE']?>"	        >
	<input type="hidden" id="Tradeid"	        name="Tradeid"	        value="<?=@$payform['Tradeid']?>"	        >
	<input type="hidden" id="LOGO_YN"	        name="LOGO_YN"	        value="<?=@$payform['LOGO_YN']?>"	        >
	<input type="hidden" id="CALL_TYPE"	        name="CALL_TYPE"	    value="<?=@$payform['CALL_TYPE']?>"			>
	<input type="hidden" id="Notiurl"	        name="Notiurl"	        value="<?=@$payform['Notiurl']?>"	        >
	<input type="hidden" id="Closeurl"	        name="Closeurl"	        value="<?=@$payform['Closeurl']?>"	        >
	<input type="hidden" id="Failurl"	        name="Failurl"	        value="<?=@$payform['Failurl']?>"	        >
	<input type="hidden" id="Userid"	        name="Userid"	        value="<?=@$payform['Userid']?>"			>
	<input type="hidden" id="Item"		        name="Item"		        value="<?=@$payform['Item']?>"		        >
	<input type="hidden" id="Prdtcd"	        name="Prdtcd"	        value="<?=@$payform['Prdtcd']?>"			>
	<input type="hidden" id="Payeremail"        name="Payeremail"       value="<?=@$payform['Payeremail']?>"		>
	<input type="hidden" id="MSTR"		        name="MSTR"		        value="<?=@$payform['MSTR']?>"		        >
	<input type="hidden" id="Notiemail"	        name="Notiemail"	    value="<?=@$payform['Notiemail']?>"			>
	<input type="hidden" id="IFRAME_NAME"       name="IFRAME_NAME"      value="<?=@$payform['IFRAME_NAME']?>"		>
	<input type="hidden" id="INFOAREA_YN"       name="INFOAREA_YN"      value="<?=@$payform['INFOAREA_YN']?>"		>
	<input type="hidden" id="FOOTER_YN"	        name="FOOTER_YN"	    value="<?=@$payform['FOOTER_YN']?>"			>
	<input type="hidden" id="HEIGHT"	        name="HEIGHT"	        value="<?=@$payform['HEIGHT']?>"			>
	<input type="hidden" id="PRDT_HIDDEN"       name="PRDT_HIDDEN"      value="<?=@$payform['PRDT_HIDDEN']?>"		>
	<input type="hidden" id="CONTRACT_HIDDEN"   name="CONTRACT_HIDDEN"  value="<?=@$payform['CONTRACT_HIDDEN']?>"	>
	<input type="hidden" id="Cryptyn"	        name="Cryptyn"	        value="<?=@$payform['Cryptyn']?>"	        >
	<input type="hidden" id="Cryptstring"       name="Cryptstring"      value="<?=@$payform['Cryptstring']?>"		>
	<input type="hidden" id="VA_Rcptlimitdt"    name="VA_Rcptlimitdt"   value="<?=@$payform['VA_Rcptlimitdt']?>"	>
	<input type="hidden" id="VA_Acctlimitdt"    name="VA_Acctlimitdt"   value="<?=@$payform['VA_Acctlimitdt']?>"	>
	<input type="hidden" id="Username"	        name="Username"			value="<?=@$payform['Username']?>"	        >
	
	<? }else if($payform['CASH_GB'] == "PB"){ ?>
	
	<!-- 모빌리언스 폰빌 결제(일반전화 받기) -->
	<input type="hidden" id="CASH_GB"			name="CASH_GB"			  value="<?=@$payform['CASH_GB']?>"			>
	<input type="hidden" id="PAY_MODE"	        name="PAY_MODE"	          value="<?=@$payform['PAY_MODE']?>"		>
	<input type="hidden" id="PB_SVCID"	        name="PB_SVCID"	          value="<?=@$payform['PB_SVCID']?>"		>
	<input type="hidden" id="Tradeid"	        name="Tradeid"	          value="<?=@$payform['Tradeid']?>"			>
	<input type="hidden" id="Siteurl"	        name="Siteurl"	          value="<?=@$payform['Siteurl']?>"			>
	<input type="hidden" id="Okurl"		        name="Okurl"		      value="<?=@$payform['Okurl']?>"			>
	<input type="hidden" id="Prdtnm"	        name="Prdtnm"	          value="<?=@$payform['Prdtnm']?>"			>
	<input type="hidden" id="Prdtprice"	        name="Prdtprice"	      value="<?=@$payform['Prdtprice']?>"		>
	<input type="hidden" id="CALL_TYPE"	        name="CALL_TYPE"	      value="<?=@$payform['CALL_TYPE']?>"		>
	<input type="hidden" id="LOGO_YN"	        name="LOGO_YN"	          value="<?=@$payform['LOGO_YN']?>"			>
	<input type="hidden" id="Failurl"	        name="Failurl"	          value="<?=@$payform['Failurl']?>"			>
	<input type="hidden" id="MSTR"		        name="MSTR"		          value="<?=@$payform['MSTR']?>"			>
	<input type="hidden" id="Notiemail"	        name="Notiemail"	      value="<?=@$payform['Notiemail']?>"		>
	<input type="hidden" id="Notiurl"	        name="Notiurl"	          value="<?=@$payform['Notiurl']?>"			>
	<input type="hidden" id="Payeremail"        name="Payeremail"         value="<?=@$payform['Payeremail']?>"		>
	<input type="hidden" id="Userid"	        name="Userid"	          value="<?=@$payform['Userid']?>"			>
	<input type="hidden" id="Prdtcd"	        name="Prdtcd"	          value="<?=@$payform['Prdtcd']?>"			>
	<input type="hidden" id="Item"		        name="Item"		          value="<?=@$payform['Item']?>"			>
	<input type="hidden" id="Cryptstring"       name="Cryptstring"        value="<?=@$payform['Cryptstring']?>"		>
	<input type="hidden" id="Cryptyn"	        name="Cryptyn"	          value="<?=@$payform['Cryptyn']?>"			>
	<input type="hidden" id="EMAIL_HIDDEN"      name="EMAIL_HIDDEN"       value="<?=@$payform['EMAIL_HIDDEN']?>"	>
	<input type="hidden" id="PB_DEFAULTCOMMID"  name="PB_DEFAULTCOMMID"   value="<?=@$payform['PB_DEFAULTCOMMID']?>">
	<input type="hidden" id="PB_Cpcode"	        name="PB_Cpcode"	      value="<?=@$payform['PB_Cpcode']?>"		>
	
	<? }else if($payform['CASH_GB'] == "TP"){ ?>
	
	<!-- 모빌리언스 일반전화 걸기 결제 -->
	<input type="hidden" id="Okurl"				name="Okurl"				value="<?=@$payform['Okurl']?>"			>
	<input type="hidden" id="Prdtnm"			name="Prdtnm"				value="<?=@$payform['Prdtnm']?>"		>
	<input type="hidden" id="Prdtprice"		    name="Prdtprice"		    value="<?=@$payform['Prdtprice']?>"     >
	<input type="hidden" id="Siteurl"			name="Siteurl"				value="<?=@$payform['Siteurl']?>"		>
	<input type="hidden" id="Tradeid"			name="Tradeid"				value="<?=@$payform['Tradeid']?>"		>
	<input type="hidden" id="PAY_MODE"		    name="PAY_MODE"				value="<?=@$payform['PAY_MODE']?>"      >
	<input type="hidden" id="CALL_TYPE"		    name="CALL_TYPE"		    value="<?=@$payform['CALL_TYPE']?>"     >
	<input type="hidden" id="LOGO_YN"			name="LOGO_YN"				value="<?=@$payform['LOGO_YN']?>"		>
	<input type="hidden" id="Failurl"			name="Failurl"				value="<?=@$payform['Failurl']?>"		>
	<input type="hidden" id="MSTR"				name="MSTR"					value="<?=@$payform['MSTR']?>"			>
	<input type="hidden" id="Notiemail"		    name="Notiemail"		    value="<?=@$payform['Notiemail']?>"     >
	<input type="hidden" id="Notiurl"			name="Notiurl"				value="<?=@$payform['Notiurl']?>"		>
	<input type="hidden" id="Payeremail"	    name="Payeremail"			value="<?=@$payform['Payeremail']?>"    >
	<input type="hidden" id="Userid"			name="Userid"				value="<?=@$payform['Userid']?>"		>
	<input type="hidden" id="Prdtcd"			name="Prdtcd"				value="<?=@$payform['Prdtcd']?>"		>
	<input type="hidden" id="Item"				name="Item"					value="<?=@$payform['Item']?>"			>
	<input type="hidden" id="CASH_GB"			name="CASH_GB"				value="<?=@$payform['CASH_GB']?>"		>
	<input type="hidden" id="EMAIL_HIDDEN"		name="EMAIL_HIDDEN"			value="<?=@$payform['EMAIL_HIDDEN']?>"  >
	<input type="hidden" id="Cryptstring"	    name="Cryptstring"			value="<?=@$payform['Cryptstring']?>"   >
	<input type="hidden" id="Cryptyn"			name="Cryptyn"				value="<?=@$payform['Cryptyn']?>"		>
	<input type="hidden" id="TP_SVCID"		    name="TP_SVCID"				value="<?=@$payform['TP_SVCID']?>"		>
	<input type="hidden" id="Opcode"			name="Opcode"				value="<?=@$payform['Opcode']?>"		>
	
	<? } ?>

</form>