function $ (element) {return document.getElementById(element);}

;(function(){// fn
	
	window.fn={};
	fn.showPagePreloader=function(){
		//return;
		$$('#overlay').show();
		$$('#page_form_preloader').show();
		$$('#global-wrapper').addClass('blurred');
	}
	fn.hidePagePreloader=function(){
		if(App.Core.init_load==0 || App.Core.page_load==0){
			return;
		}
		$$('#overlay').hide();
		$$('#page_form_preloader').hide();
		$$('#global-wrapper').removeClass('blurred');
		$$('#preloader_image').empty().remove();
	}
	fn.showProcess=function(title){
	
		var self=this;
		this.title=title;
		this.init = function(){
			if( $$('#window_progressbar').length!=0 ){
				return;
			}
			
			var html='<div id="window_progressbar"><div style="margin-top:20px;" id="progressbar"></div></div>';
			$$('body').append(html);
			$$("#window_progressbar").hide();
			$$("#window_progressbar").dialog({
				//show: "drop",
				//hide: "puff",
				autoOpen: false,
				modal: true,
				draggable: false,
				resizable: false,
				closeOnEscape: false
			})
			$$("#window_progressbar").hide().prev().find("a").hide();
			$$("#progressbar").progressbar({value:100}).css({border:"none", height:"20px"});
			return;
		}//END 
		this.show = function(){
			$$('#window_progressbar').dialog("open").dialog('option', 'title', this.title).css({"min-height":"none"});
		}
		this.init();
		this.show();
	}// END showProcess
	fn.hideProcess=function(){$$("#window_progressbar").dialog("close")}
	fn.completeProcess=function(title, text){
		var self=this;
		this.title=title;
		this.text=text;
		this.init = function(){
			if( $$('#form_send_complete').length!=0 ){
				return;
			}
			
			var html=[
				'<div id="form_send_complete" title="Запрос отправлен" style="display:none;">',
					'<div id="form_send_complete_text" style="font-weight:bold;color:green;"></div>',
				'</div>',
				].join('');
			$$('body').append(html);
			$$('#form_send_complete').dialog({
					autoOpen: false,
					modal: true,
					//position:['center', 'top'],
					draggable: true,
					resizable: false,
					width: 350,
					buttons: {	
						"Ок": function() { 
							$$(this).dialog("close"); 
						} 
					}
				});
			
			return;
		}//END 
		this.show = function(){
			//console.log('completeProcess:show()');
			//$$('#window_progressbar').dialog("open").dialog('option', 'title', this.title).css({"min-height":"none"});
			$$('#form_send_complete').dialog("open").dialog('option', 'title', this.title);
			var text=this.text||'';
			$$('#form_send_complete_text').html(text);
		}
		this.init();
		this.show();
		
	}// END showProcess
	fn.showHover=function(id){
		var self=this;
		this.id=id;
		this.init = function(){
			if( $$('#p_hover').length!=0 ){
				return;
			}
			
			var html='<div id="p_hover"	class="p_hover"></div><div id="p_hover_2"	class="p_hover_2"></div><div id="p_hover_3"	class="p_hover_3"><div style="" class="p_hover_4" >Loading...</div></div>';
			$$('body').append(html);
			$$("#p_hover").hide();
			return;
		}//END 
		this.show = function(){
			
			var id = this.id;
			
			//alert( $$('body').width() ); return;
			var container_width=$$('#'+id).width();
			var container_height=$$('#'+id).height();
			var offset=$$('#'+id).offset();
			//alert(container_height)
			
			var p_hover_left=offset.left;
			var p_hover_top=offset.top;
			
			if (id=='item_array_div' && container_height!=0){
				//p_hover_top=p_hover_top+10;
				container_height=container_height-10
				p_hover_top=p_hover_top+10;
			}
			else if(container_height<=1){// блокируем всю страницу если поле пустое
				container_width=$$('body').width()
				container_height=$$('body').height()
				p_hover_left=0;
				p_hover_top=0;
			}
			
			
			$$('#p_hover').css({'width':container_width, 'height':container_height});
			$$('#p_hover').css({'left':p_hover_left, 'top':p_hover_top});
			$$('#p_hover').show();
			//$$('#p_hover').css({'opacity':0.8});
			//$$('#p_hover IMG').css({'opacity':1});
			
			//var p_hover_2_left= (container_width)/2 - (90/2) + ($$('body').width()-container_width);
			var p_hover_2_left= p_hover_left+(container_width)/2 - (90/2);
			var p_hover_2_top=  p_hover_top+(container_height/2) - (32/2);
			
			//$$('#p_hover_2').css({'left':$$('#p_hover').offset().left+50, 'top':$$('#p_hover').offset().top+50});
			$$('#p_hover_2').css({'left':p_hover_2_left, 'top':p_hover_2_top});
			$$('#p_hover_2').show();
			
			$$('#p_hover_3').css({'left':$$('#p_hover_2').offset().left, 'top':$$('#p_hover_2').offset().top});
			$$('#p_hover_3').show();
			
			
			$$('#p_hover').show();
		}
		this.init();
		this.show();
	}
	fn.hideHover=function(){
		$$('#p_hover').hide();
		$$('#p_hover_2').hide();
		$$('#p_hover_3').hide();
	}//END hideHover
	fn.decorateTable=function(id){// произвести подсветку ячеек таблицы при наведении мышки
		var tbls = $(id);
		if (!tbls){
			return;
		}
		for(var i = 0 ; i < tbls.rows.length ; i++)
		{
			var trs = tbls.rows[i];
			var tr_class=trs.className;
			if(tr_class=='colorTR'){
				if (i % 2 == 0){
					trs.className='odd'; 
				}
				else{
					trs.className='even'; 
				}
			}
		}
		return;
	}// END decorateTable
	fn.parseDate=function(format, timestamp){    // Format a local time/date
	
		// FROM http://javascript.ru/php/date
		// +   original by: Carlos R. L. Rodrigues
		// +      parts by: Peter-Paul Koch (http://www.quirksmode.org/js/beat.html)
		// +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   improved by: MeEtc (http://yass.meetcweb.com)
		// +   improved by: Brad Touesnard
	 
		var a, jsdate = new Date(timestamp ? timestamp * 1000 : null);
		var pad = function(n, c){
			if( (n = n + "").length < c ) {
				return new Array(++c - n.length).join("0") + n;
			} else {
				return n;
			}
		};
		var txt_weekdays = ["Sunday","Monday","Tuesday","Wednesday",
			"Thursday","Friday","Saturday"];
		var txt_ordin = {1:"st",2:"nd",3:"rd",21:"st",22:"nd",23:"rd",31:"st"};
		var txt_months =  ["", "January", "February", "March", "April",
			"May", "June", "July", "August", "September", "October", "November",
			"December"];
	 
		var f = {
			// Day
				d: function(){
					return pad(f.j(), 2);
				},
				D: function(){
					t = f.l(); return t.substr(0,3);
				},
				j: function(){
					return jsdate.getDate();
				},
				l: function(){
					return txt_weekdays[f.w()];
				},
				N: function(){
					return f.w() + 1;
				},
				S: function(){
					return txt_ordin[f.j()] ? txt_ordin[f.j()] : 'th';
				},
				w: function(){
					return jsdate.getDay();
				},
				z: function(){
					return (jsdate - new Date(jsdate.getFullYear() + "/1/1")) / 864e5 >> 0;
				},
	 
			// Week
				W: function(){
					var a = f.z(), b = 364 + f.L() - a;
					var nd2, nd = (new Date(jsdate.getFullYear() + "/1/1").getDay() || 7) - 1;
	 
					if(b <= 2 && ((jsdate.getDay() || 7) - 1) <= 2 - b){
						return 1;
					} else{
	 
						if(a <= 2 && nd >= 4 && a >= (6 - nd)){
							nd2 = new Date(jsdate.getFullYear() - 1 + "/12/31");
							return date("W", Math.round(nd2.getTime()/1000));
						} else{
							return (1 + (nd <= 3 ? ((a + nd) / 7) : (a - (7 - nd)) / 7) >> 0);
						}
					}
				},
	 
			// Month
				F: function(){
					return txt_months[f.n()];
				},
				m: function(){
					return pad(f.n(), 2);
				},
				M: function(){
					t = f.F(); return t.substr(0,3);
				},
				n: function(){
					return jsdate.getMonth() + 1;
				},
				t: function(){
					var n;
					if( (n = jsdate.getMonth() + 1) == 2 ){
						return 28 + f.L();
					} else{
						if( n & 1 && n < 8 || !(n & 1) && n > 7 ){
							return 31;
						} else{
							return 30;
						}
					}
				},
	 
			// Year
				L: function(){
					var y = f.Y();
					return (!(y & 3) && (y % 1e2 || !(y % 4e2))) ? 1 : 0;
				},
				//o not supported yet
				Y: function(){
					return jsdate.getFullYear();
				},
				y: function(){
					return (jsdate.getFullYear() + "").slice(2);
				},
	 
			// Time
				a: function(){
					return jsdate.getHours() > 11 ? "pm" : "am";
				},
				A: function(){
					return f.a().toUpperCase();
				},
				B: function(){
					// peter paul koch:
					var off = (jsdate.getTimezoneOffset() + 60)*60;
					var theSeconds = (jsdate.getHours() * 3600) +
									 (jsdate.getMinutes() * 60) +
									  jsdate.getSeconds() + off;
					var beat = Math.floor(theSeconds/86.4);
					if (beat > 1000) beat -= 1000;
					if (beat < 0) beat += 1000;
					if ((String(beat)).length == 1) beat = "00"+beat;
					if ((String(beat)).length == 2) beat = "0"+beat;
					return beat;
				},
				g: function(){
					return jsdate.getHours() % 12 || 12;
				},
				G: function(){
					return jsdate.getHours();
				},
				h: function(){
					return pad(f.g(), 2);
				},
				H: function(){
					return pad(jsdate.getHours(), 2);
				},
				i: function(){
					return pad(jsdate.getMinutes(), 2);
				},
				s: function(){
					return pad(jsdate.getSeconds(), 2);
				},
				//u not supported yet
	 
			// Timezone
				//e not supported yet
				//I not supported yet
				O: function(){
				   var t = pad(Math.abs(jsdate.getTimezoneOffset()/60*100), 4);
				   if (jsdate.getTimezoneOffset() > 0) t = "-" + t; else t = "+" + t;
				   return t;
				},
				P: function(){
					var O = f.O();
					return (O.substr(0, 3) + ":" + O.substr(3, 2));
				},
				//T not supported yet
				//Z not supported yet
	 
			// Full Date/Time
				c: function(){
					return f.Y() + "-" + f.m() + "-" + f.d() + "T" + f.h() + ":" + f.i() + ":" + f.s() + f.P();
				},
				//r not supported yet
				U: function(){
					return Math.round(jsdate.getTime()/1000);
				}
		};
	 
		return format.replace(/[\\]?([a-zA-Z])/g, function(t, s){
			if( t!=s ){
				// escaped
				ret = s;
			} else if( f[s] ){
				// a date function exists
				ret = f[s]();
			} else{
				// nothing special
				ret = s;
			}
	 
			return ret;
		});
	}// END parseDate
	
})();
