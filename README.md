# Invoice Management System

A comprehensive invoice management system built with Laravel for handling sales and purchase invoices, inventory management, and business reporting.

**Live Demo:** [https://invoice-website.adriel.id](https://invoice-website.adriel.id)

## Features

### Invoice Management

- **Sales Invoices (Penjualan)**: Create and manage sales invoices
- **Purchase Invoices (Pembelian)**: Track purchases from suppliers
- **Automatic Invoice Numbering**: Auto-generates invoice numbers in format `INV-{user_id}-{count}`
- **Public Invoice Links**: Share invoices via public URLs with toggleable visibility
- **Invoice History**: View invoices filtered by all, sales, or purchases

### Inventory Management

- **Item Management**: Track items with categories, pricing, and stock levels
- **Automatic Stock Updates**: Stock automatically adjusts when creating invoices
- **Stock Tracking**: Monitor current stock, max stock, and last purchase dates
- **Item Search**: Quick search functionality for items
- **Cost Tracking**: Track cost of goods sold (COGS) and retail prices

### Reporting & Analytics

- **Dashboard**: Overview of invoices, items, and key metrics
- **Sales Reports**:
  - Pie charts showing sales by category
  - Column charts for monthly revenue (gross profit, net profit, expenses)
- **Time-based Filtering**: View sales data by week, month, or year
- **Average Sales Analysis**: Hourly sales patterns over the last 3 months

### User Management

- **Authentication**: Laravel Breeze authentication system
- **User Profiles**: Manage user information
- **Multi-user Support**: Each user can manage their own invoices

### Supplier Management

- **Supplier Database**: Store supplier information (name, email, phone, address)
- **Supplier Search**: Quick supplier lookup for purchase invoices

## Tech Stack

- **Backend**: Laravel 9.x
- **Frontend**:
  - Tailwind CSS
  - Alpine.js
  - Laravel Mix
- **Database**: MySQL/PostgreSQL (configurable)
- **PHP**: 8.1+
- **Containerization**: Docker

## Requirements

- PHP 8.1 or higher
- Composer
- Node.js and npm (or bun)
- MySQL or PostgreSQL
- Docker (optional, for containerized deployment)

## Installation

### Using Docker (Recommended)

1. Clone the repository:

```bash
git clone <repository-url>
cd invoice-website
```

2. Build and run with Docker:

```bash
docker build -t invoice-website .
docker run -p 8080:8080 invoice-website
```

### Manual Installation

1. Clone the repository:

```bash
git clone <repository-url>
cd invoice-website
```

2. Install PHP dependencies:

```bash
composer install
```

3. Install Node dependencies:

```bash
npm install
# or if using bun
bun install
```

4. Copy environment file:

```bash
cp .env.example .env
```

5. Generate application key:

```bash
php artisan key:generate
```

6. Configure your `.env` file with database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=invoice_db
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

7. Run migrations:

```bash
php artisan migrate
```

8. Seed the database (optional):

```bash
php artisan db:seed
```

9. Compile assets:

```bash
npm run dev
# or for production
npm run production
```

10. Start the development server:

```bash
php artisan serve
```

## Database Structure

### Main Tables

- **users**: User accounts and authentication
- **invoices**: Invoice records (sales and purchases)
- **items**: Product/item catalog
- **invoice_items**: Junction table linking invoices to items
- **suppliers**: Supplier information

### Key Relationships

- Users have many Invoices
- Invoices have many InvoiceItems
- Items belong to many Invoices through InvoiceItems
- Invoices can belong to a Supplier (for purchases)

## API Endpoints

### Invoice Endpoints

- `POST /api/invoices/create/penjualan` - Create sales invoice
- `POST /api/invoices/create/pembelian` - Create purchase invoice
- `GET /api/invoices/all` - Get all invoices (filtered)
- `GET /api/invoices/year` - Get yearly sales data
- `GET /api/invoices/month` - Get monthly sales data
- `GET /api/invoices/week` - Get weekly sales data
- `GET /api/invoices/user` - Get user's invoices
- `GET /api/invoices/average` - Get average sales per hour
- `GET /api/invoices/sell/{id}` - Get sales invoice details
- `GET /api/invoices/buy/{id}` - Get purchase invoice details
- `POST /api/invoices/toggle/{invoiceNumber}` - Toggle public link visibility
- `GET /invoices/{invoiceNumber}` - Public invoice view

### Item Endpoints

- `GET /api/items/list` - Get items list
- `GET /api/items/grid` - Get items grid view
- `GET /api/item/getItemDetails/{id}` - Get item details
- `POST /api/item/search` - Search items
- `POST /api/item/updateStock` - Update item stock
- `GET /api/item/getStock` - Get stock information
- `GET /api/item/pieChart` - Get pie chart data
- `GET /api/item/getAll` - Get all items

### Supplier Endpoints

- `POST /api/supplier/search` - Search suppliers

### User Endpoints

- `GET /api/user/get` - Get current user
- `GET /api/user/get/{id}` - Get user by ID
- `POST /api/user/update` - Update user information

## Routes

### Web Routes

- `/` - Redirects to dashboard
- `/dashboard` - Main dashboard (requires authentication)
- `/invoice` - Invoice creation page
- `/product` - Product/item management page
- `/report` - Sales reports and analytics
- `/profile` - User profile page

## Features in Detail

### Invoice Categories

- **Penjualan (Sales)**: For tracking sales transactions
- **Pembelian (Purchase)**: For tracking purchases from suppliers

### Stock Management

- Stock automatically decreases when creating sales invoices
- Stock automatically increases when creating purchase invoices
- Track last purchase date for inventory management

### Public Invoice Sharing

- Each invoice can be made publicly accessible via a unique link
- Toggle visibility on/off for each invoice
- Public invoices are accessible without authentication

## Development

### Running Tests

```bash
php artisan test
```

### Code Style

The project follows PSR-12 coding standards.

### Asset Compilation

```bash
# Development
npm run dev

# Watch for changes
npm run watch

# Production build
npm run production
```

## Deployment

The project includes a Dockerfile for containerized deployment. The Docker setup includes:

- PHP 8.1-FPM
- Nginx web server
- Optimized for production with OPcache enabled
- Composer dependencies pre-installed

### Environment Variables

Ensure the following are set in production:

- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL` - Your application URL
- Database credentials
- `APP_KEY` - Application encryption key

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## Support

For issues and questions, please open an issue on the repository.
