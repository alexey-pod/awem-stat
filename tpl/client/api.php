<?
include ("inc/top_block.php");
?>


<h1>Описание API</h1>
	
<div class="api_page">
	
	<p>
		<b>Отправка запроса:</b>
	</p>
	<p><b>url:</b> <a target="_blank" href="http://{$smarty.server.HTTP_HOST}/api/add">http://{$smarty.server.HTTP_HOST}/api/add</a></p>
	<p><b>метод отправки:</b> POST</p>
	<p><b>обязательные поля:</b> user_id, device_id, platform, data</p>
	<p>
		<ul>
			<li><b>user_id</b> - ID игрока  в Facebook </li>
			<li><b>datetime</b> - игровое время  события в формате unix timestamp  </li>
			<li><b>device_id</b> - ID устройства  ( строка , 64  символа )</li>
			<li><b>platform</b> - платформа  устройства  (iPad, iPhone)  </li>
			<li><b>data</b> - набор произвольных данных( например,  устройство  отсылает  событие  с параметрами  Event=Start, Money=15444  и т.д.)   </li>
		</ul>
	</p>
	{literal}
	<p>
		<b>Ответ при успешном выполнени запроса:</b> {"response":{"result":"done"}}
	</p>
	<p>
		<b>Ответ при ошибке:</b> {"error":{"error_code":1,"error_msg":"empty data"}}
	</p>
	{/literal}
	
	
	
	<br><br><br>
	<h1>Тестирование API</h1>
	<div id="api_form" class="page_form"> 
		<table>
			<tbody>
				<tr>
					<td class="name">user_id:</td>
					<td class="star"></td>
					<td class="value"><input type="text" value="" id="user_id"></td>
				</tr>
				<tr>
					<td class="name">datetime :</td>
					<td class="star"></td>
					<td class="value">
						<input type="text" value="" id="datetime">
					</td>
				</tr>
				<tr>
					<td class="name">device_id :</td>
					<td class="star"></td>
					<td class="value"><input type="text" value="" id="device_id"></td>
				</tr>
				<tr>
					<td class="name">platform :</td>
					<td class="star"></td>
					<td class="value">
						<select onchange="" style="width:80px;" id="platform">
							<option value="">- - -</option>
							<option value="iphone">iphone</option>
							<option value="ipad">ipad</option>
						</select>
					</td>
				</tr>
				<tr>
					<td class="name">data :</td>
					<td class="star"></td>
					<td class="value"><input type="text" value="" id="data"></td>
				</tr>
				
				<tr class="error hide">
					<td class="name"></td>
					<td class="star"></td>
					<td class="value">
						<div class="error">**</div>
						<div class="done">**</div>
					</td>
				</tr> 
			
			</tbody>
		</table>
		<!-- <div class="h_rasp">&nbsp;</div> -->
		<div class="button_container">
			<button onclick="p_obj.send();" class="button send">Отправить</button>
			<div class="load"></div>
		</div>
	</div>
		
</div>

<script language="JavaScript">

	function pageClass(){// 
		
		//this.script_url = '';
		this.script_url = '/respondents/script_client.php'; // урл респондента
		var self=this;
		this.ajax_load = 0;
		
		this.init = function(){
			//console.log( document.location )
			
			//loc_awem_stat.ru
			
			//this.script_url = 'http://'+document.location.hostname

			//console.log('this.script_url='+this.script_url+'/api/add');
			
			$$( "#datetime" ).datepicker({
				buttonImageOnly: true,
				dateFormat: 'dd-mm-yy'
			});// END datepicker
			
			// поправить дату
			var d = new Date();
			var datetime=Math.floor(d.getTime()/1000);
			$('datetime').value= fn.parseDate('d-m-Y', datetime) ;
			
		}
		this.send = function(){
			
			if(this.ajax_load==1){
				return;
			}
			this.ajax_load=1;
			
			$$('#api_form TR.error').hide();
			
			var config = {};
			config.user_id = $$('#user_id').val();
			config.datetime  = $$('#datetime').val();
			config.device_id  = $$('#device_id').val();
			config.platform   = $$('#platform').val();
			config.data   = $$('#data').val();
			config.mode = 'apiAddData';
			
			
			/*
			$$.ajax({
				url: this.script_url,
				context: this,
				dataType: 'json',
				type: "POST",
				data: config
			})
			.complete(function(result) {
				 console.info('ajax - complete');
			});
			
			*/
			
			$$('#api_form .button_container .load').show();
			$$('#api_form .button_container .button').addClass('disabled');
			
			$$.ajax({
				type: "POST",
				url: this.script_url,
				data: config,
				dataType: 'json',
				success: function(a){
					//console.log(a)
					$$('#api_form TR.error').show();
					
					var a_str = JSON.stringify(a, "", 4);
					
					if(a.error!=undefined){
						$$('#api_form TR.error .value').html('<div class="error">'+a_str+'</div>');
					}
					if(a.response!=undefined){
						$$('#api_form TR.error .value').html('<div class="done">'+a_str+'</div>');
					}
					
					$$('#api_form .button_container .load').hide();
					$$('#api_form .button_container .button').removeClass('disabled');
					self.ajax_load=0;
				}// END success
			});// END ajax
			
			
		}//END
	}// END pageClass p_obj
	
	$$(function(){
		p_obj = new pageClass();
		p_obj.init();
	});
	
	
	
</script>

	
<?
include ("/inc/bottom_block.php");
?>