@extends('dashboard.layouts.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Paramètres de Notification</h6>
                        <p class="text-sm mb-0">
                            <i class="fa fa-bell text-info" aria-hidden="true"></i>
                            <span class="font-weight-bold ms-1">Gérer vos notifications</span>
                        </p>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <a href="{{ route('settings.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>Retour
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mx-3 mt-3" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('settings.notifications.update') }}" method="POST" class="mx-3">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Notifications par email -->
                        <div class="col-lg-6 mb-4">
                            <div class="card h-100">
                                <div class="card-header pb-0">
                                    <h6 class="mb-0">
                                        <i class="fas fa-envelope me-2"></i>Notifications Email
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="email_notifications" name="email_notifications" checked>
                                        <label class="form-check-label text-sm font-weight-bold" for="email_notifications">
                                            Activer les notifications par email
                                        </label>
                                    </div>

                                    <div class="ms-4">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" id="order_notifications" name="order_notifications" checked>
                                            <label class="form-check-label text-sm" for="order_notifications">
                                                Nouvelles commandes
                                            </label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" id="product_notifications" name="product_notifications" checked>
                                            <label class="form-check-label text-sm" for="product_notifications">
                                                Modifications de produits
                                            </label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" id="client_notifications" name="client_notifications" checked>
                                            <label class="form-check-label text-sm" for="client_notifications">
                                                Nouveaux clients
                                            </label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" id="system_notifications" name="system_notifications">
                                            <label class="form-check-label text-sm" for="system_notifications">
                                                Notifications système
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Notifications par SMS -->
                        <div class="col-lg-6 mb-4">
                            <div class="card h-100">
                                <div class="card-header pb-0">
                                    <h6 class="mb-0">
                                        <i class="fas fa-sms me-2"></i>Notifications SMS
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="sms_notifications" name="sms_notifications">
                                        <label class="form-check-label text-sm font-weight-bold" for="sms_notifications">
                                            Activer les notifications par SMS
                                        </label>
                                    </div>

                                    <div class="ms-4">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" id="sms_urgent_orders" name="sms_urgent_orders">
                                            <label class="form-check-label text-sm" for="sms_urgent_orders">
                                                Commandes urgentes
                                            </label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" id="sms_system_alerts" name="sms_system_alerts">
                                            <label class="form-check-label text-sm" for="sms_system_alerts">
                                                Alertes système critiques
                                            </label>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <label for="sms_phone" class="form-label text-sm font-weight-bold">Numéro de téléphone SMS</label>
                                        <input type="text" class="form-control" id="sms_phone" name="sms_phone"
                                               value="{{ old('sms_phone', '+223 70 00 00 00') }}" placeholder="+223 70 00 00 00">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Préférences de fréquence -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <h6 class="mb-0">
                                        <i class="fas fa-clock me-2"></i>Fréquence des Notifications
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4 mb-3">
                                            <label for="email_frequency" class="form-label text-sm font-weight-bold">Fréquence des emails</label>
                                            <select class="form-select" id="email_frequency" name="email_frequency">
                                                <option value="immediate">Immédiat</option>
                                                <option value="hourly">Toutes les heures</option>
                                                <option value="daily" selected>Quotidien</option>
                                                <option value="weekly">Hebdomadaire</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label for="notification_time" class="form-label text-sm font-weight-bold">Heure de notification</label>
                                            <input type="time" class="form-control" id="notification_time" name="notification_time"
                                                   value="{{ old('notification_time', '09:00') }}">
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label for="timezone" class="form-label text-sm font-weight-bold">Fuseau horaire</label>
                                            <select class="form-select" id="timezone" name="timezone">
                                                <option value="Africa/Bamako" selected>Bamako (GMT+0)</option>
                                                <option value="UTC">UTC (GMT+0)</option>
                                                <option value="Europe/Paris">Paris (GMT+1)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Test de notification -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <h6 class="mb-0">
                                        <i class="fas fa-paper-plane me-2"></i>Test de Notification
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <p class="text-sm text-secondary mb-3">
                                        Testez vos paramètres de notification en envoyant un message de test.
                                    </p>
                                    <div class="row">
                                        <div class="col-lg-6 mb-3">
                                            <button type="button" class="btn btn-outline-primary btn-sm" id="test-email">
                                                <i class="fas fa-envelope me-1"></i>Test Email
                                            </button>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <button type="button" class="btn btn-outline-info btn-sm" id="test-sms">
                                                <i class="fas fa-sms me-1"></i>Test SMS
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('settings.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times me-1"></i>Annuler
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i>Mettre à jour
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Test de notification email
    document.getElementById('test-email').addEventListener('click', function() {
        // Ici vous pouvez ajouter la logique pour envoyer un email de test
        alert('Email de test envoyé !');
    });

    // Test de notification SMS
    document.getElementById('test-sms').addEventListener('click', function() {
        // Ici vous pouvez ajouter la logique pour envoyer un SMS de test
        alert('SMS de test envoyé !');
    });

    // Désactiver les sous-options si l'option principale est désactivée
    const emailNotifications = document.getElementById('email_notifications');
    const smsNotifications = document.getElementById('sms_notifications');

    function toggleEmailOptions() {
        const emailOptions = ['order_notifications', 'product_notifications', 'client_notifications', 'system_notifications'];
        emailOptions.forEach(option => {
            document.getElementById(option).disabled = !emailNotifications.checked;
        });
    }

    function toggleSmsOptions() {
        const smsOptions = ['sms_urgent_orders', 'sms_system_alerts'];
        smsOptions.forEach(option => {
            document.getElementById(option).disabled = !smsNotifications.checked;
        });
    }

    emailNotifications.addEventListener('change', toggleEmailOptions);
    smsNotifications.addEventListener('change', toggleSmsOptions);

    // Initialiser l'état
    toggleEmailOptions();
    toggleSmsOptions();
});
</script>
@endsection

