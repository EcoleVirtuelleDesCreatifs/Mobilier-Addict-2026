# Déploiement — Mobilier Addict

## Prérequis serveur

- PHP >= 8.2 avec extensions : mbstring, openssl, pdo_mysql, gd, xml, curl, zip, intl
- MySQL/MariaDB
- Composer 2
- Apache (mod_rewrite activé) ou Nginx
- Document root → dossier `public/` (sinon le `.htaccess` racine redirige automatiquement)

## 1. Upload des fichiers

Uploader tout le contenu du dossier `boutique_01/` sur le serveur, **sauf** :

```
.env
node_modules/
storage.zip
mobilier_addict.sql
tests/
```

(`vendor/` peut être installé sur le serveur via composer, voir étape 3.)

## 2. Configuration .env

```bash
cp .env.production .env
# Éditer .env : DB_USERNAME, DB_PASSWORD, MAIL_*, APP_URL
php artisan key:generate
```

Valeurs importantes déjà réglées dans `.env.production` :
- `APP_ENV=production` et `APP_DEBUG=false` (obligatoire en ligne)
- `APP_URL=https://www.mobilier-addict.com` (adapter au domaine réel)
- `MAIL_MAILER=smtp` → renseigner les identifiants SMTP de l'hébergeur
- `QUEUE_CONNECTION=sync` → les mails partent immédiatement. Si un worker est possible, passer à `database` + `php artisan queue:work` (cron/supervisor).

## 3. Dépendances et assets

```bash
composer install --no-dev --optimize-autoloader
```

Les assets sont déjà compilés (`public/build/`). Pour les regénérer :
```bash
npm install && npm run build
```

## 4. Base de données

```bash
php artisan migrate --force
```

Importer ensuite les données (produits, menus, slides…) depuis l'export `mobilier_addict.sql` ou recréer le contenu via l'admin.

## 5. Permissions et liens

```bash
chmod -R 775 storage bootstrap/cache
php artisan storage:link
```

## 6. Optimisation

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

Pour recharger après une modif de config :
```bash
php artisan optimize:clear
php artisan optimize
```

## 7. Vérifications post-déploiement

- [ ] `https://domaine/` s'affiche (HTTPS forcé automatiquement)
- [ ] `https://domaine/devis-sur-mesure` → test d'envoi (mail client + mail admin)
- [ ] `https://domaine/ma/admin/login` → accès admin
- [ ] Facture PDF → `/ma/admin/invoices/{id}` avec logo
- [ ] Images produits (`storage:link` fait)
- [ ] Sitemap : `/sitemap.xml`
- [ ] Robots : `/robots.txt`

## Cron (optionnel)

```cron
* * * * * cd /chemin/projet && php artisan schedule:run >> /dev/null 2>&1
```

Et si `QUEUE_CONNECTION=database` :
```cron
* * * * * cd /chemin/projet && php artisan queue:work --stop-when-empty >> /dev/null 2>&1
```

## Checklist sécurité

- [x] `APP_DEBUG=false`
- [x] `.env` hors git (dans `.gitignore`)
- [x] HTTPS forcé (`.htaccess` + `URL::forceScheme`)
- [x] `APP_KEY` régénéré par environnement
- [ ] Sauvegarde BDD régulière configurée côté hébergeur
