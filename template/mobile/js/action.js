
$(document).ready(function (){

		$('#username').focus(function (){
			this.value="";
		});
		$('#username').blur(function (){
			this.value="用户名只可使用字母、数字及下划线";
		});

		$('#shopadd').focus(function (){
			this.value="";
		});
		$('#shopadd').blur(function (){
			this.value="如：浙江省杭州市**街**号";
		});

		

		$('#uploadphoto').localResizeIMG({
			width:100,
			quality:1,
			success:function (result){


				var leap = 2;
				// alert(window.location.href);
				if(window.location.href=='http://localhost/business_aply/shop.html'){
					leap = 0;
				}else if(window.location.href=='http://localhost/business_aply/person.html'){
					leap = 1;
				}else{
					//leap = 2;
					//console.log('Others');
				}

			    var submitData={
					base64_string:result.clearBase64,
					leaps:leap
				};

				
				//alert(submitData);
				// console.log(submitData);
				
				$.ajax({
					url:'uploadPhoto.php?'+Math.random(),
					type:'post',
					data:submitData,
					dataType:'json',
					success:function (data){
						if(data.status==0){
							alert(data.content);
							return false;
						}else{
							$('.imglist').show();
							var attstr='<img src="'+data.url+'" />';
							$('.imglist').append(attstr);
						}
					},
					error:function (jqXHR,textStatus,errorThrown){
						alert(XMLHttpRequest.status);
			   alert(XMLHttpRequest.readyState);
			   alert(textStatus);
					}
				});
			},
		});

		$('#shopSub').click(function (){
			var url='submitShop.php';
			var sendData=$('#shopForm').serialize();
			$.ajax({
				url:url,
				type:'post',
				data:sendData,
				success:function (data){

				},
				error:function (jqXHR,textStatus,errrorThrown){
						alert("连接失败");
				}
			});

			$(document).ajaxError(function (){
				alert('ajax请求发生错误');
			});
		});

		$('#personSub').click(function (){
			var url='submitPerson.php';
			var sendData=$('#personForm').serialize();
			$.ajax({
				url:url,
				type:'post',
				data:sendData,
				success:function (data){

				},
				error:function (jqXHR,textStatus,errrorThrown){
						alert("连接失败");
				}
			});

			$(document).ajaxError(function (){
				alert('ajax请求发生错误');
			});
		});


	});