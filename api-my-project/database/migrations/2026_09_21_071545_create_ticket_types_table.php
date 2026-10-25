<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * TicketTypeController / BookingController use available_quantity,
     * sale_start and sale_end, but the original create_ticket_types_table
     * migration never defined them. Each column is added only if missing,
     * so this is safe on a database that already has them.
     */
    public function up(): void
    {
        Schema::table('ticket_types', function (Blueprint $table) {
            if (! Schema::hasColumn('ticket_types', 'available_quantity')) {
                $table->unsignedInteger('available_quantity')->default(0)->after('quantity');
            }

            if (! Schema::hasColumn('ticket_types', 'sale_start')) {
                $table->dateTime('sale_start')->nullable()->after('available_quantity');
            }

            if (! Schema::hasColumn('ticket_types', 'sale_end')) {
                $table->dateTime('sale_end')->nullable()->after('sale_start');
            }
        });
    }

    public function down(): void
    {
        // Intentionally empty: these columns may have existed before this migration.
    }
};
