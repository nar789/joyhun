
	<div id="tmp"></div>

	<p class="color_333 blod font-size_18 margin_top_38" id="privacy_title"><?=$faq_title?></p>

	<?$seg = urldecode($this->uri->segment(3));?>
		
	<ul id="faq_cate" class="margin_top_19">
		<li id="idx_t" class="faq_cate_on"><a href="/service_center/faq/<?=$seg?>/<?=$chatset_sub?>">전체<p>(<?=faq_count($faq_title,'')?>)</p></a></li>
		<?
			$i = 0;

			foreach($cate as $key => $value){				
		?>
				<li id="idx_<?=$i?>"><a href="javascript:faq_cate('<?=$seg?>','<?=$faq_title?>','<?=$cate[$i]?>');"><?=$cate[$i]?><p>(<?=faq_count($faq_title,$cate[$i])?>)</p></a></li>
		<?
				$i = $i+1;
			}
		?>

	</ul>
