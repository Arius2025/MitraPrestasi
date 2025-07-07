<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CheckDatabase extends Command
{
    protected $signature = 'db:check';
    protected $description = 'Cek koneksi dan status database aktif';

    public function handle()
    {
        $this->info('Mengecek koneksi database...');

        try {
            $driver = config('database.default');
            $databasePath = config('database.connections.' . $driver . '.database');

            if ($driver === 'sqlite' && ! file_exists($databasePath)) {
                $this->error("❌ File database tidak ditemukan di: $databasePath");
                return 1;
            }

            DB::connection()->getPdo();
            $this->info("✅ Terkoneksi ke [$driver] database.");

            $tables = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();
            $this->info("📋 Jumlah tabel: " . count($tables));

        } catch (\Throwable $e) {
            $this->error("❌ Gagal terhubung ke database:");
            $this->line($e->getMessage());
        }

        return 0;
    }
}
