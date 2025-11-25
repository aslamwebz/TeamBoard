<?php

namespace Database\Seeders;

use Database\Seeders\webz\UserSeeder;
use Database\Seeders\webz\RolePermissionSeeder;
use Database\Seeders\webz\CompanyProfileSeeder;
use Database\Seeders\webz\TeamSeeder;
use Database\Seeders\webz\UserTeamSeeder;
use Database\Seeders\webz\ClientSeeder;
use Database\Seeders\webz\ClientContactSeeder;
use Database\Seeders\webz\ProjectSeeder;
use Database\Seeders\webz\ProjectTeamSeeder;
use Database\Seeders\webz\ProjectUserSeeder;
use Database\Seeders\webz\TaskSeeder;
use Database\Seeders\webz\TaskAssignmentSeeder;
use Database\Seeders\webz\ClientNoteSeeder;
use Database\Seeders\webz\ClientProjectSeeder;
use Database\Seeders\webz\InvoiceSeeder;
use Database\Seeders\webz\InvoiceLineItemSeeder;
use Database\Seeders\webz\InvoicePaymentSeeder;
use Database\Seeders\webz\InvoiceProjectSeeder;
use Database\Seeders\webz\VendorSeeder;
use Database\Seeders\webz\VendorContactSeeder;
use Database\Seeders\webz\VendorServiceSeeder;
use Database\Seeders\webz\PurchaseRequestSeeder;
use Database\Seeders\webz\PurchaseRequestItemSeeder;
use Database\Seeders\webz\PurchaseOrderSeeder;
use Database\Seeders\webz\PurchaseOrderItemSeeder;
use Database\Seeders\webz\PurchaseOrderVendorSeeder;
use Database\Seeders\webz\ExpenseCategorySeeder;
use Database\Seeders\webz\ExpenseSeeder;
use Database\Seeders\webz\ExpenseAttachmentSeeder;
use Database\Seeders\webz\PaymentMethodSeeder;
use Database\Seeders\webz\PaymentRecordSeeder;
use Database\Seeders\webz\ReportSeeder;
use Database\Seeders\webz\MonthlyReportSeeder;
use Database\Seeders\webz\WorkerProfileSeeder;
use Database\Seeders\webz\SkillSeeder;
use Database\Seeders\webz\CertificationSeeder;
use Database\Seeders\webz\TimesheetSeeder;
use Database\Seeders\webz\WorkerSkillSeeder;
use Database\Seeders\webz\WorkerCertificationSeeder;
use Illuminate\Database\Seeder;

class WebzSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            // Phase 1 - Basic Setup
            RolePermissionSeeder::class,
            UserSeeder::class,
            CompanyProfileSeeder::class,

            // Phase 1 - Relations & Basic Entities
            TeamSeeder::class,
            UserTeamSeeder::class,
            ClientSeeder::class,
            ClientContactSeeder::class,

            // Phase 2 - Projects, Tasks, Clients Upgraded
            ProjectSeeder::class,
            ProjectTeamSeeder::class,
            ProjectUserSeeder::class,
            TaskSeeder::class,
            TaskAssignmentSeeder::class,
            ClientNoteSeeder::class,
            ClientProjectSeeder::class,

            // Phase 3 - Financial Layer
            InvoiceSeeder::class,
            InvoiceLineItemSeeder::class,
            InvoicePaymentSeeder::class,
            InvoiceProjectSeeder::class,

            // Phase 4 - Vendor System + Procurement + Expenses
            VendorSeeder::class,
            VendorContactSeeder::class,
            VendorServiceSeeder::class,
            PurchaseRequestSeeder::class,
            PurchaseRequestItemSeeder::class,
            PurchaseOrderSeeder::class,
            PurchaseOrderItemSeeder::class,
            PurchaseOrderVendorSeeder::class,
            ExpenseCategorySeeder::class,
            ExpenseSeeder::class,
            ExpenseAttachmentSeeder::class,
            PaymentMethodSeeder::class,
            PaymentRecordSeeder::class,

            // Reporting
            ReportSeeder::class,
            MonthlyReportSeeder::class,

            // Worker Management
            WorkerProfileSeeder::class,
            SkillSeeder::class,
            CertificationSeeder::class,
            TimesheetSeeder::class,
            WorkerSkillSeeder::class,
            WorkerCertificationSeeder::class,
        ]);
    }
}