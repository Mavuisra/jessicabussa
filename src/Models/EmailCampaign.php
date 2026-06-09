<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class EmailCampaign extends Model
{
    protected static string $table = 'portefolio_emailcampaign';

    public function getRecipients(): array
    {
        return Newsletter::active();
    }

    public function getSuccessRate(): float
    {
        $total = (int) ($this->total_recipients ?? 0);
        if ($total === 0) {
            return 0.0;
        }
        return ((int) ($this->sent_count ?? 0) / $total) * 100;
    }

    public function markAsSent(): void
    {
        $this->update([
            'status' => 'sent',
            'sent_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
