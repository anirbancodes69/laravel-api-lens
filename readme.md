# 🚀 ApiLens – Laravel API Logger & Dashboard

ApiLens is a lightweight Laravel package that logs all incoming HTTP requests (API + Web) and provides a simple dashboard to monitor them.

---

## ✨ Features

- 📊 Track all API & web requests
- ⚡ Capture endpoint, method, status, duration
- 🗄 Store logs in database
- 🧩 Plug & play Laravel integration
- 📈 Built-in dashboard (`/apilens`)
- 🔌 Extendable transport layer (DB, logs, etc.)

---

## 📦 Installation

Install via Composer:

```bash
composer require apilens/laravel-api-lens
⚙️ Setup
1. Publish migrations
php artisan vendor:publish --tag=apilens-migrations
2. (Optional) Publish config
php artisan vendor:publish --tag=apilens-config
3. Run migrations
php artisan migrate
4. Add Env variable
APILENS_TRANSPORT=
APILENS_TOKEN=

🚀 Usage

That’s it. No extra setup required.

All incoming requests will now be automatically tracked.

📊 Dashboard

Open in browser:

http://localhost:8000/apilens

You will see:

Endpoint

Method

Status code

Duration

Timestamp

⚙️ Configuration

File: config/apilens.php

return [
    'transport' => 'database', // options: database, log
];

You can switch transport easily.

🔌 Transport Layer

ApiLens uses a pluggable transport system.

Available:

database → stores logs in DB

log → stores logs in file

🧠 How It Works

Middleware captures request + response

Event is created

Tracker sends event to configured transport

Transport stores data (DB/log/etc.)

📁 Data Structure

Table: api_lens_events

Column	Description
endpoint	Request URI
method	GET/POST/etc
status	HTTP status code
duration	Request time (ms)
created_at	Timestamp
🧪 Testing

Hit any route:

http://localhost:8000/test
http://localhost:8000/api/users

Then check dashboard.

🛠 Development

If using locally (path repo):

"repositories": [
  {
    "type": "path",
    "url": "../package"
  }
]
📌 Roadmap

Filters (status, endpoint, time range)

Charts & analytics

Multi-project support

External ingestion API (SaaS mode)

🤝 Contributing

PRs are welcome.

📄 License

MIT


---

If you want next level (and closer to 💰 product):

👉 Next we should add:
- screenshots section
- positioning line (why better than Sentry/DataDog for small teams)
- pricing-ready framing

Just say **“make it market-ready”** and I’ll upgrade this README into a conversion machine