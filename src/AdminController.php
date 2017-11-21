<?php

namespace Selfreliance\Adminamazing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        \Carbon\Carbon::setToStringFormat(config('adminamazing.timeFormat'));
        \View::share('time', \Carbon\Carbon::now());
    }

    public function index($edit = false)
    {
        $blocks = \DB::table('blocks')->orderBy('sort', 'asc')->get();
        return view('adminamazing::home', compact('blocks'));
    }

    public function blocks()
    {
        $blocks = \DB::table('blocks')->orderBy('sort', 'asc')->get();
        return view('adminamazing::blocks', compact('blocks'));
    }

    public function addBlocks(Request $request)
    {
        if(!is_null($request['selected_blocks']))
        {
            $blocks = 0;
            foreach($request['selected_blocks'] as $selected)
            {
                \DB::table('blocks')->insert([
                    'view' => $selected,
                    'posX' => 0,
                    'posY' => 0,
                    'sort' => 0
                ]);

                $blocks++;
            }

            if($blocks > 1)
            {
                flash()->success('Блоки добавлены');
            }
            else
            {
                flash()->success('Блок добавлен');
            }
        }

        return redirect()->route('AdminMain');
    }

    public function deleteBlock($id)
    {
        \DB::table('blocks')->where('id', $id)->delete();

        return redirect()->route('AdminMain');
    }

    public function updateBlocks(Request $request)
    {
        $i = 1;
        $items = $request->input('items');
        foreach($items as $item)
        {
            \DB::table('blocks')->where('id', $item['id'])->update([
                'posX' => $item['x'],
                'posY' => $item['y'],
                'sort' => $i
            ]);

            $i++;
        }

        return \Response::json(["success" => true], "200");
    }
}