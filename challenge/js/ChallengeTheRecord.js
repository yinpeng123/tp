(function(){
	var room_id;//房间号
	$.ajax({
		type:'post',
		url:'http://www.htown.xyz/Home/index/challenge_record',
		data:{"openid":2},
		async:false,
		success:function(msg){
			console.log(msg);
			$('#main').empty()
			renderer(msg);
			render(msg);
		}
	})
	$(document).on('click','.exit',function(){
		$('#pop-up').css("display","block");
		room_id = $(this).parent().prev().find('#number').text();
		$(document).on('click','.btn',function(){
			if ($(this).text() == "确定") {
				$('#pop-up').css("display","none");
				$.ajax({
					type:'post',
					url:'http://www.htown.xyz/Home/index/exit_team',
					data:{"openid":2,"room_id":room_id},
					async:false,
					success:function(){
						location.reload();
					}
				})
			}else{
				$('#pop-up').css("display","none");
			}
		})
	})
	
})();

function renderer(msg){
	console.log($('.main'));
	var arr = ['null','doing','success','defeated','teamof'];
	var arr1 = ['null','null','none','none','none'];
	var arr2 = ['null','七日挑战赛','二十一日挑战赛'];
	for(var i = 0;i<msg.length;i++){
			$('#main').append('<div class="main">\
				<div class="state '+arr[msg[i].status]+'"></div>\
				<div class="main_header_con">\
					<div class="main_header">\
						<p>桌号</p>\
						<p id="number" class="font">'+msg[i].room_id+'</p>\
					</div>\
					<div class="main_header">\
						<p>挑战类型</p>\
						<p class="font">'+arr2[msg[i].type]+'</p>\
					</div>\
					<div class="main_header">\
						<p>开始日期</p>\
						<p class="font">'+msg[i].start_time+'</p>\
					</div>\
				</div>\
				<div class="headline">\
					<p class="headline_tit">挑战组成员</p>\
					<div class="exit '+arr1[msg[i].status]+'">退出挑战</div>\
				</div>\
				<div class="member">\
					<div class="mem"></div>\
				</div>\
			</div>');
	}
	
}
function render(msg){
	for(var i = 0;i<msg.length;i++){
		for(var j=0;j<msg[i].nickname.length;j++){
			if (j>0) {
				$($('.mem')[i]).append('<div class="member_infor le_two">\
							<div class="member_portrait">\
								<img src="'+msg[i].headimg[j]+'"/>\
							</div>\
							<div class="member_name">\
								'+msg[i].nickname[j]+'\
							</div>\
						</div>')
				}else{
					$($('.mem')[i]).append('<div class="member_infor">\
							<div class="member_portrait">\
								<img src="'+msg[i].headimg[j]+'"/>\
							</div>\
							<div class="member_name">\
								'+msg[i].nickname[j]+'\
							</div>\
						</div>')
				}
		}
	}
}
