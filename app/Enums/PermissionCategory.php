<?php

declare(strict_types=1);

namespace App\Enums;

enum PermissionCategory: string
{
    case USER_MANAGEMENT = 'User Management';
    case ROLE_MANAGEMENT = 'Role Management';
    case PERMISSION_MANAGEMENT = 'Permission Management';
    case PROJECT_MANAGEMENT = 'Project Management';
    case TASK_MANAGEMENT = 'Task Management';
    case CLIENT_MANAGEMENT = 'Client Management';
    case VENDOR_MANAGEMENT = 'Vendor Management';
    case INVOICE_MANAGEMENT = 'Invoice Management';
    case EXPENSE_MANAGEMENT = 'Expense Management';
    case FILE_MANAGEMENT = 'File Management';
    case TEAM_MANAGEMENT = 'Team Management';
    case NOTE_MANAGEMENT = 'Note Management';
    case COMMENT_MANAGEMENT = 'Comment Management';
    case DISCUSSION_MANAGEMENT = 'Discussion Management';
    case FEATURE_MANAGEMENT = 'Feature Management';
    case SETTING_MANAGEMENT = 'Setting Management';
    case OTHER = 'Other';

    public static function getCategoryForPermission(string $permissionName): self
    {
        $permissionName = mb_strtolower($permissionName);

        foreach (self::cases() as $category) {
            if ($category === self::OTHER) {
                continue;
            }

            $keyword = match ($category) {
                self::USER_MANAGEMENT => 'user',
                self::ROLE_MANAGEMENT => 'role',
                self::PERMISSION_MANAGEMENT => 'permission',
                self::PROJECT_MANAGEMENT => 'project',
                self::TASK_MANAGEMENT => 'task',
                self::CLIENT_MANAGEMENT => 'client',
                self::VENDOR_MANAGEMENT => 'vendor',
                self::INVOICE_MANAGEMENT => 'invoice',
                self::EXPENSE_MANAGEMENT => 'expense',
                self::FILE_MANAGEMENT => 'file',
                self::TEAM_MANAGEMENT => 'team',
                self::NOTE_MANAGEMENT => 'note',
                self::COMMENT_MANAGEMENT => 'comment',
                self::DISCUSSION_MANAGEMENT => 'discussion',
                self::FEATURE_MANAGEMENT => 'feature',
                self::SETTING_MANAGEMENT => 'setting',
                default => null,
            };

            if ($keyword && str_contains($permissionName, $keyword)) {
                return $category;
            }
        }

        return self::OTHER;
    }

    public static function getKeywordMap(): array
    {
        return [
            'user' => self::USER_MANAGEMENT,
            'role' => self::ROLE_MANAGEMENT,
            'permission' => self::PERMISSION_MANAGEMENT,
            'project' => self::PROJECT_MANAGEMENT,
            'task' => self::TASK_MANAGEMENT,
            'client' => self::CLIENT_MANAGEMENT,
            'vendor' => self::VENDOR_MANAGEMENT,
            'invoice' => self::INVOICE_MANAGEMENT,
            'expense' => self::EXPENSE_MANAGEMENT,
            'file' => self::FILE_MANAGEMENT,
            'attachment' => self::FILE_MANAGEMENT,
            'team' => self::TEAM_MANAGEMENT,
            'note' => self::NOTE_MANAGEMENT,
            'comment' => self::COMMENT_MANAGEMENT,
            'discussion' => self::DISCUSSION_MANAGEMENT,
            'feature' => self::FEATURE_MANAGEMENT,
            'setting' => self::SETTING_MANAGEMENT,
        ];
    }
}
