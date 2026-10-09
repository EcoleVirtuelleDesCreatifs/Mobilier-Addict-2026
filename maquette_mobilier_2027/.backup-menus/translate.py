#!/usr/bin/env python3
"""Pass de traduction française — maquette Mobilier Addict.

Traduit les nœuds texte et certaines valeurs d'attributs dans toutes les
pages .php. Ignore <script>, <style>, <?php ?> et les commentaires HTML.
"""
import glob, re

EXACT = {
    # --- interface générique ---
    "Home": "Accueil", "Menu": "Menu", "Products": "Produits",
    "All products": "Tous les produits", "All": "Tout", "New": "Nouveau",
    "Sale": "Promo", "Login": "Connexion", "Register": "Inscription",
    "Logout": "Déconnexion", "Cart": "Panier", "Wishlist": "Favoris",
    "My Wishlist": "Mes favoris", "My wishlist": "Mes favoris",
    "Compare": "Comparer", "Remove": "Supprimer", "Search": "Rechercher",
    "Close": "Fermer", "Back": "Retour", "Next": "Suivant",
    "Previous": "Précédent", "Reply": "Répondre", "Admin": "Admin",
    "Share:": "Partager :", "Message": "Message", "Email": "E-mail",
    "FAQ": "FAQ", "Contact": "Contact", "Blog": "Blog",
    "Blog Details": "Article du blog", "About": "À propos",
    "About us": "À propos de nous", "Help": "Aide", "Support": "Assistance",
    "Page Not Found": "Page introuvable", "Read More": "Lire la suite",
    "Read more": "Lire la suite", "View more": "Voir plus",
    "View All": "Tout voir",
    "See how our customers styled shoe products in their foot": "Découvrez comment nos clients portent nos chaussures",
    "Let's buy": "Achetez", "Shop By Category": "Acheter par catégorie",
    "Look for your inspiration here": "Trouvez votre inspiration ici",
    "Designing for": "Conçu pour", "Popular": "Populaire",
    "Pre-order": "Précommande", "Type": "Type", "Image": "Image",
    "Review": "Avis", "Comments - 03": "Commentaires - 03",
    "3 Comments": "3 commentaires", "Leave A Reply": "Laisser une réponse",
    "NEXT ARTICLE": "ARTICLE SUIVANT", "PREV ARTICLE": "ARTICLE PRÉCÉDENT",
    "Latest Post": "Dernier article", "Latest blogs": "Derniers articles",
    "Popular Tags": "Étiquettes populaires", "News Letter": "Infolettre",
    "Subscribe to our newsletter": "Abonnez-vous à notre infolettre",
    "Stay up to date with all the news.": "Restez informé de toutes les nouveautés.",
    "We would like to hear from you.": "Nous aimerions avoir de vos nouvelles.",
    "Drop us a line": "Écrivez-nous", "EDIT PROFILE": "MODIFIER LE PROFIL",

    # --- boutons / CTA ---
    "ADD TO CART": "AJOUTER AU PANIER", "Add to cart": "Ajouter au panier",
    "BUY IT NOW": "ACHETER", "QUICKVIEW": "APERÇU", "SHOP NOW": "ACHETER",
    "SHOP COLLECTION": "VOIR LA COLLECTION", "SHOP TOOLS": "VOIR LES OUTILS",
    "VIEW ALL": "TOUT VOIR", "VIEW MORE": "VOIR PLUS", "SEE MORE": "VOIR PLUS",
    "DISCOVER NOW": "DÉCOUVRIR", "SIGN UP": "S'INSCRIRE",
    "SIGN IN": "SE CONNECTER", "CREATE": "CRÉER",
    "CREATE AN ACCOUNT": "CRÉER UN COMPTE",
    "SUBSCRIBE & SAVE": "ABONNEZ-VOUS ET ÉCONOMISEZ",
    "SUBSCRIBE": "S'ABONNER", "SUBMIT": "ENVOYER",
    "SEND MESSAGE": "ENVOYER LE MESSAGE",
    "BACK TO HOMEPAGE": "RETOUR À L'ACCUEIL",
    "BACK TO CART": "RETOUR AU PANIER", "CONTACT US": "CONTACTEZ-NOUS",
    "Contact US": "Contactez-nous",
    "PROCEED TO SHIPPING": "PASSER À LA LIVRAISON",
    "Procced to checkout": "Passer au paiement", "Check out": "Paiement",
    "Checkout": "Paiement", "Apply Promo Code": "Appliquer le code promo",
    "Be a member": "Devenez membre",
    "Save my information in this browser for the next time.": "Enregistrer mes informations dans ce navigateur pour la prochaine fois.",
    "Forgot your password?": "Mot de passe oublié ?",

    # --- barre d'annonce / en-tête ---
    "Call: +1 078 2376": "Appelez : +225 07 99 14 03 56",
    "New year sale - 30% off": "Soldes du nouvel an : -30 %",

    # --- pied de page ---
    "Press center": "Centre de presse", "Our magazine": "Notre magazine",
    "Our group": "Notre groupe", "Work with us": "Travailler avec nous",
    "Shopping": "Achats", "Brand catalog": "Catalogue des marques",
    "Discount codes": "Codes promo", "Furniture": "Mobilier",
    "Sofa": "Canapé", "Chair": "Fauteuil", "Accessories": "Accessoires",
    "Terms & Conditions": "Conditions générales",
    "Privacy policy": "Politique de confidentialité",
    "Your Cart (04)": "Votre panier (04)", "Subtotal": "Sous-total",
    "Subtotals:": "Sous-total :", "Shipping:": "Livraison :",
    "Discount:": "Remise :", "Total:": "Total :",
    "Taxes and shipping will be calculated at checkout.": "Les taxes et la livraison seront calculées lors du paiement.",
    "View Cart": "Voir le panier",
    "You have no items in your cart": "Votre panier est vide",

    # --- collection / filtres ---
    "Sort by:": "Trier par :", "Featured": "En vedette",
    "Best Selling": "Meilleures ventes",
    "Alphabetically, A-Z": "Alphabétique, A-Z",
    "Alphabetically, Z-A": "Alphabétique, Z-A",
    "Price, low to high": "Prix croissant",
    "Price, high to low": "Prix décroissant",
    "Date, old to new": "Date, ancien au récent",
    "Date, new to old": "Date, récent à ancien",
    "Categories": "Catégories", "Availability": "Disponibilité",
    "In Stock": "En stock", "Out of Stock": "Rupture de stock",
    "Price": "Prix", "Colors": "Couleurs", "Color": "Couleur",
    "Color:": "Couleur :", "Size": "Taille", "Size:": "Taille :",
    "Brand": "Marque", "Vendor": "Vendeur", "Vendor:": "Vendeur :",
    "Product Type": "Type de produit", "Filter By": "Filtrer par",
    "Filter and Sorting": "Filtres et tri", "To": "à",
    "(237 items)": "(237 articles)",
    "Related products": "Produits associés",
    "You may also like": "Vous aimerez aussi",
    "Popular Products": "Produits populaires",
    "Featured Products": "Produits en vedette",
    "Featured Categories": "Catégories en vedette",
    "New Arrivals": "Nouveautés", "Top Branded": "Grandes marques",
    "Best Bags 2022": "Meilleurs sacs 2022",
    "Products of The Week": "Produits de la semaine",
    "Special Offer": "Offre spéciale",
    "Over 56% Discount for New Customers": "Plus de 56 % de remise pour les nouveaux clients",
    "Quality Product": "Produit de qualité",
    "Womens Bag": "Sac pour femme", "Bottles": "Bouteilles",
    "Men's Shoe": "Chaussures homme", "Toddler Dress": "Robe bébé",
    "Bodysuit": "Body", "Hoodie": "Sweat à capuche", "Jacket": "Veste",
    "Legging": "Legging", "Short": "Short", "Top": "Haut",
    "Underwear": "Sous-vêtements", "Custom": "Sur mesure",
    "Branded": "De marque", "White RGB Keyboard": "Clavier RGB blanc",
    "XS / Dove Gray": "XS / Gris colombe", "XS / Pink": "XS / Rose",
    "black": "noir", "purple": "violet", "blue": "bleu",
    "orange": "orange", "teal": "bleu-vert", "cyan": "cyan",
    "pink": "rose", "red": "rouge", "green": "vert", "gray": "gris",
    "white": "blanc",

    # --- page produit ---
    "SKU:": "Réf. :", "leather": "cuir", "Description": "Description",
    "Reviews": "Avis", "Customer Reviews": "Avis des clients",
    "No reviews yet.": "Aucun avis pour le moment.",
    "Write a review": "Rédiger un avis", "Full Name": "Nom complet",
    "Rating": "Note", "Review Title": "Titre de l'avis",
    "Body of Review (2000)": "Votre avis (2000)",
    "Compatibility": "Compatibilité",
    "Guaranteed safe checkout:": "Paiement sécurisé garanti :",
    "To test the product-": "Pour tester le produit —",
    "Apply a small amount of product on your skin in a discreet area, such as the inside of your wrist or your inner arm.": "Appliquez une petite quantité de produit sur une zone discrète, comme l'intérieur du poignet ou du bras.",
    "Wait 48 hours to see if there’s a reaction.": "Attendez 48 heures pour voir si une réaction apparaît.",
    "Check the area at 96 hours after application to see if you have a delayed reaction.": "Vérifiez la zone 96 heures après l'application pour détecter une éventuelle réaction retardée.",
    "A Perfect product for you": "Un produit parfait pour vous",
    "Choose the right fabric": "Choisissez le bon tissu",
    "Modern furniture in velvet": "Mobilier moderne en velours",
    "Ultimate luxury furniture": "Le mobilier de luxe ultime",
    "Update your living room": "Rafraîchissez votre salon",
    "Small bedroom look bigger": "Une petite chambre paraît plus grande",
    "Velvet": "Velours", "Carpt": "Tapis",

    # --- panier / paiement ---
    "Your Details": "Vos informations",
    "Order summary": "Récapitulatif de commande",
    "Cart Totals": "Total du panier", "Product": "Produit",
    "Quantity": "Quantité",
    "Shipping & taxes calculated at checkout": "Livraison et taxes calculées au paiement",
    "Promo code": "Code promo",
    "Same as shipping address": "Identique à l'adresse de livraison",
    "Billing address": "Adresse de facturation",
    "Shipping address": "Adresse de livraison",
    "Payment": "Paiement", "Shipping": "Livraison",
    "First name": "Prénom", "Last name": "Nom", "Company": "Société",
    "Country": "Pays", "City": "Ville", "Zip code": "Code postal",
    "Address 1": "Adresse 1", "Address 2": "Adresse 2",
    "Phone number": "Numéro de téléphone",
    "Phone Number": "Numéro de téléphone",
    "Email address": "Adresse e-mail", "Password": "Mot de passe",
    "All fields marked with an asterisk (*) are required": "Tous les champs marqués d'un astérisque (*) sont obligatoires",
    "Australia": "Australie", "Canada": "Canada", "Mexico": "Mexique",
    "USA": "États-Unis", "Quebec": "Québec", "Calgary": "Calgary",
    "Toronto": "Toronto", "Windsor": "Windsor", "Agency": "Agence",
    "Delivering What Consumers Really Value?": "Offrir ce que les consommateurs apprécient vraiment ?",
    "2715 Ash Dr. San Jose, South Dakota 83475": "Abidjan, Côte d'Ivoire",
    "2752 avenue Royale, Quebec, G1R 2B2, Canada": "2752 avenue Royale, Québec, G1R 2B2, Canada",

    # --- contact ---
    "Mail Address": "Adresse e-mail",
    "Office Location": "Adresse du bureau",
    "Help Is Here — From Design to Delivery": "Une aide à chaque étape — du design à la livraison",
    "Have questions or need expert advice? Our furniture specialists are just a message away! Contact us today for personalized guidance, product information, or support with your order. We're here to make your furniture shopping experience smooth, easy, and enjoyable.": "Une question ou besoin d'un conseil d'expert ? Nos spécialistes mobilier sont à un message ! Contactez-nous pour un accompagnement personnalisé, des informations produit ou de l'aide sur votre commande. Nous rendons votre expérience d'achat simple et agréable.",

    # --- marketing / accueil ---
    "Friday sale": "Soldes du vendredi",
    "Make Your Home Smarter": "Rendez votre maison plus intelligente",
    "Minimalism in your room.": "Le minimalisme dans votre intérieur.",
    "Pure is the most furniture.": "L'épure, l'essence du mobilier.",
    "Build up your kitchen.": "Aménagez votre cuisine.",
    "Discover The Best Furniture": "Découvrez le meilleur du mobilier",
    "New Chair": "Nouveau fauteuil",
    "Get Instant Cashback": "Cashback immédiat",
    "Innovative tools": "Outils innovants",
    "Polish fashion, eco products and the national art seence.": "Mode polonaise, produits écologiques et artisanat national.",
    "Why you should keep plants in your ome here is why!": "Pourquoi avoir des plantes chez soi : voici pourquoi !",
    "The fairycore trend is a 2022 fashion hit as fairies.": "La tendance fairycore est le succès mode de 2022.",
    "TOP 10 most fahionable ladies bag on super sale!": "TOP 10 des sacs pour femme les plus tendance en super promo !",
    "Home Decor": "Décoration intérieure",
    "Storage Furniture": "Mobilier de rangement",
    "Decor": "Décoration", "Kitchen": "Cuisine",
    "Style with": "À associer avec",
    "What customer say": "Ce que disent nos clients",
    "Created Furniture": "Mobilier sur mesure",
    "New Graphics": "Nouveaux visuels",
    "Free Shipping & Return": "Livraison et retour gratuits",
    "Customer Support 24/7": "Assistance client 24/7",
    "100% Secure Payment": "Paiement 100 % sécurisé",
    "We ensure secure payment!": "Nous garantissons un paiement sécurisé !",
    "Instant access to support": "Accès immédiat à l'assistance",
    "On all order over $99.00": "Sur toute commande de plus de 99,00 $",
    "All on order over $99": "Sur toute commande de plus de 99 $",
    "Save upto 56% instantly": "Jusqu'à 56 % d'économies immédiates",
    "+ Free shipping": "+ Livraison gratuite",
    "+ Free gift": "+ Cadeau offert",
    "+ Buy 1 get 1": "+ 1 acheté = 1 offert",
    "Free shipping, and no hassle returns. NIK Running shoes for men & women": "Livraison gratuite et retours sans tracas. Chaussures de running NIK pour homme et femme",
    "Climb up to the mountain with NIK": "Partez à l'assaut des montagnes avec NIK",
    "Shoe products": "Chaussures",
    "Sign up & be the first to hear about exclusive offers, new arrivals & more.": "Inscrivez-vous pour être informé en avant-première des offres exclusives et des nouveautés.",
    "You can change your email preference any time by clicking \"unsubscribe\" in your email.": "Vous pouvez modifier vos préférences e-mail à tout moment via le lien « se désabonner » présent dans nos e-mails.",
    "“ I am purchasing furniture from Bisum since the last 6 years. I love their prompt service and so far I have faced no complaints with their furniture.”": "« J'achète mes meubles chez Mobilier Addict depuis 6 ans. J'adore leur service réactif et je n'ai jamais eu de problème avec leurs meubles. »",
    "Executive, Hypebeast": "Dirigeant, Hypebeast",
    "The services provided by the officials was smooth and satisfactory. Products and goods delivered were up to satisfaction.": "Les services fournis ont été fluides et satisfaisants. Les produits livrés étaient à la hauteur de nos attentes.",
    "We Provide Expert Service and aim to have a long term with you": "Nous fournissons un service d'expert et visons une relation durable avec vous",
    "We provide a full range of front end mechanical repairs for all makes and models of cars, no matter the cause. This includes": "Nous proposons une gamme complète de réparations mécaniques pour toutes les marques et tous les modèles de voitures, quelle que soit la panne. Cela inclut",
    "Through True Rich Attended does no end it his mother since real had half every him end it his mother": "Une attention sincère et constante, une exigence réelle à chaque instant",
    "Through True Rich Attended does no end it his mother since real had half every.": "Une attention sincère et constante, une exigence de chaque instant.",
    "Through True Rich Attended does no end it his mother since real.": "Une attention sincère qui ne faiblit jamais.",
    "The second Bag is a corner room with double windows. The Bag has fabulous spa new appliances, and a laundry area. Other features include rich herringbone floors.": "La deuxième pièce est une chambre d'angle avec deux fenêtres. Elle dispose d'équipements spa neufs et d'une buanderie. Parquet à chevrons d'origine.",
    "Ecstatic unsatiable saw his giving Remain expense you position concluded.": "Un enthousiasme insatiable anime chacune de nos réalisations.",
    "Serve our customers and always deliver the customer service": "Servir nos clients et toujours offrir le meilleur service",
    "To be the world’s most eader in automotive business solutions.": "Devenir le leader mondial des solutions pour l'automobile.",
    "We value the service we provide and our loyal returning customers": "Nous valorisons le service que nous offrons et la fidélité de nos clients",
    "Services we provide to our valued customers": "Les services que nous offrons à nos clients",
    "Get in touch with us for your service related query": "Contactez-nous pour toute question sur nos services",
    "These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice hand, organizations have the need for integrating into a whole.": "Ces cas sont parfaitement simples et faciles à distinguer. Pendant une heure libre, quand notre pouvoir de choisir s'exerce, les organisations doivent s'intégrer dans un tout.",
    "A wonderful serenity has taken possssion of my entire souing like these sweet mornng spring with my whole heart I am alone, and feel the charm of exis": "Une sérénité merveilleuse s'est emparée de mon âme tout entière, comme ces doux matins de printemps ; je suis seul et je savoure le charme de l'existence",
    "A wonderful serenity has taken posseson of my entire soung like these sweet mornngs spring enjoy with my whole heart I am alone and feel the charm of": "Une sérénité merveilleuse s'est emparée de mon âme tout entière, comme ces doux matins de printemps ; je suis seul et je savoure le charme de",
    "Words can be like X-rays, if you use them properly—they’ll go through anything. You read and you’re pierced.": "Les mots peuvent être comme des rayons X : bien utilisés, ils traversent tout. On lit et l'on est transpercé.",
    "It is a long established fact that a reader will be distracted by the readable content of a page looking at its layout.The point of using Lorem Ipsum": "C'est un fait établi : un lecteur est distrait par le contenu lisible d'une page lorsqu'il en examine la mise en page. L'intérêt du Lorem Ipsum",
    "Pick Components, We Will Build": "Choisissez vos composants, nous nous chargeons du montage",
    "Build Your Own Smart Home": "Construisez votre maison connectée",
    "Starting from $56": "À partir de 56 $",
    "Mini Computer": "Mini-ordinateur",
    "Orange Phone": "Téléphone orange",
    "Slim Laptop Pro": "Portable Slim Pro",
    "Slim Notebook Pro": "Portable Slim Pro",
    "Black TV Ultra": "TV Ultra noire",
    "Giant Speakers": "Enceintes géantes",
    "Home Assistance": "Assistance domestique",
    "Home Speakers": "Enceintes pour la maison",
    "Black Speaker": "Enceinte noire",

    # --- à propos / faq ---
    "Is Bisum a safe investment?": "Mobilier Addict est-il un investissement sûr ?",
    "How do I set up a crypto wallet?": "Comment configurer un portefeuille crypto ?",
    "Where and how do I buy Bisum?": "Où et comment acheter chez Mobilier Addict ?",
    "What often will results be reported?": "À quelle fréquence les résultats sont-ils communiqués ?",
    "How can I get support?": "Comment obtenir de l'aide ?",
    "Is Axion available on a major Product exchange?": "Axion est-il disponible sur une grande plateforme d'échange ?",
    "All your questions about Axion answered": "Toutes les réponses à vos questions sur Axion",
    "Frequently Asked Question": "Questions fréquentes",
    "Shipping & Returns": "Livraison et retours",
    "What is lorem ipsum?": "Qu'est-ce que le lorem ipsum ?",
    "Returns within the European Union": "Retours dans l'Union européenne",
    "The European law states that when an order is being returned, it is mandatory for the company to refund the product price and shipping costs charged for the original shipment. Meaning: one shipping fee is paid by us.": "La loi européenne impose le remboursement du prix du produit et des frais d'expédition de la commande d'origine lors d'un retour. Autrement dit : les frais d'expédition sont pris en charge par nos soins.",
    "Standard Shipping: If you placed an order using \"standard shipping\" and you want to return it, you will be refunded the product price and initial shipping costs. However, the return shipping costs will be paid by you.": "Livraison standard : si vous avez passé commande avec la « livraison standard » et souhaitez la retourner, le prix du produit et les frais d'expédition initiaux vous seront remboursés. Les frais de retour restent à votre charge.",
    "Free Shipping: If you placed an order using \"free shipping\" and you want to return it, you will be refunded the product price, but since we paid for the initial shipping, you will pay for the return.": "Livraison gratuite : si vous avez passé commande avec la « livraison gratuite » et souhaitez la retourner, le prix du produit vous sera remboursé ; les frais de retour restent à votre charge.",
    "Please also bear in mind that shipping goods back and forth generates greenhouse gases that are accelerating climate change. We encourage you to choose your items carefully to avoid unnecessary return shipments.": "N'oubliez pas que les allers-retours de marchandises génèrent des gaz à effet de serre qui accélèrent le changement climatique. Choisissez soigneusement vos articles pour éviter les retours inutiles.",
    "You have to pay for return shipping if you want to exchange your product for another size or the package is returned because it has not been picked up at the post office.": "Les frais de retour sont à votre charge pour un échange de taille ou si le colis est renvoyé faute de retrait au bureau de poste.",

    # --- produits démo ---
    "Vita Lounge Chair": "Fauteuil lounge Vita",
    "Sarno Dining Chair": "Chaise de salle à manger Sarno",
    "Eliot Reversible Sectional": "Canapé d'angle réversible Eliot",
    "Eliot Reversible tool": "Outil réversible Eliot",
    "Vita Lounge wardrobe": "Armoire lounge Vita",
    "Tea Table": "Table à thé", "Comfy Sofa": "Canapé confortable",
    "Cusion Chair": "Chaise à coussin",
    "Black Cusion Chair": "Chaise à coussin noire",
    "Soft Lodge Chair": "Fauteuil Soft Lodge",
    "Drawer Low Dresser": "Commode basse à tiroirs",
    "Brown Side Table": "Table d'appoint marron",
    "Accesories Lather bag": "Sac en cuir — accessoires",
    "Accesories Lather Bag": "Sac en cuir — accessoires",
    "best wood furniture": "mobilier en bois massif",
    "bisum tea table": "table à thé",
    "black backpack": "sac à dos noir",
    "lady handbag": "sac à main femme",
    "men travel bag": "sac de voyage homme",
    "women vanity bag": "trousse de toilette femme",
    "women large bag": "grand sac femme",
    "long narrow strip": "longue bande étroite",
    "Bag": "Sac", "bag": "sac", "shoe": "chaussure",
    "creative": "créatif", "design": "design", "modern": "moderne",
    "web": "web", "Tool": "Outil", "Tools": "Outils",
    "Cutter": "Cutter", "Saw": "Scie",
    "Electric Drill": "Perceuse électrique",
    "all drill": "toutes les perceuses",
    "Power Tools": "Outillage électroportatif",
    "For power": "Pour les", "users": "utilisateurs exigeants",
    "Servicing & Repair": "Entretien et réparation",
    "Electric car maintenance": "Entretien de voiture électrique",
    "Needle nose pliers": "Pince à bec",
    "Wood Cutting Saw": "Scie à bois",
    "pop rivet gun": "Pince à rivets",
    "Wire Cutter": "Pince coupante",
    "Stainless Swiss Knife": "Couteau suisse inox",
    "flexible measuring tape": "Mètre ruban flexible",
    "Ferrino Steel Knife": "Couteau en acier Ferrino",
    "Core Features": "Caractéristiques clés",
    "All Kind Brand": "Toutes les marques",
    "Expert Mechanic": "Mécanicien expert",
    "Repair Vehicles": "Réparation de véhicules",
    "Paint & Costume": "Peinture et carrosserie",
    "Professional Car": "Voiture professionnelle",
    "Service Provider": "Prestataire de services",
    "Corporate clients and leisure travelers has been relying on Groundlink for dependable, safe, and professional chauffeured car service in major cities across World. Indeed, it has been more than one decade and five years that Groundlink.": "Entreprises et voyageurs d'agrément font confiance à Groundlink pour un service de chauffeur fiable, sûr et professionnel dans les grandes villes du monde. Cela fait maintenant plus de quinze ans que Groundlink.",

    # --- chaussures démo ---
    "MEN'S SHOES": "CHAUSSURES HOMME",
    "Best trucker": "Casquette trucker",
    "Formal Shoe": "Chaussure habillée",
    "new arrivals": "nouveautés", "unisex canva": "toile unisexe",
    "plus suede": "suède plus", "fat lace": "gros lacets",
    "red classic": "rouge classique", "sports men": "sport homme",
    "sports women": "sport femme", "WHAT'S NEW": "NOUVEAUTÉS",
    "The Latest Drop": "Les dernières nouveautés",
    "white keds": "keds blancs", "baby style": "style bébé",
    "black leather": "cuir noir", "black shoe": "chaussure noire",
    "super suede": "super suède", "men shoe": "chaussure homme",
    "stick shoe": "chaussure à scratch",
    "Sports Shoes": "Chaussures de sport",
    "20% Off On": "-20 % sur", "25% off on": "-25 % sur",
    "25% off for": "-25 % pour",

    # --- électroménager démo ---
    "Desktop PC": "PC de bureau", "Components": "Composants",
    "Motherboard": "Carte mère", "New Laptops": "Nouveaux portables",
    "Laptop": "Portable", "Laptop Bag": "Sacoche pour portable",
    "Adapter": "Adaptateur", "Adapters": "Adaptateurs",
    "All Desktop PC": "Tous les PC de bureau",
    "Range Extender": "Répéteur", "Cinema Drone": "Drone cinéma",
    "All in one PC": "PC tout-en-un", "Brand PC": "PC de marque",
    "Mini Pc": "Mini PC", "Processor": "Processeur",
    "Power Supply": "Alimentation", "Keyboard": "Clavier",
    "Mouse": "Souris", "Mouse pad": "Tapis de souris",
    "LED strip": "Ruban LED",
    "Grtaphics card holder": "Support de carte graphique",
    "All Laptop": "Tous les portables",
    "Gaming Laptop": "Portable gaming",
    "Business class Laptop": "Portable professionnel",
    "Touch Laptop": "Portable tactile",
    "Laptop RAM": "RAM pour portable",
    "Laptop Cooler": "Refroidisseur pour portable",
    "Battery": "Batterie", "Intel Processors": "Processeurs Intel",
    "AMD Processors": "Processeurs AMD",
    "New Processor": "Nouveau processeur", "CPU Cooler": "Ventirad",
    "Thermal Paste": "Pâte thermique",
    "Fan Controller": "Contrôleur de ventilateur",
    "GPU Support Brackets": "Supports de carte graphique",
    "PCIe Riser Cables/Extenders": "Câbles et rallonges PCIe",
    "Multi-GPU Bridges": "Ponts multi-GPU", "Dusters": "Bombe à air",
    "Storage": "Stockage",
    "All Graphics": "Toutes les cartes graphiques",
    "Router": "Routeur", "All Brands": "Toutes les marques",
    "Lan Card": "Carte réseau", "Wifi Adaptar": "Adaptateur Wi-Fi",
    "Network Cable": "Câble réseau", "Modem": "Modem",
    "Connector": "Connecteur", "Face Plate": "Plaque frontale",
    "Cable Lan": "Câble LAN", "Patch Panel": "Panneau de brassage",
    "Modular": "Modulaire", "Speaker": "Enceinte",
    "Smart Speaker": "Enceinte connectée",
    "Bluetooth Speaker": "Enceinte Bluetooth",
    "Soundbar": "Barre de son", "Headphone": "Casque",
    "Overhead Headphone": "Casque circum-aural",
    "Neckband": "Tour de cou", "Earphone": "Écouteurs",
    "Voice Recorder": "Dictaphone", "Converter": "Convertisseur",
    "Printer": "Imprimante", "Inkjet Printers": "Imprimantes jet d'encre",
    "Laser Printers": "Imprimantes laser",
    "LED Printers": "Imprimantes LED", "Toner": "Toner",
    "Cartridge": "Cartouche", "Ribbon": "Ruban", "Refill": "Recharge",
    "Charger & Adaptar": "Chargeur et adaptateur",
    "Wireless Charger": "Chargeur sans fil",
    "Cable & Adaper": "Câble et adaptateur", "Cable": "Câble",
    "Daily Lifystyle": "Quotidien",
    "Smart Fat Scale": "Balance connectée",
    "Sensor Light": "Veilleuse à capteur",
    "Electrip Toothbrush": "Brosse à dents électrique",
    "Car charger": "Chargeur voiture",
    "Phone Holder": "Support téléphone",
    "Selfie Stick": "Perche à selfie",
    "Screen Cleaner": "Nettoyant écran",
    "Electrical Power": "Alimentation électrique",
    "Power Cable": "Câble d'alimentation", "Socket": "Prise",
    "Mini Ups": "Mini onduleur",
    "Health & Wellness": "Santé et bien-être",
    "Air Purifier": "Purificateur d'air",
    "Water Purifier": "Purificateur d'eau",
    "Humidifier": "Humidificateur",
    "Dehumidifier": "Déshumidificateur",
    "Home Appliance": "Électroménager",
    "Vaccum Cleaner": "Aspirateur",
    "Washing Machine": "Lave-linge",
    "Portable Fan": "Ventilateur portable",
    "Security Camera": "Caméra de sécurité",
    "Delivary Robot": "Robot de livraison",
    "Graphics Card": "Carte graphique",
    "Network Tools": "Outils réseau",
    "Audio Devices": "Périphériques audio",
    "Printing": "Impression", "Monitors": "Écrans",

    # --- divers ---
    "Bisum - eCommerce Bootstrap 5 Template": "Mobilier Addict",
    "meta description": "Mobilier Addict — meubles, literie et électroménager",
    "Your e-mail": "Votre e-mail", "Search here": "Rechercher",
    "Search your products...": "Recherchez vos produits…",
    "Enter your name": "Entrez votre nom",
    "Enter your e-mail": "Saisissez votre e-mail",
    "Full name": "Nom complet", "Type a subject": "Saisissez un objet",
    "Write your message here*": "Écrivez votre message ici*",
    "Write your comments here": "Écrivez vos commentaires ici",
    "Write your comment here........": "Écrivez votre commentaire ici…",
    "Give your review a title": "Donnez un titre à votre avis",
    "Name": "Nom", "remove button": "bouton supprimer",
    "submenu link": "lien sous-menu", "submenu title": "titre sous-menu",
    "blog image": "image du blog", "article-button": "bouton article",
    "slider-button": "bouton du carrousel",
    "image-banner-button": "bouton de la bannière",
    "view more button": "bouton voir plus", "Category": "Catégorie",
    "product image": "image produit", "image": "image",
    "banner image": "image de bannière", "flag": "drapeau",
    "error": "erreur", "bisum": "Mobilier Addict",
    "YouTube video player": "Lecteur vidéo YouTube",
    "Google map": "Carte Google",
    "Bloger / Photographer": "Blogueur / Photographe",

    # --- passe 2 : restes ---
    "About Us": "À propos de nous",
    "We provide a full range of front end mechanical repairs for all makes and models of cars, no matter": "Nous proposons une gamme complète de réparations mécaniques pour toutes les marques et tous les modèles de voitures, quelle que soit",
    "Get A Quote": "Demander un devis",
    "Book An Appointment": "Prendre rendez-vous",
    "Get Your Service Done": "Confiez-nous votre réparation",
    "Convenient Service": "Service pratique",
    "Expert Mechanics": "Mécaniciens experts",
    "Transparent Pricing": "Tarifs transparents",
    "Meet our Team": "Notre équipe",
    "Founder, Director": "Fondateur, Directeur",
    "Head Technician": "Technicien en chef",
    "Technician": "Technicien",
    "Marketing Manager": "Responsable marketing",
    "Sales Manager": "Responsable commercial",
    "Support Assistant": "Assistant support",
    "Sorting": "Tri",
    "Sorting By": "Trier par",
    "Pica Chair": "Chaise Pica",
    "Mini Backpack": "Mini sac à dos",
    "all bags": "tous les sacs",
    "New Year Sell": "Soldes du nouvel an",
    "25% off": "-25 %",
    "for women": "pour femme",
    "Women Beautiful Handbag": "Beau sac à main pour femme",
    "Bag Bouquet": "Sac Bouquet",
    "Leather collection": "Collection cuir",
    "Office Carrier": "Sac de bureau",
    "Bag & Water pot": "Sac et gourde",
    "Service Center": "Centre de service",
    "Desktop": "PC de bureau",
    "Audio": "Audio",
    "Graphics": "Cartes graphiques",
    "Today's Best Deals": "Meilleures offres du jour",
    "4K FPV Drone": "Drone FPV 4K",
    "Gaming Mice": "Souris gaming",
    "RGB Charging Mousepad": "Tapis de souris RGB avec charge",
    "Bundle offer": "Offre groupée",
    "View Products": "Voir les produits",
    "We ensure security": "Sécurité garantie",
    "Instant support": "Assistance immédiate",
    "PC Building": "Montage PC",
    "Build PC": "Montage PC",
    "Our Latest News": "Nos dernières actualités",
    "Let’s buy": "Achetez",
    "Gadget": "Gadget",
    "Today's Best Deals": 'Meilleures offres du jour',
    'Today’s Best Deals': 'Meilleures offres du jour',
    'Travel The World': 'Voyagez à travers le monde',
    'These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice hand, organizations have the need for integrating in IT departments new technologies.': "Ces cas sont parfaitement simples et faciles à distinguer. Pendant une heure libre, quand notre pouvoir de choisir s'exerce, les organisations doivent intégrer de nouvelles technologies dans leurs services informatiques.",
    'It is a long established fact that a reader will be distracted by the readable content of a page looking at its layout.The point of using Lorem Ipsum is that it has a more-or-less normal distribu letters, as opposed to using ‘Content here, content here’, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their.': "C'est un fait établi : un lecteur est distrait par le contenu lisible d'une page lorsqu'il en examine la mise en page. L'intérêt du Lorem Ipsum est de produire une distribution de lettres à peu près normale, contrairement à « Contenu ici, contenu ici », ce qui lui donne l'apparence d'un texte lisible. De nombreux logiciels de PAO et éditeurs de pages web utilisent le Lorem Ipsum comme",
    'A wonderful serenity has taken possssion of my entire souing like these sweet mornng spring with my whole heart I am alone, and feel the charm of existenceths spot whch was create of souls like mineing am so happy my dear frend so absori bed in the exquste sens of mere.': "Une sérénité merveilleuse s'est emparée de mon âme tout entière, comme ces doux matins de printemps ; je suis seul et je savoure le charme de l'existence en ce lieu qui semble fait pour des âmes comme la mienne. Je suis si heureux, mon cher ami, si absorbé par le délicieux sentiment d'une simple",
    'A wonderful serenity has taken posseson of my entire soung like these sweet mornngs spring enjoy with my whole heart I am alone and feel the charm of exstenceths spot whch was created ouls like mineing am so happy my dear frend so absoribed in the exquste sense of mere tranquil that neglect my talentsr I should bye ncapable of drawng and single stroke at the A wonderful se taken possesson of my entre souing like.': "Une sérénité merveilleuse s'est emparée de mon âme tout entière, comme ces doux matins de printemps ; je suis seul et je savoure le charme de l'existence en ce lieu qui semble fait pour des âmes comme la mienne. Je suis si heureux, mon cher ami, si absorbé par le délicieux sentiment de la tranquillité que j'en néglige mes talents. Une sérénité merveilleuse s'est emparée de mon âme tout entière, comme.",
}

