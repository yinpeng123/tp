var myChart = echarts.init(document.getElementById('bmi_img'));
option = {
    xAxis: {
        type: 'category',
    },
    yAxis: {
        type: 'value',
        scale: true
    },
    grid: {
        top: '10%'
    },
    tooltip: {
        trigger: 'item',
        snap: true,
        formatter: '{c}kg/m^2'
    },
    lineStyle: {
        color: '#f4833d'
    },
    itemStyle: {
        normal: {
            color: '#f4833d'
        }
    },
    series: [{
        name: 'line',
        type: 'line',
        symbolSize: 5,
        smooth: true
    }
        , {
            name: 'scat',
            type: 'effectScatter',
            coordinateSystem: 'cartesian2d',
            symbolSize: 0,
            showEffectOn: 'render',
            rippleEffect: {
                brushType: 'stroke'
            },
            hoverAnimation: true,
            itemStyle: {
                normal: {
                    color: '#f4833d',
                    shadowBlur: 10,
                    shadowColor: '#f4833d'
                }
            }
        }]
};

myChart.setOption(option);
$('#bmi').resize(function () {
    myChart.resize();
});

var myChart1 = echarts.init(document.getElementById('mental_img'));

option1 = {
    xAxis: {
        type: 'category',
    },
    yAxis: {
        type: 'value',
        scale: true
    },
    grid: {
        top: '10%'
    },
    tooltip: {
        trigger: 'item',
        snap: true,
        formatter: '{c}%'
    },
    lineStyle: {
        color: '#2ea377'
    },
    itemStyle: {
        normal: {
            color: '#2ea377'
        }
    },
    series: [{
        name: 'line',
        type: 'line',
        symbolSize: 5,
        smooth: true
    }
        , {
            name: 'scat',
            type: 'effectScatter',
            coordinateSystem: 'cartesian2d',
            symbolSize: 0,
            showEffectOn: 'render',
            rippleEffect: {
                brushType: 'stroke'
            },
            hoverAnimation: true,
            itemStyle: {
                normal: {
                    color: '#2ea377',
                    shadowBlur: 10,
                    shadowColor: '#2ea377'
                }
            }
        }]
};

myChart1.setOption(option1);
$('#mental').resize(function () {
    myChart1.resize();
});

var myChart2 = echarts.init(document.getElementById('mood_img'));

option2 = {
    xAxis: {
        type: 'category',
    },
    yAxis: {
        type: 'value',
        scale: true
    },
    grid: {
        top: '10%'
    },
    tooltip: {
        trigger: 'item',
        snap: true,
        formatter: '{c}%'
    },
    lineStyle: {
        color: '#f3d110'
    },
    itemStyle: {
        normal: {
            color: '#f3d110'
        }
    },
    series: [{
        name: 'line',
        type: 'line',
        symbolSize: 5,
        smooth: true
    }
        , {
            name: 'scat',
            type: 'effectScatter',
            coordinateSystem: 'cartesian2d',
            symbolSize: 0,
            showEffectOn: 'render',
            rippleEffect: {
                brushType: 'stroke'
            },
            hoverAnimation: true,
            itemStyle: {
                normal: {
                    color: '#f3d110',
                    shadowBlur: 10,
                    shadowColor: '#f3d110'
                }
            }
        }]
};


myChart2.setOption(option2);

$('#mood').resize(function () {
    myChart2.resize();
});

var myChart3 = echarts.init(document.getElementById('health_img'));

option3 = {
    xAxis: {
        type: 'category',
    },
    yAxis: {
        type: 'value',
        scale: true
    },
    grid: {
        top: '10%'
    },
    tooltip: {
        trigger: 'item',
        snap: true,
        formatter: '{c}%'
    },
    lineStyle: {
        color: '#bfa377'
    },
    itemStyle: {
        normal: {
            color: '#bfa377'
        }
    },
    series: [
        {
            name: 'line',
            type: 'line',
            symbolSize: 5,
            smooth: true
        }
        , {
            name: 'scat',
            type: 'effectScatter',
            coordinateSystem: 'cartesian2d',
            symbolSize: 0,
            showEffectOn: 'render',
            rippleEffect: {
                brushType: 'stroke'
            },
            hoverAnimation: true,
            itemStyle: {
                normal: {
                    color: '#bfa377',
                    shadowBlur: 10,
                    shadowColor: '#bfa377'
                }
            }
        }
    ]
};


myChart3.setOption(option3);

$('#healths').resize(function () {
    myChart3.resize();
});


