
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="noindex, nofollow" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta property="og:title" content="Connexion" />
	<meta property="og:description" content="Connexion" />
	<meta property="og:image" content="{{ asset("assets/imgs/logo-2.png") }}"/>
	<meta name="format-detection" content="telephone=no">
    <title>Connexion - Mobilier Addict</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset("assets/imgs/logo-2.png") }}">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
	<style>
		:root {
			--bg: #0b1220;
			--card: rgba(255, 255, 255, .08);
			--card-border: rgba(255, 255, 255, .14);
			--text: #e9eefc;
			--muted: rgba(233, 238, 252, .72);
			--danger: #ff5a6e;
			--primary: #7c3aed;
			--primary-2: #22c55e;
			--shadow: 0 25px 80px rgba(0,0,0,.45);
			--radius: 20px;
		}
		* { box-sizing: border-box; }
		html, body { height: 100%; }
		body {
			margin: 0;
			font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif;
			background: radial-gradient(1200px 600px at 18% 18%, rgba(124, 58, 237, .35), transparent 55%),
						radial-gradient(900px 500px at 80% 70%, rgba(34, 197, 94, .22), transparent 50%),
						linear-gradient(180deg, #070a12 0%, var(--bg) 100%);
			color: var(--text);
		}
		.auth-wrap {
			min-height: 100%;
			display: grid;
			place-items: center;
			padding: 32px 16px;
		}
		.shell {
			width: min(980px, 100%);
			display: grid;
			grid-template-columns: 1.1fr .9fr;
			gap: 20px;
			align-items: stretch;
		}
		@media (max-width: 860px) {
			.shell { grid-template-columns: 1fr; }
		}
		.hero {
			border-radius: var(--radius);
			padding: 30px;
			background: linear-gradient(135deg, rgba(255,255,255,.10) 0%, rgba(255,255,255,.05) 55%, rgba(255,255,255,.03) 100%);
			border: 1px solid rgba(255,255,255,.12);
			box-shadow: var(--shadow);
			position: relative;
			overflow: hidden;
		}
		.hero:before {
			content: "";
			position: absolute;
			inset: -2px;
			background:
				radial-gradient(500px 220px at 30% 0%, rgba(124,58,237,.22), transparent 55%),
				radial-gradient(600px 280px at 80% 100%, rgba(34,197,94,.18), transparent 55%);
			pointer-events: none;
		}
		.brand {
			position: relative;
			display: flex;
			align-items: center;
			gap: 14px;
			margin-bottom: 18px;
		}
		.logo {
			width: 44px;
			height: 44px;
			border-radius: 12px;
			background: rgba(255,255,255,.10);
			border: 1px solid rgba(255,255,255,.14);
			display: grid;
			place-items: center;
			flex: 0 0 auto;
		}
		.logo img { width: 26px; height: 26px; object-fit: contain; }
		.brand h1 {
			margin: 0;
			font-size: 16px;
			letter-spacing: .2px;
			font-weight: 700;
		}
		.brand p {
			margin: 2px 0 0;
			color: var(--muted);
			font-size: 13px;
			line-height: 1.35;
		}
		.hero h2 {
			position: relative;
			margin: 10px 0 10px;
			font-size: 30px;
			line-height: 1.1;
			letter-spacing: -.4px;
		}
		.hero .subtitle {
			position: relative;
			margin: 0;
			color: var(--muted);
			font-size: 14px;
			line-height: 1.55;
			max-width: 48ch;
		}
		.card {
			border-radius: var(--radius);
			padding: 26px;
			background: rgba(255,255,255,.06);
			border: 1px solid var(--card-border);
			box-shadow: var(--shadow);
			backdrop-filter: blur(12px);
		}
		.card h3 {
			margin: 0 0 16px;
			font-size: 18px;
			font-weight: 700;
		}
		.form-row { margin-bottom: 12px; }
		label {
			display: block;
			font-size: 12px;
			color: var(--muted);
			margin-bottom: 6px;
			font-weight: 600;
		}
		input[type="email"],
		input[type="password"] {
			width: 100%;
			padding: 12px 12px;
			border-radius: 12px;
			border: 1px solid rgba(255,255,255,.14);
			background: rgba(8, 12, 22, .55);
			color: var(--text);
			outline: none;
			transition: border-color .15s ease, box-shadow .15s ease;
		}
		input::placeholder { color: rgba(233, 238, 252, .48); }
		input:focus {
			border-color: rgba(124, 58, 237, .7);
			box-shadow: 0 0 0 4px rgba(124, 58, 237, .18);
		}
		.actions {
			display: flex;
			justify-content: space-between;
			align-items: center;
			gap: 12px;
			margin: 12px 0 16px;
		}
		.check {
			display: flex;
			align-items: center;
			gap: 8px;
			font-size: 12px;
			color: var(--muted);
		}
		.check input { width: 16px; height: 16px; }
		.link {
			color: rgba(233, 238, 252, .86);
			text-decoration: none;
			font-size: 12px;
			font-weight: 600;
		}
		.link:hover { text-decoration: underline; }
		.btn {
			width: 100%;
			border: 0;
			cursor: pointer;
			padding: 12px 14px;
			border-radius: 14px;
			font-weight: 700;
			color: #fff;
			background: linear-gradient(135deg, var(--primary) 0%, #2563eb 65%, var(--primary-2) 130%);
			box-shadow: 0 14px 35px rgba(124, 58, 237, .22);
			transition: transform .08s ease, filter .12s ease;
		}
		.btn:active { transform: translateY(1px); }
		.footer {
			margin-top: 12px;
			font-size: 11px;
			color: rgba(233, 238, 252, .55);
			text-align: center;
		}
		.alert {
			border-radius: 14px;
			padding: 12px 12px;
			margin-bottom: 14px;
			border: 1px solid rgba(255, 90, 110, .35);
			background: rgba(255, 90, 110, .10);
			color: rgba(255, 214, 220, .95);
			font-size: 12px;
		}
		.alert ul { margin: 0; padding-left: 18px; }
		.alert li { margin: 0; }
	</style>

</head>

<body>
	<div class="auth-wrap">
		<div class="shell">
			<div class="hero">
				<div class="brand">
					<div class="logo">
						<img src="{{ asset("assets/imgs/logo-2.png")}}" alt="">
					</div>
					<div>
						<h1>Mobilier Addict</h1>
						<p>Accès sécurisé à votre espace d’administration.</p>
					</div>
				</div>
				<h2>Connexion Admin</h2>
				<p class="subtitle">Connecte-toi pour gérer les commandes, les produits, les menus et les modules. Si tu as perdu l’accès, contacte un administrateur.</p>
			</div>

			<div class="card">
				<h3>Se connecter</h3>

				@if ($errors->any())
					<div class="alert" role="alert">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif

				<form method="POST" action="{{ route('login.submit') }}">
					@csrf

					<div class="form-row">
						<label for="email">Email</label>
						<input id="email" type="email" name="email" required value="{{ old('email') }}" placeholder="ex: admin@mobilier-addict.com">
					</div>

					<div class="form-row">
						<label for="password">Mot de passe</label>
						<input id="password" type="password" name="password" required placeholder="Votre mot de passe">
					</div>

					<div class="actions">
						<label class="check" for="remember">
							<input id="remember" type="checkbox" name="remember">
							Se souvenir de moi
						</label>
						<a class="link" href="{{ route('password.request') }}">Mot de passe oublié ?</a>
					</div>

					<button type="submit" class="btn">Accéder au dashboard</button>
				</form>

				<div class="footer">© {{ date('Y') }} Mobilier Addict. Tous droits réservés.</div>
			</div>
		</div>
	</div>
</body>
</html>
