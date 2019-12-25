<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="/Public/index/css/common.css" />
    <link rel="stylesheet" href="/Public/index/css/createteam.css">
    <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="/Public/index/laydate/laydate.js"></script>
    <script src="/Public/index/layer/layer.js"></script>
    <script src="/Public/index/js/common.js"></script>
</head>

<body>
    <div>
        <h1>创建队伍</h1>
        <form id="createteamForm">
            <div class="form-input">
                <div class="group">
                    <label for="teamName">队伍名称</label>
                    <input type="text" required name="teamName" id="teamName" minlength="4" maxlength="10" placeholder="请输入队伍名称" />
                </div>
                <div class="group" style="font-weight: bold;color: #42ae70;">
                    <label for="teamSize" style="color: black;">队伍人数</label>
                    <input  type="radio" name="teamSize" value="2" id="radio1"/><label class="option" for="radio1" >2人</label>
                    <input type="radio" name="teamSize" value="3" id="radio2"/><label class="option" for="radio2">3人</label>
                </div>
                <div class="group">
                    <label for="startTime">开始时间</label>
                    <input type="text" id="startTime" placeholder="请选择日期" name="startTime" id="startTime" />
                    <div class="startTime-icon" id="startTime-icon"></div>
                </div>
                <div class="group">
                    <label for="teamVisibility" style="margin-right: .1rem;">队伍可见性</label>
                    <input type="radio" name="teamVisibility" value="1" id="radio3"/><label class="option onsearch" for="radio3">仅搜索可见</label>
                    <input type="radio" name="teamVisibility" value="2" id="radio4"/><label class="option all" for="radio4">所有人可见</label>
                </div>
            </div>
            <button class="button-submit" type="button">完成创建</button>
        </form>
        <div class="note">
            <p>
                注&emsp;1.创建队伍后，本日内将不可取消和加入队伍<br/> &emsp;&emsp;2.如本日24点前未组队成功，队伍将自动取消
                <br/> &emsp;&emsp;3.队伍创建成功后，计划将不可进行修改
            </p>
        </div>
    </div>
    <script src="/Public/index/js/createteam.js"></script>
</body>

</html>