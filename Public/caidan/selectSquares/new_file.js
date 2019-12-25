var log;//保存第一次点击后的类名
var line = 1;//关卡数；
var aclass = "brick apple";
var bclass = "brick lemon";
var arr = ['brick apple','brick lemon','brick xigua','brick peach','brick strawberry','brick leaf','brick tomato','brick cherry']
console.log(log);
let vConsole = new VConsole();
$(document).on('click','.brick',function(){
	var that = $(this);
	changeClass(that);
	if(!$('.brick').hasClass(aclass) || !$('.brick').hasClass(bclass)){
		line+=1;
		if(line>5){
			layer.open({
                    type: 1,
                    title: false,
                    content: '<div style="display:flex;flex-direction:column;align-items:center;justify-content:center;"><h1>游戏结束</h1></div>',
                    closeBtn: 0,
                    shadeClose: false,
                    btn: ['再来一次', '回到菜单',],
                   	yes: function (index, layero) {
                     window.location.reload();
                    },
                    btn2: function (index, layero) {
                        window.location.href = '../index.html';
                    }
                });
		}else{
            $('#num').text(line);
			adding(line);
			// log = undefined;
		}
	}
})
function changeClass(that){
    log = that.attr('class');
	if (log === aclass) {
        that.removeClass(aclass).addClass(bclass);
	}else{
        that.removeClass(bclass).addClass(aclass);
	}
}
function adding(line){
	let lines = line*4;
	$('#content').empty();
	RanClass()
	for (var i = 0;i<lines;i++) {
		let rand = parseInt(Math.random()*2);
		if (rand == 1) {
			$('#content').append('<div class="'+aclass+'"></div>');
		} else{
			$('#content').append('<div class="'+bclass+'"></div>');
		}
	}
}

function RanClass(){
	aclass = arr[parseInt(Math.random()*8)];
	bclass = arr[parseInt(Math.random()*8)];
	if (aclass == bclass) {
		RanClass()
	}
}
