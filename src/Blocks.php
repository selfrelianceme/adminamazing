<?php

namespace Selfreliance\adminamazing;

use Closure;
use Illuminate\Container\Container;
use Illuminate\Support\Str;
use Illuminate\View\Compilers\BladeCompiler;

class Blocks
{
	protected $blade;
	protected $container;

	protected $blocks = [];

	public function __construct(BladeCompiler $blade, Container $container)
	{
		$this->blade = $blade;
		$this->container = $container;
	}

    public function all()
    {
        return $this->blocks;
    }

	public function register($name, $callback)
	{
        $this->blocks[$name] = $callback;

        $this->registerBlade($name);
	}

    public function has($name)
    {
    	return array_search($name, $this->blocks);
    }

    public function get($name, array $parameters = [])
    {
    	if(!is_null($name))
    	{
    		$callback = $this->blocks[$name];

    		return $this->getCallback($callback, $parameters);
    	}
    }

    protected function registerBlade($name)
    {
        $name = $this->has($name);
        if(!is_null($name))
        {
            $this->blade->extend(function ($view, $compiler) use ($name) {
                $pattern = $this->createMatcher($name);
                $replace = '$1<?php echo Block::'.$name.'$2; ?>';
                return preg_replace($pattern, $replace, $view);
            });
        }
        else
        {
            unset($this->blocks[$name]);
            return false;
        }
    }

    protected function createMatcher($function)
    {
        return '/(?<!\w)(\s*)@'.$function.'(\s*\(.*\))/';
    }

    protected function getCallback($callback, array $parameters)
    {
    	if($callback instanceof Closure)
    	{
    		return $this->createCallableCallback($callback, $parameters);
    	}
    	else if(is_string($callback))
    	{
    		return $this->createStringCallback($callback, $parameters);
    	}
    	else
    	{
    		return ;
    	}
    }

    protected function createStringCallback($callback, array $parameters)
    {
    	if(function_exists($callback))
    	{
    		return $this->createCallableCallback($callback, $parameters);
    	}
    	else
    	{
    		return $this->createClassesCallback($callback, $parameters);
    	}
    }

    protected function createCallableCallback($callback, array $parameters)
    {
        return call_user_func_array($callback, $parameters);
    }

    protected function createClassesCallback($callback, array $parameters)
    {
        list($className, $method) = Str::parseCallback($callback, 'register');
        $instance = $this->container->make($className);
        $callable = array($instance, $method);
        return $this->createCallableCallback($callable, $parameters);
    }
}