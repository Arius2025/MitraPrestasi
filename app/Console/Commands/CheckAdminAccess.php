<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class CheckAdminAccess extends Command
{
    protected $signature = 'admin:check-access {email}';
    protected $description = 'Cek apakah user dengan email tertentu adalah admin dan bisa akses dashboard';

    public function handle()
    {
        $email = $this->argument('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("❌ User dengan email $email tidak ditemukan.");
            return 1;
        }

        $this->info("👤 Nama: {$user->name}");
        $this->info("📧 Email: {$user->email}");
        $this->info("🔐 Role: {$user->role}");

        if ($user->role === 'admin') {
            $this->info("✅ User ini adalah ADMIN dan bisa akses panel.");
        } else {
            $this->warn("⚠️ User ini BUKAN admin. Role saat ini: {$user->role}");
        }

        return 0;
    }
}
