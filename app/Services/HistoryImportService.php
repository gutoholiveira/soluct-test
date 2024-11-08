<?php

namespace App\Services;

use App\Contracts\Services\IHistoryImportService;
use App\Models\HistoryImport;
use Illuminate\Database\Eloquent\Collection;

class HistoryImportService implements IHistoryImportService
{
    public function index(): Collection
    {
        return HistoryImport::orderBy('created_at', 'desc')->get();
    }

    public function store(string $file, array $errors): void
    {
        HistoryImport::create([
            HistoryImport::FILE   => $file,
            HistoryImport::ERRORS => json_encode($errors),
        ]);
    }
}
