{if $frame}
	{if $IE}
<<<<<<< HEAD
		<iframe id='e_layer3'
			style="
=======
<iframe id='e_layer3' style="
>>>>>>> gosa-core_v2.8
				position:absolute;
				width:100%;
				height:100%;
				top:0px;
				left:0px;
				border:none;
				border-style:none;
				border-width:0pt;
				display:block;
				allowtransparency='true';
				background-color: #FFFFFF;
				filter:chroma(color=#FFFFFF);
				z-index:100; ">
		</iframe>
		<div  id='e_layer2'
			style="
				position: absolute;
				left: 0px;
				top: 0px;
				right:0px;
				bottom:0px;
				z-index:100;
				width:100%;
				height:100%;
<<<<<<< HEAD
				filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true, sizingMethod=scale, src='images/opacity_black.png'); "
	>
=======
				filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true, sizingMethod=scale, src='images/opacity_black.png'); ">
>>>>>>> gosa-core_v2.8
	{else}
		<div  id='e_layer2'
			style="
				position: absolute;
				left: 0px;
				top: 0px;
				right:0px;
				bottom:0px;
				z-index:100;
				background-image: url(images/opacity_black.png);">
<<<<<<< HEAD

	{/if}
{else}


	{if !$JS}

		{if $i_Type == $smarty.const.INFO_DIALOG || $i_Type == $smarty.const.CONFIRM_DIALOG || $i_Type == $smarty.const.OK_CANCEL_DIALOG}
		<div id='e_layer{$i_ID}' class="infoMsgDialog" style='top:200px;left:200px;'>
    {else}
		<div id='e_layer{$i_ID}' class="errorMsgDialog" style='top:200px;left:200px;'>
    {/if}

			<div id="e_layerTitle{$i_ID}" class="errorMsgTitle">
			<table summary='{t}Error message title{/t}'><tr><td>
		{if $i_Type == $smarty.const.ERROR_DIALOG}
						{image path='images/error.png'}
		{elseif $i_Type == $smarty.const.WARNING_DIALOG}
						{image path='images/warning.png'}
		{elseif $i_Type == $smarty.const.INFO_DIALOG || $i_Type == $smarty.const.CONFIRM_DIALOG || $i_Type == $smarty.const.OK_CANCEL_DIALOG}
						{image path='images/warning.png'}
		{/if}
			</td><td style='font-size: 1.1em;vertical-align:middle;font-weight:bold;'>{$s_Title}</td></tr>
			</table>
			</div>
			<table summary='{t}Error message{/t}' 
          style='width:100%; border-top: solid 1px #BBBBBB;' cellspacing=0 cellpadding=2 border=0>
				<tr>
					<td style='width:100%;padding:7px; padding-bottom:14px'>
						{$s_Message}
						<br>
					</td>
				</tr>
				<tr>
					<td colspan='2' align='center'>
		{if $i_Type == $smarty.const.ERROR_DIALOG || $i_Type == $smarty.const.WARNING_DIALOG || $i_Type == $smarty.const.INFO_DIALOG}
						<button type='submit' name='MSG_OK{$i_ID}'>{t}OK{/t}</button> 
		{elseif $buttononst.CONFIRM_DIALOG || $i_Type == $smarty.const.OK_CANCEL_DIALOG}
						<button type='submit' name='MSG_OK{$i_ID}'>{t}OK{/t}</button>
						<button type='submit' name='MSG_CANCEL{$i_ID}'>{t}Cancel{/t}</button>
		{/if}
					</td>
				</tr>
			</table>
		</div>

	{else}

=======
{/if}
{else}

