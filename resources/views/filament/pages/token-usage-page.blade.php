<x-filament::page>
    {{ $this->table }}

    <div>
        <strong>Łączny koszt: </strong> {{ \App\Models\TokenUsage::getTotalEstimatedCost() }} zł
    </div>
</x-filament::page>
