<?php
//预设信息
$file = 'group.json';//文件名
$minxx = 1;//最小值(因为我懒得去读)
$maxxx = 113;//最大值

//载入json文件并转为数组
$raw_in = file_get_contents($file);
$all_json = json_decode($raw_in,true);

//获取目前顺序,若未开始则为最小值
if(isset($_GET['i']) and !empty($_GET['i'])){
	$now_num = $_GET['i'];
}else{
	$now_num = $minxx;
}

//鼓励语
if($now_num == $maxxx){
	echo '恭喜!这是最后一个了!';
}

if($now_num == floor($maxxx/2)){
	echo '加油,你已经完成一半了!';
}

if($now_num > $maxxx){
	echo '<h1>恭喜完成!共计个'.$maxxx.'群</h1>';
	for ($i=$minxx; $i<=$maxxx; $i++){
		$tmp = explode('>',$all_json[$i]);
		echo '< '.$i.' >   ';
		echo '群名称:'.$tmp[0].'  ';
		echo '群号:'.$tmp[1].'<br>';
	}
	$full = true;
}

//剩余数量
$stn_num = $maxxx-$now_num;

//自增
$next_num = $now_num+1;

if(!$full){
	//提示信息
	echo '<h3>当前序列:'.$now_num.',剩余:'.$stn_num.'</h3>';

	//分割文本并输出
	$tmp = explode('>',$all_json[$now_num]);
	echo '群名称:'.$tmp[0].'<br>';
	echo '群号:'.$tmp[1].'<br>';
	
	//打个表单出去
	echo '<form action="" method="get">
<input type="hidden" name="i" value="'.$next_num.'"/>
<button id="submit">下一个('.$next_num.')</button>
</form>
<title>Q群号码复制添加</title>
<p>Powered by IaSoC</p>';
}