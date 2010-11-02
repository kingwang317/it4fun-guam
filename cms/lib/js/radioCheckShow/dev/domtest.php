
<script src="http://lib.mobius.tw/jquery/jquery.js"></script>
<script>
$(document).ready(function(){
//$('p.goo:first').css('border','1px solid red');
$('#me').parent().find('.goo:first').css('border','1px solid red');
});
</script>
<style>
.goo {}
</style>
<p id="me">ppa1pp1p1p1p1p1p1p11pp1p11pp11p</p>
<p>p2pp2p2p2p2p2p2p2p2pp22p2p</p>
<p>p3p3p3p3p3p3p3p3pp3p3p3p3p3</p>
<p class="goo">p4p4p4p4p4p4p4p4p4p4p4p4p4pp4</p>
<p>p5p5p5p5p55pp5p5</p>
<p class="goo">6p6pp6p6p6p6p6p6p </p>
