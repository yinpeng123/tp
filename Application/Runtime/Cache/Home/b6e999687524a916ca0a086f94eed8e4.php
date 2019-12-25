<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="/Public/index/css/common.css" />
    <link rel="stylesheet" href="/Public/index/css/makingplan.css">
    <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="/Public/index/js/common.js"></script>
</head>

<body>
    <div>
        <header>
            <h1>制定挑战计划</h1>
            <div class="startTime">
                <p class="startTime-text">开始时间</p>
                <p class="startTime-number">2018.11.30</p>
            </div>
            <div class="endTime">
                <p class="endTime-text">结束时间</p>
                <p class="endTime-number">2018.12.17</p>
            </div>
            <div class="reward">
                <p class="reward-text">完成奖励</p>
                <p><span class="star"></span><span class="reward-number">400</span></p>
            </div>
            <div class="period">
                <p class="period-text">挑战期限</p>
                <span class="period-number">21</span>
            </div>
        </header>
        <form class="plan-table">
            <div class="table-left">
                <div class="title">
                    计划内容
                </div>
                <div><input type="text" name="plan-one" maxlength="10" placeholder="请输入计划内容" /></div>
                <div><input type="text" name="plan-two" maxlength="10" placeholder="请输入计划内容" /></div>
                <div><input type="text" name="plan-three" maxlength="10" placeholder="请输入计划内容" /></div>
                <div><input type="text" name="plan-four" maxlength="10" placeholder="请输入计划内容" /></div>
                <div><input type="text" name="plan-five" maxlength="10" placeholder="请输入计划内容" /></div>
                <div><input type="text" name="plan-six" maxlength="10" placeholder="请输入计划内容" /></div>
                <div><input type="text" name="plan-seven" maxlength="10" placeholder="请输入计划内容" /></div>
            </div>
            <div class="table-right">
                <div class="title">
                    设定时间
                </div>
                <div class="timepicker" id="timepicker1">
                    <span>
                        <div class="timepicker-icon"></div>
                    </span>
                </div>
                <div class="timepicker" id="timepicker2"><span>
                        <div class="timepicker-icon"></div>
                    </span></div>
                <div class="timepicker" id="timepicker3"><span>
                        <div class="timepicker-icon"></div>
                    </span></div>
                <div class="timepicker" id="timepicker4"><span>
                        <div class="timepicker-icon"></div>
                    </span></div>
                <div class="timepicker" id="timepicker5"><span>
                        <div class="timepicker-icon"></div>
                    </span></div>
                <div class="timepicker" id="timepicker6"><span>
                        <div class="timepicker-icon"></div>
                    </span></div>
                <div class="timepicker" id="timepicker7"><span>
                        <div class="timepicker-icon"></div>
                    </span></div>
            </div>
            <button class="button-save" type="button">保存</button>
        </form>
    </div>

    <script src="/Public/index/js/makingplan.js"></script>
</body>

</html>