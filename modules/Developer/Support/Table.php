<?php
namespace Modules\Developer\Support;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Doctrine\DBAL\Types\Type;
use Modules\Developer\Support\Structure;
use Filter;

class Table
{

	/**
	 * @var \Doctrine\DBAL\Schema\AbstractSchemaManager
	 */
	protected $schema;

	/**
	 * @var string
	 */
	protected $database;

	/**
	 * @var string
	 */
	protected $table;

	/**
	 * @var string
	 */
	private $prefix;

	/**
	 * @var array
	 */
    private $registerTypes = [
    	// Mysql types
        'json'      => 'text',
        'jsonb'     => 'text',
        'bit'       => 'boolean',
        'enum'      => 'string',      
        // Postgres types
        '_text'     => 'text',
        '_int4'     => 'integer',
        '_numeric'  => 'float',
        'cidr'      => 'string',
        'inet'      => 'string',
    ];

    /**
     * @var array
     */
    private $customTypes = [
        'enum'          => 'Modules\Developer\Support\Types\EnumType',
        'json'          => 'Modules\Developer\Support\Types\JsonType',
        'year'          => 'Modules\Developer\Support\Types\YearType',
        'char'          => 'Modules\Developer\Support\Types\CharType',
        'float'         => 'Modules\Developer\Support\Types\FloatType',
        'tinyint'       => 'Modules\Developer\Support\Types\TinyintType',
        'tinyinteger'   => 'Modules\Developer\Support\Types\TinyintegerType',
        'mediumint'     => 'Modules\Developer\Support\Types\MediumintType',
        'mediuminteger' => 'Modules\Developer\Support\Types\MediumintegerType',
        'timestamp'     => 'Modules\Developer\Support\Types\TimestampType',
        'longtext'     => 'Modules\Developer\Support\Types\LongtextType',
        'mediumtext'     => 'Modules\Developer\Support\Types\MediumtextType',
    ];

	/**
	 * @param string $database
	 * @param bool   $ignoreIndexNames
	 * @param bool   $ignoreForeignKeyNames
	 */
	public function __construct()
	{
		$prefix = DB::getTablePrefix();

        $schema = Schema::getConnection()->getDoctrineSchemaManager();

        // 注册自定义的字段类型
        foreach (Filter::fire('table.custom.types', $this->customTypes) as $type => $class) {
            $this->registerTypes[$type] = $type;
            if (! Type::hasType($type)) {
                Type::addType($type, $class);
            } else {
                Type::overrideType($type, $class);
            }
        }

        // https://github.com/laravel/framework/issues/1346
        foreach (Filter::fire('table.register.types', $this->registerTypes) as $from=>$to) {
            $schema->getDatabasePlatform()->registerDoctrineTypeMapping($from, $to);
        }

		$this->schema = $schema;

		$this->prefix = $prefix;
	}

	/**
	 * 获取全部数据表
	 * 
	 * @return array
	 */
	public static function all($prefix=false)
	{
        $instance  = new static;

		$tables = $instance->schema->listTableNames();

		if ($prefix == false) {
			$tables = array_map(function($table) use ($instance) {
				return str_after($table, $instance->prefix);
			}, $tables);	
		}

		return $tables;        
	}

	/**
	 * 查找表
	 * @param  string $table 不含前缀
	 * @return object|false
	 */
	public static function find($table)
	{
		static $instance = null;

		if (empty($instance)) {
			$instance = new static;
			$instance->table = str_after($table, $instance->prefix);
		}

		return $instance;
	}

    /**
     * 获取表名称
     * 
     * @param  boolean $prefix 是否包含前缀
     * @return string
     */
	public function name($prefix=false)
	{
		return $prefix ? $this->prefix.$this->table : $this->table;
	}

	/**
	 * 检查表是否存在
	 * 
	 * @return bool
	 */
	public function exists()
	{
		return Schema::hasTable($this->table);
	}

	/**
	 * 重命名数据表
	 * 
	 * @return bool
	 */
	public function rename($name)
	{	
		Schema::rename($this->table, $name);

		if (Schema::hasTable($name)) {
			$this->table = $name;
			return true;
		}

		return false;
	}

	/**
	 * 删除表是否存在
	 * 
	 * @return bool
	 */
	public function drop()
	{
		return Schema::dropIfExists($this->table);
	}