{if !$JS}
{if $i_Type == $smarty.const.INFO_DIALOG || $i_Type == $smarty.const.CONFIRM_DIALOG || $i_Type == $smarty.const.OK_CANCEL_DIALOG}
	<div id='e_layer{$i_ID}' class="modal" style='top:200px;left:200px;'>
{else}
	<div id='e_layer{$i_ID}' class="modal" style='top:200px;left:200px;'>
{/if}
		<div id="e_layerTitle{$i_ID}" class="modal-content">
			<div class="attention-head">
				{if $i_Type == $smarty.const.ERROR_DIALOG}
					{image path='<i class="material-icons left">error</i>'}
				{elseif $i_Type == $smarty.const.WARNING_DIALOG}
					{image path='<i class="material-icons left">warning</i>'}
				{elseif $i_Type == $smarty.const.INFO_DIALOG || $i_Type == $smarty.const.CONFIRM_DIALOG ||
					$i_Type == $smarty.const.OK_CANCEL_DIALOG}
					{image path='<i class="material-icons left">info_outline</i>'}
				{/if}

				<h2>{$s_Title}</h2>
			</div>

			<div class="attention-content">
				<p>
					{$s_Message}
				</p>
			</div>
		</div>

		<div class="modal-footer">
		{if $i_Type == $smarty.const.ERROR_DIALOG || $i_Type == $smarty.const.WARNING_DIALOG || $i_Type == $smarty.const.INFO_DIALOG}
			<button class="btn-small primary" type='submit' name='MSG_OK{$i_ID}'>{t}OK{/t}</button>
		{elseif $buttononst.CONFIRM_DIALOG || $i_Type == $smarty.const.OK_CANCEL_DIALOG}
			<button class="btn-small primary" type='submit' name='MSG_OK{$i_ID}'>{t}OK{/t}</button>
			<button class="btn-small primary" type='submit' name='MSG_CANCEL{$i_ID}'>{t}Cancel{/t}</button>
		{/if}
		</div>
	</div>
{else}
>>>>>>> gosa-core_v2.8
		{if $s_Trace != "" && $i_TraceCnt != 0}
		<div id='trace_{$i_ID}' style='display:none;'>
			{$s_Trace}
		</div>
<<<<<<< HEAD
		
		{/if}

    {if $i_Type == $smarty.const.INFO_DIALOG || $i_Type == $smarty.const.CONFIRM_DIALOG || $i_Type == $smarty.const.OK_CANCEL_DIALOG}
    <div id='e_layer{$i_ID}' class="infoMsgDialog" style='top:200px;left:200px;'>
    {else}
    <div id='e_layer{$i_ID}' class="errorMsgDialog" style='top:200px;left:200px;'>
    {/if}

		<div id="e_layerTitle{$i_ID}" class="errorMsgTitle">
			<table summary='{t}Error message title{/t}'><tr><td>
		{if $i_Type == $smarty.const.ERROR_DIALOG}
						{image path='images/error.png'}
		{elseif $i_Type == $smarty.const.WARNING_DIALOG}
						{image path='images/warning.png'}
		{elseif $i_Type == $smarty.const.INFO_DIALOG || $i_Type == $smarty.const.CONFIRM_DIALOG || $i_Type == $smarty.const.OK_CANCEL_DIALOG}
						{image path='images/info.png'}
		{/if}
			</td><td style='font-size: 1.1em;vertical-align:middle; font-weight:bold;'>{$s_Title}</td></tr>
		</table>
		</div>

			<table summary='{t}Error message{/t}' 
        style='z-index:250;width:100%; border-top: solid 1px #BBBBBB;' cellspacing=0 cellpadding=2 border=0>
				<tr>
					<td style='width:100%;padding:7px; padding-bottom:14px;'>
						{$s_Message}
						<br>
					</td>
					{if $s_Trace != "" && $i_TraceCnt != 0}
					<td style='width:20px;cursor:pointer;'>
						<div onClick="$('trace_{$i_ID}').toggle();"><u>Trace</u></div>
					</td>
					{/if}
				</tr>
				<tr>
					{if $s_Trace != "" && $i_TraceCnt != 0}
					<td colspan='3' align='center' style="border-top: solid 1px #BBBBBB;">
					{else}
					<td colspan='2' align='center' style="border-top: solid 1px #BBBBBB;">
					{/if}
		{if $i_Type == $smarty.const.ERROR_DIALOG || $i_Type == $smarty.const.WARNING_DIALOG || $i_Type == $smarty.const.INFO_DIALOG}
						<button id='MSG_OK{$i_ID}' type='button' name='MSG_OK{$i_ID}' 
              onClick='next_msg_dialog();'>{t}OK{/t}</button>
		{elseif $i_Type == $smarty.const.CONFIRM_DIALOG}
						<button id='MSG_OK{$i_ID}' type='submit' name='MSG_OK{$i_ID}' 
              onClick='next_msg_dialog();'>{t}OK{/t}</button>
						<button type='button' name='MSG_CANCEL{$i_ID}' 
              onClick='next_msg_dialog();'>{t}Cancel{/t}</button>
		{elseif $i_Type == $smarty.const.OK_CANCEL_DIALOG}
						<button id='MSG_OK{$i_ID}' type='submit' name='MSG_OK{$i_ID}' 
              onClick='next_msg_dialog();'>{t}OK{/t}</button>
						<button type='submit' name='MSG_CANCEL{$i_ID}' 
              onClick='next_msg_dialog();'>{t}Cancel{/t}</button>
		{/if}
					</td>
				</tr>
			</table>
      </div>
