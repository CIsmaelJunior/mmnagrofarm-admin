<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class ListAdminUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lister tous les comptes administrateurs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('👥 Liste des comptes administrateurs');
        $this->newLine();

        $users = User::all();

        if ($users->isEmpty()) {
            $this->warn('Aucun compte administrateur trouvé.');
            $this->info('Utilisez la commande : php artisan admin:create');
            return 0;
        }

        $tableData = $users->map(function ($user) {
            return [
                'ID' => $user->id,
                'Nom' => $user->name,
                'Email' => $user->email,
                'Initiales' => $user->initials,
                'Créé le' => $user->created_at->format('d/m/Y'),
                'Dernière connexion' => $user->updated_at->format('d/m/Y H:i'),
            ];
        })->toArray();

        $this->table(
            ['ID', 'Nom', 'Email', 'Initiales', 'Créé le', 'Dernière connexion'],
            $tableData
        );

        $this->newLine();
        $this->info("Total : {$users->count()} compte(s) administrateur(s)");

        return 0;
    }
}
