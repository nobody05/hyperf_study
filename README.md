# hyperf_study
demos study php hyperf framework



## 文件说明
- hyperf-skeleton
    - app
       - Aspect                      切面
         -TestAspect.php             切面类
       - Controller
         - RoomController.php        聊天首页
         - SocketIoController.php    聊天socket控制器
         - WebSocketController.php   
         - AopTestController.php   
       - Crontabs                    计划任务
         - ExcelExport.php           表格导出    
       - config
         - autoload
            - server.php             server配置
            - view.php               模板配置
       - Service
         - Rpc                       服务提供逻辑
           - SearchService.php
         - LogService.php            记录日志
         - LoginService.php          登录service
       - swoole_demo                 swoole的一些测试
       - tcpip                       php的client-server例子
       - reflection                  注解及反射的原理  
       - public
         - js
            - socket.io.js
         - css
            - socketio.css
         - view 
            - socketio
                - index.blade.php    聊天页面
- rpc_client                         服务调用者
    
- web                                前端页面
  - src                              dev 源码
    - Page                           页面
      - DownloadCenter.js            下载中心
      - UserList.js                  用户列表
    - Components                     组件
      - Nav                          导航配置
  