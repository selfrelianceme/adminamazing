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

    protected function getPackages($dir)
    {
        $descriptions = collect([]);
        $files = \File::allFiles($dir);
        foreach($files as $file)
        {
            if($file->getFileName() == 'description.json')
            {
                $descriptions->push(json_decode(\File::get($file)));
            }
        }
        return $descriptions;
    }

    protected function getConfigBlocks($arr, &$temp)
    {
        foreach($arr as $value) 
        {
            if(is_array($value)) 
            {
                self::getConfigBlocks($value, $temp);
            }
            else 
            {
                $temp[] = $value;
            }
        }
    }

    public function index()
    {
        $blocks = $this->block->orderBy('sort', 'asc')->get();
        $getPackages = self::getPackages(realpath(__DIR__ . '/../..'));

        $configBlocks = [];
        foreach($getPackages as $package)
        {
            if(\Config::has($package->package.'.block'))
            {
                $configBlocks[] = config($package->package.'.block');
            }
        }

        $temp = [];
        self::getConfigBlocks($configBlocks, $temp);
        
        foreach($temp as $v)
        {
            $block = explode(':', $v);
            \Blocks::register($block[0], $block[1]);
        }

        return view('adminamazing::home', compact('blocks'));
    }

    public function blocks()
    {
        $blocks = $this->block->orderBy('sort', 'asc')->get();
        $getPackages = self::getPackages(realpath(__DIR__ . '/../..'));

        $configBlocks = [];
        foreach($getPackages as $package)
        {
            if(\Config::has($package->package.'.block'))
            {
                $configBlocks[] = config($package->package.'.block');
            }
        }

        $temp = [];
        self::getConfigBlocks($configBlocks, $temp);
        
        foreach($temp as $v)
        {
            $block = explode(':', $v);
            \Blocks::register($block[0], $block[1]);
        }

        $allBlocks = array_keys(\Blocks::all());
        $current_blocks = [];

        foreach($blocks as $block)
        {
            $current_blocks[] = $block->view;
        }

        $availableBlocks = array_diff($allBlocks, $current_blocks);

        return view('adminamazing::blocks', compact('blocks', 'availableBlocks'));
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