<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create {--name=} {--email=} {--password=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Créer un nouveau compte administrateur';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Création d\'un nouveau compte administrateur');
        $this->newLine();

        // Récupérer les données via les options ou demander à l'utilisateur
        $name = $this->option('name') ?: $this->ask('Nom complet de l\'administrateur');
        $email = $this->option('email') ?: $this->ask('Email de l\'administrateur');
        $password = $this->option('password') ?: $this->secret('Mot de passe (minimum 8 caractères)');

        // Validation des données
        $validator = Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ], [
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            $this->error('❌ Erreurs de validation :');
            foreach ($validator->errors()->all() as $error) {
                $this->error("  - $error");
            }
            return 1;
        }

        // Créer l'utilisateur
        try {
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'email_verified_at' => now(),
            ]);

            $this->newLine();
            $this->info('✅ Compte administrateur créé avec succès !');
            $this->newLine();
            $this->table(
                ['Champ', 'Valeur'],
                [
                    ['ID', $user->id],
                    ['Nom', $user->name],
                    ['Email', $user->email],
                    ['Créé le', $user->created_at->format('d/m/Y H:i:s')],
                ]
            );
            $this->newLine();
            $this->warn('⚠️  IMPORTANT: Notez bien ces informations de connexion !');
            $this->info('🔗 Vous pouvez maintenant vous connecter à : http://localhost:8000/login');

        } catch (\Exception $e) {
            $this->error('❌ Erreur lors de la création du compte :');
            $this->error($e->getMessage());
            return 1;
        }

        return 0;
    }
}
