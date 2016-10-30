<?
include ("inc/top_block.php");
?>

<table width="100%">
	<tr>
		<td valign="top">
			<div id="mainPage" style="display:none;">
				<!-- содержимое главной страницы -->
				<h1 >Статистика</h1>
				
				<div class="button_container">
					<!-- <div class="reload" onclick="p_obj.bildPage();"></div> -->
					<button class="button send" onclick="p_obj.bildPage();">Обновить</button>
					<button class="button send" onclick="p_obj.deleteItemAll();">Очистить базу</button>
					<button class="button send" onclick="p_obj.fillTestData();">Сгенерировать тестовые данные</button>
					<div class="load"></div>
				</div>
					
					
				

				
				<div style="margin-top:10px; margin-left:2px; clear:both;">
					
					<div id="item_array_page_nave_top" class="pages_container_small"></div>
				</div>
				<div id="item_array_div" style="">
					<!--  здесь показывается таблица   -->
					<table style="width:40%;" cellspacing="1" cellpadding="0" class="o_table" id="item_array_table" >
						<tbody id="item_array_tbody"></tbody>
					</table>
					<!--END здесь показывается таблица   -->
				</div>
				
			</div>
			<div id="editPage" style="display:none;">
				<div id="editPageLoading" style="display:none;"><!-- здесь показывается значок загрузки  --></div>
				<div id="editPageBody" style="display:none;">
					<!-- здесь показывается содержимое редактируемой страницы  -->
					<h3 class="head_2">
						<div id="header">
							<script>
								var str=$$('#main_left_menu A.active_menu SPAN').html();
								document.write(str+' - Редактирование');
							</script>
						</div>
					</h3>
					<table width="80%" cellspacing="1" cellpadding="0" border="0" style="" class="o_table" >
						<tr><!--  кнопки: добавить, удалить, вперёд, назад -->
							<td colspan="2" style="" class="module_top_ui">
								<div class="top_panel">
									<div style="display:inline-block;">
										<input 								type="button" value="Отмена"    				onclick="p_obj.cancelItem();"/>
										<input id="item_save_button_up" 		type="button" value="Сохранить" 			onclick="p_obj.doButtonSave();" />
										<input id="item_saveclose_button_up" 	type="button" value="Сохранить и закрыть" 	onclick="p_obj.doButtonSaveClose();" />
										<input id="item_save_next_button_up" 	type="button" value="Сохранить и следующий >>" 	onclick="p_obj.doButtonSaveNext();" />
										
										
										{*
										<input id="show_email_answer_form_up" 		type="button" value="Ответить по Email" 	onclick="p_obj.showEmailAnswerForm();" />
										*}
									</div>
									<div align="right" style="display:inline-block; float:right;">
										<input type="button" value="<< Назад"   onclick="p_obj.goItemPrev();"	id="item_prev_button_up" />
										<input type="button" value="Вперёд >>"  onclick="p_obj.goItemNext();"	id="item_next_button_up" />
										<input type="button" value="1 из 20" 									id="item_total_up" style="cursor:default; color:black;" disabled="disabled" />
									</div>
								</div><!--END class="top_panel" -->
							</td>
						</tr><!--END кнопки: добавить, удалить, вперёд, назад -->
						<tbody id="item_tbody">
							<tr class="even"><!-- name  -->
								<td class="item_title width" style="">
									Название:
								</td>
								<td class="item_value">
									<input id="name" type="text" value="" />
								</td>
							</tr>
							<tr class="even"><!-- sort  -->
								<td class="item_title width" style="">
									Сортировка:
								</td>
								<td class="item_value">
									<input id="sort" type="text" value="" />
								</td>
							</tr>
							<tr class="even"><!-- text  -->
								<td class="item_title width" style="">
									Альтернативный текст:
								</td>
								<td class="item_value">
									<textarea id="text" cols="50" rows="4" style="width: 100%;"></textarea>
								</td>
							</tr>
							
							<!-- strategy_file -->
								<tr class="no_bg" style="display:none_;">
									<td class="item_value" colspan="2" style="border:1px #333333 dotted;">
										<span>файлы [<b><span id="item_file_total">0</span></b>]</span>
										<span class="aslink" onclick="p_obj.toggleItemFileTable();" id="item_file_show_button">развернуть</span>
										<div class="file_block" id="file_block">
											<div class="panel" style="padding-top:10px;" >
												<span class="btn add" id="file_add">Загрузить</span>
												<span class="btn delete" id="file_delete_all" onclick="p_obj.deleteFileAll();">Удалить всё</span>
											</div>
											<div class="file_container" id="file_container" style="margin-top:5px;">
											{*
												<div class="item">
													<div class="nom">1</div>
													<div class="file">
														<a href="#">CHFJPY_H4.csv</a>
													</div>
													<div class="operation">
														<span class="page_ui" onclick="">Удалить</span>
													</div>
												</div>
												<div class="item">
													<div class="nom">2</div>
													<div class="file">
														<a href="#">USDCHF_H4.csv</a>
													</div>
													<div class="operation">
														<span class="page_ui" onclick="">Удалить</span>
													</div>
												</div>
											*}
											</div>
										</div>
									</td>
								</tr>
							<!--END strategy_file -->
							
							
						</tbody>
						<tr><!--  кнопки добавить / удалить -->
							<td colspan="5" style="text-align: left; padding-left: 0px;" class="module_bottom_ui">
								<div class="top_panel">
									<div style="display:inline-block;">
										<input 									type="button" value="Отмена"    			onclick="p_obj.cancelItem();"/>
										<input id="item_save_button_down" 		type="button" value="Сохранить" 			onclick="p_obj.doButtonSave();" />
										<input id="item_saveclose_button_down" 	type="button" value="Сохранить и закрыть" 	onclick="p_obj.doButtonSaveClose();" />
										<input id="item_save_next_button_down" 	type="button" value="Сохранить и следующий >>" 	onclick="p_obj.doButtonSaveNext();" />
										{*
										<input id="show_email_answer_form_down"	type="button" value="Ответить по Email" 	onclick="p_obj.showEmailAnswerForm();" />
										*}
									</div>
									<div align="right" style="display:inline-block; float:right;">
										<input type="button" value="<< Назад"   onclick="p_obj.goItemPrev();"	id="item_prev_button_down" />
										<input type="button" value="Вперёд >>"  onclick="p_obj.goItemNext();"	id="item_next_button_down" />
										<input type="button" value="1 из 20" 									id="item_total_down" style="cursor:default; color:black;" disabled="disabled" />
									</div>
								</div><!--END class="top_panel" -->
							</td>
						</tr>
					</table>
				</div>
			</div>
		</td>
	</tr>