MONTHS = {
    "January": "janvier", "February": "février", "March": "mars",
    "April": "avril", "May": "mai", "June": "juin", "July": "juillet",
    "August": "août", "September": "septembre", "October": "octobre",
    "November": "novembre", "December": "décembre",
}
SMONTHS = {
    "Jan": "janv.", "Feb": "févr.", "Mar": "mars", "Apr": "avr.",
    "May": "mai", "Jun": "juin", "Jul": "juil.", "Aug": "août",
    "Sep": "sept.", "Oct": "oct.", "Nov": "nov.", "Dec": "déc.",
}

MONTH_RE1 = re.compile(r'\b(' + '|'.join(MONTHS) + r')\s+(\d{1,2}),?\s+(\d{4})')
MONTH_RE2 = re.compile(r'\b(\d{1,2})\s+(' + '|'.join(MONTHS) + r'),?\s+(\d{4})')
SMONTH_RE = re.compile(r'\b(\d{1,2})\s+(' + '|'.join(SMONTHS) + r')\s+(\d{4})')
MONEY_RE  = re.compile(r'\$(\d[\d.,]*)')

KEEP = {
    "USD", "CAD", "EUR", "JPY", "GBP", "XS", "XL", "XXL", "SM", "LG",
    "S", "M", "L", "LG, XL", "SM, LG", "SM, XL, XXL", "CPU", "GPU",
    "PC", "TV", "LED", "RGB", "SSD", "RAM", "Wi-Fi", "SKU", "Otobi",
    "Sewnly", "Bynd", "Huemor", "Jordan Crown", "Hubspot", "Ramotion",
    "Infosolutions", "Ideo", "Codal", "Salesforce", "Asus", "HP",
    "Apple", "Dell", "Gigabyte", "Lenovo", "Brother", "Canon", "pantum",
    "C-net", "Cisco", "D-Link", "Intel", "AMD", "Ryzen 3", "Ryzen 5",
    "Ryzen 7", "Ryzen 9", "Pentium", "Celeron", "Xeon", "Core Ultra",
    "Core i3, i5, i7, i9", "Nvidia GeForce", "AMD Radeon", "RTX 4090",
    "RTX 4080", "RTX 4070", "GTX 1660", "GTX 1650", "RX 7900 XTX",
    "RX 7800 XT", "RX 6800 XT", "kate spade", "nike legend stripe",
    "nike legend", "stripe", "ZEN VIVID 16", "PLEATED HEEL",
    "Albert Flores", "Marvin McKinney", "Ralph Edwards", "Susan Gardner",
    "Shakespeare D. Willaim", "Lara Joe", "Floyd Miles", "Spree Themes.",
    "NIK", "john.smith@example.com", "info@example.com",
    "info2@example.com",
}

