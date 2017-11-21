<?php

namespace Selfreliance\Adminamazing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Selfreliance\Adminamazing\Models\Block;

class AdminController extends Controller
{
    public function index($edit = false)
    {
        $blocks = Block::orderBy('sort', 'asc')->get();
        return view('adminamazing::home', compact('blocks'));
    }

    public function blocks()
    {
        $blocks = Block::orderBy('sort', 'asc')->get();
        return view('adminamazing::blocks', compact('blocks'));
    }

    public function addBlocks(Request $request)
    {
        if(!is_null($request['selected_blocks']))
        {
            $blocks = 0;
            foreach($request['selected_blocks'] as $selected)
            {
                $data = [
                    'view' => $selected,
                    'posX' => 0,
                    'posY' => 0,
                    'width' => 2,
                    'height' => 3,
                    'sort' => 0
                ];

                Block::create($data);

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
        $block = Block::findOrFail($id);

        $block->delete();

        return redirect()->route('AdminMain');
    }

    public function updateBlocks(Request $request)
    {
        $i = 1;
        $items = $request->input('items');
        foreach($items as $item)
        {
            $block = Block::find($item['id']);

            $data = [
                'posX' => $item['x'],
                'posY' => $item['y'],
                'width' => $item['width'],
                'height' => $item['height'],
                'sort' => $i
            ];
            
            $block->update($data);

            $i++;
        }

        return \Response::json(["success" => true], "200");
    }
}