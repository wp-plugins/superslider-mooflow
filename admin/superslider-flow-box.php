<?php
$box = '
<form id="flowshort" name="flowshort"  action="">
		
			<label class ="ss_label" for="reflection">Reflection: 
			<input tabindex="50" type="text" class="ss_input" name="reflection" id="reflection" size="4" maxlength="4" value="'.$reflection.'" /> </label> 
			
			<label class ="ss_label" for="heightRatio">heightRatio:
			<input tabindex="51" type="text" class="ss_input" name="heightRatio" id="heightRatio" size="4" maxlength="4" value="'.$heightRatio.'" /></label>

			<label class ="ss_label" for="offsetY">offsetY:
			<input tabindex="52" type="text" class="ss_input" name="offsetY" id="offsetY" size="4" maxlength="4" value="'.$offsetY.'" /></label>

			<label class ="ss_label" for="startIndex">startIndex:
			<input tabindex="53" type="text" class="ss_input" name="startIndex" id="startIndex" size="4" maxlength="4" value="'.$startIndex.'" /></label>

			<label class ="ss_label" for="interval">interval:
			<input tabindex="54" type="text" class="ss_input" name="interval" id="interval" size="4" maxlength="4" value="'.$interval.'" /></label>

			<label class ="ss_label" for="factor">factor:
			<input tabindex="55" type="text" class="ss_input" name="factor" id="factor" size="4" maxlength="4" value="'.$factor.'" /></label>

			<label class ="ss_label" for="bgColor">bgColor:
			<input tabindex="56" type="text" class="ss_input" name="bgColor" id="bgColor" size="4" maxlength="7" value="'.$bgColor.'" /></label>
			
			<label class ="ss_label" for="useAutoPlay">
			<input tabindex="57" name="useAutoPlay" id="useAutoPlay" type="checkbox" /> useAutoPlay</label>

			<label class ="ss_label" for="useViewer">
			<input tabindex="58" name="useViewer" id="useViewer" type="checkbox" /> useViewer</label>
			
            <label class ="ss_label" for="useCaption">
			<input tabindex="59" name="useCaption" id="useCaption" type="checkbox" /> useCaption</label>
			
			<label class ="ss_label" for="useResize">
			<input tabindex="60" name="useResize" id="useResize" type="checkbox" /> useResize</label>
			
			<label class ="ss_label" for="useSlider">
			<input tabindex="61" name="useSlider" id="useSlider" type="checkbox" /> useSlider</label>
			
			<label class ="ss_label" for="useWindowResize">
			<input tabindex="62" name="useWindowResize" id="useWindowResize" type="checkbox" /> useWindowResize</label>
			
			<label class ="ss_label" for="useMouseWheel">
			<input tabindex="63" name="useMouseWheel" id="useMouseWheel" type="checkbox" /> useMouseWheel</label>
			
			<label class ="ss_label" for="useKeyInput">
			<input tabindex="64" name="useKeyInput" id="useKeyInput" type="checkbox" /> useKeyInput</label>
			
			<label class ="ss_label" for="addMilk">
			<input tabindex="65" name="addMilk" id="addMilk" type="checkbox" /> addMilk</label>
			
			<label class ="ss_label" for="addJson">
			<input tabindex="66" name="addJson" id="addJson" type="checkbox" /> addJson</label>
			
			<label class ="ss_label" for="addAjax">
			<input tabindex="67" name="addAjax" id="addAjax" type="checkbox" /> addAjax</label>

			
			<input type="button" tabindex="68" value="Add MooFlow" name="flowtotextfield" id="flowtotextfield" class="button-primary action" style="margin:10px 40px 0 10px; float: right;" onclick="addflow(); return false;" />
			
</form>
<br style="clear:both;" /><p>This shortcode helper presently only works for the Html view. Selecting any of the above options will add that option to the shortcode. If you want to then set an option to false, just change the property of the option in the shortcode inside of your post window.</p>

';
?>