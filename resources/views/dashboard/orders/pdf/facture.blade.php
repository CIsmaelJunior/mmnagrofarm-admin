<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture - {{ $commande->numero_commande }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            background: #fff;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        /* En-tête */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #28a745;
        }

        .company-info {
            flex: 1;
        }

        .logo {
            width: 120px;
            height: auto;
            margin-bottom: 10px;
        }

        .company-name {
            font-size: 24px;
            font-weight: bold;
            color: #28a745;
            margin-bottom: 5px;
        }

        .company-tagline {
            font-size: 11px;
            color: #666;
            margin-bottom: 15px;
            line-height: 1.3;
        }

        .company-details {
            font-size: 10px;
            color: #555;
            line-height: 1.4;
        }

        .invoice-info {
            text-align: right;
            flex: 1;
        }

        .invoice-title {
            font-size: 28px;
            font-weight: bold;
            color: #28a745;
            margin-bottom: 10px;
        }

        .invoice-number {
            font-size: 14px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .invoice-date {
            font-size: 11px;
            color: #666;
        }

        /* Informations client et entreprise */
        .info-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .client-info, .company-contact {
            flex: 1;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            margin: 0 10px;
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            color: #28a745;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-item {
            margin-bottom: 5px;
            font-size: 11px;
        }

        .info-label {
            font-weight: bold;
            color: #555;
        }

        /* Tableau des produits */
        .products-section {
            margin-bottom: 30px;
        }

        .products-title {
            font-size: 16px;
            font-weight: bold;
            color: #28a745;
            margin-bottom: 15px;
            text-transform: uppercase;
        }

        .products-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .products-table th {
            background: #28a745;
            color: white;
            padding: 12px 8px;
            text-align: left;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .products-table td {
            padding: 10px 8px;
            border-bottom: 1px solid #ddd;
            font-size: 11px;
            vertical-align: top;
        }

        .products-table tr:nth-child(even) {
            background: #f8f9fa;
        }

        .product-name {
            font-weight: bold;
            color: #333;
        }

        .product-details {
            font-size: 10px;
            color: #666;
            margin-top: 2px;
        }

        .quantity {
            text-align: center;
            font-weight: bold;
        }

        .price {
            text-align: right;
            font-weight: bold;
        }

        .total {
            text-align: right;
            font-weight: bold;
            color: #28a745;
        }

        /* Section totaux */
        .totals-section {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 30px;
        }

        .totals-table {
            width: 300px;
            border-collapse: collapse;
        }

        .totals-table td {
            padding: 8px 12px;
            border-bottom: 1px solid #ddd;
            font-size: 11px;
        }

        .totals-table .label {
            text-align: left;
            font-weight: bold;
        }

        .totals-table .amount {
            text-align: right;
            font-weight: bold;
        }

        .totals-table .final-total {
            background: #28a745;
            color: white;
            font-size: 14px;
            font-weight: bold;
        }

        .totals-table .final-total .label {
            color: white;
        }

        .totals-table .final-total .amount {
            color: white;
        }

        /* Notes et conditions */
        .notes-section {
            margin-bottom: 30px;
        }

        .notes-title {
            font-size: 14px;
            font-weight: bold;
            color: #28a745;
            margin-bottom: 10px;
        }

        .notes-content {
            font-size: 10px;
            color: #666;
            line-height: 1.4;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #28a745;
        }

        /* Pied de page */
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #28a745;
            text-align: center;
        }

        .footer-text {
            font-size: 10px;
            color: #666;
            line-height: 1.4;
        }

        .footer-contact {
            margin-top: 10px;
            font-size: 10px;
            color: #28a745;
            font-weight: bold;
        }

        /* Responsive */
        @media print {
            .container {
                padding: 0;
            }
        }

        /* Styles pour les statuts */
        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-en_attente {
            background: #fff3cd;
            color: #856404;
        }

        .status-en_cours {
            background: #d1ecf1;
            color: #0c5460;
        }

        .status-livree {
            background: #d4edda;
            color: #155724;
        }

        .status-annulee {
            background: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- En-tête -->
        <div class="header">
            <div class="company-info">
                <img src="{{ public_path('adm/img/logos/logo.png') }}" alt="MMB AgroFarm" class="logo">
                <div class="company-name">MMB AgroFarm</div>
                <div class="company-tagline">
                    Exploitation agricole bio spécialisée dans la culture de fruits et légumes en Côte d'Ivoire.
                    Nous cultivons avec passion et respect de la nature sur nos terres pour vous offrir des produits bio frais et de qualité.
                </div>
                <div class="company-details">
                    II Plateaux Cocody<br>
                    Abidjan, Côte d'Ivoire<br>
                    +225 07 20 20 05 06 | +225 27 31 96 15 75<br>
                    contact@mmbagrofarm.com
                </div>
            </div>
            <div class="invoice-info">
                <div class="invoice-title">
                    @if($commande->is_devis)
                        DEVIS
                    @else
                        FACTURE
                    @endif
                </div>
                <div class="invoice-number">{{ $commande->numero_commande }}</div>
                <div class="invoice-date">
                    Date: {{ $commande->created_at->format('d/m/Y') }}<br>
                    @if($commande->montant_total)
                        Échéance: {{ now()->addDays(30)->format('d/m/Y') }}
                    @endif
                </div>
            </div>
        </div>

        <!-- Informations client et entreprise -->
        <div class="info-section">
            <div class="client-info">
                <div class="section-title">Facturé à</div>
                <div class="info-item">
                    <span class="info-label">Nom:</span> {{ $commande->client->nom }}
                </div>
                <div class="info-item">
                    <span class="info-label">Email:</span> {{ $commande->client->email }}
                </div>
                @if($commande->client->telephone)
                <div class="info-item">
                    <span class="info-label">Téléphone:</span> {{ $commande->client->telephone }}
                </div>
                @endif
                @if($commande->client->entreprise)
                <div class="info-item">
                    <span class="info-label">Entreprise:</span> {{ $commande->client->entreprise }}
                </div>
                @endif
                <div class="info-item">
                    <span class="info-label">Adresse:</span><br>
                    {{ $commande->adresse_livraison }}<br>
                    {{ $commande->ville }} @if($commande->code_postal) ({{ $commande->code_postal }}) @endif
                </div>
            </div>
            <div class="company-contact">
                <div class="section-title">MMB AgroFarm</div>
                <div class="info-item">
                    <span class="info-label">Adresse:</span><br>
                    II Plateaux Cocody<br>
                    Abidjan, Côte d'Ivoire
                </div>
                <div class="info-item">
                    <span class="info-label">Téléphone:</span><br>
                    +225 07 20 20 05 06<br>
                    +225 27 31 96 15 75
                </div>
                <div class="info-item">
                    <span class="info-label">Email:</span> contact@mmbagrofarm.com
                </div>
                <div class="info-item">
                    <span class="info-label">Statut:</span>
                    <span class="status-badge status-{{ $commande->statut }}">
                        {{ $commande->statut_libelle }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Tableau des produits -->
        <div class="products-section">
            <div class="products-title">Détail des produits</div>
            <table class="products-table">
                <thead>
                    <tr>
                        <th style="width: 40%;">Produit</th>
                        <th style="width: 15%;">Conditionnement</th>
                        <th style="width: 15%;">Quantité</th>
                        @if($commande->montant_total)
                        <th style="width: 15%;">Prix unitaire</th>
                        <th style="width: 15%;">Total</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($commande->produits as $produit)
                    <tr>
                        <td>
                            <div class="product-name">{{ $produit['nom'] }}</div>
                            <div class="product-details">{{ $produit['variete'] }}</div>
                        </td>
                        <td>{{ $produit['conditionnement'] }}</td>
                        <td class="quantity">{{ $produit['quantite'] }}</td>
                        @if($commande->montant_total)
                        <td class="price">
                            @if(isset($produit['prix_unitaire']))
                                {{ number_format($produit['prix_unitaire'], 0, ',', ' ') }} FCFA
                            @else
                                -
                            @endif
                        </td>
                        <td class="total">
                            @if(isset($produit['prix_unitaire']))
                                {{ number_format($produit['prix_unitaire'] * $produit['quantite'], 0, ',', ' ') }} FCFA
                            @else
                                -
                            @endif
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($commande->montant_total)
        <!-- Section totaux -->
        <div class="totals-section">
            <table class="totals-table">
                <tr>
                    <td class="label">Sous-total:</td>
                    <td class="amount">{{ number_format($commande->montant_total, 0, ',', ' ') }} FCFA</td>
                </tr>
                @if($commande->reduction && $commande->reduction > 0)
                <tr>
                    <td class="label">Réduction ({{ $commande->reduction }}%):</td>
                    <td class="amount">-{{ number_format(($commande->montant_total * $commande->reduction) / 100, 0, ',', ' ') }} FCFA</td>
                </tr>
                @endif
                <tr class="final-total">
                    <td class="label">TOTAL:</td>
                    <td class="amount">{{ number_format($commande->montant_total, 0, ',', ' ') }} FCFA</td>
                </tr>
            </table>
        </div>
        @endif

        <!-- Notes et conditions -->
        <div class="notes-section">
            <div class="notes-title">Notes et conditions</div>
            <div class="notes-content">
                @if($commande->commentaires)
                <strong>Commentaires du client:</strong><br>
                {{ $commande->commentaires }}<br><br>
                @endif

                @if($commande->notes_admin)
                <strong>Notes administratives:</strong><br>
                {{ $commande->notes_admin }}<br><br>
                @endif

                <strong>Conditions générales:</strong><br>
                • Tous les produits sont cultivés selon les normes biologiques<br>
                • Livraison sous 24-48h après confirmation de commande<br>
                • Paiement à la livraison ou par virement bancaire<br>
                • Garantie de fraîcheur sur tous nos produits<br>
                • Retour possible sous 24h en cas de non-conformité
            </div>
        </div>

        <!-- Pied de page -->
        <div class="footer">
            <div class="footer-text">
                Merci pour votre confiance ! MMB AgroFarm s'engage à vous fournir des produits bio de qualité supérieure.
            </div>
            <div class="footer-contact">
                contact@mmbagrofarm.com | +225 07 20 20 05 06
            </div>
        </div>
    </div>
</body>
</html>