</table>

<script language="JavaScript">

	function pageClass(){// 
		
		{// Инициализация
			{// стандартные переменные
				var self=this;
				this.pageId="mainPage";// главная страница
									   //editPage страница редактирования вопроса
				
				
				
				this.item_array=[]			;// массив item
				this.item_id=0; 			// id редактируемой категории
				this.item = [];				// 1 item загруженный с сервера
				this.item_mode='';			// режим edit / add
				this.item_change = 0; 		// item менялся
				this.item_page=1; 			// номер загружаемой страницы
				this.item_total=1;			// номер всего item
				this.item_pages=1; 			// число страниц item
				
				this.item_sort_field='datetime';// поле по которому производится сортировка
				this.item_sort='desc';	 	// поле по которому производится сортировка
				this.item_pp=0;	 	// 
				this.item_pp_width=15; // число одновременно показывемых ссылок на страницы
				
				this.scriptUrl = '/respondents/script_client.php'; // урл респондента
				loadHTMLsmall='<div style="text-align:left; padding:0px; float:left;"><img src="/images/ajax-loader-medium.gif" style="cursor:help" title="Обновление" /></div><div style="text-align:left; padding:5px 5px;">&nbsp;&nbsp;Обновление...</div >';
				loadHTML='<div style="text-align:center; padding:60px 0px"><img src="/img/admin/ajax-loader-big.gif" style="cursor:help" title="Обновление таблицы" /><br /><br />Обновление...</div>';
				loadDtreeHTML='<div style="text-align:left; padding:20px 20px;"><img src="/images/ajax-loader-medium.gif" style="cursor:help" title="Обновление" /></div>';
				loadHTMLvery_small='<div style="text-align:left; padding:0px; padding-right:5px; float:left;"><img src="/img/ajax_loader_small_trans.gif" style="cursor:help" title="Загрузка" /></div>';
				// supplierProduct SupplierProduct
				
				
				
				this.page_key='Day';
				this.get_item_array_mode=		'get'+this.page_key+'Array';
				this.get_item_mode=				'get'+this.page_key+'Item';
				this.save_item_complete_mode=	'update'+this.page_key+'Item';
				this.add_item_complete_mode=	'add'+this.page_key+'Item';
				this.delete_item_mode=			'delete'+this.page_key+'Item';
				this.get_prev_next_item_mode=	'get'+this.page_key+'PrevNextItem';	
			}//END стандартные переменные
			
		}// END Инициализация
		
		this.init = function(){
			this.bildPage();
		}// END init
		
		this.bildPage = function(){// построить страницу
			// скрываем все страницы
			$$('#mainPage').hide();
			$$('#editPage').hide();
			if (this.pageId=="mainPage"){
				$$('#mainPage').show();
				this.getItemArray();
			}
			if (this.pageId=="editPage"){
				$$('#editPage').show();
				$$('#editPageBody').show();
				fn.showHover('item_tbody');// анимация загрузки
				if(this.item_mode=='edit'){
					this.getItem();
				}
				else if(this.item_mode=='add'){
					this.addItem();
				}
			}// END IF
			return;
		}// END bildPage
		
		{// работа с массивом страниц
			this.getItemArray = function(){// получить массив item
				fn.showHover('item_array_tbody');// анимация загрузки
				
				$$.ajax({
					type: "POST",
					url: this.scriptUrl,
					data: "mode="+this.get_item_array_mode
					+"&sort="+this.item_sort
					+"&sort_field="+this.item_sort_field
					,
					success: function(a){
						var data=JSON.parse(a);
						self.item_array=data.array;
						self.bildItemArray();
					}// END success
				});// END ajax
				return;
			}// END 
			this.bildItemArray = function(){// построить страницу массива item
				//$$('#item_add_button').hide();
				//return;
				var arr=this.item_array;
				var str='';
				str+=''
					+'	<tr class="table_header">'
					+'		<td align="right" width="30">№</td>'
					+'		<td align="right" width="150">'+p_obj.getSortImgHref('Дата', 'datetime')+'</td>'
					+'		<td align="right">Операция</td>'
					+'	</tr>';
				if(arr.length==0){
					// в массиве нет данных
					str+='<tr class="odd"><td colspan="6">Нет данных</td></tr>';
				}
					
				//var name=''; 		// название
				var clickEdit=''; 	// действие при редактировании
				var clickDelete=''; // действие при удалении
				var clickEnable=''; // действие при включении/выключении 
				var color=''; 		// цвет текста 
				
				var filter_name=$$.trim( $$("#filter_name").val() );
				
				var span_in="";		// span с действиями
				for(var i=0;i<arr.length;i++){
					
					{// создание кнопок
						clickDelete='onClick="p_obj.deleteItem('+arr[i].datetime+');" style="'+color+'" ';
						var button_delete, button_edit, button_enable, button_down;
						button_delete='<span class="ui_button_small right" '+clickDelete+'>Удалить</span>';
						button_down='<a target="_blank" class="ui_button_small right" href="/get_file.php?id='+arr[i].datetime+'"'+clickEnable+'>Скачать</a>';
					}
					
					// собираем span_in
					// span_in=" class='aslink' style='"+color+"' "+clickEdit;
					// span_in=" class='' style='"+color+"' "+clickEdit;
					// span_in=" class='' style='"+color+"' ";
					arr[i].datetime_str = fn.parseDate('d.m.Y', arr[i].datetime );
					str+=''
						+'<tr class="colorTR">'
						+'	<td align="right"><span>'+parseInt(i+1)+'</span></td>'
						+'	<td align="right"><span>'+arr[i].datetime_str+'</span></td>'
						+'	<td>'
						{// кнопки управления и инфо
							str+=button_down;
							str+=button_delete;
							//str+=button_enable;
						}
					str+=''	
						+'	</td>'
						+'</tr>';
				}// END FOR
				$$('#item_array_tbody').html(str);// для фильтрации 
				fn.hideHover();
				fn.decorateTable('item_array_table');// разукрасить табличку
				return;
			}// END bildItemArray
			
			
			{// функции сортировки
				this.getSortImgHref=function (title, field){
					var img='';
					var new_sort='';
					if(this.item_sort=='asc'){
						new_sort='desc';
					}
					else{
						new_sort='asc';
					}
					if(field==this.item_sort_field){
						img='&nbsp;<img alt="" title="" src="/img/admin/arrow_'+new_sort+'_white.gif"/>'
					}
					var str='';
					str=''
						+'<a onClick="p_obj.sortComment(\''+field+'\', \''+new_sort+'\')" href="javascript:void(0);" class="sort">'
						+title
						+img
						+'</a>';
					return str;
				}//END getSortImgHref
				this.sortComment=function(с_sortField, c_sort){
					this.setSort(с_sortField, c_sort);
					this.bildPage();
				}//END sortComment
				this.setSort=function (с_sortField, c_sort){// установить направление сортировки
					this.item_sort_field=с_sortField;
					this.item_sort=c_sort;
				}// END setSort
			}// функции сортировки	
			{// поиск по item_array
				this.bindSearch = function(){// подключени поиска при набор слова
					$$( "#item_array_query" ).autocomplete({
						source: function( request, response  ) {
							p_obj.getItemArray();
						},// end source:
						open : function(){},
						minLength: 0,
						select: function( event, ui ) {	return false; },
						focus: function( event, ui ) { return false; }
						//change: function( event, ui ) { return false; }
					});// END autocomplete
				}// END bindSearch
				this.hideShowItemArrayQueryClearButton = function(){// показать или спрятать кнопку очистки фильтров
					if($$.trim($$("#item_array_query").val())==''){
						$$('#item_array_clear_filter').hide();
					}
					else{
						$$('#item_array_clear_filter').show();
					}
					return;
				}// END hideShowItemArrayQueryClearButton
				this.clearItemArrayQuery = function(){
					$$('#item_array_query').val('');
					$$('#item_array_clear_filter').hide();
					this.getItemArray();
				}// clearItemArrayQuery
			}//END поиск item_array
			{// работа с фильтрами input
				this.initInputFilter = function(id){// инициализация фильтра для поиска в input
					$$( '#'+id ).autocomplete({
						source: function( request, response  ) {
							$$( '#'+id ).removeClass("ui-autocomplete-loading");// удаляем анимацию поиска в input
							p_obj.hideShowInputFilterClearButton(id);// показать или спрятать кнопку очистки фильтров
							p_obj.setItemPage(1);
							p_obj.getItemArray();
						},// end source:
						open : function(){},
						minLength: 0,
						select: function( event, ui ) {	return false; },
						focus: function( event, ui ) { return false; }
						//change: function( event, ui ) { return false; }
					});// END autocomplete
					$$('#'+id).next('.clear').click(function () {
						p_obj.clearInputFilter(id);
					});
				}//END 
				this.hideShowInputFilterClearButton = function(id){// показать или спрятать кнопку очистки фильтров
					//console.log( $$('#'+id).next('.clear') )
					if($$.trim($$('#'+id).val())==''){
						$$('#'+id).next('.clear').hide();
					}
					else{
						$$('#'+id).next('.clear').show();
					}
					return;
				}// END hideShowItemArrayQueryClearButton
				this.clearInputFilter = function(id){
					$$('#'+id).val('');
					$$('#'+id).next('.clear').hide();
					this.getItemArray();
				}// END
			}//END работа с фильтрами
			{// работа с фильтрами select
				this.initSelectFilter = function(id){// инициализация фильтра для поиска в select
					$$('#'+id).change(function() {
						p_obj.changeSelectFilter(id);
					});
					$$('#'+id).next().click(function () {
						p_obj.clearSelectFilter(id);
					});
					return;
				}//END 
				this.changeSelectFilter = function(id){//
					var first_val=$$('#'+id+' :eq(0) ').val(); // первый элемент
					if($$('#'+id).val()==first_val){
						//$$('#filter_root_cat_id_clear').hide();
						$$('#'+id).next().hide();
						//console.log(' спрятать ')
					}
					else{
						$$('#'+id).next().show();
						//console.log(' показать ')
					}
					//this.item_page=1;
					this.setItemPage(1);
					this.getItemArray();
					return;
				}//END 
				this.clearSelectFilter = function(id){
					$$('#'+id).val('');
					$$('#'+id).next().hide();
					this.getItemArray();
				}// END
			}
			this.bildFilterItemSupplierArray = function(){
				var arr=this.supplier_array;
				var statusStr="";
				var selectedStr="";
				statusStr+='<option value="all">Все</option>';
				for(var i in arr) {
					if (!arr.hasOwnProperty(i)) continue;
					//alert(i);
					statusStr+='<option value="'+arr[i].id+'">'+arr[i].name+'</option>';
				}
				$$('#filter_supplier_name').html(statusStr);
				return;
			}// END 
	

	}// END работа с массивом страниц
		
		{// работа с одной страницей
			
			
			this.deleteItem = function(id){
				if(!confirm('Действительно удалить?')){
					return;
				}
				fn.showProcess('Удаление');
				$$.ajax({
					type: "POST",
					url: this.scriptUrl,
					data: "mode="+this.delete_item_mode
						+"&id="+id,
					success: function(a){
						fn.hideProcess('Удаление');
						self.bildPage();
					}// END success
				});// END ajax
			}// END 
			
			this.deleteItemAll = function(){
				if(!confirm('Действительно удалить ВСЁ ?')){
					return;
				}
				fn.showProcess('Удаление');
				$$.ajax({
					type: "POST",
					url: this.scriptUrl,
					data: "mode=deleteDayItemAll",
					success: function(a){
						fn.hideProcess();
						self.bildPage();
					}// END success
				});// END ajax
			}// END deleteItem
			
			this.fillTestData = function(){// загрузить тестовые данные
				fn.showProcess('Загрузка данных');
				$$.ajax({
					type: "POST",
					url: this.scriptUrl,
					data: "mode=fillTestData",
					success: function(a){
						fn.hideProcess();
						self.bildPage();
					}// END success
				});// END ajax
			}// END deleteItem
		}//END работа с одной страницей
		
		{// функции сеттеры
			this.setPageId = function(val){
				this.pageId=val;
			}// END setPageId
			this.setItemId = function(val){// установить id выбранного item
				this.item_id=val;
			}// END setItemId
			this.setItemMode = function(val){// установить режим работы с item, edit / add
				this.item_mode=val;
			}//END setItemMode
			this.setItemPage = function(val){// установить item_page - номер загружаемой страницы
				this.item_page=val;
			}//END setItemPage
		}// END  функции сеттеры
		
	}// END pageClass p_obj
	
	$$(function(){
		p_obj = new pageClass();
		p_obj.init();
	});
	
</script>

<?
include ("/inc/bottom_block.php");
?>