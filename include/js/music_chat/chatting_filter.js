var S_Time = new Date();	//���� �ð� ����
var C_Time, D_Time;
var Filter_ck = 0;			//���� ī���� ����

//ȭ�� ó�� �Լ�
function Print_Ment_Screen(Print_Ment_Width)
{
//	var alert_str = "<table width='"+Print_Ment_Width+"' cellpadding='0' cellspacing='0' border='0' align='center'>";
//	alert_str += "<tr>";
//	alert_str += "<td style='padding-left:15px;padding-right:15px;padding-top:5px;padding-bottom:5px;' class='ln16' align='centent'>";
//	alert_str += "<font color='#A9A9A9' face='����ü'>�ֱ� ";
//	alert_str += "<font color='#FF0000'><b>���Ǹ���</b></font>";
//	alert_str += "�� ������ ��� �� ";
//	alert_str += "<font color='#FF0000'><b>060�ҹ���ȭ</b></font>";
//	alert_str += "�� ���� ���ػ�ʰ� ����ϰ� �߻��ǰ� ������, ";
//	alert_str += "<font color='#FF0000'><b>�����䱸</b></font>";
//	alert_str += " �� ";
//	alert_str += "<font color='#FF0000'><b>060�ҹ���ȭ����</b></font>";
//	alert_str += "�� ���� ������ ���ð� �Ű� ��Ź�帳�ϴ�.</font>";
//	alert_str += "</td>";
//	alert_str += "</tr>";
//	alert_str += "</table>";

	var alert_str = "<table width='"+Print_Ment_Width+"' cellpadding='0' cellspacing='0' border='0' align='center'>";
	alert_str += "<tr>";
	alert_str += "<td style='padding-left:15px;padding-right:15px;padding-top:5px;padding-bottom:5px;' class='ln16' align='centent'>";
	alert_str += "<font color='#A9A9A9' face='����ü'>�ֱ� ";
	alert_str += "<font color='#FF0000'><b>���Ǹ���</b></font>";
	alert_str += "�� ���̷� ";
	alert_str += "<font color='#FF0000'><b>���Ա� �䱸, 060��ȭ��ȭ ����, ��ڻ�Ī, ȭ��ä�� ����, �ҹ�����Ʈ ����</b></font>";
	alert_str += "�� �����ϴ� ���� ��Ⱑ �߻��ϰ� ������ �����Ͻñ� �ٶ��ϴ�.</font> ";
	alert_str += "</td>";
	alert_str += "</tr>";
	alert_str += "</table>";

	return alert_str;
}

//�ð� üũ �Լ�
function Check_Timer(Chk_Min, Param_Width)
{
	var def_M, timer_return;
	timer_return = '';
	C_Time = new Date();										//���� �ð� �缳��
	D_Time = C_Time.getTime() - S_Time.getTime();				//�ð� �� ���

	def_M = (D_Time/1000) / 60;									//������ ȯ��

	if ((Filter_ck == 0) || (parseInt(def_M) >= Chk_Min)){		//ó�� ���ư��ų� �ش�ð��� �Ǿ��ų�
		S_Time = new Date();									//���۽ð� �缳��
		timer_return = Print_Ment_Screen(Param_Width);			//ȭ�鿡 ó���� �Լ�
		Filter_ck += 1;											//ī���� 1 ����
	}
	
	return timer_return;
}

//���ڿ� �� �˻� �Լ�(���� �ܾ�� Split�ϰ� �� ���̸� ��ȯ)
function SplitCheck_String(s_Str, c_Str)
{
	var fnc_return, split_string;
	split_string = s_Str.split(c_Str);
	fnc_return = split_string.length;
	return fnc_return;
}

//���ڿ� �� �˻� �Լ�
function Filter_Check(vals, time_chk, Table_Width)
{
	//check_ment �� �迭�������� ���� �߰�
	var i, chk_S, filter_return;
	var Check_ment = ['�Ա�','��ü','�۱�','����','���¹�ȣ','��ŷ','����','����','����','����',
						'060','���Ǹ���','����','������','����','����',
						'����','�ʸ���','10����','20����','30����','070','����'];

	filter_return = '';

	for (i=0; i<Check_ment.length; i++){
		chk_S = SplitCheck_String(vals, Check_ment[i]);

		if (chk_S > 1){													//�� ����� ���� ���, �ð� üũ
			filter_return = Check_Timer(time_chk, Table_Width);			//�Ķ��Ÿ�� �ð� ����(����:��), Table Width
			break;
		}
	}

	return filter_return;
}
