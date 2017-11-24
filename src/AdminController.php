<?php

namespace Selfreliance\Adminamazing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Selfreliance\Adminamazing\Models\Block;

class AdminController extends Controller
{
    private $block;

    public function __construct(Block $model)
    {
        $this->block = $model;
    }

    public function index()
    {
        $blocks = $this->block->orderBy('sort', 'asc')->get();
        return view('adminamazing::home', compact('blocks'));
    }

    public function blocks()
    {
        $collectionBlocks = collect(\Blocks::all());
        $allBlocks = $this->block->orderBy('sort', 'asc')->whereNotIn('view', $collectionBlocks->keys())->get();
        $blocks = $this->block->orderBy('sort', 'asc')->get();
        return view('adminamazing::blocks', compact('blocks', 'allBlocks'));
    }

    public function addBlocks(Request $request)
    {
        $selectedBlocks = $request['selected_blocks'];

        if(!is_null($selectedBlocks))
        {
            $addedBlocks = 0;
            $blocks = $this->block->orderBy('sort', 'asc')->whereIn('view', $selectedBlocks)->get();
            foreach($selectedBlocks as $selected)
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

                    $this->block->create($data);

                    $addedBlocks++;
                }
            }

            if($addedBlocks > 0)
            {
                $ending =
                $i = 0;

                $number = $addedBlocks % 100;

                if($number >= 11 && $number <= 19)
                {
                    $ending = ['блоков', 'добавлено'];
                }
                else 
                {
                    $i = $addedBlocks % 10;
                    switch($i)
                    {
                        case (1): $ending = ['блок', 'добавлен']; break;
                        case (2):
                        case (3):
                        case (4): $ending = ['блоков', 'добавлены']; break;
                        default: $ending = ['блока', 'добавлено'];
                    }
                }

                flash()->success($addedBlocks.' '.$ending[0].' '.$ending[1]);   
            }
        }

        return redirect()->route('AdminBlocks');
    }

    public function updateBlocks(Request $request)
    {
        $sort = 1;
        $items = $request['items'];

        if(!is_null($items))
        {
            $blocks = $this->block->orderBy('sort', 'asc')->get();
            foreach($items as $item)
            {
                if($blocks->contains('id', $item['id']))
                {
                    $data = [
                        'posX' => $item['x'],
                        'posY' => $item['y'],
                        'width' => $item['width'],
                        'height' => $item['height'],
                        'sort' => $sort
                    ];
                    
                    $this->block->where('id', $item['id'])->update($data);

                    $sort++;
                }
            }
        }

        return \Response::json(['success' => true], '200');
    }

    public function deleteBlock($id)
    {
        $block = $this->block->findOrFail($id);

        $block->delete();

        flash()->success('Блок удален');

        return redirect()->route('AdminBlocks');
    }    
}