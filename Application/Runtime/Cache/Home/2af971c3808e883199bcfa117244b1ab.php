<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <title>学习卡片</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <!-- 引入样式 -->
    <link rel="stylesheet" href="https://unpkg.com/mint-ui/lib/style.css">
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
		.mint-tabbar{
			position:fixed;
		}
		.after:after {content: ""; width: 100px; } 
 
    </style>
</head>

<body>
    <div id="app">


        <mt-tab-container v-model="active">
            <mt-tab-container-item id="首页">
                <mt-header title="首页">
                    <!-- <router-link to="/" slot="left">
                                <mt-button icon="back">返回</mt-button>
                            </router-link> -->
                    <!-- <mt-button icon="more" slot="right"></mt-button> -->
                </mt-header>
                <ul style="padding: 0px 0px 40px 0px;">
                    <li v-for="item in list">
                        <div style="border:1px solid #ffd45a;border-radius: 10px;margin: .5rem;">
                            <a href="content.html"><img :src="item.img" width=100% height=200 style="border-radius:10px 10px 0px 0px"></img></a>
                            <div style="display: flex;
                                    justify-content: space-between;
                                    margin: 4%;">
                                <div>{{item.name}}</div>
                                <div>卡片数：{{item.num}}</div>
                            </div>
                        </div>
                    </li>
                </ul>
            </mt-tab-container-item>
            <mt-tab-container-item id="我的">
                <mt-header title="我的">
                    <!-- <router-link to="/" slot="left">
                                <mt-button icon="back">返回</mt-button>
                            </router-link> -->
                    <!-- <mt-button icon="more" slot="right"></mt-button> -->
                </mt-header>
                <mt-navbar v-model="selected">
                    <mt-tab-item id="1">我的点赞</mt-tab-item>
                    <mt-tab-item id="2">我的转发</mt-tab-item>
                </mt-navbar>

                <!-- tab-container -->
                <mt-tab-container v-model="selected">
                    <mt-tab-container-item id="1">
                        <div class="after" style="display:flex;flex-wrap: wrap;justify-content: space-between;margin-top: 2rem;">
                            <div v-for="n in 1" >
                                <img src="/Public/index/images/3.jpg" width="100" @click="popup">
                            </div>
                        </div>
                    </mt-tab-container-item>
                    <mt-tab-container-item id="2">
                        <div class="after" style="display:flex;flex-wrap: wrap;justify-content: space-between;margin-top: 2rem;">
                            <div v-for="n in 1">
                                <img src="/Public/index/images/4.jpg"
                                    width="100" @click="popup">
                            </div>
                        </div>
                    </mt-tab-container-item>
                </mt-tab-container>
            </mt-tab-container-item>

        </mt-tab-container>
        <!-- <mt-button @click.native="handleClick">
            <img src="assets/点赞.png" height="20" width="20" slot="icon">
        </mt-button> -->

        <mt-tabbar v-model="active">
            <mt-tab-item id="首页">
                <img slot="icon" src="/Public/index/images/home.png">
                首页
            </mt-tab-item>

            <mt-tab-item id="我的">
                <img slot="icon" src="/Public/index/images/center.png">
                我的
            </mt-tab-item>
        </mt-tabbar>

        <mt-popup v-model="popupVisible" popup-transition="popup-fade">
            <div>请先开通会员！</div>
        </mt-popup>
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
            active: '首页',
            selected: "1",
            popupVisible: false,
            list: [
                {
                    "name": "学习卡片",
                    "img": "/Public/index/images/3.jpg",
                    "num": 123
                },
                {
                    "name": "经典语句",
                    "img": "/Public/index/images/4.jpg",
                    "num": 231
                },
				 
            ]
        },
        methods: {
            popup: function () { 
                this.popupVisible = true;
            },
            handleClick: function () {
                this.$toast('Hello world!')
            }
        }
    })
</script>

</html>