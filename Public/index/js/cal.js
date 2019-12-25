var cal = {
    //param  nutrition=[{fraction:2, weight: 1}]
    //fraction分数 weight 权重
    nutrition: function (nutritions, maxFra, constant = 10) {
        var amount = 0;
        var fraSum = 0;
        var weightSum = 0;
        //求加权平均数
        for (var n of nutritions) {
            fraSum += n.fraction * n.weight;
            weightSum += parseFloat(n.weight);
            amount++;
        }
        let fraAver = fraSum / weightSum;
        return this.getScore(fraAver, maxFra, constant);
    },

    //使用自然常数e构造一个二阶倒数为负（即越大增长越慢）且极限值趋于100的曲线函数
    //越接近标准值得分越高
    //param actual实际值 standard标准值 constant自定义常数
    getScore: function (actual, standard, constant) {
        return 100 / (Math.E ** (Math.abs(actual - standard) / constant));
    },

    //遗传
    //param fa_height父亲身高, mo_height母亲身高, male_standard_height男性标准身高, female_standard_height女性标准身高
    genetic: function (fa_height, mo_height, male_standard_height, female_standard_height, constant = .23) {
        //求均方差
        let diff = Math.sqrt((((fa_height - male_standard_height) ** 2) / male_standard_height ** 2 + ((mo_height - female_standard_height) ** 2) / female_standard_height ** 2) / 2);
        return this.getScore(diff, 0, constant);
    },

    //心跳
    //param sex性别, heartbeat心跳, male_stand男性标准心跳, female_stand女性标准心跳
    heartBeat: function (sex, heartbeat, male_stand, female_stand) {
        if (sex == '男') {
            return this.getScore(heartbeat, male_stand, male_stand);
        } else {
            return this.getScore(heartbeat, female_stand, female_stand);
        }
    },

    //睡觉起床
    //param sleep_time睡觉时间, sleep_stand_time睡觉标准时间
    sleep: function (sleep_time, stand_time, constant = 5) {
        return this.getScore(sleep_time, stand_time, constant);
    },

    //BMI
    //身高单位 cm
    getBMI: function (height, weight) {
        var bmi = weight / ((height / 100) ** 2);
        var status;
        if (bmi < 18.5) {
            status = '偏瘦';
        } else if (bmi < 23.9) {
            status = '正常';
        }
        else if (bmi < 28) {
            status = '偏胖';
        }
        else if (bmi < 35) {
            status = '肥胖';
        }
        else if (bmi < 40) {
            status = '重度肥胖';
        } else {
            status = '极重度肥胖';
        }

        return { 'bmi': bmi, 'status': status };
    }
}
