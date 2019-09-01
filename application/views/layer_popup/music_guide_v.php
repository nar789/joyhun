	<div class="padding_20">
		<div class="line-height_18">음악채팅을 처음 실행하실 때 설치파일을 다운받으실 경우 아래와 같은 알림이 뜹니다.<br>
		본 프로그램은 조이헌팅에서 인증한 프로그램이니 안심하시고 아래의 방법으로 설치해주세요.</div>
		<div class="div_btn">
			<a href="http://app.joyhunting.com/DownFiles/JoyMusicChat/joyInstaller.exe">
				<img src="http://joyhunting.com/images/chatting/music_btn.png" >
			</a>
		</div>
	</div>
	<div class="tab_menu_box_set">
		<ul class="tab" id="tab">
			<li>윈도우 7의 경우
			<li>윈도우 10의 경우
		</ul>
	</div>
	<div class="tab_con" id="tab_con">
		<div>
			<img src="http://joyhunting.com/images/layer_popup/618.gif">
		</div>
		<div>
			<img src="http://joyhunting.com/images/layer_popup/617.gif">
		</div>
	</div>



<script>
$(function () {	
	tab('#tab',0);	
});

function tab(e, num){
    var num = num || 0;
    var menu = $(e).children();
    var con = $(e+'_con').children();
    var select = $(menu).eq(num);
    var i = num;

    select.addClass('on');
    con.eq(num).show();

    menu.click(function(){
        if(select!==null){
            select.removeClass("on");
            con.eq(i).hide();
        }

        select = $(this);	
        i = $(this).index();

        select.addClass('on');
        con.eq(i).show();
    });
}
</script>