def tr_dates(s):
    s = MONTH_RE1.sub(lambda m: f"{m.group(2)} {MONTHS[m.group(1)]} {m.group(3)}", s)
    s = MONTH_RE2.sub(lambda m: f"{m.group(1)} {MONTHS[m.group(2)]} {m.group(3)}", s)
    s = SMONTH_RE.sub(lambda m: f"{m.group(1)} {SMONTHS[m.group(2)]} {m.group(3)}", s)
    return s

def tr_money(s):
    s = re.sub(r'\$(\d[\d.,]*)\s*USD', lambda m: m.group(1).replace('.', ',') + ' $ US', s)
    return MONEY_RE.sub(lambda m: m.group(1).replace('.', ',') + ' $', s)

def tr_string(s):
    if s in EXACT:
        return EXACT[s]
    if s in KEEP:
        return None
    out = tr_money(tr_dates(s))
    return out if out != s else None

SEG = re.compile(r'(<script[\s>].*?</script>|<style[\s>].*?</style>|<\?(?:php|=)?.*?\?>|<!--.*?-->)', re.S | re.I)
TAG = re.compile(r'<[^>]+>')
ATTR_RE = re.compile(r'\b(alt|placeholder|title|aria-label)="([^"]*)"', re.I)

untranslated = {}
translated_count = 0

