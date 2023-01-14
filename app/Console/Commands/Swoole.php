<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Chat;

class Swoole extends Command
{
     protected $server;

    //public function __construct()
    //{
    //    $this->server =new \swoole_websocket_server('0.0.0.0', 9502);
    //    $this->server->set([
    //        'worker_num' => 4,
    //        'task_worker_num' => 3,
    //        'max_request' => 5,
    //    ]);
    //    $this->server->on('open', [$this, 'onOpen']);
    //    $this->server->on('message', [$this, 'onMessage']);
    //    $this->server->on('task', [$this, 'onTask']);
    //    $this->server->on('finish', [$this, 'onFinish']);
    //    $this->server->on('close', [$this, 'onClose']);
    //    $this->server->start();
    //}


    public function onOpen($server, $request)
    {
        var_dump($request->fd . "连接成功");
    }



    public function onMessage($server, $frame)
    {
        var_dump($frame);
        $message = json_decode($frame->data);
        var_dump($message);
        $flight = User::where('id', $message->to_id)->first();
        $this->server->bind($frame->fd,$flight->id);
        $conn_list = $this->server->connections;
        foreach ($conn_list as $fd){
            var_dump($this->server->getClientInfo($fd)['uid']);
            if($this->server->getClientInfo($fd)['uid']==$message->from_id){
                var_dump('输出所有uid');
                $codes = $fd;
                $user_getId = $this->server->getClientInfo($fd)['uid'];
            }else if(empty($codes)){
                $codes = 0;
                $user_getId=0;
            }
        }
        if($message->mode =='chat'){
            $chat_id = $message->chat_id;
            $chat_group = Chat::with('chat_alls')
                ->where('chat.to_id', $flight->id)
                ->where('chat.group_id', 0)
                ->join('user', 'user.id', '=', 'chat.from_id')
                ->select('user.id', 'user.pic', 'user.name', 'chat.*')
                ->orderBy('chat.updated_at', 'DESC')
                ->get();
            if(count($chat_group)<=0){
                $chat_group = Chat::with('chat_alls')
                ->where('chat.from_id', $flight->id)
                ->where('chat.group_id', 0)
                ->join('user', 'user.id', '=', 'chat.to_id')
                ->select('user.id', 'user.pic', 'user.name', 'chat.*')
                ->orderBy('chat.updated_at', 'DESC')
                ->get();
            }
            if($user_getId){
                $chat_group_you = Chat::with('chat_alls')
                    ->where('chat.to_id', $user_getId)
                    ->where('chat.group_id', 0)
                    ->join('user', 'user.id', '=', 'chat.from_id')
                    ->select('user.id', 'user.pic', 'user.name', 'chat.*')
                    ->orderBy('chat.updated_at', 'DESC')
                    ->get();
                if(count($chat_group_you)<=0){
                    $chat_group_you = Chat::with('chat_alls')
                    ->where('chat.from_id', $user_getId)
                    ->where('chat.group_id', 0)
                    ->join('user', 'user.id', '=', 'chat.to_id')
                    ->select('user.id', 'user.pic', 'user.name', 'chat.*')
                    ->orderBy('chat.updated_at', 'DESC')
                    ->get();
                }
            }


            $from_info = Chat::where('chat.id', $chat_id)
                ->join('user', 'user.id', '=', 'chat.from_id')
                ->select('user.id', 'user.pic', 'user.name', 'user.description', 'chat.to_id')
                ->first();

            if ($from_info->to_id != $flight->id) {
                $from_info = Chat::where('chat.id', $chat_id)
                    ->join('user', 'user.id', '=', 'chat.to_id')
                    ->select('user.id', 'user.pic', 'user.name', 'user.description')
                    ->first();
            }
            $info = json_decode($frame->data);
            if($user_getId){
                $task_id = $this->server->task(['data' => $chat_group,'data_you'=>$chat_group_you, 'from_info' => $from_info,'user_id'=>$frame->fd,'sj'=>$codes]);
            }else{
                $task_id = $this->server->task(['data' => $chat_group, 'from_info' => $from_info,'user_id'=>$frame->fd,'sj'=>$codes]);
            }

        }else{
            $chat_id = $message->chat_id;
            $from_id = $message->from_id;
            $to_id = $message->to_id;
            $content = $message->content;
            $upimages = $message->upimages;
            var_dump($upimages);
            $chats = new Chat();
            $chats->from_id = $from_id;
            $chats->group_id = $chat_id;
            $chats->to_id = $to_id;
            foreach ($upimages as $u){
            if (!empty($u)){
                    $content+="<img src=".$u.">";
                }
            }
            $chats->content = $content;
            $chats->save();

            $chat_group = Chat::with('chat_alls')
                ->where('chat.to_id', $flight->id)
                ->where('chat.group_id', 0)
                ->join('user', 'user.id', '=', 'chat.from_id')
                ->select('user.id', 'user.pic', 'user.name', 'chat.*')
                ->orderBy('chat.updated_at', 'DESC')
                ->get();
            if(count($chat_group)<=0){
                $chat_group = Chat::with('chat_alls')
                ->where('chat.from_id', $flight->id)
                ->where('chat.group_id', 0)
                ->join('user', 'user.id', '=', 'chat.to_id')
                ->select('user.id', 'user.pic', 'user.name', 'chat.*')
                ->orderBy('chat.updated_at', 'DESC')
                ->get();
            }
            if($user_getId){
                $chat_group_you = Chat::with('chat_alls')
                    ->where('chat.to_id', $user_getId)
                    ->where('chat.group_id', 0)
                    ->join('user', 'user.id', '=', 'chat.from_id')
                    ->select('user.id', 'user.pic', 'user.name', 'chat.*')
                    ->orderBy('chat.updated_at', 'DESC')
                    ->get();
                if(count($chat_group_you)<=0){
                    $chat_group_you = Chat::with('chat_alls')
                    ->where('chat.from_id', $user_getId)
                    ->where('chat.group_id', 0)
                    ->join('user', 'user.id', '=', 'chat.to_id')
                    ->select('user.id', 'user.pic', 'user.name', 'chat.*')
                    ->orderBy('chat.updated_at', 'DESC')
                    ->get();
                }
            }
            $from_info = Chat::where('chat.id', $chat_id)
                ->join('user', 'user.id', '=', 'chat.from_id')
                ->select('user.id', 'user.pic', 'user.name', 'user.description', 'chat.to_id')
                ->first();

            if ($from_info->to_id != $flight->id) {
                $from_info = Chat::where('chat.id', $chat_id)
                    ->join('user', 'user.id', '=', 'chat.to_id')
                    ->select('user.id', 'user.pic', 'user.name', 'user.description')
                    ->first();
            }
            $info = json_decode($frame->data);
            if($user_getId){
                $task_id = $this->server->task(['data' => $chat_group,'data_you'=>$chat_group_you, 'from_info' => $from_info,'user_id'=>$frame->fd,'sj'=>$codes]);
            }else{
                $task_id = $this->server->task(['data' => $chat_group, 'from_info' => $from_info,'user_id'=>$frame->fd,'sj'=>$codes]);
            }
        }


        echo "任务id:{$task_id}投递成功!";
    }

