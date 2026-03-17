# 🚀 ApiLens — Instant API Monitoring for Laravel

Stop guessing what your APIs are doing.

**ApiLens** gives you a real-time dashboard of your Laravel application's requests — without setting up complex tools like Datadog or NewRelic.

---

## ⚡ Why ApiLens?

* ⚡ **Zero setup** — install and start tracking instantly
* 🔍 **See every request** — endpoint, status, duration
* 🚨 **Spot errors fast** — 4xx / 5xx tracking
* 🐢 **Detect slow APIs** — performance insights
* 🧩 **Built for Laravel** — no external services

---

## 📸 Dashboard Preview

> *(Add your screenshot here: `docs/dashboard.png`)*

---

## 🎯 Perfect For

* Laravel developers
* Freelancers building APIs
* Startups needing quick visibility
* Debugging production issues

---

## 📊 Features

* Request logging (endpoint, method, status, time)
* Error tracking
* Top endpoints
* Slow endpoints
* Filters (status, endpoint)
* Built-in dashboard (`/apilens`)
* Simple token-based access control
* Database + log transport support

---

## 📦 Installation

```bash
composer require apilens/laravel-api-lens
```

---

## ⚙️ Setup (Recommended)

Before installing, configure your `.env`:

```env
APILENS_TRANSPORT=database
APILENS_TOKEN=your-secret
```

Then run:

```bash
php artisan apilens:install
```

This will:

* Run migrations
* (Optional) publish config
* Guide you to next steps

---

## 🚀 Usage

Open your browser:

```
http://localhost:8000/apilens?token=your-secret
```

---

## 🔐 Security

ApiLens uses simple token-based protection:

```
/apilens?token=your-secret
```

You can disable auth in config if needed.

---

## ⚙️ Configuration

(Optional — publish only if you want to customize)

```bash
php artisan vendor:publish --tag=apilens-config
```

Config file:

```
config/apilens.php
```

---

## 🗄 Database

Migrations are loaded automatically from the package.

You only need:

```bash
php artisan migrate
```

> You do NOT need to publish migrations unless you want to modify them.

---

## 🔌 Transport Options

```env
APILENS_TRANSPORT=database
```

Available:

* `database` → stores logs in DB
* `log` → stores logs in file

---

## 🧠 How It Works

1. Middleware captures request + response
2. Event is created
3. Tracker sends data to transport
4. Transport stores logs (DB/file)
5. Dashboard visualizes data

---

## 🧪 Quick Test

Hit any route:

```
/api/test
/test
```

Refresh dashboard → see logs instantly

---

## 🛠 Development (Local Package)

```json
"repositories": [
  {
    "type": "path",
    "url": "../package"
  }
]
```

---

## 🚧 Roadmap

* 📈 Charts & analytics
* ⏱ Time-based filters
* 🔔 Alerts (Slack/email)
* 🌐 SaaS dashboard (multi-project)

---

## 🤝 Contributing

PRs are welcome.

---

## 📄 License

MIT
