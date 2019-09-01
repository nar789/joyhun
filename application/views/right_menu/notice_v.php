		<div class="noti_frame" style="    height: 88px;">
			<div class="content_06_title height_26">
				<a href="/service_center/notice/noti_list"><p class="padding_top_15">공지사항</p></a>
				<a href="/service_center/notice/noti_list"><img src="<?=IMG_DIR?>/add_btn.png" class="margin_top_15"></a>
			</div>

			<div class="noti_box" style="">
				<ul style="">
					<?
						if(!$right_notice = $this->cache->get('right_notice')){
								$right_notice = board_list('2', 'notice_list', 'n_title,idx', 'n_date');
								$this->cache->save('right_notice', $right_notice, 600);	//10분 캐시 사용
						}

						foreach( $right_notice as $key => $val)
						{
					?>

					<li><a href="/service_center/notice/noti_view/idx/<?=$val['idx']?>"><?=trim_text($val['n_title'],46)?></a></li>

					<? } ?>
				</ul>
			</div>		<!-- ## noti_box END -->
		</div>		<!-- ## noti_frame END -->


		<style>
		.noti_box {
			width:210px;
			height:38px;
			margin-left:15px;
			margin-top: 10px;
		}

		.noti_box > ul {
			list-style-type:disc;
			font-size:12px;
			margin-left:17px;
			margin-top:12px;
			line-height: 18px;
		}

		.noti_box > ul > li {
			list-style:inherit;
			color:#ccc;
		}

		.noti_box > ul > li > a {
			color:#999;
		}
		
		</style>