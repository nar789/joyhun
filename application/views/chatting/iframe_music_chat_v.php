<!--음악채팅 실행부분. 스크립트밖에 없어서, 스크립트만 사용.-->
<script>
	var iCheckSum = 0;

	function waitObjectComplete(sid)
	{

	document.writeln('<OBJECT ID="JoyhuntingSmart1" WIDTH=1 HEIGHT=1 CLASSID="CLSID:D6387E7B-D3BF-4164-96FC-ABEB3C686143" codebase="http://app.joyhunting.com/DownFiles/JoySmartInstall_Vista.cab#version=1,0,0,4">');
	document.writeln('</OBJECT>');


		iCheckSum = iCheckSum + 1;

		try
		{
			
			JoyhuntingSmart1.IsInstalling();

			InstallProgram(sid);
		}
		catch(exception)
		{
			document.getElementById("lodingDiv").style.display='none';
			document.getElementById("activexDiv").style.display='block';
			if( iCheckSum == 720 )
			{
				location.reload();
				iCheckSum = 0;
			}
			else
				setTimeout('waitObjectComplete();', 250 );			
		}	
	}

	function InstallProgram(sid)
	{
		try
		{
			JoyhuntingSmart1.SetInstallerVersion( "1.0.0.71" );

			JoyhuntingSmart1.SetInstallInfo( "영화음악채팅", "Program Files\\ANIJ\\Joyhunting\\BroadcastMedia", "BCMClient", "1.0.0.6", "http://app.joyhunting.com/DownFiles/BroadcastMedia/BCMClient.ini", "NA", "-", "Y", "N" );

			var	sId         = sid;
			var sConfing=sId;

			JoyhuntingSmart1.SetInstallInfo( "음악채팅On", "Program Files\\ANIJ\\Joyhunting\\JoyMusicChat", "JoyMusicChatClient", "1.0.0.38", "http://app.joyhunting.com/DownFiles/JoyMusicChat/JoyMusicChatClient.ini", "JoyMusicChatClient.exe", sConfing, "Y", "N" );

			JoyhuntingSmart1.InstallStart();

			setTimeout('IsInstall();', 1000 );
		}
		catch(exception)
		{
			alert( 'install fail' );
		}
	}

	function IsInstall()
	{
		try
		{
			var nRet = JoyhuntingSmart1.IsInstalling();

			if( nRet != 0 )	setTimeout('IsInstall();', 1000 );			
		}
		catch(exception)
		{
			setTimeout('IsInstall();', 1000 );			
		}	
	}

	waitObjectComplete('<?=$user_id?>');
</script>