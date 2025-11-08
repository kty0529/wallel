<?php
	function browser_update_alert() {
		ob_start();
?>
		<!--[if lte IE 9]>
		<div style="position: fixed; top: 0; left: 0; z-index: 999999; width: 100%; height: 100%;"><table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td valign="middle" align="center">
			<p>현재 사용 중인 브라우저는 오래되었습니다.<br><span style="color: red;"><?php echo bloginfo( 'name' ); ?>은 구형 브라우저를 지원하지 않습니다.</span></p>
			<p>안전한 웹 이용을 위해 반드시 최신 브라우저를 이용해주시기 바랍니다.<br>만약 최신 브라우저를 이용할 수 없는 상황이라면 구글 크롬과 같은 브라우저를 이용해주시기 바랍니다.</p>
			<p>감사합니다.</p>
			<p><a href="http://browser-update.org/update-browser.html#3" target="_blank" rel="nofollow noopener" style="color: blue; text-decoration: underline;">※ 왜 최신 브라우저가 필요합니까?</a></p>
		</td></tr></tbody></table></div>
		<div style="position: fixed; top: 0; left: 0; z-index: 999990; width: 100%; height: 100%; background-color: #fff; opacity: 0.95;"></div>
		<![endif]-->
<?php
		$output = ob_get_flush();

		return $output;
	}
