<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Shuchkin\SimpleXLSXGen;

class ExportDataController extends Controller
{

    public function getCodesIdByGroupId($group_id)
    {
        $data = DB::table('codes')
                  ->select('code')
                  ->where('group_id', '=', $group_id)
                  ->get('code');

        $codes = [];
        foreach ($data->toArray() as $item) {
            $codes[] = [$item->code];
        }

        $file = "group_id_{$group_id}_codes.xlsx";

        SimpleXLSXGen::fromArray($codes)->downloadAs($file);
    }
}
