<?php
    
return [
    'title'          => 'Migration 数据迁移',
    'index'          => '迁移列表',
    'create'         => '新建迁移',
    'execute'        => '执行命令',
    'migrate'        => '迁移全部',
    'migrated'       => '已迁移',
    'migrate.tips'   => '运行当前模块所有未运行过的迁移',
    'rollback'       => '回滚一步',
    'rollback.tips'  => '回滚当前模块最后一次迁移，注意：操作会导致模块数据丢失',
    'reset'          => '回滚全部',
    'reset.tips'     => '回滚当前模块所有迁移，注意：操作会导致模块数据丢失',
    'refresh'        => '回滚迁移',
    'refresh.tips'   => '回滚当前模块所有迁移，并重新迁移全部，注意：操作会导致模块数据丢失',

    'name.blank'     => '迁移名称',
    'name.table'     => '数据表名称（不含数据表前缀）',
    'name.help'      => '只支持英文（小写）和数字，必须以英文开头，创建成功后，可以编写该迁移文件，然后执行迁移',
    
    'command'        => '迁移类型',
    'command.help'   => '',
    'command.create' => '创建表迁移，如果数据库中已经存在该表，则自动创建该表的创建迁移，否则创建空白创建迁移',
    'command.update' => '修改表迁移，创建一份空白的更新迁移',
    'command.drop'   => '删除表迁移，如果数据库中已经存在该表，则自动创建该表的删除迁移，否则创建空白删除迁移',
    'command.blank'  => '空白迁移，不包含任何迁移内容',

    'file.migrate'   => '迁移',
    'file.reset'     => '回滚',
    'file.refresh'   => '回滚迁移',
];