=======
{/if}

{if $i_Type == $smarty.const.INFO_DIALOG || $i_Type == $smarty.const.CONFIRM_DIALOG || $i_Type == $smarty.const.OK_CANCEL_DIALOG}
	<div id='e_layer{$i_ID}' class="modal" style='top:200px;left:200px;'>
{else}
	<div id='e_layer{$i_ID}' class="modal" style='top:200px;left:200px;'>
{/if}
		<div id="e_layerTitle{$i_ID}" class="modal-content attention-elem">
			<div class="attention-head">
				{if $i_Type == $smarty.const.ERROR_DIALOG}
					{image path='<i class="material-icons left">error</i>'}
				{elseif $i_Type == $smarty.const.WARNING_DIALOG}
					{image path='<i class="material-icons left">warning</i>'}
				{elseif $i_Type == $smarty.const.INFO_DIALOG || $i_Type == $smarty.const.CONFIRM_DIALOG ||
					$i_Type == $smarty.const.OK_CANCEL_DIALOG}
					{image path='<i class="material-icons left">info_outline</i>'}
				{/if}

				<h2>{$s_Title}</h2>
			</div>

			<div class="attention-content">
				<p>
					{$s_Message}
				</p>
			</div>
			{if $s_Trace != "" && $i_TraceCnt != 0}
				<div onClick="$('trace_{$i_ID}').toggle();"><u>Trace</u></div>
			{/if}
		</div>

		<div class="modal-footer">
		{if $i_Type == $smarty.const.ERROR_DIALOG || $i_Type == $smarty.const.WARNING_DIALOG || $i_Type == $smarty.const.INFO_DIALOG}
			<button class="btn-small primary" id='MSG_OK{$i_ID}' type='button' name='MSG_OK{$i_ID}' onClick='next_msg_dialog();'>{t}OK{/t}</button>
		{elseif $i_Type == $smarty.const.CONFIRM_DIALOG || $i_Type == $smarty.const.OK_CANCEL_DIALOG}
			<button class="btn-small primary" id='MSG_OK{$i_ID}' type='submit' name='MSG_OK{$i_ID}' onClick='next_msg_dialog();'>{t}OK{/t}</button>
			<button class="btn-small primary" type='button' name='MSG_CANCEL{$i_ID}' onClick='next_msg_dialog();'>{t}Cancel{/t}</button>
		{/if}
		</div>
	</div>

>>>>>>> gosa-core_v2.8
    <script language="JavaScript" type="text/javascript">
      focus_field('MSG_OK{$i_ID}');
    </script>

	{/if}
{/if}