    public function onTask($server, $task_id, $from_id, $data)
    {

        if ($data['user_id']>0){
            // 单用户对话
            $tmpGrop = [$data['user_id']];
            \Swoole\Timer::tick(1000, function ($timer_id) use ($data,$tmpGrop) {
                var_dump($timer_id);
                foreach ($tmpGrop as $fd) {
                    $this->server->push($fd, json_encode(['data' => $data['data'],'from_info'=>$data['from_info']]));
                }
                if(isset($data['data_you'])){
                    $this->server->push($data['sj'],json_encode(['data' => $data['data_you'],'from_info'=>$data['from_info']]));
                }
                \Swoole\Timer::clear($timer_id);
            });
        }else{
            // 发送全站用户
            \Swoole\Timer::tick(1000, function () use ($data) {
                    foreach ($this->server->connections as $fd) {
                        if ($this->server->isEstablished($fd)) {
                            $this->server->push($fd, json_encode(['data' => $data['data'],'from_info'=>$data['from_info']]));
                        }
                    }
                Swoole\Timer::clear($timer);
            });
        }
        $this->server->finish($data);
    }

    public function onFinish($server, $task_id, $data)
    {
        echo '任务: ' . $task_id . ' 执行完毕' . PHP_EOL;
    }

    public function onClose($server, $fd)
    {
        $this->server->task(['message' => '路人: ' . $fd . ' 下线了' . PHP_EOL, 'type' => 4]);
    }
}

