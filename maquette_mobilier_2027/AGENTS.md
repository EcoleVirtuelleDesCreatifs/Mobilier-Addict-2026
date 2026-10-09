# Repères du projet

- Maquette PHP de Mobilier Addict, en français, destinée à la Côte d’Ivoire.
- Les pages sont à la racine ; l’en-tête partagé est inclus depuis `includes/header.php`. Les liens des footers sont centralisés dans `includes/footer-links.php` (groupes `about`, `shopping`, `help`, `legal`) ; leurs enveloppes restent dans les pages existantes.
- Les nouvelles pages d’information utilisent `includes/editorial-layout.php` et leurs contenus sont dans `includes/editorial-data.php`. Les routes PHP fixent une clé de contenu, sans inclusion de fichier issue d’un paramètre utilisateur.
- Le fil d’Ariane bleu nuit est défini par `.breadcrumb` dans `assets/css/style.css` pour toutes les pages. Les interactions accessibles des footers existants sont dans `assets/js/main.js`.
- Conserver les conventions et les ressources CSS/JS existantes dans `assets/`. Limiter les styles spécifiques à une page à une classe dédiée.
- Ne pas inventer de tarifs, délais, garanties ni moyens de paiement acceptés : faire confirmer les conditions commerciales non documentées.
- Coordonnées confirmées par l’utilisateur pour la page Contact : Abidjan, Côte d’Ivoire ; +225 07 99 14 03 56 (`tel:+2250799140356`) ; contact@mobilier-addict.com (`mailto:contact@mobilier-addict.com`). Source fournie : https://mobilier-addict.com/contact.

# Vérifications

- Syntaxe d’une page modifiée : `php -l faq.php` (adapter le nom du fichier).
- Le serveur local utilisé dans cette session répond sur `http://localhost:8000` ; vérifier qu’il est actif avant un test HTTP.
- Vérifier le HTML réellement servi, les ancres et l’unicité des identifiants.
- Pour la FAQ : tester la recherche sans accents, les résultats vides, la réinitialisation, les rubriques et les accordéons au clavier ; vérifier les largeurs 320, 390, 768 et 1440 px ainsi que l’accès aux réponses sans JavaScript.
- Pour les footers : vérifier les destinations de chaque groupe sur toutes les routes, l’ouverture au clavier sur mobile, le retour à l’affichage desktop et les liens visibles sans JavaScript. Conserver l’absence du groupe Achats sur `about-us.php`, demandée explicitement.
- Vérification globale de syntaxe : `node --check assets/js/main.js` puis `for file in *.php includes/*.php; do php -l "$file" || exit 1; done`.
