<?php

namespace Larsmbergvall\UtilitiesForLaravel\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\Config;

class MakeActionCommand extends GeneratorCommand
{
    protected $name = 'make:action';
    protected $description = 'Create a new Action class';
    protected $type = 'Action';

    protected function getStub(): string
    {
        // Prefer published stub if available
        $customStub = $this->laravel->basePath('stubs/action.stub');

        return file_exists($customStub)
            ? $customStub
            : __DIR__ . '/../stubs/action.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Actions';
    }

    protected function getNameInput(): string
    {
        /** @var string $name */
        $name = $this->argument('name');
        $suffix = $this->getSuffix();

        if (! str_ends_with($name, $suffix)) {
            $name .= $suffix;
        }

        return $name;
    }

    protected function buildClass($name): string
    {
        $stub = parent::buildClass($name);
        $suffix = $this->getSuffix();

        if (strlen($suffix) == 0) {
            return str_replace('{{ actionSuffix }}', '', $stub);
        }

        if (!str_ends_with($name, $suffix)) {
            return str_replace('{{ actionSuffix }}', $suffix, $stub);
        }

        return str_replace('{{ actionSuffix }}', '', $stub);
    }

    private function getSuffix(): string
    {
        /** @var Config $config */
        $config = $this->laravel->make('config');
        /** @var string $suffix */
        $suffix = $config->get('utilities-for-laravel.action_class_suffix', '');

        return $suffix;
    }
}