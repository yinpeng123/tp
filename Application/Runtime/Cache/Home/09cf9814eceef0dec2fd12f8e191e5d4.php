<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="/Public/index/css/common.css">
    <link rel="stylesheet" href="/Public/index/css/challenge.css" />
    <script src="/Public/index/js/common.js"></script>
    <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="/Public/index/layer/layer.js"></script>
</head>

<body>
    <div>
        <div style="font-size:0;">
            <img id="toutu" alt="宣传图" width="100%" />
        </div>
        <div class="button-area">
            <div class="create-team">
                <div class="create-team-icon"></div>
                <div class="create-team-text"><span>创建队伍</span></div>
            </div>
            <div class="search-team">
                <div class="search-team-icon"></div>
                <div class="search-team-text"><span>搜索队伍</span></div>
                <input class="search-input" type="number" max="999999" placeholder="请输入6位手机尾号" />
                <button class="search-button">搜索</button>
            </div>
        </div>
        <div class="challenge-groups">
        </div>
        <div class="joinTeam-popBox" id="joinTeam-popBox">
            <div class="popBox-mask"></div>
            <div class="popBox-content">
                <p>
                    确定是否参加队伍 <br /> 参加后将与你的队友共夺奖励。
                </p>
                <button class="popBox-button popBox-button-no">我选"NO"</button>
                <button class="popBox-button popBox-button-yes">我选"YES"</button>
            </div>
        </div>
        <div class="warning-popBox" id="comp-warning-popBox">
            <div class="popBox-mask"></div>
            <div class="popBox-content">
                <p>
                    你已被投诉<br /> 七日内不能参加比赛
                </p>
                <button class="popBox-button popBox-button-ok" onclick="hideWarningPopBox()">好吧</button>
            </div>
        </div>
        <div class="warning-popBox" id="hasTeam-warning-popBox">
            <div class="popBox-mask"></div>
            <div class="popBox-content">
                <p>
                    你已拥有队伍<br /> 不能参加其他队伍
                </p>
                <button class="popBox-button popBox-button-ok" onclick="hideWarningPopBox()">好吧</button>
            </div>
        </div>
        <div class="team-popBox" id="team-popBox">
            <div class="popBox-mask"></div>
            <div class="popBox-content">
                <div class="team-popBox-top">
                    <p class="myGroup-name">奥特曼特别行动组</p>
                    <a href="javascript:void(0)" class="btn-close" onclick="hideTeamPopBox()"></a>
                </div>
                <div class="team-popBox-middle">
                    <div class="myGroup-players-avatar" id="myGroup-players-avatar">
                    </div>
                    <p class="myGroup-startTime-text">开始日期</p>
                    <p class="myGroup-startTime">2018/11/30</p>
                </div>
                <div class="team-popBox-bottom">
                    <div class="prompt-icon"></div>
                    <p class="prompt-text">温馨提示<br/>刷新后，将提高您的队伍排名哦</p>
                    <button class="button-refresh" onclick="refresh()">刷新</button>
                </div>

            </div>
        </div>
    </div>
    <script src="/Public/index/js/challenge.js"></script>
</body>

</html>