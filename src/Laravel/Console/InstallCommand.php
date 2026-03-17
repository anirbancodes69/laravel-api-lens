<?php

namespace ApiLens\Laravel\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $signature = 'apilens:install {--force : Force actions without confirmation}';

    protected $description = 'Install ApiLens package';

    public function handle()
    {
        $this->info('🚀 Installing ApiLens...');

        // Step 1: Run migrations
        if ($this->option('force') || $this->confirm('Run database migrations?', true)) {
            $this->call('migrate');
            $this->info('✅ Migrations completed');
        }

        // Step 2: Publish config (optional)
        if ($this->option('force') || $this->confirm('Publish config file?', false)) {
            $this->call('vendor:publish', [
                '--tag' => 'apilens-config'
            ]);
            $this->info('✅ Config published');
        }

        // Final message
        $this->newLine();
        $this->info('🎉 ApiLens installed successfully!');

        $this->newLine();
        $this->info('🔧 Recommended .env settings:');
        $this->line('APILENS_TRANSPORT=database');
        $this->line('APILENS_TOKEN=your-secret');
        $this->line('👉 Visit: /apilens?token=secret');
        $this->line('👉 Configure: config/apilens.php');

        return self::SUCCESS;
    }
}