	/**
	 * 创建表
	 * 
	 * @param array $columns 字段
	 * @param array  $indexes 索引
	 * @return bool
	 */
	public function create(Array $columns, Array $indexes=[])
	{
        // 转换字段和索引为 laravel 的方法和属性
		$bluepoints = Structure::instance($columns, $indexes)->convertToLaravel();

		Schema::create($this->table, function (Blueprint $table) use ($bluepoints) {
			
			foreach ($bluepoints as $key => $bluepoint) {				
				$method    = $bluepoint['method'];
				$arguments = $bluepoint['arguments'];
				$modifiers = $bluepoint['modifiers'] ?? [];
				
				// 执行方法
				$result = call_user_func_array([$table, $method], $arguments);

				// 修改器
				foreach ($modifiers as $modifier => $argument) {
					call_user_func_array([$result, $modifier], $argument);
				}
			}

		});

		return true;
	}

	/**
	 * 获取表的字段
	 * 
	 * @return array
	 */
	public function columns($collection = false)
	{
		$columns = [];

 		$column_list = $this->schema->listTableColumns($this->prefix.$this->table);
		//debug($this->schema->listTableDetails($this->prefix.$this->table));

        // $after = '__FIRST__';

		foreach ($column_list as $name=>$column) {
			
			$columns[$name]['name']       = $column->getName();
			$columns[$name]['type']       = $column->getType()->getName();
			$columns[$name]['length']     = $column->getLength();
			$columns[$name]['default']    = $column->getDefault();
			$columns[$name]['nullable']   = $column->getNotNull() ? '' : 'nullable';
			$columns[$name]['unsigned']   = $column->getUnsigned() ? 'unsigned' : '';
			$columns[$name]['increments'] = $column->getAutoincrement() ? 'increments' : '';
			$columns[$name]['comment']    = $column->getComment();
            // $columns[$name]['after']      = $after;

            // 将类型转化为数据库支持支持的格式
            $columns[$name]['type'] = Structure::convertTypeToDatabase($columns[$name]['type']);

            // char类型处理
			if ($columns[$name]['type'] == 'varchar' && $column->getFixed()) {
				$columns[$name]['type'] = 'char';
			}

            // 去除laravel中没有长度参数的类型
			if (! in_array($columns[$name]['type'], ['char', 'varchar', 'float', 'double','decimal','enum'])) {
				$columns[$name]['length'] = null;
			}

            // 获取浮点类型的精度
			if (in_array($columns[$name]['type'] , ['decimal', 'float', 'double'])) {
				$columns[$name]['length'] = $column->getPrecision().','.$column->getScale();
			}

            // 获取enum类型的允许值
            if (in_array($columns[$name]['type'], ['enum'])) {
                $columns[$name]['length'] = $column->getType()->getAllowed($this->prefix.$this->table, $columns[$name]['name']);
            }

            // 获取tinyint字段长度，用于区分是tinyint还是boolean
            if (in_array($columns[$name]['type'], ['tinyint'])) {
                $columns[$name]['type'] = $column->getType()->isBoolean($this->prefix.$this->table, $columns[$name]['name']) ? 'boolean' : $columns[$name]['type'];
            }

            // 自增字段无默认值
            if ($columns[$name]['increments']) {
            	$columns[$name]['default'] = null;
            }

            // $after = $columns[$name]['name'];
		}

		//dd($columns);
		
		return $collection ? collect($columns) : $columns;
	}

	/**
	 * 删除字段
	 * 
	 * @param  string $column 字段名称
	 * @return bool
	 */
	public function dropColumn($column)
	{
		Schema::table($this->table, function (Blueprint $table) use ($column) {
		    $table->dropColumn($column);
		});

		return true;	
	}

	/**
	 * 获取表的索引
	 * 
	 * @return array
	 */
	public function indexes($collection = false)
	{
		$indexes = [];
		$index_list = $this->schema->listTableIndexes($this->prefix.$this->table);

		foreach ($index_list as $key => $index) {

			$indexes[$key]['name']    = $index->getName();
			$indexes[$key]['columns'] = $index->getColumns();
			$indexes[$key]['type']    = 'index';

			if ( $index->isUnique() ) {
				$indexes[$key]['type'] = 'unique';
			}

			if ( $index->isPrimary() ) {
				$indexes[$key]['type'] = 'primary';
			}		
		}
		
		return $collection ? collect($indexes) : $indexes;	
	}

    /**
     * __toString 返回数据表名称
     * @return string
     */
	public function __toString()
	{
		return $this->table;
	}
}
