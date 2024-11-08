<?php

namespace App\Contracts\Services;

use Illuminate\Database\Eloquent\Collection;

interface IHistoryImportService
{
    /**
     * Return all the history imports.
     *
     * @return Collection
     */
    public function index(): Collection;

    /**
     * Store a new import register after run file import
     *
     * @return void
     */
    public function store(string $file, array $errors): void;
}
