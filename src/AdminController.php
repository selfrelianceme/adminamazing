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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        foreach(config('adminamazing.blocks') as $block => $value)
        {
            \Blocks::register($block, $value);
        }
        $blocks = $this->block->orderBy('sort', 'asc')->get();
        return view('adminamazing::home', compact('blocks'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function blocks()
    {
        foreach(config('adminamazing.blocks') as $block => $value)
        {
            \Blocks::register($block, $value);
        }

        $allBlocks = array_keys(\Blocks::all());
        $blocks = $this->block->orderBy('sort', 'asc')->get();

        $current_blocks = array();
        $blocks->each(function($row) use (&$current_blocks){
            $current_blocks[] = $row->view;
        });

        $availableBlocks = array();
        foreach($allBlocks as $block)
        {
            if(!in_array($block, $current_blocks)) $availableBlocks[] = $block;
        }

        return view('adminamazing::blocks', compact('blocks', 'availableBlocks'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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
                    $ending = ['блоков', 'добавлены'];
                }
                else 
                {
                    $i = $addedBlocks % 10;
                    switch($i)
                    {
                        case (1): $ending = ['блок', 'добавлен']; break;
                        case (2):
                        case (3):
                        case (4): $ending = ['блока', 'добавлено']; break;
                        default: $ending = ['блоков', 'добавлены'];
                    }
                }

                flash()->success($addedBlocks.' '.$ending[0].' '.$ending[1]);   
            }
        }

        return redirect()->route('AdminBlocks');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteBlock($id)
    {
        $block = $this->block->findOrFail($id);

        $block->delete();

        flash()->success('Блок удален');

        return redirect()->route('AdminBlocks');
    }    
}