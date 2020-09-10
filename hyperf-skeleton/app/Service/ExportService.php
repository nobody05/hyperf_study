<?php
declare(strict_types=1);

namespace App\Service;

ini_set("memory_limit", "20M");

use Hyperf\DbConnection\Db;
use Illuminate\Support\Facades\Redis;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Cache\Adapter\Redis\RedisCachePool;
use Cache\Bridge\SimpleCache\SimpleCacheBridge;
use PhpOffice\PhpSpreadsheet\Settings;

class ExportService
{
    protected $spreadsheet;
    protected $xlsx;

    public function __construct(Spreadsheet $spreadsheet)
    {
        $this->spreadsheet = $spreadsheet;
    }

    public function export($headers, $list, $fileName)
    {
        $columns = $headers;
        $result = $list;
        $sheet = $this->spreadsheet->getActiveSheet();

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

        $writer = new Xlsx($this->spreadsheet);
        $writer->save($fileName);

    }
}