def process_text_node(node):
    global translated_count
    lead = node[:len(node) - len(node.lstrip())]
    trail = node[len(node.rstrip()):]
    key = ' '.join(node.split())
    if not key or not re.search(r'[A-Za-z0-9]', key):
        return node
    r = tr_string(key)
    if r is None:
        if len(key) > 1 and re.search(r'[A-Za-z]', key) and not key.startswith(('{', '<?')) and 'font-family' not in key and '--' not in key:
            untranslated[key] = untranslated.get(key, 0) + 1
        return node
    if r == '':
        return node
    translated_count += 1
    if '&amp;' in node and '&' in r and '&amp;' not in r:
        r = r.replace('&', '&amp;')
    return lead + r + trail

def process_tag(tag):
    def sub(m):
        global translated_count
        key = ' '.join(m.group(2).split())
        r = tr_string(key)
        if r is None or r == '':
            return m.group(0)
        translated_count += 1
        return f'{m.group(1)}="{r}"'
    return ATTR_RE.sub(sub, tag)

files = sorted(glob.glob('*.php')) + sorted(glob.glob('includes/*.php'))
for f in files:
    t = open(f, encoding='utf-8').read()
    out, pos = [], 0
    for seg in SEG.finditer(t):
        chunk = t[pos:seg.start()]
        parts = TAG.split(chunk)
        tags = TAG.findall(chunk)
        rebuilt = []
        for i, p in enumerate(parts):
            rebuilt.append(process_text_node(p))
            if i < len(tags):
                rebuilt.append(process_tag(tags[i]))
        out.append(''.join(rebuilt))
        out.append(seg.group(0))
        pos = seg.end()
    # tail
    chunk = t[pos:]
    parts = TAG.split(chunk)
    tags = TAG.findall(chunk)
    rebuilt = []
    for i, p in enumerate(parts):
        rebuilt.append(process_text_node(p))
        if i < len(tags):
            rebuilt.append(process_tag(tags[i]))
    out.append(''.join(rebuilt))
    nt = ''.join(out)
    if nt != t:
        open(f, 'w', encoding='utf-8').write(nt)
    print(f'{f}: {"modifié" if nt != t else "—"}')

print(f'\n{translated_count} remplacements')
print('\n--- non traduit ---')
for s, n in sorted(untranslated.items(), key=lambda x: -x[1]):
    print(f'{n:4d}  {s[:130]}')
