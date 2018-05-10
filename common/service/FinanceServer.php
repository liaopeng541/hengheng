<?php
/**
 * Created by PhpStorm.
 * User: liao
 * Date: 2018/4/6
 * Time: 下午3:53
 */
namespace common\service;
use common\models\FinanceCash;
use common\models\FinanceRechangeTatal;
use common\models\FinanceShopTotal;
use common\models\HhOtoOrder;
use common\models\HhService;
use common\models\HhStore;
use common\models\HhUserBagLog;
use common\models\LpAccountLog;
use common\models\LpFinance;
use common\models\FinanceCard;
use common\models\LpOrder;
use common\models\LpRechargeOrder;
use yii\base\Model;

class FinanceServer extends Model
{
    public static function rechangedata($day)
    {
        echo "正在计算".$day."的充值数据\n";
        if(!FinanceRechangeTatal::find()->where(['date'=>$day])->one()) {
            $yesterday = strtotime($day);
            $before_day = date("Y-m-d", strtotime($day . "-1day"));
            $today = strtotime($day . "+1day");
            //前日结余
            $yesterday_balance = 0;
            $yesterday_model = FinanceRechangeTatal::find()->where(['date' => $before_day])->one();
            $yesterday_model and $yesterday_balance = $yesterday_model->balance;
            //昨日总充值
            $yesterday_recharge = LpRechargeOrder::find()->where(['status' => 1])->andWhere(['between', "add_time", $yesterday, $today])->sum("order_amount");
            $yesterday_wx_recharge = LpRechargeOrder::find()->where(['status' => 1])->andWhere(['between', "add_time", $yesterday, $today])->andWhere(['pay_code' => 2])->sum("order_amount");
            $sql=LpRechargeOrder::find()->where(['status' => 1])->andWhere(['between', "add_time", $yesterday, $today])->andWhere(['pay_code' => 2])->createCommand()->getRawSql();
            echo $sql."\n";
            echo $day."充了".$yesterday_wx_recharge."\n";
            $yesterday_ali_recharge = LpRechargeOrder::find()->where(['status' => 1])->andWhere(['between', "add_time", $yesterday, $today])->andWhere(['pay_code' => 1])->sum("order_amount");

            $yesterday_recharge or $yesterday_recharge = 0;
            //昨日总使用
            $yesterday_use = LpAccountLog::find()->where(['or', ['order_type' => 0], ['order_type' => 5]])->andWhere(['between', "change_time", $yesterday, $today])->sum("user_money");
            $yesterday_use = abs($yesterday_use);
            $yesterday_use or $yesterday_use = 0;
            //昨日结余
            $balance = $yesterday_balance + $yesterday_recharge - $yesterday_use;
            $F = new FinanceRechangeTatal();
            $F->balance = $balance;
            $F->date = $day;
            $F->yesterday_balance = $yesterday_balance;
            $F->rechange_money = $yesterday_recharge;
            $F->wx_total = $yesterday_wx_recharge;
            $F->ali_total = $yesterday_ali_recharge;
            $F->use_money = $yesterday_use;
            $F->save();
        }else{
            echo $day."的充值数据己经存在，无需计算\n";
        }
    }

    public static function carddata($day)
    {
        //查询所有服务
        $servicelist=HhService::find()->all();
        $before_day=date("Y-m-d",strtotime($day."-1day"));
        $today_start=strtotime($day);
        $today_end=strtotime($day."+1day");
        if(!FinanceCard::find()->andWhere(['date'=>$day])->all()) {
            echo "计算".$day."卡劵数据\n";
            $yes_card = FinanceCard::find()->andWhere(['date' => $before_day])->all();
            foreach ($servicelist as $val) {
                $f_card = new FinanceCard();
                $f_card->date = $day;
                $f_card->service_name = $val->name;
                $f_card->service_id = $val->id;
                $f_card->yesterday_balance = 0;
                if ($yes_card) {
                    foreach ($yes_card as $v) {
                        if ($v->service_id == $val->id) {
                            $f_card->yesterday_balance = $v->balance;
                        }
                    }
                }
                $f_card->add = HhUserBagLog::find()->where(['service_id' => $val->id])->andWhere([">", 'change_num', 0])->andWhere(['between', 'add_time', $today_start, $today_end])->sum("change_num");
                $f_card->add or $f_card->add = 0;
                $f_card->use = HhUserBagLog::find()->where(['service_id' => $val->id])->andWhere(["<", 'change_num', 0])->andWhere(['between', 'add_time', $today_start, $today_end])->sum("change_num");
                $f_card->use = abs($f_card->use);
                $f_card->balance = $f_card->yesterday_balance + $f_card->add - $f_card->use;
                $f_card->save();
            }
        }else{
            echo $day."卡劵数据己经存在\n";
        }
    }

