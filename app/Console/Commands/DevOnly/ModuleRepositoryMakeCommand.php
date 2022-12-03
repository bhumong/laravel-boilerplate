<?php

namespace App\Console\Commands\DevOnly;

use Illuminate\Support\Str;
use Nwidart\Modules\Support\Stub;
use Nwidart\Modules\Commands\GeneratorCommand;
use Nwidart\Modules\Traits\ModuleCommandTrait;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Nwidart\Modules\Support\Config\GenerateConfigReader;

class ModuleRepositoryMakeCommand extends GeneratorCommand
{
    use ModuleCommandTrait;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:make-repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository class for the specified module';

    protected $argumentName = 'name';

    public function getDefaultNamespace(): string
    {
        $module = $this->laravel['modules'];
        return $module->config('paths.generator.repository.namespace') ?: $module->config('paths.generator.repository.path', 'Repositories');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the repository.'],
            ['module', InputArgument::OPTIONAL, 'The name of module will be used.'],
        ];
    }

    /**
     * Get template contents.
     *
     * @return string
     */
    protected function getTemplateContents()
    {
        $module = $this->laravel['modules']->findOrFail($this->getModuleName());

        return (new Stub($this->getStubName(), [
            'NAMESPACE' => $this->getClassNamespace($module),
            'CLASS'     => $this->getClass(),
            'MODEL' => Str::replaceLast('Repository', '', $this->getClass()),
            'MODEL_NAMESPACE' => Str::replaceFirst('Repositories', 'Entities', $this->getClassNamespace($module)),
            'MODEL_VAR' => lcfirst(Str::replaceLast('Repository', '', $this->getClass())),
        ]))->render();
    }

    /**
     * Get the destination file path.
     *
     * @return string
     */
    protected function getDestinationFilePath()
    {
        $path = $this->laravel['modules']->getModulePath($this->getModuleName());

        $repoPath = GenerateConfigReader::read('repository');

        return $path . $repoPath->getPath() . '/' . $this->getFileName() . '.php';
    }

    /**
     * @return string
     */
    private function getFileName()
    {
        return Str::studly($this->argument('name'));
    }

    protected function getOptions()
    {
        return [
            ['resource', 'r', InputOption::VALUE_NONE, 'Create a resource repository'],
        ];
    }

    /**
     * @return string
     */
    protected function getStubName(): string
    {
        return $this->option('resource') ? '/repository-resource.stub' : '/repository.stub';
    }
}
