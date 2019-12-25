//视力检测的 .ruler下dom 创建
(function(){
	$('#detection_test').addClass('xia')
})();
//导航栏的tab切换
$('.nav_list').click(function(){
	
//	if($(this).index() == 2){
//		$('html').addClass('fixation')
//		$('body').addClass('fixation');
//	}else{
//		$('html').addClass('fixation')
//		$('body').removeClass('fixation');
//	}
	$('#content_box').children().eq($(this).index()).show().siblings('.content').hide();
	$('.nav_list').removeClass('active');
	$(this).addClass('active');
})
//色盲测试下picker的初始化
$("#picker").picker({
  title: "请填写图中数字",
  cols: [
    {
      textAlign: 'center',
      values: ['0', '1', '2', '3', '4', '5', '6', '7','8','9']
      //如果你希望显示文案和实际值不同，可以在这里加一个displayValues: [.....]
    },
    { 
      textAlign: 'center',
      values: ['0', '1', '2', '3', '4', '5', '6', '7','8','9']
    }
  ]
});
//picker里面的数字
var color_num; 
//picker数字的十位
var a_tens;
//picker数字的个位
var a_digit;
//点击次数
var color_clicknum = 0;
//色盲的概率
var color_percent = 0; 
//色盲测试结果
const arr = [12,36,66,29,26];
//测视力E的方向
const arr1 = ['shang','xia','zuo','you'];
//测视力点击正确次数
var vision_true = 0;
//测试视力点击错误次数
var vision_flase = 0;
//测试视力状态
var vision_state = false;
//测试视力倍数
var vision_bei = 1;
//视力标注
var vision_see = 4;
//数组
const arr2 = [0.1,0.12,0.15,0.2,0.25,0.3,0.4,0.5,0.6,0.8,1.0,1.2,1.5]
$("#picker").change(function(){
	 color_num = $("#picker").val().replace(/\s*/g,"")
	 a_tens = parseInt(color_num/10);
	 a_digit = color_num%10;
	$('#picker_top_l').text((a_tens-1));
	$('#picker_top_r').text((a_digit-1));
	$('#picker_bottom_l').text((a_tens+1));
	$('#picker_bottom_r').text((a_digit+1));
	if(a_tens == 0){
		$('#picker_bottom_l').text((a_tens+1));
		a_tens = 10;
		$('#picker_top_l').text((a_tens-1));
	}
	if(a_digit == 0){
		$('#picker_bottom_r').text((a_digit+1));
		a_digit = 10;
		$('#picker_top_r').text((a_digit-1));
	}
	if(a_tens ==9){
		$('#picker_top_l').text((a_tens-1));
		a_tens =1 ;
		$('#picker_bottom_l').text((a_tens-1));
	}
	if(a_digit == 9){
		$('#picker_top_r').text((a_digit-1));
		a_digit =1;
		$('#picker_bottom_r').text((a_digit-1));
	}
	
})
$('.btn_r').click(function(){
	if (color_num == arr[color_clicknum]) {
		$('.nav_ball').eq(color_clicknum).text('√');
		$('.nav_ball').eq(color_clicknum).addClass('nav_ball_font');
	} else{
		$('.nav_ball').eq(color_clicknum).text('x');
		color_percent+=20;
	}
	color_clicknum+=1;
	if(color_clicknum<5){
		$('.test_img').css('background','url(../images/'+color_clicknum+'.png) no-repeat center/100% 100%');
	}else{
		window.location.href='testresult?color_percent='+color_percent;
	}
	console.log(color_num,color_clicknum);
	
})
$('.btn_l').click(function(){
	$('.nav_ball').eq(color_clicknum).text('x');
	color_clicknum+=1;
	color_percent+=20;
	console.log(color_clicknum);
	if(color_clicknum<5){
		$('.test_img').css('background','url(../images/'+color_clicknum+'.png) no-repeat center/100% 100%');
	}else{
		window.location.href='testresult?color_percent='+color_percent;
	}
})
//散光测试
$('.btn').click(function(){
	var input_choose = $('input:radio[name="one"]:checked').attr("id");
	if (input_choose == "one") {
		window.location.href='testresult?astigmatism=1';
	} else if(input_choose == "two"){
		window.location.href='testresult?astigmatism=0';
	}
})
//视力测试
$('.detection_btn').click(function(){
	var btn_text = $(this).text();
	var ran_num = parseInt(Math.random()*4);
	if (btn_text == "上") {
		if($('#detection_test').hasClass('shang')){
			$('#state').append('<div class="state nav_ball_font">√</div>');
			vision_true++
		}else{
			$('#state').append('<div class="state">x</div>');
			vision_flase++
		}
	} else if(btn_text == "左"){
		if($('#detection_test').hasClass('zuo')){
			$('#state').append('<div class="state nav_ball_font">√</div>');
			vision_true++
		}else{
			$('#state').append('<div class="state">x</div>');
			vision_flase++
		}
	}else if(btn_text == "右"){
		if($('#detection_test').hasClass('you')){
			$('#state').append('<div class="state nav_ball_font">√</div>');
			vision_true++
		}else{
			$('#state').append('<div class="state">x</div>');
			vision_flase++
		}
	}else{
		if($('#detection_test').hasClass('xia')){
			$('#state').append('<div class="state nav_ball_font">√</div>');
			vision_true++
		}else{
			$('#state').append('<div class="state">x</div>');
			vision_flase++
		}
	}
	if(vision_true == 3){
		$('#state').empty();
		vision_true = 0;
		vision_flase = 0;
		vision_see = (parseFloat(vision_see)+0.1).toFixed(1);
		if (vision_see<5) {
			vision_bei = (parseFloat(vision_bei)-0.1).toFixed(1);
		} else if(vision_see<5.2){
			vision_bei = (parseFloat(vision_bei)-0.01).toFixed(2);
		}else{
			window.location.href='testresult?vision_see=5.2';
		}
		$('.detection_r').text(vision_see);
		$('#detection_img_rel').css('transform','scale('+vision_bei+')');
		vision_state = true;
	}
	if(vision_flase == 3){
		$('#state').empty();
		vision_true = 0;
		vision_flase = 0;
		if (vision_state) {
			window.location.href='testresult?vision_see='+vision_see;
		} else{
			vision_see-=0.1;
			vision_see = parseFloat(vision_see).toFixed(1);
			vision_bei+=0.1;
			vision_bei = parseFloat(vision_bei).toFixed(1);
			$('.detection_r').text(vision_see);
			$('#detection_img_rel').css('transform','scale('+vision_bei+')');
		}
	}
	$('#detection_test').removeClass();
	$('#detection_test').addClass(arr1[ran_num]);
	if (vision_see<4) {
		var vision_index = (parseFloat(vision_see)-4).toFixed(2)*10;
		if(vision_index>7){
			$('.ruler_re').css('margin-left',-(vision_index-7)*12+'vw')
		}
		$('.ruler_re').children().removeClass('font_color');
		$('.ruler_re').children().eq(vision_index).addClass('font_color');
		$('.detection_l').text(arr2[vision_index]);
		console.log(vision_index);
	}
	
})
$('#choose_btn').click(function(){
	ran_num = parseInt(Math.random()*4);
	$('#state').append('<div class="state">x</div>');
	vision_flase++
	if(vision_flase == 3){
		$('#state').empty()
		vision_true = 0;
		vision_flase = 0;
		if (vision_state) {
			window.location.href='testresult?vision_see='+vision_see;
		} else{
			vision_see-=0.1;
			vision_see = parseFloat(vision_see).toFixed(1);
			vision_bei+=0.1;
			vision_bei = parseFloat(vision_bei).toFixed(1);
			$('.detection_r').text(vision_see);
			$('#detection_img_rel').css('transform','scale('+vision_bei+')');
		}
	}
	$('#detection_test').removeClass();
	$('#detection_test').addClass(arr1[ran_num]);
})
