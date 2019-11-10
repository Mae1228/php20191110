<?php
require "./SqlHelper.php";
$pdo = new SqlHelper("root","root","127.0.0.1","dbtest");
// BEGIN 创建一个tcp socket服务器
$host = '192.168.0.104';
$port = 7777;
$listen_socket = socket_create( AF_INET, SOCK_STREAM, SOL_TCP );
socket_bind( $listen_socket, $host, $port );
socket_listen( $listen_socket );
// END 创建服务器完毕
echo '我启动了';
// 也将监听socket放入到read fd set中去，因为select也要监听listen_socket上发生事件
$client = [ $listen_socket ];
// 先暂时只引入读事件，避免有同学晕头
$write = [];
$exp = [];
 
// 开始进入循环
while( true ){
    $read = $client;
    // 当select监听到了fd变化，注意第四个参数为null
    // 如果写成大于0的整数那么表示将在规定时间内超时
    // 如果写成等于0的整数那么表示不断调用select，执行后立马返回，然后继续
    // 如果写成null，那么表示select会阻塞一直到监听发生变化
    if( socket_select( $read, $write, $exp, 0 ) > 0 ){
        // 判断listen_socket有没有发生变化，如果有就是有客户端发生连接操作了
        if( in_array( $listen_socket, $read ) ){
            // 将客户端socket加入到client数组中
            $client_socket = socket_accept( $listen_socket );
			
            $client[] = $client_socket;
            // 然后将listen_socket从read中去除掉
            $key = array_search( $listen_socket, $read );
            unset( $read[ $key ] );
        }
        // 查看去除listen_socket中是否还有client_socket
        if( count( $read ) > 0 ){
            foreach( $read as $socket_item ){
                // 从可读取的fd中读取出来数据内容，然后发送给其他客户端
                $content = socket_read( $socket_item, 2048 );
                // 循环client数组，将内容发送给其余所有客户端
                $str=substr($content,0,2);
				$time=date('H:i:s',time());
				
				if($str == '**'){
					$wendu = substr($content,2,2);
					
					$sql="insert into ws values (null,'$wendu',1,'$time')";
					$pdo->execute_dml($sql);
					
				}else if($str == '||'){
					$shidu = substr($content,2,2);
					
					$sql="insert into ws values (null,'$shidu',2,'$time')";
					$pdo->execute_dml($sql);
				}else if($str == '=='){
					$uid=substr($content,2);
					file_put_contents('./uid.txt',$uid);
				}
            }
        }
    }
    // 当select没有监听到可操作fd的时候，直接continue进入下一次循环
    else {
        continue;
    }
 

}