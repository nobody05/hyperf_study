<?php

use Illuminate\Support\Facades\DB;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use \Illuminate\Events\Dispatcher;
use \Illuminate\Container\Container;
use \Illuminate\Database\Capsule\Manager;

require __DIR__."/../vendor/autoload.php";

! defined('BASE_PATH') && define('BASE_PATH', dirname(__DIR__, 1));

$capsule = new Manager();
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'test',
    'username'  => 'root',
    'password'  => 'root',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$capsule->setEventDispatcher(new Dispatcher(new Container()));
$capsule->setAsGlobal();
$capsule->bootEloquent();



print_r(memory_get_peak_usage(true) / 1024 / 1024);
$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();


$columns = [
    'id' => 'ID',
    'nickname' => '昵称',
    'gender' => '性别',
    'mobile' => '手机号',
    'country' => '国家',
    'province' => '省份'
];
echo PHP_EOL;
print_r(memory_get_peak_usage(true) / 1024 / 1024);

$result = $capsule::table("user")
    ->where("id", ">", 100)
    ->select(array_keys($columns))
    ->limit(20000)
    ->get()
    ->toArray();
$result = json_decode(json_encode($result), true);

echo PHP_EOL;
print_r(memory_get_peak_usage(true) / 1024 / 1024);

$sheet = $spreadsheet->getActiveSheet();

$row = 1;
$column = 1;
foreach ($columns as $field => $description) {
    $sheet->setCellValueByColumnAndRow($column, $row, $description);

    $column ++;
}

foreach ($result as $k=>$info) {
    $row = $k+2;
    $i = 1;
    foreach ($info as $key=>$value) {
        $column = $i;
        if (is_string($value) && strpos($value, '=') === 0) $value = "'".$value;
        $sheet->setCellValueByColumnAndRow($column, $row, $value);

        $i ++;
    }

}

echo PHP_EOL;
print_r(memory_get_peak_usage(true) / 1024 / 1024);

$writer = new Xlsx($spreadsheet);
$writer->save(BASE_PATH. '/runtime/hello'.date("YmdHis"). '.xlsx');
echo PHP_EOL;
print_r(memory_get_peak_usage(true) / 1024 / 1024);