    public static function Cashdata($day)
    {
        $today_start=strtotime($day);
        $today_end=strtotime($day."+1day");
        $store_list=HhStore::find()->all();
        foreach ($store_list as $val)
        {
            echo "正在统计".$day."收银数据 ";
            $cashmodel=new FinanceCash();
            $cashmodel->store_id=$val->id;
            $a_total=HhOtoOrder::find()->select('sum(total) as a_total,sum(level_total) as a_level_total,sum(user_money_total) as a_user_money_total,sum(card_total) as a_card_total')->where(['pay_status'=>1])->andWhere(['between','add_time',$today_start,$today_end])->andWhere(['store_id'=>$val->id])->asArray()->one();
            $cashmodel->volume=$a_total['a_total'];
            $cashmodel->card_total=$a_total['a_card_total'];
            $cashmodel->vip_total=$a_total['a_level_total'];
            $cashmodel->user_money_total=$a_total['a_user_money_total'];

            $cashmodel->wx_total=HhOtoOrder::find()->where(['pay_status'=>1])->andWhere(['between','add_time',$today_start,$today_end])->andWhere(['pay_code'=>2])->andWhere(['store_id'=>$val->id])->sum('p_total');
            $cashmodel->ali_total=HhOtoOrder::find()->where(['pay_status'=>1])->andWhere(['between','add_time',$today_start,$today_end])->andWhere(['pay_code'=>1])->andWhere(['store_id'=>$val->id])->sum('p_total');
            $cashmodel->cash_total=HhOtoOrder::find()->where(['pay_status'=>1])->andWhere(['between','add_time',$today_start,$today_end])->andWhere(['pay_code'=>0])->andWhere(['store_id'=>$val->id])->sum('p_total');
            $cashmodel->date=$day;
            if($cashmodel->save())
            {
                echo "ok\n";
            }else{
                echo "fail\n";
            }
            usleep(50);

        }



    }

    public static function shopdata($day)
    {
        $today_start=strtotime($day);
        $today_end=strtotime($day."+1day");
        $shop_total=FinanceShopTotal::find()->where(['date'=>$day])->one();
        if(!$shop_total){
            $shop_total=new FinanceShopTotal();
            $shop_total->date=$day;
            $order_total=LpOrder::find()->where(['between',"add_time",$today_start,$today_end])->andWhere(['pay_status'=>1])->sum('total_amount');
            $order_total or $order_total=0;
            $shop_total->total=$order_total;
            $wx_total=LpOrder::find()->where(['between',"add_time",$today_start,$today_end])->andWhere(['pay_status'=>1])->andWhere(['pay_code'=>2])->sum('order_amount');
            $ali_total=LpOrder::find()->where(['between',"add_time",$today_start,$today_end])->andWhere(['pay_status'=>1])->andWhere(['pay_code'=>1])->sum('order_amount');
            $user_money_total=LpOrder::find()->where(['between',"add_time",$today_start,$today_end])->andWhere(['pay_status'=>1])->sum('user_money');
            $shop_total->user_money=$user_money_total;
            $shop_total->wx=$wx_total;
            $shop_total->ali=$ali_total;
            $shop_total->save();
        }



    }


}