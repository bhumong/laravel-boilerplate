<?php

namespace App\Console\Commands\DevOnly;

use Mockery\Generator\Method;
use Illuminate\Console\Command;
use Mockery\Generator\MockConfiguration;
use Mockery\Generator\StringManipulation\Pass\MethodDefinitionPass;

class MethodRenderer extends MethodDefinitionPass
{
    public function render($rawMethod)
    {
        $method = new Method($rawMethod);
        if ($method->isPublic()) {
            $methodDef = 'public';
        } elseif ($method->isProtected()) {
            $methodDef = 'protected';
        } else {
            $methodDef = 'private';
        }

        if ($method->isStatic()) {
            $methodDef .= ' static';
        }

        $methodDef .= ' function ';
        $methodDef .= $method->returnsReference() ? ' & ' : '';
        $methodDef .= $method->getName();
        $methodDef .= $this->renderParams($method, new MockConfiguration);
        $methodDef .= $this->renderReturnType($method);
        $methodDef .= ';';

        return $method->getDocComment() . "\n" . $methodDef;
    }
}

class GenerateInterfaceIDEHelper extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ide-helper:interfaces';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate autocompletion for interfaces with the class implementation';

    protected $interfaces = [
        \Mockery\ExpectationInterface::class => \Mockery\Expectation::class
    ];

    protected $filename = '_ide_helper_interfaces.php';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $result = [];
        foreach ($this->interfaces as $interfaceName => $className) {
            $interface = new \ReflectionClass($interfaceName);
            $ns = $interface->getNamespaceName();
            $header = $this->renderInterfaceHeader($className, $interface);
            $methods = $this->renderMethods($this->getClassMethods($className));
            $result[$ns][] = "$header {{$methods}}";
        }

        $output = [];
        foreach ($result as $ns => $interfaceBodies) {
            $output[] = 'namespace ' . $ns;
            $output[] = '{';
            $output[] = implode("\n", $interfaceBodies);
            $output[] = '}';
        }

        $output = $this->changeReturnSelfToInterfaceFullName($output, $interfaceName);
        file_put_contents(base_path($this->filename), "<?php\n" . $output . "\n");
    }

    private function changeReturnSelfToInterfaceFullName($output, $interfaceName)
    {
        return str_replace('@return self', '@return \\' . $interfaceName, implode("\n", $output));
    }

    private function renderMethods($methods)
    {
        $renderer = new MethodRenderer;
        foreach ($methods as $method) {
            $output[] = $renderer->render($method);
        }
        return implode("\n", $output);
    }

    private function renderInterfaceHeader($className, $interface)
    {
        $output[] = '/**';
        $output[] = ' * Render class impl. for autocompletion';
        $output[] = ' * @see \\' . $className;
        $output[] = ' */';
        $output[] = "interface " . $interface->getShortName();
        return implode("\n", $output);
    }

    private function getClassMethods($className)
    {
        $class = new \ReflectionClass($className);
        return array_filter(
            $class->getMethods(\ReflectionMethod::IS_PUBLIC),
            function ($method) {
                // exclude magic methods
                return !preg_match('/^__/', $method->getName());
            }
        );
    }
}
