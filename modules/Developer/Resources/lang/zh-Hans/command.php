<?php
return [
    'create'                  => '创建',
    'model.title'             => 'Model 模型',
    'model.name.label'        => 'Model 名称',
    'model.name.help'         => '如：test，将创建Test',
    'model.table.label'       => 'Table 名称',
    'model.table.help'        => '模型关联的数据表，如果不填写，将使用Model名称的复数为表名称，当表存在时，自动生成表的对应模型属性',
    'console.title'           => 'Artisan 命令',
    'console.help'            => '需要在当前模块的ServiceProvider的register方法中注册后才能生效',
    'console.name.label'      => '命令名称',
    'console.name.help'       => '如：test，将创建TestCommand',
    'request.title'           => 'Request 表单请求',
    'request.name.label'      => '名称',
    'request.name.help'       => '如：test，将创建TestRequest',
    'provider.title'          => 'ServiceProvider 服务提供者',
    'provider.help'           => '需要在当前模块的module.json的providers属性中注册后才能生效',
    'provider.name.label'     => '名称',
    'provider.name.help'      => '如：test，将创建TestServiceProvider',
    'provider.type.label'     => '类型',
    'provider.type.help'      => '',
    'provider.type.plain'     => '常规服务提供者',
    'provider.type.event'     => '事件服务提供者',
    'provider.type.route'     => '路由服务提供者',
    'middleware.title'        => 'Middleware 中间件',
    'middleware.help'         => '需要在当前模块的ServiceProvider的boot方法中注册后才能生效',
    'middleware.name.label'   => '名称',
    'middleware.name.help'    => '如：test，将创建TestMiddleware',
    'event.title'             => 'Event 事件',
    'event.name.label'        => '名称',
    'event.name.help'         => '如：test，将创建Test',
    'listener.title'          => 'Listener 监听器',
    'listener.name.label'     => 'Listener 名称',
    'listener.name.help'      => '如：test，将创建 Test',
    'listener.event.label'    => 'Event 名称',
    'listener.event.help'     => '监听的Event事件，当前模块只需输入基本类名',
    'listener.queued.label'   => '是否使用队列',
    'listener.queued.help'    => '',
    'factory.title'           => 'Factory 数据工厂',
    'factory.name.label'      => '名称',
    'factory.name.help'       => '如：test，将创建 TestFactory',
    'mail.title'              => 'Mail 邮件',
    'mail.name.label'         => '名称',
    'mail.name.help'          => '如：test，将创建 Test',
    'notification.title'      => 'Notification 消息通知',
    'notification.name.label' => '名称',
    'notification.name.help'  => '如：test，将创建 Test',
    'seeder.title'            => 'Seeder 数据填充',
    'seeder.name.label'       => 'Seeder 名称',
    'seeder.name.help'        => '如：test，将创建 TestDatabaseSeeder或者TestTableSeeder',
    'seeder.master.label'     => 'Seeder 类型',
    'seeder.master.help'      => '选择是创建TestDatabaseSeeder，选择否将创建 TestTableSeeder',
    'rule.title'              => 'Rule 验证规则',
    'rule.name.label'         => '名称',
    'rule.name.help'          => '如：test，将创建 Test',
    'trait.title'             => 'Trait 代码复用',
    'trait.name.label'        => '名称',
    'trait.name.help'         => '如：test，将创建 Test',
    'data.title'              => 'Data 文件数据',
    'data.name.label'         => '名称',
    'data.name.help'          => '如：test，将创建 test',
    'hook.title'              => 'Hook 钩子',
    'hook.name.label'         => '名称',
    'hook.name.help'          => '如：test，将创建 Test',
    'job.title'               => 'Job 任务',
    'job.name.label'          => 'Job 名称',
    'job.name.help'           => '如：test，将创建 Test',
    'job.sync.label'          => 'Sync 同步任务',
    'job.sync.help'           => '',
    'policy.title'            => 'Policy 策略',
    'policy.help'             => '需要在当前模块的ServiceProvider的boot方法中注册后才能生效',
    'policy.name.label'       => '名称',
    'policy.name.help'        => '如：test，将创建 Test',
    'test.title'              => 'Test 测试',
    'test.help'               => '',
    'test.name.label'         => '名称',
    'test.name.help'          => '如：test，将创建 Test',
    'test.type.label'         => '类型',
    'test.type.help'          => '',
    'test.type.unit'          => '单元测试，对代码中少且相对独立的一部分代码来进行',
    'test.type.feature'       => '功能测试，对大面积代码进行的测试',
];
