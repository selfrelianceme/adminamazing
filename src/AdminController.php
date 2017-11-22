<?php

namespace Selfreliance\Adminamazing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Selfreliance\Adminamazing\Models\Block;

class AdminController extends Controller
{
    public function index()
    {
        $blocks = Block::orderBy('sort', 'asc')->get();
        return view('adminamazing::home', compact('blocks'));
    }

    public function blocks()
    {
        $allBlocks = \Blocks::all();
        $allBlocks = array_keys($allBlocks);
        $allBlocks = Block::orderBy('sort', 'asc')->whereNotIn('view', $allBlocks)->get();
        $blocks = Block::orderBy('sort', 'asc')->get();
        return view('adminamazing::blocks', compact('blocks', 'allBlocks'));
    }

    public function getNumEnding($iNumber, $aEndings)
    {
        $sEnding =
        $i = 0;
        $iNumber = $iNumber % 100;
        if ($iNumber>=11 && $iNumber<=19) {
            $sEnding=$aEndings[2];
        }
        else {
            $i = $iNumber % 10;
            switch ($i)
            {
                case (1): $sEnding = $aEndings[0]; break;
                case (2):
                case (3):
                case (4): $sEnding = $aEndings[1]; break;
                default: $sEnding = $aEndings[2];
            }
        }
        return $sEnding;
    }

    public function addBlocks(Request $request)
    {
        if(!is_null($request['selected_blocks']))
        {
            $addedBlocks = 0;
            $blocks = Block::orderBy('sort', 'asc')->whereIn('view', $request['selected_blocks'])->get();
            foreach($request['selected_blocks'] as $selected)
            {
                if(!$blocks->contains('view', $selected))
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

                    $addedBlocks++;
                }
            }

            if(count($addedBlocks) > 0 && $addedBlocks != 0)
            {
                $ending = [
                    ['блок', 'добавлен'], ['блока', 'добавлено'], ['блоков', 'добавлены']
                ];

                $ending = self::getNumEnding($addedBlocks, $ending);
                flash()->success($addedBlocks.' '.$ending[0].' '.$ending[1]);   
            }
        }

        return redirect()->route('AdminBlocks');
    }

    public function deleteBlock($id)
    {
        $block = Block::findOrFail($id);

        $block->delete();

        flash()->success('Блок удален');

        return redirect()->route('AdminBlocks');
    }

    public function updateBlocks(Request $request)
    {
        $i = 1;
        $items = $request['items'];

        if(!is_null($items))
        {
            $blocks = Block::orderBy('sort', 'asc')->get();
            foreach($items as $item)
            {
                if($blocks->contains('id', $item['id']))
                {
                    $data = [
                        'posX' => $item['x'],
                        'posY' => $item['y'],
                        'width' => $item['width'],
                        'height' => $item['height'],
                        'sort' => $i
                    ];
                    
                    Block::where('id', $item['id'])->update($data);

                    $i++;
                }
            }
        }

        return \Response::json(['success' => true], '200');
    }
}