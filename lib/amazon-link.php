<?php
if ($availability == "Y") {
?>
<script language="JavaScript">
function popUp(URL,NAME) {
	amznwin=window.open(URL,NAME,'location=yes,scrollbars=yes,status=yes,toolbar=yes,resizable=yes,width=380,height=450,screenX=10,screenY=10,top=10,left=10');
	amznwin.focus();
}
document.open();
document.write("<a href=javascript:popUp('http://buybox.amazon.com/exec/obidos/redirect?tag=teamspam&link_code=qcb&creative=23424&camp=2025&path=/dt/assoc/tg/aa/xml/assoc/-/<?php echo $asin; ?>/teamspam/ref=ac_bb5_,_amazon')><img src=http://rcm-images.amazon.com/images/G/01/associates/remote-buy-box/buy5.gif border=0 alt='Buy from Amazon.com' ></a>");
document.close();
</script>
<noscript>
<form method="POST" action="http://buybox.amazon.com/o/dt/assoc/handle-buy-box=<?php echo $asin; ?>">
<input type="hidden" name="asin.<?php echo $asin; ?>" value="1" />
<input type="hidden" name="tag-value" value="teamspam" />
<input type="hidden" name="tag_value" value="teamspam" />
<input type="image" name="submit.add-to-cart" value="Buy from Amazon.com" border="0" alt="Buy from Amazon.com" src="http://rcm-images.amazon.com/images/G/01/associates/add-to-cart.gif" />
</form>
</noscript>
<?php
		} else {
?>
<a href="http://www.amazon.com/exec/obidos/ASIN/<?php echo $asin; ?>/teamspam" target="_blank">Limited Availability</a>
<?php
		}
?>