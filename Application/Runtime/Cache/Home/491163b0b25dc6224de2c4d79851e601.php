<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <title>学习卡片</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <!-- 引入样式 -->
    <link rel="stylesheet" href="https://unpkg.com/mint-ui/lib/style.css">
    <script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
    <style>
        body {
            margin: 0;
        }

        .mint-header {
            background-color: #ffd45a;
        }

        li {
            list-style-type: none;
        }

        .mt-progress {
            height: 0;
        }

        /* image[lazy=loading] {
            width: 40px;
            height: 300px;
            margin: auto;
        } */
    </style>
</head>

<body>
    <div id="app">
        <mt-header title="卡片内容">
            <a href="index.html" slot="left">
                <mt-button icon="back">返回</mt-button>
            </a>
            <mt-button icon="more" slot="right"></mt-button>
        </mt-header>

        <div>
            <div style="width: 100%;">
                <img :src="item.img" width=100% alt="内容卡片"   class="card">
                <mt-progress :value="timeValue">
                </mt-progress>

            </div>
            <div style="display: flex;justify-content: space-around;align-items: center;background-color: #ffd45a">
                <p style="padding-left: 1rem;">{{item.des}}</p>
                <div style="text-align: center;">
                    <!--&lt;!&ndash;<img src="assets/点赞.png" height="24" width="24" @click="dianzhan">&ndash;&gt;-->
                    <!--<p style="margin: 0;color: #ffffff;">{{item.num1}}</p>-->
                </div>

                <div style="text-align: center;">
                    <!--<img src="assets/分享.png" height="24" width="24" @click="zhuanfa">-->
                    <!--<p style="margin: 0;color: #ffffff;">{{item.num2}}</p>-->
                </div>
            </div>

        </div>
    </div>
</body>
<!-- 先引入 Vue -->
<script src="https://unpkg.com/vue/dist/vue.js"></script>
<!-- 引入组件库 -->
<script src="https://unpkg.com/mint-ui/lib/index.js"></script>
<script>
    new Vue({
        el: '#app',
        data: {
            item: {
                img: "/Public/index/images/1.png",
                des: "关于学习技巧的卡片！",
                num1: 322,
                num2: 123
            },
            totalTime: 200,
            timeValue: 0
        },
        created() {
            let that = this;
            that.setTime();
        },
        methods: {

                setTime: function () {
                    let clock;
                    this.totalTime = 200;
                    this.timeValue = 0;
                    clock = window.setInterval(() => {
                        this.totalTime--;
                        this.timeValue = (200 - this.totalTime) / 2;
                        if (this.totalTime <= 0) {
                            this.item = {
                                img: "/Public/index/images/2.png",
                                des: "经典语句！",
                                num1: 123,
                                num2: 341
                            };
                            this.setTime();
                            clearInterval(clock);
                        }
                    }, 100)
                },
            dianzhan: function () {
                this.item.num1++;
            },
            zhuanfa: function () {
                this.item.num2++;
            },
            touchstart: function (event) {
                var touch = event.targetTouches[0];
                //滑动起点的坐标
                startX = touch.pageX;
                startY = touch.pageY;
            },
            touchmove: function (event) {
                var touch = event.targetTouches[0];
                //手势滑动时，手势坐标不断变化，取最后一点的坐标为最终的终点坐标
                endX = touch.pageX;
                endY = touch.pageY;
                var distanceX = (endX - startX) / 2;
                if (distanceX < 0) {
                    $('.card').css('transform', 'translate(' + distanceX + 'px,0)');
                }

            },
            touchend: function (event) {
                var distanceX = endX - startX;
                if (endX == 0) { return; }
                if (distanceX < -250) {
                    this.item = {
                        img: "/Public/index/images/2.png",
                        des: "经典语句！",
                        num1: 123,
                        num2: 341
                    };
                    this.setTime();
                }
                $('.card').css('transform', 'translate(0,0)');
                startX = startY = endX = endY = 0;
            },
        }
    })
</script>

</html>