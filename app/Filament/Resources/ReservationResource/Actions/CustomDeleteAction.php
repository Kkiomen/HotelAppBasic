<?php

namespace App\Filament\Resources\ReservationResource\Actions;

use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Model;

class CustomDeleteAction extends DeleteAction
{
    public function __invoke($record)
    {
        $this->record = $record;

        $this->setUp();

        $this->action(function (): void {
            $result = $this->process(static fn (Model $record) => dump($record));

            if (! $result) {
                $this->failure();

                return;
            }

            $this->success();
        });

        $this->handle();

        return $this;
    }
}
