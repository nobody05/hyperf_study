# hyperf_study
demos study php hyperf framework



## 文件说明

- app
   - Aspect                      切面
     -TestAspect.php             切面类
   - Controller
     - RoomController.php        聊天首页
     - SocketIoController.php    聊天socket控制器
     - WebSocketController.php   
     - AopTestController.php     
   - config
     - autoload
        - server.php             server配置
        - view.php               模板配置
   - Service
     - LogService.php            记录日志
     - LoginService.php          登录service
   - swoole_demo                 swoole的一些测试
   - reflection                  注解及反射的原理  
   - public
     - js
        - socket.io.js
     - css
        - socketio.css
     - view 
        - socketio
            - index.blade.php    聊天页面
   