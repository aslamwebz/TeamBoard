# TeamBoard - Business Management Platform

TeamBoard is a comprehensive multi-tenant business management platform that combines project management with vendor and procurement management capabilities.

## Features

### Core Business Management
- **Project Management**: Create, track, and manage projects with phases and milestones
- **Task Management**: Assign, track, and complete individual tasks within projects
- **Team Management**: Organize users into teams and assign them to projects
- **Client Management**: Manage client relationships, contacts, and communications
- **Invoice Management**: Create and track invoices for clients
- **Reporting**: Generate various business reports

### Advanced Vendor Management System
- **Vendor Management**: Track vendor/supplier information, contacts, and services
- **Purchase Orders**: Create and manage purchase orders with approval workflows
- **Worker Profiles**: Manage employee profiles, skills, and certifications
- **Timesheets**: Track work hours and allocate them to projects/tasks
- **Expense Tracking**: Track expenses with vendor associations and project links
- **Outsourcing Integration**: Assign projects and tasks to vendors for external fulfillment

### Key Integrations
- Projects can be assigned to vendors for outsourcing
- Tasks can be subcontracted to external vendors
- Purchase orders linked to specific projects and tasks
- Expenses tracked against projects with vendor relationships
- Complete procurement workflow from request to payment

## Architecture

- **Framework**: Laravel 12.x with PHP 8.4+
- **Multi-tenancy**: Stancl Tenancy for subdomain-based tenant isolation
- **UI**: Livewire 3 with real-time components
- **Permissions**: Spatie Laravel Permissions for role-based access control
- **Database**: MySQL with tenant-specific databases

## Setup

1. Install dependencies:
   ```bash
   composer install
   npm install
   ```

2. Create environment files:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. Configure your database and tenant settings in `.env`.

4. Run migrations:
   ```bash
   php artisan migrate
   ```

5. Seed the database:
   ```bash
   php artisan db:seed --class=DatabaseSeeder
   ```

## Usage

1. **Vendor Management**: Navigate to the Vendors section to manage suppliers
2. **Purchase Orders**: Create purchase orders for procurement needs
3. **Project Management**: Plan and track internal projects
4. **Outsourcing**: Assign projects/tasks to vendors for external fulfillment
5. **Expense Tracking**: Monitor costs associated with vendors and projects

## Tenant Isolation

Each tenant has its own isolated database ensuring complete data separation while sharing the same application codebase.

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License.