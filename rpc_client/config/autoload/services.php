<?php
declare(strict_types=1);


return [
    'consumers' => [
        [
            // 对应消费者类的 $serviceName
            'name' => 'SearchService',
            // 这个消费者要从哪个服务中心获取节点信息，如不配置则不会从服务中心获取节点信息
            'registry' => [
                'protocol' => 'consul',
                'address' => 'http://127.0.0.1:8500',
            ],
            'options' => [
                'connect_timeout' => 5.0,
                'recv_timeout' => 5.0,
                'settings' => [
                    // 根据协议不同，区分配置
                    'open_eof_split' => true,
                    'package_eof' => "\r\n",
//                     'open_length_check' => true,
//                     'package_length_type' => 'N',
//                     'package_length_offset' => 0,
//                     'package_body_offset' => 4,
                ],
            ]

            // 如果没有指定上面的 registry 配置，即为直接对指定的节点进行消费，通过下面的 nodes 参数来配置服务提供者的节点信息
//            'nodes' => [
//                ['host' => '127.0.0.1', 'port' => 9504],
//            ],
        ]
    ],
];