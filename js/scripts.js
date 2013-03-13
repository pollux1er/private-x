			function DropDown(el) {
				this.dd = el;
				this.placeholder = this.dd.children('span');
				this.opts = this.dd.find('ul.dropdown > li');
				this.input = this.dd.find('input');
				this.val = '';
				this.index = -1;
				this.initEvents();
			}
			DropDown.prototype = {
				initEvents : function() {
					var obj = this;

					obj.dd.on('click', function(event){
						$(this).toggleClass('active');
						return false;
					});

					obj.opts.on('click',function(){
						var opt = $(this);
				    spanOpt = opt.find(".indicatif");
						obj.val = opt.text();
						obj.indicatif = spanOpt.text();
						obj.index = opt.index();
						obj.placeholder.text(obj.val);
						obj.input.val(obj.val);
						$("#recepteur").val(obj.indicatif);
					});
				},
				getValue : function() {
					return this.val;
				},
				getIndex : function() {
					return this.index;
				}
			}

			$(function() {
				
				var dd = new DropDown( $('#dd') );				
                
				$(document).click(function() {
					
					$('.wrapper-dropdown').removeClass('active');
				});

			});

		  $(document).ready(function(){
				$(".prefait1").val($(".expediteur").text());
				$(".prefait2").val($(".recepteur").text());
			  $(".edit1").click(function(){
				  $(".expediteur").css('display', 'none');
				  $(".edit1").css('display', 'none');
				  $(".prefait1").css('display', 'block');
				  $(".done1").css('display', 'block');
				});
			  $(".done1").click(function(){
				  $(".expediteur").css('display', 'block');
				  $(".edit1").css('display', 'block');
				  $(".prefait1").css('display', 'none');
				  $(".done1").css('display', 'none');
				  $(".expediteur1").text($(".prefait1").val());
				});
			  $(".edit2").click(function(){
				  $(".expediteur").css('display', 'none');
				  $(".edit2").css('display', 'none');
				  $(".prefait2").css('display', 'block');
				  $(".done2").css('display', 'block');
				});
			  $(".done2").click(function(){
				  $(".expediteur").css('display', 'block');
				  $(".edit2").css('display', 'block');
				  $(".prefait2").css('display', 'none');
				  $(".done2").css('display', 'none');
				  $(".expediteur2").text($(".prefait2").val());
				});
			});
			
			function updateCountdown() {
				var remaining = 140 - jQuery('.message').val().length;
				jQuery('.countdown').text(remaining + ' caracteres restants.');
			} 
			jQuery(document).ready(function($) {
				updateCountdown();
				$('.message').change(updateCountdown);
				$('.message').keyup(updateCountdown);
			});
